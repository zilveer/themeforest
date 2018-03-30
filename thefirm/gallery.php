<?php
/*
Template Name: Gallery
*/
?>

<?php if (!(isset($_POST["ishome"]) && $_POST["ishome"] == 1)) 
	$firmIsPage = true;


if ($firmIsPage) {
?>
	<?php get_header(); ?>

<?php }; ?>


<?php
$args = array(
	'post_type' => 'attachment',
	'numberposts' => null,
	'post_status' => null,
	'post_parent' => $post->ID,
	'posts_per_page' => -1
);
$attachments = get_posts($args);
$count = 1;
if ($attachments) {
	foreach ($attachments as $attachment) {		
		?>
		<?php  if ( $count % 4 == 0) $class2 = ' style="float: right;" '; ?>
		<?php  if (!($count % 4 == 0)) $class2 = 'style="float: left; margin-right: 53px;"'; ?>
		
			<div <?php echo $class2; ?> class="galleryimage">
			<?php $imgurl = wp_get_attachment_image_src($attachment->ID, 'full'); ?>
				<a rel="prettyPhoto[11]" href="<?php echo $imgurl[0]; ?>" ><img class="imghBXinner" src="<?php echo wp_get_attachment_thumb_url($attachment->ID); ?>" /></a>
			</div>
		<?php  if ( $count % 4 == 0) echo '<div class="clearfix"></div> <div style="height: 53px;"></div>'; ?>
		<?php
		$count++;
	}
}
?>
<div class="clearfix"></div>
<?php if ($firmIsPage) { ?>


<script type="text/javascript" charset="utf-8">
  jQuery(document).ready(function(){
    jQuery("a[rel^='prettyPhoto']").prettyPhoto({social_tools: false});
  });
</script>

	<?php get_footer(); ?>
<?php }; ?>