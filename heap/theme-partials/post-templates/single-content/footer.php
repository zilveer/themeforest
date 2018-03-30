<?php
global $post_format;
?>

<footer class="article__footer  push--bottom">
	<?php
	global $numpages;
	if($numpages > 1):
		?>
		<div class="entry__meta-box  meta-box--pagination">
			<?php
			$args = array(
				'before' => '<ol class="nav  pagination--single">',
				'after' => '</ol>',
				'next_or_number' => 'next_and_number',
				'previouspagelink' => __('&laquo;', 'heap'),
				'nextpagelink' => __('&raquo;', 'heap')
			);
			wp_link_pages( $args );
			?>
		</div>
	<?php
	endif;
	$categories = get_the_category();
	if ( !is_wp_error($categories) && !empty( $categories ) ): ?>
		<div class="meta--categories btn-list  meta-list">
			<span class="btn  btn--small  btn--secondary  list-head"><?php _e('Categories', 'heap') ?></span>
			<?php
			foreach ($categories as $category) {
				echo '<a class="btn  btn--small  btn--tertiary" href="'. get_category_link($category->term_id) .'" title="' . esc_attr(sprintf(__("View all posts in %s", 'heap'), $category->name)) . '" rel="tag">'. $category->name .'</a>';
			}; ?>
		</div>
	<?php endif;

	$tags = get_the_tags();
	if ( !empty( $tags ) ): ?>
		<div class="meta--tags  btn-list  meta-list">
			<span class="btn  btn--small  btn--secondary  list-head"><?php _e('Tags', 'heap') ?></span>
			<?php
			foreach ($tags as $tag) {
				echo '<a class="btn  btn--small  btn--tertiary" href="'. get_tag_link($tag->term_id) .'" title="'. esc_attr(sprintf(__("View all posts tagged %s", 'heap'), $tag->name)) .'" rel="tag">'. $tag->name .'</a>';
			}; ?>
		</div>
	<?php endif; ?>
	<hr class="separator" />
	<div class="post-meta">
		<?php
		if ( function_exists( 'display_pixlikes' ) ) {
			//get the pixlikes options
			$options = get_option('pixlikes_settings');

			//now determine if we really need to show it by taking into account the plugin's settings
			//this is a trick to guess whether one has pushed at least once the save button in the plugin's settings page
			if ( ! array_key_exists( "general", $options ) ) {
				$show_pixlikes = true;
			} else {
				$show_pixlikes = false;

				// singulars
				if( is_singular('post') && $options['show_on_post'] == '1' )  {
					$show_pixlikes = true;
				}
				if( is_page() && !is_front_page() && $options['show_on_page'] == '1' )  {
					$show_pixlikes = true;
				}
			}

			if ( $show_pixlikes ) :
				//replicate the logic of the plugin's loadTemplate() since it doesn't allow to pass a path to a template
				//so to bypass the regular template logic

				//replicate the plugin class has_post_cookie() function since it is private
				$has_post_cookie = false;
				if ( $options['free_votes'] ) {
					$has_post_cookie = false;
				} elseif ( isset( $_COOKIE['pixlikes_' . get_the_ID() ] ) ) {
					$has_post_cookie = true;
				}

				if ( empty( $display_only ) && ! $has_post_cookie ) {
					$display_only = 'likeable';
				} else {
					$display_only = 'liked';
				}

				$data_id = 'data-id="'.get_the_ID().'"';
				$likes_number = get_pixlikes( get_the_ID() );

				if ( empty($likes_number) ) {
					$likes_number = 0;
				} ?>
				<div id="pixlikes" class="share-item  pixlikes-box  <?php echo $display_only; ?>"  <?php echo $data_id ?>>
					<span class="like-link"><i class="icon-e-heart"></i>
					<span class="likes-text">
						<span class="likes-count"><?php echo $likes_number ?></span>&nbsp;<?php _e('likes', 'heap') ?>
					</span>
					</span>
				</div>
			<?php endif;
		} ?>
		<?php if ( heap_option('blog_single_show_share_links') && (heap_option('blog_single_share_links_position', 'bottom') == 'bottom' || heap_option('blog_single_share_links_position', 'bottom') == 'both') ): ?>
				<div class="addthis_toolbox addthis_default_style addthis_32x32_style  add_this_list"
					 addthis:url="<?php echo heap_get_current_canonical_url(); ?>"
					 addthis:title="<?php wp_title('|', true, 'right'); ?>"
					 addthis:description="<?php echo trim(strip_tags(get_the_excerpt())) ?>">
					<?php get_template_part('theme-partials/wpgrade-partials/addthis-social-buttons'); ?>
				</div>
		<?php endif; ?>
	</div>

	<?php if (heap_option('blog_single_show_author_box')) get_template_part( 'author-bio' ); ?>

</footer><!-- .article__footer -->

<?php if ( function_exists('yarpp_related') ) { yarpp_related(); }