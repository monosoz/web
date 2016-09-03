<form action="{{ url('cart/') }}" method="POST" class="pull-right">
    {{ csrf_field() }}
  <div class="input-group">
    <span class="input-group-btn" style="width: auto;">
          <button type="submit" name="id" value="{{\App\Product::find(102)->variants->first()->id}}" class="btn btn-success">
              <strong><i class="fa fa-inr"></i>{{\App\Product::find(102)->variants->first()->price+0}}</strong>
          </button>
    </span>
    <span class="input-group-btn" style="width: auto;">
          <button type="submit" name="id" value="{{\App\Product::find(102)->variants->first()->id}}" class="btn btn-danger">
              <strong>Add Ketchup</strong>
          </button>
    </span>
  </div>
</form>