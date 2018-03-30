<?php
/*-----------------------------------------------------------------------------------*/
/*	Add Metaboxes
/*-----------------------------------------------------------------------------------*/

add_action( 'load-post.php', 'fave_meta_boxes_setup' );
add_action( 'load-post-new.php', 'fave_meta_boxes_setup' );

/* Meta box setup function. */
if ( !function_exists( 'fave_meta_boxes_setup' ) ) :
	function fave_meta_boxes_setup() {
		global $typenow;
		if ( $typenow == 'page' ) {
			add_action( 'add_meta_boxes', 'fave_load_page_metaboxes' );
			add_action( 'save_post', 'fave_save_page_metaboxes', 10, 2 );
		}

		if ( $typenow == 'post' ) {
			add_action( 'add_meta_boxes', 'fave_load_post_metaboxes' );
			add_action( 'save_post', 'fave_save_post_metaboxes', 10, 2 );
		}

		if ( $typenow == 'video' ) {
			add_action( 'add_meta_boxes', 'fave_load_video_metaboxes' );
			add_action( 'save_post', 'fave_save_video_metaboxes', 10, 2 );
		}

		if ( $typenow == 'gallery' ) {
			add_action( 'add_meta_boxes', 'fave_load_gallery_metaboxes' );
			add_action( 'save_post', 'fave_save_gallery_metaboxes', 10, 2 );
		}
	}
endif;

/* Add page metaboxes */
if ( !function_exists( 'fave_load_page_metaboxes' ) ) :
	function fave_load_page_metaboxes() {

		/* Sidebar metabox */
		add_meta_box(
			'fave_default_sidebar',
			__( 'Sidebar', 'magzilla' ),
			'fave_sidebar_metabox',
			'page',
			'side',
			'default'
		);

		add_meta_box(
			'fave_homepage_latest_articles',
			__( 'Homepage Latest Articles', 'magzilla' ),
			'fave_homepage_latest_artical_metabox',
			'page',
			'normal',
			'high'
		);

		add_meta_box(
			'fave_homepage_loop_filter',
			__( 'Homepage Filter', 'magzilla' ),
			'fave_homepage_loop_filter_metabox',
			'page',
			'normal',
			'high'
		);


	}
endif;


/* Add post metaboxes */
if ( !function_exists( 'fave_load_post_metaboxes' ) ) :
	function fave_load_post_metaboxes() {

		add_meta_box(
			'fave_post_settings',
			__( 'Post Settings', 'magzilla' ),
			'fave_post_settings_metabox',
			'post',
			'normal',
			'high'
		);

	}
endif;


/* Add video post type metaboxes */

if ( !function_exists( 'fave_load_video_metaboxes' ) ) :
	function fave_load_video_metaboxes() {

		/* Sidebar metabox */
		add_meta_box(
			'fave_video_posttype',
			__( 'Video Template Options', 'magzilla' ),
			'fave_video_post_type_metabox',
			'video',
			'normal',
			'high'
		);

}
endif;


/* Add gallery post type metaboxes */

if ( !function_exists( 'fave_load_gallery_metaboxes' ) ) :
	function fave_load_gallery_metaboxes() {

		/* Sidebar metabox */
		add_meta_box(
			'fave_gallery_posttype',
			__( 'Gallery Post Options', 'magzilla' ),
			'fave_gallery_post_type_metabox',
			'gallery',
			'normal',
			'high'
		);

}
endif;


/* ======================================================================================
*	Page Sidebar Metabox
* ======================================================================================= */
if ( !function_exists( 'fave_sidebar_metabox' ) ) :
	function fave_sidebar_metabox( $object, $box ) {
		$fave_meta = fave_get_post_meta( $object->ID );
		$sidebars_lay = fave_get_sidebar_layouts();
		$sidebars = fave_get_sidebars_list();
?>
	  	<ul class="fave-img-select-wrap">
	  	<?php foreach ( $sidebars_lay as $id => $layout ): ?>
	  		<li>
	  			<?php $selected_class = $id == $fave_meta['fave_use_sidebar'] ? ' selected': ''; ?>
	  			<img src="<?php echo $layout['img']; ?>" title="<?php echo $layout['title']; ?>" class="fave-img-select<?php echo $selected_class; ?>">
	  			<span><?php echo $layout['title']; ?></span>
	  			<input type="radio" class="fave-hidden" name="fave[fave_use_sidebar]" value="<?php echo $id; ?>" <?php checked( $id, $fave_meta['fave_use_sidebar'] );?>/> </label>
	  		</li>
	  	<?php endforeach; ?>
	   </ul>

	   <p class="description"><?php _e( 'Sidebar layout', 'magzilla' ); ?></p>

	  <?php if ( !empty( $sidebars ) ): ?>

	  <ul class="next-hide">
	  	<p><select name="fave[fave_sidebar]" class="widefat">
			    <option value=""><?php _e( 'None', 'magzilla' ); ?></option>
	  	<?php foreach ( $sidebars as $id => $name ): ?>
	  		<option value="<?php echo $id; ?>" <?php selected( $id, $fave_meta['fave_sidebar'] );?>><?php echo $name; ?></option>
	  	<?php endforeach; ?>
	  </select></p>

	</ul>
	  <?php endif; ?>
	  <?php
	}
endif;

/* ======================================================================================
*	Homepage Latest Articles
* ======================================================================================= */

if ( !function_exists( 'fave_homepage_latest_artical_metabox' ) ) :
	function fave_homepage_latest_artical_metabox( $object, $box ) {
		$fave_meta = fave_get_post_meta( $object->ID );
		$sidebars_lay = fave_get_sidebar_layouts();
		$post_layouts = fave_get_blog_layouts( true );
		$sidebars = fave_get_sidebars_list();
?>
	  	
	  	
	   

	   <div class="favethemes_meta_control">
	   		<p class="fave-inline-title-wrap"><span class="fave_meta_title"><?php _e( 'Sidebar Position:', 'magzilla' ); ?></span></p>
	   		<div class="fave-inline-block-wrap">
			  	<ul class="fave-img-select-wrap">
			  	<?php foreach ( $sidebars_lay as $id => $layout ): ?>
			  		<li>
			  			<?php $selected_class = $id == $fave_meta['fave_article_list_use_sidebar'] ? ' selected': ''; ?>
			  			<img src="<?php echo $layout['img']; ?>" title="<?php echo $layout['title']; ?>" class="fave-img-select<?php echo $selected_class; ?>">
			  			<span><?php //echo $layout['title']; ?></span>
			  			<input type="radio" class="fave-hidden" name="fave[fave_article_list_use_sidebar]" value="<?php echo $id; ?>" <?php checked( $id, $fave_meta['fave_article_list_use_sidebar'] );?>/> </label>
			  		</li>
			  	<?php endforeach; ?>
			   </ul>
		   </div>
	   </div>

	  <?php if ( !empty( $sidebars ) ): ?>

	  <div class="favethemes_meta_control custom_sidebar_js">  
	  	<p class="fave-inline-block-wrap"><span class="fave_meta_title"><?php _e( 'Custom Sidebar:', 'magzilla' ); ?></span></p>
		<div class="fave-inline-block-wrap">
			<ul class="next-hide">
			  	<p><select name="fave[fave_article_list_sidebar]" class="fave-dropdown widefat">
					    <option value=""><?php _e( 'None', 'magzilla' ); ?></option>
			  	<?php foreach ( $sidebars as $id => $name ): ?>
			  		<option value="<?php echo $id; ?>" <?php selected( $id, $fave_meta['fave_article_list_sidebar'] );?>><?php echo $name; ?></option>
			  	<?php endforeach; ?>
			  </select></p>
			</ul>
		</div>
	</div>
	<?php endif; ?>

	<div class="favethemes_meta_control">
   		<p class="fave-inline-title-wrap"><span class="fave_meta_title"><?php _e( 'Page Template:', 'magzilla' ); ?></span></p>
   		<div class="fave-inline-block-wrap">
		  	<ul class="fave-img-select-wrap">
		  	<?php foreach ( $post_layouts as $id => $layout ): ?>
		  		<li>
		  			<?php $selected_class = $id == $fave_meta['articles_layout'] ? ' selected': ''; ?>
		  			<img src="<?php echo $layout['img']; ?>" title="<?php echo $layout['title']; ?>" class="fave-img-select<?php echo $selected_class; ?>">
		  			<span><?php //echo $layout['title']; ?></span>
		  			<input type="radio" class="fave-hidden" name="fave[articles_layout]" value="<?php echo $id; ?>" <?php checked( $id, $fave_meta['articles_layout'] );?>/> </label>
		  		</li>
		  	<?php endforeach; ?>
		   </ul>
	   </div>
   </div>

   <div class="favethemes_meta_control">  
	  	<p class="fave-inline-block-wrap"><span class="fave_meta_title"><?php _e( 'Show Title:', 'magzilla' ); ?></span></p>
		<div class="fave-inline-block-wrap">
			<ul>
			  	<p><select name="fave[blog_title]" class="fave-dropdown widefat">
			  	
			  		<option value="show-title" <?php selected( 'show-title', $fave_meta['blog_title'] );?>><?php _e('Show Title', 'magzilla'); ?></option>
			  		<option value="hide-title" <?php selected( 'hide-title', $fave_meta['blog_title'] );?>><?php _e('Hide Title', 'magzilla'); ?></option>
			  	
			  </select></p>
			</ul>
		</div>
		<p class="fave-inline-block-wrap fave-meta-des"><?php _e( '- Enable/Disbale listing title', 'magzilla' ); ?></p>
	</div>

	<div class="favethemes_meta_control">  
	  	<p class="fave-inline-block-wrap"><span class="fave_meta_title"><?php _e( 'Title:', 'magzilla' ); ?></span></p>
		<div class="fave-inline-block-wrap">
			<input class="fave-input-text-backend-small" type="text" name="fave[custom_title]" value="<?php echo $fave_meta['custom_title']; ?>" />
		</div>
		<p class="fave-inline-block-wrap fave-meta-des"><?php _e( '- Custom title for article list section', 'magzilla' ); ?></p>
	</div>

	<div class="favethemes_meta_control">
		<label for="Color"><?php _e( 'Title Background Color', 'magzilla'); ?></label><br/>
		<div id="fave_color_wrap">
			<p>
				<input name="fave[title_bg_color]" type="text" class="fave_colorpicker" value="<?php echo $fave_meta['title_bg_color']; ?>" data-default-color="<?php echo $fave_meta['title_bg_color']; ?>"/>
			</p>
		</div>
	</div>

	<div class="favethemes_meta_control">
		<label for="Color"><?php _e( 'Title Text Color', 'magzilla'); ?></label><br/>
		<div id="fave_color_wrap">
			<p>
				<input name="fave[title_text_color]" type="text" class="fave_colorpicker" value="<?php echo $fave_meta['title_text_color']; ?>" data-default-color="<?php echo $fave_meta['title_text_color']; ?>"/>
			</p>
		</div>
	</div>

	<div class="favethemes_meta_control">
		<label for="Color"><?php _e( 'Title Border Top Color', 'magzilla'); ?></label><br/>
		<div id="fave_color_wrap">
			<p>
				<input name="fave[title_border_color]" type="text" class="fave_colorpicker" value="<?php echo $fave_meta['title_border_color']; ?>" data-default-color="<?php echo $fave_meta['title_border_color']; ?>"/>
			</p>
		</div>
	</div>


<?php
	}
endif;


/* ======================================================================================
*	Homepage Latest Articles
* ======================================================================================= */

if ( !function_exists( 'fave_homepage_loop_filter_metabox' ) ) :
	function fave_homepage_loop_filter_metabox( $object, $box ) {
		$fave_meta = fave_get_post_meta( $object->ID );
		$categories = fave_get_category_id_array( true );
		$sort = fave_get_sort();
		$author_filter = fave_create_array_authors();

?>
	  	
	  	
	  <?php if ( !empty( $categories ) ): ?>
	  <div class="favethemes_meta_control">  
	  	<p class="fave-inline-block-wrap"><span class="fave_meta_title"><?php _e( 'Category Filter:', 'magzilla' ); ?></span></p>
		<div class="fave-inline-block-wrap">
			<ul class="next-hide">
			  	<p><select name="fave[category_id]" class="fave-dropdown widefat">
			  	<?php foreach ( $categories as $name => $id ): ?>
			  		<option value="<?php echo $id; ?>" <?php selected( $id, $fave_meta['category_id'] );?>><?php echo $name; ?></option>
			  	<?php endforeach; ?>
			  </select></p>
			</ul>
		</div>
	</div>
	<?php endif; ?>

	<div class="favethemes_meta_control">  
	  	<p class="fave-inline-block-wrap"><span class="fave_meta_title"><?php _e( 'Multiple categories filter:', 'magzilla' ); ?></span></p>
		<div class="fave-inline-block-wrap">
			<input class="fave-input-text-backend-small" type="text" name="fave[category_ids]" value="<?php echo $fave_meta['category_ids']; ?>" />
		</div>
		<p class="fave-inline-block-wrap fave-meta-des"><?php _e( '- To filter multiple categories, enter here the category IDs separated by commas (example: 3,7,15)', 'magzilla' ); ?></p>
	</div>

	<div class="favethemes_meta_control">  
	  	<p class="fave-inline-block-wrap"><span class="fave_meta_title"><?php _e( 'Filter by tag slug:', 'magzilla' ); ?></span></p>
		<div class="fave-inline-block-wrap">
			<input class="fave-input-text-backend-small" type="text" name="fave[tag_slug]" value="<?php echo $fave_meta['tag_slug']; ?>" />
		</div>
		<p class="fave-inline-block-wrap fave-meta-des"><?php _e( '- To filter multiple tag slug, enter here the tag slugs separated by commas (example: tag1,tag2,tag3)', 'magzilla' ); ?></p>
	</div>

	<?php if ( !empty( $sort ) ): ?>
	  <div class="favethemes_meta_control">  
	  	<p class="fave-inline-block-wrap"><span class="fave_meta_title"><?php _e( 'Sort Order:', 'magzilla' ); ?></span></p>
		<div class="fave-inline-block-wrap">
			<ul>
			  	<p><select name="fave[sort]" class="fave-dropdown widefat">
			  	<?php foreach ( $sort as $val => $title ): ?>
			  		<option value="<?php echo $val; ?>" <?php selected( $val, $fave_meta['sort'] );?>><?php echo $title['title']; ?></option>
			  	<?php endforeach; ?>
			  </select></p>
			</ul>
		</div>
	</div>
	<?php endif; ?>

	<?php if ( !empty( $author_filter ) ): ?>
	  <div class="favethemes_meta_control">  
	  	<p class="fave-inline-block-wrap"><span class="fave_meta_title"><?php _e( 'Author Filter:', 'magzilla' ); ?></span></p>
		<div class="fave-inline-block-wrap">
			<ul class="next-hide">
			  	<p><select name="fave[autors_id]" class="fave-dropdown widefat">
			  	<?php foreach ( $author_filter as $name => $id ): ?>
			  		<option value="<?php echo $id; ?>" <?php selected( $id, $fave_meta['autors_id'] );?>><?php echo $name; ?></option>
			  	<?php endforeach; ?>
			  </select></p>
			</ul>
		</div>
	</div>
	<?php endif; ?>

	
	 <div class="favethemes_meta_control">  
	  	<p class="fave-inline-block-wrap"><span class="fave_meta_title"><?php _e( 'Featured Posts:', 'magzilla' ); ?></span></p>
		<div class="fave-inline-block-wrap">
			<ul class="next-hide">
			  	<p><select name="fave[featured_posts]" class="fave-dropdown widefat">
			  	
			  	<option value="" <?php selected( '', $fave_meta['featured_posts'] );?>><?php _e( '- Any -', 'magzilla' ); ?></option>
			  	<option value="no" <?php selected( 'no', $fave_meta['featured_posts'] );?>><?php _e( 'Exclude', 'magzilla' ); ?></option>
			  	<option value="yes" <?php selected( 'yes', $fave_meta['featured_posts'] );?>><?php _e( 'Include', 'magzilla' ); ?></option>
			  	
			  </select></p>
			</ul>
		</div>
		<p class="fave-inline-block-wrap fave-meta-des"><?php _e( '- You can make a post featured by clicking featured post checkbox while add/edit post', 'magzilla' ); ?></p>
	</div>

	<div class="favethemes_meta_control">  
	  	<p class="fave-inline-block-wrap"><span class="fave_meta_title"><?php _e( 'Posts Per Page:', 'magzilla' ); ?></span></p>
		<div class="fave-inline-block-wrap">
			<input class="fave-input-text-backend-small" type="text" name="fave[posts_limit]" value="<?php echo $fave_meta['posts_limit']; ?>" />
		</div>
		<p class="fave-inline-block-wrap fave-meta-des"><?php _e( ' - ex: 8; a integer number, used to display the number of posts per page', 'magzilla' ); ?></p>
	</div>

	<div class="favethemes_meta_control">  
	  	<p class="fave-inline-block-wrap"><span class="fave_meta_title"><?php _e( 'Offset Posts:', 'magzilla' ); ?></span></p>
		<div class="fave-inline-block-wrap">
			<input class="fave-input-text-backend-small" type="text" name="fave[offset]" value="<?php echo $fave_meta['offset']; ?>" />
		</div>
		
	</div>

	<div class="favethemes_meta_control">  
	  	<p class="fave-inline-block-wrap"><span class="fave_meta_title"><?php _e( 'Posts Excerpt:', 'magzilla' ); ?></span></p>
		<div class="fave-inline-block-wrap">
			<ul>
			  	<p><select name="fave[posts_excerpt]" class="fave-dropdown widefat">
			  
			  	<option value="enable" <?php selected( 'enable', $fave_meta['posts_excerpt'] );?>><?php _e( 'Enable', 'magzilla' ); ?></option>
			  	<option value="disable" <?php selected( 'disable', $fave_meta['posts_excerpt'] );?>><?php _e( 'Disbale', 'magzilla' ); ?></option>
			  </select></p>
			</ul>
		</div>
	</div>

	<div class="favethemes_meta_control">  
	  	<p class="fave-inline-block-wrap"><span class="fave_meta_title"><?php _e( 'Pagination Style:', 'magzilla' ); ?></span></p>
		<div class="fave-inline-block-wrap">
			<ul>
			  	<p><select name="fave[pagination_style]" class="fave-dropdown widefat">
			  	
			  	<option value="" <?php selected( '', $fave_meta['pagination_style'] );?>><?php _e( '- No -', 'magzilla' ); ?></option>
			  	<option value="numeric" <?php selected( 'numeric', $fave_meta['pagination_style'] );?>><?php _e( 'Numeric', 'magzilla' ); ?></option>
			  	<option value="prev-next" <?php selected( 'prev-next', $fave_meta['pagination_style'] );?>><?php _e( 'Prev/Next page links', 'magzilla' ); ?></option>
			  	<option value="load-more" <?php selected( 'load-more', $fave_meta['pagination_style'] );?>><?php _e( 'Load More Button', 'magzilla' ); ?></option>
			  	<!-- <option value="infinite-scroll" <?php selected( 'infinite-scroll', $fave_meta['pagination_style'] );?>><?php _e( 'Infinite Scroll', 'magzilla' ); ?></option> -->
			  	
			  </select></p>
			</ul>
		</div>
	</div>
	

<?php
	}
endif;


/* Save Page Meta */
if ( !function_exists( 'fave_save_page_metaboxes' ) ) :
	function fave_save_page_metaboxes( $post_id, $post ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

		if ( isset( $_POST['fave_page_nonce'] ) ) {
			if ( !wp_verify_nonce( $_POST['fave_page_nonce'], __FILE__  ) )
				return;
		}

		if ( $post->post_type == 'page' && isset( $_POST['fave'] ) ) {
			$post_type = get_post_type_object( $post->post_type );
			if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
				return $post_id;

			$fave_meta = array();

			$fave_meta['fave_use_sidebar'] = isset( $_POST['fave']['fave_use_sidebar'] ) ? $_POST['fave']['fave_use_sidebar'] : 0;
			$fave_meta['fave_sidebar'] = isset( $_POST['fave']['fave_sidebar'] ) ? $_POST['fave']['fave_sidebar'] : 0;

			$fave_meta['fave_article_list_use_sidebar'] = isset( $_POST['fave']['fave_article_list_use_sidebar'] ) ? $_POST['fave']['fave_article_list_use_sidebar'] : 0;
			$fave_meta['fave_article_list_sidebar'] = isset( $_POST['fave']['fave_article_list_sidebar'] ) ? $_POST['fave']['fave_article_list_sidebar'] : 0;
			$fave_meta['articles_layout'] = isset( $_POST['fave']['articles_layout'] ) ? $_POST['fave']['articles_layout'] : 0;
			$fave_meta['blog_title'] = isset( $_POST['fave']['blog_title'] ) ? $_POST['fave']['blog_title'] : 0;
			$fave_meta['custom_title'] = isset( $_POST['fave']['custom_title'] ) ? $_POST['fave']['custom_title'] : 0;
			$fave_meta['title_bg_color'] = isset( $_POST['fave']['title_bg_color'] ) ? $_POST['fave']['title_bg_color'] : '';
			$fave_meta['title_text_color'] = isset( $_POST['fave']['title_text_color'] ) ? $_POST['fave']['title_text_color'] : '';
			$fave_meta['title_border_color'] = isset( $_POST['fave']['title_border_color'] ) ? $_POST['fave']['title_border_color'] : '';

			$fave_meta['category_id'] = isset( $_POST['fave']['category_id'] ) ? $_POST['fave']['category_id'] : 0;
			$fave_meta['category_ids'] = isset( $_POST['fave']['category_ids'] ) ? $_POST['fave']['category_ids'] : 0;
			$fave_meta['tag_slug'] = isset( $_POST['fave']['tag_slug'] ) ? $_POST['fave']['tag_slug'] : 0;
			$fave_meta['sort'] = isset( $_POST['fave']['sort'] ) ? $_POST['fave']['sort'] : 0;
			$fave_meta['autors_id'] = isset( $_POST['fave']['autors_id'] ) ? $_POST['fave']['autors_id'] : 0;
			$fave_meta['featured_posts'] = isset( $_POST['fave']['featured_posts'] ) ? $_POST['fave']['featured_posts'] : 0;
			$fave_meta['posts_limit'] = isset( $_POST['fave']['posts_limit'] ) ? $_POST['fave']['posts_limit'] : 0;
			$fave_meta['offset'] = isset( $_POST['fave']['offset'] ) ? $_POST['fave']['offset'] : 0;
			$fave_meta['posts_excerpt'] = isset( $_POST['fave']['posts_excerpt'] ) ? $_POST['fave']['posts_excerpt'] : 0;
			$fave_meta['pagination_style'] = isset( $_POST['fave']['pagination_style'] ) ? $_POST['fave']['pagination_style'] : 0;
			

			update_post_meta( $post_id, '_favethemes_meta', $fave_meta );

		}
	}
endif;


/* ======================================================================================
*	Video Custom Post Type Meta
* ======================================================================================= */

if ( !function_exists( 'fave_video_post_type_metabox' ) ) :
	function fave_video_post_type_metabox( $object, $box ) {
		$fave_meta = fave_get_video_post_type_meta( $object->ID );
		$sidebars_lay = fave_get_sidebar_layouts();
		$post_layouts = fave_get_gallery_layouts( true );
		$sidebars = fave_get_sidebars_list();
?>

	   <div class="favethemes_meta_control">
	   		<p class="fave-inline-title-wrap"><span class="fave_meta_title"><?php _e( 'Post Template:', 'magzilla' ); ?></span></p>
	   		<div class="fave-inline-block-wrap">
			  	<ul class="fave-img-select-wrap">
			  	<?php foreach ( $post_layouts as $id => $layout ): ?>
			  		<li>
			  			<?php $selected_class = $id == $fave_meta['post_layout'] ? ' selected': ''; ?>
			  			<img src="<?php echo $layout['img']; ?>" title="<?php echo $layout['title']; ?>" class="fave-img-select<?php echo $selected_class; ?>">
			  			<span><?php //echo $layout['title']; ?></span>
			  			<input type="radio" class="fave-hidden" name="fave[post_layout]" value="<?php echo $id; ?>" <?php checked( $id, $fave_meta['post_layout'] );?>/> </label>
			  		</li>
			  	<?php endforeach; ?>
			   </ul>
		   </div>
	   </div>

	   <div class="favethemes_meta_control">
	   		<p class="fave-inline-title-wrap"><span class="fave_meta_title"><?php _e( 'Sidebar Position:', 'magzilla' ); ?></span></p>
	   		<div class="fave-inline-block-wrap">
			  	<ul class="fave-img-select-wrap">
			  	<?php foreach ( $sidebars_lay as $id => $layout ): ?>
			  		<li>
			  			<?php $selected_class = $id == $fave_meta['fave_use_sidebar'] ? ' selected': ''; ?>
			  			<img src="<?php echo $layout['img']; ?>" title="<?php echo $layout['title']; ?>" class="fave-img-select<?php echo $selected_class; ?>">
			  			<span><?php //echo $layout['title']; ?></span>
			  			<input type="radio" class="fave-hidden" name="fave[fave_use_sidebar]" value="<?php echo $id; ?>" <?php checked( $id, $fave_meta['fave_use_sidebar'] );?>/> </label>
			  		</li>
			  	<?php endforeach; ?>
			   </ul>
		   </div>
	   </div>

	  <?php if ( !empty( $sidebars ) ): ?>

	  <div class="favethemes_meta_control custom_sidebar_js">  
	  	<p class="fave-inline-block-wrap"><span class="fave_meta_title"><?php _e( 'Custom Sidebar:', 'magzilla' ); ?></span></p>
		<div class="fave-inline-block-wrap">
			<ul class="next-hide">
			  	<p><select name="fave[fave_sidebar]" class="fave-dropdown widefat">
					    <option value=""><?php _e( 'None', 'magzilla' ); ?></option>
			  	<?php foreach ( $sidebars as $id => $name ): ?>
			  		<option value="<?php echo $id; ?>" <?php selected( $id, $fave_meta['fave_sidebar'] );?>><?php echo $name; ?></option>
			  	<?php endforeach; ?>
			  </select></p>
			</ul>
		</div>
	</div>

	<?php endif; ?>

<?php
	}
endif;


/* Save video post type Meta */
if ( !function_exists( 'fave_save_video_metaboxes' ) ) :
	function fave_save_video_metaboxes( $post_id, $post ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

		if ( isset( $_POST['fave_video_nonce'] ) ) {
			if ( !wp_verify_nonce( $_POST['fave_video_nonce'], __FILE__  ) )
				return;
		}

		if ( $post->post_type == 'video' && isset( $_POST['fave'] ) ) {
			$post_type = get_post_type_object( $post->post_type );
			if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
				return $post_id;

			$fave_meta = array();

			$fave_meta['post_layout'] = isset( $_POST['fave']['post_layout'] ) ? $_POST['fave']['post_layout'] : 0;
			$fave_meta['fave_use_sidebar'] = isset( $_POST['fave']['fave_use_sidebar'] ) ? $_POST['fave']['fave_use_sidebar'] : 0;
			$fave_meta['fave_sidebar'] = isset( $_POST['fave']['fave_sidebar'] ) ? $_POST['fave']['fave_sidebar'] : 0;
			/*$fave_meta['video_url'] = isset( $_POST['fave']['video_url'] ) ? $_POST['fave']['video_url'] : 0;
			$fave_meta['fave_video_channel'] = isset( $_POST['fave']['fave_video_channel'] ) ? $_POST['fave']['fave_video_channel'] : 0;
			$fave_meta['video_duration'] = isset( $_POST['fave']['video_duration'] ) ? $_POST['fave']['video_duration'] : 0;
			$fave_meta['fave_video_featured'] = isset( $_POST['fave']['fave_video_featured'] ) ? $_POST['fave']['fave_video_featured'] : 0;*/
		
			update_post_meta( $post_id, '_favethemes_video_posttype_meta', $fave_meta );

		}
	}
endif;


/* ======================================================================================
*	Gallery Custom Post Type Meta
* ======================================================================================= */

