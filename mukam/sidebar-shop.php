<?php
if ( function_exists( 'get_option_tree') ) {
       	$theme_options = get_option('option_tree');  
}
	$animy4 = ''; 
    $animy = get_option_tree('enable_load_animation', $theme_options);
    if ( $animy == 'Yes' ) {
      
      $animy4 = ' fadein scaleInv anim_4';
    }
?>				
				<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>	
					<aside class="col-sm-4 col-md-4 sidebar<?php echo $animy4;?>">
						<?php dynamic_sidebar( 'sidebar-1' ); ?>
					</aside>
				<?php endif; ?>	