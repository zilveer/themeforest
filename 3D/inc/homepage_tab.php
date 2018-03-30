<?php if($q_homepage_tab_style == 1) { ?>

	<?php
	$one = false;
	$i = 0;
	if($q_homepage_tab_category_id != '') 
	{
    $showPostsInCategory = new WP_Query(); $showPostsInCategory->query('cat='. $q_homepage_tab_category_id .'&showposts=1');
    if ($showPostsInCategory->have_posts()) :
    while ($showPostsInCategory->have_posts()) : $showPostsInCategory->the_post();
    $one = true;
	
	$video_url = '';
	if(get_post_meta($post->ID,'im_theme_3D_video', true))
	{
		$video_url = get_post_meta($post->ID,'im_theme_3D_video', true);
	}
    ?>
        
	<div class="grid_12 tabcontent1 margin">
        <h1><?php the_title(); ?></h1>
        <h2><?php echo get_post_meta($post->ID,'im_theme_3D_description', true); ?></h2>
        
        <p><?php echo get_the_content(''); ?></p>
        
        <?php
        if(get_post_meta($post->ID,'im_theme_3D_button_1_title', true))
		{
			echo '<a class="button3dblue rightmargin" href="'.get_post_meta($post->ID,'im_theme_3D_button_1_url', true).'">'.get_post_meta($post->ID,'im_theme_3D_button_1_url', true).'</a>';
		}
		?>
        <?php
        if(get_post_meta($post->ID,'im_theme_3D_button_2_title', true))
		{
			echo '<a class="button3dgreen rightmargin" href="'.get_post_meta($post->ID,'im_theme_3D_button_2_url', true).'">'.get_post_meta($post->ID,'im_theme_3D_button_2_url', true).'</a>';
		}
		?>

    </div> <!-- /.tabcontent1 -->
    <div class="grid_12 margin">
        <div class="content1-lamb"></div>
        <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_id())); ?>" class="fancypicture" title="<?php the_title(); ?>">
            <?php the_post_thumbnail('homepage-tab-1', array('class' => 'content1-img')); ?> 
        </a>
        <div class="content1-shadow"></div>
    </div> <!-- /.grid_12 -->
    
    
    <?php endwhile; endif; ?>
    <?php } ?>
    <?php if($one == false){ ?>
    
    <div class="grid_12 tabcontent1 margin">
        <h1>New design, This is new idea!</h1>
        <h2>Morbi sollicitudin sollicitudin porta. Sed vestibulum, ipsum at interdum iaculis, dui turpis rhoncus lacus, vel sagittis enim tortor et quam. Suspendisse faucibus ultrices lectus et vehicula. Integer eget libero non tortor suscipit vestibulum. Etiam sit amet feugiat feugiat.</h2>
        <p>Donec libero sem, tristique nec dignissim eu, sodales id massa. Fusce sed eros tincidunt lectus ultricies scelerisque. Donec fermentum lacus a est auctor elementum id eu mauris. Proin vel neque urna, vitae semper odio. Nullam feugiat, turpis non bibendum tincidunt, purus orci adipiscing magna, a mollis arcu lacus eget elit. Sed sed nulla leo. Pellentesque feugiat dui ut lectus faucibus venenatis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque ultrices interdum lectus. Maecenas ut iaculis mi.</p>
        <a class="button3dblue rightmargin" href="">Signup</a> <a class="button3dgreen rightmargin" href="">Login</a>
    </div> <!-- /.tabcontent1 -->
    <div class="grid_12 margin">
        <div class="content1-lamb"></div>
        <a href="<?php if($video_url == ''){ echo wp_get_attachment_url( get_post_thumbnail_id(get_the_id())); } else { echo $video_url;  } ?>" class="<?php if($video_url == ''){ echo 'fancypicture'; } else { echo 'fancyvideo'; } ?>" title="<?php the_title(); ?>">
            <img src="<?php bloginfo('template_url'); ?>/image/content1-pic.png" alt="" class="content1-img">
        </a>
        <div class="content1-shadow"></div>
    </div> <!-- /.grid_12 -->
    
    <?php } ?>

<?php } ?>





