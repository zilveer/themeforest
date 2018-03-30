<?php
/**
 * The template for displaying content. Used for 404 pages.
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

  <article id="post-notfound" >
	<div class="entry">
	  <div class="post-content group">
		<p><?php _e( 'It looks like this was the result of either:', 'primathemes' ); ?></p>
		<ul>
		<li><?php _e( 'a mistyped address', 'primathemes' ); ?></li>
		<li><?php _e( 'an out-of-date link', 'primathemes' ); ?></li>
		</ul>
		<p><?php _e( 'Perhaps searching can help.', 'primathemes' ); ?></p>
		<?php get_search_form(); ?>
	  </div>
	</div>
  </article>
