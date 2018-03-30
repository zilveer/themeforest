<?php get_header(); ?>
<?php
require(get_template_directory().'/inc/cb-general-options.php');
require(get_template_directory().'/inc/cb-page-options.php');

require(get_template_directory().'/inc/cb-little-head.php');
$hst='';
$hst1='';
$hst2='';
if($headtfc!=''||$headtsc!='') {
	if($headtfc!='') $hst1='color:'.$headtfc.';';
	if($headtsc!='') $hst2='text-shadow:1px 1px '.$headtsc.';';
	$hst='style="'.$hst1.$hst2.'"';
}
?>


<?php if($showbreads!='no'&&$show_bread=='yes'&&$header_type!='slider_head'){ if(function_exists('yoast_breadcrumb')){ yoast_breadcrumb('<div class="bread_wrap"><div class="wrapper_p"><div id="breadcrumbs">','</div><div class="cl"></div></div></div>'); } } ?>

</div>
</div>
<!-- bg_head end -->

<div id="middle"
<?php if($fullg=='yes'&&$cb_type=='gallery') echo 'style="padding:0!important;"'; ?>>
	<div
		class="wrapper_p <?php if($fullg=='yes'&&$cb_type=='gallery') echo 'fullgallery'; ?>">

		<?php if(($header_type=='slider_head'&&($title=='yes'||$title==''))||($header_type=='map'&&($title=='yes'||$title==''))) { ?>
		<?php echo '<h1 class="in"><a href="'.get_permalink().'" '.$hst.'>'.get_the_title().'</a></h1>'; ?>
		<?php } ?>

		<?php if($cb_type!='contact') { if($sidebar=='left') { ?>
		<div id="sidebar_l">
		<?php if($sidebar_name!='0') { dynamic_sidebar($sidebar_name); } else { dynamic_sidebar('sidebar'); } ?>
		</div>
		<!-- sidebar #end -->
		<?php } } ?>

		<?php  $cb_type_h=''; switch($cb_type) {
			case 'home':
				$cb_type_h='id="page"';
				break;
			case 'default':
				$cb_type_h='id="page"';
				break;
			case 'blog':
				$cb_type_h='id="blog-masonry"';
				break;
			case 'portfolio':
				$cb_type_h='id="portfolio"';
				break;
			case 'gallery':
				$cb_type_h='id="gallery"';
				break;
			case 'video':
				$cb_type_h='id="page"';
				break;
			case 'audio':
				$cb_type_h='id="page"';
				break;
			case 'slider':
				$cb_type_h='id="page"';
				break;
			case 'contact':
				$cb_type_h='id="page"';
				break;
			default:
				$cb_type_h='id="page"';
				break;
		}
		?>

		<div <?php echo $cb_type_h; ?> <?php if($side=='yes') { ?>
			class="side <?php if($sidebar=='left') echo 'side_right'; if($sidebar=='right') echo 'side_left'; else echo 'side'; ?>"
			<?php } ?>>

			<?php if($header_type!='slider_head'&&$header_type!='map'&&$title=='yes') { ?>
			<div class="wrapper_p <?php echo 'head_title';?>">
			<?php if(($title=='yes'||$title=='')&&$cb_type!='home') echo '<h1 class="title"><a href="'.get_permalink().'" '.$hst.'>'.get_the_title().'</a></h1>'; ?>
			</div>
			<div class="cl"></div>
			<?php } ?>


			<?php  switch($cb_type) {
				case 'home':
					get_template_part('cb-default');
					break;
				case 'default':
					get_template_part('cb-default');
					break;
				case 'blog':
					get_template_part('cb-blog');
					break;
				case 'portfolio':
					get_template_part('cb-portfolio');
					break;
				case 'gallery':
					get_template_part('cb-gallery');
					break;
				case 'video':
					get_template_part('cb-video');
					break;
				case 'audio':
					get_template_part('cb-audio');
					break;
				case 'slider':
					get_template_part('cb-slider');
					break;
				case 'contact':
					get_template_part('cb-contact');
					break;
				default:
					get_template_part('cb-default');
					break;
			}
			?>
		</div>

		<?php if($cb_type!='contact') { if ($sidebar=='right') { ?>
		<div id="sidebar_r">
			<ul>
			<?php if($sidebar_name!='0') { dynamic_sidebar($sidebar_name); } else { dynamic_sidebar('sidebar'); } ?>
			</ul>
		</div>
		<!-- sidebar #end -->
		<?php } } ?>
		<div class="cl"></div>
	</div>
	<!-- wrapper #end -->

	<div class="middle_right_bg"></div>

</div>
<!-- middle #end -->

<?php get_footer(); ?>