<?php if($q_homepage_tab_style == 2) { ?>

	
	<?php
	$one = false;
	$i = 0;
	if($q_homepage_tab_category_id != '') 
	{
		$showPostsInCategory = new WP_Query(); $showPostsInCategory->query('cat='. $q_homepage_tab_category_id .'&showposts=3');
		if ($showPostsInCategory->have_posts()) :
	
		while ($showPostsInCategory->have_posts()) : $showPostsInCategory->the_post();
		$one = true;
		$i++;
		
		if($i == 3){$divStyle = 'grid_8 tabcontent2 tabcontent2-last-child margin';}
		else{$divStyle = 'grid_8 tabcontent2 margin';}
		
		$video_url = '';
        if(get_post_meta($post->ID,'im_theme_3D_video', true))
		{
			$video_url = get_post_meta($post->ID,'im_theme_3D_video', true);
		}
	?>
			
        <div class="<?php echo $divStyle; ?>">
            <a href="<?php if($video_url == ''){ echo wp_get_attachment_url( get_post_thumbnail_id(get_the_id())); } else { echo $video_url;  } ?>" class="<?php if($video_url == ''){ echo 'fancypicture'; } else { echo 'fancyvideo'; } ?>" title="<?php the_title(); ?>">
                <?php the_post_thumbnail('homepage-tab-2', array('class' => 'content2-img')); ?>
            </a>
            <div class="content2-shadow"></div>
            <h1><?php the_title(); ?></h1>
            <h2><?php echo mb_substr(get_post_meta($post->ID,'im_theme_3D_description', true),0,60,'UTF-8'); ?></h2>
            <p><?php echo mb_substr(strip_tags(get_the_content()),0,140,'UTF-8'); ?></p>
            <a href="<?php echo get_permalink(); ?>" class="More3d floatright">Read</a>
        </div>
            
    	<?php endwhile; endif; ?>
    <?php } ?>	
    
    <?php if($one == false){ ?>

<!-- #1 -->
<div class="grid_8 tabcontent2 margin">
    <a href="<?php bloginfo('template_url'); ?>/image/bigpic.png" class="fancypicture" title="Galleri Picture Title One"><img src="<?php bloginfo('template_url'); ?>/image/content2-pic.png" class="content2-img" alt=""></a>
    <div class="content2-shadow"></div>
    <h1>The Work Post One</h1>
    <h2>Morbi sollicitudin sollicitudin porta. Sed vestibulum, ipsum at interdum iaculis.</h2>
    <p>Donec libero sem, tristique nec dignissim eu, sodales id massa. Fusce sed eros tincidunt lectus ultricies scelerisque.</p>
    <a href="#" class="More3d floatright">Read</a>
</div>

<!-- #2 -->
<div class="grid_8 tabcontent2 margin">
    <a href="<?php bloginfo('template_url'); ?>/image/bigpic.png" class="fancypicture" title="Galleri Picture Title Two"><img src="<?php bloginfo('template_url'); ?>/image/content2-2-pic.png" class="content2-img" alt=""></a>
    <div class="content2-shadow"></div>
    <h1>The Work Post Two</h1>
    <h2>Morbi sollicitudin sollicitudin porta. Sed vestibulum, ipsum at interdum iaculis.</h2>
    <p>Donec libero sem, tristique nec dignissim eu, sodales id massa. Fusce sed eros tincidunt lectus ultricies scelerisque.</p>
    <a href="#" class="More3d floatright">Read</a>
</div>

<!-- #3 -->
<div class="grid_8 tabcontent2 tabcontent2-last-child margin">
    <a href="<?php bloginfo('template_url'); ?>/image/bigpic.png" class="fancypicture" title="Galleri Picture Title Three"><img src="<?php bloginfo('template_url'); ?>/image/content2-3-pic.png" class="content2-img" alt=""></a>
    <div class="content2-shadow"></div>
    <h1>The Work Post Three</h1>
    <h2>Morbi sollicitudin sollicitudin porta. Sed vestibulum, ipsum at interdum iaculis.</h2>
    <p>Donec libero sem, tristique nec dignissim eu, sodales id massa. Fusce sed eros tincidunt lectus ultricies scelerisque.</p>
    <a href="#" class="More3d floatright">Read</a>
</div>
	<?php } ?>
<?php } ?>



