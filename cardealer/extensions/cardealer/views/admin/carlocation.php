 <?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php wp_enqueue_script('thememakers_theme_carlocation_js', TMM_THEME_URI . '/admin/theme_options/js/carlocation.js'); ?>
<?php wp_enqueue_style('thememakers_theme_carlocation_css', TMM_THEME_URI . '/admin/theme_options/css/carlocation.css'); ?>
<?php
//Our class extends the WP_List_Table class, so we need to make sure that it's there
//$myListTable = new Carlocation_List_Table();
?>
<div class="wrap nosubsub">
	<h2><?php _e('Locations', 'cardealer'); ?></h2>

</div>
<div id="col-container">
	<div id="col-right">
		<div class="wrap">
			<?php Carlocation_List_Table::build_table(); ?>
		</div>
	</div>
    <div id="col-left">
		<?php if (current_user_can('edit_posts')) {
			?>
			<div id="cd-l" class="col-wrap">
					<div class="form-wrap">

						<h3><?php _e('Add New Location', 'cardealer'); ?></h3>
						<form id="addtag" method="post" action="">            

							<div class="form-field clearfix">
								<div class="row">
									<div class="col-half">

										<input id="add_new_country" class="button" type="submit" value="<?php _e('Add New Country', 'cardealer'); ?>" name="submit">

									</div>
									<div class="col-half">

										<div id="tax_carlocation_container1"></div>

									</div>
								</div>
								<div class="row">
									<div class="col-half">

										<input id="add_new_state" class="button" type="submit" value="<?php _e('Add State Location to', 'cardealer'); ?>" name="submit">

									</div>
									<div class="col-half">

										<div id="tax_carlocation_container2"></div>

									</div>
								</div>
								<div class="row">
									<div class="col-half">

										<input id="add_new_city" class="button" type="submit" value="<?php _e('Add City Location to', 'cardealer'); ?>" name="submit">

									</div>
									<div class="col-half">

										<div id="tax_carlocation_container3"></div>

									</div>
								</div>

							</div>   

							<div class="addtag_fields" style="display:none;">

									<div class="form-field form-required">
										<label for="tag-name"><?php _ex('Name', 'Taxonomy Name', 'cardealer'); ?></label>
										<input name="tag-name" id="tag-name" type="text" value="" size="40" aria-required="true" />
										<p><?php _e('The name is how it appears on your site.', 'cardealer'); ?></p>
									</div>

									<div class="form-field">
										<label for="tag-slug"><?php _ex('Slug', 'Taxonomy Slug', 'cardealer'); ?></label>
										<input name="slug" id="tag-slug" type="text" value="" size="40" />
										<p><?php _e('The &#8220;slug&#8221; is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.', 'cardealer'); ?></p>
									</div>

									<input id="add_new_cars_location" class="button button-primary" type="submit" value="<?php _e('Add New Location', 'cardealer'); ?>" name="submit">
									<br>
									<br>
								<hr/>
							</div>

							<div class="delete_location_wrap">
								<h3><?php _e('Delete Cars Location', 'cardealer'); ?></h3>
								<?php
								//get locations selects name
								$locations_captions = TMM::get_option('locations_captions_on_search_widget', TMM_APP_CARDEALER_PREFIX);
								$locations_captions = explode(',', $locations_captions);
								?>

								<div class="form-field clearfix">

									<span><strong><?php echo $locations_captions[0] ? $locations_captions[0] : ''; ?></strong></span>
									<div id="del_carlocation1">
										<?php
										TMM_Ext_Car_Dealer::draw_locations_select(array(
											'required' => 0,
											'selected' => 0,
											'id' => 'del_carlocation_select1',
											'name' => 'del_carlocation[]',
											'parent_id' => 0
										));
										?>
									</div>

									<br>
									<span><strong><?php echo isset($locations_captions[1]) ? $locations_captions[1] : ''; ?></strong></span>
									<div id="del_carlocation2">
										<label class="sel"><select id="del_carlocation_select2" name="del_carlocation[]"><option value=""><?php _e('None', 'cardealer'); ?></option></select></label>
									</div>

									<br>
									<span><strong><?php echo isset($locations_captions[2]) ? $locations_captions[2] : ''; ?></strong></span>
									<div id="del_carlocation3">
										<label class="sel"><select id="del_carlocation_select3" name="del_carlocation[]"><option value=""><?php _e('None', 'cardealer'); ?></option></select></label>
									</div>

									<br><a id="delete_location_button" class="button button-primary button-large" href="javascript:void(0);"><?php _e('Delete selected', 'cardealer'); ?></a>

								</div>

							</div>

						</form>
					</div>
			</div>
			<?php }
		?>
    </div>
</div>

<div style="display: none;">
    <table id="inline_edit_table">        
        <tr id="inline_edit" class="inline-edit-row inline-editor" style="">
        <td class="colspanchange" colspan="5">
            <fieldset>
                <div class="inline-edit-col">
                    <h4><?php _e('Edit', 'cardealer'); ?></h4>
                    <label>
                        <span class="title"><?php _e('Name', 'cardealer'); ?></span>
                        <span class="input-text-wrap">
                            <input class="ptitle" type="text" value="" name="name">
                        </span>
                    </label>
                    <label>
                        <span class="title"><?php _e('Slug', 'cardealer'); ?></span>
                        <span class="input-text-wrap">
                            <input class="ptitle" type="text" value="" name="slug">
                        </span>
                    </label>
                </div>
            </fieldset>
            <p class="inline-edit-save submit">
                <a class="cancel button-secondary alignleft tag_edit_cancel" href="#inline-edit" accesskey="c"><?php _e('Cancel', 'cardealer'); ?></a>
                <a class="save button-primary alignright tag_edit_update" href="#inline-edit" accesskey="s"><?php _e('Update Location', 'cardealer'); ?></a>
            </p>
        </td>
        </tr>        
    </table>
</div>