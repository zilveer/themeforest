

<?php get_header(); ?>


<?php 
$cat_id = get_query_var('cat');
$cat_data = get_option("category_$cat_id");
?>	

<?php 
$categories = get_the_category();
$category_id = $categories[0]->cat_ID;
$posts_found = get_option('op_posts_found');

$taxonomy = 'category';
$term_obj = get_term( $category_id, $taxonomy );
$posts_count = '<div class="cat_post_count">' . $term_obj->count  .' '. $posts_found .'</div>'; 
?>

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

<div class="clear"></div>
<?php } ?>





<?php if (get_option('op_cat_parallax_style')!== 'Default') { ?>


<div class="cat_title_box_Kesha">
<div class="inner">
<h1><?php single_cat_title(''); ?></h1> 

<?php echo category_description( ); ?>
</div>
</div>

<?php } else { ?>

<?php if (get_option('op_cat_parallax_image') == 'on') { ?> 
<div class="inner">
<?php } ?>

<?php if($cat_data['extra1'] == ''){} else { ?>
<?php wp_enqueue_script('dzsparallaxer', BASE_URL . 'js/dzsparallaxer.js', false, '', true); ?>

<div class="dzsparallaxer auto-init">

<div class="divimage dzsparallaxer--target " style="width: 100%; height: 624px; background-image: url(<?php if (isset($cat_data['extra1'])){ echo $cat_data['extra1'];} ?>);">
</div>
<div class="center-it">

<div class="photo_bg_shadow">
<div class="photo_bg">

<div class="inner">
<div class="photo_content_box">
<?php echo $posts_count ?>
<div class="clear"></div>
<h1><?php single_cat_title(''); ?></h1> 
<div class="clear"></div>
<?php echo category_description( ); ?>
</div>
</div>

</div>
</div>

</div>
<?php if (get_option('op_cat_parallax_image') == 'on') { ?> 
</div>
<?php } ?>

<?php } ?>

<div class="clear"></div>
<?php } ?>
</div>


<?php if (get_option('op_cat_slider_style') == 'Default') { ?> 
<?php if (get_option('op_category_slider') == 'on') { ?>
<?php get_template_part('includes/cat_slider'); ?>
<?php } ?>
<?php } ?>

<?php if (get_option('op_category_carousel') == 'on') { ?>
<?php get_template_part('includes/random_carousel'); ?>
<?php } ?>

<div class="inner">

<div id="content<?php if (isset($cat_data['extra2'])){ echo $cat_data['extra2'];} ?>" class="EqHeightDiv">	

<div class="index_inner">	

<?php if (get_option('op_cat_slider_style') == 'Elastic Slider') { ?> 
<?php if (get_option('op_category_slider') == 'on') { ?>
<?php get_template_part('includes/elastic_slider_category'); ?>
<?php } ?>
<?php } ?>

