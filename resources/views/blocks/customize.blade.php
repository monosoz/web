<link href="{{ url('st02.css') }}" rel="stylesheet">
<div class="modal fade" id="vModal" tabindex="-1" role="dialog" aria-labelledby="customize" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="custom-title">Customize</h4>
            </div>
            <div class="vModal-body modal-body">
<div class="row">
<div class="col-sm-8 col-xs-8">
    <div class="tp-selector tp-main">
    <p>Veg Topping: </p>
      @foreach ($tags->find(1)->addons as $addon)
      <div class="col-sm-6 tp-card-c">
        <input id="vt{{$addon->id}}" type="checkbox" name="top_id[]" value="{{$addon->id}}"/>
        <label class="tp-card tp-card-vt" for="vt{{$addon->id}}">
        <img class="tpthumb" src="data:image/jpeg;base64,{{base64_encode($addon->image)}}">
        <span class="tpname">{{$addon->name}}</span></label>
    </div>
      @endforeach
    </div>
    <div class="tp-selector tp-main">
    <p>Non-Veg Topping: </p>
      @foreach ($tags->find(2)->addons as $addon)
      <div class="col-sm-6 tp-card-c">
        <input id="vt{{$addon->id}}" type="checkbox" name="top_id[]" value="{{$addon->id}}"/>
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
        <input id="sz" type="radio" name="sz" value="r">
        <label class="tp-card base-size" for="sz">Regular : 10"</label><br>
        <input checked="checked" id="sz" type="radio" name="sz" value="m">
        <label class="tp-card base-size" for="sz">Medium : 12"</label><br>
        <input id="sz" type="radio" name="sz" value=""  disabled>
        <label class="base-size" for="sz" style="cursor:not-allowed;"> Large : 14"</label>
    </div>
    </div>
</div>
</div>
            </div>
<div class="modal-footer">
    <div class="tp-selector col-sm-6">
        <input id="aec" type="checkbox" name="top_id[]" value="1" />
        <label class="tp-card add-cheese" for="aec">
        <img class="tpthumb" src="">
        Add Extra Cheese</label><br/>
    </div>
    <div class="col-sm-6">
        <span>Total:&nbsp</span><i class="fa fa-inr"></i><span class="tp-total">0</span>
        <input type="reset" value="Reset" class="btn">
        <input type="submit" value="Submit" class="btn">
    </div>
</div>
        </div>
    </div>
</div>


