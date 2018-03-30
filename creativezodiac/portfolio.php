 <?php 
   global $options;
foreach ($options as $value) {
    if (get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; }
    else { $$value['id'] =get_option( $value['id'] ); }
     $$value['id'] = stripslashes($$value['id']);
    } 
 ?>

<div id="content_bg">   
    <?php include "navigation.php"; ?>
    <div class="blur_left"></div>
    <div class="blur_right"></div>
    <div class="main_content_area" id="loader-template" style="display:none;">
    	<div class="page">
        	<div class="loader_template_wrapper"><img src="<?php echo get_bloginfo('template_url');?>/gfx/loader.gif" class="loader_image" alt="loader" /></div><!-- END "loader_template_wrapper" -->
        </div><!-- END "page" -->
    </div><!-- END "main_content_area" -->
        <div class="main_content_area" id="main_content-0" style="display:none;">
      <div class="page_default_wrapper">
          <div class="page page_default">
          </div><!-- END "page_default" -->
          <div class="page_default_blur_top"></div>
          <div class="page_default_blur_bottom"></div>
      </div>
    </div><!-- END "main_content_area" -->
    <div class="main_content_area" id="main_content-1" style="display:none;">
        <div class="page_default_wrapper">
          <div class="page page_default">
          </div><!-- END "page_default" -->
          <div class="page_default_blur_top"></div>
          <div class="page_default_blur_bottom"></div>
      </div>
    </div><!-- END "main_content_area" -->
    <div class="main_content_area" id="gallery-template-0" style="display:none;">
        <div class="portfolio">
        	<div class="portfolio_left">
            	<div class="big_image_wrapper">
                	<img src="" class="big_image" id="big_image_down-0" alt="Big Image" />
                    <img src="" class="big_image" id="big_image_up-0" alt="Big Image" />
                    <img src="<?php echo get_bloginfo('template_url');?>/gfx/port_bigimg_play.png" class="port_bigimg_play" alt="port_bigimg_play" />
                    <div class="big_image_border"></div>
                    <div class="big_image_hover_wrapper">
                    	<div class="big_image_hover_buttons">
                        	<div class="left_button_wrapper">
                            	<div class="left_button"></div>
                            </div><!-- END "left_button_wrapper" -->
                            <div class="center_button_wrapper">
                            	<a href="#" id="center_button_portfolio-0" class="center_button_zoom_image"></a>
                            </div><!-- END "center_button_wrapper" -->
                            <div class="right_button_wrapper">
                            	<div class="right_button"></div>
                            </div><!-- END "right_button_wrapper" -->
                        </div><!-- END "big_image_hover_buttons" -->
                        <div class="text_wrapper">
                        	<h2 class="item_name"></h2>
                        	<p class="item_description"></p>
                        </div><!-- END "text_wrapper" -->
                    </div><!-- END "big_image_hover_wrapper" -->
                </div><!-- END "big_image_wrapper" --> 
            </div><!-- END "portfolio_left" --> 
            <div class="portfolio_right">
                <div class="thumbs_wrapper">
                    <div class="thumbs">
                        <div class="thumb_wrapper">
                            <div class="thumb">
                                <img src="" class="thumb_image" alt="thumb" />
                                <img src="<?php echo get_bloginfo('template_url');?>/gfx/port_thumb_play.png" class="port_thumb_play" alt="port_thumb_play" />
                                <div class="thumb_border"></div><!-- END "thumb_border" -->
                                <div class="thumb_shine"></div><!-- END "thumb_shine" -->
                            </div><!-- END "thumb" -->
                        </div><!-- END "thumb_wrapper" -->
                        <div class="thumb_wrapper">
                            <div class="thumb">
                                <img src="" class="thumb_image" alt="thumb" />
                                <img src="<?php echo get_bloginfo('template_url');?>/gfx/port_thumb_play.png" class="port_thumb_play" alt="port_thumb_play" />
                                <div class="thumb_border"></div><!-- END "thumb_border" -->
                                <div class="thumb_shine"></div><!-- END "thumb_shine" -->
                            </div><!-- END "thumb" -->
                        </div><!-- END "thumb_wrapper" -->
                        <div class="thumb_wrapper">
                            <div class="thumb">
                                <img src="" class="thumb_image" alt="thumb" />
                                <img src="<?php echo get_bloginfo('template_url');?>/gfx/port_thumb_play.png" class="port_thumb_play" alt="port_thumb_play" />
                                <div class="thumb_border"></div><!-- END "thumb_border" -->
                                <div class="thumb_shine"></div><!-- END "thumb_shine" -->
                            </div><!-- END "thumb" -->
                        </div><!-- END "thumb_wrapper" -->
                        <div class="thumb_wrapper">
                            <div class="thumb">
                                <img src="" class="thumb_image" alt="thumb" />
                                <img src="<?php echo get_bloginfo('template_url');?>/gfx/port_thumb_play.png" class="port_thumb_play" alt="port_thumb_play" />
                                <div class="thumb_border"></div><!-- END "thumb_border" -->
                                <div class="thumb_shine"></div><!-- END "thumb_shine" -->
                            </div><!-- END "thumb" -->
                        </div><!-- END "thumb_wrapper" -->
                        <div class="thumb_wrapper">
                            <div class="thumb">
                                <img src="" class="thumb_image" alt="thumb" />
                                <img src="<?php echo get_bloginfo('template_url');?>/gfx/port_thumb_play.png" class="port_thumb_play" alt="port_thumb_play" />
                                <div class="thumb_border"></div><!-- END "thumb_border" -->
                                <div class="thumb_shine"></div><!-- END "thumb_shine" -->
                            </div><!-- END "thumb" -->
                        </div><!-- END "thumb_wrapper" -->
                        <div class="thumb_wrapper">
                            <div class="thumb">
                                <img src="" class="thumb_image" alt="thumb" />
                                <img src="<?php echo get_bloginfo('template_url');?>/gfx/port_thumb_play.png" class="port_thumb_play" alt="port_thumb_play" />
                                <div class="thumb_border"></div><!-- END "thumb_border" -->
                                <div class="thumb_shine"></div><!-- END "thumb_shine" -->
                            </div><!-- END "thumb" -->
                        </div><!-- END "thumb_wrapper" -->
                    </div><!-- END "thumbs" -->
                </div><!-- END "thumbs_wrapper" -->
                <div class="port_prev_next_wrapper">
                	<div class="port_prev">
                    	<p class="port_prev_text"><?php echo $cz_gallery_prev; ?></p>
                    </div><!-- END "port_prev" --> 
                    <div class="port_next">
                    	<p class="port_next_text"><?php echo $cz_gallery_next; ?></p>
                    </div><!-- END "port_next" --> 
                </div><!-- END "port_prev_next_wrapper" --> 
			</div><!-- END "portfolio_right" --> 
        </div><!-- END "portfolio" -->
    </div><!-- END "main_content_area" -->
    <div class="main_content_area" id="gallery-template-1" style="display:none;">
        <div class="portfolio">
        	<div class="portfolio_left">
            	<div class="big_image_wrapper">
                	<img src="" class="big_image" id="big_image_down-1" alt="Big Image" />
                    <img src="" class="big_image" id="big_image_up-1" alt="Big Image" />
                    <img src="<?php echo get_bloginfo('template_url');?>/gfx/port_bigimg_play.png" class="port_bigimg_play" alt="port_bigimg_play" />
                    <div class="big_image_border"></div>
                    <div class="big_image_hover_wrapper">
                    	<div class="big_image_hover_buttons">
                        	<div class="left_button_wrapper">
                            	<div class="left_button"></div>
                            </div><!-- END "left_button_wrapper" -->
                            <div class="center_button_wrapper">
                            	<a href="#" id="center_button_portfolio-1" class="center_button_zoom_image"></a>
                            </div><!-- END "center_button_wrapper" -->
                            <div class="right_button_wrapper">
                            	<div class="right_button"></div>
                            </div><!-- END "right_button_wrapper" -->
                        </div><!-- END "big_image_hover_buttons" -->
                        <div class="text_wrapper">
                        	<h2 class="item_name"></h2>
                        	<p class="item_description"></p>
                        </div><!-- END "text_wrapper" -->
                    </div><!-- END "big_image_hover_wrapper" -->
                </div><!-- END "big_image_wrapper" --> 
            </div><!-- END "portfolio_left" --> 
            <div class="portfolio_right">
                <div class="thumbs_wrapper">
                    <div class="thumbs">
                        <div class="thumb_wrapper">
                            <div class="thumb">
                                <img src="" class="thumb_image" alt="thumb" />
                                <img src="<?php echo get_bloginfo('template_url');?>/gfx/port_thumb_play.png" class="port_thumb_play" alt="port_thumb_play" />
                                <div class="thumb_border"></div><!-- END "thumb_border" -->
                                <div class="thumb_shine"></div><!-- END "thumb_shine" -->
                            </div><!-- END "thumb" -->
                        </div><!-- END "thumb_wrapper" -->
                        <div class="thumb_wrapper">
                            <div class="thumb">
                                <img src="" class="thumb_image" alt="thumb" />
                                <img src="<?php echo get_bloginfo('template_url');?>/gfx/port_thumb_play.png" class="port_thumb_play" alt="port_thumb_play" />
                                <div class="thumb_border"></div><!-- END "thumb_border" -->
                                <div class="thumb_shine"></div><!-- END "thumb_shine" -->
                            </div><!-- END "thumb" -->
                        </div><!-- END "thumb_wrapper" -->
                        <div class="thumb_wrapper">
                            <div class="thumb">
                                <img src="" class="thumb_image" alt="thumb" />
                                <img src="<?php echo get_bloginfo('template_url');?>/gfx/port_thumb_play.png" class="port_thumb_play" alt="port_thumb_play" />
                                <div class="thumb_border"></div><!-- END "thumb_border" -->
                                <div class="thumb_shine"></div><!-- END "thumb_shine" -->
                            </div><!-- END "thumb" -->
                        </div><!-- END "thumb_wrapper" -->
                        <div class="thumb_wrapper">
                            <div class="thumb">
                                <img src="" class="thumb_image" alt="thumb" />
                                <img src="<?php echo get_bloginfo('template_url');?>/gfx/port_thumb_play.png" class="port_thumb_play" alt="port_thumb_play" />
                                <div class="thumb_border"></div><!-- END "thumb_border" -->
                                <div class="thumb_shine"></div><!-- END "thumb_shine" -->
                            </div><!-- END "thumb" -->
                        </div><!-- END "thumb_wrapper" -->
                        <div class="thumb_wrapper">
                            <div class="thumb">
                                <img src="" class="thumb_image" alt="thumb" />
                                <img src="<?php echo get_bloginfo('template_url');?>/gfx/port_thumb_play.png" class="port_thumb_play" alt="port_thumb_play" />
                                <div class="thumb_border"></div><!-- END "thumb_border" -->
                                <div class="thumb_shine"></div><!-- END "thumb_shine" -->
                            </div><!-- END "thumb" -->
                        </div><!-- END "thumb_wrapper" -->
                        <div class="thumb_wrapper">
                            <div class="thumb">
                                <img src="" class="thumb_image" alt="thumb" />
                                <img src="<?php echo get_bloginfo('template_url');?>/gfx/port_thumb_play.png" class="port_thumb_play" alt="port_thumb_play" />
                                <div class="thumb_border"></div><!-- END "thumb_border" -->
                                <div class="thumb_shine"></div><!-- END "thumb_shine" -->
                            </div><!-- END "thumb" -->
                        </div><!-- END "thumb_wrapper" -->
                    </div><!-- END "thumbs" -->
                </div><!-- END "thumbs_wrapper" -->
                <div class="port_prev_next_wrapper">
                	<div class="port_prev">
                    	<p class="port_prev_text"><?php echo $cz_gallery_prev; ?></p>
                    </div><!-- END "port_prev" --> 
                    <div class="port_next">
                    	<p class="port_next_text"><?php echo $cz_gallery_next; ?></p>
                    </div><!-- END "port_next" --> 
                </div><!-- END "port_prev_next_wrapper" --> 
			</div><!-- END "portfolio_right" --> 
        </div><!-- END "portfolio" -->
    </div><!-- END "main_content_area" -->
        <div class="main_content_area" id="blog-template-0" style="display:none;">
        <div class="page">
            <div class="blog">
            	<div class="blog_left_column">
                	<div class="icon_wrapper icon_wrapper_article" id="article_switch-0">
                    	<div class="icon_wrapper_bg"></div>
                    	<img src="<?php echo get_bloginfo('template_url');?>/gfx/blog_icons/icon_article.png" class="icon_article" id="icon-article-0" alt="Article" />
                        <span class="icon_desc" id="icon-desc-article-0"><?php echo $cz_blogleft_article; ?></span>
                    </div><!-- END "icon_wrapper" -->
                    <div class="icon_wrapper icon_wrapper_comments" id="comments_switch-0">
                    	<div class="icon_wrapper_bg"></div>
                    	<img src="<?php echo get_bloginfo('template_url');?>/gfx/blog_icons/icon_comments.png" class="icon_comments" id="icon-comments-0" alt="Comments" />
                        <span class="comments_number" id="icon-comments-number-0"></span>
                        <span class="icon_desc" id="icon-desc-comments-0"><?php echo $cz_blogleft_comments; ?></span>
                    </div><!-- END "icon_wrapper" -->
                    <div class="icon_wrapper icon_wrapper_gallery" id="gallery_switch-0">
                    	<div class="icon_wrapper_bg"></div>
                    	<img src="<?php echo get_bloginfo('template_url');?>/gfx/blog_icons/icon_gallery.png" class="icon_gallery" id="icon-gallery-0" alt="Gallery" />
                        <span class="icon_desc" id="icon-desc-gallery-0"><?php echo $cz_blogleft_gallery; ?></span>
                    </div><!-- END "icon_wrapper" -->
                    <div class="icon_wrapper icon_wrapper_share" id="share_switch-0">
                    	<div class="icon_wrapper_bg"></div>
                    	<img src="<?php echo get_bloginfo('template_url');?>/gfx/blog_icons/icon_share.png" class="icon_share" id="icon-share-0" alt="Share" />
                        <span class="icon_desc" id="icon-desc-share-0"><?php echo $cz_blogleft_share; ?></span>
                    </div><!-- END "icon_wrapper" -->
                    <div class="icon_wrapper icon_wrapper_search" id="search_switch-0">
                    	<div class="icon_wrapper_bg"></div>
                    	<img src="<?php echo get_bloginfo('template_url');?>/gfx/blog_icons/icon_search.png" class="icon_search" id="icon-search-0" alt="Search" />
                        <span class="icon_desc" id="icon-desc-search-0"><?php echo $cz_blogleft_search; ?></span>
                    </div><!-- END "icon_wrapper" -->
                </div><!-- END "blog_left_column" -->
                <div class="blog_center_column">                
                	<div class="blog_content" id="blog_post-0" >
                    	<div class="meta_data">
                        	<p class="categories"></p>
                            <p class="date"></p>
                        </div>
                    	<h1 class="post_title"></h1>
                        <div class="blog_text_content">
                            <div class="blog_big_thumb">
                        		<img src="" class="blog_big_thumb_image" alt="thumb" />
                                <div class="blog_big_thumb_border"></div><!-- END "blog_big_thumb_border" -->
                                <div class="blog_big_thumb_shine"></div><!-- END "blog_big_thumb_shine" -->
                            </div><!-- END "blog_big_thumb" -->
						</div><!-- END "blog_text_content" -->
                    </div><!-- END "blog_content" --> 
                     	<div class="blog_content" id="gallery_page-0" style="display:none">
                      </div><!-- END "blog_content" -->   
                      <div class="blog_content" id="share_page-0" style="display:none">
                      </div><!-- END "blog_content" --> 
                      <div class="blog_content" id="search_page-0" style="display:none">
                        <div id="blog_search_form_wrapper-0" class="blog_search_form_wrapper">
                        	<input type="text" name="search_form" value="<?php echo $cz_blogdesc_search;?>" onfocus="if (this.value == '<?php echo $cz_blogdesc_search;?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $cz_blogdesc_search;?>';}" class="search_input" id="search-input-0" />
                            <div class="search_button" id="blog-search-submit-0"></div><!-- END "search_button" -->
                        </div><!-- END "blog_search_form_wrapper" -->
                        <div class="blog_search_results_divider"></div>
                        <div class="blog_search_results_wrapper">
                        </div><!-- END "blog_search_results_wrapper" -->
                      </div><!-- END "blog_content" -->   
                    <div class="blog_content" id="comments_page-0" style="display:none">
                    </div><!-- END "blog_content" -->
                    <div class="blog_content_blur_top"></div><!-- END "blog_content_blur_top" -->
                    <div class="blog_content_blur_bottom"></div><!-- END "blog_content_blur_bottom" -->
                    <div class="blog_content_scroll">
                    	<div class="blog_content_scrollbar" id="blog_content_scrollbar-0">
                        </div><!-- END "blog_content_scrollbar" -->
                    </div><!-- END "blog_content_scroll" -->
                    <div class="loader_wrapper"><img src="<?php echo get_bloginfo('template_url');?>/gfx/loader.gif" class="loader" alt="loader" /></div>
                </div><!-- END "blog_center_column" -->
                <div class="blog_right_column">
                	<div class="blog_menu">
                    </div><!-- END "blog_menu" -->
                	<div class="right_column_blur_top">
                    	<div class="arrow_top"></div>
                    </div><!-- END "right_column_blur_top" -->
                    <div class="right_column_blur_bottom">
                    	<div class="arrow_bottom"></div>
                    </div><!-- END "right_column_blur_bottom" -->
                    <div class="right_column_blur_left">
                    	<div class="arrow_left"></div>
                    </div><!-- END "right_column_blur_left" -->
                </div><!-- END "blog_right_column" -->
            </div><!-- END "blog" -->
        </div><!-- END "page" -->
    </div><!-- END "main_content_area" -->
            <div class="main_content_area" id="blog-template-1" style="display:none;">
        <div class="page">
            <div class="blog">
            	<div class="blog_left_column">
                	<div class="icon_wrapper icon_wrapper_article" id="article_switch-1">
                    	<div class="icon_wrapper_bg"></div>
                    	<img src="<?php echo get_bloginfo('template_url');?>/gfx/blog_icons/icon_article.png" class="icon_article" id="icon-article-1" alt="Article" />
                        <span class="icon_desc" id="icon-desc-article-1"><?php echo $cz_blogleft_article; ?></span>
                    </div><!-- END "icon_wrapper" -->
                    <div class="icon_wrapper icon_wrapper_comments" id="comments_switch-1">
                    	<div class="icon_wrapper_bg"></div>
                    	<img src="<?php echo get_bloginfo('template_url');?>/gfx/blog_icons/icon_comments.png" class="icon_comments" id="icon-comments-1" alt="Comments" />
                        <span class="comments_number" id="icon-comments-number-1"></span>
                        <span class="icon_desc" id="icon-desc-comments-1"><?php echo $cz_blogleft_comments; ?></span>
                    </div><!-- END "icon_wrapper" -->
                    <div class="icon_wrapper icon_wrapper_gallery" id="gallery_switch-1">
                    	<div class="icon_wrapper_bg"></div>
                    	<img src="<?php echo get_bloginfo('template_url');?>/gfx/blog_icons/icon_gallery.png" class="icon_gallery" id="icon-gallery-1" alt="Gallery" />
                        <span class="icon_desc" id="icon-desc-gallery-1"><?php echo $cz_blogleft_gallery; ?></span>
                    </div><!-- END "icon_wrapper" -->
                    <div class="icon_wrapper icon_wrapper_share" id="share_switch-1">
                    	<div class="icon_wrapper_bg"></div>
                    	<img src="<?php echo get_bloginfo('template_url');?>/gfx/blog_icons/icon_share.png" class="icon_share" id="icon-share-1" alt="Share" />
                        <span class="icon_desc" id="icon-desc-share-1"><?php echo $cz_blogleft_share; ?></span>
                    </div><!-- END "icon_wrapper" -->
                    <div class="icon_wrapper icon_wrapper_search" id="search_switch-1">
                    	<div class="icon_wrapper_bg"></div>
                    	<img src="<?php echo get_bloginfo('template_url');?>/gfx/blog_icons/icon_search.png" class="icon_search" id="icon-search-1" alt="Search" />
                        <span class="icon_desc" id="icon-desc-search-1"><?php echo $cz_blogleft_search; ?></span>
                    </div><!-- END "icon_wrapper" -->
                </div><!-- END "blog_left_column" -->
                <div class="blog_center_column">                
                	<div class="blog_content" id="blog_post-1">
                    	<div class="meta_data">
                        	<p class="categories"></p>
                            <p class="date"></p>
                        </div>
                    	<h1 class="post_title"></h1>
                        <div class="blog_text_content">
                            <div class="blog_big_thumb">
                        		<img src="" class="blog_big_thumb_image" alt="thumb" />
                                <div class="blog_big_thumb_border"></div><!-- END "blog_big_thumb_border" -->
                                <div class="blog_big_thumb_shine"></div><!-- END "blog_big_thumb_shine" -->
                            </div><!-- END "blog_big_thumb" -->
						</div><!-- END "blog_text_content" -->
                    </div><!-- END "blog_content" -->
                    <div class="blog_content" id="gallery_page-1" style="display:none">
                      </div><!-- END "blog_content" -->
                      <div class="blog_content" id="share_page-1" style="display:none">
                      </div><!-- END "blog_content" -->
                      <div class="blog_content" id="search_page-1" style="display:none">
                         <div id="blog_search_form_wrapper-1" class="blog_search_form_wrapper">
                         	<input type="text" name="search_form" value="<?php echo $cz_blogdesc_search;?>" onfocus="if (this.value == '<?php echo $cz_blogdesc_search;?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $cz_blogdesc_search;?>';}" class="search_input" id="search-input-1" />
                          <div class="search_button" id="blog-search-submit-1"></div><!-- END "search_button" -->
                        </div><!-- END "blog_search_form_wrapper" -->
                  		<div class="blog_search_results_divider"></div>
                        <div class="blog_search_results_wrapper">
                        </div><!-- END "blog_search_results_wrapper" -->
                      </div><!-- END "blog_content" -->        
                    <div class="blog_content" id="comments_page-1" style="display:none">
                    </div><!-- END "blog_content" -->                    
                    <div class="blog_content_blur_top"></div><!-- END "blog_content_blur_top" -->
                    <div class="blog_content_blur_bottom"></div><!-- END "blog_content_blur_bottom" -->
                    <div class="blog_content_scroll">
                    	<div class="blog_content_scrollbar" id="blog_content_scrollbar-1">
                        </div><!-- END "blog_content_scrollbar" -->
                    </div><!-- END "blog_content_scroll" -->
                    <div class="loader_wrapper"><img src="<?php echo get_bloginfo('template_url');?>/gfx/loader.gif" class="loader" alt="loader" /></div>
                </div><!-- END "blog_center_column" -->
                <div class="blog_right_column">
                	<div class="blog_menu">
                    </div><!-- END "blog_menu" -->
                	<div class="right_column_blur_top">
                    	<div class="arrow_top"></div>
                    </div><!-- END "right_column_blur_top" -->
                    <div class="right_column_blur_bottom">
                    	<div class="arrow_bottom"></div>
                    </div><!-- END "right_column_blur_bottom" -->
                    <div class="right_column_blur_left">
                    	<div class="arrow_left"></div>
                    </div><!-- END "right_column_blur_left" -->
                </div><!-- END "blog_right_column" -->
            </div><!-- END "blog" -->
        </div><!-- END "page" -->
    </div><!-- END "main_content_area" -->
    <div class="main_content_area" id="contact-template" style="display:none;">
        <div class="contact">
            <div class="contact_left">
            </div><!-- END "contact_right" -->
            <div class="contact_right">
                <div class="contact_blur_left"></div><!-- END "contact_blur_left" -->
                <div class="contact_step_number_wrapper">
                    <div class="contact_blur_top"></div><!-- END "contact_blur_top" -->
                    <div class="contact_blur_bottom"></div><!-- END "contact_blur_bottom" -->
                    <div class="contact_step_number_slider">
                        <div class="contact_step_number_slide">
                            <div class="contact_step_number_round">
                                <span class="contact_step_number">!</span>
                            </div><!-- END "contact_step_number_round" -->
                        </div><!-- END "contact_step_number_slide" -->
                        <div class="contact_step_number_slide">
                            <div class="contact_step_number_round">
                                <span class="contact_step_number">3</span>
                            </div><!-- END "contact_step_number_round" -->
                        </div><!-- END "contact_step_number_slide" -->
                        <div class="contact_step_number_slide">
                            <div class="contact_step_number_round">
                                <span class="contact_step_number">2</span>
                            </div><!-- END "contact_step_number_round" -->
                        </div><!-- END "contact_step_number_slide" -->
                        <div class="contact_step_number_slide">
                            <div class="contact_step_number_round">
                                <span class="contact_step_number">1</span>
                            </div><!-- END "contact_step_number_round" -->
                        </div><!-- END "contact_step_number_slide" -->
                    </div><!-- END "contact_step_number_slider" -->
                </div><!-- END "contact_step_number_wrapper" -->
                <div class="form_steps_wrapper">
                    <div class="form_steps_slider">
                        <div class="form_steps_slide">
                            <div class="form_step_1_wrapper">
                                <h1><?php echo $cz_contact_name; ?></h1>
                                <input type="text" class="form_type_text" value="" />
                                <div class="form_steps_dots_wrapper">
                                    <div class="form_step_dot_on" id="dot_step_1-1"></div>
                                    <div class="form_step_dot_off" id="dot_step_1-2"></div>
                                    <div class="form_step_dot_off" id="dot_step_1-3"></div>
                                </div><!-- END "form_steps_dots_wrapper" -->
                                <span class="go_btn_wrapper contact_next_step_btn" id="next_step_1">
                                    <span class="go_btn_left"></span>
                                    <span class="go_btn_right"><?php echo $cz_contact_next; ?></span>
                                </span><!-- END "go_btn_wrapper contact_next_step_btn" -->
                            </div><!-- END "form_step_1_wrapper" -->
                        </div><!-- END "form_steps_slide" -->
                        <div class="form_steps_slide">
                            <div class="form_step_2_wrapper">
                                <h1><?php echo $cz_contact_email; ?></h1>
                                <input type="text" class="form_type_text" />
                                <div class="form_steps_dots_wrapper">
                                    <div class="form_step_dot_off" id="dot_step_2-1"></div>
                                    <div class="form_step_dot_on" id="dot_step_2-2"></div>
                                    <div class="form_step_dot_off" id="dot_step_2-3"></div>
                                </div><!-- END "form_steps_dots_wrapper" -->
                                <span class="go_btn_wrapper contact_next_step_btn" id="next_step_2">
                                    <span class="go_btn_left"></span>
                                    <span class="go_btn_right"><?php echo $cz_contact_next; ?></span>
                                </span><!-- END "go_btn_wrapper contact_next_step_btn" -->
                            </div><!-- END "form_step_2_wrapper" -->
                        </div><!-- END "form_steps_slide" -->
                        <div class="form_steps_slide">
                            <div class="form_step_3_wrapper">
                                <h1><?php echo $cz_contact_message; ?></h1>
                                <textarea class="form_type_textarea" rows="10" cols="10"></textarea>
                                <div class="form_steps_dots_wrapper">
                                    <div class="form_step_dot_off" id="dot_step_3-1"></div>
                                    <div class="form_step_dot_off" id="dot_step_3-2"></div>
                                    <div class="form_step_dot_on" id="dot_step_3-3"></div>
                                </div><!-- END "form_steps_dots_wrapper" -->
                                <span class="go_btn_wrapper contact_next_step_btn" id="next_step_3">
                                    <span class="go_btn_left"></span>
                                    <span class="go_btn_right"><?php echo $cz_contact_next; ?></span>
                                </span><!-- END "go_btn_wrapper contact_next_step_btn" -->
                            </div><!-- END "form_step_3_wrapper" -->                                
                        </div><!-- END "form_steps_slide" -->
                        <div class="form_steps_slide">
                            <div class="form_step_4_wrapper">
                                <h1><?php echo $cz_contact_ok; ?></h1>
                                <span class="go_btn_wrapper contact_next_step_btn" id="next_step_4">
                                    <span class="go_btn_left"></span>
                                    <span class="go_btn_right"><?php echo $cz_contact_another; ?></span>
                                </span><!-- END "go_btn_wrapper contact_next_step_btn" -->
                            </div><!-- END "form_step_4_wrapper" -->                                
                        </div><!-- END "form_steps_slide" -->
                    </div><!-- END "form_steps_slider" -->
                </div><!-- END "form_steps_wrapper" -->
            </div><!-- END "contact_right" -->
        </div><!-- END "contact" -->
	</div><!-- END "main_content_area" -->
</div><!-- END "content_bg" -->