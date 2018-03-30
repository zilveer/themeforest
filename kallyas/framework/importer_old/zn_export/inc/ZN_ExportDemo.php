<?php
// Required when creating the dummy.xml file
define( 'ZN_WXR_VERSION', '1.2' );


/**
 * Base class for adding the theme to the demo archive
 */
class ZN_ExportDemo extends ZN_ExportBase
{
	// Content
	private $_contentOutputFile = 'dummy.xml';

	// Custom Icons
	private $_ciDirName = 'custom_icons';
	private $_ciZipName = 'custom_icons.zip';

	// Theme options
	private $_themeOptionsFileName = 'theme_options.txt';
	/**
	 * Holds the wp_upload_dir() paths
	 * @var array
	 */
	var $_upload_dir_config;

	/**
	 * Holds the uploads directory url
	 * @var string
	 */
	var $_upload_dir_url;

	/**
	 * Holds the uploads directory url without WWW
	 * @var string
	 */
	var $__upload_dir_url_no_www;

	/**
	 * Holds the uploads directory path
	 * @var string
	 */
	var $_upload_dir_path;

	/**
	 * Holds the uploads placeholder used for replacing the uploads urls
	 * @var string
	 */
	var $_site_url_placeholder = 'ZNBP_SITE_URL_PLACEHOLDER';

	/**
	 * Holds the allowed file types on export
	 * @var array
	 */
	var $_allowed_file_types = array(
		'jpg',
		'png',
		'gif',
		'svg',
		'jpeg',
		'txt',
		'woff',
		'ttf',
		'eot',
	);

	// Widgets
	private $_widgetsFileName = 'widgets.txt';


//<editor-fold desc=">>> CLASS INTERNALS">
	public function __construct( $archiveName = '' ){
		parent::__construct($archiveName);
	}
//</editor-fold desc=">>> CLASS INTERNALS">


//<editor-fold desc=">>> CONTENT EXPORT">
	public function exportContent( $zip )
	{
		if(! $this->checkZipInstance($zip)){
			return false;
		}

		ob_start();
		$this->_zn_export_wp();
		$content = ob_get_contents();
		ob_end_clean();

		if(empty($content)){
			$this->addWarning(
				sprintf(__('[%s] An internal error occurred: Content could not be exported.','zn_framework'),__METHOD__)
			);
			return false;
		}

		$zip->addFromString($this->_contentOutputFile, $content);

		$this->addInfo('Added '.$this->_contentOutputFile.'('.strlen($content).' file');

		return (!empty($content));
	}

