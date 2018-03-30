<?php get_header(); ?>

	<div class="bottom-spacer"></div>
	
	<div id="page-post" class="shell clearfix">

	<?php $pageID = get_option('page_for_posts'); $post = get_post($pageID);
	
	$page_options = get_post_meta($post->ID,'_page_options',true);
	$sidebar_choice = get_post_meta($post->ID, '_sidebar_choice', true);
	if (!$sidebar_choice){ $sidebar_choice = 'default-sidebar'; }
	$sidebar_type = get_post_meta($post->ID,'_sidebar_layout',true);
	$sidebar_type = (!empty($sidebar_type) ? $sidebar_type = $sidebar_type[0] : $sidebar_type = false);
	
	if ($sidebar_type == 'left'){
		$page_type = 'right';
	} else if ($sidebar_type == 'right'){
		$page_type = 'left';
	} else if ($sidebar_type == 'no-sidebar'){
		$page_type = 'full';
	} else {
		$page_type = ot_get_option('default_page_type','full');
		switch($page_type):
				
			case 'full' :
				$sidebar_type = 'no-sidebar';
			break;
			case 'left' :
				$sidebar_type = 'right';
			break;
			case 'right' :
				$sidebar_type = 'left';
			break;
		
		endswitch;
	}
	
	?><article <?php post_class($page_type.' page-content'); ?>>
		
		<?php if (!is_array($page_options) || !in_array('hide_breadcrumbs',$page_options) && !in_array('hide_title',$page_options)):
			?><div class="top-nav"<?php
				if (is_array($page_options) && in_array('hide_breadcrumbs',$page_options) && !in_array('hide_title',$page_options)):
					echo ' style="top: 26px;"';
				endif;
			?>><?php js_get_pagination(); ?></div><?php
		endif;
	
		if (!is_array($page_options) || !in_array('hide_breadcrumbs',$page_options)): ?><?php js_breadcrumbs(); ?><?php endif;
		if (!is_array($page_options) || !in_array('hide_title',$page_options)): ?><h1 class="page-title"><span><?php the_title(); ?></span></h1><?php endif;
	
		if ( have_posts() ) : while (have_posts()) : the_post();

			global $thumbnail_type;
			$thumbnail_type = 'recent-post-thumbnail-square';
			get_template_part('singlerow','post');
			
		endwhile; endif;
		
		js_get_pagination();
		wp_reset_query();
		
	?></article><?php
	
	if (isset($sidebar_type) && $sidebar_type != 'no-sidebar'){ ?>
		<aside class="<?php echo $sidebar_type; ?>">
			<?php dynamic_sidebar($sidebar_choice); ?>
		</aside>
	<?php } ?>
	
	</div><div class="bottom-spacer"></div><?php
	
get_footer(); ?>