<?php if($q_homepage_tab_style == 3) { ?>

<?php
	$one = false;
	$i = 0;
	if($q_homepage_tab_category_id != '') 
	{
		$showPostsInCategory = new WP_Query(); $showPostsInCategory->query('cat='. $q_homepage_tab_category_id .'&showposts=4');
		if ($showPostsInCategory->have_posts()) :
	
		while ($showPostsInCategory->have_posts()) : $showPostsInCategory->the_post();
		$one = true;
		$i++;
	
		
		$video_url = '';
        if(get_post_meta($post->ID,'im_theme_3D_video', true))
		{
			$video_url = get_post_meta($post->ID,'im_theme_3D_video', true);
		}
	?>
			      
        <?php if($i == 1) { ?>
             <!-- #LEFT -->
            <div class="grid_10 tabcontent2">
                <a href="<?php if($video_url == ''){ echo wp_get_attachment_url( get_post_thumbnail_id(get_the_id())); } else { echo $video_url;  } ?>" class="<?php if($video_url == ''){ echo 'fancypicture'; } else { echo 'fancyvideo'; } ?>" title="<?php the_title(); ?>">
                    <?php the_post_thumbnail('homepage-tab-3', array('class' => 'content3-img')); ?>
                </a>
 
                <h1 class="content3-title"><?php the_title(); ?></h1>
                <span class="author-tag"><strong><?php lang('Author'); ?>:</strong> <a href="<?php the_author_link(); ?>"><?php the_author(); ?></a></span>
                <span class="time-tag"><strong><?php lang('Date'); ?>:</strong> <?php echo get_the_date(); ?></span>
                <h3 class="content3-subp"><?php echo mb_substr(strip_tags(get_the_content()),0,140,'UTF-8'); ?></h3>
                <a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>" class="More3d floatright-two">Read</a>
            </div>
        <?php } ?>
        
        <?php if($i == 2) { ?>
        	<div class="grid_13 margin content3right">
        <?php } ?>
        
        <?php if($i > 1) { ?>
            <div class="content3right-list">
                <a href="<?php if($video_url == ''){ echo wp_get_attachment_url( get_post_thumbnail_id(get_the_id())); } else { echo $video_url;  } ?>" class="<?php if($video_url == ''){ echo 'fancypicture'; } else { echo 'fancyvideo'; } ?>" title="<?php the_title(); ?>">
                    <?php the_post_thumbnail('homepage-tab-3-1', array('class' => 'content3-img content3-right')); ?>
                </a>
                <h1><a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
                <span class="author-tag"><strong><?php lang('Author'); ?>:</strong> <a href="<?php the_author_link(); ?>"><?php the_author(); ?></a></span>
                <span class="time-tag"><strong><?php lang('Date'); ?>:</strong> <?php echo get_the_date(); ?></span>
                <p><?php echo mb_substr(get_the_content(),0,100,'UTF-8'); ?></p>
            </div>
        
        <?php } ?>
            
    	<?php endwhile; endif; ?>
        
        <?php  if($i > 1){echo '</div> <!-- /.content3right-list -->';} ?>
        
    <?php } ?>	
    
    <?php if($one == false){ ?>



<div class="grid_10 tabcontent2">
    <a href="<?php bloginfo('template_url'); ?>/image/bigpic.png" class="fancypicture" title="The Picture Title is Here"><img src="<?php bloginfo('template_url'); ?>/image/content3-pic.png" class="content3-img" alt=""></a>
    	<h1 class="content3-title">Latest Blog Title Is Here</h1>
    	<span class="author-tag"><strong>Author:</strong> <a href="#">John Doe</a></span>
    	<span class="time-tag"><strong>Date:</strong> 22 JAN 2012</span>
    	<h3 class="content3-subp">Morbi sollicitudin sollicitudin porta. Sed vestibulum, ipsum at interdum iaculis, dui turpis rhoncus lacus, vel sagittis enim tortor et quam.</h3>
    <a href="#" class="More3d floatright-two">Read</a>
</div>
                        

<!-- #RIGHT -->
<div class="grid_13 margin content3right">

    <!-- #1 -->
    <div class="content3right-list">
        <a href="<?php bloginfo('template_url'); ?>/image/bigpic.png" class="fancypicture" title="Galleri Picture Title One"><img src="<?php bloginfo('template_url'); ?>/image/content4-pic.png" alt="" class="content3-img content3-right"></a>
        <h1><a href="#">Recent Blog Post One</a></h1>
        <span class="author-tag"><strong>Author:</strong> <a href="#">John Doe</a></span>
        <span class="time-tag"><strong>Date:</strong> 22 JAN 2012</span>
        <p>Curabitur magna tortor, lacinia amet etiam accumsan sapien aliquam..</p>
    </div>
    
    <!-- #2 -->
    <div class="content3right-list">
        <a href="<?php bloginfo('template_url'); ?>/image/bigpic.png" class="fancypicture" title="Galleri Picture Title Two"><img src="<?php bloginfo('template_url'); ?>/image/content4-2-pic.png" alt="" class="content3-img content3-right"></a>
        <h1><a href="#">Recent Blog Post Two</a></h1>
        <span class="author-tag"><strong>Author:</strong> <a href="#">John Doe</a></span>
        <span class="time-tag"><strong>Date:</strong> 22 JAN 2012</span>
        <p>Curabitur magna tortor, lacinia amet etiam accumsan sapien aliquam..</p>
    </div>
    
    <!-- #3 -->
    <div class="content3right-list">
        <a href="<?php bloginfo('template_url'); ?>/image/bigpic.png" class="fancypicture" title="Galleri Picture Title Three"><img src="<?php bloginfo('template_url'); ?>/image/content4-3-pic.png" alt="" class="content3-img content3-right"></a>
        <h1><a href="#">Recent Blog Post Three</a></h1>
        <span class="author-tag"><strong>Author:</strong> <a href="#">John Doe</a></span>
        <span class="time-tag"><strong>Date:</strong> 22 JAN 2012</span>
        <p>Curabitur magna tortor, lacinia amet etiam accumsan sapien aliquam..</p>
    </div>

</div>
<div class="clear"></div>
	<?php } ?>

<?php } ?>