	/**
	 * Generates the WXR export file for download
	 *
	 * @since 2.1.0
	 *
	 * @param array $args Filters defining what should be included in the export
	 */
	private function _zn_export_wp( $args = array() ) {
		global $wpdb, $post;

		$defaults = array(
			'replace_images' => true,
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

		$where .= " AND {$wpdb->posts}.post_status = 'publish'";
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
								<guid isPermaLink="false"><?php the_guid(); ?></guid>
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
									<wp:attachment_url><?php echo wp_get_attachment_url( $post->ID ); ?></wp:attachment_url>
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
									if ( apply_filters( 'wxr_export_skip_postmeta', false, $meta->meta_key, $meta ) ) {
										continue;
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

//</editor-fold desc=">>> CONTENT EXPORT">


//<editor-fold desc=">>> CUSTOM ICONS EXPORT">
	function exportCustomIcons( $zip )
	{
		if(! $this->checkZipInstance($zip)){
			return false;
		}

		// Add the directory to the archive
		$zip->addEmptyDir( $this->_ciDirName );

		// Get path to the CI directory from inside the archive
		$tmp_icons_folders = array();

		$upload_dir = wp_upload_dir();
		$icons_folders = trailingslashit($upload_dir['basedir']) . 'zn_fonts';
		if(! is_dir($icons_folders)){
			$this->addInfo(
				sprintf('[%s] No icons found inside %s directory. Skipping adding custom icons. ',
					get_class(),$icons_folders)
			);
			return true;
		}
		if(! is_readable($icons_folders)) {
			$this->addWarning(
				sprintf( __( '[%s] The icons directory (%s) is not accessible. Check for permissions.', 'zn_framework'),
					get_class(), $icons_folders )
			);
			// no need to continue beyond this point
			return true;
		}
		$dirs = array_filter(glob($icons_folders.'/*'), 'is_dir');
		if(empty($dirs)){
			// Nothing to do
			return true;
		}

		foreach( $dirs as $dir )
		{
			// We can't actually do anything at this point. Set permissions and try again.
			if(! is_readable($dir) && !chmod($dir, 755)){
				$this->addWarning(
					sprintf(__('[%s] Directory (%s) is not accessible. Check permissions.', 'zn_framework'),
						get_class(), $dir)
				);
				continue;
			}

			$files = new RecursiveIteratorIterator(
				new RecursiveDirectoryIterator($dir),
				RecursiveIteratorIterator::LEAVES_ONLY
			);

			$icon_name = basename($dir);
			$file_path = $upload_dir['basedir'] . DIRECTORY_SEPARATOR  . $icon_name.'.zip';
			$nzip = new ZipArchive();
			$nzip->open($file_path, ZIPARCHIVE::CREATE );
			foreach ($files as $name => $file)
			{
				// Skip directories (they would be added automatically)
				if (!$file->isDir())
				{
					// Get real and relative path for current file
					$filePath = $file->getRealPath();
					$relativePath = substr($filePath, strlen($icons_folders) + 1);

					// Add current file to archive
					$nzip->addFile($filePath, $relativePath);
				}
			}
			$nzip->close();
			$tmp_icons_folders[] = $file_path;
			$zip->addFromString($this->_ciDirName."/{$icon_name}.zip", file_get_contents($file_path));
		}

		// try to cleanup
		foreach( $tmp_icons_folders as $tmp_zip ){
			@unlink($tmp_zip);
		}
$this->addInfo('Custom Icons added');
		// all good
		return true;
	}
//</editor-fold desc=">>> CUSTOM ICONS EXPORT">


//<editor-fold desc=">>> THEME OPTIONS EXPORT">
	public function exportThemeOptions( $zip )
	{
		if(! $this->checkZipInstance($zip)){
			return false;
		}

		$content = $this->_buildThemeOptionsJson();
		if(empty($content)){
			$this->addError(
				sprintf(__('[%s] An error occurred while attempting to retrieve the theme options.','zn_framework'),
					get_class())
			);
			return false;
		}

		// Try to add the file
		$zip->addFromString($this->_themeOptionsFileName, $content);

		$this->addInfo('Theme options added. '.$this->_themeOptionsFileName.'('.strlen($content).')');
		return (! empty($content));
	}

	private function _buildThemeOptionsJson(){

		$this->_upload_dir_config = wp_upload_dir();
		$this->_upload_dir_path = $this->_upload_dir_config['basedir'];
		$this->_upload_dir_url = $this->_upload_dir_config['baseurl'];
		$this->__upload_dir_url_no_www = str_replace('www.', '', $this->_upload_dir_url );


		$options = $this->_get_all_options();
		$options = $this->_zpbp_parse_recursive_export( $options );
		return json_encode($options);

	}

	private function _zpbp_parse_recursive_export( &$export_config ){

		if( empty( $export_config ) ) return $export_config;

		if ( is_array( $export_config ) ){
			foreach ($export_config as $key => &$value) {
				if ( empty( $value ) ) continue;

				if( is_array( $value ) ){
					$this->_zpbp_parse_recursive_export( $value );
				}
				else{
					// Check if this is exportable media
					$value = $this->_znpb_extract_image( $value );
				}
			}
		}
		else{
			// This should be a string
			$export_config = $this->_znpb_extract_image( $export_config );
		}

		return $export_config;
	}

	/**
	 * This function checks to see if we have an exportable media and if so, it will add it to the zip file
	 * @param string $url
	 * @return string
	 */
	private function _znpb_extract_image( $url ){

		$file_types = implode('|', $this->_allowed_file_types);
		$pattern = "#https?://[^/\s]+/\S+\.($file_types)#";
		$url = preg_replace_callback( $pattern, array( $this, '_media_callback' ), $url );

		return $url;
	}

	/**
	 * This function adds the media file to the zip archive and replaces the uploads directory path with a placeholder path that we cann replace on import
	 * @param  array $file The preg_replace match
	 * @return string The modified file url
	 */
	public function _media_callback($file){

		// Check to see if this is a local file or not
		if( strpos($file[0], $this->_upload_dir_url) !== false || strpos($file[0], $this->__upload_dir_url_no_www) !== false ){
			// Get the media file path relative to the uploads folder
			$file_path = str_replace(array($this->_upload_dir_url, $this->__upload_dir_url_no_www), '', $file[0]);
			return $this->_site_url_placeholder . $file_path;
		}

		return $file[0];
	}

	// Make this function to pass trough all the options and skipe the 'skip_export' ones
	private function _get_all_options(){
		$options = zget_option(false,false,true);

		unset($options['general_options']['mailchimp_api']);
		unset($options['general_options']['google_analytics']);

		return $options;
	}

//</editor-fold desc=">>> THEME OPTIONS EXPORT">


//<editor-fold desc=">>> WIDGETS EXPORT">
	public function exportWidgets( $zip )
	{
		if(! $this->checkZipInstance($zip)){
			return false;
		}

		$content = $this->_buildWidgetsJson();
		if(empty($content)){
			$this->addError(
				sprintf('[%s] An error occurred while attempting to retrieve the widgets.',__METHOD__)
			);
			return false;
		}

		// Try to add the file
		$zip->addFromString($this->_widgetsFileName, $content);

		$this->addInfo('Widgets added. '.$this->_widgetsFileName.'('.strlen($content).')');
		return (! empty($content));
	}

	private function _getAllWidgets() {
		global $wp_registered_widget_controls;

		$widget_controls = $wp_registered_widget_controls;

		$available_widgets = array();

		foreach ( $widget_controls as $widget ) {

			if ( ! empty( $widget['id_base'] ) && ! isset( $available_widgets[$widget['id_base']] ) ) { // no dupes

				$available_widgets[$widget['id_base']]['id_base'] = $widget['id_base'];
				$available_widgets[$widget['id_base']]['name'] = $widget['name'];

			}

		}

		return $available_widgets;

	}

	private function _buildWidgetsJson(){
		// Get all available widgets site supports
		$available_widgets = $this->_getAllWidgets();

		// Get all widget instances for each widget
		$widget_instances = array();
		foreach ( $available_widgets as $widget_data ) {

			// Get all instances for this ID base
			$instances = get_option( 'widget_' . $widget_data['id_base'] );

			// Have instances
			if ( ! empty( $instances ) ) {

				// Loop instances
				foreach ( $instances as $instance_id => $instance_data ) {

					// Key is ID (not _multiwidget)
					if ( is_numeric( $instance_id ) ) {
						$unique_instance_id = $widget_data['id_base'] . '-' . $instance_id;
						$widget_instances[$unique_instance_id] = $instance_data;
					}

				}

			}

		}

		// Gather sidebars with their widget instances
		$sidebars_widgets = get_option( 'sidebars_widgets' ); // get sidebars and their unique widgets IDs
		$sidebars_widget_instances = array();
		foreach ( $sidebars_widgets as $sidebar_id => $widget_ids ) {

			// Skip inactive widgets
			if ( 'wp_inactive_widgets' == $sidebar_id ) {
				continue;
			}

			// Skip if no data or not an array (array_version)
			if ( ! is_array( $widget_ids ) || empty( $widget_ids ) ) {
				continue;
			}

			// Loop widget IDs for this sidebar
			foreach ( $widget_ids as $widget_id ) {

				// Is there an instance for this widget ID?
				if ( isset( $widget_instances[$widget_id] ) ) {

					// Add to array
					$sidebars_widget_instances[$sidebar_id][$widget_id] = $widget_instances[$widget_id];

				}

			}

		}

		// Replace image id's
		if ( 1==1 ) {
			$sidebars_widget_instances = $this->_replaceImagesDeep($sidebars_widget_instances);
		}

		// Encode the data for file contents
		return json_encode( $sidebars_widget_instances );

	}

	private function _replaceImagesDeep( $array ){
		if ( ! is_array(  $array ) ) {
			return $array;
		}

		$new_array = array();

		foreach( $array as $key => $value ){
			$new_array[$key] = $this->_replaceImagesDeep( $value );
		}

		return $new_array;
	}

//</editor-fold desc=">>> WIDGETS EXPORT">


//<editor-fold desc=">>> GENERAL METHODS">
	function exportThemeScreenshot( $zip )
	{
		if(! $this->checkZipInstance($zip)){
			return false;
		}

		$theme = wp_get_theme();
		if(is_object($theme))
		{
			$imagePath = $theme->get_screenshot();
			if(empty($imagePath)){
				$this->addWarning(
					sprintf('[%s] This theme does not have a screenshot file. Skipping adding the theme screenshot', get_class())
				);
				return true;
			}
			$imgName = basename($imagePath);

			$zip->addFromString($imgName, file_get_contents($imagePath));
			$this->addInfo('Theme screenshot added');
			return true;
		}

		$this->addWarning(
			sprintf('[%s] Could not retrieve the current theme info. Skipping adding the theme screenshot', get_class())
		);
		return true;
	}

	function exportDemoConfigFile( $zip )
	{
		if(! $this->checkZipInstance($zip)){
			return false;
		}
		$str = '<?php'.PHP_EOL;
		$str .= '/**'.PHP_EOL;
		$str .= ' * Update the homepage'.PHP_EOL;
		$str .= ' */'.PHP_EOL;
		$str .= '$homepage = get_page_by_title( "Homepage" );'.PHP_EOL;
		$str .= 'if(isset( $homepage ) && $homepage->ID) :'.PHP_EOL;
		$str .= "\t".'update_option("show_on_front", "page"); /* Set to static front page */'.PHP_EOL;
		$str .= "\t".'update_option("page_on_front", $homepage->ID); /* Front Page */'.PHP_EOL;
		$str .= 'endif;'.PHP_EOL;

		$zip->addFromString('dummy_config.php', $str);

		$this->addInfo('Added demo config file');

		return true;
	}
//</editor-fold desc=">>> GENERAL METHODS">

}
