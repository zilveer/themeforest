<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<div class = "entry-thumb text-center">
	<div class="icon-wrap"><i class="navicon-quote-right"></i></div>
	<a href="<?php echo the_permalink(); ?>" class="quote-content"><?php is_single() ? the_content() : the_excerpt(); ?></a>
	<?php $post_custom_author_name = get_post_meta(get_the_ID(), "post_custom_author_name", true ); ?>
	<?php if (!empty($post_custom_author_name)): ?>
			<div class="quote-author"><?php echo $post_custom_author_name; ?></div>
	<?php endif; ?>
</div>