<?php if($q_homepage_tab_style == 4) { ?>



	<?php
	$one = false;
	$i = 0;
	if($q_homepage_tab_category_id != '') 
	{
		$showPostsInCategory = new WP_Query(); $showPostsInCategory->query('cat='. $q_homepage_tab_category_id .'&showposts=4');
		if ($showPostsInCategory->have_posts()) :
	
		while ($showPostsInCategory->have_posts()) : $showPostsInCategory->the_post();
		$one = true;
		$i++;
		
		$video_url = '';
        if(get_post_meta($post->ID,'im_theme_3D_video', true))
		{
			$video_url = get_post_meta($post->ID,'im_theme_3D_video', true);
		}

	?>
			      
        <?php if($i == 1) { ?>
             <!-- #LEFT -->
            <div class="grid_10 tabcontent2">
                <a href="<?php if($video_url == ''){ echo wp_get_attachment_url( get_post_thumbnail_id(get_the_id())); } else { echo $video_url;  } ?>" class="<?php if($video_url == ''){ echo 'fancypicture'; } else { echo 'fancyvideo'; } ?>" title="<?php the_title(); ?>">
                    <?php the_post_thumbnail('homepage-tab-3', array('class' => 'content3-img')); ?>
                </a>
                <div class="content3-shadow"></div>
                <h1 class="content3-title"><?php the_title(); ?></h1>
                <span class="author-tag"><strong><?php lang('Author'); ?>:</strong> <a href="<?php the_author_link(); ?>"><?php the_author(); ?></a></span>
                <span class="time-tag"><strong><?php lang('Date'); ?>:</strong> <?php echo get_the_date(); ?></span>
                <h3 class="content3-subp"><?php echo mb_substr(strip_tags(get_the_content()),0,140,'UTF-8'); ?></h3>
                <a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>" class="More3d floatright-two">Read</a>
            </div>
        <?php } ?>
        
        <?php if($i == 2) { ?>
        	<div class="grid_13 margin content3right">
        <?php } ?>
        
        <?php if($i > 1) { ?>
            <div class="content3right-list">
                <a href="<?php if($video_url == ''){ echo wp_get_attachment_url( get_post_thumbnail_id(get_the_id())); } else { echo $video_url;  } ?>" class="<?php if($video_url == ''){ echo 'fancypicture'; } else { echo 'fancyvideo'; } ?>" title="<?php the_title(); ?>">
                    <?php the_post_thumbnail('homepage-tab-3-1', array('class' => 'content3-img content3-right')); ?>
                </a>
                <div class="content4-shadow"></div>
                <h1><a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
                <span class="author-tag"><strong><?php lang('Author'); ?>:</strong> <a href="<?php the_author_link(); ?>"><?php the_author(); ?></a></span>
                <span class="time-tag"><strong><?php lang('Date'); ?>:</strong> <?php echo get_the_date(); ?></span>
                <p><?php echo mb_substr(strip_tags(get_the_content()),0,80,'UTF-8'); ?></p>
            </div>
        
        <?php } ?>
            
    	<?php endwhile; endif; ?>
        
        <?php  if($i > 1){echo '</div> <!-- /.content3right-list -->';} ?>
        
    <?php } ?>	


	<?php if($one == false){ ?>
    
<!-- #LEFT -->
<div class="grid_10 tabcontent2">
    <a href="http://www.youtube.com/embed/GgR6dyzkKHI" class="fancyvideo" title="You tube "><img src="<?php bloginfo('template_url'); ?>/image/content4-5-pic.png" class="content3-img" alt=""></a>
    <div class="content3-shadow"></div>
    <h1 class="content3-title">Latest Blog Title Is Here</h1>
    <span class="author-tag"><strong>Author:</strong> <a href="#">John Doe</a></span>
    <span class="time-tag"><strong>Date:</strong> 22 JAN 2012</span>
    <h3 class="content3-subp">Morbi sollicitudin sollicitudin porta. Sed vestibulum, ipsum at interdum iaculis, dui turpis rhoncus lacus, vel sagittis enim tortor et quam.</h3>
    <a href="#" class="More3d floatright-two">Read</a>
</div>

<!-- #RIGHT -->
<div class="grid_13 margin content3right">

    <!-- #1 -->
    <div class="content3right-list">
        <a href="http://www.youtube.com/embed/GgR6dyzkKHI" class="fancyvideo" title="You tube "><img src="<?php bloginfo('template_url'); ?>/image/content5-1-pic.png" alt="" class="content3-img content3-right"></a>
        <div class="content4-shadow"></div>
        <h1><a href="#">Recent Blog Post One</a></h1>
        <span class="author-tag"><strong>Author:</strong> <a href="#">John Doe</a></span>
        <span class="time-tag"><strong>Date:</strong> 22 JAN 2012</span>
        <p>Curabitur magna tortor, lacinia amet etiam accumsan sapien aliquam..</p>
    </div>
    
    <!-- #2 -->
    <div class="content3right-list">
        <a href="http://www.youtube.com/embed/GgR6dyzkKHI" class="fancyvideo" title="You tube "><img src="<?php bloginfo('template_url'); ?>/image/content5-2-pic.png" alt="" class="content3-img content3-right"></a>
        <div class="content4-shadow"></div>
        <h1><a href="#">Recent Blog Post Two</a></h1>
        <span class="author-tag"><strong>Author:</strong> <a href="#">John Doe</a></span>
        <span class="time-tag"><strong>Date:</strong> 22 JAN 2012</span>
        <p>Curabitur magna tortor, lacinia amet etiam accumsan sapien aliquam..</p>
    </div>
    
    <!-- #3 -->
    <div class="content3right-list">
        <a href="http://www.youtube.com/embed/GgR6dyzkKHI" class="fancyvideo" title="You tube "><img src="<?php bloginfo('template_url'); ?>/image/content5-3-pic.png" alt="" class="content3-img content3-right"></a>
        <div class="content4-shadow"></div>
        <h1><a href="#">Recent Blog Post Three</a></h1>
        <span class="author-tag"><strong>Author:</strong> <a href="#">John Doe</a></span>
        <span class="time-tag"><strong>Date:</strong> 22 JAN 2012</span>
        <p>Curabitur magna tortor, lacinia amet etiam accumsan sapien aliquam..</p>
    </div>

</div>
<div class="clear"></div>

	<?php } ?>

<?php } ?>



