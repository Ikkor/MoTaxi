function addContextMenu(map, geocodingService) {
  // First we need to subscribe to the "contextmenu" event on the map
  map.addEventListener('contextmenu', function (evt) {
    currentGeocodingResultObject = null;
    // As we already handle contextmenu event callback on middle waypoints
    // we don't do anything if target is different than the map.
    if (evt.target !== map) {
      return;
    }

    // "contextmenu" event might be triggered not only by a pointer,
    // but a keyboard button as well. That's why ContextMenuEvent
    // doesn't have a "currentPointer" property.
    // Instead it has "viewportX" and "viewportY" properties
    // for the associates position.

    // Get geo coordinates from the screen coordinates.
    let coord = map.screenToGeo(evt.viewportX, evt.viewportY);

    // Now we get the name of the place we clicked using reverse geocode
    geocodingService.reverseGeocode(
      {
        prox: coord.lat + ',' + coord.lng + ',50',
        mode: 'retrieveAddresses',
        maxresults: 1,
        languages: 'en-GB'
      },
      function(response) {
      	let res = response.Response;
        if (res.View && res.View[0].Result && res.View[0].Result[0]) {
          updateContextMenuLabel(evt, res.View[0].Result[0].Location.Address.Label);
          currentGeocodingResultObject = {
            label: res.View[0].Result[0].Location.Address.Label,
            coord
          }
        } else {
          var coordLabel = [
            Math.abs(coord.lat.toFixed(4)) + ((coord.lat > 0) ? 'N' : 'S'),
            Math.abs(coord.lng.toFixed(4)) + ((coord.lng > 0) ? 'E' : 'W')
          ].join(' ');
          updateContextMenuLabel(evt, coordLabel);
          currentGeocodingResultObject = {
            label: coordLabel,
            coord
          }
        }
      },
      function(err) {
        currentGeocodingResultObject = null;
        console.error(err);
      }
    );

    // In order to add menu items, you have to push them to the "items"
    // property of the event object. That has to be done synchronously, otherwise
    // the ui component will not contain them. However you can change the menu entry text asynchronously.
    pushDefaultContextMenuItems(evt, coord);
  });
}

function pushDefaultContextMenuItems(evt, coord) {
  evt.items.push(
    // menu item with label only, which displays address or the current coordinates
    new H.util.ContextItem({
      label: ''
    }),
    // It is possible to add a seperator between items in order to logically group them.
    H.util.ContextItem.SEPARATOR,
    // menu item to set starting point
    new H.util.ContextItem({
      label: 'Set as starting point',
      callback: function() {
        setStartingPoint(currentGeocodingResultObject);
      }
    }),
    // menu item to set destination point
    new H.util.ContextItem({
      label: 'Set as destination',
      callback: function() {
        setDestination(currentGeocodingResultObject);
      }
    })
  );
  
  // add  menu item for adding waypoints, if start % end already defined
  if (waypoints.length >= 2 && waypoints[0] && waypoints[1])  {
  	evt.items.push(
      // menu item to set middle waypoint
      new H.util.ContextItem({
        label: 'Add waypoint',
        callback: function() {
          addWaypoint(currentGeocodingResultObject);
        }
      })
    );
  }
}

function updateContextMenuLabel(evt, addressLabel) {
  var item = evt.items[0];
  item.setLabel(addressLabel);
}

function setStartingPoint(geocodingResult) {
  if (geocodingResult) {
    // update input value
    document.getElementById('inputStart').value = geocodingResult.label;
    // set first waypoint
    waypoints[0] = {
      label: geocodingResult.label,
      coord: geocodingResult.coord
    }

    // add marker / or updated its position for starting point
    if (startMarkerObject) {
      startMarkerObject.setGeometry(geocodingResult.coord);
    } else {
      startMarkerObject = new H.map.Marker(geocodingResult.coord);
      map.addObject(startMarkerObject);
    }
  }
  // try to calculate route
  calculateRoute();
}

