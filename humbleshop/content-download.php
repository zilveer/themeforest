<?php
/**
 * The template for displaying content in the single-download.php template
 */

$column = 'col-sm-7';

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array($column)); ?>>

	<div class="entry-content clearfix" itemscope itemtype="http://schema.org/Product">
		<?php if ( has_excerpt() ) { echo '<p>'.get_the_excerpt().'</p>'; } ?>

		<?php the_content(); ?>
		<hr>
		<p>
			<small>
			<?php echo get_the_term_list( $post->ID, 'download_tag', '<span>TAG :</span> ', ', ', '' ); ?>
			<br>
			<?php echo get_the_term_list( $post->ID, 'download_category', '<span>CATEGORY :</span> ', ', ', '' ); ?>	
			</small>
		</p>
	</div>

<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-52b45886732c82f7"></script>
<!-- AddThis Button END -->

<?php comments_template(); ?> 
	
</article>