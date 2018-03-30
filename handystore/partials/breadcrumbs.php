<?php
// ----- Plumtree Blog Breadcrumbs Function

	/* === OPTIONS === */
	$text['home'] = __('Home', 'plumtree'); // text for the 'Home' link
	$text['category'] = __('Archive by Category "%s"', 'plumtree'); // text for a category page
	$text['search'] = __('Search Results for "%s"', 'plumtree'); // text for a search results page
	$text['tag'] = __('Posts Tagged "%s"', 'plumtree'); // text for a tag page
	$text['author'] = __('Articles Posted by %s', 'plumtree'); // text for an author page
	$text['404'] = __('Error 404', 'plumtree'); // text for the 404 page

	$show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
	$before = '<li itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem"><span class="current" itemprop="item">'; // tag before the current crumb
	$after = '</span></li>'; // tag after the current crumb
	/* === END OF OPTIONS === */

	global $post;

	$home_link = home_url('/');
	$link_before = '<li itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">';
	$link_after = '</li>';
	$link_attr = ' rel="nofollow" itemprop="item"';
	$link = $link_before . '<a' . $link_attr . ' href="%1$s" ><span itemprop="name">%2$s</span></a>' . $link_after;
	if (is_search() || is_404 ()) { $parent_id = $parent_id_2 = ''; }
	else { $parent_id = $parent_id_2 = $post->post_parent; }
	$frontpage_id = get_option('page_on_front');

	if ( !is_front_page() || !is_page_template( 'page-templates/front-page.php' ) ) : ?>
	<div class="breadcrumbs-wrapper col-md-12 col-sm-12 col-xs-12"><!-- Breadcrumbs-wrapper -->
		<div class="container">
			<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-12">
						<?php if ( is_single() && handy_get_option('post_pagination')=='on' && !is_attachment() ) { ?>
							<nav class="navigation post-navigation"><!-- Post Nav -->
								<h1 class="screen-reader-text"><?php echo __( 'Post navigation', 'plumtree' ); ?></h1>
								<div class="nav-links">
									<?php previous_post_link( '%link', '<i class="fa fa-angle-left"></i>'. __( ' Previous Post', 'plumtree' ) ); ?>
									<?php next_post_link( '%link', __( 'Next Post ', 'plumtree' ) . '<i class="fa fa-angle-right"></i>' ); ?>
								</div>
							</nav><!-- end of Post Nav -->
						<?php } //end of post nav
							elseif ( is_single() && handy_get_option('post_pagination')=='on' && is_attachment() ) {
								$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
								$next     = get_adjacent_post( false, '', false );
								if ( ! $next && ! $previous ) {
									return false;
								} else { ?>
									<nav class="navigation post-navigation"><!-- Image Nav -->
										<h1 class="screen-reader-text"><?php echo __( 'Post navigation', 'plumtree' ); ?></h1>
										<div class="nav-links">
											<?php previous_image_link( '%link', '<i class="fa fa-angle-left"></i>'.__( ' Previous Image', 'plumtree' ) ); ?>
											<?php next_image_link( '%link', __( 'Next Image ', 'plumtree' ).'<i class="fa fa-angle-right"></i>' ); ?>
										</div>
									</nav><!-- end of Image Nav -->
								<?php }
							} // end of images nav
							 else {
								pt_output_page_title();
							} ?>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
				<?php if ( handy_get_option('site_breadcrumbs')=='on' || handy_get_option('post_breadcrumbs')=='on' ) {
				echo '<ol class="breadcrumbs" itemscope="itemscope" itemtype="http://schema.org/BreadcrumbList">';
				if ($show_home_link == 1) {
					/* Home Link */
					echo '<li itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
							<a href="' . esc_url($home_link) . '" itemprop="item"><span itemprop="name">' . esc_attr($text['home']) . '</span></a>
						  </li>';
				}

				if ( is_home() && get_option( 'page_for_posts' ) ) {
					echo $before . esc_attr(get_the_title( get_option( 'page_for_posts' ) )) . $after;

				} elseif ( is_category() ) {
					$this_cat = get_category(get_query_var('cat'), false);
					if ($this_cat->parent != 0) {
						$cats = get_category_parents($this_cat->parent, TRUE, '');
						$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
						$cats = str_replace('</a>', '</a>' . $link_after, $cats);
					echo $cats;
					}
					echo $before . sprintf(esc_attr($text['category']), single_cat_title('', false)) . $after;

				} elseif ( is_search() ) {
					echo $before . sprintf(esc_attr($text['search']), get_search_query()) . $after;

				} elseif ( is_day() ) {
					echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'));
					echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F'));
					echo $before . get_the_time('d') . $after;

				} elseif ( is_month() ) {
					echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'));
					echo $before . get_the_time('F') . $after;

				} elseif ( is_year() ) {
					echo $before . get_the_time('Y') . $after;

				} elseif ( is_single() && !is_attachment() ) {
					if ( get_post_type() != 'post' ) {
						$post_type = get_post_type_object(get_post_type());
						$slug = $post_type->rewrite;
						printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
						echo $before . esc_attr(get_the_title()) . $after;
					} else {
						$cat = get_the_category(); $cat = $cat[0];
						$cats = get_category_parents($cat, TRUE, '');
						$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
						$cats = str_replace('</a>', '</a>' . $link_after, $cats);
						echo $cats;
						echo $before . esc_attr(get_the_title()) . $after;
					}

				} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
					$post_type = get_post_type_object(get_post_type());
					echo $before . esc_attr($post_type->labels->singular_name) . $after;

				} elseif ( is_attachment() ) {
					$parent = get_post($parent_id);
					$cat = get_the_category($parent->ID);
					if ($cat && is_array($cat)) {
						$cat = $cat[0];
						$cats = get_category_parents($cat, TRUE, '');
						$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
						$cats = str_replace('</a>', '</a>' . $link_after, $cats);
						echo $cats;
					}
					if ( $parent_id && $parent_id !='0') { printf($link, get_permalink($parent), $parent->post_title); }
					echo $before . esc_attr(get_the_title()) . $after;

				} elseif ( is_page() && !$parent_id ) {
					echo $before . esc_attr(get_the_title()) . $after;

				} elseif ( is_page() && $parent_id ) {
					if ($parent_id != $frontpage_id) {
						$breadcrumbs = array();
						while ($parent_id) {
							$page = get_page($parent_id);
							if ($parent_id != $frontpage_id) {
								$breadcrumbs[] = sprintf($link, esc_url(get_permalink($page->ID)), esc_attr(get_the_title($page->ID)));
							}
							$parent_id = $page->post_parent;
						}
						$breadcrumbs = array_reverse($breadcrumbs);
						for ($i = 0; $i < count($breadcrumbs); $i++) {
							echo $breadcrumbs[$i];
						}
					}
					echo $before . esc_attr(get_the_title()) . $after;

				} elseif ( is_tag() ) {
					echo $before . sprintf(esc_attr($text['tag']), single_tag_title('', false)) . $after;

				} elseif ( is_author() ) {
					global $author;
					$userdata = get_userdata($author);
					echo $before . sprintf(esc_attr($text['author']), $userdata->display_name) . $after;

				} elseif ( is_404() ) {
					echo $before . esc_attr($text['404']) . $after;

				} elseif ( has_post_format() && !is_singular() ) {
					echo get_post_format_string( get_post_format() );
				}

		if ( get_query_var('paged') ) {
			echo ' (' . __('Page', 'plumtree') . ' ' . get_query_var('paged') . ')';
		}
	echo '</ol>';
	} ?>
	</div>
	</div></div></div><!-- end of Breadcrumbs -->
<?php endif;
