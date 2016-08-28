<div class="modal fade" id="wModal" tabindex="-1" role="dialog" aria-labelledby="welcome" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius:40px;font-size:larger;background-color:#f9cd11;padding:5%">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            @if($cart_status==5)
            <div style="text-align: center; padding-top: 10%; padding-bottom: 10%;">
                <h1 style="font-size:50px;color:#980211;">Get Any Medium Pizza (12") @ 129!</h1>
                <h3>use coupon code 'OFF100'</h3>
            </div>
            <span class="pull-right" style="margin-top: -10px;">*Limited Promotion</span>
            @elseif($cart_status==11)
            <div style="text-align: center; padding-top: 10%; padding-bottom: 10%;">
                <h1 style="font-size:50px;color:#980211;">Your order has been placed.</h1>
            </div>
            @elseif(!env('OPEN'))
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


