@if ($cart_status!=0)
<div class="modal fade" id="wModal" tabindex="-1" role="dialog" aria-labelledby="welcome" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius:40px;font-size:larger;background-color:#f9cd11;padding:5%">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            @if($cart_status==5)
            <!--div class="offers2" style="
    position: absolute;
    height: 100%;
    width: 100%;
    bottom: 0;
    right: 0;"></div-->
            <div style="text-align: center; padding-top: 10%; padding-bottom: 10%;">
                <h1 style="font-size:40px;font-weight: 900;color:#980211;">Get <i class="fa fa-inr"></i>100 off on any Large Pizza!</h1>
                <h4>use coupon code '<strong style="color:#090;">MONO100</strong>' for Large Pizza</h4>
            </div>
            <span class="pull-right" style="margin-top: -10px;">*Limited Promotion</span>
            @elseif($cart_status==21)
            <div style="text-align: center; padding-top: 10%; padding-bottom: 10%;">
                <h1 style="font-size:40px;font-weight: 900;color:#980211;">Use coupon code '<strong style="color:#090;">OFF50</strong>' and get flat <i class="fa fa-inr"></i>50 off on all purchases!</h1>
            </div>
            <span class="pull-right" style="margin-top: -10px;">*Limited Promotion</span>
            @elseif($cart_status==22)
            <div style="text-align: center; padding-top: 10%; padding-bottom: 10%;">
                <h1 style="font-size:40px;font-weight: 900;color:#980211;">Use coupon code '<strong style="color:#090;">OFF20</strong>' and get flat 20% off on all purchases!</h1>
            </div>
            <span class="pull-right" style="margin-top: -10px;">*Limited Promotion</span>
            @elseif($cart_status==11)
            <div style="text-align: center; padding-top: 10%; padding-bottom: 10%;">
                <h1 style="font-size:50px;color:#980211;">Your order has been placed.</h1>
            </div>
            @elseif($cart_status==12)
            <div style="text-align: center; padding-top: 10%; padding-bottom: 10%;">
                <h1 style="font-size:50px;color:#980211;">Callback Request Sent.</h1>
            </div>
            @elseif(!config('shop.open'))
            <div style="text-align: center; padding-top: 10%; padding-bottom: 10%;">
                <h1 style="font-size:50px;color:#980211;">We are closed right now.</h1>
            </div>
            @else
            <div style="text-align: center; padding-top: 10%; padding-bottom: 10%;">
                <h1 style="font-size:50px;color:#980211;">Wellcome to monosoz!</h1>
            </div>
            @endif
        </div>
    </div>
</div>


@elseif(!config('shop.open'))
<div style="text-align: center; padding-top: 10%; padding-bottom: 10%;">
    <h1 style="font-size:50px;color:#980211;">We are closed right now.</h1>
</div>
@endif
