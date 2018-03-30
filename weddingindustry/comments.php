<?php if ( have_comments() ) : ?>

	<h3 class="subtitle greydark"><?php comments_number(__('NO COMMENTS','weddingindustry'),__('ONE COMMENT','weddingindustry'),__( '% COMMENTS','weddingindustry') );?></h3>
	<div class="nicdark_space20"></div>
	<div class="nicdark_divider left small"><span class="nicdark_bg_grey2"></span></div>
	<div class="nicdark_space10"></div>

	<ul class="commentlist">
		<?php wp_list_comments(); ?>
	</ul>

	<!--start navigation comment-->
	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
	<!--end navigation comment-->


	<?php if ( comments_open() ) : ?>
		<?php comment_form(); ?>
	<?php endif; ?>
    

<?php else : ?>
	
	<?php if ( comments_open() ) : ?>
		<?php comment_form(); ?>
	<?php endif;

endif; ?>