@extends('layout')

@section('content')

<style>
    .container {
      max-width: 450px;
    }
    .push-top {
      margin-top: 50px;
    }
</style>

<div class="card push-top">
  <div class="card-header">
    Edit & Update
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
      <form method="post" action="{{ route('rides.update', $ride->ride_id) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="ride_name">ride Name</label>
              <input type="text" class="form-control" name="ride_name" value="{{ $ride->ride_id }}"/>
          </div>
          <div class="form-group">
              <label for="ride_email">ride Email</label>
              <input type="email" class="form-control" name="ride_email" value="{{ $ride->ride_email }}"/>
          </div>
          <div class="form-group">
              <label for="ride_phone">ride Phone</label>
              <input type="tel" class="form-control" name="ride_phone" value="{{ $ride->ride_phone }}"/>
          </div>
          <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" name="username" value="{{ $ride->username }}"/>
          </div>
          <button type="submit" class="btn btn-block btn-danger">Update User</button>
      </form>
  </div>
</div>
@endsection