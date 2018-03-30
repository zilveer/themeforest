<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
	$data_title = get_the_title();
	$data_link = get_permalink();
?>
<?php
/*
<div class="dfd-single-share-fixed" data-directory="<?php echo get_template_directory_uri(); ?>">
    <ul>
	    <li class="entry-share-link-facebook" data-title="<?php echo esc_attr($data_title); ?>" data-url="<?php echo esc_url($data_link); ?>"></li>
	    <li class="entry-share-link-twitter" data-title="<?php echo esc_attr($data_title); ?>" data-url="<?php echo esc_url($data_link); ?>"></li>
	    <li class="entry-share-link-googleplus" data-title="<?php echo esc_attr($data_title); ?>" data-url="<?php echo esc_url($data_link); ?>"></li>
	    <li class="entry-share-link-linkedin" data-title="<?php echo esc_attr($data_title); ?>" data-url="<?php echo esc_url($data_link); ?>"></li>
    </ul>
</div>
*/
?>
<div class="dfd-single-share-fixed" data-directory="<?php echo get_template_directory_uri(); ?>">
	<ul class="rrssb-buttons">
		<li class="rrssb-facebook entry-share-link-facebook">
			<!--  Replace with your URL. For best results, make sure you page has the proper FB Open Graph tags in header:
				  https://developers.facebook.com/docs/opengraph/howtos/maximizing-distribution-media-content/ -->
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_attr($data_link) ?>" class="popup entry-share-link-facebook">
				<i class="soc_icon-facebook"></i>
			</a>
		</li>
		<li class="rrssb-twitter entry-share-link-twitter">
			<!-- Replace href with your Meta and URL information  -->
			<a href="https://twitter.com/intent/tweet?text=<?php echo esc_attr($data_link) ?>" class="popup entry-share-link-twitter">
				<i class="soc_icon-twitter-2"></i>
			</a>
		</li>
		<li class="rrssb-googleplus entry-share-link-googleplus">
			<!-- Replace href with your meta and URL information.  -->
			<a href="https://plus.google.com/share?url=<?php echo esc_attr($data_link) ?>" class="popup entry-share-link-googleplus">
				<i class="soc_icon-google"></i>
			</a>
		</li>
		<li class="rrssb-linkedin entry-share-link-linkedin">
			<!-- Replace href with your meta and URL information -->
			<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_attr($data_link) ?>" class="popup entry-share-link-linkedin">
				<i class="soc_icon-linkedin"></i>
			</a>
		</li>
	</ul>
</div>