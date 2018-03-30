<?php 
$layoutFeatured = get_option('themeteam_origami_featured_layout');
switch($layoutFeatured){

	case 'postsandrecent':
?>
<div id="container" class="clearfix">
	<div class="container_12">
		<div class="col2-right-layout clearfix">
        	<div class="clearfix">
            	<div class="clear"> </div>
		          <?php $my_query = new WP_Query(array('post__in'=>get_option('sticky_posts'), 'posts_per_page' => 2, 'caller_get_posts' => 1));	?>
		          <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post() ?>   
		            <div class="grid_4 sticky">
		              <?php if (has_post_thumbnail()): ?>
		              <div class="imgframe"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_post_thumbnail('thumb300'); ?><span class="frame"><span><span><span><span><span class="empty"><em> </em></span></span></span></span></span></span></a></div>
		              <?php endif ?>
                      <div class="clearfix">
                        <h2><a href="<?php the_permalink();?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title();?></a></h2>
		                <?php the_excerpt();?>
		                <p><a href="<?php the_permalink();?>" class="button small <?php echo $GLOBALS['button_css'];?>"><span><span>READ MORE</span></span></a></p>
                      </div>
		            </div>
		         <?php endwhile; endif;?>

	            <aside class="grid_4 right" id="sidebar" style="margin-top:0px;">
	              <div>
	                <div id="latest-posts" class="clearfix widget">
	                  <h2>Latest Blog Posts</h2>
	                  <ul>
	                    <?php $_query = new WP_Query('showposts=4'); while ($_query->have_posts()) : $_query->the_post(); ?>
	                    <li>
	                      <?php if (has_post_thumbnail()): ?>
	                      <div class="thumbnail left"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_post_thumbnail('thumb60'); ?><span><em> </em></span></a></div>
	                      <?php endif ?>
	                      <div class="prefix_1">
	                        <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
	                        <p><time><?php the_time('M j, Y');?></time>  | <?php comments_popup_link('0 Comments', '1 Comment', '% Comments'); ?> | <a href="<?php the_permalink();?>">read</a></p>
	                      </div>
	                    </li>
	                    <?php endwhile;?> 
	                  </ul>
	                </div>
	              </div>
	            </aside>
            
			</div>
		</div>
	<div class="clear"><!--clear fix--></div>
	</div>
</div>
<?php	
	break;
	case '3featured':
?>
<div id="container" class="clearfix">
	<div class="container_12">
		<div class="clear"><!--clear fix--></div>
<?php		
		$my_query = new WP_Query(array('post__in'=>get_option('sticky_posts'), 'posts_per_page' => 3, 'caller_get_posts' => 1));
        if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>     
            <div class="grid_4 sticky">
              <?php if (has_post_thumbnail()): ?>
              <div class="imgframe clearfix"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_post_thumbnail('thumb300'); ?><span class="frame"><span><span><span><span><span class="empty"><em> </em></span></span></span></span></span></span></a></div>
              <?php endif ?>
              <div class="clearfix">
                <h2><a href="<?php the_permalink();?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title();?></a></h2>
                <?php the_excerpt();?>
                <p><a href="<?php the_permalink();?>" class="button small <?php echo $GLOBALS['button_css'];?>"><span><span>READ MORE</span></span></a></p>
              </div>
            </div>
         <?php endwhile; endif;?>
	<div class="clear"><!--clear fix--></div>
	</div>
</div>
<?php
	break;
	case 'none':
	//nothing to do
?>
	<div class="clear"><!--clear fix--></div>
<?php	
	
	break;
	case 'custom':
	?>
	<div id="container" class="clearfix">
		<div class="container_12">
			<div class="clear"><!--clear fix--></div>
			<div id="custom-blocks">
				<?php echo place_shortcode(get_option('themeteam_origami_custom_content')); ?>
			</div>
		</div>
	</div>

	<?php
	break;
	case '4featured':
	?>
<div id="container" class="clearfix">
	<div class="container_12">
		<div class="clear"><!--clear fix--></div>
<?php		
		$my_query = new WP_Query(array('post__in'=>get_option('sticky_posts'), 'posts_per_page' => 4, 'caller_get_posts' => 1));
        if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>     
            <div class="grid_3 sticky">
              <?php if (has_post_thumbnail()): ?>
              <div class="imgframe clearfix"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_post_thumbnail('thumb200'); ?><span class="frame"><span><span><span><span><span class="empty"><em> </em></span></span></span></span></span></span></a></div>
              <?php endif ?>
              <div class="clearfix">
                <h2><a href="<?php the_permalink();?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title();?></a></h2>
                <?php the_excerpt();?>
                <p><a href="<?php the_permalink();?>" class="button small <?php echo $GLOBALS['button_css'];?>"><span><span>READ MORE</span></span></a></p>
              </div>
            </div>
         <?php endwhile; endif;?>
	<div class="clear"><!--clear fix--></div>
	</div>
</div>
	
<?php
	break;
}
?>
		  