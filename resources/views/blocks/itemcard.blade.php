<div class="iccon col-md-4 col-sm-6">
  <div class="itemcard card clearfix">
    <img class="pthumb" src="data:image/jpeg;base64,{{base64_encode($product->image)}}">
    <span class="pname">{{$product->name}}</span>
    <p class="textclip">{{$product->description}}</p>
    <div class="buy-form">
      @foreach ($product->variants->all() as $variant)
      @if(substr("$variant->sku", -1)==='L')
      <button type="submit" class="btn btn-success" name="id" value="{{$variant->id}}" data-toggle="tooltip" title='Large 14"'>
        <i class="fa fa-inr"></i><span class="prod-price">{{$variant->price+0}}</span>
      </button>
      @elseif(substr("$variant->sku", -1)==='M')
      <button type="submit" class="btn btn-success" name="id" value="{{$variant->id}}" data-toggle="tooltip" title='Medium 12"'>
        <i class="fa fa-inr"></i><span class="prod-price">{{$variant->price+0}}</span>
      </button>
      @else
      <button type="submit" class="btn btn-success" name="id" value="{{$variant->id}}" data-toggle="tooltip" title='Regular 10"'>
        <i class="fa fa-inr"></i><span class="prod-price">{{$variant->price+0}}</span>
      </button>
      @endif
      @endforeach
    </div>

      <button type="button" class="cust-btn btn" data-toggle="modal" data-target="#vModal">
      <div class="button clickable" onclick="customize({{'"'.$product->id.'", "'.$product->name.'"'}})"></div>
        <i class="fa fa-pencil"></i>
      </button>
  </div>
</div>