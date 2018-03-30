<?php
/**
 * Next/Previous Single Post Links
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */
 
 global $sd_data;
 ?>
 <?php if ( get_next_posts_link() || get_previous_posts_link() ) : ?>
<footer>
	<div class="sd-prev-next-post clearfix">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-6">
				<span class="sd-prev-post">
					<span><?php next_post_link( '%link', '<i class="fa fa-arrow-left"></i>' . $sd_data['sd_blog_single_prev'] ); ?></span>
					<?php next_post_link( '%link' ); ?>
				</span>
			</div>
			<!-- col-md-6 -->
			<div class="col-md-6 col-sm-6 col-xs-6">
				<span class="sd-next-post">
					<span><?php previous_post_link( '%link',  $sd_data['sd_blog_single_next'] . '<i class="fa fa-arrow-right"></i>' ); ?></span>
					<?php previous_post_link( '%link' ); ?>
				</span>
			</div>
			<!-- col-md-6 -->
		</div>
		<!-- row -->
	</div>
	<!-- sd-prev-next-post -->
</footer>
<?php endif; ?>