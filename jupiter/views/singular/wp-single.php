<?php

/**
 * template part for blog single single.php. views/blog/components
 *
 * @author      Artbees
 * @package     jupiter/views
 * @version     5.0.0
 */

global $mk_options;


if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<article id="<?php the_ID(); ?>" <?php post_class(array('mk-blog-single')); ?> itemscope="itemscope" itemtype="https://schema.org/BlogPosting" itemprop="blogPost">

	<?php do_action('blog_single_before_featured_image'); ?>

	<?php mk_get_view('blog/components', 'blog-single-featured'); ?>

	<?php mk_get_view('blog/components', 'blog-single-meta'); ?>

	<?php do_action('blog_single_before_the_content'); ?>

	<?php mk_get_view('blog/components', 'blog-single-content'); ?>

	<?php do_action('blog_single_after_the_content'); ?>

	<?php mk_get_view('blog/components', 'blog-single-bold-share'); ?>

	<?php mk_get_view('blog/components', 'blog-single-about-author'); ?>

	<?php mk_get_view('blog/components', 'blog-similar-posts'); ?>

	<?php mk_get_view('blog/components', 'blog-single-comments'); ?>

	<?php do_action('blog_single_after_comments'); ?>

</article>

<?php endwhile; ?>