<div class="panel panel-default" data-empty="{{ count($items) ? 0 : 1 }}">
	<div class="panel-heading">
		<h3 class="panel-title">Pizza ingredients</h3>
	</div>
	<div class="panel-body">

		@foreach($items as $item)
			{{ $loop->iteration  }}. {{ $item-> product->name }}<br>
		@endforeach

		<p>Total: ${{ $total }}</p>
		<p>
			<form action="{{ route('place.order') }}" method="post">
				{{ csrf_field() }}
				<p><button class="btn btn-info" type="submit">Place order</button></p>
			</form>
		</p>
	</div>

</div>
