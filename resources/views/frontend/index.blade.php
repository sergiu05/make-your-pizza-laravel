@extends('layout', ['meta_description' => 'Description of the Index Page'])

@section('content')
<div class="container homepage">
    <div class="row">
    	<div class="col-md-8 col-md-offset-2">
    	<div id="droppable" class="">
    	</div>
    	<ul class="ingredients">
    	@foreach($ingredients as $ingredient)<li class="ingredient-wrapper" data-id="{{ $ingredient->id }}"><img src="{{ $ingredient->getUrl() }}" alt="Image of {{ $ingredient->name }}" height="100"></li>@endforeach      
    	</ul>
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

$(".ingredients")
	.find('li')
	.draggable({
		snap: "#droppable",
		snapMode: "outer",		
		revert: "invalid",
		scope: 1
	});

$("#droppable").droppable({	
	tolerance: "touch",
	accept: ".ingredient-wrapper",
	drop: function(event, ui) {		
		var $img = $("<img>", {
			src: ui.draggable.find('img').attr('src'),
			height: 75,
			width: "auto"
		});
		$img.appendTo($('#droppable'));
		ui.draggable.css("visibility", "hidden");
	},
	scope: 1
});

</script>
@stop