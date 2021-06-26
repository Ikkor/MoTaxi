<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ride;
class RideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
    only store/ index and update will be used
    */

    public function index(){
        //
        $ride = ride::all();
        //return view('index' , compact('renter'));
        return view('indexAdmin' , ['rides' => $ride]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
        return view('create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //
        $storeData = $request->validate([
            'from_loc' => 'required|max:255',
            'to_loc' => 'required|max:255',
            // 'time_in' => 'nullable|date_format:Y-m-d H:i:s',
            // 'time_out' => 'nullable|date_format:Y-m-d H:i:s',
            'time_in' => 'nullable',
            'time_out' => 'nullable',

            'client_id' => 'required|max:255',
            'driver_id' => 'required|max:255',
            'service_type' => 'required|max:255',
            'distance' => 'required|numeric',
            'pay' => 'required|numeric',
            'vehicle' => 'required|max:255'
        ]);
        $storeData['status']='ongoing';
        $ride = ride::create($storeData);
        $ride=compact('ride');

        return view('activeRide',['rides' => $ride]);
        //return redirect('/rides')->with('success', 'Ride details have been saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //if a ride is ongoing then it has no time_out
    public function show($id){
        //
    }
      /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        //
        $ride = ride::findOrFail($id);
        return view('edit', compact('ride'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $updateData = $request->validate([
            'time_out' => 'nullable|max:255',
        ]);
        ride::where('ride_id',$id)->update($updateData);
        
        return redirect('/rides')->with('success', 'ride details have been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //
        $ride = ride::findOrFail($id);
        $ride->delete();

        return redirect('/rides')->with('completed', 'ride has been deleted');
    }
}
