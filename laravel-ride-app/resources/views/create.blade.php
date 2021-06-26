@extends('layout')

@section('content')

<?php 

$time_in = date("Y-m-d\TH:i:s", strtotime($_GET['time_in'])); 
$from_loc= $_GET['from_loc'];
$to_loc= $_GET['to_loc'];

$eta = 20*$_GET['txt_distance']; //just need to put this into a field
$pay = $_GET['txt_rate']*$_GET['txt_distance'];


?>
<style>
    .container {
      max-width: 450px;
    }
    .push-top {
      margin-top: 50px;
    }
</style>
<form action="https://google.com" method="get">
  <button type="submit" formaction="https://google.com">click me</button>
</form>
<div class="card push-top">
  <div class="card-header">
    Your submitted details 
  </div>

  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('rides.store') }}">

          <div class="form-group">
              @csrf
              <label for="from_loc">To</label>
              <input readonly="readonly" class="form-control" name="from_loc" value=<?php echo $from_loc ?>>
          </div>

          <div class="form-group">
              <label for="to_loc">From</label>
              <input readonly="readonly" class="form-control" name="to_loc" value=<?php echo $to_loc?>>
          </div>

          <div class="form-group">
              <label for="time_in">time_in</label>
              <input readonly="readonly" type="datetime-local" class="form-control" name="time_in" value= <?php echo $time_in; ?> >
          </div>

          <div class="form-group">
              <label for="time_out">time_out [ride is active]</label>
              <input readonly="readonly" type="datetime-local" class="form-control" name="time_out" value=<?php echo $time_in; ?>>
          </div>

          <div class="form-group">
              <label for="username">Username</label>
              <input readonly="readonly" type="text" class="form-control" name="username" value=<?php echo $_GET['txt_name']; ?>>
          </div>

          <div class="form-group">
              <label for="client_id">client_id</label>
              <input readonly="readonly" type="text" class="form-control" name="client_id" value=<?php echo $_GET['txt_id']?>>
          </div>


          <div class="form-group">
              <label for="driver_id">driver_id</label>
              <input readonly="readonly" type="text" class="form-control" name="driver_id" value=<?php echo $_GET['driver_id'] ?>>
          </div>

          <div class="form-group">
              <label for="service_type">service_type</label>
              <input readonly="readonly" type="text" class="form-control" name="service_type" value=<?php echo $_GET['service']?>>
          </div>
          
          <div class="form-group">
              <label for="distance">distance</label>
              <input readonly="readonly" type="text" class="form-control" name="distance" value=<?php echo $_GET['txt_distance']?>>
          </div>

          <div class="form-group">
              <label for="pay">pay</label>
              <input readonly="readonly" type="text" class="form-control" name="pay" value=<?php echo $pay ?>>
          </div>

          <div class="form-group">
              <label for="vehicle">vehicle</label>
              <input readonly="readonly" type="text" class="form-control" name="vehicle" value=<?php echo $_GET['reg_no'] ?>>
          </div>
          <button type="submit" class="btn btn-block btn-danger">Confirm</button>
      </form>
  </div>
</div>
@endsection