<?php
/**
 * The template used for displaying single post content in single.php
 *
 */
?>

<div class="post_wrap clearfix">

<?php get_template_part( 'template-parts/share' ); ?>

		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header><!-- .entry-header -->

	<?php 
		if ( has_post_thumbnail( $post->ID ) ){
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) );  
	?>

	<a href="<?php echo $image[0]; ?>" data-featherlight="image" class="featured-image">
		<?php the_post_thumbnail( 'page-thumbnails' ); ?>
	</a>

	<?php } // end featured image check ?>

	<div class="entry-meta">
		<?php _e('Published: ','heartfelt'); the_time( get_option( 'date_format' ) ); ?>&nbsp; &#126; &nbsp;
		<span class="blog_comments"><a href="<?php comments_link(); ?> "><i class="fa fa-comment"></i><?php comments_number( '0', '1', '%' ); ?></a></span>
	</div><!-- .entry-meta -->

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="entry-content clearfix">

			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'heartfelt' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

	</article><!-- #post-## -->

	<hr>

	<footer class="entry-footer clearfix">

		<?php 
			echo get_the_category_list(); 
			echo get_the_tag_list('<ul class="post_tags"><li>','</li><li>','</li></ul>');
			edit_post_link( __( 'Edit', 'heartfelt' ), '<span class="edit-link">', '</span>' ); 
		?>

	</footer><!-- .entry-footer -->

	<hr>

	<?php heartfelt_post_nav(); ?>

</div><!-- .post_wrap -->
