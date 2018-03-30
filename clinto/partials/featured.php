<?php
	if ( function_exists( 'ot_get_option' ) and ot_get_option( 'home_slides_category' ) ) :
		$the_query = new WP_Query( array(
			'cat'  => ot_get_option( 'home_slides_category', '' ),
			'posts_per_page' => 5,
			'offset'         => 0,
			'meta_query'     => array(array('key' => '_thumbnail_id'))
		));
	$count = 1;
	if ( $the_query->have_posts() ) : ?>

		<div id="HomeCarousel" class="carousel slide">
			<div class="carousel-inner">
				<?php
					while ( $the_query->have_posts() ) : $the_query->the_post();
					 	if ( has_post_thumbnail( $the_query->post->ID ) ) { // the current post has a thumbnail

							//Get the Thumbnail URL
							$src = wp_get_attachment_image_src( get_post_thumbnail_id( $the_query->post->ID ), 'slides', false, '' ); ?>

							<div class="item row-fluid <?php if( $count == "1" ) echo 'active'; ?>" style="background-image:url(<?php echo $src[0] ?>)">
								<div class="carousel-caption span10 offset1">
									<h2><a href="<?php the_permalink(); ?>"><?php echo get_the_title( $the_query->post->ID ) ?></a></h2>
									<p><?php the_excerpt(  $the_query->post->ID ); ?></p>
								</div>
							</div>
						<?php }
						$count++;
					endwhile;
					wp_reset_postdata();
				?>
			</div><!-- carousel-inner -->

			<?php if ($the_query->found_posts > 1 ) : ?>
				<a class="left carousel-control" href="#HomeCarousel" data-slide="prev">&lsaquo;</a>
				<a class="right carousel-control" href="#HomeCarousel" data-slide="next">&rsaquo;</a>
			<?php endif; ?>

		</div><!-- #HomeCarousel -->

	<?php endif; ?>

<?php endif; ?>
<?php wp_cache_flush(); ?>