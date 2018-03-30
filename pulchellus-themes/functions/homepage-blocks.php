<?php

/* -------------------------------------------------------------------------*
 * 							HOMEPAGE 4 INFO BLOCKS							*
 * -------------------------------------------------------------------------*/
 
	function homepage_4_info_blocks($blockType, $blockId,$blockInputType) {
?>
	<div class="container">
		<div class="row">
<?php	
		for($i=1; $i<=4; $i++) { 
			$title = get_option(THEME_NAME."_".$blockType."_title_".$i."_".$blockId);
			$text = get_option(THEME_NAME."_".$blockType."_text_".$i."_".$blockId);
			$icon = get_option(THEME_NAME."_".$blockType."_icon_".$i."_".$blockId);
			if((isset($title) || isset($text)) && ($text != "" || $title != "")) {	
?>			
          <div class="four columns">
				<div class="service-box">
					<i class="<?php echo $icon;?>"></i>
					<h4><?php echo stripslashes($title);?></h4>
					<p><?php echo stripslashes($text);?></p>
				</div>
          </div>

<?php			
			}
		}
?>
		</div>
	</div>
	<div class="sixteen columns"><hr class="stripe"/></div>
<?php
	}
	
?>

<?php

/* -------------------------------------------------------------------------*
 * 							HOMEPAGE FEATURED BOX							*
 * -------------------------------------------------------------------------*/
 
	function homepage_featured_box($blockType, $blockId,$blockInputType) {
		$title = get_option(THEME_NAME."_".$blockType."_title_".$blockId);
		$text = get_option(THEME_NAME."_".$blockType."_text_".$blockId);
		$link = get_option(THEME_NAME."_".$blockType."_link_".$blockId);
		$linkText = get_option(THEME_NAME."_".$blockType."_link_text_".$blockId);
?>
	<div class="sixteen columns">
		<div class="call-to-action">
				<div class="call-to-action-text">
					<h3><?php echo stripslashes($title);?></h3>
					<p><?php echo stripslashes($text);?></p>
				</div>
				<div class="call-to-action-button">
					<?php if($link) { ?>
						<a href="<?php echo $link;?>" target="_blank" class="button"><?php echo $linkText;?></a>
					<?php } ?>
				</div>
		</div>
	</div>
	<div class="sixteen columns"><hr class="stripe"/></div>
<?php
	}
	
?>
<?php
/* -------------------------------------------------------------------------*
 * 							HOMEPAGE MAIN ARTICLE							*
 * -------------------------------------------------------------------------*/
 
	function homepage_main_news_block($blockType, $blockId,$blockInputType) {
		global $post;
		$type = get_option(THEME_NAME."_".$blockType."_type_".$blockId);
		$title = get_option(THEME_NAME."_".$blockType."_title_".$blockId);

	
		$type = explode(",", $type);
		
		$query = array('post_type' => $type, 'showposts' => 4);
		$my_query = new WP_Query($query);
		$counter = 1;
		

?>
	<div class="row">
    	<!-- Heading title -->
        <div class="sixteen columns heading">
        	<h4><?php echo stripslashes($title);?><span><a href="<?php get_page_link(get_option('page_for_posts'));?>"> <?php _e("View all posts",THEME_NAME);?></a></span></h4>
        </div>
	

		<?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
		<?php $image = get_post_thumb($post->ID,350,250);?>
		<?php $imageL = get_post_thumb($post->ID,640,'');?>
			<!-- Entry post -->
			<article class="four columns entry-post">
				<div class="entry-thumb hover-image">
					<a class="fancybox" href="<?php echo $imageL['src'];?>"><img src="<?php echo $image['src'];?>" alt="<?php the_title();?>"></a>
				</div>
				<h4 class="entry-title">
					<a href="<?php the_permalink();?>"><?php the_title();?></a>
				</h4>
				<ul class="entry-meta">
					<li class="posted-date"><?php the_time("F d, Y");?></li>
					<?php if ( comments_open() && ($my_query->post->post_type)!="portfolio-item") { ?>
						<li class="posted-comments"><a href="<?php the_permalink();?>#comments"><?php comments_number(__('0', THEME_NAME), __('1', THEME_NAME), __('%', THEME_NAME)); ?></a></li>
					<?php } ?>
				</ul>
				<div class="entry-content">
					<p><?php echo WordLimiter(get_the_content(), 10);?></p>
				</div>
			</article>
		<?php endwhile; else: ?>
			<p><?php printf ( __('No posts were found', THEME_NAME)); ?></p>
		<?php endif; ?>	
    </div>
	<div class="sixteen columns"><hr class="stripe"/></div>
<?php
	}
