<?php
/**
 * Footer widget areas.
 *
 * @package WordPress
 * @subpackage grace
 * 
 */

// count the active widgets to determine column sizes
$footerwidgets = is_active_sidebar('footer1') + is_active_sidebar('footer2') + is_active_sidebar('footer3') + is_active_sidebar('footer4');
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

<?php if (is_active_sidebar('footer1')) : ?>
<div class="<?php echo $footergrid;?>">
	<ul>
	<?php dynamic_sidebar('footer1'); ?>
	</ul>
</div>
<?php endif;?>

<?php if (is_active_sidebar('footer2')) : $last = ($footerwidgets == '2' ? ' last' : false);?>
<div class="<?php echo $footergrid.$last;?>">
	<ul>
	<?php dynamic_sidebar('footer2'); ?>
	</ul>
</div>
<?php endif;?>

<?php if (is_active_sidebar('footer3')) : $last = ($footerwidgets == '3' ? ' last' : false);?>
<div class="<?php echo $footergrid.$last;?>">
	<ul>
	<?php dynamic_sidebar('footer3'); ?>
	</ul>
</div>
<?php endif;?>

<?php if (is_active_sidebar('footer4')) : $last = ($footerwidgets == '4' ? ' last' : false);?>
<div class="<?php echo $footergrid.$last;?>">
	<ul>
	<?php dynamic_sidebar('footer4'); ?>
	</ul>
</div>
<?php endif;?>
<div class="clear"></div>

<?php endif;?>