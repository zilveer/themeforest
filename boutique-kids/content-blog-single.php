<?php

if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!-- boutique template: content-blog-single -->
<?php
do_action('boutique_blog_content_inner_before'); ?>

<?php boutique_blog_links(); ?>
	<?php if ( has_post_thumbnail() ) { ?>
		<div class="blog_image dtbaker_photo_border"><div>
				<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'boutique_blog-large', array(
						'class' => 'fancy_border'
					) );
				}
				?>
		</div></div>
	<?php } ?>

	<div class="blog_content">
		<?php the_content( sprintf( esc_html__( 'Continue reading %s', 'boutique-kids' ), '<span class="meta-nav">&rarr;</span>' ) ); ?>
		<?php $d = wp_link_pages( array( 'before' => '<nav class="dtbaker_pagination"><ul class="page-numbers">', 'after' => '</ul></nav>', 'link_before' => '<li><span>', 'link_after' => '</span></li>', 'echo' => 0 ) );
		$d = preg_replace( '#(<a[^>]*>)<li><span>#','<li>$1',$d );
		$d = preg_replace( '#</span></li></a>#','</a></li>',$d );
		echo str_replace( 'page-numbers','dtbaker-page-numbers',$d );
		?>
	</div>

<?php do_action('boutique_blog_content_inner_after'); ?>