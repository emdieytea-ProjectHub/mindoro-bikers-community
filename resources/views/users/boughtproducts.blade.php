@extends('users.layout.app')

@section('body')
    <div class="col-lg-6">
        <div class="central-meta">
            @guest
                <div class="row" id="post">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="alert alert-warning text-center">
                                <p>
                                    Please login to Post
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
                        <div class="alert alert-success text-center" style="margin-bottom: 10px">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="d-flex justify-content-between items-center">
                        <h3>
                            Products
                        </h3>
                        <div>
                            <a href="{{ route('market.add_product') }}" class="btn btn-sm btn-primary">
                                <span data-feather="plus-circle"></span>
                                Add
                            </a>
                        </div>

                        @include('users.product_modal')

                    </div>
                </div>
            @endauth


        </div><!-- add post new box -->
        <div class="loadMore">
            <div class="central-meta item">

                @if ($products->count())
                    @foreach ($products as $soldproducts)
                        <div class="user-post" style="margin-top: 30px">
                            <div class="friend-info">
                                <figure>
                                    <img src="{{ asset($soldproducts->seller->avatar) }}" alt="">
                                </figure>
                                <div class="friend-name">
                                    <ins>
                                        <a href="time-line.html" title="">
                                            {{ $soldproducts->seller->fname }} {{ $soldproducts->seller->lname }}
                                        </a>
                                    </ins>
                                    <span>published: {{ $soldproducts->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="post-meta">
                                    <div class="description">

                                        <p>
                                            {{ $soldproducts->boughtproduct->product }}
                                        </p>
                                    </div>
                                    <img src="{{ asset($soldproducts->boughtproduct->productImage) }}" alt="">
                                    <div class="we-video-info">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h4 class="text-danger">
                                                    ₱{{ number_format($soldproducts->boughtproduct->price) }}
                                                </h4>
                                            </div>
                                            <div class="col-md-4">

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <hr>
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
            <div class="widget">
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

<!-- centerl meta -->