function setDestination(geocodingResult) {
  if (geocodingResult) {
    // update input value
    document.getElementById('inputDest').value = geocodingResult.label;


    // set the last waypoint
    let index = (waypoints.length < 2) ? 1 : (waypoints.length - 1);
    
    waypoints[index] = {
      label: geocodingResult.label,
      coord: geocodingResult.coord
    }

    // add marker / or updated its position for destination point
    if (destMarkerObject) {
      destMarkerObject.setGeometry(geocodingResult.coord);
    } else {
      destMarkerObject = map.addObject(new H.map.Marker(
        geocodingResult.coord,
        {icon: new H.map.Icon(
            'https://image.flaticon.com/icons/png/512/37/37134.png', 
            {size: {h: 45, w:47}})
        }
      ));
    }
  }

  // try to calculate route
  calculateRoute()
}

function addWaypoint(geocodingResult) {
  if (geocodingResult) {
    // add marker for middle waypoint
    let index = waypoints.length - 1,
    		icon = new H.map.Icon(
          svg.replace('INDEX', index), 
          {
            size: {w: iconWidth, h: iconHeight}
          }
        ),
        marker = new H.map.Marker(
          geocodingResult.coord,
          {
            icon: icon,
            data: {'index': index}
          }
        );
    
    map.addObject(marker);
    
    // add contextmenu callback to the marker
    marker.addEventListener('contextmenu', function(evt) {
    	evt.items.push(
      	new H.util.ContextItem({
          label: 'Remove waypoint',
          callback: function() {
            removeWaypoint(marker);
          }
        })
      );
    });
  
    // add waypoint before destination point
    waypoints.splice(waypoints.length - 1, 0, {
      label: geocodingResult.label,
      coord: geocodingResult.coord,
      marker: marker
    });

    // recalculate the route
    calculateRoute();
  }
}

function removeWaypoint(markerObject) {
  // remove from waypoints list
  waypoints.splice(markerObject.getData()['index'], 1)[0];
  
  // remove marker object from map
  map.removeObject(markerObject);
  
  // reset icons and data for rest of waypoint markers
  let index = 0;
  waypoints.forEach(function(waypoint) {
  	if (waypoint['marker']) {
    	waypoint['marker'].setIcon(new H.map.Icon(
        svg.replace('INDEX', index), 
        {
          size: {w: iconWidth, h: iconHeight}
        }
      ));
      waypoint['marker'].setData({'index': index});
    }
    index++;
  });
  
  // recalculate the route
  calculateRoute();
}

function calculateRoute() {
  if (waypoints.length >= 2 && waypoints[0] && waypoints[1]) {
  	// delete previous routing result information
    document.getElementById('info').innerHTML = '';
    
    let params = {
          mode: 'fastest;car',
          routeattributes : 'summary,shape',
          representation: 'display'
        },
        index = 0;
      
    // add waypoints
    waypoints.forEach(function(point) {
    	params['waypoint' + index++] = 'geo!' + point.coord.lat + ',' + point.coord.lng;
    });
    
    // calculate new route
    routingService.calculateRoute(
      params,
      function(result) {
        let res = result.response;
        if (res.route[0]) {
          var lineString = new H.geo.LineString();
          res.route[0].shape.forEach(function(latLng) {
            var splitLatLng = latLng.split(',')
            lineString.pushLatLngAlt(splitLatLng[0], splitLatLng[1], 0);
          })

          // add / update route Polyline
          if (routeObject) {
            routeObject.setGeometry(lineString);
          } else {
            routeObject = map.addObject(new H.map.Polyline(lineString, {style: {
              strokeColor: 'rgb(255, 165, 0)',
              lineWidth: 5
            }}));
          }

          // add / update polyline from original start position to mapped start position
          let startLineString = new H.geo.LineString(),
          		splitLatLng = res.route[0].shape[0].split(',');
              
          startLineString.pushPoint(waypoints[0].coord);
          startLineString.pushLatLngAlt(splitLatLng[0], splitLatLng[1], 0);
          
          if (startRouteObject) {
            startRouteObject.setGeometry(startLineString);
          } else {
            startRouteObject = new H.map.Polyline(startLineString, {style: {
              strokeColor: 'rgba(255, 165, 0, 0.7)',
              lineWidth: 5,
              lineDash: [1, 5],
              lineCap: 'round'
            }});
            map.addObject(startRouteObject);
          }

          // add / update polyline from mapped to original destionation position
          let destLineString = new H.geo.LineString();
          splitLatLng = res.route[0].shape[res.route[0].shape.length - 1].split(',')
          destLineString.pushLatLngAlt(splitLatLng[0], splitLatLng[1], 0);
          destLineString.pushPoint(waypoints[waypoints.length - 1].coord);
          if (destRouteObject) {
            destRouteObject.setGeometry(destLineString);
          } else {
            destRouteObject = map.addObject(new H.map.Polyline(destLineString, {style: {
              strokeColor: 'rgba(255, 165, 0, 0.7)',
              lineWidth: 5,
              lineDash: [1, 5],
              lineCap: 'round'
            }}));
          }

          // update summary text
          document.getElementById('info').innerHTML = res.route[0].summary.text;
          document.getElementById('distance').value = res.route[0].summary.distance;




        }
      },
      function(err) {
        document.getElementById('info').innerHTML = err;
        error = err;
      });
  }
}

