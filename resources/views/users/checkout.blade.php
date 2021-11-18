@extends('users.layout.app')

@section('body')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="col-lg-6">
        <div class="central-meta item">
            @if (session('success'))
                <div class="alert alert-success text-center" style="margin-bottom: 10px">
                    {{ session('success') }}
                </div>
            @endif
            <form method="POST" action="{{ route('market.checkout.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                    <h3 class="card-title">
                        Product Checkout: {{ $product->product }}
                    </h3>
                </div>
                <input type="hidden" name="seller_id" value="{{ $product->user_id }}">
                <input type="hidden" name="buyer_id" value="{{ Auth::id() }}">
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="form-group">
                    <label>
                        Delivery Address
                    </label>
                    <textarea rows="3" name="address" class="form-control" style="background-color: #fff"
                        required></textarea>
                </div>

                <div class="form-radio">
                    <div class="radio">
                        <label>
                            <input type="radio" checked="checked" name="radio"><i class="check-box"></i>Cash on delivery
                        </label>
                    </div>

                </div>
        </div>

        <div class="card-footer">
            <button class="btn btn-success btn-sm" type="submit">
                Continue
            </button>
        </div>
        </form>
    </div>

    </div>

    </div>
    <script>
        $('.numeric').keypress(function(e) {
            var a = [];
            var k = e.which;

            for (i = 48; i < 58; i++)
                a.push(i);

            if (!(a.indexOf(k) >= 0))
                e.preventDefault();

            // $('span').text('KeyCode: '+k);
        });
    </script>
@endsection

<!-- centerl meta -->
