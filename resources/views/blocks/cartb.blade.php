<table class="cart-table table table-hover">
    <tbody>
{{--*/ $toff = 0 /*--}}
    @foreach ($cart->items as $item)
@if($item->price<0)
    {{--*/ $toff += $item->price * $item->quantity /*--}}
@elseif(substr($item->class, -5, 5)!='Addon')
    {{--*/ $q = $item->quantity /*--}}
    {{--*/ $ql = $q /*--}}

    <tr>
@for(; $q>-1; $q--)
    @if($item->rel->where('item_no', "$q")->count()!=0)
        <td><span>
            @if(substr($item->class, 0, 4)==='App\\')
            {{ $item->displayName }}
            @elseif(substr($item->sku, 0, 4)==='FREE')
            Free Pizza
            @else
            Custom Pizza
                @if(substr($item->sku, -1)==='R')
                -Regular
                @elseif(substr($item->sku, -1)==='M')
                -Medium
                @elseif(substr($item->sku, -1)==='L')
                -Large
                @endif
            @endif
            @foreach ($item->rel->where('item_no', "$q") as $rel)
            @if($rel->child->id==4 || $rel->child->id==5)({{ $rel->child->name }})
            @endif
            @endforeach
        </span></td>
        <td><i class="fa fa-inr"></i><span> {{ $item->price + 0 }}</span>
            <!--form action="{{ url('cart/'.$item->sku) }}" method="POST">
                {{ csrf_field() }}
                <input id="" type="hidden" name="item_no" value="{{ $q }}">
                <button type="submit" name="action" value="add" class="btn-link">
                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                </button-->
                <span> - 1</span>
                <!--button type="submit" name="action" value="rm" class="btn-link">
                    <i class="fa fa-minus-square" aria-hidden="true"></i>
                </button>
            </form-->
        </td>
    <tr id="cart-addon">
        <td>
        <ul style="list-style: none;">
            @foreach ($item->rel->where('item_no', "$q") as $rel)
            @if($rel->child->price!=0)
            <li>
                <span>{{ $rel->child->name }}</span>
            </li>
            @endif
            @endforeach
        </ul>
        </td>
        <td>
        <ul style="list-style-type: none;">
            @foreach ($item->rel->where('item_no', "$q") as $rel)
            @if($rel->child->price!=0)
            <li>
                <span>{{ $rel->child->price }}</span>
            </li>
            @endif
            @endforeach
        </ul>
        </td>
    </tr>
        {{--*/ $ql-- /*--}}
    @elseif($q==0&$ql>0)
        <td><span>
            @if(substr($item->class, 0, 4)==='App\\')
            {{ $item->displayName }}
            @elseif(substr($item->sku, 0, 4)==='FREE')
            Free Pizza
            @elseif(substr($item->sku, 0, 4)==='PROD')
            Custom Pizza
                @if(substr($item->sku, -1)==='R')
                -Regular
                @elseif(substr($item->sku, -1)==='M')
                -Medium
                @elseif(substr($item->sku, -1)==='L')
                -Large
                @endif
            @endif
        </span></td>
        <td><i class="fa fa-inr"></i><span> {{ $item->price + 0 }}</span>
            <!--form action="{{ url('cart/'.$item->sku) }}" method="POST">
                {{ csrf_field() }}
                <input id="" type="hidden" name="item_no" value="{{ $q }}">
                <button type="submit" name="action" value="add" class="btn-link">
                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                </button-->
                @if($ql>1)
                <span style="padding-left:10px;">x {{$ql}} </span>
                @endif
                <!--button type="submit" name="action" value="rm" class="btn-link">
                    <i class="fa fa-minus-square" aria-hidden="true"></i>
                </button>
            </form-->
        </td>
    @endif
    </tr>
@endfor
@endif
    @endforeach
    </tbody>

    <tfoot>
        <tr>
            <td>Subtotal:</td>
            <td><i class="fa fa-inr"></i><span> {{ $cart->totalPrice - $toff }}</span></td>
        </tr>
        <tr>
            <td>Vat:</td>
            <td><i class="fa fa-inr"></i><span> {{ $cart->totalTax }}</span></td>
        </tr>
        @if($toff != 0)
        <tr>
            <th>Discount:</th>
            <th><i class="fa fa-inr"></i><span> {{ $toff }}</span></th>
        </tr>
        @endif
        <tr>
            <th>Total:</th>
            <th><i class="fa fa-inr"></i><span> {{ number_format($cart->total, 0) }}</span>
            <button class="pull-right btn" type="button" data-toggle="modal" data-target="#paytm">Pay Online</button>
            </th>
        </tr>
    </tfoot>
</table>
