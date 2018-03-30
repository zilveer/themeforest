<?php get_header(); ?>

<?php
/* cosmetico post template */
require(get_template_directory().'/inc/cb-general-options.php');
require('inc/cb-post-options.php');

require(get_template_directory().'/inc/cb-little-head.php');

/* dynamic or default sidebar */
if(!isset($sidebar_post_name))$sidebar_post_name='';
if(!isset($sidebar_post))$sidebar_post='';
if($sidebar_post=='') $sidebar_post='no';
if($sidebar_post_name=='') $sidebar_post_name='0';
if($sidebar_post=='no'&&$sideb_post=='yes') $sidebar_post=$sideb_col;

$side='';
if($sidebar_post!='none'&&$sidebar_post!='no') $side='yes';

$hst='';
$hst1='';
$hst2='';
$pno='';
if($headtfc!=''||$headtsc!='') {
	if($headtfc!='') $hst1='color:'.$headtfc.';';
	if($headtsc!='') $hst2='text-shadow:1px 1px '.$headtsc.';';
	$hst='style="'.$hst1.$hst2.'"';
}
?>



<?php if($cb_type=='portfolio'&&is_single()) echo '</div>';?>

<?php if($cb_type=='portfolio') $port_wrap='style="margin-top:-30px;position:relative;"';?>


<?php if(!isset($port_wrap))$port_wrap='';if($show_bread=='yes'&&$header_type!='slider_head'){ if(function_exists('yoast_breadcrumb')){ yoast_breadcrumb('<div class="bread_wrap" '.$port_wrap.'><div class="wrapper_p"><div id="breadcrumbs">','</div><div class="cl"></div></div></div>'); } } ?>

</div>
</div>
<!-- bg_head end -->

<div id="middle">
	<div class="wrapper_p">


	<?php if($sidebar_post=='left') { ?>
		<div id="sidebar_l">
		<?php if($sidebar_post_name!='0') { dynamic_sidebar($sidebar_post_name); } else { dynamic_sidebar('sidebar'); } ?>
		</div>
		<!-- sidebar #end -->
		<?php } ?>



		<div id="post"
			class="<?php if($side=='yes'&&$sidebar_post!='none'&&$sidebar_post!='no') { ?>side <?php if($sidebar_post=='left') echo 'side_right'; if($sidebar_post=='right') echo 'side_left'; else echo 'side'; ?> <?php } echo implode(' ',get_post_class()); ?>">

			<?php if($cb_type=='portfolio'&&is_single()) $pno='style="padding-bottom:0px!important;"';
			if($cb_type=='portfolio'&&is_single()) echo '<div class="b_20" style="width:100%;padding:17px 0px;margin-bottom:0px;border-bottom:0px;">';?>
			<?php if($header_type!='map'&&$header_type!='slider_head'||($cb_type=='portfolio'&&is_single())) { ?>
			<div class="wrapper_p <?php echo 'head_title';?>">
			<?php if($title=='yes'||$title=='') echo '<h1 class="title" ><a href="'.get_permalink().'" '.$hst.'>'.get_the_title().'</a></h1>'; ?>
			</div>
			<div class="cl"></div>
			<?php } ?>
			<?php get_template_part('cb-single-templates');?>

		</div>

		<?php if ($sidebar_post=='right') { ?>
		<div id="sidebar_r">
			<ul>
			<?php if($sidebar_post_name!='0') { dynamic_sidebar($sidebar_post_name); } else { dynamic_sidebar('sidebar'); } ?>
			</ul>
		</div>
		<!-- sidebar #end -->
		<?php } ?>

		<div class="cl"></div>

	</div>
	<!-- wrapper #end -->

	<div class="middle_right_bg"></div>

</div>
<!-- middle #end -->

<?php get_footer(); ?>