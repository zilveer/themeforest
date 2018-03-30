<?php
if (!defined('ABSPATH')) exit();

$post_type_values = get_post_meta($post->ID, 'post_type_values', true);
//echo do_shortcode('[blockquote type="type-bg-color" author="' . $post_type_values['quote_author'] . '"]' . $post_type_values['quote'] . '[/blockquote]');
?>

<div class="quote-inner">
	<?php if (isset($post_type_values['quote'])){ ?>
	<blockquote class="blockquote">
		<p>
			<a href="<?php echo esc_url(get_permalink($post->ID)) ?>"><?php echo (isset($post_type_values['quote'])) ? esc_html($post_type_values['quote']) : '' ; ?></a>
		</p>
		<div class="quote-meta">
			<?php echo (isset($post_type_values['quote_author'])) ? esc_html($post_type_values['quote_author']) : ''; ?>
		</div>
	</blockquote>
	<?php } ?>
</div>