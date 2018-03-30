<?php
/**
* @package   Warp Theme Framework
* @author    bdthemes
* @copyright Copyright (C) BDThemes Ltd
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/


wp_enqueue_media();

?>

<script type="text/javascript">

jQuery(document).ready(function($){
  
  var _custom_media = true,
      _orig_send_attachment = wp.media.editor.send.attachment;

  jQuery('.mediaUploader .button').click(function(e) {
    var send_attachment_bkp = wp.media.editor.send.attachment;
    var button = jQuery(this);
    var id = button.attr('id').replace('_button', '');
    _custom_media = true;
    wp.media.editor.send.attachment = function(props, attachment){
      if (_custom_media) {
        jQuery("#"+id).val(attachment.url);
      } else {
        return _orig_send_attachment.apply( this, [props, attachment] );
      };
    }

    wp.media.editor.open(button);
    return false;
  });

  jQuery('.add_media').on('click', function(){
    _custom_media = false;
  });


});

</script>


<?php 
printf('<div class="uk-form-controls-condensed mediaUploader"><input %s />', $control->attributes(array_merge($node->attr(), array('type' => 'text', 'name' => $name, 'value' => $value, 'id' => md5($name), 'placeholder' => $node->attr('label'))), array('label', 'description', 'default')));
printf('<input class="button" name="logoUpload" id="'.md5($name).'_button" value="Upload" style="width: 65px; text-align: center; margin-left: 5px;" />');
if ($description = $node->attr('description')) {
    printf('<span class="uk-form-help-inline">%s</span>', $node->attr('description'));
}
printf('</div>');













