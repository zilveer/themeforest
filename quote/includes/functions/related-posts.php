<?php 

//==========================================================
// === REALTED BITS YO
//==========================================================
function dt_related_posts() {

	$so_show_related_posts = rwmb_meta( 'showrelated' );
	$so_related_posts = rwmb_meta( 'related_posts', 'type=select_advanced' );
	$title = get_theme_mod('related-posts-title' , 'Related Items');

	if ( is_main_query() && is_single() ) {

		if( $so_show_related_posts == 1 && ! empty( $so_related_posts ) ) { ?>

		<div class="centered">
			<h2 class="main-title fade-down"><?php echo $title; ?></h2>
			<hr>
	 	</div> 

		<div class="clearfix gap">
			<div id="related-carousel">					
	
			<?php foreach ( $so_related_posts as $so_related_post ) { ?> 
					<div class="post-item">

	               		<div class="item-inner">
	               			<?php echo get_the_post_thumbnail( $so_related_post,'featured-blog' ); ?>
	                        <div class="overlay">
	                            <a class="preview btn btn-outlined btn-primary" href="<?php echo esc_url( get_permalink( $so_related_post ) ); ?>" title="<?php echo esc_attr( get_the_title( $so_related_post ) ); ?>"><i class="fa fa-link"></i></a>          
	                        </div>   
	                    </div>
                        <h2 class="post-title"><?php echo esc_attr( get_the_title( $so_related_post ) ); ?></h2>
                    </div> 
			
			<?php }; ?>
			</div>


			<?php unset( $so_related_post ); ?>

		</div>

		<?php
		}

	}

}