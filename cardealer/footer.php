<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<?php if (tmm_get_sidebar_position() != 'no_sidebar'):  ?>

	</main><!--/ .col-md-9 .col-sm-12 main #main -->

	<?php
		global $post;
		$is_single_car = false;
		if (is_single()) {
			if (get_post_type($post->ID) == TMM_Ext_PostType_Car::$slug) {
				$is_single_car = true;
				get_sidebar('single-car');
			}
		}

		if (!empty($_POST['template_user_cars']) && ($_POST['template_user_cars'] == true)) {
			get_sidebar('user-cars');
		} else {
			if (!empty($_POST['template_user_dealer']) && ($_POST['template_user_dealer'] == true)) {
				if (TMM::get_option('cars_show_statistic_dealer_page', TMM_APP_CARDEALER_PREFIX)) {
					get_sidebar('user-dealer');
				}
			}
			if (!$is_single_car) {
				get_sidebar();
			}
		}
	?>

<?php endif; ?>

	<?php if (tmm_get_sidebar_position() == 'no_sidebar'): ?>
		</main><!--/ .col-xs-12 #main -->
	<?php endif; ?>

		</div><!--/ .row-->
	</div><!--/ .container-->

<?php
if (is_single() || is_page() || is_page_template()) {
	tmm_layout_content($post->ID, 'full_width');
}
?>

</div><!--/ #content-->

<!-- - - - - - - - - - - - - end Content - - - - - - - - - - - - - - - -->


<!-- - - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - - - -->
<?php
$col_class = 'col-md-3';
$count = (int) TMM::get_option("footer_columns");

if (empty($count)) {
	$count = 4;
}

if ($count === 1) {
	$col_class = 'col-md-12';
} else if ($count === 2) {
	$col_class = 'col-md-6';
} else if ($count === 3) {
	$col_class = 'col-md-4';
} else if ($count === 4) {
	$col_class = 'col-md-3';
} else if ($count === 6) {
	$col_class = 'col-md-2';
}
?>

<footer id="footer">

    <div class="container">

		<div class="row">

			<?php if (!TMM::get_option("hide_footer")) { ?>

				<?php for ($i=1; $i<=$count; $i++) { ?>

				<div class="<?php echo $col_class ?>">
					<?php if (function_exists('dynamic_sidebar') AND dynamic_sidebar('footer_sidebar_'.$i)) ?>
				</div>

				<?php } ?>

			<?php } ?>

		</div><!--/ .row-->

		<div class="row">
			<div class="col-xs-12">
				<div class="adjective clearfix">
					<p class="copyright"><?php echo TMM::get_option("copyright_text") ?></p>
					<p class="developed"><?php _e('Developed by', 'cardealer'); ?>
						<a target="_blank" href="http://webtemplatemasters.com">ThemeMakers</a>
					</p>
				</div><!--/ .adjective-->
			</div>
		</div><!--/ .row-->

    </div><!--/ .container-->

</footer><!--/ #footer-->

<!-- - - - - - - - - - - - - - - end Footer - - - - - - - - - - - - - - - - -->

<?php if (TMM::get_option('boxed_layout')) { ?>
</div><!-- / .page-wrapper -->
<?php } ?>

	</div><!-- / .wrapper-inner -->
</div><!-- / .wrapper -->

<?php echo TMM_Ext_Authentication::draw_auth_panel() ?>

<?php wp_footer(); ?>
<input type="hidden" id="post_id" value="<?php the_ID() ?>">
</body>
</html>