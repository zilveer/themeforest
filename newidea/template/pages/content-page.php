<?php
/**
 * Page Content as page with full content 
 *
 * @subpackage newidea
 * @since newidea 4.0
 */
global $page_id, $object_id, $default_background;

$post = get_page($object_id);

$bg = $default_background;
if( newidea_get_post_meta_key('default-image', $post->ID) != ""){
	$bg = newidea_get_post_meta_key('default-image', $post->ID);
}
?>
<!--Page-->
<section id="<?php echo $page_id;?>" class="contBg" data-bg="<?php echo $bg;?>"  >
	<span></span>
    <div class="external-container">
        <h2 class="title"><?php echo $post->post_title; ?></h2>
        <?php 
			$content = $post->post_content;
			$content = apply_filters( 'the_content', $content );
		?>
        <div class="scroll-pane">
			<div><?php echo $content; ?></div>
        </div>
    </div>
</section>
