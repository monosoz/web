@if (count($tags) === 0)
  <p>Comming Soon.</p>
@else
<div class="tag clickable" type="button" class="tag-btn" data-toggle="collapse" data-target="#tag1-collapse">> Make your own pizza!</div>
<div class="row tag-c">
  <div class="collapse in" id="tag1-collapse">
    <div class="iccon col-md-4 col-sm-6">
      <div class="itemcard card clearfix">
        <img class="pthumb" src="{{ url('img/custompizza.png') }}">
        <span class="pname">Custom Pizza</span>
        <p class="textclip">Be Your Own Chef...<br>Make Your Own Pizza!</p>
        <div class="buy-form">
          <button type="submit" class="btn btn-success" disabled>
            <i class="fa fa-inr"></i><span class="prod-price">***</span>
          </button>
        </div>
        <button type="button" class="cust-btn btn" data-toggle="modal" data-target="#vModal">
      <div class="button clickable" onclick="customize('0', 'Make your own...')"></div>
          <i class="fa fa-pencil"></i>
        </button>
      </div>
    </div>
  </div>
</div>
<div class="tag clickable" type="button" class="tag-btn" data-toggle="collapse" data-target="#tag2-collapse">> {{ $tags->find(1)->name }}</div>
<form class="" action="{{ url('cart') }}" method="POST">
  {{ csrf_field() }}
  <div class="row tag-c">
    <div class="collapse in" id="tag2-collapse">
      @foreach ($tags->find(1)->products as $product)
      @include('blocks.itemcard')
      @endforeach
      <div class="iccon col-md-4 col-sm-6">
      <div class="itemcard card clearfix">
        <img class="pthumb" src="{{ url('img/custompizza.png') }}">
        <span class="pname">More Coming Soon...</span>
        <div class="buy-form">
          <button type="submit" class="btn btn-success" disabled>
            <i class="fa fa-inr"></i><span class="prod-price">***</span>
          </button>
        </div>
      </div>
    </div>
    </div>
  </div>
<div class="tag clickable" type="button" class="tag-btn" data-toggle="collapse" data-target="#tagt-collapse">> Non-Veg</div>
<div class="row tag-c">
  <div class="collapse in" id="tagt-collapse">
    <div class="iccon col-md-4 col-sm-6">
      <div class="itemcard card clearfix">
        <img class="pthumb" src="img/IMG_5221s.png">
        <span class="pname">Coming Soon...</span>
        <div class="buy-form">
          <button type="submit" class="btn btn-success" disabled>
            <i class="fa fa-inr"></i><span class="prod-price">***</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
  <!--div class="tag clickable" type="button" class="tag-btn" data-toggle="collapse" data-target="#tag3-collapse">> {{ $tags->find(2)->name }}</div>
  <div class="row tag-c">
    <div class="collapse in" id="tag3-collapse">
      @foreach ($tags->find(2)->products as $product)
      @include('blocks.itemcard')
      @endforeach
    </div>
  </div-->

  <div class="tag clickable" type="button" class="tag-btn" data-toggle="collapse" data-target="#tagt-collapse">> {{ $tags->find(51)->name }}</div>
<div class="row tag-c">
  <div class="collapse in" id="tagt-collapse">
      @foreach ($tags->find(51)->products()->find(101)->variants as $product)
      @include('blocks.colddrinkcard')
      @endforeach
  </div>
</div>
</form>
<form action="{{ url('add_custom') }}" method="POST">
  {{ csrf_field() }}
  <div>
    @include('blocks.customize')
  </div>
</form>
@endif