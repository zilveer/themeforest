<?php
/**
 * The template for displaying content using "featured image and full text" style. 
 * Used for index/archive/search pages.
 *
 * WARNING: This file is part of the PrimaShop parent theme.
 * Please do all modifications in the form of a child theme.
 *
 * @category PrimaShop
 * @package  Templates
 * @author   PrimaThemes
 * @link     http://www.primathemes.com
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

  <article id="post-<?php the_ID(); ?>" <?php post_class('post-blog'); ?> >
	<div class="entry">

	  <h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	  
	  <?php echo do_shortcode( prima_get_setting( 'meta_'.get_post_type(), null, '<p class="post-meta"><small>%setting%</small></p>' ) ); ?>

	  <div class="post-content group">
	    <?php prima_image( array ( 'attachment' => false, 'image_class' => 'image-featured', 'link_to_post' => true ) ); ?>
		<?php the_content(); ?>
	  </div>

	</div>
  </article>