<?php if($q_homepage_tab_style == 5) { ?>



<?php
	$one = false;
	$i = 0;
	if($q_homepage_tab_category_id != '') 
	{
		$showPostsInCategory = new WP_Query(); $showPostsInCategory->query('cat='. $q_homepage_tab_category_id .'&showposts=4');
		if ($showPostsInCategory->have_posts()) :
	
		while ($showPostsInCategory->have_posts()) : $showPostsInCategory->the_post();
		$one = true;
		$i++;
		
		$video_url = '';
        if(get_post_meta($post->ID,'im_theme_3D_video', true))
		{
			$video_url = get_post_meta($post->ID,'im_theme_3D_video', true);
		}

	?>
			      
        
        
        <?php if($i == 1) { ?>
        	<div class="grid_7 margin content5">
        <?php } ?>
        
        <?php if($i < 4) { ?>
           <div class="content4left-list">
                <?php the_post_thumbnail('homepage-tab-5-1', array('class' => 'content4-left')); ?>
                <h1><a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
                <p><?php echo mb_substr(strip_tags(get_the_content()),0,50,'UTF-8'); ?></p>
            </div>
        <?php } ?>
            
         <?php if($i == 4) { ?>
         </div> <!-- /.grid_7 margin content5 -->
         <div class="grid_17 margin">
            <div class="content5-right">
           <a href="<?php if($video_url == ''){ echo wp_get_attachment_url( get_post_thumbnail_id(get_the_id())); } else { echo $video_url;  } ?>" class="<?php if($video_url == ''){ echo 'fancypicture'; } else { echo 'fancyvideo'; } ?>" title="<?php the_title(); ?>">
                <?php the_post_thumbnail('homepage-tab-5-2', array('class' => 'content3-img')); ?>
            </a>
            <div class="content5-shadow"></div>
            <h2 class="content5-subtitle">" <?php echo mb_substr(strip_tags(get_the_content()),0,200,'UTF-8'); ?> "</h2>
            <a href="<?php echo get_permalink(); ?>" class="More3d floatright-three">All</a>
            </div>
        </div>
        <div class="clear"></div>
         <?php } ?>   
           
    	<?php endwhile; endif; ?>
        
        
    <?php } ?>	


	<?php if($one == false){ ?>


<!-- #LEFT -->

<div class="grid_7 margin content5">
<!-- #1 -->
<div class="content4left-list">
    <img src="<?php bloginfo('template_url'); ?>/image/icon-01.png" alt="" class="content4-left">
    <h1><a href="#">Recent Blog Post Three</a></h1>
    <p>Curabitur magna tortor, lacinia sit amet aliquam ac.</p>
</div>

<!-- #2 -->
<div class="content4left-list">
    <img src="<?php bloginfo('template_url'); ?>/image/icon-02.png" alt="" class="content4-left">
    <h1><a href="#">Recent Blog Post Three</a></h1>
    <p>Curabitur magna tortor, lacinia sit amet aliquam ac.</p>
</div>

<!-- #3 -->
<div class="content4left-list">
    <img src="<?php bloginfo('template_url'); ?>/image/icon-03.png" alt="" class="content4-left">
    <h1><a href="#">Recent Blog Post Three</a></h1>
    <p>Curabitur magna tortor, lacinia sit amet aliquam ac.</p>
</div>

</div>

<!-- #RIGHT -->
<div class="grid_17 margin">
    <div class="content5-right">
    <a href="<?php bloginfo('template_url'); ?>/image/bigpic.png" class="fancypicture" title="The Picture Title is Here"><img src="<?php bloginfo('template_url'); ?>/image/content5-pic.png" alt="" class="content3-img"></a>
    <div class="content5-shadow"></div>
    <h2 class="content5-subtitle">" Morbi sollicitudin sollicitudin porta. Sed vestibulum, ipsum at interdum iaculis, dui turpis rhoncus lacus, vel sagittis enim tortor et quam. Suspendisse faucibus ultrices lectus et vehicula. "</h2>
    <a href="#" class="More3d floatright-three">All</a>
    </div>
</div>
<div class="clear"></div>

	<?php } ?>

<?php } ?>



