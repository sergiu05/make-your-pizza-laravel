<div class="cart-content">
	<ul>
	@foreach($items as $item)
		<li>{{ $item->product->name }}</li>
	@endforeach
	</ul>
</div>