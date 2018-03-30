<?php
global $get_meta, $post, $do_not_duplicate;

if( ( tie_get_option('check_also') && empty( $get_meta["tie_hide_check_also"][0] ) ) || ( isset( $get_meta["tie_hide_check_also"][0] ) && $get_meta["tie_hide_check_also"][0] == 'no' ) ):
	$original_post = $post;

	$check_also_no = tie_get_option('check_also_number') ? tie_get_option('check_also_number') : 1;
	$check_also_position = tie_get_option('check_also_position') ? tie_get_option('check_also_position') : 'right';
	
	$do_not_duplicate[] = $post->ID;
		
	$query_type = tie_get_option('check_also_query') ;
	if( $query_type == 'author' ){
		$args=array('post__not_in' => $do_not_duplicate ,'posts_per_page'=> $check_also_no , 'author'=> get_the_author_meta( 'ID' ), 'no_found_rows' => 1 );
	}elseif( $query_type == 'tag' ){
		$tags = wp_get_post_tags($post->ID);
		$tags_ids = array();
		foreach($tags as $individual_tag) $tags_ids[] = $individual_tag->term_id;
		$args=array('post__not_in' => $do_not_duplicate ,'posts_per_page'=> $check_also_no , 'tag__in'=> $tags_ids, 'no_found_rows' => 1  );
	}
	else{
		$categories = get_the_category($post->ID);
		$category_ids = array();
		foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
		$args=array('post__not_in' => $do_not_duplicate ,'posts_per_page'=> $check_also_no , 'category__in'=> $category_ids, 'no_found_rows' => 1 );
	}		
	$check_also_query = new wp_query( $args );
	if( $check_also_query->have_posts() ) :?>
	
	<section id="check-also-box" class="post-listing check-also-<?php echo $check_also_position?>">
		<a href="#" id="check-also-close"><i class="fa fa-close"></i></a>

		<div class="block-head">
			<h3><?php _eti( 'Check Also' ); ?></h3>
		</div>

		<?php while ( $check_also_query->have_posts() ) : $check_also_query->the_post()?>
		<div <?php tie_post_class( 'check-also-post' ); ?>>
			<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'tie-medium' ); ?>
					<span class="fa overlay-icon"></span>
				</a>
			</div><!-- post-thumbnail /-->
			<?php endif; ?>			
			<h2 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<p><?php tie_excerpt_home() ?></p>
		</div>
		<?php endwhile;?>
	</section>
			
			
	<?php endif;

	$post = $original_post;
	wp_reset_query();
endif; ?>