<?php if(! defined('ABSPATH')){ return; }

if ( ! defined( 'ABSPATH' ) ) {
	die("Don't call this file directly.");
}

define( 'ZN_WXR_VERSION', '1.2' );

if ( ! class_exists( 'ZnContentExporter' ) ) {
	class ZnContentExporter
	{
		function __construct(){
		}

		function render_page() {
		?>

				<div class="wp-filter">
					<div class="actions">
						<h4>Options : </h4>
						<label class="action">
							<input name="replace_images" checked type="checkbox" value="true"/>
							Replace images url ?
						</label>
					</div>
				</div>


				<div class="znexp-accordion">
				<?php
				// GET ALL ATTACHEMENTS
					$all_post_types = get_post_types();

					$i = 0;
					foreach( $all_post_types as $key => $value ) {

						$posts = $this->get_posts( $value );
						$current_post_type = get_post_type_object( $value );
						if ( !$posts ) continue;

						?>

							<div class="znexp-accordion-header">
								<h4><input type="checkbox" checked class="znxp-toggle-all"/><?php echo $current_post_type->labels->name; ?> ( <?php echo count( $posts ); ?> )</h4>
							</div>
							<div class="znexp-accordion-content clearfix">
								<?php

									if ( $value == 'attachment' ) {


										//print_z( $posts );
										foreach ( $posts as $post ) {

											if ( strpos( $post->post_mime_type, 'image') !== false ) {
												$img = wp_get_attachment_image( $post->ID , 'thumbnail' );
											}
											else {
												$img = '<img src="'. wp_mime_type_icon( $post->post_mime_type ) .'" />';
// 						header('Content-type: image/jpeg');

// // $image = new Imagick(get_attached_file( $post->ID ));

// // $image->blurImage(5,3);
// // echo $image;img2.jpg

											}

											echo '<span class="zn_export_image">';
												echo '<input id="zn_uid_'.$i.'" checked type="checkbox"  name="zn_'.$value.'[]" value="'.$post->ID.'"/>';
												echo '<label for="zn_uid_'.$i.'">'. $img;
													echo '<div class="znexp-image-overlay">';
														echo '<div>';
															echo '<span>'.$post->post_name.'</span>';
															echo '<a target="_blank" href="'.wp_get_attachment_url( $post->ID ).'">View attachment</a>';
														echo '</div>';
													echo '</div>';
												echo '</label>';
											echo '</span>';
											$i++;

										}

									}
									// TODO : Create a nav menu walker to better present the menu
									elseif( $value == 'nav_menu_item' ) {
								// print_z( $posts );
										foreach ($posts as $post) {

											// GET THE PROPER MENU NAME : IF THE MENU ITEM IS ACTUALLY A PAGE WE HAVE TO MAKE A QUERY TO RETRIEVE THAT NAME
											if ( is_numeric($post->post_name ) ) {
												$menu_post_id = get_post_meta( $post->ID, '_menu_item_object_id', true);
											}

											if( !empty( $menu_post_id ) ) {$menu_name = get_the_title( $menu_post_id ); }
											else {$menu_name = $post->post_title; }

											echo '<p>';
												echo '<label for="zn_uid_'.$i.'">';
													echo '<input id="zn_uid_'.$i.'" checked type="checkbox"  name="zn_'.$value.'[]" value="'.$post->ID.'"/>';
													echo $menu_name;
													echo ' ( <a target="_blank" href="'.get_permalink( $post->ID ).'" title="'.$post->post_title.'">view page</a> )';
												echo '</label>';
											echo '</p>';
											$i++;

										}

									}
									else {

										foreach ($posts as $post) {
										 //   setup_postdata($post);

											echo '<p>';
												echo '<label for="zn_uid_'.$i.'">';
													echo '<input id="zn_uid_'.$i.'" checked type="checkbox"  name="zn_'.$value.'[]" value="'.$post->ID.'"/>';
													echo $post->post_title;
													echo ' ( <a target="_blank" href="'.get_permalink( $post->ID ).'" title="'.$post->post_title.'">view page</a> )';
												echo '</label>';
											echo '</p>';
											$i++;

										}

									}
								?>

						</div>
						<?php

					}
						echo '</div>';

					?>

		<?php
		}

		function get_posts( $post_type ){

			$args = array(
				'post_type' => $post_type,
				'numberposts' => -1,
				'post_status' => null, // Can be set to null
				'post_parent' => null, // any parent
				'order'	=> 'ASC',
			);

			// ONLY FOR WOOCOMMERCE
			if( $post_type == 'shop_order' ) { $args['post_status'] = array_keys( wc_get_order_statuses() ); }

			return get_posts($args);

		}

		function do_deploy(){
			$export_xml = fopen( THEME_BASE . '/template_helpers/dummy_content/dummy.xml', 'w' );

			ob_start();
			$this->zn_export_wp();
			$content = ob_get_clean();
			fwrite( $export_xml, $content );

		}

		function do_export(){

			$filename = 'dummy.xml';

			header( 'Content-Description: File Transfer' );
			header( 'Content-Disposition: attachment; filename=' . $filename );
			header( 'Content-Type: text/xml; charset=' . get_option( 'blog_charset' ), true );

			$this->zn_export_wp();
			die();

		}

/**
 * Generates the WXR export file for download
 *
 * @since 2.1.0
 *
 * @param array $args Filters defining what should be included in the export
 */
function zn_export_wp( $args = array() ) {
	global $wpdb, $post;

	$defaults = array(
		'replace_images' => ! empty( $_POST['replace_images'] ),
		'content' => 'all', //old
		'author' => false, //old
		'category' => false,//old
		'start_date' => false, //old
		'end_date' => false, //old
		'status' => false,//old
	);
	$args = wp_parse_args( $args, $defaults );

	$ids = array();

	// BUILD POST ID'S
	$all_post_types = get_post_types();

	// BUILD THE QUERY FOR POSTS
	$where = "1=1";

	foreach ( $all_post_types as $key => $value) {
		if ( !empty( $_POST['zn_'.$value] ) ) {
			$ids = array_merge( $ids, $_POST['zn_'.$value] );
		}
	}


	if ( !empty( $ids ) ) {
		$where .= " AND {$wpdb->posts}.ID IN (" . implode( ',', $ids ) . ')';
	}

	$where .= " AND {$wpdb->posts}.post_status != 'auto-draft'";
	$join = '';

	// grab a snapshot of post IDs, just in case it changes during the export
	$post_ids = $wpdb->get_col( "SELECT ID FROM {$wpdb->posts} $join WHERE $where ORDER BY ID " );

	// get the requested terms ready, empty unless posts filtered by category or all content
	$cats = $tags = $terms = array();
	if ( isset( $term ) && $term ) {
		$cat = get_term( $term['term_id'], 'category' );
		$cats = array( $cat->term_id => $cat );
		unset( $term, $cat );
	} else if ( 'all' == $args['content'] ) {
		$categories = (array) get_categories( array( 'get' => 'all' ) );
		$tags = (array) get_tags( array( 'get' => 'all' ) );

		$custom_taxonomies = get_taxonomies( array( '_builtin' => false ) );
		$custom_terms = (array) get_terms( $custom_taxonomies, array( 'get' => 'all' ) );

		// put categories in order with no child going before its parent
		while ( $cat = array_shift( $categories ) ) {
			if ( $cat->parent == 0 || isset( $cats[$cat->parent] ) )
				$cats[$cat->term_id] = $cat;
			else
				$categories[] = $cat;
		}

		// put terms in order with no child going before its parent
		while ( $t = array_shift( $custom_terms ) ) {
			if ( $t->parent == 0 || isset( $terms[$t->parent] ) )
				$terms[$t->term_id] = $t;
			else
				$custom_terms[] = $t;
		}

		unset( $categories, $custom_taxonomies, $custom_terms );
	}

	/**
	 * Wrap given string in XML CDATA tag.
	 *
	 * @since 2.1.0
	 *
	 * @param string $str String to wrap in XML CDATA tag.
	 * @return string
	 */
	function zn_wxr_cdata( $str ) {
		if ( seems_utf8( $str ) == false )
			$str = utf8_encode( $str );

		// $str = ent2ncr(esc_html($str));
		$str = '<![CDATA[' . str_replace( ']]>', ']]]]><![CDATA[>', $str ) . ']]>';

		return $str;
	}

	/**
	 * Return the URL of the site
	 *
	 * @since 2.5.0
	 *
	 * @return string Site URL.
	 */
	function zn_wxr_site_url() {
		// ms: the base url
		if ( is_multisite() )
			return network_home_url();
		// wp: the blog url
		else
			return get_bloginfo_rss( 'url' );
	}

	/**
	 * Output a cat_name XML tag from a given category object
	 *
	 * @since 2.1.0
	 *
	 * @param object $category Category Object
	 */
	function zn_wxr_cat_name( $category ) {
		if ( empty( $category->name ) )
			return;

		echo '<wp:cat_name>' . zn_wxr_cdata( $category->name ) . '</wp:cat_name>';
	}

	/**
	 * Output a category_description XML tag from a given category object
	 *
	 * @since 2.1.0
	 *
	 * @param object $category Category Object
	 */
	function zn_wxr_category_description( $category ) {
		if ( empty( $category->description ) )
			return;

		echo '<wp:category_description>' . zn_wxr_cdata( $category->description ) . '</wp:category_description>';
	}

	/**
	 * Output a tag_name XML tag from a given tag object
	 *
	 * @since 2.3.0
	 *
	 * @param object $tag Tag Object
	 */
	function zn_wxr_tag_name( $tag ) {
		if ( empty( $tag->name ) )
			return;

		echo '<wp:tag_name>' . zn_wxr_cdata( $tag->name ) . '</wp:tag_name>';
	}

	/**
	 * Output a tag_description XML tag from a given tag object
	 *
	 * @since 2.3.0
	 *
	 * @param object $tag Tag Object
	 */
	function zn_wxr_tag_description( $tag ) {
		if ( empty( $tag->description ) )
			return;

		echo '<wp:tag_description>' . zn_wxr_cdata( $tag->description ) . '</wp:tag_description>';
	}

	/**
	 * Output a term_name XML tag from a given term object
	 *
	 * @since 2.9.0
	 *
	 * @param object $term Term Object
	 */
	function zn_wxr_term_name( $term ) {
		if ( empty( $term->name ) )
			return;

		echo '<wp:term_name>' . zn_wxr_cdata( $term->name ) . '</wp:term_name>';
	}

	/**
	 * Output a term_description XML tag from a given term object
	 *
	 * @since 2.9.0
	 *
	 * @param object $term Term Object
	 */
	function zn_wxr_term_description( $term ) {
		if ( empty( $term->description ) )
			return;

		echo '<wp:term_description>' . zn_wxr_cdata( $term->description ) . '</wp:term_description>';
	}

	/**
	 * Output list of authors with posts
	 *
	 * @since 3.1.0
	 */
	function zn_wxr_authors_list() {
		global $wpdb;

		$authors = array();
		$results = $wpdb->get_results( "SELECT DISTINCT post_author FROM $wpdb->posts WHERE post_status != 'auto-draft'" );
		foreach ( (array) $results as $result )
			$authors[] = get_userdata( $result->post_author );

		$authors = array_filter( $authors );

		foreach ( $authors as $author ) {
			echo "\t<wp:author>";
			echo '<wp:author_id>' . $author->ID . '</wp:author_id>';
			echo '<wp:author_login>' . $author->user_login . '</wp:author_login>';
			echo '<wp:author_email>' . $author->user_email . '</wp:author_email>';
			echo '<wp:author_display_name>' . zn_wxr_cdata( $author->display_name ) . '</wp:author_display_name>';
			echo '<wp:author_first_name>' . zn_wxr_cdata( $author->user_firstname ) . '</wp:author_first_name>';
			echo '<wp:author_last_name>' . zn_wxr_cdata( $author->user_lastname ) . '</wp:author_last_name>';
			echo "</wp:author>\n";
		}
	}

	/**
	 * Ouput all navigation menu terms
	 *
	 * @since 3.1.0
	 */
	function zn_wxr_nav_menu_terms() {
		$nav_menus = wp_get_nav_menus();
		if ( empty( $nav_menus ) || ! is_array( $nav_menus ) )
			return;

		foreach ( $nav_menus as $menu ) {
			echo "\t<wp:term><wp:term_id>{$menu->term_id}</wp:term_id><wp:term_taxonomy>nav_menu</wp:term_taxonomy><wp:term_slug>{$menu->slug}</wp:term_slug>";
			zn_wxr_term_name( $menu );
			echo "</wp:term>\n";
		}
	}

	/**
	 * Output list of taxonomy terms, in XML tag format, associated with a post
	 *
	 * @since 2.3.0
	 */
	function zn_wxr_post_taxonomy() {
		$post = get_post();

		$taxonomies = get_object_taxonomies( $post->post_type );
		if ( empty( $taxonomies ) )
			return;
		$terms = wp_get_object_terms( $post->ID, $taxonomies );

		foreach ( (array) $terms as $term ) {
			echo "\t\t<category domain=\"{$term->taxonomy}\" nicename=\"{$term->slug}\">" . zn_wxr_cdata( $term->name ) . "</category>\n";
		}
	}

	function zn_wxr_filter_postmeta( $return_me, $meta_key ) {
		if ( '_edit_lock' == $meta_key )
			$return_me = true;
		return $return_me;
	}
	add_filter( 'wxr_export_skip_postmeta', 'zn_wxr_filter_postmeta', 10, 2 );

	echo '<?xml version="1.0" encoding="' . get_bloginfo('charset') . "\" ?>\n";

	//print_z( $post_ids );

	?>
<!-- This is a WordPress eXtended RSS file generated by WordPress as an export of your site. -->
<!-- It contains information about your site's posts, pages, comments, categories, and other content. -->
<!-- You may use this file to transfer that content from one site to another. -->
<!-- This file is not intended to serve as a complete backup of your site. -->

<!-- To import this information into a WordPress site follow these steps: -->
<!-- 1. Log in to that site as an administrator. -->
<!-- 2. Go to Tools: Import in the WordPress admin panel. -->
<!-- 3. Install the "WordPress" importer from the list. -->
<!-- 4. Activate & Run Importer. -->
<!-- 5. Upload this file using the form provided on that page. -->
<!-- 6. You will first be asked to map the authors in this export file to users -->
<!--    on the site. For each author, you may choose to map to an -->
<!--    existing user on the site or to create a new user. -->
<!-- 7. WordPress will then import each of the posts, pages, comments, categories, etc. -->
<!--    contained in this file into your site. -->

<?php the_generator( 'export' ); ?>
<rss version="2.0"
	xmlns:excerpt="http://wordpress.org/export/<?php echo ZN_WXR_VERSION ; ?>/excerpt/"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:wp="http://wordpress.org/export/<?php echo ZN_WXR_VERSION ; ?>/"
>

<channel>
	<title><?php bloginfo_rss( 'name' ); ?></title>
	<link><?php bloginfo_rss( 'url' ); ?></link>
	<description><?php bloginfo_rss( 'description' ); ?></description>
	<pubDate><?php echo date( 'D, d M Y H:i:s +0000' ); ?></pubDate>
	<language><?php bloginfo_rss( 'language' ); ?></language>
	<wp:wxr_version><?php echo ZN_WXR_VERSION ; ?></wp:wxr_version>
	<wp:base_site_url><?php echo zn_wxr_site_url(); ?></wp:base_site_url>
	<wp:base_blog_url><?php bloginfo_rss( 'url' ); ?></wp:base_blog_url>

<?php zn_wxr_authors_list(); ?>

<?php foreach ( $cats as $c ) : ?>
	<wp:category><wp:term_id><?php echo $c->term_id ?></wp:term_id><wp:category_nicename><?php echo $c->slug; ?></wp:category_nicename><wp:category_parent><?php echo $c->parent ? $cats[$c->parent]->slug : ''; ?></wp:category_parent><?php zn_wxr_cat_name( $c ); ?><?php zn_wxr_category_description( $c ); ?></wp:category>
<?php endforeach; ?>
<?php foreach ( $tags as $t ) : ?>
	<wp:tag><wp:term_id><?php echo $t->term_id ?></wp:term_id><wp:tag_slug><?php echo $t->slug; ?></wp:tag_slug><?php zn_wxr_tag_name( $t ); ?><?php zn_wxr_tag_description( $t ); ?></wp:tag>
<?php endforeach; ?>
<?php foreach ( $terms as $t ) : ?>
	<wp:term><wp:term_id><?php echo $t->term_id ?></wp:term_id><wp:term_taxonomy><?php echo $t->taxonomy; ?></wp:term_taxonomy><wp:term_slug><?php echo $t->slug; ?></wp:term_slug><wp:term_parent><?php echo $t->parent ? $terms[$t->parent]->slug : ''; ?></wp:term_parent><?php zn_wxr_term_name( $t ); ?><?php zn_wxr_term_description( $t ); ?></wp:term>
<?php endforeach; ?>
<?php if ( 'all' == $args['content'] ) zn_wxr_nav_menu_terms(); ?>

	<?php
	/** This action is documented in wp-includes/feed-rss2.php */
	do_action( 'rss2_head' );
	?>

<?php if ( $post_ids ) {
	global $wp_query;
	$wp_query->in_the_loop = true; // Fake being in the loop.

	// fetch 20 posts at a time rather than loading the entire table into memory
	while ( $next_posts = array_splice( $post_ids, 0, 20 ) ) {
	$where = 'WHERE ID IN (' . join( ',', $next_posts ) . ')';
	$posts = $wpdb->get_results( "SELECT * FROM {$wpdb->posts} $where" );

	// Begin Loop
	foreach ( $posts as $post ) {
		setup_postdata( $post );
		$is_sticky = is_sticky( $post->ID ) ? 1 : 0;

?>
	<item>
		<?php /** This filter is documented in wp-includes/feed.php */ ?>
		<title><?php echo apply_filters( 'the_title_rss', $post->post_title ); ?></title>
		<link><?php the_permalink_rss() ?></link>
		<pubDate><?php echo mysql2date( 'D, d M Y H:i:s +0000', get_post_time( 'Y-m-d H:i:s', true ), false ); ?></pubDate>
		<dc:creator><?php echo zn_wxr_cdata( get_the_author_meta( 'login' ) ); ?></dc:creator>
		<guid isPermaLink="false"><?php

		if ( $post->post_type == 'attachment' && !empty( $args['replace_images']) ) {
			echo str_replace( 'wp-content/uploads/' , 'zn-content/uploads/', esc_url( get_the_guid() ) );
		}
		else {
			the_guid();
		}

		?></guid>
		<description></description>
		<content:encoded><?php
			/**
			 * Filter the post content used for WXR exports.
			 *
			 * @since 2.5.0
			 *
			 * @param string $post_content Content of the current post.
			 */

			echo zn_wxr_cdata( apply_filters( 'the_content_export', $post->post_content ) );
		?></content:encoded>
		<excerpt:encoded><?php
			/**
			 * Filter the post excerpt used for WXR exports.
			 *
			 * @since 2.6.0
			 *
			 * @param string $post_excerpt Excerpt for the current post.
			 */
			echo zn_wxr_cdata( apply_filters( 'the_excerpt_export', $post->post_excerpt ) );
		?></excerpt:encoded>
		<wp:post_id><?php echo $post->ID; ?></wp:post_id>
		<wp:post_date><?php echo $post->post_date; ?></wp:post_date>
		<wp:post_date_gmt><?php echo $post->post_date_gmt; ?></wp:post_date_gmt>
		<wp:comment_status><?php echo $post->comment_status; ?></wp:comment_status>
		<wp:ping_status><?php echo $post->ping_status; ?></wp:ping_status>
		<wp:post_name><?php echo $post->post_name; ?></wp:post_name>
		<wp:status><?php echo $post->post_status; ?></wp:status>
		<wp:post_parent><?php echo $post->post_parent; ?></wp:post_parent>
		<wp:menu_order><?php echo $post->menu_order; ?></wp:menu_order>
		<wp:post_type><?php echo $post->post_type; ?></wp:post_type>
		<wp:post_password><?php echo $post->post_password; ?></wp:post_password>
		<wp:is_sticky><?php echo $is_sticky; ?></wp:is_sticky>
<?php	if ( $post->post_type == 'attachment' ) : ?>
		<wp:attachment_url><?php
			if ( !empty( $args['replace_images']) ) {
				echo str_replace( 'wp-content/uploads/' , 'zn-content/uploads/', wp_get_attachment_url( $post->ID ) );
			}
			else{
				echo wp_get_attachment_url( $post->ID );
			}

		?></wp:attachment_url>
<?php 	endif; ?>
<?php 	zn_wxr_post_taxonomy(); ?>
<?php	$postmeta = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpdb->postmeta WHERE post_id = %d", $post->ID ) );
		foreach ( $postmeta as $meta ) :
			/**
			 * Filter whether to selectively skip post meta used for WXR exports.
			 *
			 * Returning a truthy value to the filter will skip the current meta
			 * object from being exported.
			 *
			 * @since 3.3.0
			 *
			 * @param bool   $skip     Whether to skip the current post meta. Default false.
			 * @param string $meta_key Current meta key.
			 * @param object $meta     Current meta object.
			 */
			if ( apply_filters( 'wxr_export_skip_postmeta', false, $meta->meta_key, $meta ) )
				continue;

			// ZN CHANGE META VALUE FOR THUMBNAIL_ID
			// if ( $meta->meta_key == '_thumbnail_id' ) {
			// 	$meta->meta_value = str_replace( 'wp-content/uploads/' , 'zn-content/uploads/', $meta->meta_value );
			// }

			// REPLACE THE IMAGE URLS IF PERMITTED
			if ( !empty( $args['replace_images']) ) {
				$meta->meta_value = str_replace( 'wp-content/uploads/' , 'zn-content/uploads/', $meta->meta_value );
			}


		?>
		<wp:postmeta>
			<wp:meta_key><?php echo $meta->meta_key; ?></wp:meta_key>
			<wp:meta_value><?php echo zn_wxr_cdata( $meta->meta_value ); ?></wp:meta_value>
		</wp:postmeta>
<?php	endforeach; ?>
<?php	$comments = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_post_ID = %d AND comment_approved <> 'spam'", $post->ID ) );
		foreach ( $comments as $c ) : ?>
		<wp:comment>
			<wp:comment_id><?php echo $c->comment_ID; ?></wp:comment_id>
			<wp:comment_author><?php echo zn_wxr_cdata( $c->comment_author ); ?></wp:comment_author>
			<wp:comment_author_email><?php echo $c->comment_author_email; ?></wp:comment_author_email>
			<wp:comment_author_url><?php echo esc_url_raw( $c->comment_author_url ); ?></wp:comment_author_url>
			<wp:comment_author_IP><?php echo $c->comment_author_IP; ?></wp:comment_author_IP>
			<wp:comment_date><?php echo $c->comment_date; ?></wp:comment_date>
			<wp:comment_date_gmt><?php echo $c->comment_date_gmt; ?></wp:comment_date_gmt>
			<wp:comment_content><?php echo zn_wxr_cdata( $c->comment_content ) ?></wp:comment_content>
			<wp:comment_approved><?php echo $c->comment_approved; ?></wp:comment_approved>
			<wp:comment_type><?php echo $c->comment_type; ?></wp:comment_type>
			<wp:comment_parent><?php echo $c->comment_parent; ?></wp:comment_parent>
			<wp:comment_user_id><?php echo $c->user_id; ?></wp:comment_user_id>
<?php		$c_meta = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpdb->commentmeta WHERE comment_id = %d", $c->comment_ID ) );
			foreach ( $c_meta as $meta ) : ?>
			<wp:commentmeta>
				<wp:meta_key><?php echo $meta->meta_key; ?></wp:meta_key>
				<wp:meta_value><?php echo zn_wxr_cdata( $meta->meta_value ); ?></wp:meta_value>
			</wp:commentmeta>
<?php		endforeach; ?>
		</wp:comment>
<?php	endforeach; ?>
	</item>
<?php
	}
	}
} ?>
</channel>
</rss>
<?php

}




	}


}


?>
