<?php // Footer meta output

if ( is_single() ) : ?>

	<footer class="entry-meta-bottom"><!-- Article's Footer -->
		<?php if ( function_exists( 'pt_entry_post_tags' ) ) { pt_entry_post_tags(); } ?>
		<?php if ( function_exists( 'pt_share_buttons_output' ) && handy_get_option('blog_share_buttons')=='on' ) { pt_share_buttons_output(); } ?>
		<?php if ( function_exists( 'pt_entry_post_views' ) ) { pt_entry_post_views(); } ?>
		<?php if ( function_exists( 'pt_output_like_button' ) ) { pt_output_like_button( get_the_ID() ); } ?>
	</footer><!-- end of Article's Footer -->

	<?php if ( get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
		<?php get_template_part( 'author-bio' ); ?>
	<?php endif; ?>

<?php endif; ?>
