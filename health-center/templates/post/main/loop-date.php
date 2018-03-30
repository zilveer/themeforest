<?php
/**
 * Post (in loop) date
 *
 * @package wpv
 */

if(!wpv_get_optionb('meta_posted_on')) return;
?>
<div class="post-row-left">
	<?php include(locate_template('templates/post/main/part-date.php')); ?>
</div>