?>


<?php

/* -------------------------------------------------------------------------*
 * 						HOMEPAGE CATEGORY ARTICLE							*
 * -------------------------------------------------------------------------*/
 
	function homepage_cat_news_block($blockType, $blockId,$blockInputType) {
		global $post;
		$title = get_option(THEME_NAME."_".$blockType."_title_".$blockId);
		$description = get_option(THEME_NAME."_".$blockType."_description_".$blockId);
		$type = get_option(THEME_NAME."_".$blockType."_type_".$blockId);
		$catID = get_option(THEME_NAME."_".$blockType."_id_".$blockId);
		
		switch($type) {
			case "post" :
				$d="";
				$taxonomy="category";
				break;
			case "portfolio-item" :
				$d="p";
				$taxonomy="portfolio-cat";
				break;
		}
		
		$catID = get_option(THEME_NAME."_".$blockType."_".$d."id_".$blockId);
		$term = get_term( $catID, $taxonomy);
		if($type=="post") {
			$args = array(
				'post_type' => $type,
				'showposts' => 4,
				'cat' => $catID
			);
			$link = get_category_link($catID);
		} else { 
			$args = array(
				'post_type' => $type,
				'showposts' => 4,
				'tax_query' => array(
					array(
						'taxonomy' => $taxonomy,
						'terms' => $term
					)
				)
			);
	
			$link = get_term_link($term,$taxonomy);
		}
		
		
		$my_query = new WP_Query($args);
		$counter = 0;


?>
	<div class="row">
    	<!-- Heading title -->
        <div class="sixteen columns heading">
        	<h4><?php echo stripslashes($title);?><span><a href="<?php echo $link;?>"> <?php _e("View all posts",THEME_NAME);?></a></span></h4>
        </div>
	

		<?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
		<?php $image = get_post_thumb($post->ID,350,250);?>
		<?php $imageL = get_post_thumb($post->ID,640,'');?>
			<!-- Entry post -->
			<article class="four columns entry-post">
				<div class="entry-thumb hover-image">
					<a class="fancybox" href="<?php echo $imageL['src'];?>"><img src="<?php echo $image['src'];?>" alt="<?php the_title();?>"></a>
				</div>
				<h4 class="entry-title">
					<a href="<?php the_permalink();?>"><?php the_title();?></a>
				</h4>
				<ul class="entry-meta">
					<li class="posted-date"><?php the_time("F d, Y");?></li>
					<?php if ( comments_open() && $type!="portfolio-item") { ?>
						<li class="posted-comments"><a href="<?php the_permalink();?>#comments"><?php comments_number(__('0', THEME_NAME), __('1', THEME_NAME), __('%', THEME_NAME)); ?></a></li>
					<?php } ?>
				</ul>
				<div class="entry-content">
					<p><?php echo WordLimiter(get_the_content(), 10);?></p>
				</div>
			</article>
		<?php endwhile; else: ?>
			<p><?php printf ( __('No posts were found', THEME_NAME)); ?></p>
		<?php endif; ?>	
    </div>
	<div class="sixteen columns"><hr class="stripe"/></div>
<?php
	}
?>

<?php

/* -------------------------------------------------------------------------*
 * 								TEXT BLOCK									*
 * -------------------------------------------------------------------------*/

	function homepage_text_block($blockType, $blockId,$blockInputType) {
		$title = stripslashes(get_option(THEME_NAME."_".$blockType."_title_".$blockId));
		$subtitle = stripslashes(get_option(THEME_NAME."_".$blockType."_subtitle_".$blockId));
	?>
		<div class="sixteen columns text-center">
			<h1><?php echo do_shortcode($title);?></h1>
			<h3 class="subheader"><?php echo do_shortcode($subtitle);?></h3>
			
		</div>
		<div class="sixteen columns"><hr class="stripe"/></div>
	<?php
	}
?>
<?php

/* -------------------------------------------------------------------------*
 * 									HTML CODE								*
 * -------------------------------------------------------------------------*/

	function homepage_html($blockType, $blockId,$blockInputType) {
		$text = stripslashes(get_option(THEME_NAME."_".$blockType."_".$blockId));
	?>
		<div class="row">
			<?php echo do_shortcode($text);?>
		</div>
	<?php
	}
?>
