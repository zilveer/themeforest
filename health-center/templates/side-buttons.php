<?php

/**
 * Displays the scroll to top button and the feedback widget area
 *
 * @package wpv
 * @subpackage health-center
 */

if(wpv_get_option('feedback-type') != 'none'): ?>
	<div id="feedback-wrapper">
		<?php if(wpv_get_option('feedback-type') == 'sidebar'): ?>
			<?php dynamic_sidebar('feedback-sidebar') ?>
			<a href="#" id="feedback" class="slideout icon" ><?php wpv_icon('pencil') ?></a>
		<?php else: ?>
			<a href="<?php wpvge('feedback-link')?>" id="feedback" class="icon"><?php wpv_icon('pencil') ?></a>
		<?php endif ?>
	</div>
<?php endif ?>

<?php if(wpv_get_option('show_scroll_to_top')): ?>
	<div id="scroll-to-top" class="icon"><?php wpv_icon('arrow-up3') ?></div>
<?php endif ?>
