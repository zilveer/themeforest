<?php
/**
 * @package Gather - Event Landing Page Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 10-8-2015
 *
 * @copyright  Copyright ( C ) 2014 - 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

?>
<div class="content-none">
    <div class="row">
		
		<div class="col-sm-12">
			<h4 class="article-title"><?php _e('Nothing Found Here!','gather'); ?></h4>
		    <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

				<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'gather' ), admin_url( 'post-new.php' ) ); ?></p>

				<?php elseif ( is_search() ) : ?>

				<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'gather' ); ?></p>
				<?php get_search_form(); ?>

				<?php else : ?>

				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'gather' ); ?></p>
				<?php get_search_form(); ?>

			<?php endif; ?>
		</div>
    </div>
</div>