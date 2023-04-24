@extends('admin.layout.app')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css" />
<script src="https://code.jquery.com/jquery-2.2.4.min.js"
integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.js"></script>

@section('body');
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2"> Sales</h1>
            <div class="btn-toolbar mb-2 mb-md-0">


            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table id="tbl-sales-filter" class="table table-striped table-bordered">
                <thead>
                    <tr>

                        <th>Seller Name</th>
                        <th>Buyer Name</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Sold Date</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($soldproducts as $soldproduct)
                        <tr>

                            <td>{{ $soldproduct->seller->fname }} {{ $soldproduct->seller->lname }}</td>
                            <td>{{ $soldproduct->buyer->fname }} {{ $soldproduct->buyer->lname }}</td>

                            <td>
                                {{ $soldproduct->boughtproduct->product }}
                            </td>
                            <td>
                                {{ number_format($soldproduct->boughtproduct->price) }}
                            </td>

                            <td>
                                {{ date('d-F-Y', strtotime($soldproduct->created_at)) }}
                                ({{ $soldproduct->created_at->diffForHumans() }})
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>


    <script>
        $("#tbl-sales-filter").DataTable()
    </script>
@endsection
