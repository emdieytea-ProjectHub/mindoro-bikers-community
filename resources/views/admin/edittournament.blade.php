@extends('admin.layout.app')

@section('body');
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
      <h1 class="h2">Edit Tournament</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        
        <a href="{{ route('admin.tournament') }}" class="btn btn-sm btn-danger">
          <span data-feather="arrow-left"></span>
          Back
        </a>
      </div>
    </div>
  
    <form method="POST" action="{{ route('admin.tournament.update', $tournament->id) }}">
        @csrf
        @method('patch')
    <div class="">
        @if (session('success'))
           
        <div class="alert alert-success" style="margin-bottom: 20px">
            {{ session('success') }}
        </div>

        @endif

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $tournament->name }}" required>
        </div>
        <div class="form-group">
            <label>City</label>
            <input type="text" name="city" class="form-control" value="{{ $tournament->city }}" required>
        </div>
        <div class="form-group">
            <label>Date</label>
            <input type="date" name="t_date" class="form-control" value="{{ $tournament->t_date }}" required>
        </div>

        <div class="form-group">
            <label>Kick off</label>
            <input type="time" name="kick_off" class="form-control" value="{{ $tournament->kick_off }}" required>
        </div>
        
        <div class="form-group">
            
            <button class="btn btn-primary">
                Save
            </button>
        </div>
    </div>
</form>
  </main>
@endsection