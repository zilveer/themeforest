<?php if( !defined('ABSPATH') ) exit;?>
<?php get_header(); ?>
	<div class="container">
		<?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		} ?>	
		<div class="row">
			<div class="col-sm-8 main-content">
				<?php if( have_posts() ):the_post();?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                	<?php 
                		if( has_post_thumbnail() ){
                			the_post_thumbnail( apply_filters( 'get_the_post_thumbnail/size' , 'blog-large-thumb'), array('class'=>'img-responsive') );
                		}
                	?>                    
                    <div class="post-header">
                        <h2>
                        	<?php if( !is_single() ):?>
                        		<a href="<?php the_permalink();?>"><?php the_title();?></a>
                        	<?php else:?>
                        		<?php the_title();?>
                        	<?php endif;?>
                        </h2>
                        <?php do_action( 'mars_blog_metas' );?>
                    </div>
                    
                    <div class="post-entry">
                    	<?php the_content();?>
						<?php 
							$defaults = array(
								'before' => '<ul class="pagination">',
								'after' => '</ul>',
								'before_link' => '<li>',
								'after_link' => '</li>',
								'current_before' => '<li class="active">',
								'current_after' => '</li>',
								'previouspagelink' => '&laquo;',
								'nextpagelink' => '&raquo;'
							);  
							bootstrap_link_pages( $defaults );
						?>
                    </div>
                    <div class="post-info">
                    	<span class="meta"><?php print the_terms( $post->ID, 'category', '<span class="meta-info">'.__('Category','mars').'</span> ', ' ' ); ?></span>
                        <?php the_tags('<span class="meta"><span class="meta-info">'.__('Tag','mars').'</span> ',' ','</span>');?>
                    </div>
                    
                    <?php 
                    
	                    if ( ( get_previous_post() || get_next_post() ) && apply_filters( 'videotube_prev_next_post' , true ) === true ):
	                    
	                    	?>
								<nav>
								  <ul class="pager">
								  	<?php 
								  	
									  	if( get_previous_post() ):
									  		$prev_post = get_previous_post();
									  		
									  		echo '<li class="previous"><a href="'. esc_url( get_permalink( $prev_post->ID ) ) .'">'. sprintf( '&larr; %s', $prev_post->post_title ) .'</a></li>';
									  	
									    endif;
									    
									    if( get_next_post() ):
									    	$next_post = get_next_post();
									    	
									    	echo '<li class="next"><a href="'. esc_url( get_permalink( $next_post->ID ) ) .'">'. sprintf( '%s &rarr;', $next_post->post_title ) .'</a></li>';
									    endif;
								  	
								  	?>
								  </ul>
								</nav>                    
	                    	<?php 
	                    
	                    endif;
                    
                    ?>
                    
                </div><!-- /.post -->     
				<?php dynamic_sidebar('mars-post-single-below-content-sidebar');?>
				<?php 
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				?>	
				<?php endif;?>
			</div>
			<?php get_sidebar();?>
		</div><!-- /.row -->
	</div><!-- /.container -->
<?php get_footer();?>
