<style>
    .modal-backdrop {
        z-index: -1;
    }

</style>

<div class="modal fade" id="view{{ $product->id }}" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <br>
        <div class="modal-content">
            <div class="modal-header alert-fill-danger">
                <h5 class="modal-title" id="exampleModalLabel">
                    View Information
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times</span>
                </button>

            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <img src="{{ asset($product->productImage) }}" style="width: 50%">
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        Product Name:
                    </div>
                    <div class="col-md-6">
                        {{ $product->product }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        Price
                    </div>
                    <div class="col-md-6">
                        {{ number_format($product->price) }}
                    </div>
                </div>

                @foreach ($product->soldproducts as $sold)


                    <div class="row">
                        <div class="col-md-6">
                            Buyer
                        </div>
                        <div class="col-md-6">
                            @php
                                $buyer = DB::table('users')
                                    ->where('id', $sold->buyer_id)
                                    ->get()[0];

                            @endphp

                            {{ $buyer->fname . ' ' . $buyer->lname }}
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            Contact:
                        </div>
                        <div class="col-md-6">
                            {{ $buyer->phone }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            Email:
                        </div>
                        <div class="col-md-6">
                            {{ $buyer->email }}
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            Address:
                        </div>
                        <div class="col-md-6">
                            {{ $sold->address }}
                        </div>
                    </div>
                @endforeach
            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                    <i data-feather="x-circle"></i>
                    Close
                </button>
            </div>

        </div>
    </div>
</div>
