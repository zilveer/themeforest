<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Documentation
 Description: Create and display a Documentation element
 Class: TH_Documentation
 Category: content
 Level: 3
 Scripts: true
*/
/**
 * Class TH_Documentation
 *
 * Create and display a Documentation element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_Documentation extends ZnElements
{
	public static function getName(){
		return __( "Documentation", 'zn_framework' );
	}

	function scripts(){
		wp_enqueue_style( 'documentation-css', THEME_BASE_URI . '/css/pages/documentation.css', array('kallyas-styles'), ZN_FW_VERSION );
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		$categories = get_terms( 'documentation_category', array (
			'orderby'     => 'name',
			'order'       => 'ASC',
			'hide_empty'  => 0,
			'show_count ' => 1
		) );
		$limit = '6';
		if ( ! empty( $options['doc_num_items'] ) ) {
			$limit = $options['doc_num_items'];
		}

		$count = count( $categories );
		$i     = 1;

		foreach ( $categories as $category )
		{
			if ( $i % 2 == 1 ) {
				echo '<div class="row zn_photo_gallery '.$this->data['uid'].' '.zn_get_element_classes($options).'" '.zn_get_element_attributes($options).'>';
			}

			echo '<div class="col-sm-6">';
			echo '<h3><a href="' . get_term_link( $category->slug, 'documentation_category' ) . '">' . $category->name . ' (' . $category->count . ')</a></h3>';

			$args = array (
				'post_type'              => 'documentation',
				'post_status'            => 'publish',
				'posts_per_page'         => $limit,
				'documentation_category' => $category->slug
			);

			$zn_doc = new WP_Query( $args );

			echo '<ol>';

			while ( $zn_doc->have_posts() ): $zn_doc->the_post();

				global $post;

				echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';

			endwhile; // end loop

			wp_reset_postdata();

			echo "</ol>";

			echo '</div>';

			if ( $i % 2 == 0 || $i == $count ) {
				echo '</div>';
			}

			$i ++;
		}
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array (
						"name"        => __( "Number of items", 'zn_framework' ),
						"description" => __( "Please enter the desired number of items that you want to be shown under each category.", 'zn_framework' ),
						"id"          => "doc_num_items",
						"std"         => "6",
						"type"        => "text"
					),
				),
			),


			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#Yl7l2SVgyRU',
				'docs'    => 'http://support.hogash.com/documentation/documentation-header/',
				'copy'    => $uid,
				'general' => true,
			)),

		);

		return $options;

	}
}
