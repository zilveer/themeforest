<?php
/** Blueprint
  *
  * The blueprint is the theme framrwork's utility for generating
  * consistent and reliable pages. It is used to display common
  * elements for all pages (title, featured image, comments) and
  * it determines which specific content it needs to include.
  *
  * It also handles sidebar details and other display specific
  * things.
  *
  * @package The Beauty Salon
  *
  */


get_header();

if( !empty( $framework->options['frontpage_postlist'] ) AND is_numeric($framework->options['frontpage_postlist'] ) AND is_home()  ) {
	$list = get_post( $framework->options['frontpage_postlist'] );
	query_posts( array(
		'page' => '',
		'eb_product_list' => $list->post_name,
		'post_type' => 'eb_product_list',
		'name' => $list->post_name,
	));
}


$no_sidebar = array( 'eb_product_list' );
global $blueprint, $wp_query;
	if( have_posts() AND !is_archive() AND !is_search() AND !is_home() ) {
		while ( have_posts() ) { the_post(); $blueprint->add_data(); $blueprint->master_page = $post;
			$sidebar_class = ( $blueprint->has_sidebar() == true ) ? 'has-sidebar' : 'no-sidebar';

			echo '<div class="row blueprint ' . $blueprint->get_sidebar_position() . ' ' . $sidebar_class . '" id="' . $blueprint->blueprint_template( 'name' ) . '">';
			if( $blueprint->blueprint_has_header() ) {
				echo '<div class="row"><div class="twelvecol">';

					echo '<div class="blueprint-header">';

						if( $framework->has_element('show_breadcrumb') ) {
							echo '<div class="breadcrumb indent left right">';
								echo tbs_get_breadcrumbs();
							echo '</div>';
						}

						if( $blueprint->has_title() ) {
							echo '<div class="page-title indent left right">' . tbs_get_page_title(). '</div>';
						}
					echo '</div>';

					if( $blueprint->has_thumbnail() AND !is_singular( array( 'post', 'eb_product' ) ) ) {
						echo '<div class="page-image featured-image">';
						the_post_thumbnail( 'rf_col_1', array( 'container_class' => 'box smallpadding' ) );
						echo '</div>';
					}

					if( $blueprint->has_post_content() AND !in_array( $framework->get_post_type(), array( 'post', 'page', 'eb_product' ) ) ) {
						echo '<div class="page-content indent left right">';
						the_content();
						echo '</div>';
					}

				echo '</div></div>';
			}

			echo '<div class="row">';
				$blueprint->blueprint_content( $no_sidebar );
			echo "</div>";


		}

		echo '</div>';

	}
	elseif( have_posts() AND ( is_archive() OR is_search() OR is_home() ) ) {
		echo '<div class="row blueprint">';

			echo '<div class="blueprint-header">';

				if( $framework->has_element('show_breadcrumb') ) {
					echo '<div class="breadcrumb indent left right">';
						echo tbs_get_breadcrumbs();
					echo '</div>';
				}

				if( $blueprint->has_title() ) {
					echo '<div class="page-title indent left right">' . tbs_get_page_title(). '</div>';
				}
			echo '</div>';

			$blueprint->blueprint_content();

		echo '</div>';
	}
	else {
		$blueprint->show_no_posts();
	}

get_footer();

?>
