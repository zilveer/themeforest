<?php

/*
 * checks if a given api key exists in mailchimp
 */
$bebelConfig = new bebelMailchimpBundleConfig();
$url = BebelUtils::replaceToken('%BCP_BUNDLE_PATH%/'.$bebelConfig->getBundleDir().'/admin/misc/checkApiKey.ajax.php', "BCP_BUNDLE_PATH");

?>
<script type="text/javascript">
			
	jQuery(function($){
        $(".check_<?php echo $key ?>").click(function() {
            $.ajax({
                type: "POST",
                url: "<?php echo $url ?>",
                data: "key="+$(".bSettings_<?php echo $key ?>").val()
            }).done(function( msg ) {
                $(".ajax_res_<?php echo $key ?>").css('display', 'block');
                if(msg == "valid") {
                    $(".ajax_res_<?php echo $key ?>").css('backgroundColor', 'darkgreen');
                }else {
                    $(".ajax_res_<?php echo $key ?>").css('backgroundColor', '#ff0000');
                }
                
            });
        });
        
    });
</script>

<div class="grid_4 push_1 alpha">
  <h4><?php echo $widget['title'] ?></h4>
</div>
<div class="grid_15 omega">
  <div class="widget">
    <input type="text" value="<?php echo $this->settings->get($key) ?>" class="bSettings_<?php echo $key ?>" name="bSettings[<?php echo $key ?>]" style="float:left;" />
    <input type="button" value="Check Key" class="check_<?php echo $key ?>"  style="float:left;" />
    <div class="ajax_res_<?php echo $key ?>" style="float:left; margin: 2px 10px; background: transparent; display: none; width: 15px; height: 15px;"></div><br class="clear" />
    <p class="help"><?php echo $widget['description']?></p>
  </div>
  
</div>
