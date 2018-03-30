(function($) {

	var size = {

		remove : function remove ( evt ) {
			evt.preventDefault();

			var $this = $( evt.currentTarget ),
				$unit = $this.parents( '.sizes-single-unit' );

			$unit.slideUp(200, function () {
				$unit.remove();
			});
		},

		add : function add (evt) {
			evt.preventDefault();

			var $this = $( evt.currentTarget );

			var $unit = $( '.sizes-single-unit' ).eq( 0 ).clone().insertBefore( $this ),
			 	$name = $unit.find( 'input[type=text]' );

			$unit.find( '.size-name' ).html( '' );
			$unit.find( 'input[type=number]' ).val( '' );
			$name.val( '' );

			size.nameBind( $unit );
		},

		nameBind : function nameBind ( $unit ) {
			var $input = $unit.find( 'input[type=text]' ),
				$output = $unit.find( '.size-name' );

			$input.on( 'change keydown keyup', function updateName() {
				$output.html( $input.val() );
			});
		}
	};


	$( document ).on('click', '.delete-size', size.remove );
	$('.add-size').on('click', size.add );


	$("#mk_image_sizes").submit(function(){

		var $this = $(this),
			serialised = [];


        window.progressCircle().play();

		$this.find('.sizes-single-unit').each(function(){
			serialised.push( $(this).find('input').serialize() );
		});
		console.log(serialised);

		var data = {
			action : 'mk_save_image_sizes',
			options : serialised,
			security : $('#security').val(),
			_wp_http_referer : $('input[name="_wp_http_referer"]').val()
		};

		 $.post(ajaxurl, data, function(response) {
            console.log(response);
        	window.progressCircle().status(1);
        });

		return false;

	});


})(jQuery);