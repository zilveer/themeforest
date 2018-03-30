<?php

if ( ! defined( 'ABSPATH' ) ) exit;

?>
<!-- boutique template: content-blog-summary -->
<?php do_action('boutique_blog_summary_inner_before'); ?>
<div class="blog_date">
		<span class="month"><?php echo get_the_date('M');?></span>
		<span class="day"><?php echo get_the_date('j');?></span>
		<span class="year"><?php echo get_the_date('Y');?></span>
		<div></div>
	</div>
	<div class="blog_summary_wrap">
		<?php if ( has_post_thumbnail() ) { ?>
			<div class="blog_image">
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'boutique-kids' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'boutique_blog-small', array(
							'class' => 'fancy_border',
						) );
					}
					?>
				</a>
			</div>
		<?php } ?>
		<div class="blog_header">
			<h2 class="entry-title <?php echo ( is_sticky() ) ? ' featured-post' : '';?> ?>"><span><?php echo is_sticky() ? '<i class="fa fa-star-o"></i> ' : '';?><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'boutique-kids' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></span></h2>
		</div>
		<?php boutique_blog_links(); ?>
		<div class="blog_summary">
			<?php the_excerpt(); ?>
			<?php /* <?php else : ?>
	            <div class="entry-content">
	                <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'boutique' ) ); ?>
	                <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'boutique' ) . '</span>', 'after' => '</div>' ) ); ?>
	            </div><!-- .entry-content3 -->
	            <?php endif; ?>
	*/ ?>
			<a href="<?php the_permalink();?>" class="dtbaker_button larger"><?php _e('Read More','boutique-kids');?></a>
		</div>
		<div class="clear"></div>
	</div>
<?php do_action('boutique_blog_summary_inner_after'); ?>