<?php if(libero_mikado_options()->getOptionValue('blog_single_navigation') == 'yes'){ ?>
	<?php $navigation_blog_through_category = libero_mikado_options()->getOptionValue('blog_navigation_through_same_category') ?>
	<div class="mkd-blog-single-navigation">
		<div class="mkd-blog-single-navigation-inner">
			<?php if(get_previous_post() != ""){ ?>
				<div class="mkd-blog-single-prev">
					<?php
					if($navigation_blog_through_category == 'yes'){
						previous_post_link('%link','<span class="fa fa-angle-left">', true,'','category');
					} else {
						previous_post_link('%link','<span class="fa fa-angle-left">');
					}
					?>
				</div> <!-- close div.blog_prev -->
			<?php } ?>
			<?php if(get_next_post() != ""){ ?>
				<div class="mkd-blog-single-next">
					<?php
					if($navigation_blog_through_category == 'yes'){
						next_post_link('%link','<span class="fa fa-angle-right">', true,'','category');
					} else {
						next_post_link('%link','<span class="fa fa-angle-right">');
					}
					?>
				</div>
			<?php } ?>
		</div>
	</div>
<?php } ?>