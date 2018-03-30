<div id="hometab">

<ul id="serinfo-nav">

        <li class="li01"><a href="#serpane0"><?php _e('Latest','themnific');?></a></li>
        <li class="li02"><a href="#serpane1"><?php _e('Popular','themnific');?></a></li>
        <li class="li03"><a href="#serpane2"><?php _e('Random','themnific');?></a></li>
        <li class="li04" style="width:20.5%"><a href="#serpane3"><?php _e('Tags','themnific');?></a></li>

</ul>

<ul id="serinfo">

  		<li id="serpane0">	
        	<?php 
			$the_query = new WP_Query('&showposts=4&orderby=post_date&order=desc');	
			while ($the_query->have_posts()) : $the_query->the_post(); $do_not_duplicate = $post->ID;
			?>	
        		<?php get_template_part("/includes/post-types/tab-post"); ?>
            <?php endwhile; ?>	
  		</li>


  		<li id="serpane1">
			<?php $pc = new WP_Query('orderby=comment_count&posts_per_page=4'); ?>
			<?php while ($pc->have_posts()) : $pc->the_post(); ?>
        		<?php get_template_part("/includes/post-types/tab-post"); ?>
            <?php endwhile; ?>
  		</li>
        
        
        
     	<li id="serpane2">	
        	<?php $posts = get_posts('orderby=rand&numberposts=4'); foreach($posts as $post) { ?>	
        		<?php get_template_part("/includes/post-types/tab-post"); ?>
            <?php } ?>
        </li>
        
        
        
  		<li id="serpane3">
           <?php wp_tag_cloud('smallest=7&largest=22&'); ?>
        </li>
     



</ul>

</div>
<div style="clear: both;"></div>