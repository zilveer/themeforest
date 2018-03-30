<div class="row">

	            <?php
	
	            //the_post();
	            
	            ?>
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
            
            <div class="four columns">
	        <?php
	        
        		get_template_part( 'sidebar'); 
	        
	        ?>
            </div>
            	            
				<div class="eight columns last" id="post-<?php the_ID();?>">
				
					<div class="entry-content">
	
	                    <?php
	                    
	                    the_content();
	                    
	                    edit_post_link(__('Edit', 'qs_framework'),'<span class="edit-link">','</span>') ?>
	
					</div><!-- .entry-content -->
                    
            <?php        
			
       		comments_template(); // calling the comments template
			?>
            
				</div><!-- #post -->
                
</div>
                