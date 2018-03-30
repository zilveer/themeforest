<?php if ($view_params['description'] == 'true') {
		$content = str_replace(']]>', ']]&gt;', apply_filters('the_content', get_post_meta(get_the_ID() , '_desc', true)));
?>
		<div class="team-member-desc a_margin-top-20 a_margin-bottom-10 a_display-block"><?php echo $content; ?></div>
<?php } ?>