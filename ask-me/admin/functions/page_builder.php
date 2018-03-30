<?php
/*-----------------------------------------------------------------------------------*/
/* Add meta boxes */
/*-----------------------------------------------------------------------------------*/
add_action ('add_meta_boxes','builder_meta_boxes');
function builder_meta_boxes() {
	global $post;
	add_meta_box ('builder_slideshow',__('Page slideshow','vbegy'),'builder_slideshow','page','normal','high');
	add_meta_box ('builder_slideshow',__('Page slideshow','vbegy'),'builder_slideshow','post','normal','high');
	add_meta_box ('sort_the_sections',__('Sort the sections','vbegy'),'sort_the_sections','post','side','low');
	add_meta_box ('sort_the_sections',__('Sort the sections','vbegy'),'sort_the_sections','question','side','low');
}
/*-----------------------------------------------------------------------------------*/
/* Sort the sections */
/*-----------------------------------------------------------------------------------*/
function sort_the_sections() {
	global $post;
	wp_nonce_field ('builder_save_meta','builder_save_meta_nonce');
	$vbegy_custom_sections = get_post_meta($post->ID,"vbegy_custom_sections",true);
	?>
	<div class="minor-publishing">
		<div class="rwmb-field">
			<div class="rwmb-label">
				<label for="vbegy_custom_sections">Custom sections</label>
			</div>
			<div class="rwmb-input vpanel_checkbox_input">
				<input type="checkbox" class="rwmb-checkbox" name="vbegy_custom_sections" id="vbegy_custom_sections" value="1"<?php if (isset($vbegy_custom_sections) && $vbegy_custom_sections == 1) {echo " checked='checked'";}?>>
			</div>
		</div>
		<ul id="sort-sections">
			<?php
			$order_sections_li = get_post_meta($post->ID,"order_sections_li");
			if (empty($order_sections_li)) {
				$order_sections_li = array(0 => array(1 => "advertising",2 => "author",3 => "related",4 => "comments",5 => "next_previous"));
			}
			$order_sections = $order_sections_li[0];
			$i = 0;
			foreach ($order_sections as $key_r => $value_r) {
				$i++;
				if ($value_r == "") {
					unset($order_sections[$key_r]);
				}else {?>
					<li id="<?php echo esc_attr($value_r)?>" class="ui-state-default">
						<div class="widget-head"><span>
						<?php if ($value_r == "advertising") {
							echo esc_attr("Advertising");
						}else if ($value_r == "author") {
							echo esc_attr("About the author");
						}else if ($value_r == "related") {
							echo esc_attr("Related articles");
						}else if ($value_r == "comments") {
							echo esc_attr("Comments");
						}else if ($value_r == "next_previous") {
							echo esc_attr("Next and Previous articles");
						}?>
						</span></div>
						<input name="order_sections_li[<?php echo esc_attr($i);?>]" value="<?php if ($value_r == "next_previous") {echo esc_attr("next_previous");}else if ($value_r == "advertising") {echo esc_attr("advertising");}else if ($value_r == "author") {echo esc_attr("author");}else if ($value_r == "related") {echo esc_attr("related");}else if ($value_r == "comments") {echo esc_attr("comments");}?>" type="hidden">
					</li>
				<?php }
			}
			?>
		</ul>
	</div>
	<?php
}
/*-----------------------------------------------------------------------------------*/
/* builder slideshow meta box */
/*-----------------------------------------------------------------------------------*/
function builder_slideshow() {
	global $post;
	wp_nonce_field ('builder_save_meta','builder_save_meta_nonce');
	?>
    <div id="builder_slide_warp">
		<div class="add-item" add-item="add_slide"><?php _e('+ Add new slide','vbegy')?></div>
	    <div class="clear"></div>
		<ul id="builder_slide">
	    	<?php
			$builder_slide_item = get_post_meta($post->ID,'builder_slide_item');
			$k = 0;
			if ($builder_slide_item) {
				$builder_slide_item = $builder_slide_item[0];
				foreach ($builder_slide_item as $builder_slide) {$k++;
					?>
					<li id="builder_slide_<?php echo $k;?>" class="ui-state-default">
						<div class="widget-head">
							<span class="vpanel<?php echo $k;?>">Slide item - <?php echo $k;?></span>
							<a class="builder-toggle-open">+</a>
							<a class="builder-toggle-close">-</a>
						</div>
						<div class="widget-content">
						    <label for="builder_slide_item[<?php echo $k;?>][image_url]">
						    	<span>Image URL :</span>
						    	<input id="builder_slide_item[<?php echo $k;?>][image_url]" name="builder_slide_item[<?php echo $k;?>][image_url]" value="<?php echo (isset($builder_slide['image_url'])?$builder_slide['image_url']:"")?>" type="text" class="upload upload_image_<?php echo $k;?>">
								<input class="upload_image_button button upload-button-2" rel="<?php echo $k;?>" type="button" value="Upload">
						        <input type="hidden" class="image_id" name="builder_slide_item[<?php echo $k;?>][image_id]" value="<?php echo (isset($builder_slide['image_id'])?$builder_slide['image_id']:"")?>">
						        <div class="clear"></div>
						    </label>
						    
						    <label for="builder_slide_item[<?php echo $k;?>][slide_link]">
						    	<span>Slide Link :</span>
						        <input id="builder_slide_item[<?php echo $k;?>][slide_link]" name="builder_slide_item[<?php echo $k;?>][slide_link]" value="<?php echo (isset($builder_slide['slide_link'])?$builder_slide['slide_link']:"")?>" type="text">
						    </label>
						    
						</div>
						<a class="del-builder-item">x</a>
					</li>
			<?php }
			}else {
				echo "";
			}?>
	    </ul>
		<script type="text/javascript">builder_slide_j = <?php echo $k+1;?>;</script>
	</div>
    <?php
}
/*-----------------------------------------------------------------------------------*/
/* Process builder meta box */
/*-----------------------------------------------------------------------------------*/
add_action ('save_post','builder_meta_save',1,2);
function builder_meta_save ($post_id,$post) {
	global $wpdb;
	if (!$_POST) return $post_id;
	if ($post->post_type != 'page' && $post->post_type != 'question' && $post->post_type != 'post') return $post_id;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
	if (!isset($_POST['builder_save_meta_nonce']) || !wp_verify_nonce ($_POST['builder_save_meta_nonce'],'builder_save_meta')) return $post_id;
	if (!current_user_can ('edit_post',$post_id)) return $post_id;
	
	if (isset($_POST["builder_slide_item"])) {
		$builder_slide_post = $_POST["builder_slide_item"];
	}
	if (isset($builder_slide_post) && !empty($builder_slide_post)) {
		foreach ($builder_slide_post as $key_s => $value_s) {
			if (isset($value_s["box_title"])) {
				$value_s["box_title"] = esc_html($value_s["box_title"]);
			}
			if (isset($value_s["box_posts_num"])) {
				$value_s["box_posts_num"] = (int)esc_html($value_s["box_posts_num"]);
			}
			$builder_slides[$key_s] = $value_s;
		}
		update_post_meta($post->ID,"builder_slide_item",$builder_slides);
	}else {
		delete_post_meta($post->ID,"builder_slide_item");
	}
	
	if (isset($_POST["vbegy_custom_sections"]) && $_POST["vbegy_custom_sections"] == 1) {
		$vbegy_custom_sections = $_POST["vbegy_custom_sections"];
		update_post_meta($post->ID,"vbegy_custom_sections",$vbegy_custom_sections);
	}else {
		delete_post_meta($post->ID,"vbegy_custom_sections");
	}
	
	if (isset($_POST["order_sections_li"])) {
		$order_sections_li = $_POST["order_sections_li"];
	}
	if (isset($order_sections_li) && !empty($order_sections_li)) {
		$order_sections_li = $_POST["order_sections_li"];
		update_post_meta($post->ID,"order_sections_li",$order_sections_li);
	}else {
		delete_post_meta($post->ID,"order_sections_li");
	}
	
	if (empty($_POST["publish"])) {
		$array_meta = array("sort_home_elements");
		foreach ($array_meta as $value_sort) {
			$vbegy_sort = $_POST["vbegy_".$value_sort];
			foreach ($vbegy_sort as $key_v_sort => $value_v_sort) {
				if (empty($value_v_sort["value"]) && empty($value_v_sort["name"])) {
					unset($vbegy_sort[$key_v_sort]);
				}
			}
			update_post_meta($post->ID,"vbegy_".$value_sort,$vbegy_sort);
		}
	}
	
}
?>