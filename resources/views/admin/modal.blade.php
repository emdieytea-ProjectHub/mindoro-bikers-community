
  <div class="modal fade" id="view{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header alert-fill-danger">
          <h5 class="modal-title" id="exampleModalLabel">
            <i data-feather="delete"></i>
             View Product
          </h5>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times</span>
          </button>

        </div>

        <form method="POST" action="{{ route('admin.delete') }}">
        @csrf

        <div class="modal-body">
            <input type="hidden" name="id" value="{{ $product->id }}" >
            <div class="alert alert-warning">
                Are you sure you want to delete
            </div>
          
            
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">
            <i data-feather="x-circle"></i>
            Close
          </button>
          <button type="submit" class="btn btn-success">
            <i data-feather="check-circle"></i>
            Continue
        </button>
        </div>

      </form>

      </div>
    </div>
  </div>