<?php

global $post;

td_global::$current_template = 'woo';


get_header();

//set the template id, used to get the template specific settings
$template_id = 'woo';


$loop_sidebar_position = td_util::get_option('tds_' . $template_id . '_sidebar_pos'); //sidebar right is default (empty)



?>
	<div class="td-main-content-wrap td-main-page-wrap">
		<div class="td-container">
			<div class="td-container-border">
				<div class="td-pb-row">
				<?php
				switch ($loop_sidebar_position) {
					default:
						?>
						<div class="td-pb-span8 td-main-content td-pb-padding-side" role="main">
							<div class="td-ss-main-content">
								<?php
								woocommerce_breadcrumb();
								woocommerce_content();
								?>
							</div>
						</div>
						<div class="td-pb-span4 td-main-sidebar" role="complementary">
							<div class="td-ss-main-sidebar">
								<?php get_sidebar(); ?>
							</div>
						</div>
						<?php

						break;

					case 'sidebar_left':
						?>
						<div class="td-pb-span8 td-main-content td-pb-padding-side td-sidebar-left-content" role="main">
							<div class="td-ss-main-content">
								<?php
								woocommerce_breadcrumb();
								woocommerce_content();
								?>
							</div>
						</div>
						<div class="td-pb-span4 td-main-sidebar" role="complementary">
							<div class="td-ss-main-sidebar">
								<?php get_sidebar(); ?>
							</div>
						</div>
						<?php
						break;

					case 'no_sidebar':
						?>
						<div class="td-pb-span12 td-main-content td-pb-padding-side" role="main">
							<div class="td-ss-main-content">
								<?php
								woocommerce_breadcrumb();
								woocommerce_content();
								?>
							</div>

						</div>
						<?php
						break;

				}?>
			</div>
			</div>
		</div>
	</div> <!-- /.td-main-content-wrap -->

<?php
get_footer();
?>