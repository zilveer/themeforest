            <div id="content-right">
            	<!-- begin of sidebar -->
              <?php
              if($post->post_parent) {
                $children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0&depth=1&menu_order=sort_column");
              }else{
                $children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0&depth=1&menu_order=sort_column");
              }  
              ?>            	
              <?php if ($children) { ?>
            	<div class="sidebar">
                    <h3><?php echo __('More ','vulcan');?><?php echo get_the_title($post->post_parent);?></h3>              
                     <ul class="sidebar-list">
                     	<?php echo $children;?>
                     </ul>             
                </div>
                <div class="sidebar-bottom"></div>
                <?php 
                  }
                ?>                
                <!-- end of sidebar -->
                
                <?php 
                $sidebar_name = get_post_meta($post->ID,"_page_sidebar_widget",true);
                
                if (is_single() || is_archive() || is_category() || is_search() || is_404()) {
            		  dynamic_sidebar('blog-sidebar');
                } else {
                  dynamic_sidebar($sidebar_name);
                }
                
                ?>
            </div>   