<?php if (get_option('op_banner_index') == 'on') { ?>
<div id="banner_index_728">
<?php $index_banner = get_option("op_banner_index_code"); ?>
<?php echo stripslashes($index_banner); ?>
</div>
<?php } ?>

    <?php if (get_option('op_index_post_style')!== 'Default') { ?>
    <?php $index_post_style = 'post_' . get_option("op_index_post_style"); ?> 
    <?php } ?>

    <div id="<?php echo $index_post_style ?>">	

    <div class="mosaicflow" data-item-selector=".post, .product" data-min-item-width="260">	

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
 
    <?php if (get_option('op_index_post_style')!== 'Default') { ?>
  	<?php 
	
		$format = get_post_format(); if ( false === $format ) { 
		$post_format_image_Kesha = ''; 
		}
					
		if(has_post_format('video')) { 
		$post_format_image_Kesha = '<div class="post_format_video_Kesha"></div>';
		}
					
		if(has_post_format('image')) {
		$post_format_image_Kesha = '<div class="post_format_image_Kesha"></div>';
		}
		
		if(has_post_format('audio')) {
		$post_format_image_Kesha = '<div class="post_format_audio_Kesha"></div>';
		}

    ?>	
	 
	<?php } else { ?>
	 
 	<?php 
		$format = get_post_format(); if ( false === $format ) { 
		$post_format_image = '<div class="post_format"></div>'; 
		}
					
		if(has_post_format('video')) { 
		$post_format_image = '<div class="post_format_video"></div>';
		}
					
		if(has_post_format('image')) {
		$post_format_image = '<div class="post_format_image"></div>';
		}
		
		if(has_post_format('audio')) {
		$post_format_image = '<div class="post_format_audio"></div>';
		}
	?> 
	
    <?php } ?> 
 
	<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">	

		
	
		<?php if(has_post_thumbnail()) { ?>
		<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumbnails', false, '' ); $thumbnailSrc = $src[0]; ?>		
		
		<div class="post_img_box">
        <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
		<?php $image = aq_resize( $thumbnailSrc, 480, 'auto', false); ?>
        <img src="<?php echo $image ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
		<?php echo $post_format_image_Kesha; ?>
		</a>
		</div>	
		
		<div class="cats_and_formats_box">
		<?php $category = get_the_category();
        if ($category) {
        echo '<a class="custom_cat_class" href="' . get_category_link( $category[0]->term_id ) . '" title="' . sprintf( __( "%s", "my-text-domain" ), $category[0]->name ) . '" ' . '>' . $category[0]->name.'</a> ';
        }
        ?>
		
		<?php echo $post_format_image; ?>
		</div>
		
        <div class="clear"></div>
        <?php } else {} ?>

		<?php
		$more_cat_posts = get_option('op_view_more_in_category');
		$categories_string = '';
			foreach((get_the_category()) as $category) {
           
			$categories_string .= '<a class="custom_cat_class_Kesha tip" href="'.get_category_link( $category->term_id ).' " title="' . esc_attr( sprintf( __( "$more_cat_posts %s" ), $category->name ) ) . '" " >'.$category->cat_name.'</a>';
	        } 
		$categories_string = trim($categories_string);
		?>
		<?php echo $categories_string; ?>
        <div class="clear"></div>
		
		
		<h1><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" ><?php the_title(); ?> &raquo;</a></h1>
		
		<?php $post_text = get_post_meta($post->ID, 'r_post_text', true); ?>
	    <?php if($post_text !== '') { ?>
	    <p>
	    <?php echo $post_text; ?>
        </p> 

	    <?php } else { ?>
		<?php the_excerpt(); ?>
        <?php } ?>

		<?php if (get_option('op_blog_meta_line') == 'on') { ?>	
		<div class="bottom_info_box"><div class="info_box_inner">
		<div class="category_time"><?php the_time('j M, Y'); ?></div>	
        <div class="post_views"><?php echo getPostViews(get_the_ID()); ?></div>
		
		<div class="cat_author"><?php echo get_option('op_author'); ?> <?php the_author_link(); ?></div> 
		
		
        <?php $custom_read_more = get_post_meta($post->ID, 'r_custom_read_more', true); ?>
	    <?php if($custom_read_more !== '') { ?>
	    <div class="custom_read_more">
					
        <?php $custom_rm_link = get_post_meta($post->ID, 'r_custom_rm_link', true); ?>
	    <?php if($custom_rm_link !== '') { ?>
		<a href="<?php echo $custom_rm_link; ?>" title="<?php the_title(); ?>" target="_blank">
		<?php } else { ?>	
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">					
	    <?php } ?>	
					
	    <?php echo $custom_read_more; ?> &raquo;
		</a>
        </div>
	    <?php } else { ?>
	    <div class="custom_read_more">
					
        <?php $custom_rm_link = get_post_meta($post->ID, 'r_custom_rm_link', true); ?>
	    <?php if($custom_rm_link !== '') { ?>
		<a href="<?php echo $custom_rm_link; ?>" title="<?php the_title(); ?>" target="_blank">
		<?php } else { ?>	
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">					
	    <?php } ?>	
					
		<?php echo get_option('op_read_more'); ?>
					
		</a>
        </div>
		<?php } ?>
		
		
		
		
		</div></div>
        <?php } ?>
		
	</div>
	
	
		<?php endwhile; ?>
		<?php else : ?>
		
		<div class="post_nr">
        <h2><?php echo get_option('op_nothing_found'); ?></h2>
        <div class="single-entry">
		<?php echo get_option('op_nothing_found_text'); ?>
		<div class="clear"></div>
		<?php get_search_form(); ?>
		<div class="clear"></div>
		</div>
		<?php get_template_part('includes/archive_layout'); ?>
        </div>

	    <?php endif; ?>	 

</div>
</div>

</div>		
	
<div class="clear"></div>

        <?php if(function_exists('wp_pagenavi')) { ?>
		<div class="postnav"> 
		<?php wp_pagenavi(); ?>
        </div>
		
        <?php } else { ?>
        <?php custom_pagination(); ?>
        <?php } ?>
 
	    <div class="clear"></div>

</div>

<?php if($cat_data['extra2'] == '_hide_sidebar'){ } else { ?>
	<?php get_sidebar('right'); ?>	
<?php } ?>	
	
</div>
</div>

<div class="clear"></div>
	
<?php get_footer(); ?>

	