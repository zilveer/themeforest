<?php 

global $custom_query, $wp_query;

// Check for a custom query, typically sent by a shortcode
$the_query = (!$custom_query) ? $wp_query : $custom_query;

$_wp_query = $wp_query ;
$wp_query = $the_query ;

?>
<div class="two-col-grid">
	<div class="posts row">
	<?php 
		if ( $the_query->have_posts() ) :
			 /* Start the Loop */ 
			$counter = 0;
			while ( $the_query->have_posts() ) : $the_query->the_post();
			$post_format = get_post_format(); 
			$post_format_text = !empty( $post_format ) ? $post_format : __( 'Standard', 'mediacenter' );
	?>
		<div class="post-two-col-grid col-sm-6">
			<a href="<?php the_permalink(); ?>" class="text-center post-thumbnail" title="<?php echo sprintf( __( 'Post Format: %1$s', 'mediacenter' ), $post_format_text ); ?>">
				<?php 
				if( has_post_thumbnail() ){
					echo get_the_post_thumbnail( get_the_ID(), array( 430, 245) , array( 'class' => 'media-object' ) );
				} else {
					echo '<span class="mc-default-post-thumbnail">' . media_center_default_post_thumbnail( $post_format ) . '</span>';
				}
				?>
			</a>
			<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php media_center_post_meta(); ?>
			<div class="excerpt"><?php the_excerpt(); ?></div>
			<div class="read-more-div"><a class="le-button huge read-more" href="<?php echo get_permalink() ;?>"><?php echo __('Read More', 'mediacenter');?></a></div>
		</div>
		<?php if( ++$counter % 2 == 0 ) : ?>
		<div class="clearfix"></div>
		<?php endif; ?>
	<?php
			endwhile;
		else : 
			get_template_part( 'content', 'none' );
		endif; // end have_posts() check
	?>
	</div><!-- /.posts -->
</div>

<?php $wp_query = $_wp_query ;