// Step 1: initialize communication with the platform
// In your own code, replace variable window.apikey with your own apikey
const platform = new H.service.Platform({
  apikey: 'vZJXS7TB0jQvKS1o1VocuG47nR6dIBWyyzmlTuZomHY'
});
const maptypes = platform.createDefaultLayers();


var lon;
var lat;

    $.ajax({
          url: "https://geolocation-db.com/jsonp",
          jsonpCallback: "callback",
          dataType: "jsonp",
          success: function(location) {
            lon=location.longitude;
            lat=location.latitude;

          }
        })

// Step 2: initialize a map - this map is centered over Europe
const map = new H.Map(document.getElementById('map'),
  maptypes.vector.normal.map, {
    center: {
      lat: lat,
      lng: lon
    },
    zoom: 14,
    pixelRatio: window.devicePixelRatio || 1
  });
  
map.getViewPort().setPadding(30, 30, 30, 30);

// add a resize listener to make sure that the map occupies the whole container
window.addEventListener('resize', () => map.getViewPort().resize());

// Step 3: make the map interactive
// MapEvents enables the event system
// Behavior implements default interactions for pan/zoom (also on mobile touch environments)
const behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

// Create the default UI components
const ui = H.ui.UI.createDefault(map, maptypes);

// Create geocoding and routing service
var geocodingService = platform.getGeocodingService(),
		routingService = platform.getRoutingService(),
    currentGeocodingResultObject,
    waypoints = [],
    startRouteObject,
    destRouteObject,
    routeObject,
    startMarkerObject,
    destMarkerObject,
    iconWidth = 28,
    iconHeight = 36,
    svg = `<svg
          xmlns="http://www.w3.org/2000/svg"
          width="${iconWidth}px"
          height="${iconHeight}px"
        >
          <style>
            .text {
              font-size: ${iconWidth / 2}px;
              fill: white;
            }
          </style>

          <path
            d="M 13 0 C 9.5 0 6.3 1.3 3.8 3.8 C 1.4 7.8 0 9.4 0 12.8 C 0 16.3 1.4 19.5 3.8 21.9 L 13 31 L 22.2
               21.9 C 24.6 19.5 25.9 16.3 25.9 12.8 C 25.9 9.4 24.6 6.1 22.1 3.8 C 19.7 1.3 16.5 0 13 0 Z"
            fill="white"
          />
          <path
            d="M 13 2.2 C 6 2.2 2.3 7.2 2.1 12.8 C 2.1 16.1 3.1 18.4 5.2 20.5 L 13 28.2 L 20.8 20.5 C
               22.9 18.4 23.8 16.2 23.8 12.8 C 23.6 7.07 20 2.2 13 2.2 Z"
            fill="rgba(255, 165, 0, 0.8)"
          />
          <text
            x="${iconWidth / 2 - iconWidth / 5}"
            y="${iconHeight / 2}"
            class="text"
          >
            INDEX
          </text>
        </svg>`;

// Step 5: main logic
addContextMenu(map, geocodingService);
