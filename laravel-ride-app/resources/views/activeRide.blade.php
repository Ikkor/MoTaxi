@extends('layout')

@section('content')

<style>
  .push-top {
    margin-top: 50px;
  }
</style>

<div class="push-top">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <table class="table">
    <thead>
        <tr class="table-warning">
          <td>From</td>
          <td>To</td>
          <td>Time In</td>
          <td>Service Type</td>
          <td>Distance</td>
          <td>Pay</td>
          <td>Vehicle</td>
          <td>Status</td>
          <td>ETA</td>
        </tr>
    </thead>
    <tbody>
        @foreach($rides as $ride)
        <tr>
            <td>{{$ride->from_loc}}</td>
            <td>{{$ride->to_loc}}</td>
            <td>{{$ride->time_in}}</td>
            <td>{{$ride->service_type}}</td>
            <td>{{$ride->distance}}</td>
            <td>{{$ride->pay}}</td>
            <td>{{$ride->vehicle}}</td>
            <td>{{$ride->status}}</td>
            <td>10minutes</td>
        </tr>
        @endforeach
    </tbody>
  </table>

  
<div>
@endsection