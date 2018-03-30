<?php
/**
 * Evential Wordpress Theme functions and definitions
 *
 * @package Evential
 * @subpackage Evential
 * @since Evential 1.0
 */
?>

<div id="rms_contact" class="modal fade contact_form" style="z-index: 999999;background: rgba(0, 169, 157, 0.82);">
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 0;">
      <div class="modal-header" style="border-bottom: 0px solid #e5e5e5;">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		        <?php
                    global $tlazya_evential;
                    if (isset($tlazya_evential['contacts_title']) && $tlazya_evential['contacts_title'] != '') {
                        echo '<h2 class="uppercase" style="margin-bottom: 15px;padding-left: 9px;">'.esc_html($tlazya_evential['contacts_title']).'</h2>';
                    }
                    ?>
      </div>
      <div class="modal-body" style="padding: 25px; padding-top: 0px;">
        <?php
                    global $tlazya_evential;
                    if (isset($tlazya_evential['contacts_content']) && $tlazya_evential['contacts_content'] != '') {
                        echo '<p style="margin: 0 0 25px;">'.$tlazya_evential['contacts_content'].'</p>';
                    }
                    ?>
                        <?php
                            global $tlazya_evential;
                            if ((isset($tlazya_evential['contact_form_id']) && $tlazya_evential['contact_form_id'] != '') && (isset($tlazya_evential['contact_form_title']) && $tlazya_evential['contact_form_title'] != '')){
                                echo do_shortcode('[contact-form-7 id="'.esc_attr($tlazya_evential['contact_form_id']).'" title="'.esc_attr($tlazya_evential['contact_form_title']).'"]');
                            }
                        ?>					
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->