<?php 
get_header();
$gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());
$gt3_theme_pagebuilder['settings']['selected-sidebar-name'] = "WooCommerce";
?>
<div class="content_wrapper">
	<div class="container">
        <div class="content_block woo_wrap row <?php echo esc_attr($gt3_theme_pagebuilder['settings']['layout-sidebars']) ?>">
            <div class="fl-container <?php echo(($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "hasRS" : ""); ?>">
                <div class="row">
                    <div class="posts-block <?php echo($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" ? "hasLS" : ""); ?>">
					<?php if (!isset($gt3_theme_pagebuilder['settings']['show_title']) || $gt3_theme_pagebuilder['settings']['show_title'] !== "no") { ?>
                        <div class="page_title_block">
							<h1 class="title">
                            	<?php 
									if (is_product()) {
										_e('Welcome to Our Shop!', 'theme_localization');
									} else {
										the_title();	
									}
								?>                                
                            </h1>
                        </div>
                    <?php } ?>                    
                        <div class="contentarea woocommerce_container">
                        	<?php
								woocommerce_content();
								wp_link_pages(array('before' => '<div class="page-link">' . __('Pages', 'theme_localization') . ': ', 'after' => '</div>'));
							?>   							
                        </div>
                    </div>
                    <?php get_sidebar('left'); ?>
                </div>
            </div>
            <?php get_sidebar('right'); ?>
        </div>
    </div>
</div>

<script>
	function setUpWindow() {
		"use strict";
		main_wrapper.css('min-height', window_h - parseInt(site_wrapper.css('padding-top')) - parseInt(site_wrapper.css('padding-bottom'))+'px');
		
		if (jQuery('.right-sidebar-block').size() > 0) {		
			if (jQuery('.right-sidebar-block').height() < jQuery('.main_wrapper').height()) {
				jQuery('.right-sidebar-block').css({'min-height' : jQuery('.posts-block').height() + 'px'});
			}
		}
		if (jQuery('.left-sidebar-block').size() > 0) {		
			if (jQuery('.left-sidebar-block').height() < jQuery('.main_wrapper').height()) {
				jQuery('.left-sidebar-block').css({'min-height' : jQuery('.posts-block').height() + 'px'});
			}
		}			
	}
	jQuery(document).ready(function(){
		"use strict";
		setUpWindow();		
	});
	jQuery(window).load(function(){
		"use strict";
		setUpWindow();
	});
	jQuery(window).resize(function(){
		"use strict";
		setUpWindow();
	});
</script>

<?php get_footer(); ?>
    