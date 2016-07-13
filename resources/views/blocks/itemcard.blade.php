<div class="iccon col-lg-4 col-sm-6">
  <div class="itemcard card clearfix">
    <img class="pthumb" src="data:image/jpeg;base64,{{base64_encode($product->image)}}">
    <span class="pname">{{$product->name}}</span>
    <p class="textclip">{{$product->description}}</p>
    <form class="buy-form" action="{{ url('cart') }}" method="POST">
      @foreach ($product->variants->all() as $variant)
      {{ csrf_field() }}
      <button type="submit" class="btn btn-primary" name="id" value="{{$variant->id}}">{{substr("$variant->sku", -1)}}&nbsp
        <i class="fa fa-inr">&nbsp</i>{{$variant->price+0}}
      </button>
      @endforeach
    </form>
  </div>
</div>