<?php if($q_homepage_tab_style == 6) { ?>


<ul class="download-list">
<?php
$one = false;
$i = 0;
if($q_homepage_tab_category_id != '') 
{
	$showPostsInCategory = new WP_Query(); $showPostsInCategory->query('cat='. $q_homepage_tab_category_id .'&showposts=4');
	if ($showPostsInCategory->have_posts()) :

	while ($showPostsInCategory->have_posts()) : $showPostsInCategory->the_post();
	$one = true;
	$i++;
	

?>

<li>
    
    <?php the_post_thumbnail('homepage-tab-6-1', array('class' => 'download-icon')); ?>
    <div class="download-shadow"></div>
    <h1><a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
    <p>Total: <?php echo get_post_meta($post->ID,'im_theme_3D_download_size', true); ?></p>
</li>

 
           
	<?php endwhile; endif; ?>
    
<?php } ?>	

<?php if($one == false){ ?>


    <!-- #1 -->
    <li>
        <img src="<?php bloginfo('template_url'); ?>/image/dicon01.png" alt="" class="download-icon" />
        <div class="download-shadow"></div>
        <h1><a href="#">The File Name One</a></h1>
        <p>Total: 241 KB</p>
    </li>
    
    <!-- #2 -->
    <li>
        <img src="<?php bloginfo('template_url'); ?>/image/dicon02.png" alt="" class="download-icon" />
        <div class="download-shadow"></div>
        <h1><a href="#">The File Name Two</a></h1>
        <p>Total: 241 KB</p>
    </li>
    
    <!-- #3 -->
    <li>
        <img src="<?php bloginfo('template_url'); ?>/image/dicon03.png" alt="" class="download-icon" />
        <div class="download-shadow"></div>
        <h1><a href="#">The File Name Three</a></h1>
        <p>Total: 241 KB</p>
    </li>
    
    <!-- #4 -->
    <li>
        <img src="<?php bloginfo('template_url'); ?>/image/dicon04.png" alt="" class="download-icon" />
        <div class="download-shadow"></div>
        <h1><a href="#">The File Name Four</a></h1>
        <p>Total: 241 KB</p>
    </li>
    
    <!-- #5 -->
    <li>
        <img src="<?php bloginfo('template_url'); ?>/image/dicon05.png" alt="" class="download-icon" />
        <div class="download-shadow"></div>
        <h1><a href="#">The File Name Five</a></h1>
        <p>Total: 241 KB</p>
    </li>
    
    <!-- #6 -->
    <li>
        <img src="<?php bloginfo('template_url'); ?>/image/dicon06.png" alt="" class="download-icon" />
        <div class="download-shadow"></div>
        <h1><a href="#">The File Name Six</a></h1>
        <p>Total: 241 KB</p>
    </li>
    
    <!-- #7 -->
    <li>
        <img src="<?php bloginfo('template_url'); ?>/image/dicon07.png" alt="" class="download-icon" />
        <div class="download-shadow"></div>
        <h1><a href="#">The Idea Web Site PDF</a></h1>
        <p>Total: 241 KB</p>
    </li>
    
    <!-- #8 -->
    <li>
        <img src="<?php bloginfo('template_url'); ?>/image/dicon08.png" alt="" class="download-icon" />
        <div class="download-shadow"></div>
        <h1><a href="#">The Idea Web Site PDF</a></h1>
        <p>Total: 241 KB</p>
    </li>
    
    <!-- #9 -->
    <li>
        <img src="<?php bloginfo('template_url'); ?>/image/dicon09.png" alt="" class="download-icon" />
        <div class="download-shadow"></div>
        <h1><a href="#">The Idea Web Site PDF</a></h1>
        <p>Total: 241 KB</p>
    </li>
    
    <!-- #10 -->
    <li>
        <img src="<?php bloginfo('template_url'); ?>/image/dicon010.png" alt="" class="download-icon" />
        <div class="download-shadow"></div>
        <h1><a href="#">The Idea Web Site PDF</a></h1>
        <p>Total: 241 KB</p>
    </li>
    
    <!-- #11 -->
    <li>
        <img src="<?php bloginfo('template_url'); ?>/image/dicon011.png" alt="" class="download-icon" />
        <div class="download-shadow"></div>
        <h1><a href="#">The Idea Web Site PDF</a></h1>
        <p>Total: 241 KB</p>
    </li>
    
    <!-- #12 -->
    <li>
        <img src="<?php bloginfo('template_url'); ?>/image/dicon012.png" alt="" class="download-icon" />
        <div class="download-shadow"></div>
        <h1><a href="#">The Idea Web Site PDF</a></h1>
        <p>Total: 241 KB</p>
    </li>


	<?php } ?>
    </ul>

<?php } ?>
