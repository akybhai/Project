@extends('layouts.app')

@section('content')
  <h1>Hello</h1>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <img src="/storage/cover_images/{{$productImage->cover_image}}" alt="" style="width:100%;">
      </div>
      <div class="col-md-8">
        <h1>{{ $product->name }}</h1>
        <h3>{{ $product->description }}</h3>
        <a href="" class="btn btn-lg btn-success">Book it</a>
      </div>
    </div>

  </div>
@endsection
