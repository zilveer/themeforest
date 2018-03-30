<?php get_header(); ?>

<?php while(have_posts()) : the_post(); ?>
               
    <?php
    
        $sidebar = uxbarn_get_array_value(get_post_meta($post->ID, 'uxbarn_setting_select_custom_sidebar'), 0);
        $sidebar_location = uxbarn_get_array_value(get_post_meta($post->ID, 'uxbarn_sidebar_location'), 0);
        
        $row_color_class = ' no-bg ';
        
        $content_class = '';
        $sidebar_class = '';
        $content_column_class = ' large-9 ';
        
        if($sidebar) {
            if($sidebar_location == 'left') {
                
                $content_class =' push-3 ';
                $sidebar_class = ' pull-9 ';
                
            }
            
            $content_class .= ' with-sidebar white-bg ';
            $row_color_class = ' grey-bg ';
            
        } else {
            $content_column_class = ' large-12 ';
        }
        
    ?>
    
    <div class="row <?php echo $row_color_class; ?>">
        <div class="uxb-col <?php echo $content_column_class; ?> columns for-nested <?php echo $content_class; ?>">
            
            <?php echo uxbarn_get_final_post_content(); ?>
            
            <?php
            
            	$enable_page_comment = false;
				if ( function_exists( 'ot_get_option' ) ) {
					
					$enable_page_comment = ot_get_option('uxbarn_to_setting_enable_page_comment');
					if ( $enable_page_comment == '' || $enable_page_comment == 'false' ) {
						$enable_page_comment = false;
					} else {
						$enable_page_comment = true;
					}
					
				}
            
            ?>
            
            <?php if( $enable_page_comment ) : ?>
                
                <?php if(comments_open()) : ?>
                    
                    <!-- Comment Section -->
                    <div class="row top-margin">
                        <div class="uxb-col large-12 columns">
                            
                            <?php comments_template(); ?>
                            
                        </div>
                    </div>
                    
                <?php endif; ?>
                
            <?php endif; ?>
            
        </div>
        
        <?php if($sidebar) : ?>
        
            <div id="sidebar-wrapper" class="uxb-col large-3 columns for-nested <?php echo $sidebar_class; ?>">
                <?php get_sidebar(); ?>
            </div>
            
        <?php endif; ?>
            
    </div>
        
<?php endwhile; ?> 
        
<?php get_footer(); ?>