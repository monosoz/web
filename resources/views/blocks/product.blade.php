 <div>
  @if (count($products) === 0)
    <p>No content on this blog yet. </p>
  @else
    @foreach ($products as $product)
    <div class="col-md-4 col-sm-6 iccon">
      <div class="itemcard clearfix">
        <img class="pthumb" src="data:image/jpeg;base64,{{base64_encode($product->image)}}">
        <h3>{{$product->name}}</h3>
        <p>{{$product->description}}</p>
        <form action="{{ url('cart') }}" method="POST">
        @foreach ($product->variants->all() as $variant)
          {{ csrf_field() }}
          <button type="submit" class="btn btn-primary" name="id" value="{{$variant->id}}">{{substr("$variant->sku", -1)}}&nbsp
            <i class="fa fa-inr">&nbsp</i>{{$variant->price+0}}
          </button>
        @endforeach
        </form>
      </div>
    </div>
    @endforeach
  @endif
</div>