<?php
	$single_post_config = get_option(THEME_SLUG.'single_post_config','');
	$single_post_config = unserialize($single_post_config);
	
	$single_post_config = wd_array_atts(
		array(
				'show_category' => 1
				,'show_author_post_link' => 1
				,'show_time' => 1
				,'show_tags' => 1
				,'show_thumb' => 1
				,'show_view_count' => 1
				,'show_comment_count' => 1
				,'show_social' => 1
				,'show_author' => 1
				,'show_related' => 1
				,'related_label' => "Related Posts"
				,'show_comment_list' => 1				
				,'comment_list_label' => "Responds"				
				,'num_post_related' => 4
				,'show_category_phone' => 1
				,'show_author_post_link_phone' => 1
				,'show_time_phone' => 1
				,'show_tags_phone' => 1
				,'show_thumb_phone' => 1
				,'show_view_count_phone' => 1
				,'show_comment_count_phone' => 1
				,'show_social_phone' => 1
				,'show_author_phone' => 1
				,'show_related_phone' => 1
				,'show_comment_list_phone' => 1	
			)
		,$single_post_config);	
?>
<div id="tab-customforpostsingle" class="custompost-tab">
    <div class="tab-title">
        <h2><span><?php _e('Custom for post page','wpdance'); ?></span></h2>
    </div><!-- .tab-title -->
	<div class="tab-content">
		<form name="config-single" method="POST" action="<?php echo admin_url('admin-ajax.php'); ?>" enctype="multipart/form-data" id="config-single">
			<div class="code-head area-config area-config1">
				<div class="area-inner">
					<div class="area-inner1">
						<h3 class="area-title"><?php _e('Config post detailed page','wpdance'); ?></h3>
						<?php $this->showTooltip(__("Config post detailed page",'wpdance'),__("Config post detailed page",'wpdance')); ?>
						<div class="area-content">
							<p>
								<label>Show Categories 
									<input  type="checkbox" value="1" name="show_category" <?php if( $single_post_config["show_category"] == 1 ) echo "checked='checked'";?>/>
								</label>
							</p>
							<p>							
								<label>Show Author Post Link 
									<input  type="checkbox" value="1" name="show_author_post_link" <?php if($single_post_config["show_author_post_link"] == 1) echo "checked='checked'";?>/>
								</label>
							</p>
							<p>		
								<label>Show Post Time 
									<input  type="checkbox" value="1" name="show_time" <?php if($single_post_config["show_time"] == 1) echo "checked='checked'";?>/>
								</label>	
							</p>
							<p>
								<label>Show Post Tags 
									<input  type="checkbox" value="1" name="show_tags" <?php if( $single_post_config["show_tags"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</p>
							<p>
								<label>Show Thumbnail
									<input  type="checkbox" value="1" name="show_thumb" <?php if( $single_post_config["show_thumb"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</p>
							<p>
								<label>Show Views Count 
									<input  type="checkbox" value="1" name="show_view_count" <?php if( $single_post_config["show_view_count"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</p>							
							<p>
								<label>Show Comment Count 
									<input  type="checkbox" value="1" name="show_comment_count" <?php if( $single_post_config["show_comment_count"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</p>
							<p>
								<label>Show Social Sharing 
									<input  type="checkbox" value="1" name="show_social" <?php if( $single_post_config["show_social"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</p>
							<p>
								<label>Show Author Infors Box 
									<input  type="checkbox" value="1" name="show_author" <?php if( $single_post_config["show_author"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</p>
							<p>
								<label>Show Related Posts 
									<input  type="checkbox" value="1" name="show_related" <?php if( $single_post_config["show_related"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</p>
							<p>
								<label>Related Posts Label </label>
								<input  type="text" value="<?php echo stripslashes(esc_html($single_post_config["related_label"])); ?>" name="related_label"/>
							</p>
							<p>
								<label>Related Posts Number </label>
								<input  type="text" value="<?php echo absint($single_post_config["num_post_related"]);?>" name="num_post_related"/>
							</p>							
							<p>
								<label>Show Comment List 
									<input  type="checkbox" value="1" name="show_comment_list" <?php if( $single_post_config["show_comment_list"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</p>
							<p>
								<label>Comment List Label </label>
								<input  type="text" value="<?php echo stripslashes(esc_html($single_post_config["comment_list_label"]));?>" name="comment_list_label"/>
							</p>
							
						</div><!-- .area-content -->
					</div><!-- .area-inner1 -->
				</div><!-- .area-inner -->
			</div><!-- .code-head -->		


			<div class="code-head area-config area-config1">
				<div class="area-inner">
					<div class="area-inner1">
						<h3 class="area-title"><?php _e('Config mobile detailed page','wpdance'); ?></h3>
						<?php $this->showTooltip(__("Config mobile post detailed page",'wpdance'),__("Config mobile post detailed page",'wpdance')); ?>
						<div class="area-content">
							<p>
								<label>Show Categories 
									<input  type="checkbox" value="1" name="show_category_phone" <?php if( $single_post_config["show_category_phone"] == 1 ) echo "checked='checked'";?>/>
								</label>
							</p>
							<p>							
								<label>Show Author Post Link 
									<input  type="checkbox" value="1" name="show_author_post_link_phone" <?php if($single_post_config["show_author_post_link_phone"] == 1) echo "checked='checked'";?>/>
								</label>
							</p>
							<p>		
								<label>Show Post Time 
									<input  type="checkbox" value="1" name="show_time_phone" <?php if($single_post_config["show_time_phone"] == 1) echo "checked='checked'";?>/>
								</label>	
							</p>
							<p>
								<label>Show Post Tags 
									<input  type="checkbox" value="1" name="show_tags_phone" <?php if( $single_post_config["show_tags_phone"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</p>
							<p>
								<label>Show Thumbnail
									<input  type="checkbox" value="1" name="show_thumb_phone" <?php if( $single_post_config["show_thumb_phone"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</p>
							<p>
								<label>Show View Count 
									<input  type="checkbox" value="1" name="show_view_count_phone" <?php if( $single_post_config["show_view_count_phone"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</p>
							<p>
								<label>Show Comment Count 
									<input  type="checkbox" value="1" name="show_comment_count_phone" <?php if( $single_post_config["show_comment_count_phone"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</p>
							<p>
								<label>Show Social Sharing 
									<input  type="checkbox" value="1" name="show_social_phone" <?php if( $single_post_config["show_social_phone"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</p>
							<p>
								<label>Show Author Infors Box 
									<input  type="checkbox" value="1" name="show_author_phone" <?php if( $single_post_config["show_author_phone"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</p>
							<p>
								<label>Show Related Posts 
									<input  type="checkbox" value="1" name="show_related_phone" <?php if( $single_post_config["show_related_phone"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</p>

							<p>
								<label>Show Comment List 
									<input  type="checkbox" value="1" name="show_comment_list_phone" <?php if( $single_post_config["show_comment_list_phone"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</p>

							
						</div><!-- .area-content -->
					</div><!-- .area-inner1 -->
				</div><!-- .area-inner -->
			</div><!-- .code-head -->	
			
			<div class="bottom-actions">
			   <div class="actions">
					<input type="hidden" name="action" value="config_single"/>
					<button type="submit" class="button btn-save"><span><span><?php _e('Save Changes','wpdance'); ?></span></span></button>
			   </div><!-- .actions -->
			</div><!-- .bottom-actions -->	
		</form>
	</div><!-- .tab-content -->
</div><!-- #tabs-9 -->