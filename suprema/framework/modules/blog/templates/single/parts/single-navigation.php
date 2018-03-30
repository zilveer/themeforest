<?php if(suprema_qodef_options()->getOptionValue('blog_single_navigation') == 'yes'){ ?>
	<?php $navigation_blog_through_category = suprema_qodef_options()->getOptionValue('blog_navigation_through_same_category') ?>
	<div class="qodef-blog-single-navigation">
		<div class="qodef-blog-single-navigation-inner clearfix">
			<?php if(get_previous_post() != ""){ ?>
				<div class="qodef-blog-single-prev">
					<?php
					if($navigation_blog_through_category == 'yes'){
						previous_post_link('%link','<span class="arrow_left"></span>', true,'','category');
					} else {
						previous_post_link('%link','<span class="arrow_left"></span>');
					}
					?>
				</div> <!-- close div.blog_prev -->
			<?php } ?>
			<?php if(get_next_post() != ""){ ?>
				<div class="qodef-blog-single-next">
					<?php
					if($navigation_blog_through_category == 'yes'){
						next_post_link('%link','<span class="arrow_right"></span>', true,'','category');
					} else {
						next_post_link('%link','<span class="arrow_right"></span>');
					}
					?>
				</div>
			<?php } ?>
		</div>
	</div>
<?php } ?>