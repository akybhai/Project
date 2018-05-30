{{-- Add Product Modal --}}
<!-- Modal -->
  <div class="modal fade" id="addproductmodal" tabindex="-1" role="dialog" aria-labelledby="addproductmodaltitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="addproductmodaltitle">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
    <form method="POST" action="{{ url('products')}}"  enctype="multipart/form-data" >
      <!-- Name of the product-->
      {{ csrf_field() }}
      <div class="form-group" id="addProductForm">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="productName" placeholder="Product name here" name="productName" required>
      </div>

      <!-- Description of the product-->
      <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" rows="3" id="productDescription" name="productDescription" placeholder="Enter product description" required></textarea>
      </div>

      <!-- Category DropDown -->
      <div class="form-group">
        <label for="category">Category:</label>
        <select class="form-control" id="productCategory" name="productCategory">
          @foreach($cat as $ct)
          <option>{{ $ct->category }}</option>
          @endforeach
        </select>
      </div>

      <!-- Product ID -->
      <div class="form-group">
        <label for="productid">Product ID:</label>
        <input type="number" class="form-control" id="productID" placeholder="Enter product id" name="productID" required>
      </div>
      <div class="form-group">
        <label for="img">Upload Images:</label>
        <input class="form-control" type="file" name="cover_image" id="imgFile">
      </div>
      <div class="form-group">
        <label for="img">Upload Help Document:</label>
        <input class="form-control" type="file" name="help_doc" id="pdfFile">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-default" id="newProductBtn"><b>Add</b></button>
      </div>
    </form>

    </div>
    </div>
    </div>
</div>
  <!-- Modal ending here -->
