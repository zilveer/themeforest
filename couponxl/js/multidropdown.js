jQuery(document).ready(function($){
	$('.multidropdown-param').each(function(){
		var $this = $(this);
		var values = $this.find('input').val().split(',');
		for( var i=0; i<values.length; i++ ){
			$this.find('option[value="'+values[i]+'"]').attr( 'selected', '1' );
		}
	});

	$(document).on( 'change', '.multidropdown-param select', function(){
		var $parent = $(this).parents('.multidropdown-param');
		var $field = $parent.find('input');
		$field.val( $(this).val().join(',') );
	});
});