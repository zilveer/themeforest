<?php
/* WIDGET - TABS */

class tp_widget_tabs extends WP_Widget {
	function tp_widget_tabs() {
		$widget_ops = array('classname' => 'tp_widget_tabs', 'description' => __('Display more content in one place! Max. 3 tabs allowed!','ingrid') );
		parent::__construct('tp_widget_tabs', '* Sidebar Tabs', $widget_ops);
	}


	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		
		//generate random id so we can add more tab widget
		$rand = mt_rand(1,1000);
		
		//echo widget
			echo '
			<!-- TABBED CONTENT -->
			<section class="tabs">
				<ul class="tabnav">';
				
				echo '<li><a href="#sb-tabs-'.$rand.'-1">'; if(!empty($instance['tp_w_tabs_1_title'])){echo $instance['tp_w_tabs_1_title'];}else{ echo 'TAB ONE'; }; echo '</a></li>';
				
				if(!empty($instance['tp_w_tabs_2_title'])){
					echo '<li><a href="#sb-tabs-'.$rand.'-2">'.$instance['tp_w_tabs_2_title'].'</a></li>';
				}
				if(!empty($instance['tp_w_tabs_3_title'])){
					echo '<li><a href="#sb-tabs-'.$rand.'-3">'.$instance['tp_w_tabs_3_title'].'</a></li>';
				}
				
			echo '
				</ul>
				';
				
				// tab one
					echo '
					<div id="sb-tabs-'.$rand.'-1" class="tabdiv">';
					
						if(!empty($instance['tp_w_tabs_1_content'])){
						
							if($instance['tp_w_tabs_1_content'] == 'recent'){
							// print recent posts
								echo '
								<ul class="widget_post_list">';	 
								global $post;		
																
								if(!empty($instance['tp_w_tabs_tab1_cats'])){
									$instance['tp_w_tabs_tab1_cats'] = maybe_unserialize($instance['tp_w_tabs_tab1_cats']);									
									$myposts = get_posts('posts_per_page=' . $instance['tp_w_tabs_1_p_count'] . '&category=' . implode(',',$instance['tp_w_tabs_tab1_cats']));
								}else{			
									$myposts = get_posts('posts_per_page=' . $instance['tp_w_tabs_1_p_count']);
								}																
								$fctr = '1';
								foreach($myposts as $post) {
									setup_postdata($post);	
									
									echo '
									<li>';									
									
									$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array(80,55), false, '' );

									//if has thumb
									if($src[0] != ''){
										echo '
										<p>
											<a href="'.get_permalink().'"><img class="tn" src="'.$src[0].'" alt="post thumbnail" />';
									}else{
										echo '
										<p>
											<a href="'.get_permalink().'">';
									}			
												
									echo get_the_title().'</a><br />
											<span>'.get_the_date().'</span>
									
									</li>';
									
									$fctr++;
								}		 
								
								wp_reset_query();
								
								echo '
								</ul>';
								
							}elseif($instance['tp_w_tabs_1_content'] == 'popular'){
							// print pop posts
								echo '
								<ul class="widget_post_list">';	 
								global $post;		
								
								if(!empty($instance['tp_w_tabs_tab1_cats'])){
									$instance['tp_w_tabs_tab1_cats'] = maybe_unserialize($instance['tp_w_tabs_tab1_cats']);									
									$myposts = get_posts('orderby=comment_count&posts_per_page=' . $instance['tp_w_tabs_1_p_count'] . '&category=' . implode(',',$instance['tp_w_tabs_tab1_cats']));
								}else{			
									$myposts = get_posts('orderby=comment_count&posts_per_page=' . $instance['tp_w_tabs_1_p_count']);
								}	
								$fctr = '1';
								foreach($myposts as $post) {
									setup_postdata($post);	
									
									echo '
									<li>';									
									
									$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array(80,55), false, '' );

									//if has thumb
									if($src[0] != ''){
										echo '
										<p>
											<a href="'.get_permalink().'"><img class="tn" src="'.$src[0].'" alt="post thumbnail" />';
									}else{
										echo '
										<p>
											<a href="'.get_permalink().'">';
									}			
												
									echo get_the_title().'</a><br />
											<span>'.get_the_date().'</span>
									
									</li>';
									
									$fctr++;
								}		 
								
