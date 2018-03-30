<?php get_header(); ?>

<div id="main_content">
	<div class="center1 padding" id="top_light4">
	
  		<div class="center_box">
   		
   			<div class="center_left">
   				<div id="center_left_top" class="center_left_top">
	   				<h3>Free call</h3>
	   				<span>0800 658 9545</span>
	   				<ul id="left_nav">
	   					<?php wp_list_categories('title_li='); ?>
	   				</ul>
                </div>
                <ul class="listing">
	                    <li>Design</li>
	                    <li>(x)HTML/CSS</li>
	                    <li>JavaScript</li>
	                    <li>Custom CMS (BVD)</li>
	            </ul>
	            <ul class="listing">
	                    <li>Project managment</li>
	                    <li>Hosting</li>
	                    <li>Support</li>
	            </ul>
   			</div><!-- end center_left-->
   			
   			<div class="center_right">
   				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
   				
            	<div class="blog_post" id="post-<?php the_ID(); ?>">
   				<h2><?php the_title(); ?></h2>

   				<div class="publish">published on <?php the_time('d.m.Y'); ?> in <?php the_category(', '); ?></div>
   				
   				<div class="entry">
   					<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>

					<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
					<?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>
				</div>
				
				<?php edit_post_link('Edit this entry','','.'); ?>

      
      </div>
      <!-- end blog_post -->
		<?php endwhile; else: ?>
		
			<p>Sorry, no posts matched your criteria.</p>
		
		<?php endif; ?>
                
<div class="comments">
      <?php comments_template('',true); ?>
    </div>
   				
   			</div><!-- end center_right-->
   			
   		</div><!-- end center_box-->
   		
    </div><!--end center 1 -->
</div><!-- end main content-->

<?php get_footer(); ?>