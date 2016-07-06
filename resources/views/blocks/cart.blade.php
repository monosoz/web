<table class="table table-hover">
    @foreach ($cart->items as $item)
    <tr>
        <td><span>{{ $item->displayName }}</span></td>
        <td><i class="fa fa-inr"></i><span> {{ $item->price + 0 }}</span></td>
        <td>
           <form action="{{ url('cart/'.$item->sku) }}" method="POST">
                {{ csrf_field() }}
                <button type="submit" name="action" value="add" class="btn-link">
                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                </button>
                <span>{{ $item->quantity }}</span>
                <button type="submit" name="action" value="rm" class="btn-link">
                    <i class="fa fa-minus-square" aria-hidden="true"></i>
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
