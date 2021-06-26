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
          <td>RideID</td>
          <td>From</td>
          <td>To</td>
          <td>Time In</td>
          <td>Service Type</td>
          <td>Distance</td>
          <td>Pay</td>
          <td>Vehicle</td>
          <td class="text-center">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($rides as $ride)
        <tr>
            <td>{{$ride->ride_id}}</td>
            <td>{{$ride->from_loc}}</td>
            <td>{{$ride->to_loc}}</td>
            <td>{{$ride->time_in}}</td>
            <td>{{$ride->service_type}}</td>
            <td>{{$ride->distance}}</td>
            <td>{{$ride->pay}}</td>
            <td>{{$ride->vehicle}}</td>
            <td class="text-center">
                <a href="{{ route('rides.edit', $ride->ride_id)}}" class="btn btn-primary btn-sm">Edit</a>
                
                <form action="{{ route('rides.destroy', $ride->ride_id)}}" method="post" style="display: inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                  </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection