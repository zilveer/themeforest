<?php

/**************************************
CUSTOM META FIELD
***************************************/

	//metaboxes
	add_action('add_meta_boxes', 'register_cmb_inspire_post_settings');
	add_action ('save_post', 'update_cmb_inspire_post_settings');

	function register_cmb_inspire_post_settings () {
		add_meta_box('cmb_inspire_post_settings','Inspire post settings', 'display_cmb_inspire_post_settings','post');
	}

	function display_cmb_inspire_post_settings ($post) {

	/**************************************
	GET VALUES
	***************************************/

	// OPTIONS
		$default_cap_text_len = 90;
		$default_excerpt_len = 300;



	// COMPONENTS
		$result_cmb_comp_feat_img = get_post_meta($post->ID, 'cmb_comp_feat_img', true);
		$result_cmb_comp_media = get_post_meta($post->ID, 'cmb_comp_media', true);
		$result_cmb_comp_title = get_post_meta($post->ID, 'cmb_comp_title', true);
		$result_cmb_comp_excerpt = get_post_meta($post->ID, 'cmb_comp_excerpt', true);
		$result_cmb_comp_meta = get_post_meta($post->ID, 'cmb_comp_meta', true);
		$result_cmb_comp_quote = get_post_meta($post->ID, 'cmb_comp_quote', true);
		$result_cmb_comp_feat_img_lightbox = get_post_meta($post->ID, 'cmb_comp_feat_img_lightbox', true);
		$result_cmb_comp_media_link = get_post_meta($post->ID, 'cmb_comp_media_link', true);
		$result_cmb_comp_media_link_blog = get_post_meta($post->ID, 'cmb_comp_media_link_blog', true);
		$result_cmb_excerpt = get_post_meta($post->ID, 'cmb_excerpt', true);
	// SLIDER
		$result_cmb_slider_feature = get_post_meta($post->ID, 'cmb_slider_feature', true);
		$result_cmb_slider_use_cap_header = get_post_meta($post->ID, 'cmb_slider_use_cap_header', true);
		$result_cmb_slider_cap_header = get_post_meta($post->ID, 'cmb_slider_cap_header', true);
		$result_cmb_slider_use_cap_text = get_post_meta($post->ID, 'cmb_slider_use_cap_text', true);
		$result_cmb_slider_cap_text = get_post_meta($post->ID, 'cmb_slider_cap_text', true);
		$result_cmb_slider_use_link = get_post_meta($post->ID, 'cmb_slider_use_link', true);
		$result_cmb_slider_link = get_post_meta($post->ID, 'cmb_slider_link', true);
		$result_cmb_slider_use_media = get_post_meta($post->ID, 'cmb_slider_use_media', true);
		$result_cmb_slider_media = get_post_meta($post->ID, 'cmb_slider_media', true);

		$result_cmb_exist = get_post_meta($post->ID, 'cmb_exist', true);

		//defaults
		if (empty($result_cmb_exist)) {
			$result_cmb_comp_feat_img = "checked";
			$result_cmb_comp_title = "checked";
			$result_cmb_comp_excerpt = "checked";
			$result_cmb_comp_meta = "checked";
			$result_cmb_excerpt = mb_make_excerpt($post->post_content, $default_excerpt_len, true);

			$result_cmb_slider_use_cap_header = "checked";
			$result_cmb_slider_cap_header = $post->post_title;
			$result_cmb_slider_use_cap_text = "checked";
			$result_cmb_slider_cap_text = mb_make_excerpt($post->post_content, $default_cap_text_len, true);
		}

	/**************************************
	DISPLAY CONTENT
	***************************************/

		?>

	<!-- COMPONENTS -->

		<div class="option_heading">
			<span>Compontents</span>
		</div>


		<div class="option_item">
			<input type='checkbox' id='cmb_comp_feat_img' name='cmb_comp_feat_img' value='checked' <?php checked(!empty($result_cmb_comp_feat_img)); ?>>
			<label for='cmb_comp_feat_img'>Featured image</label><br>
			
			<input type='checkbox' id='cmb_comp_media' name='cmb_comp_media' value='checked' <?php checked(!empty($result_cmb_comp_media)); ?>>
			<label for='cmb_comp_media'>Media</label><br>
			
			<input type='checkbox' id='cmb_comp_title' name='cmb_comp_title' value='checked' <?php checked(!empty($result_cmb_comp_title)); ?>>
			<label for='cmb_comp_title'>Title</label><br>
			
			<input type='checkbox' id='cmb_comp_excerpt' name='cmb_comp_excerpt' value='checked' <?php checked(!empty($result_cmb_comp_excerpt)); ?>>
			<label for='cmb_comp_excerpt'>Excerpt</label><br>
			
			<input type='checkbox' id='cmb_comp_meta' name='cmb_comp_meta' value='checked' <?php checked(!empty($result_cmb_comp_meta)); ?>>
			<label for='cmb_comp_meta'>Meta info</label><br>

		</div>

		<div class="option_item">
			<label for='cmb_comp_media_link'>Media link (component)</label><br>
			<input type='text' id='cmb_comp_media_link' name='cmb_comp_media_link' class='widefat' value='<?php if (!empty($result_cmb_comp_media_link)) echo $result_cmb_comp_media_link; ?>'>
			<span class="item_hint">(Remember to adjust sizes. 1 column width: 990px, 2 col. width: 490px, 3 col. width: 323px, 4 col. width: 240px, auto: set width to 100%. Also, set height or remove for auto-height)</span>
		</div>

		<div class="option_item">
			<label for='cmb_excerpt'>Excerpt</label><br>
			<textarea id='cmb_excerpt' name='cmb_excerpt' class='widefat'><?php if (!empty($result_cmb_excerpt)) echo $result_cmb_excerpt; ?></textarea>
			<button type="button" name="button_generate_excerpt" id='button_generate_excerpt' class="button-secondary auto_generate" value="<?php echo mb_make_excerpt($post->post_content, $default_excerpt_len, true); ?>">Auto-generate</button>
		</div>

		<div class="option_item">
			<input type='checkbox' id='cmb_comp_quote' name='cmb_comp_quote' value='checked' <?php checked(!empty($result_cmb_comp_quote)); ?>>
			<label for='cmb_comp_quote'>Show excerpt as quote</label>
		</div>

		<div class="option_item">
			<input type='checkbox' id='cmb_comp_feat_img_lightbox' name='cmb_comp_feat_img_lightbox' value='checked' <?php checked(!empty($result_cmb_comp_feat_img_lightbox)); ?>>
			<label for='cmb_comp_feat_img_lightbox'>Clicking featured image component opens up lightbox</label>
		</div>

		<div class="option_item">
			<label for='cmb_comp_media_link_blog'>Media link for blog layout</label><br>
			<input type='text' id='cmb_comp_media_link_blog' name='cmb_comp_media_link_blog' class='widefat' value='<?php if (!empty($result_cmb_comp_media_link_blog)) echo $result_cmb_comp_media_link_blog; ?>'>
			<span class="item_hint">(Leave empty to use featured image. Remember to adjust sizes. Works best with width="560" and height="310")</span>
		</div>

	<!-- SLIDER -->

		<div class="option_heading">
			<span>Slider</span>
		</div>

		<div class="option_item">
			<input type='checkbox' id='cmb_slider_feature' name='cmb_slider_feature' value='checked' <?php checked(!empty($result_cmb_slider_feature)); ?>>
			<label for='cmb_slider_feature'>Feature this post in slider</label>
		</div>

		<div id="popup_cmb_slider_options">

			<div class="option_item">
				<input type='checkbox' id='cmb_slider_use_cap_header' name='cmb_slider_use_cap_header' value='checked' <?php checked(!empty($result_cmb_slider_use_cap_header)); ?>>
				<label for='cmb_slider_use_cap_header'>Use caption header</label>
				<input type='text' id='cmb_slider_cap_header' name='cmb_slider_cap_header' class='widefat' value='<?php if (!empty($result_cmb_slider_cap_header)) echo $result_cmb_slider_cap_header; ?>'>
				<button type="button" name="button_generate_header" id='button_generate_header' class="button-secondary auto_generate" value="<?php echo $post->post_title; ?>">Auto-generate</button>
			</div>

			<div class="option_item">
				<input type='checkbox' id='cmb_slider_use_cap_text' name='cmb_slider_use_cap_text' value='checked' <?php checked(!empty($result_cmb_slider_use_cap_text)); ?>>
				<label for='cmb_slider_use_cap_text'>Use caption text</label>
				<textarea id='cmb_slider_cap_text' name='cmb_slider_cap_text' class='widefat'><?php if (!empty($result_cmb_slider_cap_text)) echo $result_cmb_slider_cap_text; ?></textarea>
				<button type="button" name="button_generate_text" id='button_generate_text' class="button-secondary auto_generate" value="<?php echo mb_make_excerpt($post->post_content, $default_cap_text_len, true); ?>">Auto-generate</button>
			</div>

			<div class="option_item">
				<input type='checkbox' id='cmb_slider_use_link' name='cmb_slider_use_link' value='checked' <?php checked(!empty($result_cmb_slider_use_link)); ?>>
				<label for='cmb_slider_use_link'>Use custom link</label>
				<input type='text' id='cmb_slider_link' name='cmb_slider_link' class='widefat' value='<?php if (!empty($result_cmb_slider_link)) echo $result_cmb_slider_link; ?>'>
				<span class="item_hint">(If selected clicking slider image will redirect to custom link)</span>
			</div>

			<div class="option_item">
				<input type='checkbox' id='cmb_slider_use_media' name='cmb_slider_use_media' value='checked' <?php checked(!empty($result_cmb_slider_use_media)); ?>>
				<label for='cmb_slider_use_media'>Use media in slider</label>
				<input type='text' id='cmb_slider_media' name='cmb_slider_media' class='widefat' value='<?php if (!empty($result_cmb_slider_media)) echo $result_cmb_slider_media; ?>'>
				<span class="item_hint">(Use media instead of featured image in slider. Remember to adjust sizes. Works best with width: 100% and height: 420px. NB: increases load times.</span>
			</div>

		</div>

		<!-- add nonce -->
		<input type="hidden" name="cmb_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)); ?>" />
		<input type="hidden" name="cmb_exist" value="true" />
		<?php	
	}



/**************************************
UPDATE
***************************************/

	function update_cmb_inspire_post_settings ($post_id) {
		// avoid activation on irrelevant admin pages
		if (!isset($_POST['cmb_nonce'])) {
			return false;		
		}

		// verify nonce.    
		if (!wp_verify_nonce($_POST['cmb_nonce'], basename(__FILE__)) || !isset($_POST['cmb_nonce'])) {
			return false;
		}

		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		} else {

		//COMPONTENTS
			update_post_meta($post_id, 'cmb_comp_feat_img', $_POST['cmb_comp_feat_img']);
			update_post_meta($post_id, 'cmb_comp_media', $_POST['cmb_comp_media']);
			update_post_meta($post_id, 'cmb_comp_title', $_POST['cmb_comp_title']);
			update_post_meta($post_id, 'cmb_comp_excerpt', $_POST['cmb_comp_excerpt']);
			update_post_meta($post_id, 'cmb_comp_meta', $_POST['cmb_comp_meta']);
			update_post_meta($post_id, 'cmb_comp_quote', $_POST['cmb_comp_quote']);
			update_post_meta($post_id, 'cmb_comp_feat_img_lightbox', $_POST['cmb_comp_feat_img_lightbox']);
			update_post_meta($post_id, 'cmb_comp_media_link', $_POST['cmb_comp_media_link']);
			update_post_meta($post_id, 'cmb_comp_media_link_blog', $_POST['cmb_comp_media_link_blog']);
			update_post_meta($post_id, 'cmb_excerpt', $_POST['cmb_excerpt']);

		//SLIDER
			update_post_meta($post_id, 'cmb_slider_feature', $_POST['cmb_slider_feature']);
			update_post_meta($post_id, 'cmb_slider_use_cap_header', $_POST['cmb_slider_use_cap_header']);
			update_post_meta($post_id, 'cmb_slider_cap_header', $_POST['cmb_slider_cap_header']);
			update_post_meta($post_id, 'cmb_slider_use_cap_text', $_POST['cmb_slider_use_cap_text']);
			update_post_meta($post_id, 'cmb_slider_cap_text', $_POST['cmb_slider_cap_text']);
			update_post_meta($post_id, 'cmb_slider_use_link', $_POST['cmb_slider_use_link']);
			update_post_meta($post_id, 'cmb_slider_link', $_POST['cmb_slider_link']);
			update_post_meta($post_id, 'cmb_slider_use_media', $_POST['cmb_slider_use_media']);
			update_post_meta($post_id, 'cmb_slider_media', $_POST['cmb_slider_media']);

			update_post_meta($post_id, 'cmb_exist', $_POST['cmb_exist']);
				
		}
	}


