@extends('admin.layout.app')

@section('body');
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css" />
    <style>
        ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .notification-drop {
            font-family: 'Ubuntu', sans-serif;
            color: #444;
        }

        .notification-drop .item {
            padding: 10px;
            font-size: 18px;
            position: relative;
            border-bottom: 1px solid #ddd;
        }

        .notification-drop .item:hover {
            cursor: pointer;
        }

        .notification-drop .item i {
            margin-left: 10px;
        }

        .notification-drop .item ul {
            display: none;
            position: absolute;
            top: 100%;
            background: #fff;
            left: -200px;
            right: 0;
            z-index: 1;
            border-top: 1px solid #ddd;
        }

        .notification-drop .item ul li {
            font-size: 16px;
            padding: 15px 0 15px 25px;
        }

        .notification-drop .item ul li:hover {
            background: #ddd;
            color: rgba(0, 0, 0, 0.8);
        }

        @media screen and (min-width: 500px) {
            .notification-drop {
                display: flex;
                justify-content: flex-end;
            }

            .notification-drop .item {
                border: none;
            }
        }



        .notification-bell {
            font-size: 20px;
        }

        .btn__badge {
            background: #FF5D5D;
            color: white;
            font-size: 12px;
            position: absolute;
            top: 0;
            right: 0px;
            padding: 3px 10px;
            border-radius: 50%;
        }

        .pulse-button {
            box-shadow: 0 0 0 0 rgba(255, 0, 0, 0.5);
            -webkit-animation: pulse 1.5s infinite;
        }

        .pulse-button:hover {
            -webkit-animation: none;
        }

        @-webkit-keyframes pulse {
            0% {
                -moz-transform: scale(0.9);
                -ms-transform: scale(0.9);
                -webkit-transform: scale(0.9);
                transform: scale(0.9);
            }

            70% {
                -moz-transform: scale(1);
                -ms-transform: scale(1);
                -webkit-transform: scale(1);
                transform: scale(1);
                box-shadow: 0 0 0 50px rgba(255, 0, 0, 0);
            }

            100% {
                -moz-transform: scale(0.9);
                -ms-transform: scale(0.9);
                -webkit-transform: scale(0.9);
                transform: scale(0.9);
                box-shadow: 0 0 0 0 rgba(255, 0, 0, 0);
            }
        }

        .notification-text {
            font-size: 14px;
            font-weight: bold;
        }

        .notification-text span {
            float: right;
        }

    </style>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.js"></script>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <div class="d-flex">
                <h1 class="h2 mr-5">Products</h1>
                <ul class="notification-drop">
                    @php
                        $not_verify_count = 0;

                        foreach ($products as $product) {
                            if ($product->verified == null) {
                                $not_verify_count++;
                            }
                        }
                    @endphp
                    <li class="item">
                        <span data-feather="bell" class="text-dark text-bold"> </span>
                        <ul>
                            @if ($not_verify_count <= 0)
                                <li class="text-success">
                                    <span data-feather="check" class="text-info"></span>&nbsp;All products verified!
                                </li>
                            @else
                                @foreach ($products as $product)
                                    @if ($product->verified == null)
                                        <li class="text-danger">
                                            <strong>{{ $product->product }}</strong> is need to verify.
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="btn-toolbar mb-2 mb-md-0">


                <a href="{{ route('market.add_product') }}" class="btn btn-sm btn-primary">
                    <span data-feather="plus-circle"></span> Add
                </a>

            </div>

        </div>



        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table id="tbl-prod-filter" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Seller</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Sold status</th>
                        <th>Verification</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                <img src="{{ asset($product->productImage) }}" style="width: 50px">
                            </td>
                            <td>
                                {{ $product->user->fname }} {{ $product->user->lname }}
                            </td>

                            <td>
                                {{ $product->product }}
                            </td>

                            <td>
                                {{ number_format($product->price) }}
                            </td>

                            <td>
                                @if ($product->status == 0)
                                    <span class="badge badge-warning">
                                        On sell
                                    </span>
                                @else
                                    <span class="badge badge-success">
                                        Sold
                                    </span>
                                @endif
                            </td>

                            <td>
                                @if ($product->verified == null)
                                    <span class="badge badge-danger">
                                        Not verified
                                    </span>
                                @else
                                    <span class="badge badge-success">
                                        Verified
                                    </span>
                                @endif
                            </td>

                            <td>
                                <div class="btn-group">

                                    <a class="btn btn-info btn-sm" href="" data-toggle="modal"
                                        data-target="#view{{ $product->id }}">
                                        View
                                    </a>
                                    <a class="btn btn-warning btn-sm {{ $product->verified ? 'disabled' : '' }}"
                                        href="{{ route('admin.products.verify', $product->id) }}">
                                        Verify
                                    </a>
                                </div>
                            </td>

                        </tr>
                        @include('admin.modal_view')
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

    <script>
        $("#tbl-prod-filter").DataTable()

        $(".notification-drop .item").on('click', function() {
            $(this).find('ul').toggle();
        });
    </script>
@endsection
