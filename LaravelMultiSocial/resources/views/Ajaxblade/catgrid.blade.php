
<div class="module" onclick="catClick(this)">All Products</div>
@foreach($cat as $ca)

<div class="module" onclick="catClick(this)">{{$ca->c}}</div>

@endforeach

