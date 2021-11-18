@extends('admin.layout.app')

@section('body');
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
      <h1 class="h2">Add Scores</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        
        <a href="{{ route('admin.scoreboard') }}" class="btn btn-sm btn-danger">
          <span data-feather="arrow-left"></span>
          Back
        </a>
      </div>
    </div>
  
    <form method="POST" action="{{ route('admin.scoreboard.update', $scoreboard->id ) }}">
        @csrf
        @method('patch')   
    <div class="">
        @if (session('success'))
           
        <div class="alert alert-success" style="margin-bottom: 20px">
            {{ session('success') }}
        </div>

        @endif

        <div class="form-group">
            <label>Tournament</label>
            <select class="form-control" name="tournament_id" required>
                <option value="{{ $scoreboard->tournament_id }}">{{ $scoreboard->tournament->name }}</option>
            
           @foreach ($tournaments as $tournament )
               <option value="{{ $tournament->id }}">
                    {{ $tournament->name }}
                </option>
           @endforeach
        </select>
        </div>
        
        <div class="form-group">
            <label>Team</label>
            <input type="text" name="team" value="{{ $scoreboard->team }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Time</label>
            <input type="text" name="time" value="{{ $scoreboard->time }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Time Interval</label>
            <input type="text" name="time_interval" value="{{ $scoreboard->time_interval }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Actual Time</label>
            <input type="text" name="actual_time" value="{{ $scoreboard->actual_time }}" class="form-control" required>
        </div>
         <div class="form-group">
            <label>Rank</label>
            <input type="text" name="rank" value="{{ $scoreboard->rank }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label>score</label>
            <input type="text" name="score" value="{{ $scoreboard->score }}"  class="form-control" required>
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