@extends('admin.layout.app')

@section('body');
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
            <div class="btn-toolbar mb-2 mb-md-0">


            </div>
        </div>


        <style>
            td {
                text-align: left;
                padding-bottom: 15px !important;




            }

            .aa {
                background: indianred;
                color: white;
                font-weight: 900;
            }

            .bb {
                background: orange;
                color: white;
                font-weight: 900;
            }

            .cc {
                background: yellowgreen;
                color: white;
                font-weight: 900;

            }

            .dd {
                background: cornflowerblue;
                color: white;
                font-weight: 900;
            }

            .ee {
                background: darkslateblue;
                color: white;
                font-weight: 800;

            }

            .tt {
                background: white;
                border: none !important;
            }

        </style>
        @php
            $users = DB::table('users')->get();
        @endphp
        @php
            $product = DB::table('products')->get();
        @endphp
        @php
            $groups = DB::table('groups')->get();
        @endphp
        @php
            $sale = DB::table('soldproducts')->get();
        @endphp
        @php
            $tournaments = DB::table('tournaments')->get();
        @endphp
        <div class="table-responsive">
            <table class="table table-striped table-bordered">

                <tbody>
                    <td style="width: 20%;background-image: url('https://arowix.com/mbc/public/images/download.jpg');"
                        class="aa"><em style="font-size: 3em;">{{ $users->count() }}</em><br><Br> <span>Total Users</span>
                    </td>
                    <td class="tt"></td>
                    <td class="bb" style="width:20%;background-image: url('https://arowix.com/mbc/public/images/set.jpg')">
                        <em style="font-size: 3em;">{{ $product->count() }}</em><br><Br> <span>Total Products</span>
                    </td>
                    <td class="tt"></td>
                    <td class="cc" style="width:20%;background-image: url('https://arowix.com/mbc/public/images/grp.jpg')">
                        <em style="font-size: 3em;">{{ $groups->count() }}</em><br><Br> <span>Total Groups</span>
                    </td>
                    <td class="tt"></td>
                    <td class="dd" style="background-image: url('https://arowix.com/mbc/public/images/sales.jpg')"><em
                            style="font-size: 3em;">{{ $sale->count() }}</em><br><Br> <span>Total Sales</span></td>
                    <td class="tt"></td>
                    <tr>
                        <td class="tt"></td>
                    </tr>
                    <tr>
                        <td class="ee" style="background-image: url('https://arowix.com/mbc/public/images/trnm.jpg')"><em
                                style="font-size: 3em;">{{ $tournaments->count() }}</em><br><Br> <span>Total
                                Tournaments</span></td>
                    </tr>
                </tbody>
            </table>
            <br><br><br><br><br><br><br><br>
        </div>
    </main>
@endsection
