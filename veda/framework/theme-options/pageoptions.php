<!-- #pageoptions -->
<div id="pageoptions" class="bpanel-content">

    <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">

        <ul class="sub-panel">
            <li><a href="#tab1"><?php esc_html_e('Post', 'veda');?></a></li>
            <li><a href="#tab2"><?php esc_html_e('Portfolio', 'veda');?></a></li>
            <li><a href="#tab3"><?php esc_html_e('404', 'veda');?></a></li>
            <li><a href="#tab4"><?php esc_html_e('Hooks', 'veda');?></a></li>
            <li><a href="#tab5"><?php esc_html_e('Under Construction', 'veda');?></a></li>
        </ul>

        <!-- #tab1-post -->
        <div id="tab1" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Post', 'veda');?></h3>
                </div>
                
                <div class="box-content">
                
                	<div class="column one-half">
                        <h6><?php esc_html_e('Single Author Box', 'veda');?></h6>
                        <div class="column one-fifth">
                              <?php $checked = ( "true" ==  veda_option('pageoptions','single-post-authorbox') ) ? ' checked="checked"' : ''; ?>
                              <?php $switchclass = ( "true" ==  veda_option('pageoptions','single-post-authorbox') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                              <div data-for="dttheme-single-post-authorbox" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                              <input class="hidden" id="dttheme-single-post-authorbox" name="dttheme[pageoptions][single-post-authorbox]" 
                              	type="checkbox" value="true" <?php echo $checked;?> />
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('YES! to display author box in single blog posts.', 'veda');?></p>
                        </div>
                    </div>
                    <div class="column one-half last">
                        <h6><?php esc_html_e('Single Related Posts', 'veda');?></h6>
                        <div class="column one-fifth">
                              <?php $checked = ( "true" ==  veda_option('pageoptions','single-post-related') ) ? ' checked="checked"' : ''; ?>
                              <?php $switchclass = ( "true" ==  veda_option('pageoptions','single-post-related') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                              <div data-for="dttheme-single-post-related" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                              <input class="hidden" id="dttheme-single-post-related" name="dttheme[pageoptions][single-post-related]" type="checkbox" 
                              	value="true" <?php echo $checked;?> />
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('YES! to display related blog posts in single posts.', 'veda');?></p>
                        </div>
                    </div>
                    
                    <div class="hr"></div>
                    
                	<div class="column one-half">
                        <h6><?php esc_html_e('Posts Comments', 'veda');?></h6>
                        <div class="column one-fifth">
                              <?php $checked = ( "true" ==  veda_option('pageoptions','single-post-comments') ) ? ' checked="checked"' : ''; ?>
                              <?php $switchclass = ( "true" ==  veda_option('pageoptions','single-post-comments') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                              <div data-for="dttheme-single-post-comments" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                              <input class="hidden" id="dttheme-single-post-comments" name="dttheme[pageoptions][single-post-comments]" type="checkbox" 
                              	value="true" <?php echo $checked;?> />
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('YES! to display single blog post comments.', 'veda');?></p>
                        </div>
                    </div>
                    <div class="column one-half last">
                    </div>
                </div><!-- .box-content -->

                <div class="box-title">
                    <h3><?php esc_html_e('Post Archives Page Layout', 'veda');?></h3>
                </div>

                <div class="box-content">
                    <h6><?php esc_html_e('Layout', 'veda');?></h6>
                    <p class="note no-margin"> <?php esc_html_e("Choose the Post archives page layout Style", 'veda');?></p>
                    <div class="hr_invisible"> </div>
                    <div class="bpanel-option-set">
                        <ul class="bpanel-post-layout bpanel-layout-set" id="post-archives-layout">
                        <?php $layout = array('content-full-width'=>'without-sidebar','with-left-sidebar'=>'left-sidebar','with-right-sidebar'=>'right-sidebar','with-both-sidebar'=>'both-sidebar');
                              $v =  veda_option('pageoptions',"post-archives-page-layout");
                              $v = !empty($v) ? $v : "content-full-width";
                              foreach($layout as $key => $value):
                                  $class = ( $key ==   $v ) ? " class='selected' " : "";
                                  echo "<li><a href='#' rel='{$key}' {$class}><img src='" . VEDA_THEME_URI . "/framework/theme-options/images/columns/{$value}.png' /></a></li>";
                              endforeach; ?>
                        </ul>
                        <input name="dttheme[pageoptions][post-archives-page-layout]" type="hidden" value="<?php echo esc_attr($v);?>"/>
                    </div><?php 
                    $sb_layout = veda_option('pageoptions',"post-archives-page-layout");
                    $sidebar_both = $sidebar_left = $sidebar_right = '';
                    if($sb_layout == 'content-full-width') {
                      $sidebar_both = 'style="display:none;"'; 
                    } elseif($sb_layout == 'with-left-sidebar') {
                      $sidebar_right = 'style="display:none;"'; 
                    } elseif($sb_layout == 'with-right-sidebar') {
                      $sidebar_left = 'style="display:none;"'; 
                    } ?>
                    <div id="bpanel-widget-area-options" <?php echo 'class="post-archives-layout" '.$sidebar_both;?>>
                      <div id="left-sidebar-container" class="bpanel-page-left-sidebar" <?php echo $sidebar_left; ?>>
                          <!-- 2. Standard Sidebar Left Start -->
                          <div id="page-commom-sidebar" class="bpanel-sidebar-section custom-box">
                              <h6><?php esc_html_e('Show Standard Left Sidebar', 'veda');?></label></h6>
                              <?php veda_switch("",'pageoptions','show-standard-left-sidebar-for-post-archives'); ?>
                          </div><!-- Standard Sidebar Left End-->
                      </div>

                      <div id="right-sidebar-container" class="bpanel-page-right-sidebar" <?php echo $sidebar_right; ?>>
                          <!-- 3. Standard Sidebar Right Start -->
                          <div id="page-commom-sidebar" class="bpanel-sidebar-section custom-box">
                              <h6><?php esc_html_e('Show Standard Right Sidebar', 'veda');?></label></h6>
                              <?php veda_switch("",'pageoptions','show-standard-right-sidebar-for-post-archives'); ?>
                          </div><!-- Standard Sidebar Right End-->
                      </div>
                    </div>
                </div>
                
                <div class="box-title">
                    <h3><?php esc_html_e('Post Archives Post Layout', 'veda');?></h3>
                </div>

                <div class="box-content">
                
                    <h6><?php esc_html_e('Layout', 'veda');?></h6>
                    <p class="note no-margin"><?php esc_html_e("Choose the Post Layout Style in Post Archives", 'veda');?></p>
                    <div class="hr_invisible"> </div>
                    <div class="bpanel-option-set">
                        <ul class="bpanel-post-layout bpanel-layout-set">
                        <?php $posts_layout = array('one-column'=>esc_html__("One post per row.", 'veda'), 'one-half-column'=>esc_html__("Two posts per row.", 'veda'),
													'one-third-column' => esc_html__("Three posts per row.", 'veda') );
                              $v = veda_option('pageoptions',"post-archives-post-layout");
                              $v = !empty($v) ? $v : "one-half-column";
                              foreach($posts_layout as $key => $value):
                                 $class = ( $key ==  $v ) ? " class='selected' " :"";                                  
                                 echo "<li><a href='#' rel='{$key}' {$class} title='{$value}'><img src='" . VEDA_THEME_URI . "/framework/theme-options/images/columns/{$key}.png' /></a></li>";
                              endforeach;?>                        
                        </ul>
                        <input name="dttheme[pageoptions][post-archives-post-layout]" type="hidden" value="<?php echo esc_attr($v);?>"/>
                    </div>
                    <div class="hr"></div>

                	<div class="column one-half">
                    	<h6><?php esc_html_e('Allow Excerpt', 'veda');?></h6>
                        <div class="column one-fifth">
                        	<?php $checked = ( "true" ==  veda_option('pageoptions','post-archives-enable-excerpt') ) ? ' checked="checked"' : ''; ?>
                            <?php $switchclass = ( "true" ==  veda_option('pageoptions','post-archives-enable-excerpt') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                        	<div data-for="dttheme-post-archives-enable-excerpt" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                            <input class="hidden" id="dttheme-post-archives-enable-excerpt" name="dttheme[pageoptions][post-archives-enable-excerpt]"
                            	type="checkbox" value="true" <?php echo $checked;?> />                        
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('YES! to allow excerpt', 'veda');?></p>
                        </div>
                    </div>

                	<div class="column one-half last">
                    	<h6><?php esc_html_e('Excerpt Length', 'veda');?></h6>
                        <div class="column one-fifth">
                        	<input type="text" name="dttheme[pageoptions][post-archives-excerpt]" class="large" 
                            	value="<?php echo stripslashes(veda_option('pageoptions', 'post-archives-excerpt'));?>"/>
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('Enter Excerpt Length', 'veda');?></p>
                        </div>
                    </div>
                    
                    <div class="hr"></div>
                	<div class="column one-half">
                    	<h6><?php esc_html_e('Read More', 'veda');?></h6>
                        <div class="column one-fifth">
                        	<?php $checked = ( "true" ==  veda_option('pageoptions','post-archives-enable-readmore') ) ? ' checked="checked"' : ''; ?>
                            <?php $switchclass = ( "true" ==  veda_option('pageoptions','post-archives-enable-readmore') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                        	<div data-for="dttheme-post-archives-enable-readmore" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                            <input class="hidden" id="dttheme-post-archives-enable-readmore" name="dttheme[pageoptions][post-archives-enable-readmore]"
                            	type="checkbox" value="true" <?php echo $checked;?> />                        
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('YES! to enable read more button', 'veda');?></p>
                        </div>
                    </div>
                	<div class="column one-half last">
                    	<h6><?php esc_html_e('Read More Shortcode', 'veda');?></h6>
                        <div class="column one-column">
                        	<textarea id="dttheme[pageoptions][post-archives-readmore]" name="dttheme[pageoptions][post-archives-readmore]"><?php 
								echo stripslashes( veda_option('pageoptions', 'post-archives-readmore') );?></textarea>
                        </div>
                        <div class="column one-column last">
                              <p class="note"><?php esc_html_e('Paste any button shortcode here', 'veda');?></p>
                        </div>
                    </div>
                </div>

                <div class="box-title">
                    <h3><?php esc_html_e('Single Post & Post Archive options','veda');?></h3>
                </div>
                <div class="box-content">
                
                	<div class="column one-third">
                    	<label><?php esc_html_e('Single Post Style', 'veda');?></label>
                    </div>
                    <div class="column two-third last">
                    	<select name="dttheme[pageoptions][post-style]" class="dt-chosen-select"><?php
                        $selected = 	veda_option('pageoptions','post-style');
                        $blog_styles =  array( 
                          '' => esc_html__('Default','veda'),
                          'entry-date-left' => esc_html__('Date Left','veda'),
                          'entry-date-author-left' => esc_html__('Date and Author Left','veda'),
                          'blog-medium-style'=>esc_html__('Medium','veda'),
                          'blog-medium-style dt-blog-medium-highlight'=>esc_html__('Medium Hightlight','veda'),
                          'blog-medium-style dt-blog-medium-highlight dt-sc-skin-highlight' => esc_html__('Medium Skin Highlight','veda')
                        );
							foreach( $blog_styles as $bs => $bv ):
								echo "<option value='{$bs}'".selected($selected,$bs,false).">{$bv}</option>";
							endforeach;?>
                        </select>
                    	<p class="note"><?php esc_html_e('Choose post style to display single blog posts and archives.', 'veda');?></p>
                    </div>
                    <div class="hr"></div>
                    
                	<div class="column one-half">
                    	<h6><?php esc_html_e('Post Format Meta', 'veda');?></h6>
                        <div class="column one-fifth">
                        	<?php $checked = ( "true" ==  veda_option('pageoptions','post-format-meta') ) ? ' checked="checked"' : ''; ?>
                            <?php $switchclass = ( "true" ==  veda_option('pageoptions','post-format-meta') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                        	<div data-for="dttheme-post-format-meta" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                            <input class="hidden" id="dttheme-post-format-meta" name="dttheme[pageoptions][post-format-meta]"
                            	type="checkbox" value="true" <?php echo $checked;?> />                        
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('YES! to show post format meta information', 'veda');?></p>
                        </div>
                    </div>
                    <div class="column one-half last">
                    	<h6><?php esc_html_e('Author Meta', 'veda');?></h6>
                        <div class="column one-fifth">
                        	<?php $checked = ( "true" ==  veda_option('pageoptions','post-author-meta') ) ? ' checked="checked"' : ''; ?>
                            <?php $switchclass = ( "true" ==  veda_option('pageoptions','post-author-meta') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                        	<div data-for="dttheme-post-author-meta" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                            <input class="hidden" id="dttheme-post-author-meta" name="dttheme[pageoptions][post-author-meta]"
                            	type="checkbox" value="true" <?php echo $checked;?> />                        
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('YES! to show post author meta information', 'veda');?></p>
                        </div>
                    </div>
                    <div class="hr"></div>

                	<div class="column one-half">
                    	<h6><?php esc_html_e('Date Meta', 'veda');?></h6>
                        <div class="column one-fifth">
                        	<?php $checked = ( "true" ==  veda_option('pageoptions','post-date-meta') ) ? ' checked="checked"' : ''; ?>
                            <?php $switchclass = ( "true" ==  veda_option('pageoptions','post-date-meta') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                        	<div data-for="dttheme-post-date-meta" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                            <input class="hidden" id="dttheme-post-date-meta" name="dttheme[pageoptions][post-date-meta]"
                            	type="checkbox" value="true" <?php echo $checked;?> />                        
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('YES! to show post date meta information', 'veda');?></p>
                        </div>
                    </div>
                    <div class="column one-half last">
                    	<h6><?php esc_html_e('Comment Meta', 'veda');?></h6>
                        <div class="column one-fifth">
                        	<?php $checked = ( "true" ==  veda_option('pageoptions','post-comment-meta') ) ? ' checked="checked"' : ''; ?>
                            <?php $switchclass = ( "true" ==  veda_option('pageoptions','post-comment-meta') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                        	<div data-for="dttheme-post-comment-meta" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                            <input class="hidden" id="dttheme-post-comment-meta" name="dttheme[pageoptions][post-comment-meta]"
                            	type="checkbox" value="true" <?php echo $checked;?> />                        
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('YES! to show post comment meta information', 'veda');?></p>
                        </div>
                    </div>
                    <div class="hr"></div>

                	<div class="column one-half">
                    	<h6><?php esc_html_e('Category Meta', 'veda');?></h6>
                        <div class="column one-fifth">
                        	<?php $checked = ( "true" ==  veda_option('pageoptions','post-category-meta') ) ? ' checked="checked"' : ''; ?>
                            <?php $switchclass = ( "true" ==  veda_option('pageoptions','post-category-meta') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                        	<div data-for="dttheme-post-category-meta" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                            <input class="hidden" id="dttheme-post-category-meta" name="dttheme[pageoptions][post-category-meta]"
                            	type="checkbox" value="true" <?php echo $checked;?> />                        
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('YES! to show post category information', 'veda');?></p>
                        </div>
                    </div>
                    <div class="column one-half last">
                    	<h6><?php esc_html_e('Tag Meta', 'veda');?></h6>
                        <div class="column one-fifth">
                        	<?php $checked = ( "true" ==  veda_option('pageoptions','post-tag-meta') ) ? ' checked="checked"' : ''; ?>
                            <?php $switchclass = ( "true" ==  veda_option('pageoptions','post-tag-meta') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                        	<div data-for="dttheme-post-tag-meta" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                            <input class="hidden" id="dttheme-post-tag-meta" name="dttheme[pageoptions][post-tag-meta]"
                            	type="checkbox" value="true" <?php echo $checked;?> />                        
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('YES! to show post tag information', 'veda');?></p>
                        </div>
                    </div>
                </div>
            </div><!-- .bpanel-box end -->
        </div><!--#tab1-post end-->

        <!-- #tab2-portfolio -->
        <div id="tab2" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Portfolio', 'veda');?></h3>
                </div>
                
                <div class="box-content">
                
                	<div class="column one-half">
                    	<h6><?php esc_html_e('Single Related Portfolios', 'veda');?></h6>
                        <div class="column one-fifth">
                        	<?php $checked = ( "true" ==  veda_option('pageoptions','single-portfolio-related') ) ? ' checked="checked"' : ''; ?>
                            <?php $switchclass = ( "true" ==  veda_option('pageoptions','single-portfolio-related') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                            <div data-for="dttheme-single-portfolio-related" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                            <input class="hidden" id="dttheme-single-portfolio-related" name="dttheme[pageoptions][single-portfolio-related]" type="checkbox" 
                            	value="true" <?php echo $checked;?> />
                        </div>
                        <div class="column four-fifth last">
                        	<p class="note"><?php esc_html_e('YES! to show related portfolio items in single portfolio.', 'veda');?></p>
                        </div>
                    </div>
                    
                    <div class="column one-half last">
                    	<h6><?php esc_html_e('Style', 'veda');?></h6>
                    	<div class="column one-fifth">
                        	<select name="dttheme[pageoptions][single-portfolio-related-style]" class="dt-chosen-select"><?php
								$selected = veda_option('pageoptions','single-portfolio-related-style');
								$portfolio_styles =  array( 'type1' => esc_html__('Modern Title','veda'), 'type2' => esc_html__('Title & Icons Overlay','veda'), 'type3' => esc_html__('Title Overlay','veda'),
									'type4' => esc_html__('Icons Only','veda'), 'type5' => esc_html__('Classic','veda'), 'type6' => esc_html__('Minimal Icons','veda'),
									'type7' => esc_html__('Presentation','veda'), 'type8' => esc_html__('Girly','veda'), 'type9' => esc_html__('Art','veda'));
									
								foreach( $portfolio_styles as $bs => $bv ):
									echo "<option value='{$bs}'".selected($selected,$bs,false).">{$bv}</option>";
								endforeach;?></select>
                        </div>
                        <div class="column four-fifth last">
                        	<p class="note"><?php esc_html_e('Choose post style to display related portfolio items.', 'veda');?></p>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    
                    <div class="hr"></div>

                    <h6><?php esc_html_e('Portfolios Comment', 'veda');?></h6>
                    <div class="column one-fifth">
                          <?php $checked = ( "true" ==  veda_option('pageoptions','single-portfolio-comments') ) ? ' checked="checked"' : ''; ?>
                          <?php $switchclass = ( "true" ==  veda_option('pageoptions','single-portfolio-comments') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                          <div data-for="dttheme-single-portfolio-comments" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                          <input class="hidden" id="dttheme-single-portfolio-comments" name="dttheme[pageoptions][single-portfolio-comments]" type="checkbox" value="true" <?php echo $checked;?> />
                    </div>
                    <div class="column four-fifth last">
                          <p class="note"><?php esc_html_e('YES! to display comments in single portfolios.', 'veda');?></p>
                    </div>
                </div><!-- .box-content -->
                
                <div class="box-title">
                    <h3><?php esc_html_e('Portfolio Archives Page Layout', 'veda');?></h3>
                </div>

                <div class="box-content">
                    <h6><?php esc_html_e('Layout', 'veda');?></h6>
                    <p class="note no-margin"> <?php esc_html_e("Choose the Portfolio archives page layout Style", 'veda');?></p>
                    <div class="hr_invisible"> </div>
                    <div class="bpanel-option-set">
                        <ul class="bpanel-post-layout bpanel-layout-set" id="portfolio-archives-layout">
                        <?php $layout = array('content-full-width'=>'without-sidebar','with-left-sidebar'=>'left-sidebar','with-right-sidebar'=>'right-sidebar','with-both-sidebar'=>'both-sidebar');
                              $v =  veda_option('pageoptions',"portfolio-archives-page-layout");
                              $v = !empty($v) ? $v : "content-full-width";
                              foreach($layout as $key => $value):
                                  $class = ( $key ==   $v ) ? " class='selected' " : "";
                                  echo "<li><a href='#' rel='{$key}' {$class}><img src='" . VEDA_THEME_URI . "/framework/theme-options/images/columns/{$value}.png' /></a></li>";
                              endforeach; ?>
                        </ul>
                        <input name="dttheme[pageoptions][portfolio-archives-page-layout]" type="hidden" value="<?php echo esc_attr($v);?>"/>
                    </div><?php 
                    $sb_layout = veda_option('pageoptions',"portfolio-archives-page-layout");
                    $sidebar_both = $sidebar_left = $sidebar_right = '';
                    if($sb_layout == 'content-full-width') {
                      $sidebar_both = 'style="display:none;"'; 
                    } elseif($sb_layout == 'with-left-sidebar') {
                      $sidebar_right = 'style="display:none;"'; 
                    } elseif($sb_layout == 'with-right-sidebar') {
                      $sidebar_left = 'style="display:none;"'; 
                    } ?>
                    <div id="bpanel-widget-area-options" <?php echo 'class="portfolio-archives-layout" '.$sidebar_both;?>>
                      <div id="left-sidebar-container" class="bpanel-page-left-sidebar" <?php echo $sidebar_left; ?>>
                          <!-- 2. Standard Sidebar Left Start -->
                          <div id="page-commom-sidebar" class="bpanel-sidebar-section custom-box">
                              <h6><?php esc_html_e('Show Standard Left Sidebar', 'veda');?></label></h6>
                              <?php veda_switch("",'pageoptions','show-standard-left-sidebar-for-portfolio-archives'); ?>
                          </div><!-- Standard Sidebar Left End-->
                      </div>

                      <div id="right-sidebar-container" class="bpanel-page-right-sidebar" <?php echo $sidebar_right; ?>>
                          <!-- 3. Standard Sidebar Right Start -->
                          <div id="page-commom-sidebar" class="bpanel-sidebar-section custom-box">
                              <h6><?php esc_html_e('Show Standard Right Sidebar', 'veda');?></label></h6>
                              <?php veda_switch("",'pageoptions','show-standard-right-sidebar-for-portfolio-archives'); ?>
                          </div><!-- Standard Sidebar Right End-->
                      </div>
                    </div>
                </div>

                <div class="box-title">
                    <h3><?php esc_html_e('Portfolio Archives Post Layout', 'veda');?></h3>
                </div>

                <div class="box-content">

                    <h6><?php esc_html_e('Layout', 'veda');?></h6>
                    <p class="note no-margin"><?php esc_html_e("Choose the Post Layout Style in Portfolio Archives", 'veda');?></p>
                    <div class="hr_invisible"> </div>
                    <div class="bpanel-option-set">
                        <ul class="bpanel-post-layout bpanel-layout-set">
                        <?php $posts_layout = array( 'one-half-column'=>esc_html__("Two posts per row.", 'veda'),
                                'one-third-column' => esc_html__("Three posts per row.", 'veda'),
                                'one-fourth-column' => esc_html__("Four posts per row.", 'veda'));
								
                              $v = veda_option('pageoptions',"portfolio-archives-post-layout");
                              $v = !empty($v) ? $v : "one-half-column";
                              foreach($posts_layout as $key => $value):
                                 $class = ( $key ==  $v ) ? " class='selected' " :"";                                  
                                 echo "<li><a href='#' rel='{$key}' {$class} title='{$value}'><img src='" . VEDA_THEME_URI . "/framework/theme-options/images/columns/{$key}.png' /></a></li>";
                              endforeach;?>                        
                        </ul>
                        <input name="dttheme[pageoptions][portfolio-archives-post-layout]" type="hidden" value="<?php echo esc_attr($v);?>"/>
                    </div>

                    <div class="column one-half">
                      <h6><?php esc_html_e('Style', 'veda');?></h6>
                      <div class="column one-fifth">
                        <select name="dttheme[pageoptions][portfolio-archives-post-style]" class="dt-chosen-select"><?php
                          $selected = veda_option('pageoptions','portfolio-archives-post-style');

                          $portfolio_styles =  array( 'type1' => esc_html__('Modern Title','veda'), 'type2' => esc_html__('Title & Icons Overlay','veda'), 'type3' => esc_html__('Title Overlay','veda'),
									'type4' => esc_html__('Icons Only','veda'), 'type5' => esc_html__('Classic','veda'), 'type6' => esc_html__('Minimal Icons','veda'),
									'type7' => esc_html__('Presentation','veda'), 'type8' => esc_html__('Girly','veda'), 'type9' => esc_html__('Art','veda'));

                          foreach( $portfolio_styles as $bs => $bv ):
                            echo "<option value='{$bs}'".selected($selected,$bs,false).">{$bv}</option>";
                          endforeach;?>
                        </select>
                      </div>
                      <div class="column four-fifth last">
                        <p class="note"><?php esc_html_e('Choose post style to display related portfolio items.', 'veda');?></p>
                      </div>
                    </div>

                    <div class="column one-half last"></div>
                    <div class="hr"></div>

                	<div class="column one-half">
                    	<h6><?php esc_html_e('Allow Grid Space', 'veda');?></h6>
                        <div class="column one-fifth">
                        	<?php $checked = ( "true" ==  veda_option('pageoptions','portfolio-allow-grid-space') ) ? ' checked="checked"' : ''; ?>
                            <?php $switchclass = ( "true" ==  veda_option('pageoptions','portfolio-allow-grid-space') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                        	<div data-for="dttheme-portfolio-allow-grid-space" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                            <input class="hidden" id="dttheme-portfolio-allow-grid-space" name="dttheme[pageoptions][portfolio-allow-grid-space]"
                            	type="checkbox" value="true" <?php echo $checked;?> />                        
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('YES! to allow grid space', 'veda');?></p>
                        </div>
                    </div>

                	<div class="column one-half last">
                    	<h6><?php esc_html_e('Allow Full Width', 'veda');?></h6>
                        <div class="column one-fifth">
                        	<?php $checked = ( "true" ==  veda_option('pageoptions','portfolio-allow-full-width') ) ? ' checked="checked"' : ''; ?>
                            <?php $switchclass = ( "true" ==  veda_option('pageoptions','portfolio-allow-full-width') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                        	<div data-for="dttheme-portfolio-allow-full-width" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                            <input class="hidden" id="dttheme-portfolio-allow-full-width" name="dttheme[pageoptions][portfolio-allow-full-width]"
                            	type="checkbox" value="true" <?php echo $checked;?> />                        
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('YES! to allow full width', 'veda');?></p>
                        </div>
                    </div>
                </div>                

                <div class="box-title">
                    <h3><?php esc_html_e('Portfolio Custom Fields', 'veda');?></h3>
                </div>

                <div class="box-content">
                    <div class="portfolio-custom-fields">
                        <input type="button" class="black add-custom-field" value="<?php esc_attr_e('Add New Field', 'veda');?>" />
                        <p class="note"><?php esc_html_e('You can create custom fields like name, url and date etc', 'veda');?></p>
                        <div class="hr_invisible"> </div>

                        <?php $custom_fields = veda_option("pageoptions","portfolio-custom-fields");
                              $custom_fields = is_array($custom_fields) ? array_filter($custom_fields) : array();
                              $custom_fields = array_unique( $custom_fields);
							  foreach( $custom_fields as $field ){ ?>
                                  <div class="custom-field-container">
									  <div class="hr_invisible"> </div>
                                      <input class="medium" type="text" name="<?php echo "dttheme[pageoptions][portfolio-custom-fields][]";?>" value="<?php echo esc_attr($field);?>">
                                      <a href='' class='remove-custom-field'><?php esc_html_e('Remove', 'veda');?></a>
                                  </div>
						<?php } ?>
                        <div class="clone hidden">
                            <div class="custom-field-container">
								<div class="hr_invisible"> </div>                            
                                <input class="medium" type="text" name="<?php echo "dttheme[pageoptions][portfolio-custom-fields][]";?>" value="">
                                <a href='' class='remove-custom-field'><?php esc_html_e('Remove', 'veda');?></a>
                            </div>
                        </div>
                    </div>
				</div>

                <div class="box-title">
                    <h3><?php esc_html_e('Permalinks', 'veda');?></h3>
                </div>

                <div class="box-content">
                    <div class="column one-third"><label><?php esc_html_e('Single Portfolio slug', 'veda');?></label></div>
                    <div class="column two-third last">
                        <input name="dttheme[pageoptions][single-portfolio-slug]" type="text" class="medium" value="<?php echo trim(stripslashes(veda_option('pageoptions','single-portfolio-slug')));?>" />
                        <p class="note"><?php esc_html_e('Do not use characters not allowed in links. Use, eg. portfolio-item <br> <b>After change go to Settings > Permalinks and click Save changes.</b>', 'veda');?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Portfolio Category slug', 'veda');?></label></div>
                    <div class="column two-third last">
                        <input name="dttheme[pageoptions][portfolio-category-slug]" type="text" class="medium" value="<?php echo trim(stripslashes(veda_option('pageoptions','portfolio-category-slug')));?>" />
                        <p class="note"><?php esc_html_e('Do not use characters not allowed in links. Use, eg. portfolio-types <br> <b>After change go to Settings > Permalinks and click Save changes.</b>', 'veda');?></p>
                    </div>
				</div>
            </div><!-- .bpanel-box end -->
        </div><!--#tab2-portfolio end-->

        <!-- #tab3-404 -->
        <div id="tab3" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('404 Message', 'veda');?></h3>
                </div>

                <div class="box-content">
					<div class="column one-half">
                        <h6><?php esc_html_e('Enable Message', 'veda');?></h6>
                        <div class="column one-fifth">
                              <?php $checked = ( "true" ==  veda_option('pageoptions','enable-404message') ) ? ' checked="checked"' : ''; ?>
                              <?php $switchclass = ( "true" ==  veda_option('pageoptions','enable-404message') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                              <div data-for="dttheme-enable-404message" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                              <input class="hidden" id="dttheme-enable-404message" name="dttheme[pageoptions][enable-404message]" type="checkbox" value="true" <?php echo $checked;?> />
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('YES! to enable not-found page message.', 'veda');?></p>
                        </div>
                    </div>
                    <div class="column one-half last">
						<h6><?php esc_html_e('Template Style', 'veda');?></h6>
                        <div class="column one-fifth">
                            <select name="dttheme[pageoptions][notfound-style]" class="dt-chosen-select"><?php
                                $selected = veda_option('pageoptions','notfound-style');
                                $comingsoon_styles =  array( 'type1' => esc_html__('Modern','veda'), 'type2' => esc_html__('Classic','veda'), 'type3' => esc_html__('Diamond','veda'),
                                    'type4' => esc_html__('Girly','veda'), 'type5' => esc_html__('Shadow','veda'), 'type6' => esc_html__('Stack','veda'),
                                    'type7' => esc_html__('Diamond Alt','veda'), 'type8' => esc_html__('Minimal','veda'));
                                    
                                foreach( $comingsoon_styles as $bs => $bv ):
                                    echo "<option value='{$bs}'".selected($selected,$bs,false).">{$bv}</option>";
                                endforeach;?></select>
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('Choose the style of not-found template page.', 'veda');?></p>
                        </div>
                    </div>
                    <div class="hr"></div>

					<div class="column one-column">
                        <h6><?php esc_html_e('Custom Page', 'veda');?></h6>
                        <select name="dttheme[pageoptions][notfound-pageid]" class="dt-chosen-select">
							<option value=""><?php esc_html_e('Choose the page', 'veda'); ?></option><?php
                            $selected = veda_option('pageoptions','notfound-pageid');
							$pages = get_pages ( 'title_li=&orderby=name' );
							foreach ( $pages as $page ) :
								$id = esc_attr ( $page->ID );
								$title = esc_html ( $page->post_title );
								echo "<option value='{$id}' " . selected ( $selected, $id, false ) . ">{$title}</option>";
							endforeach ?>
                        </select>
                        <p class="note"><?php esc_html_e('Choose the page for not-found content.', 'veda');?></p>
					</div>
				</div>

				<div class="box-title">
                    <h3><?php esc_html_e('Background Options', 'veda');?></h3>
                </div>
                <div class="box-content">
                    <h6><?php esc_html_e("Background Image", 'veda');?></h6>
                    <div class="clear"></div>
                    <div class="image-preview-container">
                        <input id="dttheme-notfound-bg" name="dttheme[pageoptions][notfound-bg]" type="text" class="uploadfield large" readonly="readonly"
                                value="<?php echo veda_option('pageoptions','notfound-bg');?>"/>
                        <input type="button" value="<?php esc_attr_e('Upload', 'veda');?>" class="upload_image_button show_preview" />
                        <input type="button" value="<?php esc_attr_e('Remove', 'veda');?>" class="upload_image_reset" />
                        <?php veda_adminpanel_image_preview(veda_option('pageoptions','notfound-bg'));?>
                    </div>
                    <p class="note"><?php esc_html_e("Upload an image for not-found page's background", 'veda');?> </p>

                    <div class="hr_invisible"> </div>

                    <!-- Not Found BG Settings -->
                    <div class="column one-half">
                    <?php $bg_settings = array(
                                array(
                                    "label"=>	esc_html__('Background Image Repeat', 'veda'),
                                    "tooltip"=>	esc_html__("Select how would you like to repeat the background image", 'veda'),
                                    "name" => "dttheme[pageoptions][notfound-bg-repeat]",
                                    "db-key"=>"notfound-bg-repeat",
                                    "options"=>  array("repeat","repeat-x","repeat-y","no-repeat")
                                ),
                                array(
                                    "label"=>esc_html__('Background Image Position', 'veda'),
                                    "tooltip"=>	esc_html__("Select how would you like to position the background", 'veda'),
                                    "name" => "dttheme[pageoptions][notfound-bg-position]",
                                    "db-key"=>"notfound-bg-position",
                                    "options"=>  array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right")
                                )
                          );    
                          foreach($bg_settings as $bgsettings): ?>
                              <div class="bpanel-option-set">
                                <label><?php echo $bgsettings['label'];?></label>
                                <div class="clear"></div>
                                <select name="<?php echo esc_attr($bgsettings['name']);?>" class="dt-chosen-select">
                                    <option value=""><?php esc_html_e("Select", 'veda');?></option>
                                    <?php foreach($bgsettings['options'] as $option):?>
                                        <option value="<?php echo esc_attr($option);?>"
                                            <?php selected($option,veda_option('pageoptions',$bgsettings['db-key'])); ?>><?php echo $option;?></option>
                                    <?php endforeach;?>
                                </select>
                                <p class="note"><?php echo $bgsettings['tooltip'];?></p>
                                <div class="hr_invisible"> </div>
                              </div><?php
                          endforeach;?>
    
                          <div class="bpanel-option-set">
                             <h6><?php esc_html_e("Show Background Color", 'veda');?></h6>
                             <?php veda_switch("",'pageoptions','show-notfound-bg-color');?>
                             <p class="note"><?php esc_html_e("YES! to use background color.", 'veda');?></p>
                          </div>
                    </div><!-- Not Found BG Settings End -->
                    
                     <!-- Not Found BG Color -->
                     <div class="column one-half last">
                        <?php $label = 		esc_html__("Background Color", 'veda');
                              $name  =		"dttheme[pageoptions][notfound-bg-color]";
                              $value =  	(veda_option('pageoptions','notfound-bg-color') != NULL) ? veda_option('pageoptions','notfound-bg-color') :"";
                              $tooltip = 	esc_html__("Pick a background color of the page.(e.g. #a314a3)", 'veda');
                              veda_admin_color_picker($label,$name,$value,'');?>
                              <p class="note"><?php echo esc_html($tooltip);?></p>
                              <div class="hr_invisible"> </div>
                            
                         <?php echo veda_admin_jqueryuislider( esc_html__("Background opacity", 'veda'),	"dttheme[pageoptions][notfound-bg-opacity]",
                                                                  veda_option("pageoptions","notfound-bg-opacity"),"");?>
						<p class="note"><?php esc_html_e("Set the background color opacity.", 'veda');?> </p>

                        <div class="bpanel-option-set">
                          <label><?php esc_html_e('Background Style', 'veda');?></label>
                          <div class="hr_invisible"> </div>
                          <div class="clear"></div>
                          <textarea id="dttheme[pageoptions][notfound-bg-style]" style="height:60px;" name="dttheme[pageoptions][notfound-bg-style]"><?php echo stripslashes(veda_option('pageoptions', 'notfound-bg-style'));?></textarea>
                          <p class="note"><?php esc_html_e("Paste CSS code for background style.", 'veda');?> </p>
                        </div>                                    
                     </div><!-- Not Found BG Color -->
                </div>
            </div><!-- .bpanel-box end -->
        </div><!--#tab3-404 end-->

        <!-- #tab4-hooks -->
        <div id="tab4" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Top', 'veda');?></h3>
                </div>

                <div class="box-content">
                     <h6><?php esc_html_e('Enable Top Hook', 'veda');?></h6>
                     <div class="column one-fifth">
                          <?php $checked = ( "true" ==  veda_option('pageoptions','enable-top-hook') ) ? ' checked="checked"' : ''; ?>
                          <?php $switchclass = ( "true" ==  veda_option('pageoptions','enable-top-hook') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                          <div data-for="dttheme-pageoptions-top-hook" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                          <input class="hidden" id="dttheme-pageoptions-top-hook" name="dttheme[pageoptions][enable-top-hook]" type="checkbox" value="true" <?php echo $checked;?> />
                     </div>
                     <div class="column four-fifth last">
                        <p class="note"><?php esc_html_e('YES! to enable top hook.', 'veda');?></p>
                     </div>
                     <div class="clear"></div>
                     <div class="hr_invisible_large"></div>
                     <textarea id="dttheme[pageoptions][top-hook]" name="dttheme[pageoptions][top-hook]"><?php echo stripslashes(veda_option('pageoptions', 'top-hook'));?></textarea>
                      <p class="note"><?php esc_html_e('Paste your top hook, Executes after the opening &lt;body&gt; tag.</b>', 'veda');?></p>
                </div><!-- .box-content -->
                
                <div class="box-title">
                    <h3><?php esc_html_e('Content Before', 'veda');?></h3>
                </div>

                <div class="box-content">
                     <h6><?php esc_html_e('Enable Content Before Hook', 'veda');?></h6>
                     <div class="column one-fifth">
                          <?php $checked = ( "true" ==  veda_option('pageoptions','enable-content-before-hook') ) ? ' checked="checked"' : ''; ?>
                          <?php $switchclass = ( "true" ==  veda_option('pageoptions','enable-content-before-hook') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                          <div data-for="dttheme-pageoptions-content-before-hook" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                          <input class="hidden" id="dttheme-pageoptions-content-before-hook" name="dttheme[pageoptions][enable-content-before-hook]" type="checkbox" value="true" <?php echo $checked;?> />
                     </div>
                     <div class="column four-fifth last">
                        <p class="note"><?php esc_html_e('YES! to enable content before hook.', 'veda');?></p>
                     </div>
                     <div class="clear"></div>
                     <div class="hr_invisible_large"></div>
                     <textarea id="dttheme[pageoptions][content-before-hook]" name="dttheme[pageoptions][content-before-hook]"><?php echo stripslashes(veda_option('pageoptions', 'content-before-hook'));?></textarea>
                     <p class="note"><?php esc_html_e('Paste your content before hook, Executes before the opening &lt;#Wrapper&gt; tag.</b>', 'veda');?></p>
                </div><!-- .box-content -->

                <div class="box-title">
                    <h3><?php esc_html_e('Content After', 'veda');?></h3>
                </div>

                <div class="box-content">
                     <h6><?php esc_html_e('Enable Content After Hook', 'veda');?></h6>
                     <div class="column one-fifth">
                          <?php $checked = ( "true" ==  veda_option('pageoptions','enable-content-after-hook') ) ? ' checked="checked"' : ''; ?>
                          <?php $switchclass = ( "true" ==  veda_option('pageoptions','enable-content-after-hook') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                          <div data-for="dttheme-pageoptions-content-after-hook" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                          <input class="hidden" id="dttheme-pageoptions-content-after-hook" name="dttheme[pageoptions][enable-content-after-hook]" type="checkbox" value="true" <?php echo $checked;?> />
                     </div>
                     <div class="column four-fifth last">
                        <p class="note"><?php esc_html_e('YES! to enable content after hook.', 'veda');?></p>
                     </div>
                     <div class="clear"></div>
                     <div class="hr_invisible_large"></div>
                     <textarea id="dttheme[pageoptions][content-after-hook]" name="dttheme[pageoptions][content-after-hook]"><?php echo stripslashes(veda_option('pageoptions', 'content-after-hook'));?></textarea>
                     <p class="note"><?php esc_html_e('Paste your content after hook, Executes after the closing &lt;/#Wrapper&gt; tag.</b>', 'veda');?></p>                     
                </div><!-- .box-content -->

                <div class="box-title">
                    <h3><?php esc_html_e('Bottom', 'veda');?></h3>
                </div>

                <div class="box-content">
                     <h6><?php esc_html_e('Enable Bottom Hook', 'veda');?></h6>
                     <div class="column one-fifth">
                          <?php $checked = ( "true" ==  veda_option('pageoptions','enable-bottom-hook') ) ? ' checked="checked"' : ''; ?>
                          <?php $switchclass = ( "true" ==  veda_option('pageoptions','enable-bottom-hook') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                          <div data-for="dttheme-pageoptions-bottom-hook" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                          <input class="hidden" id="dttheme-pageoptions-bottom-hook" name="dttheme[pageoptions][enable-bottom-hook]" type="checkbox" value="true" <?php echo $checked;?> />
                     </div>
                     <div class="column four-fifth last">
                        <p class="note"><?php esc_html_e('YES! to enable bottom hook.', 'veda');?></p>
                     </div>
                     <div class="clear"></div>
                     <div class="hr_invisible_large"></div>
                     <textarea id="dttheme[pageoptions][bottom-hook]" name="dttheme[pageoptions][bottom-hook]"><?php echo stripslashes(veda_option('pageoptions', 'bottom-hook'));?></textarea>
                     <p class="note"><?php esc_html_e('Paste your bottom hook, Executes after the closing &lt;/body&gt; tag.</b>', 'veda');?></p>
                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->
        </div><!--#tab4-hooks end-->

        <!-- #tab5-comingsoon -->
        <div id="tab5" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Under Construction', 'veda');?></h3>
                </div>
                <div class="box-content">
					<div class="column one-half">
                        <h6><?php esc_html_e('Enable Coming Soon', 'veda');?></h6>
                        <div class="column one-fifth">
                              <?php $checked = ( "true" ==  veda_option('pageoptions','enable-comingsoon') ) ? ' checked="checked"' : ''; ?>
                              <?php $switchclass = ( "true" ==  veda_option('pageoptions','enable-comingsoon') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                              <div data-for="dttheme-enable-comingsoon" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                              <input class="hidden" id="dttheme-enable-comingsoon" name="dttheme[pageoptions][enable-comingsoon]" type="checkbox" value="true" <?php echo $checked;?> />
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('YES! to check under construction page of your website.', 'veda');?></p>
                        </div>
                    </div>
                    <div class="column one-half last">
						<h6><?php esc_html_e('Template Style', 'veda');?></h6>
                        <div class="column one-fifth">
                            <select name="dttheme[pageoptions][comingsoon-style]" class="dt-chosen-select"><?php
                                $selected = veda_option('pageoptions','comingsoon-style');
                                $comingsoon_styles =  array( 'type1' => esc_html__('Diamond','veda'), 'type2' => esc_html__('Teaser','veda'), 'type3' => esc_html__('Minimal','veda'),
                                    'type4' => esc_html__('Counter Only','veda'), 'type5' => esc_html__('Belt','veda'), 'type6' => esc_html__('Classic','veda'),
                                    'type7' => esc_html__('Boxed','veda'));
                                    
                                foreach( $comingsoon_styles as $bs => $bv ):
                                    echo "<option value='{$bs}'".selected($selected,$bs,false).">{$bv}</option>";
                                endforeach;?></select>
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('Choose the style of coming soon template.', 'veda');?></p>
                        </div>
                    </div>
                    <div class="hr"></div>

					<div class="column one-column">
                        <h6><?php esc_html_e('Custom Page', 'veda');?></h6>
                        <select name="dttheme[pageoptions][comingsoon-pageid]" class="dt-chosen-select">
							<option value=""><?php esc_html_e('Choose the page', 'veda'); ?></option><?php
                            $selected = veda_option('pageoptions','comingsoon-pageid');
							$pages = get_pages ( 'title_li=&orderby=name' );
							foreach ( $pages as $page ) :
								$id = esc_attr ( $page->ID );
								$title = esc_html ( $page->post_title );
								echo "<option value='{$id}' " . selected ( $selected, $id, false ) . ">{$title}</option>";
							endforeach ?>
                        </select>
                        <p class="note"><?php esc_html_e('Choose the page for comingsoon content.', 'veda');?></p>
					</div>
					<div class="hr"></div>

					<div class="column one-third">
                        <h6><?php esc_html_e('Show Launch Date', 'veda');?></h6>
                        <div class="column one-fifth">
                              <?php $checked = ( "true" ==  veda_option('pageoptions','show-launchdate') ) ? ' checked="checked"' : ''; ?>
                              <?php $switchclass = ( "true" ==  veda_option('pageoptions','show-launchdate') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                              <div data-for="dttheme-show-launchdate" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                              <input class="hidden" id="dttheme-show-launchdate" name="dttheme[pageoptions][show-launchdate]" type="checkbox" value="true" <?php echo $checked;?> />
                        </div>
                        <div class="column four-fifth last">
                              <p class="note"><?php esc_html_e('YES! to show launch date text.', 'veda');?></p>
                        </div>
                    </div>

					<div class="column one-third">
                    	<h6><?php esc_html_e('Launch Date', 'veda');?></h6>
                        <input type="text" class="large" name="dttheme[pageoptions][comingsoon-launchdate]" placeholder="10/30/2016 12:00:00" value="<?php echo veda_option('pageoptions','comingsoon-launchdate');?>" />
                        <p class="note"><?php esc_html_e('Put Format: 12/30/2016 12:00:00 month/day/year hour:minute:second', 'veda');?></p>
                    </div>
                    <div class="column one-third last">
                    	<h6><?php esc_html_e('UTC Timezone', 'veda');?></h6>
                        <select name="dttheme[pageoptions][comingsoon-timezone]" class="medium"><?php
                            $selected = veda_option('pageoptions','comingsoon-timezone');
                            $timezones =  array(''=>'0','-12'=>'-12','-11'=>'-11','-10'=>'-10','-9'=>'-9','-8'=>'-8',
												'-7'=>'-7','-6'=>'-6','-5'=>'-5','-4'=>'-4','-3'=>'-3','-2'=>'-2','-1'=>'-1',
												'+1'=>'+1','+2'=>'+2','+3'=>'+3','+4'=>'+4','+5'=>'+5','+6'=>'+6',
												'+7'=>'+7','+8'=>'+8','+9'=>'+9','+10'=>'+10','+11'=>'+11','+12'=>'+12');
                            foreach( $timezones as $tv ):
                                echo "<option value='{$tv}'".selected($selected,$tv,false).">{$tv}</option>";
                            endforeach;?></select>
                        <p class="note"><?php esc_html_e('Choose utc timezone, by default UTC:00:00', 'veda');?></p>
                    </div>
                </div>

				<div class="box-title">
                    <h3><?php esc_html_e('Background Options', 'veda');?></h3>
                </div>
                <div class="box-content">
                    <h6><?php esc_html_e("Background Image", 'veda');?></h6>
                    <div class="clear"></div>
                    <div class="image-preview-container">
                        <input id="dttheme-comingsoon-bg" name="dttheme[pageoptions][comingsoon-bg]" type="text" class="uploadfield large" readonly="readonly"
                                value="<?php echo veda_option('pageoptions','comingsoon-bg');?>"/>
                        <input type="button" value="<?php esc_attr_e('Upload', 'veda');?>" class="upload_image_button show_preview" />
                        <input type="button" value="<?php esc_attr_e('Remove', 'veda');?>" class="upload_image_reset" />
                        <?php veda_adminpanel_image_preview(veda_option('pageoptions','comingsoon-bg'));?>
                    </div>
                    <p class="note"><?php esc_html_e("Upload an image for coming soon page's background", 'veda');?> </p>

                    <div class="hr_invisible"> </div>

                    <!-- Coming Soon BG Settings -->
                    <div class="column one-half">
                    <?php $bg_settings = array(
                                array(
                                    "label"=>	esc_html__('Background Image Repeat', 'veda'),
                                    "tooltip"=>	esc_html__("Select how would you like to repeat the background image", 'veda'),
                                    "name" => "dttheme[pageoptions][comingsoon-bg-repeat]",
                                    "db-key"=>"comingsoon-bg-repeat",
                                    "options"=>  array("repeat","repeat-x","repeat-y","no-repeat")
                                ),
                                array(
                                    "label"=>esc_html__('Background Image Position', 'veda'),
                                    "tooltip"=>	esc_html__("Select how would you like to position the background", 'veda'),
                                    "name" => "dttheme[pageoptions][comingsoon-bg-position]",
                                    "db-key"=>"comingsoon-bg-position",
                                    "options"=>  array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right")
                                )
                          );    
                          foreach($bg_settings as $bgsettings): ?>
                              <div class="bpanel-option-set">
                                <label><?php echo $bgsettings['label'];?></label>
                                <div class="clear"></div>
                                <select name="<?php echo esc_attr($bgsettings['name']);?>" class="dt-chosen-select">
                                    <option value=""><?php esc_html_e("Select", 'veda');?></option>
                                    <?php foreach($bgsettings['options'] as $option):?>
                                        <option value="<?php echo esc_attr($option);?>"
                                            <?php selected($option,veda_option('pageoptions',$bgsettings['db-key'])); ?>><?php echo $option;?></option>
                                    <?php endforeach;?>
                                </select>
                                <p class="note"><?php echo $bgsettings['tooltip'];?></p>
                                <div class="hr_invisible"> </div>
                              </div><?php
                          endforeach;?>
    
                          <div class="bpanel-option-set">
                             <h6><?php esc_html_e("Show Background Color", 'veda');?></h6>
                             <?php veda_switch("",'pageoptions','show-comingsoon-bg-color');?>
                             <p class="note"><?php esc_html_e('YES! to use background color.','veda');?></p>
                          </div>
                    </div><!-- Coming Soon BG Settings End -->

                     <!-- Coming Soon BG Color -->
                     <div class="column one-half last">
                        <?php $label = 		esc_html__("Background Color", 'veda');
                              $name  =		"dttheme[pageoptions][comingsoon-bg-color]";
                              $value =  	(veda_option('pageoptions','comingsoon-bg-color') != NULL) ? veda_option('pageoptions','comingsoon-bg-color') :"";
                              $tooltip = 	esc_html__("Pick a background color of the page.(e.g. #a314a3)", 'veda');
                              veda_admin_color_picker($label,$name,$value,'');?>
                              <p class="note"><?php echo esc_html($tooltip);?></p>
                              <div class="hr_invisible"> </div>

                         <?php echo veda_admin_jqueryuislider( esc_html__("Background opacity", 'veda'), "dttheme[pageoptions][comingsoon-bg-opacity]",
                            veda_option("pageoptions","comingsoon-bg-opacity"),"");?>
							           <p class="note"><?php esc_html_e("Set the background color opacity.", 'veda');?> </p>
                         
                        <div class="bpanel-option-set">
                          <label><?php esc_html_e('Background Style', 'veda');?></label>
                          <div class="hr_invisible"> </div>
                          <div class="clear"></div>
                          <textarea id="dttheme[pageoptions][comingsoon-bg-style]" style="height:60px;" name="dttheme[pageoptions][comingsoon-bg-style]"><?php echo stripslashes(veda_option('pageoptions', 'comingsoon-bg-style'));?></textarea>
                          <p class="note"><?php esc_html_e("Paste CSS code for background style.", 'veda');?> </p>
                        </div>
                     </div><!-- Coming Soon BG Color -->
                </div>
            </div>
        </div>

    </div><!-- .bpanel-main-content end-->
</div><!-- #pageoptions end-->