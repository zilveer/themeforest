<?php
/**
 * The html of the settings box in the post type unlimited admin pages. 
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */       

 $first = true;    
 global $post;             //yit_debug($this_obj->get_items( $post->ID ));
?>

<p class="field-row">
    <a href="" class="button-secondary add-items"><?php _e( 'Add field', 'yit' ) ?></a>
	<img src="<?php echo esc_url( admin_url( 'images/wpspin_light.gif' ) ); ?>" class="ajax-loading" id="add-items-ajax-loading" alt="" />
</p>


<div class="contactform_items panel">
	
    <?php 
        $i = 0;
        foreach ( array_values( $this_obj->get_items( $post->ID ) ) as $item_id => $the_ ) :
    
            yit_get_model('contact_form')->add_contactform_field( array(
                'index'      => $i,
                'post_id'    => $post->ID,
                'field_name' => $this_obj->metabox_name,
                'die'        => false
            ) );
    
            $i++;
        endforeach; 
    ?>

</div>


<script>
jQuery(document).ready(function($){
	//toggle items
	$('.contactform_item h3, .contactform_item .handlediv').live('click', function() {
		var p = $(this).parent('.contactform_item'), id = p.attr('id');
		p.toggleClass('closed');

			
		if ( !p.hasClass('closed') ) {
			p.find('.inside').show();
		} else {
			p.find('.inside').hide();
		}

	});
	
	
	//sortable
	$('.contactform_items').sortable({
		items:'.contactform_item',
		cursor:'move',
		axis:'y',
		handle: 'h3',
		scrollSensitivity:40,
		forcePlaceholderSize: true,
		helper: 'clone',
		opacity: 0.65,
		placeholder: 'metabox-sortable-placeholder',
		start:function(event,ui){
			ui.item.css('background-color','#f6f6f6');
		},
		stop:function(event,ui){
			console.log(ui);
			ui.item.removeAttr('style');
			variation_row_indexes();
		}
	});

	function variation_row_indexes() {
		$('.contactform_items .contactform_item').each(function(index, el){
			$('.contactform_menu_order', el).val( parseInt( $(el).index('.contactform_items .contactform_item') ) );
		});
	};
	
	
	//remove item
	$('.remove_item').live('click', function(){
		if( $('.remove_item').length > 1 ) {
			$(this).parents('.contactform_item').remove();
		}
		
		return false;
	});
	
	
	
	//
	var field_type_handler = function(){
	    var this_item = $(this);
    	$('.text-field-type select', this_item).live('change', function(){
    		var val = $(this).val();             
    		$('.deps', this_item).hide().filter(function(i){ return $(this).hasClass( 'deps_' + val ); }).show();
    	}).change();
    };
	$('.contactform_item').each(field_type_handler);
	
	
	//
	$('.del-field-option').live('click', function(){
		if( $('.option').length > 1 ) {
			$(this).parents('.option').remove();
		}
		
		return false;
	});
	
	//add new fields to contact form
	$('.add-items').click(function(){
		
        var data = {
       		action: 'add_contactform_field',
            post_id: <?php echo $post->ID; ?>,
            index: $('.contactform_item').length,
            field_name: '<?php echo $this_obj->metabox_name; ?>'
        };
		$.post(ajaxurl, data, function(response) {
			$('.contactform_items').append(response);
			$('.contactform_item').each(field_type_handler);
		});
		
		return false;
	});
	
});
</script>