if ( !function_exists( 'fave_gallery_post_type_metabox' ) ) :
	function fave_gallery_post_type_metabox( $object, $box ) {
		$fave_meta = fave_get_gallery_post_type_meta( $object->ID );
		$sidebars_lay = fave_get_sidebar_layouts();
		$post_layouts = fave_get_gallery_layouts( true );
		$sidebars = fave_get_sidebars_list();
?>
	  	
	   <div class="favethemes_meta_control">
	   		<p class="fave-inline-title-wrap"><span class="fave_meta_title"><?php _e( 'Post Template:', 'magzilla' ); ?></span></p>
	   		<div class="fave-inline-block-wrap">
			  	<ul class="fave-img-select-wrap">
			  	<?php foreach ( $post_layouts as $id => $layout ): ?>
			  		<li>
			  			<?php $selected_class = $id == $fave_meta['post_layout'] ? ' selected': ''; ?>
			  			<img src="<?php echo $layout['img']; ?>" title="<?php echo $layout['title']; ?>" class="fave-img-select<?php echo $selected_class; ?>">
			  			<span><?php //echo $layout['title']; ?></span>
			  			<input type="radio" class="fave-hidden" name="fave[post_layout]" value="<?php echo $id; ?>" <?php checked( $id, $fave_meta['post_layout'] );?>/> </label>
			  		</li>
			  	<?php endforeach; ?>
			   </ul>
		   </div>
	   </div>

	   <div class="favethemes_meta_control">
	   		<p class="fave-inline-title-wrap"><span class="fave_meta_title"><?php _e( 'Sidebar Position:', 'magzilla' ); ?></span></p>
	   		<div class="fave-inline-block-wrap">
			  	<ul class="fave-img-select-wrap">
			  	<?php foreach ( $sidebars_lay as $id => $layout ): ?>
			  		<li>
			  			<?php $selected_class = $id == $fave_meta['fave_use_sidebar'] ? ' selected': ''; ?>
			  			<img src="<?php echo $layout['img']; ?>" title="<?php echo $layout['title']; ?>" class="fave-img-select<?php echo $selected_class; ?>">
			  			<span><?php //echo $layout['title']; ?></span>
			  			<input type="radio" class="fave-hidden" name="fave[fave_use_sidebar]" value="<?php echo $id; ?>" <?php checked( $id, $fave_meta['fave_use_sidebar'] );?>/> </label>
			  		</li>
			  	<?php endforeach; ?>
			   </ul>
		   </div>
	   </div>

	  <?php if ( !empty( $sidebars ) ): ?>

	  <div class="favethemes_meta_control custom_sidebar_js">  
	  	<p class="fave-inline-block-wrap"><span class="fave_meta_title"><?php _e( 'Custom Sidebar:', 'magzilla' ); ?></span></p>
		<div class="fave-inline-block-wrap">
			<ul class="next-hide">
			  	<p><select name="fave[fave_sidebar]" class="fave-dropdown widefat">
				<option value=""><?php _e( 'None', 'magzilla' ); ?></option>
			  	<?php foreach ( $sidebars as $id => $name ): ?>
			  		<option value="<?php echo $id; ?>" <?php selected( $id, $fave_meta['fave_sidebar'] );?>><?php echo $name; ?></option>
			  	<?php endforeach; ?>
			  </select></p>
			</ul>
		</div>

	</div>
	<?php endif; ?>

<?php
	}
endif;


/* Save gallery post type Meta */
if ( !function_exists( 'fave_save_gallery_metaboxes' ) ) :
	function fave_save_gallery_metaboxes( $post_id, $post ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

		if ( isset( $_POST['fave_gallery_nonce'] ) ) {
			if ( !wp_verify_nonce( $_POST['fave_gallery_nonce'], __FILE__  ) )
				return;
		}

		if ( $post->post_type == 'gallery' && isset( $_POST['fave'] ) ) {
			$post_type = get_post_type_object( $post->post_type );
			if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
				return $post_id;

			$fave_meta = array();

			$fave_meta['post_layout'] = isset( $_POST['fave']['post_layout'] ) ? $_POST['fave']['post_layout'] : 0;
			$fave_meta['fave_use_sidebar'] = isset( $_POST['fave']['fave_use_sidebar'] ) ? $_POST['fave']['fave_use_sidebar'] : 0;
			$fave_meta['fave_sidebar'] = isset( $_POST['fave']['fave_sidebar'] ) ? $_POST['fave']['fave_sidebar'] : 0;
		
			update_post_meta( $post_id, '_favethemes_gallery_posttype_meta', $fave_meta );

		}
	}
endif;



/* ======================================================================================
*	Post Settings
* ======================================================================================= */

