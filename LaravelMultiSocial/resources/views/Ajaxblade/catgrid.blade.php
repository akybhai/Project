
<div class="module" onclick="catClick(this)">ALL PRODUCTS</div>
@foreach($cat as $ca)

<div class="module" onclick="catClick(this)">{{$ca->c}}</div>

@endforeach
