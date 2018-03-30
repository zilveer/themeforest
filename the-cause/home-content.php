<?php global $post;

if (trim($post->post_content)) {

?>

<div>

<?php	
echo apply_filters('the_content', $post->post_content);
?>

</div>

<?php } ?>

