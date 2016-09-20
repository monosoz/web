<div class="iccon col-md-2 col-sm-3 col-xs-6">
  <div class="cdcard card clearfix">
    <img class="cbthumb" src="img/items/{{$product->name}}.png">
    <span class="pname">{{$product->name}}</span>
    <div class="buy-form">
      <button type="submit" class="btn btn-success" name="id" value="{{$product->id}}">
        <i class="fa fa-inr"></i><span class="prod-price">{{$product->price+0}} - MRP</span>
      </button>
    </div>
  </div>
</div>