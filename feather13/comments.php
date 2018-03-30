<?php if((comments_open() && wpb_comments_enabled()) || have_comments()): ?>
<div id="comments">
	<div class="pad">

		<?php if(comments_open() && wpb_comments_enabled() && ('top'==wpb_option('comments-form-location'))): ?>
			<div id="response">
				<?php comment_form(); ?>
			</div>
		<?php endif; ?>

		<?php if (have_comments()): ?>
		
			<h4 class="heading"><span><?php printf( _n('%1$s Comment','%1$s Comments',get_comments_number(),'feather'), number_format_i18n(get_comments_number()) ); ?></span></h4>

			<ol class="commentlist fix">
				<?php wp_list_comments('avatar_size=60'); ?>
			</ol><!--/commentlist-->

			<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
			<nav id="comment-nav">
				<div class="nav-previous"><?php previous_comments_link(); ?></div>
				<div class="nav-next"><?php next_comments_link(); ?></div>
				<div class="clear"></div>
			</nav><!--/comment-nav-->
			<?php endif; ?>
			
		<?php endif; ?>

		<?php if(comments_open() && wpb_comments_enabled() && ('bottom'==wpb_option('comments-form-location'))): ?>
			<div id="response">
				<?php comment_form(); ?>
			</div>
		<?php endif; ?>

	</div><!--/pad-->
</div><!--/comments-->
<?php endif; ?>