if ( !function_exists( 'fave_post_settings_metabox' ) ) :
	function fave_post_settings_metabox( $object, $box ) {
		$fave_meta = fave_get_post_meta( $object->ID );
		$sidebars_lay = fave_get_sidebar_layouts();
		$post_layouts = fave_get_post_layouts( true );
		$sidebars = fave_get_sidebars_list();
?>
	  	
	  	
	   <div class="favethemes_meta_control">
	   		<p class="fave-inline-title-wrap"><span class="fave_meta_title"><?php _e( 'Post Template:', 'magzilla' ); ?></span></p>
	   		<div class="fave-inline-block-wrap">
			  	<ul class="fave-img-select-wrap">
			  	<?php foreach ( $post_layouts as $id => $layout ): ?>
			  		<li>
			  			<?php $selected_class = $id == $fave_meta['post_layout'] ? ' selected': ''; ?>
			  			<img src="<?php echo $layout['img']; ?>" title="<?php echo $layout['title']; ?>" class="fave-img-select<?php echo $selected_class; ?>">
			  			<span><?php //echo $layout['title']; ?></span>
			  			<input type="radio" class="fave-hidden" name="fave[post_layout]" value="<?php echo $id; ?>" <?php checked( $id, $fave_meta['post_layout'] );?>/> </label>
			  		</li>
			  	<?php endforeach; ?>
			   </ul>
		   </div>
	   </div>

	   <div class="favethemes_meta_control">
	   		<p class="fave-inline-title-wrap"><span class="fave_meta_title"><?php _e( 'Sidebar Position:', 'magzilla' ); ?></span></p>
	   		<div class="fave-inline-block-wrap">
			  	<ul class="fave-img-select-wrap">
			  	<?php foreach ( $sidebars_lay as $id => $layout ): ?>
			  		<li>
			  			<?php $selected_class = $id == $fave_meta['fave_post_sidebar'] ? ' selected': ''; ?>
			  			<img src="<?php echo $layout['img']; ?>" title="<?php echo $layout['title']; ?>" class="fave-img-select<?php echo $selected_class; ?>">
			  			<span><?php //echo $layout['title']; ?></span>
			  			<input type="radio" class="fave-hidden" name="fave[fave_post_sidebar]" value="<?php echo $id; ?>" <?php checked( $id, $fave_meta['fave_post_sidebar'] );?>/> </label>
			  		</li>
			  	<?php endforeach; ?>
			   </ul>
		   </div>
	   </div>

	  <?php if ( !empty( $sidebars ) ): ?>

	  <div class="favethemes_meta_control custom_sidebar_js">  
	  	<p class="fave-inline-block-wrap"><span class="fave_meta_title"><?php _e( 'Custom Sidebar:', 'magzilla' ); ?></span></p>
		<div class="fave-inline-block-wrap">
			<ul class="next-hide">
			  	<p><select name="fave[fave_sidebar]" class="fave-dropdown widefat">
			  	<?php foreach ( $sidebars as $id => $name ): ?>
			  		<option value="<?php echo $id; ?>" <?php selected( $id, $fave_meta['fave_sidebar'] );?>><?php echo $name; ?></option>
			  	<?php endforeach; ?>
			  </select></p>
			</ul>
		</div>

	</div>
	<?php endif; ?>

	<div class="favethemes_meta_control">  
	  	<p class="fave-inline-block-wrap"><span class="fave_meta_title"><?php _e( 'Source Name:', 'magzilla' ); ?></span></p>
		<div class="fave-inline-block-wrap">
			<input class="fave-input-text-backend-small" type="text" name="fave[source_name]" value="<?php echo $fave_meta['source_name']; ?>" />
		</div>
		<p class="fave-inline-block-wrap fave-meta-des"><?php _e( '- Name of the source', 'magzilla' ); ?></p>
	</div>

	<div class="favethemes_meta_control">  
	  	<p class="fave-inline-block-wrap"><span class="fave_meta_title"><?php _e( 'Source URL:', 'magzilla' ); ?></span></p>
		<div class="fave-inline-block-wrap">
			<input class="fave-input-text-backend-small" type="text" name="fave[source_url]" value="<?php echo $fave_meta['source_url']; ?>" />
		</div>
		<p class="fave-inline-block-wrap fave-meta-des"><?php _e( '- URL of the source', 'magzilla' ); ?></p>
	</div>


<?php
	}
endif;


/* Save Post Meta */
if ( !function_exists( 'fave_save_post_metaboxes' ) ) :
	function fave_save_post_metaboxes( $post_id, $post ) {

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

		if ( isset( $_POST['fave_post_nonce'] ) ) {
			if ( !wp_verify_nonce( $_POST['fave_post_nonce'], __FILE__  ) )
				return;
		}


		if ( $post->post_type == 'post' && isset( $_POST['fave'] ) ) {
			$post_type = get_post_type_object( $post->post_type );
			if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
				return $post_id;

			$fave_meta = array();

			$fave_meta['post_layout'] = isset( $_POST['fave']['post_layout'] ) ? $_POST['fave']['post_layout'] : 0;
			$fave_meta['fave_post_sidebar'] = isset( $_POST['fave']['fave_post_sidebar'] ) ? $_POST['fave']['fave_post_sidebar'] : 0;
			$fave_meta['fave_sidebar'] = isset( $_POST['fave']['fave_sidebar'] ) ? $_POST['fave']['fave_sidebar'] : 0;
			$fave_meta['source_name'] = isset( $_POST['fave']['source_name'] ) ? $_POST['fave']['source_name'] : 0;
			$fave_meta['source_url'] = isset( $_POST['fave']['source_url'] ) ? $_POST['fave']['source_url'] : 0;

			update_post_meta( $post_id, '_favethemes_meta', $fave_meta );

		}
	}
endif;
?>