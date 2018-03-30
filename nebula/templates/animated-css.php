<?php 
	header("Content-Type: text/css");
	$absolute_path = __FILE__;
	$path_to_file = explode( 'wp-content', $absolute_path );
	$path_to_wp = $path_to_file[0];
	require_once( $path_to_wp.'/wp-load.php' );

	//Check if hide portfolio navigation
	$pp_portfolio_single_nav = get_option('pp_portfolio_single_nav');
	if(empty($pp_portfolio_single_nav))
	{
?>
.portfolio_nav { display:none; }
<?php
	}
?>
<?php
	$pp_fixed_menu = get_option('pp_fixed_menu');
	
	if(!empty($pp_fixed_menu))
	{
?>
.top_bar.fixed
{
	position: fixed;
	animation-name: fadeIn;
	-webkit-animation-name: fadeIn;	
	animation-duration: 0.5s;	
	-webkit-animation-duration: 0.5s;
	visibility: visible !important;
}
<?php
}
?>

<?php
	//Hack animation CSS for Safari
	$current_browser = getBrowser();
	
	if(isset($current_browser['name']) && $current_browser['name'] != 'Internet Explorer'  && $current_browser['name'] != 'Apple Safari')
	{
?>
@-webkit-keyframes fadeIn { from { opacity:0; } to { opacity:0.99; } }
@-moz-keyframes fadeIn { from { opacity:0; } to { opacity:0.99; } }
@keyframes fadeIn { from { opacity:0; } to { opacity:0.99; } }
 
.fade-in {
    animation-name: bigEntrance;
	-webkit-animation-name: bigEntrance;	

	animation-duration: 0.7s;	
	-webkit-animation-duration: 0.7s;

	animation-timing-function: ease-out;	
	-webkit-animation-timing-function: ease-out;	

	-webkit-animation-fill-mode:forwards; 
    -moz-animation-fill-mode:forwards;
    animation-fill-mode:forwards;
}
 
.fade-in.one {
	-webkit-animation-delay: 0.5s;
	-moz-animation-delay: 0.5s;
	animation-delay: 0.5s;
}

.fade-in.two {
	-webkit-animation-delay: 1.2s;
	-moz-animation-delay:1.2s;
	animation-delay: 1.2s;
}
 
.fade-in.three {
	-webkit-animation-delay: 1.4s;
	-moz-animation-delay: 1.4s;
	animation-delay: 1.4s;
}

.fade-in.four {
	-webkit-animation-delay: 1.6s;
	-moz-animation-delay: 1.6s;
	animation-delay: 1.6s;
}
#supersized { 
	opacity:0;  /* make things invisible upon start */
	-webkit-animation:fadeIn ease-in 1;  /* call our keyframe named fadeIn, use animattion ease-in and repeat it only 1 time */
	-moz-animation:fadeIn ease-in 1;
	animation:fadeIn ease-in 1;
	
	-webkit-animation-fill-mode:forwards;  /* this makes sure that after animation is done we remain at the last keyframe value (opacity: 1)*/
	-moz-animation-fill-mode:forwards;
	animation-fill-mode:forwards;
	
	-webkit-animation-duration:0.3s;
	-moz-animation-duration:0.3s;
	animation-duration:0.3s;
	
	-webkit-animation-delay: 0.5s;
	-moz-animation-delay: 0.5s;
	animation-delay: 0.5s;
}

<?php
	}
	else
	{
?>
	.fade-in, #supersized, #gallery_caption, #blog_grid_wrapper .post.type-post, #galleries_grid_wrapper .gallery.type-gallery, .one_half.portfolio2_wrapper, .one_third.portfolio3_wrapper, .one_fourth.portfolio4_wrapper, .mansory_thumbnail, #photo_wall_wrapper .wall_entry, #portfolio_filter_wrapper .element { opacity: 1 !important; }
	body { overflow-x: auto; }
<?php
	}
?>

<?php
	for($i=1;$i<=50;$i++)
	{
?>
.animated<?php echo $i; ?>
{
	-webkit-animation-delay: <?php echo $i/5; ?>s;
	-moz-animation-delay: <?php echo $i/5; ?>s;
	animation-delay: <?php echo $i/5; ?>s;
}
<?php
	}
?>