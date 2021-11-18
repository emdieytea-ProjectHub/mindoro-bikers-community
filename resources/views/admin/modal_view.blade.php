
  <div class="modal fade" id="view{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header alert-fill-danger">
          <h5 class="modal-title" id="exampleModalLabel">
             View Product
          </h5>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times</span>
          </button>

        </div>
        <div class="modal-body">
            
          <div class="row">
            <div class="col-md-12">
              <img src="{{ asset($product->productImage) }}" style="width: 100%">
            </div>
            
          </div>

          <div class="row mt-4">
            <div class="col-md-6">
              Seller:
            </div>
            <div class="col-md-6">
              {{ $product->user->fname }} {{ $product->user->lname }}
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