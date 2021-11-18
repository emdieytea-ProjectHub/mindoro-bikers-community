@extends('users.layout.app')

@section('body')
    <div class="col-lg-6">
        <div class="central-meta" style="border: 3px solid #0af5dd; border-radius:5px;  box-shadow: 10px 10px aquamarine; ">
            @guest
                <div class="row" id="post">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="alert alert-warning text-center">
                                <p>
                                    Please login to buy or sell
                                </p>
                                <a class="btn btn-warning" href="{{ route('login') }}">
                                    Login
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endguest

            @auth
                <div class="new-postbox">

                    @if (session('success'))
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="d-flex justify-content-between items-center">
                        <h3>
                            Products
                        </h3>
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('market.add_product') }}" class="btn btn-sm btn-primary p-2">
                                <span data-feather="plus-circle"></span>
                                + Add
                            </a>
                            <div>
                                <input type="search" id="search" class="form-control" placeholder="Search product..." />
                            </div>
                        </div>

                        @include('users.product_modal')

                    </div>
                </div>
            @endauth


        </div><!-- add post new box -->
        <div class="">
            <div class="central-meta item"
                style="border: 3px solid #0af5dd; border-radius:5px;  box-shadow: 10px 10px aquamarine; ">

                @if ($products->count())
                    @foreach ($products as $product)
                        <div class="user-post product" style="margin-top: 30px">
                            <div class="friend-info">
                                <figure>
                                    <img src="{{ asset($product->user->avatar) }}" alt="">
                                </figure>
                                <div class="friend-name">
                                    <ins>
                                        <a href="#" title="">
                                            {{ $product->user->fname }} {{ $product->user->lname }}
                                        </a>
                                    </ins>
                                    <div id="div_rating{{ $product->id }}">
                                        @php
                                            $star = number_format($product->rating->avg('rate'));
                                        @endphp
                                        <div class="pull-right">
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($i < $star)
									   <i class="fa fa-star text-warning"></i>
                                                    @else
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <i class="fa fa-star-o"></i> @endif @endfor
                                                    {{ $star }}
                                        </div>
                                    </div>
                                    <span>published: {{ $product->created_at->diffForHumans() }}</span>

                                </div>
                                <div class="post-meta">
                                    <div class="description">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p>
                                                    {{ $product->product }}
                                                </p>
                                                <p>
                                                    {{ $product->description }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <img class="img-thumbnail img-fluid" width="100%" height="100%"
                                            src="{{ asset($product->productImage) }}" alt="">
                                    </div>
                                    <div class="we-video-info">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h4 class="text-danger">
                                                    ₱{{ number_format($product->price) }}
                                                </h4>
                                            </div>

                                            <div class="col-md-3">
                                                @auth
                                                    @if ($product->user_id !== Auth::id())
                                                        Rate the Seller:<br>
                                                        <span style="cursor: pointer">

                                                            <i id="{{ $product->id }}" class="rate fa fa-star-o"
                                                                data-id="1"></i>
                                                            <i id="{{ $product->id }}" class="rate fa fa-star-o"
                                                                data-id="2"></i>
                                                            <i id="{{ $product->id }}" class="rate fa fa-star-o"
                                                                data-id="3"></i>
                                                            <i id="{{ $product->id }}" class="rate fa fa-star-o"
                                                                data-id="4"></i>
                                                            <i id="{{ $product->id }}" class="rate fa fa-star-o"
                                                                data-id="5"></i>
                                                        </span>
                                                    @endif

                                                    <div class="btn-group">

                                                        <a class="btn btn-info btn-sm" href="" data-toggle="modal"
                                                            data-target="#view{{ $product->id }}">
                                                            View Information
                                                        </a>
                                                        @include('users.modal_view')
                                                    </div>

                                                @endauth
                                            </div>

                                            <div class="col-md-3">
                                                @auth
                                                    @if ($product->user_id !== Auth::id())

                                                        <a href="{{ route('market.checkout', $product->id) }}"
                                                            class="btn btn-success btn-sm pull-right">
                                                            Buy
                                                        </a>
                                                    @endif
                                                @endauth
                                            </div>

                                            <div class="col-md-3">
                                                @auth
                                                    @if ($product->user_id !== Auth::id())

                                                        <a href="{{ route('sendMessage', $product->user_id) }}"
                                                            class="btn btn-success btn-sm pull-right">
                                                            Message the seller
                                                        </a>
                                                    @endif
                                                @endauth
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div>
                            <br />
                            <hr />
                        </div>
                    @endforeach
                @else

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="alert alert-warning text-center">
                                    <p>
                                        No post yet, be the first to Post!!!!
                                    </p>

                                    @auth
                                        <a class="btn btn-warning" href="#login">
                                            Post
                                        </a>
                                    @endauth

                                </div>
                            </div>
                        </div>
                    </div>

                @endif

            </div>


        </div>
    </div>
    <div class="col-lg-3">
        <aside class="sidebar static">
            <div class="widget" style="border: 3px solid #0af5dd; border-radius:5px;  box-shadow: 10px 10px aquamarine; ">
                <h4 class="widget-title">Menu</h4>
                <ul class="naves">
                    <li>
                        <a href="{{ route('market') }}" title="">All products</a>
                    </li>
                    <li>
                        <a href="{{ route('market.my_product') }}" title="">My products</a>
                    </li>
                    <li>
                        <a href="{{ route('market.sold_product') }}" title="">My Sold Products </a>
                    </li>
                    <li>
                        <a href="{{ route('market.bought_product') }}" title="">My Bought products</a>
                    </li>

                </ul>
            </div><!-- Shortcuts -->

        </aside>
    </div>


@endsection

@push('custom-scripts')
    <script>
        $('body').on('click', '.rate', function() {
            let id = $(this).attr('id');
            let data = $(this).data('id');

            $.ajax({
                type: "get",
                url: "{{ route('rate') }}",
                data: {
                    id: id,
                    rate: data
                },
                success: function(data) {
                    alert(data)
                    $(`#div_rating${id}`).load(`{{ Request::url() }} #div_rating${id}`);
                }
            });
        })

        $('#search').keyup(function(evt) {
            let txt = $('.product').hide();
            $('.product:contains("' + $(this).val() + '")').show();
        });
    </script>
@endpush
