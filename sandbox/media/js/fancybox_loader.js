		jQuery(document).ready(function() {
			/*
			*   Examples - images
			*/

			jQuery("a#example1").fancybox();

			jQuery("a.example2").fancybox({
				'titleShow'     : true,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic',
				'easingIn'      : 'easeOutBack',
				'easingOut'     : 'easeInBack'
			});
	});