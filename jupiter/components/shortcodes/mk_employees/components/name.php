<?php if(!empty($view_params['link'])) { ?>
	<a class="team-member-name" href="<?php echo $view_params['link']; ?>">
<?php } ?>
	<span class="team-member-name a_font-16 a_display-block a_font-weight-bold a_text-transform-up a_color-333"><?php the_title(); ?></span>
<?php if(!empty($view_params['link'])) { ?>
	</a>
<?php } ?>