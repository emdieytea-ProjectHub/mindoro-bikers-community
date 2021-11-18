
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header alert-fill-danger">

        <h5 class="modal-title" id="exampleModalLabel">
          DELETE
        </h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <form method="POST" action="delete.php">
      <div class="modal-body">
       
     <div class="form-group">
       <label>Group Name</label>
       <input type="text" name="groupName" class="form-control">
     </div>
        
      </div>
      <div class="modal-footer">
        <div class="btn-group">
          <button type="submit" class="btn btn-danger btn-small" name="btn_editcategory">
          <i class="fa fa-check-circle"></i> Yes
        </button>
        <button type="button" class="btn btn-success btn-small" data-dismiss="modal">
          <i class="fa fa-times-circle"></i> No
        </button>
        
        </div>
      </div>
      </form>
    </div>
  </div>
</div>