@extends('staffadmin.layouts.app')

@section('admincontent')
  <div class="app-title">
    <div>
      <h1><i class="fa fa-pencil-square-o"></i> Categories</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="{{ route('home')}}">Dashboard</a></li>
    </ul>
  </div>
  <!-- status Message from Server -->
  @include('staffadmin.partials.message')

  <!--  Add category Button -->
  <div class="row justify-content-center">
    <form  action="{{ route('adminstaff.newcategories') }}" method="POST">
      {{ csrf_field() }}
      <!--  Input Box-->
      <input type="text" placeholder="Enter New Category" name="category" placeholder="enter new Category">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <button class="btn btn-primary btn-lg" type="submit"><i class="fa fa-plus-circle"></i>Add new Category</button>
    </form>
  </div>

  <!--  List of Categories -->
  @if($cat->count() == 0)
    <h1>No Categories currently entered in the system</h1>
  @else
    <div class="row justify-content-center">
      <div class="col-6 table-responsive" >
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Category Name</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($cat as $ct)
              <tr>
                <td>{{$ct->category}}</td>
                <td><button class="btn btn-primary" data-toggle="modal" data-target="#myRenameModal" id="renameButton" value="{{$ct->id}}" onclick="renameCatFunction({{$ct->id}}, this)"><i class="fa fa-pencil-square-o"></i>Rename</button></td>
                <td>
                  <!-- value="{{$ct->id}}" -->
                  <button class="btn btn-danger" data-toggle="modal" data-target="#myDeleteModal" id="deleteButton"  onclick="passValueToDeleteModal({{$ct->id}}, '{{$ct->category}}')"><i class="fa fa-trash-o"></i>Delete</button>
                </td>

              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  @endif


<!-- Delete Modal -->
<div class="modal fade" id="myDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myDelModalLabel">Modal title</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

      </div>
      <div class="modal-body">
        Are you sure you want to delete ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <form id="deleteForm" method="POST" action="">
          <input type="hidden" name="_method" value="DELETE">
          {{ csrf_field() }}
          <button class="btn btn-danger" type="submit" value="Delete">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Delete Modal -->
<!-- Rename Modal -->
<div class="modal fade" id="myRenameModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Rename</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

      </div>
      <div class="modal-body">
        <!-- TextBox to get the name of the catgeory-->
        <form id="renameForm" method="POST" action="">
        <input type="text" name="renameCatInput" value="" id="renameCatInput" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

          <input type="hidden" name="_method" value="PUT">
          {{ csrf_field() }}
          <button class="btn btn-success" type="submit">update</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Rename Modal -->
@endsection

@script
<script type="text/javascript">
// function pass value to delete modal.
function passValueToDeleteModal(catId, catName)
{
  // set the URL for Delete Button
  var formAction = "{{ url('admin/categories/delete')}}" + "/" + catId;
  $('#deleteForm').attr('action',formAction);
  // Change the title
  $('#myDelModalLabel').text(catName);
}

// Function to rename the categories
function renameCatFunction(i, $this)
{
  var catId = i;
  var catName =  $($this).closest('td').prev('td').text();
  $('#renameCatInput').val(catName);
  // enter the value in the input
  //Do input validation
  //update the route
  var formAction = "{{ url('admin/categories/update')}}" + "/" + catId;
  $('#renameForm').attr('action',formAction);
}
</script>
@endscript
