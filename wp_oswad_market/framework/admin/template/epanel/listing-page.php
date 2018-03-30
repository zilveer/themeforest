<?php
	$archive_page_config = get_option(THEME_SLUG.'archive_page_config','');
	$archive_page_config = unserialize($archive_page_config);
	
	$archive_page_config = wd_array_atts(
		array(
				'show_category' => 1
				,'show_author_post_link' => 1
				,'show_time' => 1
				,'show_tags' => 1
				,'show_views_count' => 1
				,'show_comment_count' => 1
				,'show_excerpt' => 1
				,'show_thumb' => 1
				,'show_read_more' => 1				
				,'show_category_phone' => 1
				,'show_author_post_link_phone' => 1
				,'show_time_phone' => 1
				,'show_tags_phone' => 1
				,'show_views_count_phone' => 1
				,'show_comment_count_phone' => 1
				,'show_excerpt_phone' => 1
				,'show_thumb_phone' => 1
				,'show_read_more_phone' => 1	
			)
		,$archive_page_config);	
?>
<div id="tab-listing-page" class="custompost-tab">
    <div class="tab-title">
        <h2><span><?php _e('Custom archive page','wpdance'); ?></span></h2>
    </div><!-- .tab-title -->
	<div class="tab-content">
		<form name="config-archive-page" method="POST" action="<?php echo admin_url('admin-ajax.php'); ?>" enctype="multipart/form-data" id="config-archive-page">
			<input type="hidden" value="1" name="config_archive_page"/>
			<div class="code-head area-config area-config1">
				<div class="area-inner">
					<div class="area-inner1">
						<h3 class="area-title"><?php _e('Config archive page','wpdance'); ?></h3>
						<?php $this->showTooltip(__("Config archive page",'wpdance'),__("Config archive page",'wpdance')); ?>
						<div class="area-content">
							<p>
								<label>Show Categories 
									<input  type="checkbox" value="1" name="show_category" <?php if( $archive_page_config["show_category"] == 1 ) echo "checked='checked'";?>/>
								</label>
							</p>
							<p>							
								<label>Show Author
									<input  type="checkbox" value="1" name="show_author_post_link" <?php if($archive_page_config["show_author_post_link"] == 1) echo "checked='checked'";?>/>
								</label>
							</p>
							<p>		
								<label>Show Post Time 
									<input  type="checkbox" value="1" name="show_time" <?php if($archive_page_config["show_time"] == 1) echo "checked='checked'";?>/>
								</label>	
							</p>
							<!--<p>
								<label>Show Post Tags 
									<input  type="checkbox" value="1" name="show_tags" <?php if( $archive_page_config["show_tags"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</p>-->
							<p>
								<label>Show Views Count 
									<input  type="checkbox" value="1" name="show_views_count" <?php if( $archive_page_config["show_views_count"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</p>
							<p>
								<label>Show Comment Count 
									<input  type="checkbox" value="1" name="show_comment_count" <?php if( $archive_page_config["show_comment_count"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</p>
							<p>
								<label>Show Excerpt
									<input  type="checkbox" value="1" name="show_excerpt" <?php if( $archive_page_config["show_excerpt"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</p>
							<p>
								<label>Show Thumbnail
									<input  type="checkbox" value="1" name="show_thumb" <?php if( $archive_page_config["show_thumb"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</p>							
							<p>
								<label>Show Read more button
									<input  type="checkbox" value="1" name="show_read_more" <?php if( $archive_page_config["show_read_more"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</p>

							
						</div><!-- .area-content -->
					</div><!-- .area-inner1 -->
				</div><!-- .area-inner -->
			</div><!-- .code-head -->		

			<div class="code-head area-config area-config1">
				<div class="area-inner">
					<div class="area-inner1">
						<h3 class="area-title"><?php _e('Config mobile archive page','wpdance'); ?></h3>
						<?php $this->showTooltip(__("Config mobile archive page",'wpdance'),__("Config mobile archive page",'wpdance')); ?>
						<div class="area-content">
							<p>
								<label>Show Categories 
									<input  type="checkbox" value="1" name="show_category_phone" <?php if( $archive_page_config["show_category_phone"] == 1 ) echo "checked='checked'";?>/>
								</label>
							</p>
							<p>							
								<label>Show Author
									<input  type="checkbox" value="1" name="show_author_post_link_phone" <?php if($archive_page_config["show_author_post_link_phone"] == 1) echo "checked='checked'";?>/>
								</label>
							</p>
							<p>		
								<label>Show Post Time 
									<input  type="checkbox" value="1" name="show_time_phone" <?php if($archive_page_config["show_time_phone"] == 1) echo "checked='checked'";?>/>
								</label>	
							</p>
							<!--<p>
								<label>Show Post Tags 
									<input  type="checkbox" value="1" name="show_tags_phone" <?php if( $archive_page_config["show_tags_phone"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</p>-->
							<p>
								<label>Show Views Count 
									<input  type="checkbox" value="1" name="show_views_count_phone" <?php if( $archive_page_config["show_views_count_phone"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</p>
							<p>
								<label>Show Comment Count 
									<input  type="checkbox" value="1" name="show_comment_count_phone" <?php if( $archive_page_config["show_comment_count_phone"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</p>
							<p>
								<label>Show Excerpt
									<input  type="checkbox" value="1" name="show_excerpt_phone" <?php if( $archive_page_config["show_excerpt_phone"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</p>
							<p>
								<label>Show Thumbnail
									<input  type="checkbox" value="1" name="show_thumb_phone" <?php if( $archive_page_config["show_thumb_phone"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</p>						
							<p>
								<label>Show Read more button
									<input  type="checkbox" value="1" name="show_read_more_phone" <?php if( $archive_page_config["show_read_more_phone"] == 1 ) echo "checked='checked'";?>/>
								</label>	
							</p>

							
						</div><!-- .area-content -->
					</div><!-- .area-inner1 -->
				</div><!-- .area-inner -->
			</div><!-- .code-head -->	
			
			<div class="bottom-actions">
			   <div class="actions">
					<input type="hidden" name="action" value="config_archive_page"/>
					<button type="submit" class="button btn-save"><span><span><?php _e('Save Changes','wpdance'); ?></span></span></button>
			   </div><!-- .actions -->
			</div><!-- .bottom-actions -->	
		</form>
	</div><!-- .tab-content -->
</div><!-- #tabs-9 -->