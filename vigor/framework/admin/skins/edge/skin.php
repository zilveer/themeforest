<?php

function edgt_theme_display() {
	global $edgtFramework;
	$tab    = edgt_get_admin_tab();
	$active_page = $edgtFramework->edgtOptions->getAdminPageFromSlug($tab);
	if ($active_page == null) return;
	?>
	<div class="edgtf-options-page edgtf-page">

		<div class="edgtf-page-header page-header clearfix">

			<div class="edgtf-theme-name pull-left" >
				<img src="<?php echo esc_url(edgt_get_skin_uri() . '/assets/img/logo.png'); ?>" alt="edgt_logo" class="edgtf-header-logo pull-left"/>
				<?php $current_theme = wp_get_theme(); ?>
				<h1 class="pull-left">
					<?php echo esc_html($current_theme->get('Name')); ?>
					<small><?php echo esc_html($current_theme->get('Version')); ?></small>
				</h1>
			</div>
			<div class="edgtf-top-section-holder">
				<div class="edgtf-top-section-holder-inner">
					<div class="form-top-section">
						<div class="form-top-section-holder" id="anchornav">
							<div class="form-top-section-inner clearfix">
								<?php
								foreach ($edgtFramework->edgtOptions->adminPages as $key=>$page ) {
									if ($page->slug == $tab) { ?>
										<div class="edgtf-anchor-holder">
											<?php if(is_array($page->layout) && count($page->layout)) { ?>
												<span>Scroll To:</span>
												<select class="nav-select edgtf-selectpicker" data-width="315px" data-hide-disabled="true" data-live-search="true" id="edgtf-select-anchor">
													<option value="" disabled selected></option>
													<?php foreach ($page->layout as $panel) { ?>
														<option data-anchor="#edgtf_<?php echo esc_attr($panel->name); ?>"><?php echo esc_attr($panel->title); ?></option>
													<?php } ?>
												</select>

											<?php } ?>
										</div>
									<?php }
								}?>
							</div>
						</div>
					</div>
					<div class="edgtf-top-buttons-holder">
						<input type="button" id="edgt_top_save_button" class="btn btn-info btn-sm" value="<?php _e('Save Changes', 'edgt'); ?>"/>
					</div>

					<div class="edgtf-input-change"><i class="fa fa-exclamation-circle"></i>You should save your changes</div>
					<div class="edgtf-changes-saved"><i class="fa fa-check-circle"></i>All your changes are successfully saved</div>
				</div>
			</div>

		</div> <!-- close div.edgtf-page-header -->

		<div class="edgtf-page-content-wrapper">
			<div class="edgtf-page-content">
				<div class="edgtf-page-navigation edgtf-tabs-wrapper vertical left clearfix">

					<div class="edgtf-tabs-navigation-wrapper">

						<ul class="nav nav-tabs clearfix">
							<?php
							foreach ($edgtFramework->edgtOptions->adminPages as $key=>$page ) {
								$slug = "";
								if (!empty($page->slug)) $slug = "_tab".$page->slug;
								?>
								<li<?php if ($page->slug == $tab) echo " class=\"active\""; ?>>
									<a href="<?php echo esc_url(get_admin_url().'admin.php?page=edgt_theme_menu'.$slug); ?>">
										<?php if($page->icon !== '') { ?>
											<i class="<?php echo esc_attr($page->icon); ?> edgtf-tooltip edgtf-inline-tooltip left" data-placement="top" data-toggle="tooltip" title="<?php echo esc_attr($page->title); ?>"></i>
										<?php } ?>
										<span><?php echo esc_html($page->title); ?></span>
									</a>
								</li>
							<?php
							}
							?>
							<li><a href="<?php echo esc_url(get_admin_url().'admin.php?page=edgt_theme_menu_tabimport'); ?>"><i class="fa fa-download edgtf-tooltip edgtf-inline-tooltip left" data-placement="top" data-toggle="tooltip" title="Import"></i><span>Import</span></a></li>
						</ul>
					</div> <!-- close div.edgtf-tabs-navigation-wrapper -->

					<div class="edgtf-tabs-content">
						<div class="tab-content">
							<?php
							foreach ($edgtFramework->edgtOptions->adminPages as $key=>$page ) {
								if ($page->slug == $tab) {
									?>
									<div class="tab-pane fade<?php if ($page->slug == $tab) echo " in active"; ?>" id="<?php echo esc_attr($key); ?>">
										<div class="edgtf-tab-content">
											<h2 class="edgtf-page-title"><?php echo esc_attr($page->title); ?></h2>


											<form method="post" class="edgt_ajax_form">
												<div class="edgtf-page-form">

													<?php $page->render(); ?>
												</div>
											</form>

										</div><!-- close edgtf-tab-content -->
									</div>
								<?php
								}
							}
							?>
						</div>
					</div> <!-- close div.edgtf-tabs-content -->

				</div> <!-- close div.edgtf-page-navigation -->

			</div> <!-- close div.edgtf-page-content -->

		</div> <!-- close div.edgtf-page-content-wrapper -->
		<a id='back_to_top' href='#'>
            <span class="fa-stack">
                <span class="arrow_carrot-up"></span>
            </span>
		</a>
	</div> <!-- close div.edgt-options-page -->
<?php }