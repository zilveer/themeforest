<?php
/**
 * The dynamically generated custom sidebars
 */
?>

<?php global $footer_sidebar_1, $footer_sidebar_2, $footer_sidebar_3, $footer_sidebar_4, $sidebar_footer1_exists, $sidebar_footer2_exists, $sidebar_footer3_exists, $sidebar_footer4_exists;

if (($footer_sidebar_1 == 'default_sidebar') || (!$sidebar_footer1_exists)) : $footer_s_name_1 = 'first-footer-widget-area'; else : $footer_s_name_1 = $footer_sidebar_1; endif;
if (($footer_sidebar_2 == 'default_sidebar') || (!$sidebar_footer2_exists)) : $footer_s_name_2 = 'second-footer-widget-area'; else : $footer_s_name_2 = $footer_sidebar_2; endif;
if (($footer_sidebar_3 == 'default_sidebar') || (!$sidebar_footer3_exists)) : $footer_s_name_3 = 'third-footer-widget-area'; else : $footer_s_name_3 = $footer_sidebar_3; endif;
if (($footer_sidebar_4 == 'default_sidebar') || (!$sidebar_footer4_exists)) : $footer_s_name_4 = 'fourth-footer-widget-area'; else : $footer_s_name_4 = $footer_sidebar_4; endif;

// count the active widgets to determine column sizes
$footerwidgets = is_active_sidebar($footer_s_name_1) + is_active_sidebar($footer_s_name_2) + is_active_sidebar($footer_s_name_3) + is_active_sidebar($footer_s_name_4);
// default
$footergrid = "one_fourth";
// if only one
if ($footerwidgets == "1") {
$footergrid = "full-width";
// if two, split in half
} elseif ($footerwidgets == "2") {
$footergrid = "one_half";
// if three, divide in thirds
} elseif ($footerwidgets == "3") {
$footergrid = "one_third";
// if four, split in fourths
} elseif ($footerwidgets == "4") {
$footergrid = "one_fourth";
}

?>

<?php if ($footerwidgets) : ?>

<?php if (is_active_sidebar($footer_s_name_1)) : ?>
<div class="<?php echo $footergrid;?>">
	<?php dynamic_sidebar($footer_s_name_1); ?>
</div>
<?php endif;?>

<?php if (is_active_sidebar($footer_s_name_2)) : $last = ($footerwidgets == '2' ? ' last' : false);?>
<div class="<?php echo $footergrid.$last;?>">
	  <?php dynamic_sidebar($footer_s_name_2); ?>
</div>
<?php endif;?>

<?php if (is_active_sidebar($footer_s_name_3)) : $last = ($footerwidgets == '3' ? ' last' : false);?>
<div class="<?php echo $footergrid.$last;?>">
	  <?php dynamic_sidebar($footer_s_name_3); ?>
</div>
<?php endif;?>

<?php if (is_active_sidebar($footer_s_name_4)) : $last = ($footerwidgets == '4' ? ' last' : false);?>
<div class="<?php echo $footergrid.$last;?>">
		  <?php dynamic_sidebar($footer_s_name_4); ?>
</div>
<?php endif;?>
<div class="clear"></div>

<?php endif;?>