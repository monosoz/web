<link href="{{ url('st02.css') }}" rel="stylesheet">
<div class="modal fade" id="vModal" tabindex="-1" role="dialog" aria-labelledby="customize" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Customize {{$product->name}}</h4>
            </div>
            <div class="vModal-body modal-body">
<div class="col-sm-8 col-xs-8">
    <div class="tp-selector">
        <input id="aec" type="checkbox" name="top_id" value="1" />
        <label class="tp-card add-cheese" for="aec">
        <img class="tpthumb" src="">
        Add Extra Cheese</label><br/>
    </div>
    <div class="tp-selector">
    <p>Veg Topping: </p>
      @foreach ($tags->find(1)->addons as $addon)
      <div class="col-sm-6 tp-card-c">
        <input id="vt{{$addon->id}}" type="checkbox" name="top_id" value="{{$addon->id}}"/>
        <label class="tp-card tp-card-vt" for="vt{{$addon->id}}">
        <img class="tpthumb" src="data:image/jpeg;base64,{{base64_encode($addon->image)}}">
        <span class="tpname">{{$addon->name}}</span></label>
    </div>
      @endforeach
    </div>
    <div class="tp-selector">
    <p>Non-Veg Topping: </p>
      @foreach ($tags->find(2)->addons as $addon)
      <div class="col-sm-6 tp-card-c">
        <input id="vt{{$addon->id}}" type="checkbox" name="top_id" value="{{$addon->id}}"/>
        <label class="tp-card tp-card-nvt" for="vt{{$addon->id}}">
        <img class="tpthumb" src="data:image/jpeg;base64,{{base64_encode($addon->image)}}">
        <span class="tpname">{{$addon->name}}</span></label>
    </div>
      @endforeach
    </div>
</div>
<div class="col-sm-4 col-xs-4">
    <img class="pmthumb" src="data:image/jpeg;base64,{{base64_encode($product->image)}}">
    <div class="pmsize">
    <p>Size:</p>
    <div class="tp-selector">
        <input id="a1" type="radio" name="a" value="r" />
        <label class="base-size" for="a1">Regular : 10"</label><br/>
        <input checked="checked" id="a2" type="radio" name="a" value="m" />
        <label class="tp-card base-size" for="a2">Medium : 12"</label><br>
        <input id="a3" type="radio" name="a" value="l" />
        <label class="base-size" for="a3"> Large : 14"</label>
    </div>
    </div>
</div>
            </div>
        </div>
    </div>
</div>


