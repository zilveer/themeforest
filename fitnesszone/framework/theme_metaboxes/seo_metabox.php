<?php $status = dt_theme_is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php') || dt_theme_is_plugin_active('wordpress-seo/wp-seo.php');
if(!$status):	add_action("admin_init", "seo_metabox");	endif;?>
<?php function seo_metabox(){
		$posts = array("post","page");
		foreach($posts as $post):
			add_meta_box("seo-meta-container", __('SEO Options','iamd_text_domain'), "seo_settings", "{$post}", "normal", "default");
			add_action('save_post','seo_meta_save');
		endforeach;
	} 
	
	function seo_settings($args){ 
		global $post;?>
        <div class="custom-box">
            <div class="column one-sixth">
                <label><?php _e('Title','iamd_text_domain');?> </label>
            </div>
            <div class="column five-sixth last">      
                <input name="_seo_title" type="text" class="large"  value="<?php echo get_post_meta( $post->ID, '_seo_title', true );?>" />
                <p class="three-fourth note"> <?php _e('The title display in search engines is limited to 70 chars. If the SEO title is empty the title will be generated based on your title template in your SEO settings.','iamd_text_domain');?> </p>
             </div>
        </div>
        <div class="custom-box">
            <div class="column one-sixth">
            <label><?php _e('Description','iamd_text_domain');?> </label>
            </div>
            <div class="column five-sixth last">      
                <textarea class="large" id="" name="_seo_description" cols="8" rows="8"><?php echo stripslashes(get_post_meta($post->ID,'_seo_description',true));?></textarea>
				<p class="three-fourth note"> <?php _e('The meta description will be limited to 140 chars. If the meta description is empty the description <br> will be generated based on your meta description options in your SEO settings.','iamd_text_domain');?> </p>
             </div>
        </div>
        <div class="custom-box">
            <div class="column one-sixth">
            <label><?php _e('Keywords','iamd_text_domain');?> </label>
            </div>
            <div class="column five-sixth last">      
                <input name="_seo_keywords" type="text" class="large" value="<?php echo get_post_meta( $post->ID, '_seo_keywords', true );?>"/>
                <p class="note"> <?php _e('Add any additional comma separated keywords here.','iamd_text_domain');?> </p>
            </div>
        </div>
<?php
		wp_reset_postdata();
    }
	
	function seo_meta_save($post_id){
		global $pagenow;
		if ( 'post.php' != $pagenow ) return $post_id;
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 	return $post_id;
		
			$title = !empty($_POST['_seo_title']) ? $_POST['_seo_title'] : NULL;
			$desc =  !empty($_POST['_seo_description']) ? $_POST['_seo_description'] : NULL;
			$keywords = !empty($_POST['_seo_keywords']) ? $_POST['_seo_keywords'] : NULL;
		update_post_meta($post_id, '_seo_title',$title);
		update_post_meta($post_id, '_seo_description',$desc);
		update_post_meta($post_id, '_seo_keywords',$keywords);
	}?>