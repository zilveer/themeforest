<?php

$theme_settings = sleek_theme_settings();

// stop if sidebar disabled
if( !$theme_settings->layout['use_sidebar'] ){
	return;
}



/* Sidebar Content */
$sidebar_tab_general = true;

if(
	!is_active_sidebar('sidebar-area')
	|| (
		is_singular()
		&& get_post_meta( get_the_ID(), 'sidebar_use_general_tab', true ) == '0'
	)
){
	$sidebar_tab_general = false;
}

if( function_exists('bp_current_component') ){
	if( bp_current_component() ){
		$sidebar_tab_general = true;
	}
}


/* Sidebar Comments */
$sidebar_tab_comments = false;

if(
	is_singular() // is single post or page
	&& get_post_meta( get_the_ID(), 'comments_use', true ) != '0' // comments are not disabled on post
	&& ( comments_open() || get_comments_number() > 0 ) // comments are open and cound > 0
	&& $theme_settings->layout['comments_in_sidebar'] // comments are in sidebar [global or override]
){
	$sidebar_tab_comments = true;
}

/* Tabs */
$use_tabs = false;

// if conditions to display tabs met
if(
	is_singular()
	&& $sidebar_tab_general
	&& $sidebar_tab_comments
){
	$use_tabs = true;
}



/* Sidebar Classes */
$sidebar_class = '';
$sidebar_class .= $theme_settings->style['bg']['bg_sidebar_dark'] ? ' dark-mode' : '';
$sidebar_class .= $use_tabs ? ' sidebar--tabs-active sidebar--comments-active' : '';

?>



<!-- sidebar -->
<aside id="sidebar" class="sidebar <?php echo $sidebar_class; ?>">



	<!-- Sidebar Tabs -->
	<?php if( $use_tabs ):?>
		<div class="sidebar__tabs hidden-mobile">
			<a href="#" class="active js-sidebar-tab" data-tab="comments" title="<?php _e('Comments Sidebar Tab', 'sleek'); ?>"><?php comments_number( __( '0 Comments', 'sleek' ), __( '1 Comment', 'sleek' ), __( '% Comments', 'sleek' ) ); ?></a>
			<a href="#" class="js-sidebar-tab" data-tab="general" title="<?php _e('General Sidebar Tab', 'sleek'); ?>"><?php echo $theme_settings->general['sidebar_title']; ?></a>
		</div>
	<?php endif; ?>
	<!-- / Sidebar Tabs -->



	<div class="sidebar__content">



		<!-- Comments -->
		<?php if( $sidebar_tab_comments ){
			echo '<div class="sidebar__comments js-nano js-nano-sidebar-comments">';
			echo '<div class="nano-content">';
				comments_template();

				echo '&nbsp;'; // nedded to calculate margin in height, for full height bg

			echo '</div>';
			echo '</div>';
		}?>
		<!-- / Comments -->



		<!-- Sidebar General -->
		<?php if( $sidebar_tab_general ): ?>

			<div class="sidebar__general js-nano js-nano-sidebar-general">
			<div class="nano-content">

				<?php if( $sidebar_tab_general ){
					if( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-area') );
				}?>

				&nbsp; <!-- nedded to calculate margin in height, for full height bg  -->

			</div>
			</div>
		<?php endif; ?>
		<!-- / Sidebar General -->



	</div>
	<!-- / .sidebar__content -->



</aside>
<!-- / .sidebar -->
