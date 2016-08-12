 <div>
  <form class="" action="{{ url('cart') }}" method="POST">
    {{ csrf_field() }}
  <div class="row tag-c">
    <div class="tag" type="button" class="tag-btn" data-toggle="collapse" data-target="#tag1-collapse">> {{ $tags->find(1)->name }}</div>
    <div class="collapse in" id="tag1-collapse">
      @foreach ($tags->find(1)->products as $product)
      @include('blocks.itemcard')
      @endforeach
    </div>
  </div>
  <div class="row tag-c">
    <div class="tag" type="button" class="tag-btn" data-toggle="collapse" data-target="#tag2-collapse">> {{ $tags->find(2)->name }}</div>
    <div class="collapse in" id="tag2-collapse">
      @foreach ($tags->find(2)->products as $product)
      @include('blocks.itemcard')
      @endforeach
    </div>
  </div>
  </form>
  <form action="{{ url('add_custom') }}" method="POST">>
    {{ csrf_field() }}
  <div>
    @include('blocks.customize')
  </div>
  </form>
</div>