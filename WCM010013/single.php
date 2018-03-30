<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage TemplateMela
 * @since TemplateMela 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
  <div id="content" class="site-content" role="main">
    <?php
		// Start the Loop.
		while ( have_posts() ) : the_post();

			/*
			 * Include the post format-specific template for the content. If you want to
			 * use this in a child theme, then include a file called called content-___.php
			 * (where ___ is the post format) and that will be used instead.
			 */
			get_template_part( 'content', get_post_format() );

			$templatemela_is_author_info = templatemela_is_author_info();
			if($templatemela_is_author_info == 1):
				get_template_part( 'author-bio' );
			endif;
			
			// Previous/next post navigation.
			templatemela_post_nav();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		endwhile;
		$templatemela_is_related_posts = templatemela_is_related_posts();	
	?>
  </div>
  <!-- #content -->
</div>
<!-- #primary -->
<?php
get_sidebar( 'content' );
get_sidebar();
get_footer(); ?>