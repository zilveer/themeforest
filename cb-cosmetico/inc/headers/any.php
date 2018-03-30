<?php
/* anything slider */

require(get_template_directory().'/inc/cb-general-options.php');
require(get_template_directory().'/inc/cb-page-options.php');

require(get_template_directory().'/inc/cb-little-head.php');

?>
<ul id="slider" style="<?php if($s_height!=''){ echo 'height:'.$s_height.';'; } else echo 'height:530px;'; ?>width:100%;">
<?php
$sww='980'; $shh='340';
if($s_height!='')$shh=substr($s_height,0,-2)-35;
query_posts('cat='.$cat.'&order=ASC');
$ij=0;
if(have_posts()) : ?>
<?php while(have_posts()) : the_post() ?>
<?php $con=apply_filters('the_content', get_the_content()); $isrc=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full'); ?>
	<li class="panel<?php echo $ij; ?>"><?php if($isrc[0]!='') { ?> <script
			type="text/javascript">
jQuery(document).ready(function(){
jQuery("li.panel<?php echo $ij; ?>").backstretch("<?php echo $isrc[0]; ?>");
});
</script> <?php } ?> <?php if($isrc) { ?> <?php if($s_link=='yes') { ?><a
		href="<?php echo get_permalink(); ?>"><?php } ?> <?php if($s_text=='yes') { $sww2=$sww-40; echo '<div class="wrapper_p w_imp"><div style="width:980px;position:absolute;z-index:2;padding-bottom:20px;padding-top:15px;" class="slide_text">'.$con.'</div></div>'; } ?>
		<?php if($s_link=='yes') { ?> </a> <?php } ?> <?php } else {?> <?php $sww2=$sww-40; echo '<div class="wrapper_p" style="width:980px!important;"><div class="slider_top_c" style="padding-left:0px;padding-right:0px;"><div class="slide_c">'.$con.'</div></div></div>'; } echo'</li>'; $ij++; $isrc[0]='';endwhile; endif; wp_reset_query(); ?>

</ul>
