<?php
/*
@package WordPress
@subpackage The Cause
*/

get_header('sidebar');

?>

<h2><?php woocommerce_page_title(); ?></h2>


<div id="post-<?php echo $postID; ?>">
	<div> <?php get_sidebar('shop'); ?>

		<!-- INNER content -->
		<div id="inner" class="woocommerce">
		<?php woocommerce_content(); ?>
		</div>		
		
	</div>		
</div>


<?php get_footer(); ?>