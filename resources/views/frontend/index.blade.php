@extends('layout', ['meta_description' => 'Description of the Index Page'])

@section('content')
<div class="container homepage">
    <div class="row">
    	<div class="col-md-8 col-md-offset-1">
            <div id="droppable" class="" data-placeholder="Drag ingredients to this container">
                @foreach ($cartItems as $cartLine)
                    <img src="{{ $cartLine->product->getUrl() }}" alt="Image of {{ $cartLine->product->name }}" height="75" data-id="{{ $cartLine->product->getId() }}">
                @endforeach
            </div>
            <ul class="ingredients">
                @foreach($ingredients as $ingredient)
                    <li class="ingredient-wrapper" data-id="{{ $ingredient->id }}">
                        <img src="{{ $ingredient->getUrl() }}" alt="Image of {{ $ingredient->name }}" height="100">
                    </li>
                @endforeach
            </ul>
            <div id="ingredients-alert" class="alert alert-danger">
            </div>
    	</div>
        <div class="col-md-3">
            <section id="cart-content">
            </section>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script>

(function($,sr){

  // debouncing function from John Hann
  // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
  var debounce = function (func, threshold, execAsap) {
      var timeout;

      return function debounced () {
          var obj = this, args = arguments;
          function delayed () {
              if (!execAsap)
                  func.apply(obj, args);
              timeout = null;
          };

          if (timeout)
              clearTimeout(timeout);
          else if (execAsap)
              func.apply(obj, args);

          timeout = setTimeout(delayed, threshold || 100);
      };
  }
  // smartresize 
  jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };

})(jQuery,'smartresize');


var resizeContainerImages = function() {
	var container = $('.ingredients'),
		containerWidth = Math.floor(container.width()),
		total = 0,
		row = 1;	

	if (container.data('initial-li-width')) {
		container.find('li.marked').width(container.data('initial-li-width'));
	} else {
		container.data('initial-li-width', container.find('li').first().width());
	}
	container
		.find('li')
		.removeClass('marked')
		.each(function() {
			var $this = $(this);

			if (container)

			total += $this.width();		
			if (total > containerWidth) {			
				var prevRowSiblings = $this.prevAll().filter(function(index) {
					return !$(this).hasClass("marked");
				});
				prevRowSiblings.addClass("marked").data("row", row);
			
				prevRowSiblings.width(Math.floor(containerWidth / prevRowSiblings.length));

				total = $this.width();
				row++;
			}
		});
};

resizeContainerImages();

$(window).smartresize(resizeContainerImages);

var $droppable = $('#droppable');
var $ingredients = $(".ingredients");

$ingredients
	.find('li')
	.draggable({
		snap: "#droppable",
		snapMode: "outer",		
		revert: "invalid",
		scope: 1
	});



$droppable.find('img').each(function() {
	var $this = $(this);

	$ingredients.find('li').each(function() {
		var $thisLi = $(this);

		if ($this.data('id') == $thisLi.data('id')) {
			$thisLi.css("visibility", "hidden");
		}
	});
});



var getAllItems = function() {
    return $.ajax({
        url: '{{ route('cart.allItems') }}',
        dataType: 'html'
    });
};

var getAllItemsCallback = function(data) {
    $('#cart-content').html(data);
    if ($('#cart-content').find('.panel').data('empty') == 1) {
        $('#droppable').html('<p>Drag ingredients to this container. After that, click the dragged item to remove it from selected items.</p>');
    } else {
        $('#droppable').find('p').remove();
    }
};

getAllItems().
        done(getAllItemsCallback);

$droppable.on('click', 'img', function(event) {
    var $this = $(this);
    var url = '{{ route('cart.removeItem', ":productId") }}';

    url = url.replace(":productId", $this.data('id'));

    var removeItem = function(url) {
        return $.ajax({
            url: url,
            method: "post",
            dataType: "json"
        });
    };

    $.when(removeItem(url)).done(function(data) {
        $this.remove();
        $ingredients.find('li[data-id="' + $this.data('id') + '"]').css('visibility', 'visible').animate({
            top: 0,
            left: 0
        }, 500);

        getAllItems()
                .done(getAllItemsCallback);

    });

});



$droppable.droppable({	
	tolerance: "touch",
	accept: ".ingredient-wrapper",
	drop: function(event, ui) {		
		var $img = $("<img>", {
			"src": ui.draggable.find('img').attr('src'),
			"height": 75,
			"width": "auto",
			"data-id": ui.draggable.data('id')
		});

		var url = '{{ route("cart.addItem", ":productId") }}';

		url = url.replace(":productId", ui.draggable.data('id'));

        var addItem = function(url) {
            return $.ajax({
                url: url,
                method: "post",
                dataType: "json"
            });
        };

		$.when(addItem(url)).done(function(data) {
            $img.appendTo($('#droppable'));
            ui.draggable.css("visibility", "hidden");
            $('#ingredients-alert').html('');

            getAllItems()
                    .done(getAllItemsCallback);
        })
		.fail(function(jqXHR, textStatus, errorThrown) {

    		ui.draggable.animate({
    			top: 0,
    			left: 0
    		}, 500);

    		$('#ingredients-alert').text(jqXHR.responseJSON.message);
    	});
	},
	scope: 1
});

</script>
@stop