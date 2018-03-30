<div class="row">
			<?php if(qs_get_meta('qs_remove_page_title', get_the_ID()) != '1') { ?>
			<header class="twelve columns entry-title">
				<h1 class="">  
					<?php 
						$page_title = qs_get_meta('qs_page_title', get_the_ID()) ? qs_get_meta('qs_page_title', get_the_ID()) : get_the_title();
						echo $page_title; 
					?>
                </h1>
                <h2 class="subtitle"><?php echo qs_get_meta('qs_page_subtitle', get_the_ID()); ?></h2>
            </header>
            <?php } ?>
            
            

				<div class="eight columns" id="post-<?php the_ID();?>">
	                
					<div class="entry-content">
	
	                    <?php
	                    
	                    the_content();
	                    
	                    wp_link_pages("\t\t\t\t\t<div class='page-link'>".__('Pages: ', 'qs_framework'), "</div>\n", 'number');
	                    
	                    edit_post_link(__('Edit', 'qs_framework'),'<span class="edit-link">','</span>') ?>
                        
                        <?php comments_template(); // calling the comments template?>
	
					</div><!-- .entry-content -->
            
				</div><!-- #post -->
                
			<div class="four columns last">
	        <?php
	        
				get_template_part( 'sidebar'); 
	        
	        ?>
            </div>

</div>