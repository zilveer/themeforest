<?php
/**
 * The template used for displaying post content
 *
 */
?>

<div class="post_wrap clearfix">

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php get_template_part( 'template-parts/share' ); ?>

		<header class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		</header><!-- .entry-header -->

	<div class="featured_image_wrap">

		<?php if ( has_post_thumbnail() ) { ?>
				<a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail( 'full-width-thumbnails' ); ?></a>
		<?php } ?>

	</div><!--. featured_image_wrap -->

	<div class="entry-meta">
		<?php _e('Published: ','heartfelt'); the_time( get_option( 'date_format' ) ); ?>&nbsp; &#126; &nbsp;
		<span class="blog_comments"><a href="<?php comments_link(); ?> "><i class="fa fa-comment"></i><?php comments_number( '0', '1', '%' ); ?></a></span>
	</div><!-- .entry-meta -->

	<article>

		<div class="entry-content clearfix">

			<?php the_content(__(' continue reading &#8594;','heartfelt')); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'heartfelt' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

	</article>

	<hr>

	<footer class="entry-footer clearfix">

		<?php 
			echo get_the_category_list(); 
			echo get_the_tag_list('<ul class="post_tags"><li>','</li><li>','</li></ul>');
			edit_post_link( __( 'Edit', 'heartfelt' ), '<span class="edit-link">', '</span>' ); 
		?>

	</footer><!-- .entry-footer -->

	</div><!-- post class -->

</div><!-- .post_wrap -->
