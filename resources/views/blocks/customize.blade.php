<link href="{{ url('st02.css') }}" rel="stylesheet">
<div class="modal fade" id="vModal" tabindex="-1" role="dialog" aria-labelledby="customize" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="tp-content modal-content">
            <div class="modal-header" style="border-bottom: 2px solid #222;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="custom-title">Customize</h4>
            </div>
            <div class="vModal-body modal-body">
<input id="custom-id" type="hidden" name="p_id" value="">
<div class="row">
<div class="col-sm-5">
    <div class="pmsize row">
    <div class="col-xs-6">
        <img class="pmthumb" src="{{ url('img/custompizzal.png') }}">
    </div>
    <div class="tp-selector col-xs-6">
        <p>Size:</p>

    <div class="bo-con">
        <input id="szr" type="radio" name="sz" value="r">
        <label class="tp-card base-size" for="szr">Regular : 10"</label><br>
        <input checked="checked" id="szm" type="radio" name="sz" value="m">
        <label class="tp-card base-size" for="szm">Medium : 12"</label><br>
        <input id="szl" type="radio" name="sz" value="l">
        <label class="tp-card base-size" for="szl"> Large : 14"</label>
    </div>
    </div>
    </div>
</div>
<div class="col-sm-7">
    <div class="tp-selector tp-main clearfix">
    <p>Veg Topping: </p>
      @foreach ($tags->find(1)->addons as $addon)
      <div class="col-xs-6 tp-card-c">
        <input id="vt{{$addon->id}}" type="checkbox" name="top_id[]" value="{{$addon->id}}"/>
        <label class="tp-card tp-card-vt" for="vt{{$addon->id}}">
        <div class="tpthumb"><img src="{{url('img/tp/' . $addon->id . '.png')}}"></div>
        <span class="tpname">{{$addon->name}}</span></label>
    </div>
      @endforeach
    </div>
    <div class="tp-selector tp-main clearfix">
    <p>Non-Veg Topping: </p>
      @foreach ($tags->find(2)->addons as $addon)
      <div class="col-xs-6 tp-card-c">
        <input id="vt{{$addon->id}}" type="checkbox" name="top_id[]" value="{{$addon->id}}" disabled/>
        <label class="tp-card tp-card-nvt" for="vt{{$addon->id}}" style="cursor:not-allowed;">
        <img class="tpthumb" src="">
        <span class="tpname">{{$addon->name}}</span></label>
      </div>
      @endforeach
    </div>
</div>

</div>
            </div>
<div class="modal-footer" style="border-top: 2px solid #222;">
<div class="row">
    <div class="tp-selector col-xs-6">
        <input id="aec" type="checkbox" name="top_id[]" value="1" />
        <label class="tp-card add-cheese" for="aec">
        <img class="tpthumb" src="" style="display:none;">
        <span class="tpname">&nbspAdd Extra Cheese</span></label><br/>
    </div>
    <div class="col-xs-6" style="white-space: nowrap;">
        <!--span>Total:&nbsp</span><i class="fa fa-inr"></i><span class="tp-total">0</span-->
        <input type="reset" value="Reset" class="btn btn-primary">
        <input type="submit" value="Submit" class="btn btn-primary">
    </div>
</div>
</div>
        </div>
    </div>
</div>


