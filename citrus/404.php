<?php get_header();?>

<div class="container">

	<?php 
	$page_layout =  dttheme_option('specialty','not-found-404-layout');
	$show_sidebar = $show_left_sidebar = $show_right_sidebar =  false;
	$sidebar_class="";

	switch ( $page_layout ) {
		case 'with-left-sidebar':
			$page_layout = "with-sidebar with-left-sidebar";
			$show_sidebar = $show_left_sidebar = true;
			$sidebar_class = "secondary-has-left-sidebar";
		break;

		case 'with-right-sidebar':
			$page_layout = "with-sidebar with-right-sidebar";
			$show_sidebar = $show_right_sidebar	= true;
			$sidebar_class = "secondary-has-right-sidebar";
		break;

		case 'both-sidebar':
			$page_layout = "with-sidebar page-with-both-sidebar";
			$show_sidebar = $show_right_sidebar	= $show_left_sidebar = true;
			$sidebar_class = "secondary-has-both-sidebar";
		break;

		case 'content-full-width':
		default:
			$page_layout = "content-full-width";
		break;
	}
	global $dt_allowed_html_tags;
	
	if ( $show_sidebar ):
		if ( $show_left_sidebar ): ?>
			<!-- Secondary Left -->
			<div id="secondary-left" class="secondary-sidebar <?php echo $sidebar_class;?>"><?php get_sidebar( 'left' );?></div><?php
		endif;
	endif;?>

	<!-- ** Primary Section ** -->
	<div id="primary" class="<?php echo $page_layout;?>">
		<div class="error-info">
			<?php echo wp_kses(stripcslashes(dttheme_option('specialty','404-message')), $dt_allowed_html_tags);?>
            <?php get_search_form();?>
			<a href="<?php echo home_url();?>" title="" class="dt-sc-button small"><?php _e('Back to Home','dt_themes');?></a> 
		</div>
	</div ><!-- ** Primary Section End ** --><?php

	if ( $show_sidebar ):
		if ( $show_right_sidebar ): ?>
			<!-- Secondary Right -->
			<div id="secondary-right" class="secondary-sidebar <?php echo $sidebar_class;?>"><?php get_sidebar( 'right' );?></div><?php
		endif;
	endif; ?>
    
</div>
<div class="dt-sc-margin70"></div>
    
<?php get_footer(); ?>