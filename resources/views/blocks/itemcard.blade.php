<div class="iccon col-md-4 col-sm-6">
  <div class="itemcard card clearfix">
    <img class="pthumb" src="data:image/jpeg;base64,{{base64_encode($product->image)}}">
    <span class="pname">{{$product->name}}</span>
    <p class="textclip">{{$product->description}}</p>
    <div class="buy-form">
      @foreach ($product->variants->all() as $variant)
      @if(substr("$variant->sku", -1)==='L')
      <button type="submit" class="btn btn-primary" disabled>
        <i class="fa fa-inr"></i><span class="prod-price">{{$variant->price+0}}</span>
      </button>
      @else
      <button type="submit" class="btn btn-primary" name="id" value="{{$variant->id}}">
        <i class="fa fa-inr"></i><span class="prod-price">{{$variant->price+0}}</span>
      </button>
      @endif
      @endforeach
    </div>

      <button type="button" class="btn" data-toggle="modal" data-target="#vModal">
      <div class="button" onclick="customize({{'"'.$product->id.'", "'.$product->name.'"'}})"></div>
        <i class="fa fa-pencil"></i>
      </button>
  </div>
</div>