<?php
global $block, $get_meta, $post, $page_builder_id;

$page_builder_id = $post->ID;
		
if( isset( $get_meta[ 'tie_builder' ][0] ) ){
	$tie_get_blocks = false;
	if( !empty( $get_meta[ 'tie_builder' ][0] ) ){
		$tie_get_blocks = $get_meta[ 'tie_builder' ][0]; 
		if( is_serialized( $tie_get_blocks ) ){
			$tie_get_blocks = unserialize ( $tie_get_blocks );
		}
	}	
}
		
if( !empty( $tie_get_blocks ) && is_array( $tie_get_blocks ) ){
	foreach ( $tie_get_blocks as $block ){

		switch( $block['type'] ){

			case 'n':
				get_template_part( 'framework/blocks/block-categories' );
				break;
				
			case 's':
				get_template_part( 'framework/blocks/block-scroll' );
				break;
							
			case 'news-pic':
				get_template_part( 'framework/blocks/block-pictures' );
				break;
							
			case 'videos':
				get_template_part( 'framework/blocks/block-videos' );
				break;			
					
			case 'recent':
				get_template_part( 'framework/blocks/block-recent' );
				break;							
					
			case 'woocommerce':
				if( function_exists( 'is_woocommerce' ) )
					get_template_part( 'framework/blocks/block-woocommerce' );
					
				break;	
					
			case 'tabs':
				get_template_part( 'framework/blocks/block-tabs' );
				break;
					
			case 'ads': ?>
				<div class="e3lan home-e3lan">
				<?php
					if( !empty($block['text']) ){
						if( function_exists('icl_t') ) $custom_text = icl_t( THEME_NAME , $block['boxid'] , $block['text']); else $custom_text = $block['text'];
						echo do_shortcode( htmlspecialchars_decode(stripslashes ( $custom_text ) ));
					}?>
				</div>
				<div class="clear"></div>
			<?php
				break;
					
		}
	}
}