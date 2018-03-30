<?php if(qode_startit_options()->getOptionValue('blog_single_navigation') == 'yes'){ ?>
	<?php $navigation_blog_through_category = qode_startit_options()->getOptionValue('blog_navigation_through_same_category') ?>
	<div class="qodef-blog-single-navigation">
		<div class="qodef-blog-single-navigation-inner">
			<?php if(get_previous_post() != ""){ ?>
				<div class="qodef-blog-single-prev">
					<?php
					if($navigation_blog_through_category == 'yes'){
						previous_post_link('%link','<', true,'','category');
					} else {
						previous_post_link('%link','<');
					}
					?>
				</div> <!-- close div.blog_prev -->
			<?php } ?>
			<?php if(get_next_post() != ""){ ?>
				<div class="qodef-blog-single-next">
					<?php
					if($navigation_blog_through_category == 'yes'){
						next_post_link('%link','>', true,'','category');
					} else {
						next_post_link('%link','>');
					}
					?>
				</div>
			<?php } ?>
		</div>
	</div>
<?php } ?>