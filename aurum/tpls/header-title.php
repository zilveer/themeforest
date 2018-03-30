<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

if(is_search())
	return;

$main_title         = get_field('main_title');
$small_description  = get_field('small_description');
$has_breadcrumb     = get_field('show_breadcrumb') && (function_exists('bcn_display')) && ! is_front_page();


if(get_field('show_page_title') && ( ($main_title || $small_description) || $has_breadcrumb )):

?>
<div class="container page-title-container">
	<div class="row">
		<div class="col-sm-<?php echo $has_breadcrumb ? 6 : 12; ?>">
			<div class="page-title">
				<h1>
					<?php echo $main_title; ?>

					<?php if($small_description): ?>
					<small><?php echo $small_description; ?></small>
					<?php endif; ?>
				</h1>
			</div>
		</div>
		<?php if($has_breadcrumb): ?>
		<div class="col-sm-6<?php echo $small_description ? ' bc-more-padding' : ''; ?>">
			<?php
				if(function_exists('bcn_display'))
				{
					echo '<div class="breadcrumb pull-right-md">';
				    bcn_display();
					echo '</div>';
				}
			?>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php
endif;