								wp_reset_query();
								
								echo '
								</ul>';
							}elseif($instance['tp_w_tabs_1_content'] == 'tags'){
								//display tags
								$tags = get_tags(array('taxonomy' => 'posts'));
								print '<section class="widget_tag_cloud">';
								foreach($tags as $tag){
									$tag_link = get_tag_link($tag->term_id);
									print '<a href="'.$tag_link.'">'.$tag->name.'</a>';
								}
								print '</section>';
								
							}elseif($instance['tp_w_tabs_1_content'] == 'cats'){
								//display category tags								
								if(empty($instance['tp_w_tabs_tab1_cats'])){ 
									//show all
									$cats = get_categories(array('type' => 'post'));
									print '<section class="widget_tag_cloud">';
									foreach($cats as $cat){
										$cat_link = get_category_link($cat->term_id);
										print '<a href="'.$cat_link.'">'.$cat->name.'</a>';
									}
									print '</section>';
								}else{
									print '<section class="widget_tag_cloud">';
									foreach($instance['tp_w_tabs_tab1_cats'] as $cat){					
										print '<a href="'.get_category_link($cat).'">'.get_cat_name($cat).'</a>';
									}
									print '</section>';
								}
							}			
							
						}elseif(!empty($instance['tp_w_tabs_1_custom'])){
							echo do_shortcode($instance['tp_w_tabs_1_custom']);
						}else{
							echo '<p>No content defined yet!</p>';
						}
						
					echo '
					</div>';
				
				if(!empty($instance['tp_w_tabs_2_title'])){					
				// tab two
					echo '
					<div id="sb-tabs-'.$rand.'-2" class="tabdiv">';
					
						if(!empty($instance['tp_w_tabs_2_content'])){
						
							if($instance['tp_w_tabs_2_content'] == 'recent'){
							// print recent posts
								echo '
								<ul class="widget_post_list">';	 
								global $post;		
																
								if(!empty($instance['tp_w_tabs_tab2_cats'])){
									$instance['tp_w_tabs_tab2_cats'] = maybe_unserialize($instance['tp_w_tabs_tab2_cats']);									
									$myposts = get_posts('posts_per_page=' . $instance['tp_w_tabs_2_p_count'] . '&category=' . implode(',',$instance['tp_w_tabs_tab2_cats']));
								}else{			
									$myposts = get_posts('posts_per_page=' . $instance['tp_w_tabs_2_p_count']);
								}																
								$fctr = '1';
								foreach($myposts as $post) {
									setup_postdata($post);	
									
									echo '
									<li>';									
									
									$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array(80,55), false, '' );

									//if has thumb
									if($src[0] != ''){
										echo '
										<p>
											<a href="'.get_permalink().'"><img class="tn" src="'.$src[0].'" alt="post thumbnail" />';
									}else{
										echo '
										<p>
											<a href="'.get_permalink().'">';
									}			
												
									echo get_the_title().'</a><br />
											<span>'.get_the_date().'</span>
									
									</li>';
									
									$fctr++;
								}		 
								
								wp_reset_query();
								
								echo '
								</ul>';
								
							}elseif($instance['tp_w_tabs_2_content'] == 'popular'){
							// print pop posts
								echo '
								<ul class="widget_post_list">';	 
								global $post;		
								
								if(!empty($instance['tp_w_tabs_tab2_cats'])){
									$instance['tp_w_tabs_tab2_cats'] = maybe_unserialize($instance['tp_w_tabs_tab2_cats']);									
									$myposts = get_posts('orderby=comment_count&posts_per_page=' . $instance['tp_w_tabs_2_p_count'] . '&category=' . implode(',',$instance['tp_w_tabs_tab2_cats']));
								}else{			
									$myposts = get_posts('orderby=comment_count&posts_per_page=' . $instance['tp_w_tabs_2_p_count']);
								}	
								$fctr = '1';
								foreach($myposts as $post) {
									setup_postdata($post);	
									
									echo '
									<li>';									
									
									$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array(80,55), false, '' );

									//if has thumb
									if($src[0] != ''){
										echo '
										<p>
											<a href="'.get_permalink().'"><img class="tn" src="'.$src[0].'" alt="post thumbnail" />';
									}else{
										echo '
										<p>
											<a href="'.get_permalink().'">';
									}			
												
									echo get_the_title().'</a><br />
											<span>'.get_the_date().'</span>
									
									</li>';
									
									$fctr++;
								}		 
								
								wp_reset_query();
								
								echo '
								</ul>';
							}elseif($instance['tp_w_tabs_2_content'] == 'tags'){
								//display tags
								$tags = get_tags(array('taxonomy' => 'posts'));
								print '<section class="widget_tag_cloud">';
								foreach($tags as $tag){
									$tag_link = get_tag_link($tag->term_id);
									print '<a href="'.$tag_link.'">'.$tag->name.'</a>';
								}
								print '</section>';
								
							}elseif($instance['tp_w_tabs_2_content'] == 'cats'){
								//display category tags								
								if(empty($instance['tp_w_tabs_tab2_cats'])){ 
									//show all
									$cats = get_categories(array('type' => 'post'));
									print '<section class="widget_tag_cloud">';
									foreach($cats as $cat){
										$cat_link = get_category_link($cat->term_id);
										print '<a href="'.$cat_link.'">'.$cat->name.'</a>';
									}
									print '</section>';
								}else{
									print '<section class="widget_tag_cloud">';
									foreach($instance['tp_w_tabs_tab2_cats'] as $cat){					
										print '<a href="'.get_category_link($cat).'">'.get_cat_name($cat).'</a>';
									}
									print '</section>';
								}
							}			
							
						}elseif(!empty($instance['tp_w_tabs_2_custom'])){
							echo do_shortcode($instance['tp_w_tabs_2_custom']);
						}else{
							echo '<p>No content defined yet!</p>';
						}
						
					echo '
					</div>';
				}
				
				if(!empty($instance['tp_w_tabs_3_title'])){
				// tab three
					echo '
					<div id="sb-tabs-'.$rand.'-3" class="tabdiv">';
					
						if(!empty($instance['tp_w_tabs_3_content'])){
						
							if($instance['tp_w_tabs_3_content'] == 'recent'){
							// print recent posts
								echo '
								<ul class="widget_post_list">';	 
								global $post;		
																
								if(!empty($instance['tp_w_tabs_tab3_cats'])){
									$instance['tp_w_tabs_tab3_cats'] = maybe_unserialize($instance['tp_w_tabs_tab3_cats']);									
									$myposts = get_posts('posts_per_page=' . $instance['tp_w_tabs_3_p_count'] . '&category=' . implode(',',$instance['tp_w_tabs_tab3_cats']));
								}else{			
									$myposts = get_posts('posts_per_page=' . $instance['tp_w_tabs_3_p_count']);
								}																
								$fctr = '1';
								foreach($myposts as $post) {
									setup_postdata($post);	
									
									echo '
									<li>';									
									
									$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array(80,55), false, '' );

									//if has thumb
									if($src[0] != ''){
										echo '
										<p>
											<a href="'.get_permalink().'"><img class="tn" src="'.$src[0].'" alt="post thumbnail" />';
									}else{
										echo '
										<p>
											<a href="'.get_permalink().'">';
									}			
												
									echo get_the_title().'</a><br />
											<span>'.get_the_date().'</span>
									
									</li>';
									
									$fctr++;
								}		 
								
								wp_reset_query();
								
								echo '
								</ul>';
								
							}elseif($instance['tp_w_tabs_3_content'] == 'popular'){
							// print pop posts
								echo '
								<ul class="widget_post_list">';	 
								global $post;		
								
								if(!empty($instance['tp_w_tabs_tab3_cats'])){
									$instance['tp_w_tabs_tab3_cats'] = maybe_unserialize($instance['tp_w_tabs_tab3_cats']);									
									$myposts = get_posts('orderby=comment_count&posts_per_page=' . $instance['tp_w_tabs_3_p_count'] . '&category=' . implode(',',$instance['tp_w_tabs_tab3_cats']));
								}else{			
									$myposts = get_posts('orderby=comment_count&posts_per_page=' . $instance['tp_w_tabs_3_p_count']);
								}	
								$fctr = '1';
								foreach($myposts as $post) {
									setup_postdata($post);	
									
									echo '
									<li>';									
									
									$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array(80,55), false, '' );

									//if has thumb
									if($src[0] != ''){
										echo '
										<p>
											<a href="'.get_permalink().'"><img class="tn" src="'.$src[0].'" alt="post thumbnail" />';
									}else{
										echo '
										<p>
											<a href="'.get_permalink().'">';
									}			
												
									echo get_the_title().'</a><br />
											<span>'.get_the_date().'</span>
									
									</li>';
									
									$fctr++;
								}		 
								
								wp_reset_query();
								
								echo '
								</ul>';
							}elseif($instance['tp_w_tabs_3_content'] == 'tags'){
								//display tags
								$tags = get_tags(array('taxonomy' => 'posts'));
								print '<section class="widget_tag_cloud">';
								foreach($tags as $tag){
									$tag_link = get_tag_link($tag->term_id);
									print '<a href="'.$tag_link.'">'.$tag->name.'</a>';
								}
								print '</section>';
								
							}elseif($instance['tp_w_tabs_3_content'] == 'cats'){
								//display category tags								
								if(empty($instance['tp_w_tabs_tab3_cats'])){ 
									//show all
									$cats = get_categories(array('type' => 'post'));
									print '<section class="widget_tag_cloud">';
									foreach($cats as $cat){
										$cat_link = get_category_link($cat->term_id);
										print '<a href="'.$cat_link.'">'.$cat->name.'</a>';
									}
									print '</section>';
								}else{
									print '<section class="widget_tag_cloud">';
									foreach($instance['tp_w_tabs_tab3_cats'] as $cat){					
										print '<a href="'.get_category_link($cat).'">'.get_cat_name($cat).'</a>';
									}
									print '</section>';
								}
							}			
							
						}elseif(!empty($instance['tp_w_tabs_3_custom'])){
							echo do_shortcode($instance['tp_w_tabs_3_custom']);
						}else{
							echo '<p>No content defined yet!</p>';
						}
						
					echo '
					</div>';				
				}
				
			echo '	
			</section>
			';

		echo $after_widget;
	}

	
	function update($new_instance, $old_instance) {				
		$instance = $old_instance;
		$instance['tp_w_tabs_1_title'] = $new_instance['tp_w_tabs_1_title'];
		$instance['tp_w_tabs_2_title'] = $new_instance['tp_w_tabs_2_title'];
		$instance['tp_w_tabs_3_title'] = $new_instance['tp_w_tabs_3_title'];
		$instance['tp_w_tabs_1_content'] = $new_instance['tp_w_tabs_1_content'];
		$instance['tp_w_tabs_2_content'] = $new_instance['tp_w_tabs_2_content'];
		$instance['tp_w_tabs_3_content'] = $new_instance['tp_w_tabs_3_content'];
		$instance['tp_w_tabs_1_custom'] = $new_instance['tp_w_tabs_1_custom'];
		$instance['tp_w_tabs_2_custom'] = $new_instance['tp_w_tabs_2_custom'];
		$instance['tp_w_tabs_3_custom'] = $new_instance['tp_w_tabs_3_custom'];
		$instance['tp_w_tabs_1_p_count'] = $new_instance['tp_w_tabs_1_p_count'];		
		$instance['tp_w_tabs_2_p_count'] = $new_instance['tp_w_tabs_2_p_count'];		
		$instance['tp_w_tabs_3_p_count'] = $new_instance['tp_w_tabs_3_p_count'];				
		$instance['tp_w_tabs_tab1_cats'] = $new_instance['tp_w_tabs_tab1_cats'];	
		$instance['tp_w_tabs_tab2_cats'] = $new_instance['tp_w_tabs_tab2_cats'];	
		$instance['tp_w_tabs_tab3_cats'] = $new_instance['tp_w_tabs_tab3_cats'];	
		
		
		
        return $instance;
    }

	
	function form($instance) {
		$defaults = array( 'tp_w_tabs_1_p_count' => '', 'tp_w_tabs_2_p_count' => '', 'tp_w_tabs_3_p_count' => '',
		'tp_w_tabs_1_title' => '', 'tp_w_tabs_1_content' => '',	'tp_w_tabs_1_custom' => '',
		'tp_w_tabs_2_title' => '', 'tp_w_tabs_2_content' => '',	'tp_w_tabs_2_custom' => '',
		'tp_w_tabs_3_title' => '', 'tp_w_tabs_3_content' => '',	'tp_w_tabs_3_custom' => '',
		'tp_w_tabs_tab1_cats' => '', 'tp_w_tabs_tab2_cats' => '', 'tp_w_tabs_tab3_cats' => '');
		$instance = wp_parse_args( (array) $instance, $defaults );
		
		echo '
		<p><label><strong>'.__('Tab #1','ingrid').'</strong></label>
		<p><label>'.__('Title','ingrid').':</label>
		<input type="text" name="'.$this->get_field_name('tp_w_tabs_1_title').'" value="'.esc_attr($instance['tp_w_tabs_1_title']).'" style="font-size: 11px; width: 185px;" /></p>
		<p><label>'.__('Select content','ingrid').':</label>
		<select id="tp_w_tabs_s1" name="'.$this->get_field_name('tp_w_tabs_1_content').'" style="width: 130px;">
		<option value=""'; if($instance['tp_w_tabs_1_content'] == ''){print ' selected="selected"';} print '>-</option>
		<option value="recent"'; if($instance['tp_w_tabs_1_content'] == 'recent'){print ' selected="selected"';} print '>'.__('Recent Posts','ingrid').'</option>
		<option value="popular"'; if($instance['tp_w_tabs_1_content'] == 'popular'){print ' selected="selected"';} print '>'.__('Popular Posts','ingrid').'</option>		
		<option value="tags"'; if($instance['tp_w_tabs_1_content'] == 'tags'){print ' selected="selected"';} print '>'.__('Tags','ingrid').'</option>
		<option value="cats"'; if($instance['tp_w_tabs_1_content'] == 'cats'){print ' selected="selected"';} print '>'.__('Categories','ingrid').'</option>
		</select></p>				
		
		<p class="tab1-cat-listb'; if($instance['tp_w_tabs_1_content'] == 'tags' || $instance['tp_w_tabs_1_content'] == '' || $instance['tp_w_tabs_1_content'] == 'cats'){ print ' hidden'; } print '">
		<label>'.__('Number of posts to show','ingrid').':</label>
		<input type="text" name="'.$this->get_field_name('tp_w_tabs_1_p_count').'" value="'.esc_attr($instance['tp_w_tabs_1_p_count']).'" style="font-size: 11px; width: 20px;" /><br /><br /></p>		
		
		<p class="tab1-cat-list'; if($instance['tp_w_tabs_1_content'] == 'tags' || $instance['tp_w_tabs_1_content'] == ''){ print ' hidden'; } print '">'.__('Select post category(s) to display. If none is selected, all categories will be displayed.','ingrid').'<br /><br /></p>
		<p class="tab1-cat-list'; if($instance['tp_w_tabs_1_content'] == 'tags' || $instance['tp_w_tabs_1_content'] == ''){ print ' hidden'; } print '">';
			$instance['tp_w_tabs_tab1_cats'] = maybe_unserialize($instance['tp_w_tabs_tab1_cats']);
			$categories =  get_categories();
			if(!empty($categories)){
			foreach ($categories as $cat){
			$option = '<span class="fifty"><input type="checkbox" id="'. $this->get_field_id( 'tp_w_tabs_tab1_cats' ) .'[]" name="'. $this->get_field_name( 'tp_w_tabs_tab1_cats' ) .'[]"';
				if (is_array($instance['tp_w_tabs_tab1_cats'])) {
					foreach ($instance['tp_w_tabs_tab1_cats'] as $cats) {
						if($cats==$cat->term_id) {
						$option = $option.' checked="checked"';
						}
					}
				}
				$option .= ' value="'.$cat->term_id.'" />';
                $option .= ' <label>'.$cat->cat_name.'</label></span>';    
                
                echo $option;
            }
			}
		echo '<br /><br />
		</p>
		<p class="tab1-cat-list"'; if($instance['tp_w_tabs_1_content'] == 'tags' || $instance['tp_w_tabs_1_content'] == ''){ print ' hidden'; } print '>&nbsp;</p>	
		<p class="tab1-customcnt"'; if($instance['tp_w_tabs_1_content'] != ''){ print ' hidden'; } print '><label>'.__('or enter custom content','ingrid').':</label>
		<textarea name="'.$this->get_field_name('tp_w_tabs_1_custom').'" style="font-size: 11px; width: 100%; height: 80px; ">'.esc_attr($instance['tp_w_tabs_1_custom']).'</textarea></p>
		
		
		
		
		<p>&nbsp;</p>		
		<p><label><strong>'.__('Tab #2','ingrid').'</strong></label>
		<p><label>'.__('Title','ingrid').':</label>
		<input type="text" name="'.$this->get_field_name('tp_w_tabs_2_title').'" value="'.esc_attr($instance['tp_w_tabs_2_title']).'" style="font-size: 11px; width: 185px;" /></p>
		<p><label>'.__('Select content','ingrid').':</label>
		<select id="tp_w_tabs_s2" name="'.$this->get_field_name('tp_w_tabs_2_content').'" style="width: 130px;">
		<option value=""'; if($instance['tp_w_tabs_2_content'] == ''){print ' selected="selected"';} print '>-</option>
		<option value="recent"'; if($instance['tp_w_tabs_2_content'] == 'recent'){print ' selected="selected"';} print '>'.__('Recent Posts','ingrid').'</option>
		<option value="popular"'; if($instance['tp_w_tabs_2_content'] == 'popular'){print ' selected="selected"';} print '>'.__('Popular Posts','ingrid').'</option>		
		<option value="tags"'; if($instance['tp_w_tabs_2_content'] == 'tags'){print ' selected="selected"';} print '>'.__('Tags','ingrid').'</option>
		<option value="cats"'; if($instance['tp_w_tabs_2_content'] == 'cats'){print ' selected="selected"';} print '>'.__('Categories','ingrid').'</option>
		</select></p>				
		
		<p class="tab2-cat-listb'; if($instance['tp_w_tabs_2_content'] == 'tags' || $instance['tp_w_tabs_2_content'] == '' || $instance['tp_w_tabs_2_content'] == 'cats'){ print ' hidden'; } print '">
		<label>'.__('Number of posts to show','ingrid').':</label>
		<input type="text" name="'.$this->get_field_name('tp_w_tabs_2_p_count').'" value="'.esc_attr($instance['tp_w_tabs_2_p_count']).'" style="font-size: 11px; width: 20px;" /><br /><br /></p>		
		
		<p class="tab2-cat-list'; if($instance['tp_w_tabs_2_content'] == 'tags' || $instance['tp_w_tabs_2_content'] == ''){ print ' hidden'; } print '">'.__('Select post category(s) to display. If none is selected, all categories will be displayed.','ingrid').'<br /><br /></p>
		<p class="tab2-cat-list'; if($instance['tp_w_tabs_2_content'] == 'tags' || $instance['tp_w_tabs_2_content'] == ''){ print ' hidden'; } print '">';
			$instance['tp_w_tabs_tab2_cats'] = maybe_unserialize($instance['tp_w_tabs_tab2_cats']);
			$categories =  get_categories();
			if(!empty($categories)){
			foreach ($categories as $cat){
			$option = '<span class="fifty"><input type="checkbox" id="'. $this->get_field_id( 'tp_w_tabs_tab2_cats' ) .'[]" name="'. $this->get_field_name( 'tp_w_tabs_tab2_cats' ) .'[]"';
				if (is_array($instance['tp_w_tabs_tab2_cats'])) {
					foreach ($instance['tp_w_tabs_tab2_cats'] as $cats) {
						if($cats==$cat->term_id) {
						$option = $option.' checked="checked"';
						}
					}
				}
				$option .= ' value="'.$cat->term_id.'" />';
                $option .= ' <label>'.$cat->cat_name.'</label></span>';    
                
                echo $option;
            }
			}
		echo '<br /><br />
		</p>
		<p class="tab2-cat-list"'; if($instance['tp_w_tabs_2_content'] == 'tags' || $instance['tp_w_tabs_2_content'] == ''){ print ' hidden'; } print '>&nbsp;</p>	
		<p class="tab2-customcnt"'; if($instance['tp_w_tabs_2_content'] != ''){ print ' hidden'; } print '><label>'.__('or enter custom content','ingrid').':</label>
		<textarea name="'.$this->get_field_name('tp_w_tabs_2_custom').'" style="font-size: 11px; width: 100%; height: 80px; ">'.esc_attr($instance['tp_w_tabs_2_custom']).'</textarea></p>
		
		
		
		
		<p>&nbsp;</p>		
		<p><label><strong>'.__('Tab #3','ingrid').'</strong></label>
		<p><label>'.__('Title','ingrid').':</label>
		<input type="text" name="'.$this->get_field_name('tp_w_tabs_3_title').'" value="'.esc_attr($instance['tp_w_tabs_3_title']).'" style="font-size: 11px; width: 185px;" /></p>
		<p><label>'.__('Select content','ingrid').':</label>
		<select id="tp_w_tabs_s3" name="'.$this->get_field_name('tp_w_tabs_3_content').'" style="width: 130px;">
		<option value=""'; if($instance['tp_w_tabs_3_content'] == ''){print ' selected="selected"';} print '>-</option>
		<option value="recent"'; if($instance['tp_w_tabs_3_content'] == 'recent'){print ' selected="selected"';} print '>'.__('Recent Posts','ingrid').'</option>
		<option value="popular"'; if($instance['tp_w_tabs_3_content'] == 'popular'){print ' selected="selected"';} print '>'.__('Popular Posts','ingrid').'</option>		
		<option value="tags"'; if($instance['tp_w_tabs_3_content'] == 'tags'){print ' selected="selected"';} print '>'.__('Tags','ingrid').'</option>
		<option value="cats"'; if($instance['tp_w_tabs_3_content'] == 'cats'){print ' selected="selected"';} print '>'.__('Categories','ingrid').'</option>
		</select></p>				
		
		<p class="tab3-cat-listb'; if($instance['tp_w_tabs_3_content'] == 'tags' || $instance['tp_w_tabs_3_content'] == '' || $instance['tp_w_tabs_3_content'] == 'cats'){ print ' hidden'; } print '">
		<label>'.__('Number of posts to show','ingrid').':</label>
		<input type="text" name="'.$this->get_field_name('tp_w_tabs_3_p_count').'" value="'.esc_attr($instance['tp_w_tabs_3_p_count']).'" style="font-size: 11px; width: 20px;" /><br /><br /></p>		
		
		<p class="tab3-cat-list'; if($instance['tp_w_tabs_3_content'] == 'tags' || $instance['tp_w_tabs_3_content'] == ''){ print ' hidden'; } print '">'.__('Select post category(s) to display. If none is selected, all categories will be displayed.','ingrid').'<br /><br /></p>
		<p class="tab3-cat-list'; if($instance['tp_w_tabs_3_content'] == 'tags' || $instance['tp_w_tabs_3_content'] == ''){ print ' hidden'; } print '">';
			$instance['tp_w_tabs_tab3_cats'] = maybe_unserialize($instance['tp_w_tabs_tab3_cats']);
			$categories =  get_categories();
			if(!empty($categories)){
			foreach ($categories as $cat){
			$option = '<span class="fifty"><input type="checkbox" id="'. $this->get_field_id( 'tp_w_tabs_tab3_cats' ) .'[]" name="'. $this->get_field_name( 'tp_w_tabs_tab3_cats' ) .'[]"';
				if (is_array($instance['tp_w_tabs_tab3_cats'])) {
					foreach ($instance['tp_w_tabs_tab3_cats'] as $cats) {
						if($cats==$cat->term_id) {
						$option = $option.' checked="checked"';
						}
					}
				}
				$option .= ' value="'.$cat->term_id.'" />';
                $option .= ' <label>'.$cat->cat_name.'</label></span>';    
                
                echo $option;
            }
			}
		echo '<br /><br />
		</p>
		<p class="tab3-cat-list"'; if($instance['tp_w_tabs_3_content'] == 'tags' || $instance['tp_w_tabs_3_content'] == ''){ print ' hidden'; } print '>&nbsp;</p>	
		<p class="tab3-customcnt"'; if($instance['tp_w_tabs_3_content'] != ''){ print ' hidden'; } print '><label>'.__('or enter custom content','ingrid').':</label>
		<textarea name="'.$this->get_field_name('tp_w_tabs_3_custom').'" style="font-size: 11px; width: 100%; height: 80px; ">'.esc_attr($instance['tp_w_tabs_3_custom']).'</textarea></p>
		
		';
		
	 }
}

register_widget('tp_widget_tabs');

?>