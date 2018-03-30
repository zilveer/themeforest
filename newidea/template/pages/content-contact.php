<?php
/**
 * Contact Content
 *
 * @subpackage newidea
 * @since newidea 4.0
 */
global $page_id, $object_id, $default_background;

$post = get_page($object_id);

$bg = $default_background;
if( newidea_get_post_meta_key('default-image', $post->ID) != ""){
	$bg = newidea_get_post_meta_key('default-image', $post->ID);
}
?>
<!--Contact-->
<section id="<?php echo $page_id;?>" <?php post_class('contBg'); ?> data-bg="<?php echo $bg;?>"  >
	<span></span>
    <div class="contact-container">
		<div class="contactDet">
			<div class="contCol1">
    			<h3 class="title"><?php echo $post->post_title; ?></h3>
                <?php 
					$content = $post->post_content;
					$content = apply_filters( 'the_content', $content );
				?>
				<div><?php echo $content; ?></div>
    		</div>
	    	<div class="contCol2">
	    		<h3 class="title"><?php _e('Message','newidea') ?></h3>
	    		<form id="contact-form" action="<?php echo get_template_directory_uri().'/post-contact.php'; ?>" >
                <input id="emailTo" type="hidden" value="<?php echo newidea_get_options_key('contact-recipient'); ?>" />
                 <div class="contForm" >
                      <div class="fieldRow">
                        <label><?php _e('Name','newidea');?> <span class="warning">*</span></label>
                        <input id="contact-name" name="contactName" required class="inputText" value="" type="text">
                      </div>
                      <div class="fieldRow">
                        <label><?php _e('Email','newidea')?> <span class="warning">*</span></label>
                        <input id="contact-email" name="email" required class="inputText" value="" type="text">
                      </div>
                      <div class="fieldRow">
                        <label><?php _e('Messages','newidea');?> <span class="warning">*</span></label>
                        <textarea id="contact-message" name="message" required ></textarea>
                      </div>
                      <div class="fieldRow">
                        <input id="submit" type="button"  value="Send" class="button" />
                        <p class="error"></p>
                        <p class="success"></p>
                      </div>
		     	</div>
			</form>
	    </div>
    <div class="contCol3">
    	<h3 class="title"><?php _e('Location','newidea'); ?></h3>
        <div id="map"><img src="<?php echo newidea_get_post_meta_key('contact-map-image'); ?>" alt="" width="260" height="140"></div>
        <ul class="contact-information">
        <?php if(newidea_get_post_meta_key('contact-address') != "") :?>
        <li class="marker-icon"><div><h6><?php echo __('Address:','newidea'); ?></h6><?php echo newidea_get_post_meta_key('contact-address'); ?></div></li>
        <?php endif; 
        if(newidea_get_post_meta_key('contact-email') != "") :
        ?>
        <li class="mail-icon"><div><h6><?php echo __('Email:','newidea'); ?></h6><?php echo newidea_get_post_meta_key('contact-email'); ?></div></li>
        <?php endif;
        if(newidea_get_post_meta_key('contact-phone') != "") :
        ?>
        <li class="phone-icon"><div><h6><?php echo __('Phone:','newidea'); ?></h6><?php echo newidea_get_post_meta_key('contact-phone'); ?></div></li>
        <?php endif; ?>
        </ul>
    </div>
    </div>
	</div>
</section>