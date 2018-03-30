<?php 
$quote_array = flow_elated_get_quote_meta_fields();
$quote_text = $quote_array['quote_text'];
$quote_author = $quote_array['quote_author'];
?>
<div class="eltd-post-title">
	<div class="eltd-quote-title">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php echo esc_attr($quote_text); ?>
		</a>
	</div>
	<span class="eltd-quote-author">&mdash; <?php echo esc_attr($quote_author); ?></span>
</div>