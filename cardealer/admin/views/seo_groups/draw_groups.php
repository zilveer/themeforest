<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div id="seo_groups">
	<?php
	if (is_string($seo_groups) AND !empty($seo_groups)) {
		$seo_groups = unserialize($seo_groups);
	}
	?>
	<?php if (!empty($seo_groups) AND is_array($seo_groups)): ?>
		<?php foreach ($seo_groups as $group_id => $seo_group) : ?>
			<div id="<?php echo $group_id; ?>" class="tab-content" style="display: none">
				<input type="hidden" name="seo_group[<?php echo $group_id; ?>][name]" value="<?php echo $seo_group['name']; ?>" />
				<div class="clearfix ">
					<div class="admin-one-half">

						<h4><?php _e('Meta title', 'cardealer'); ?></h4>
						<input type="text" name="seo_group[<?php echo $group_id ?>][title]" value="<?php echo $seo_group['title']; ?>"><br />
						<br />
						<h4><?php _e('Meta keywords', 'cardealer'); ?></h4>
						<textarea name="seo_group[<?php echo $group_id ?>][keywords]"><?php echo $seo_group['keywords']; ?></textarea><br />
						<br />
						<h4><?php _e('Meta description', 'cardealer'); ?></h4>
						<textarea name="seo_group[<?php echo $group_id ?>][description]"><?php echo $seo_group['description']; ?></textarea><br />

					</div><!--/ .admin-one-half-->

					<div class="admin-one-half last">                        

						<div class="add-button add_seo_group_category" group-id="<?php echo $group_id ?>"></div>&nbsp;<strong><?php _e('Add Category', 'cardealer'); ?></strong>
						<?php
						if (!empty($seo_group['cat'])) {
							foreach ($seo_group['cat'] as $cat_key => $cat_value) {
								?>

								<div class="tmk_row">
									<br />
									
									<table>
										<tr>
											<td>
												<label class="sel">
													<?php echo $entity_seo_group::get_categories_select($cat_value, 'seo_group[' . $group_id . '][cat][' . $cat_key . ']', '', 'seo_categories_selects'); ?>
												</label>
											</td>
											<td style="vertical-align: top !important;">
												<?php if ($cat_key > 0): ?>
													<a class="remove-button remove_seo_group_category" href="#"></a>
												<?php endif; ?>
											</td>
										</tr>
									</table>
									
								</div>

								<?php
							}
						} else {
							echo $entity_seo_group::get_categories_select('', 'seo_group[' . $group_id . '][cat][0]');
						}
						?>


					</div><!--/ .admin-one-half-->

				</div>
				<br />
				<h2 style="color: red"><?php _e('Notice: One SEO group can be used only once per category. In other case it would be used for category as it was picked at first time for category.', 'cardealer'); ?></h2>

			</div>
		<?php endforeach; ?>
	<?php endif; ?>

</div>


<div style="display: none;">
    <ul id="seo_groups_ids"></ul>
</div>