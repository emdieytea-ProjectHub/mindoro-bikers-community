@extends('admin.layout.app')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css" />
<script src="https://code.jquery.com/jquery-2.2.4.min.js"
integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.js"></script>


@section('body');
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2"> Report</h1>
            <div class="btn-toolbar mb-2 mb-md-0">


            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table id="report-filter" class="table table-striped table-bordered">
                <thead>
                    <tr>

                        <th>Group Name</th>
                        <th>Number of Users</th>

                    </tr>
                </thead>
                <tbody>

                    @foreach ($groups as $group)


                        <tr>

                            <td>{{ $group->groupName }} </td>
                            <td>
                                <span class="btn btn-warning btn-sm">
                                    {{ $group->usergroup->count() + 1 }}
                                </span>
                            </td>


                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

    <script>
        $('#report-filter').DataTable()
    </script>
@endsection
