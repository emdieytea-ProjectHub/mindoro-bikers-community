@extends('admin.layout.app')

@section('body');
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
      <h1 class="h2">Admins</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        
        <a href="{{ route('admin.users.add') }}" class="btn btn-sm btn-primary">
          <span data-feather="plus-circle"></span>
          Add
        </a>
      </div>
    </div>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
           
            <th>Name</th>
            <th>Email</th>
            <th>action</th>
          </tr>
        </thead>
        <tbody>

         @foreach ($users as $user )
             
         
          <tr>
            
            <td>{{ $user->fname }} {{ $user->lname }}</td>
            <td>
                {{ $user->email }}
            </td>
            <td>
                <div class="btn-group">
                    <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-warning">
                        Edit
                    </a>
                    <a class="btn btn-danger" href="{{ route('admin.user.delete', $user->id) }}" onclick="return confirm('Are you sure you want to delete')">
                        Delete
                  </a>
                </div>
            </td>
            
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </main>
@endsection