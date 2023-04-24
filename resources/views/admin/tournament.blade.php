@extends('admin.layout.app')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css" />
<script src="https://code.jquery.com/jquery-2.2.4.min.js"
integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.js"></script>

@section('body');
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Tournaments</h1>
            <div class="btn-toolbar mb-2 mb-md-0">

                <a href="{{ route('admin.tournament.add') }}" class="btn btn-sm btn-primary">
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


        <div class="table-responsive">
            <table id="tbl-tournaments-filter" class="table table-striped table-bordered">
                <thead>
                    <tr>

                        <th>Name</th>
                        <th>City</th>
                        <th>Date</th>
                        <th>Kick Off</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tournaments as $tournament)


                        <tr>

                            <td>{{ $tournament->name }}</td>
                            <td>
                                {{ $tournament->city }}
                            </td>

                            <td>
                                {{ $tournament->t_date }}
                            </td>

                            <td>
                                {{ $tournament->kick_off }}
                            </td>

                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.tournament.edit', $tournament->id) }}"
                                        class="btn btn-warning">
                                        Edit
                                    </a>
                                    <a class="btn btn-danger"
                                        href="{{ route('admin.tournament.delete', $tournament->id) }}"
                                        onclick="return confirm('Are you sure you want to delete')">
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

    <script>
        $("#tbl-tournaments-filter").DataTable()
    </script>
@endsection
