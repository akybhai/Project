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
        <a href="#" data-toggle="modal" data-target="#product_view" class="pull-left singleProductView" onclick="singleProductViewFunc({{$prod->id}})">
          {{ $prod->productID }}
        </a>
      </td>
      <!--  Clickable Product Name -->
      <td>
        <a href="#" data-toggle="modal" data-target="#product_view" class="singleProductView" onclick="singleProductViewFunc({{$prod->id}})">
          {{ $prod->name }}
        </a>
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
        <form method="POST" action="{{ url('products/'.$prod->id)}}" style="display:inline;">
          <input type="hidden" name="_method" value="DELETE">
          {{ csrf_field() }}
          <button class="btn btn-danger" type="submit" value="Delete"><i class="fa fa-trash-o"></i>Delete</button>
        </form>
      </td>
    </tr>
    @endforeach
<!--  table body ends -->
  </tbody>
</table>
@else
  <h2> No Products for this particular category</h2>
@endif
