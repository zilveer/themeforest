<div id="vc-templatera-editor" class="panel" style="display: none;">
    <div class="panel-heading">
        <a href="#" class="vc-close" data-dismiss="panel" aria-hidden="true"><i class="icon"></i></a>
        <a href="#" class="vc-transparent" data-transparent="panel" aria-hidden="true"><i class="icon"></i></a>

        <h3 class="panel-title"><?php _e('Templates', 'js_composer') ?></h3>
    </div>
    <div class="panel-body wpb-edit-form vc-templates-body">
        <div class="row vc-row wpb_edit_form_elements">
            <div class="col-md-12 vc-column">
                <div class="wpb_element_label"><?php _e('Save current layout as a template', 'js_composer') ?></div>
                <div class="edit_form_line">
                    <input name="padding" class="wpb-textinput vc_title_name" type="text" value="" id="vc-templatera-name" placeholder="<?php _e('Template name', 'js_composer') ?>"> <button id="vc-template-save" class="btn btn-primary"><?php _e('Save template', 'js_composer') ?></button>
                </div>
                <span class="description"><?php _e('Save your layout and reuse it on different sections of your website', 'js_composer') ?></span>
            </div>
            <div class="col-md-12 vc-column">
                <div class="wpb_element_label"><?php _e('Load Template', 'js_composer') ?></div>
                <span class="description"><?php _e('Append previosly saved template to the current layout', 'js_composer') ?></span>
                <ul class="wpb_templates_list" id="vc-templatera-list">
                    <?php echo $this->getList() ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <button type="button" class="btn btn-default vc-close" data-dismiss="panel"><?php _e('Close', 'js_composer') ?></button>
    </div>
</div>