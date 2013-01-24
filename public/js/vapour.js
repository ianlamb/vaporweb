$(document).ready( function() {
	VapourSystem();
});

var VapourSystem = function() {

	// Variables
	var activeIcon;
	var activeWindow;
	var activeContext = $('.vos-context').first();
	
	// Initialize
	//$('#content').css('width', screen.width + 200);
	//$('#content').css('height', screen.height + 120);
	
	// Misc Bindings
	$('body').bind('mousedown', function(e) {
		if($(e.target).has('.vos-context').length > 0) {
			blurSelection();
		}
	});
	$('#options').bind('click', function() {
		blurSelection();
		$('#options').children('ul').show();
	});
	// TODO: figure out swipe gestures
	$('.vos-context').on('swiperight swiperightup swiperightdown', function(e) {
			shiftContext("left");
		}).on('swipeleft swipeleftup swipeleftdown', function(e) {
			shiftContext("right");
	});
	
	// Key Bindings
	var onKeydown = function(e) {
		console.log( "["+e.keyCode+"] pressed!" );
		
		switch(e.keyCode) {
		case 46: // DELETE
			if(activeIcon != null) {
				deleteIcon(activeIcon);
			}
			break;
		case 37: // LEFT
			shiftContext("left");
			break;
		case 39: // RIGHT
			shiftContext("right");
			break;
		default:
			break;
		}
	}
	window.addEventListener('keydown', function(event) { onKeydown(event); }, false);

	// Window Bindings
	$('.vos-window').draggable();
	$('.vos-window').bind('drag', function() {
		$(this).children('.vos-window-body').html(
			"X: " + $(this).position().left + "<br />Y: " + $(this).position().top
		);
		selectWindow($(this));
	});
	$('.vos-window').bind('mousedown', function() {
		selectWindow($(this));
	});
	$('.vos-window-controls i').bind('click', function() {
		closeWindow($(this).closest('.vos-window'));
	});
	
	// Icon Bindings
	$('.vos-icon').draggable();
	$('.vos-icon').bind('drag', function() {
		selectIcon($(this));
	});
	$('.vos-icon').bind('mousedown', function() {
		selectIcon($(this));
	});

	// Misc Methods
	var blurSelection = function() {
		$('#options').children('ul').hide();
		if(activeIcon != null) {
			activeIcon.removeClass('vos-icon-active');
			activeIcon.css('z-index', 5);
		}
		if(activeWindow != null) {
			activeWindow.removeClass('vos-window-active');
		}
	}
	
	// Window Methods
	var selectWindow = function(jqElem) {
		blurSelection();
		if(activeWindow != jqElem) {
			$('.vos-window').each( function() {
				if($(this).css('z-index') > 0)
					$(this).css('z-index', $(this).css('z-index')-1);
			});
			jqElem.addClass('vos-window-active');
			jqElem.css('z-index', jqElem.css('z-index')+5);
			activeWindow = jqElem;
		}
	}
	
	var closeWindow = function(jqElem) {
		var elemId = jqElem.attr('id');
		jqElem.remove();
		console.log( "Window ID: " + elemId + " closed!" );
	}
	
	// Icon Methods
	var selectIcon = function(jqElem) {
		blurSelection();
		if(activeIcon != jqElem) {
			jqElem.addClass('vos-icon-active');
			jqElem.css('z-index', 100);
			activeIcon = jqElem;
		}
	}
	
	var deleteIcon = function(jqElem) {
		var elemId = jqElem.attr('id');
		jqElem.remove();
		console.log( "Icon ID: " + elemId + " deleted!" );
	}
	
	// Context Methods
	var shiftContext = function(direction) {
		var contextId = parseInt(activeContext.attr('id').split('-')[1]);
		
		switch(direction) {
		case "left":
			if(contextId > 1) {
				activeContext = $("#context-"+(contextId-1));
				$('.vos-context').animate({ 
					left: '+=' + screen.width
				}, 500);
				$('.vos-context-item-active').animate({ 
					left: '-=' + 30
				}, 500);
			}
			break;
		case "right":
			if(contextId < 4) {
				if($('.vos-context').length <= contextId) {
					// create and move to a new context
					$('.vos-context').animate({ 
						left: '-=' + screen.width
					}, 500);
					$('.vos-context-item-active').animate({ 
						left: '+=' + 30
					}, 500);
					$('#content').append('<div class="vos-context" id="context-' + (contextId+1) + '"></div>');
					activeContext = $("#context-"+(contextId+1));
				} else {
					// move to the next context
					activeContext = $("#context-"+(contextId+1));
					$('.vos-context').animate({ 
						left: '-=' + screen.width
					}, 500);
					$('.vos-context-item-active').animate({ 
						left: '+=' + 30
					}, 500);
				}
			}
			break;
		default:
			break;
		}
	}
};