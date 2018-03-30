
<?php
/*
Template Name: Author
*/
?>

<?php get_header(); ?>

<div id="main_content"> 
	
<?php if (get_option('op_crumbs') == 'on') { ?>
<?php if (get_option('op_boxed_menu_ticker') == 'on') { ?> 
<div class="inner">
<?php } ?>
<div id="content_bread_panel">	
<div class="inner">
<?php if (function_exists('wp_breadcrumbs')) wp_breadcrumbs(); ?>
</div>
</div>
<?php if (get_option('op_boxed_menu_ticker') == 'on') { ?> 
</div>
<?php } ?>
<?php } ?>
	
	
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumbnails', false, '' ); $thumbnailSrc = $src[0]; ?>	

<?php if(has_post_thumbnail()) { ?>

	<?php $post_thumbnail = get_post_meta($post->ID, "r_post_thumbnail", $single = true);
	if($post_thumbnail !== 'on') { ?>
		
	<?php if (get_option('op_boxed_menu_ticker') == 'on') { ?> 
    <div class="inner">
    <?php } ?>	
		
		<div class="big_image_cover">
	  
	    <?php $image = aq_resize( $thumbnailSrc, 1180, 'auto', false); ?>
        <img src="<?php echo $image ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
	
		
		<div class="photo_bg_shadow"></div>
		
		<div id="author_content">
		
<div class="inner">	

<div class="author_avatar">
<?php echo get_avatar( get_the_author_meta( 'ID' ), 120 ); ?>
</div>

<div class="author_description">
<h2 class="author_name"><?php echo the_author_meta('nickname'); ?></h2>

<p><?php echo the_author_meta('description'); ?></p>

<span><?php echo $op_total_posts . ' ' . count_user_posts( get_the_author_meta('ID') ); ?></span>

<div class="author_email">
<?php $user_email = the_author_meta('user_email'); ?>
</div>	
</div>

</div>
</div>	 
		
		</div>
<?php if (get_option('op_boxed_menu_ticker') == 'on') { ?> 
</div>
<?php } ?>	
	<?php } ?>
	    
	   
<?php } else {} ?>	

<?php endwhile; ?>
<?php else : ?>
<?php endif; ?>	
	
	

	
<div class="inner">	
<div id="content" class="EqHeightDiv">

<?php

    global $authordata;
    get_currentuserinfo();
    $author_query = array('posts_per_page' => '-1', 'post__not_in' => array( $post->ID ),'author' => $authordata->ID);
    $author_posts = new WP_Query($author_query);
    while($author_posts->have_posts()) : $author_posts->the_post();
    ?>
	<div class="author_post"> 
	    
		<?php if(has_post_thumbnail()) { ?>
		<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumbnails', false, '' ); $thumbnailSrc = $src[0]; ?>		
		
		<?php echo $post_format_image ?> 
		
        <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
		<?php $image = aq_resize( $thumbnailSrc, 80, 40, false); ?>
        <img src="<?php echo $image ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
		</a>
		
        <?php } else {} ?>
		
        <a class="author_posts_title" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>  

	</div> 	
    <?php           
    endwhile; ?>
	 


</div>

<?php get_sidebar('right'); ?>	
	
</div>
</div>

<div class="clear"></div>
	
<?php get_footer(); ?>
