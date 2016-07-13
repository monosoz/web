 <div>
  @if (count($products) === 0)
    <p>Comming soon. </p>
  @else
  <div class="clearfix">
    <div class="tag">{{ $tags->find(1)->name }}</div>
    @foreach ($tags->find(1)->products as $product)
    @include('blocks.itemcard')
    @endforeach
  </div>
  <div class="clearfix">
    <div class="tag">{{ $tags->find(2)->name }}</div>
    @foreach ($tags->find(2)->products as $product)
    @include('blocks.itemcard')
    @endforeach
  </div>
  @endif
</div>