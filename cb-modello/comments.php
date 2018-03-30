<!-- modello comments template -->

<div id="comments">

<?php if(have_comments()) : ?>

			<?php printf(_n('One Response to %2$s','%1$s Responses to %2$s',get_comments_number(),'cb-modello' ),
			number_format_i18n(get_comments_number()),'<em>'.get_the_title().'</em>');

			if(get_comment_pages_count()>1&&get_option('page_comments')) : ?>

			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments','cb-modello')); ?></div>
				<div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;','cb-modello')); ?></div>
			</div>
<?php endif;?>	<div class="commentlist"><?php wp_list_comments(array('style' => 'div')); ?></div>

<?php if(get_comment_pages_count()>1&&get_option('page_comments')) :  ?>

			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments', 'cb-modello')); ?></div>
				<div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'cb-modello')); ?></div>
			</div>
<?php endif; endif; 

comment_form(); ?>
<?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>
</div>
