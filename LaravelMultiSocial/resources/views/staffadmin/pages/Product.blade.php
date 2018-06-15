@extends('staffadmin.layouts.app')
@include('staffadmin.modals.editProduct')
@include('staffadmin.modals.addProduct')
@include('staffadmin.modals.singleProductView')
@section('meta')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
<style>
ul.ui-autocomplete.ui-menu {
  z-index: 1000 !important;
}
#singleProductViewImg {
    display: block;
    margin: 0 auto;
}
</style>

@endsection


@section('admincontent')
          <div class="app-title">
            <div>
              <h1><i class="fa fa-plus-circle"></i> Products</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
              <li class="breadcrumb-item"><a href="{{ route('home')}}">Dashboard</a></li>
            </ul>
          </div>
          @if($cat->count() != 0)
          <div class="row justify-content-center">
            <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addproductmodal"><i class="fa fa-plus-circle"></i>Add new Product</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a class="btn btn-primary btn-lg" href="{{ route('adminstaff.downloaduserlist') }}"><i class="fa fa-download"></i>Export Inventory</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <!-- <button class="btn btn-primary btn-lg"><i class="fa fa-download"></i>Export Inventory</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
          </div>


          <br>
          <!-- status Message from Server -->
          @include('staffadmin.partials.message')
          <div class="row justify-content-center">

            <div class="col-md-3" align="middle">
                <div class="tile-title-w-btn">
                  <h3 class="title">Select Category</h3>
                </div>
                <div class="bs-component">
                  <div class="list-group" id="highlight1">
                    {{--  Loop through the categories--}}
                    @foreach ($cat as $ct)
                        <a class="list-group-item list-group-item-action @if($ct->category == $firstCat ) active @endif" id="_{{ $ct->id }}" onclick="getproduct('_{{ $ct->id }}')" href="#" >{{ $ct->category }}</a>
                    @endforeach
                  </div>

                </div>
            </div>

            <div class="col-9 table-responsive" id="productResult" >
              @include('staffadmin.ajax.productTable')
            </div>
          @else
            <h2>No Categories currently in the system</h2>
            <h4>Enter New Categories</h4>
            <a class="btn btn-primary btn-lg" href="{{ route('adminstaff.newcategories') }}"><i class="fa fa-plus-circle"></i>Add New Category</a>&nbsp;
          @endif
          </div>



{{--  Display single product view MODAL--}}
<!-- Style -->



@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">

//global variable yo store selected category

//function to append the selected tag
function selectedCategory(selectCat)
{
  //loop through each category
  $("#product_category option").each(function()
  {
    //check the current category is selected
    if(selectCat === $(this).val())
    {
      $(this).prop('selected', true);
    }
  });

}





//function to pass the product related details to Edit Modal
function editProductFunc(id)
{
  var route = "{{ url('products/')}}" + "/"+ id;
  var imgRoute = "/storage/cover_images/";
  $('#editProductForm').attr('action',route);
  $.ajax({
  type : 'get',
  url : '{{route('adminstaff.products.edit')}}',
  data:{'productID':id},
  dataType:'json',
  success:function(data){
    console.log(data);
    //set the values of the edit form
    $('#productName').val(data[0].name);
    $('#productDescription').val(data[0].description);
    $('#productid').empty().html(data[0].productID);
    $('#prodImage').attr('src',imgRoute + data[2]);;
    selectedCategory(data[1]);
  }
});
}


//function to view the single product view
function singleProductViewFunc(id)
{
  // ajax get call to single product
  var imgRoute = "/storage/cover_images/";
  $.ajax({
  type : 'get',
  url : '{{route('adminstaff.products')}}',
  data:{'productID':id},
  dataType:'json',
  success:function(data){
    console.log(data);
    $('#singleProductId').empty().html(data[0].productID);
    $('#singleProductName').empty().html(data[0].name);
    $('#singleProductDescription').empty().html(data[0].description);

    // handle the Media Files
    // data[1].forEach(function(elmen){
    //
    //   console.log(elmen.cover_image)
    //   var imgFormat = (elmen.cover_image).split(".")[1];
    //   if(imgFormat == "jpg" || imgFormat == "jpeg" || imgFormat == "png")
    //   {
    //     var imageName =
    //   }
    //
    // });

    $('#singleProductViewImg').attr('src',imgRoute + data[1].cover_image);


    // console.log();
  }
  });

}



// function to get the product
function getproduct(idval)
{
  // handle the front end highlighting
  var x= document.getElementById("highlight1");
  Array.prototype.forEach.call(x.children, i => {
      i.classList.remove("active");});
      var x= document.getElementById(idval);
      x.classList.add("active");
  // string handling
  var categorgyId = idval.split("_")[1];
  console.log(categorgyId);

  //ajax query to get product

  $.ajax({
  type : 'get',
  url : '{{route('adminstaff.products')}}',
  data:{'categoryId':categorgyId},
  success:function(data){

  $('#productResult').empty().html(data);
  }
  });




};

// Script to get the products for a particular category
$('#searchBtn').click(function(){
  // get the value of the input field
  $value=$('#searchbox').val();
  //check the input field then only fire ajax call
  if($value)
  {
    $.ajax({
    type : 'get',
    url : '{{route('localadmin.userlist')}}',
    data:{'search':$value},
    success:function(data){
    $('#userlistdata').empty().html(data);
    }
    });
  }
  else
  {
    // send an alert to input a value
    alert('enter the search parameter');
  }


});

// Function to add confirmation to delete product page

function passValueToDelProdModal(prodId, prodName)
{
  // set the URL for Delete Button
  var formAction = "{{ url('products/')}}" + "/" + prodId;
  $('#deleteProdForm').attr('action',formAction);
  // Change the title
  $('#myDelProdLabel').text(prodName);
}





// Function to add & Remove active from class
function hone(idval)
{
  var x= document.getElementById("highlight1");
  Array.prototype.forEach.call(x.children, i => {
      i.classList.remove("active");});
      var x= document.getElementById(idval);
      x.classList.add("active");
};



</script>
<script type="text/javascript">
$( function() {
  var availableTags = [
    "ActionScript",
    "AppleScript",
    "Asp",
    "BASIC",
    "C",
    "C++",
    "Clojure",
    "COBOL",
    "ColdFusion",
    "Erlang",
    "Fortran",
    "Groovy",
    "Haskell",
    "Java",
    "JavaScript",
    "Lisp",
    "Perl",
    "PHP",
    "Python",
    "Ruby",
    "Scala",
    "Scheme"
  ];
  $( "#productName" ).autocomplete({
    source: availableTags,
  });
  // $( "#productName" ).autocomplete( "option", "appendTo", "#addProductForm" );

} );
</script>
@endsection
