<!--  Template consist of products in table format-->
@if($products->count() != 0)
<table class="table table-striped">
<!--  table header start-->
  <thead>
    <tr>
      <th>Product Id</th>
      <th>Name</th>
      <th></th>
    </tr>
  </thead>
<!--  table header ends-->
  <tbody>
<!--  table body start -->
    @foreach ($products as $prod)
    <tr>
      <!--  Clickable Product ID -->
      <td>
        <!-- <a href="#" data-toggle="modal" data-target="#product_view" class="pull-left singleProductView" onclick="singleProductViewFunc({{$prod->id}})"> -->
          {{ $prod->productID }}
        <!-- </a> -->
      </td>
      <!--  Clickable Product Name -->
      <td>
        <!-- <a href="#" data-toggle="modal" data-target="#product_view" class="singleProductView" onclick="singleProductViewFunc({{$prod->id}})"> -->
          {{ $prod->name }}
        <!-- </a> -->
      </td>
      <!-- Clickable View Edit Delete Button -->
      <td>
        <!-- View Button -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#product_view" class="singleProductView" onclick="singleProductViewFunc({{$prod->id}})"  ><i class="fa fa-pencil-square-o"></i>
          View
        </button>
        <!-- Edit Button -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#productrenamemodal" id="editProduct" onclick="editProductFunc({{$prod->id}})" ><i class="fa fa-pencil-square-o"></i>
          Edit
        </button>
        <!-- Delete button -->
        <button class="btn btn-danger" data-toggle="modal" data-target="#myDelProdModal" id="deleteProdButton"  onclick="passValueToDelProdModal({{$prod->id}}, '{{ $prod->name }}')"><i class="fa fa-trash-o"></i>Delete</button>
      </td>
    </tr>
    @endforeach
<!--  table body ends -->
  </tbody>
</table>
<!-- Delete Modal -->
<div class="modal fade" id="myDelProdModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myDelProdLabel">Modal title</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

      </div>
      <div class="modal-body">
        Are you sure you want to delete ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <form id="deleteProdForm" method="POST" action="">
          <input type="hidden" name="_method" value="DELETE">
          {{ csrf_field() }}
          <button class="btn btn-danger" type="submit" value="Delete">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Delete Modal -->
@else
  <h2> No Products for this particular category</h2>
@endif
