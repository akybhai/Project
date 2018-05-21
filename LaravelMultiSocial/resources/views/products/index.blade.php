<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Product</h2>
  <p>All Products in the inventory</p>
  <a href="{{ url('products/create') }}" class="btn btn-lg btn-primary">Add Product</a>
  <table class="table table-condensed">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Category</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($products as $product)
        <tr>
          <td>{{$product-> productID}}</td>
          <td><a href="{{ url('products/'.$product->id)}}">{{$product-> name}} </a></td>
          <td>{{$product-> description}}</td>
          <td>{{$product->categories->category}}</td>
          <td><a href="{{ url('products/'.$product->id.'/edit')}}" class="btn btn-success">edit</a>
              <!-- Delete button -->
              <form method="POST" action="{{ url('products/'.$product->id)}}" style="float:right;">
                <input type="hidden" name="_method" value="DELETE">
                {{ csrf_field() }}
                <button class="btn btn-danger" type="submit" value="Delete">Delete</button>
              </form>
          </td>

        </tr>
      @endforeach
    </tbody>
  </table>
</div>

</body>
</html>
