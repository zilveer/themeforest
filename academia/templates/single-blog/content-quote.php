<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 11/2/2015
 * Time: 2:46 PM
 */

$prefix = 'g5plus_';

$quote_content = rwmb_meta($prefix.'post_format_quote',array(),get_the_ID());
$quote_author = rwmb_meta($prefix.'post_format_quote_author',array(),get_the_ID());
$quote_author_url = rwmb_meta($prefix.'post_format_quote_author_url',array(),get_the_ID());

$class = array();
$class[]= "clearfix";
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
	<?php g5plus_set_view(get_the_ID());?>
	<?php if (!empty($quote_content) && !empty($quote_author) && !empty($quote_author_url)) : ?>
	<div class="entry-quote-wrap">
		<i class="fa fa-quote-left"></i>
		<blockquote>
			<p><?php echo esc_html($quote_content); ?></p>
			<cite><a href="<?php echo esc_url($quote_author_url) ?>" title="<?php echo esc_attr($quote_author); ?>"><?php echo esc_html($quote_author); ?></a></cite>
		</blockquote>
	</div>
	<?php endif; ?>
	<div class="entry-content-wrap">
		<h3 class="entry-post-title p-font"><?php the_title(); ?></h3>
		<div class="entry-post-meta-wrap">
			<?php g5plus_post_meta(); ?>
		</div>
		<div class="entry-content clearfix">
			<?php
			the_content();
			g5plus_link_pages();
			?>
		</div>
		<?php
		/**
		 * @hooked - g5plus_post_tags - 10
		 * @hooked - g5plus_share - 15
		 *
		 **/
		do_action('g5plus_after_single_post_content');
		?>
	</div>
	<?php
	/**
	 * @hooked - g5plus_post_nav - 20
	 * @hooked - g5plus_post_author_info - 25
	 * @hooked - g5plus_post_related - 30
	 *
	 **/
	do_action('g5plus_after_single_post');
	?>
</article>
