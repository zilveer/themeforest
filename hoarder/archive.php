<?php get_header(); ?>
<?php /* Get author data */
	if(get_query_var('author_name')) {
	    $curauth = get_user_by( 'login', get_query_var('author_name') );
	} else {
    	$curauth = get_userdata(get_query_var('author'));
	}
?>
			
			<!-- BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">
			
			<?php 
			$archive = '';
			if (have_posts()) : 
			
			    if( is_category() ){ $archive = 'cat='. get_query_var('cat'); } 
				elseif( is_tag() ){ $archive = 'tag_id='. get_query_var('tag_id'); }
				elseif( is_day() ){ $archive = 'year='. get_the_time('Y') .'&monthnum='. get_the_time('n') .'&day='. get_the_time('j'); }
				elseif( is_month() ){ $archive = 'year='. get_the_time('Y') .'&monthnum='. get_the_time('n'); }
				elseif( is_year() ){ $archive = 'year='. get_the_time('Y'); }
				elseif( is_author() ){ $archive = 'author='. get_query_var('author'); }
				elseif( $format = get_post_format() ){ $archive = 'post-format-'. $format; }
			    
			$post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
	 	  	<?php /* If this is a category archive */ if (is_category()) { ?>
				<h1 class="page-title"><?php printf(__('All posts in %s', 'zilla'), single_cat_title('',false)); ?></h1>
	 	  	<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
				<h1 class="page-title"><?php printf(__('All posts tagged %s', 'zilla'), single_tag_title('',false)); ?></h1>
	 	  	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				<h1 class="page-title"><?php _e('Archive for', 'zilla') ?> <?php the_time( get_option('date_format') ); ?></h1>
	 	 	 <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				<h1 class="page-title"><?php _e('Archive for', 'zilla') ?> <?php the_time('F, Y'); ?></h1>
	 		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				<h1 class="page-title"><?php _e('Archive for', 'zilla') ?> <?php the_time('Y'); ?></h1>
		  	<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				<h1 class="page-title"><?php _e('All posts by', 'zilla') ?> <?php echo $curauth->display_name; ?></h1>
	 	  	<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<h1 class="page-title"><?php _e('Blog Archives', 'zilla') ?></h1>
	 	  	<?php } ?>
	
			<?php while (have_posts()) : the_post(); ?>
			    
            <?php zilla_post_before(); ?>
			<!-- BEGIN .hentry -->
			<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">				
			<?php zilla_post_start(); ?>
			
			<?php
			    $format = get_post_format();
			    				    
			    get_template_part( 'content', $format);
			    
			    if( $format == '' || $format == 'gallery' || $format == 'video' || $format == 'audio' ) {
			        get_template_part( 'content', 'meta' ); 
			    }
			?>
				                
            <?php zilla_post_end(); ?>
			<!-- END .hentry-->  
			</div>
			<?php zilla_post_after(); ?>

			<?php endwhile; ?>
			
			<?php 
    		$pagination = zilla_get_option('post_pagination_type');
    		// force pagination in Opera
			global $is_opera;
    		if( $pagination == 'loadmore' && !$is_opera ) { 
    		    if( $wp_query->max_num_pages > 1 ) { ?>
    		        <a href="#" id="load-more" rel="<?php echo $archive; ?>" data-width="580"><?php _e('Load More', 'zilla'); ?></a>
    		    <?php }
    		} else { ?>
    		    <!-- BEGIN .navigation .page-navigation -->
        		<div class="navigation page-navigation">
    			    <div class="nav-next">
    				    <?php next_posts_link(__('Older Entries', 'framework')); ?>
    				</div>
    				<div class="nav-previous">
    				    <?php previous_posts_link(__('Newer Entries', 'framework')) ?>
    				</div>
    			<!-- END .navigation .page-navigation -->
        		</div>
    		<?php } ?>
    		
		<?php else : ?>

			<!-- BEGIN #post-0-->
			<div id="post-0" <?php post_class(); ?>>
			
				<h2 class="entry-title"><?php _e('Error 404 - Not Found', 'zilla') ?></h2>
			
				<!-- BEGIN .entry-content-->
				<div class="entry-content">
					<p><?php _e("Sorry, but you are looking for something that isn't here.", "zilla") ?></p>
				<!-- END .entry-content-->
				</div>
			
			<!-- END #post-0-->
			</div>

		<?php endif; ?>
		<!-- END #primary .hfeed -->
		</div>
	
    <?php get_sidebar(); ?>
    
<?php get_footer(); ?>