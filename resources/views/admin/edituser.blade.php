@extends('admin.layout.app')

@section('body');
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
      <h1 class="h2">Add users</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        
        <a href="{{ route('admin.users') }}" class="btn btn-sm btn-danger">
          <span data-feather="arrow-left"></span>
          Back
        </a>
      </div>
    </div>
  
    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
        @csrf
        @method('patch')
    <div class="">
        @if (session('success'))
           
        <div class="alert alert-success" style="margin-bottom: 20px">
            {{ session('success') }}
        </div>

        @endif

        <div class="form-group">
            <label>First Name</label>
            <input type="text" name="fname" class="form-control" value="{{ $user->fname }}" required>
        </div>

        <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="lname" class="form-control" value="{{ $user->lname }}" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
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