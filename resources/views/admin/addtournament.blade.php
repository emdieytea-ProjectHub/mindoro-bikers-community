@extends('admin.layout.app')

@section('body');
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Add tournament</h1>
            <div class="btn-toolbar mb-2 mb-md-0">

                <a href="{{ route('admin.tournament') }}" class="btn btn-sm btn-danger">
                    <span data-feather="arrow-left"></span>
                    Back
                </a>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.tournament.add') }}">
            @csrf

            <div class="">
                @if (session('success'))

                    <div class="alert alert-success" style="margin-bottom: 20px">
                        {{ session('success') }}
                    </div>

                @endif

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="t_date" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Kick off</label>
                    <input type="time" name="kick_off" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>
                        Route Name
                    </label>
                    <input type="text" name="route_name" class="form-control" required>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Starting destination</label>
                            <input type="text" name="start" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ending destination</label>
                            <input type="text" name="end" class="form-control" required>
                        </div>
                    </div>
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
