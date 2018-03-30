<?php
	if( is_user_logged_in() AND !is_null( $content ) AND !is_feed() ) {
        
        global $current_user, $wp_roles;
        $user_levels = $wp_roles->roles;
        
        $current_user_level = array_search( $current_user->roles[0], $user_levels );
        $required_level = array_search( trim( strtolower( $role ) ), $user_levels );
        
        if( $current_user_level < $required_level ) :            
            if( !empty( $message ) ) : ?>
                <div class="box error-box">
                	<p><?php echo $message; ?></p>
                </div>           
			<?php endif;
		else : ?>
			<div class="well">
				<?php echo wpautop( do_shortcode( $content ) ); ?>
			</div>
		<?php endif;        
    }    
	else if( !empty( $message ) ) : ?>
        <div class="box info-box">
        	<p><?php echo $message; ?></p>
        </div>
	<?php endif;
?>

