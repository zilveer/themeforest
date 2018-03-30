<?php 

$id = get_the_id();
$content = get_the_content();
$post_meta = wbc_get_meta( $id );
$quote_who = (isset($post_meta['wbc-quote-who']) && !empty($post_meta['wbc-quote-who'])) ? $post_meta['wbc-quote-who'] : 'd';
$quote_message = (isset($post_meta['wbc-quote-message']) && !empty($post_meta['wbc-quote-message'])) ? $post_meta['wbc-quote-message'] : 'd';

?>
<article id="post-<?php the_id();?>" <?php post_class('clearfix');?>>
  

      <div class="post-contents">
 

	      <div class="entry-content clearfix">


	      	<div class="quote-format">
			<?php echo esc_html( $quote_message ); ?>
			<span class="quote-who"><?php echo esc_html( $quote_who ); ?></span>
	      	</div>

			<?php 
				if(is_single()){

					echo apply_filters('the_content', $content);

				}
			?>
			<?php if( is_single() && has_tag() ): ?>

				<div class="tags">
				<?php the_tags(); ?>
				</div>

			<?php endif; ?>
		</div>

    </div>

</article> <!-- ./post -->