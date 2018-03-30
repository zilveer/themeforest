<?php if(! defined('ABSPATH')){ return; }
global $current_post;
if(!isset($current_post['title']) || empty( $current_post['title'] ) ) {
	if(! is_array($current_post)){
		$current_post = array();
	}
	$current_post['title'] = get_the_title();
}
$date_format = zget_option( 'blog_date_format', 'blog_options', false, 'l, d F Y' );
?>

<div class="itemHeader kl-blog-item-header">
	<?php echo $current_post['title']; ?>
	<div class="post_details kl-blog-item-details kl-font-alt">
		<span class="catItemDateCreated kl-blog-item-date updated" <?php echo WpkPageHelper::zn_schema_markup('post_time'); ?>><?php the_time( $date_format );?></span>
		<span class="catItemAuthor kl-blog-item-author" <?php echo WpkPageHelper::zn_schema_markup('author'); ?>><?php echo __( 'by', 'zn_framework' );?> <?php the_author_posts_link(); ?></span>
	</div>
	<!-- end post details -->
</div>
