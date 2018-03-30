<?php
global $wpalchemy_media_access;
wp_enqueue_media();
wp_enqueue_script('media-upload');
?>
<div class="mom_meta_control">
    <div class="mom_meta_group mom_ads_group">
    <?php
    while($mb->have_fields_and_multi('ads')): ?>
    <?php $mb->the_group_open(); ?>
    <div class="mmg-item mom-ad-gi" data-id="<?php $mb->the_index(); ?>">
    <div class="mmmg-head">
	<span class="mgh-handle"><i class="enotype-icon-menu"></i></span>
	<span class="ad-type-img"></span>
	<span class="ad-title">
	       <?php $mb->the_field('ad_title'); ?>
                <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" placeholder="Insert Ad title here">
	</span>
	<span class="ad-controler">
	    <a href="#" class="edit-ad"><i class="momizat-icon-plus"></i></a>
	    <a href="#" class="dodelete delete-ad momizat-icon-close"></a>
	</span>
    </div>
    <div class="mmg-content">
   <div class="mom_tiny_form_element">
   <?php $mb->the_field('ad_type'); ?>
        <div class="mom_tiny_desc">
            <div class="mom_td_bubble">
                <label for="<?php $mb->the_name(); ?>"><?php _e('Type', 'theme'); ?></label>
                <span><?php _e('ad type can be image with url or code', 'theme'); ?></span>
            </div> <!--bubble-->
        </div> <!--desc-->
        <div class="mom_tiny_input">
			<select name="<?php $mb->the_name(); ?>" data-id="[<?php $mb->the_index(); ?>]" class="mom-ad-type">
			<option value=""<?php $mb->the_select_state(''); ?>><?php _e('Image', 'theme'); ?></option>
			<option value="code"<?php $mb->the_select_state('code'); ?>><?php _e('Code', 'theme'); ?></option>
		</select>
            <div class="mti_options_wrap mti_ad_image">
                <div class="mti_option">
                   <?php $mb->the_field('ad_image'); ?>
                    <span><?php _e('Ad image','framework'); ?> </span>
                        <?php $wpalchemy_media_access->setGroupName('nn')->setInsertButtonLabel('Insert'); ?>
            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value(), 'type' => 'hidden', 'class' => 'mom_mb_image_imgID')); ?>
            <?php echo $wpalchemy_media_access->getButton(array('label'=> 'Upload')); ?>
         <div class="mom_preview_meta_img mti_img_preview"><img src="" alt=""><a href="#" class="mti_remove_img"><i class="dashicons dashicons-no"></i></a></div>
        <?php $mb->the_field('ad_image_full'); ?>
        <input type="hidden" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="mom_full_meta_input">
        <?php $mb->the_field('ad_image_preview'); ?>
	<input type="hidden" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="mom_preview_meta_input">
                    </div>
                <div class="mti_option">
                   <?php $mb->the_field('ad_url'); ?>
                    <span><?php _e('Ad URL','framework'); ?> </span>
                    <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="">
                </div>

                <div class="mti_option">
                   <?php $mb->the_field('ad_url_target'); ?>
                    <span><?php _e('URL Target','framework'); ?> </span>
            		<select name="<?php $mb->the_name(); ?>">
			<option value=""<?php $mb->the_select_state(''); ?>><?php _e('Open in same window', 'theme'); ?></option>
			<option value="_blank"<?php $mb->the_select_state('_blank'); ?>><?php _e('Open in new window', 'theme'); ?></option>
                        </select>
                </div>
            </div> <!--mti_options-->


            <div class="mti_options_wrap mti_ad_code hide">
                <div class="mti_option">
                   <?php $mb->the_field('ad_code'); ?>
                    <span><?php _e('Ad Code','framework'); ?> </span>
                    <textarea type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" placeholder="<?php _e('insert Ad code from any advertising Service e.g. google AdSense', 'theme'); ?>"><?php $mb->the_value(); ?></textarea>
                </div>
            </div> <!--mti_options-->
        </div> <!--input-->
        <div class="clear"></div>
    </div> <!--mom_meta_item-->
    
    <div class="mom_tiny_form_element">
        <?php $mb->the_field('ad_expire_date'); ?>
        <div class="mom_tiny_desc">
            <div class="mom_td_bubble">
                <label for="<?php $mb->the_name(); ?>"><?php _e('Expiration Date', 'theme'); ?></label>
                <span><?php _e('define when ad disappear from frontend', 'theme'); ?></span>
            </div> <!--bubble-->
        </div> <!--desc-->
        <div class="mom_tiny_input">
                    <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" placeholder="Expiration Date" class="medium mom-metabox-date">
        </div> <!--input-->
        <div class="clear"></div>
    </div> <!--mom_meta_item-->	
    </div>
</div> <!--mom meta group item-->
    <?php $mb->the_group_close(); ?>
    <?php endwhile; ?>
    <a href="#" class="docopy-ads add-new-group-item button button-primary"><?php _e('Add new', 'theme') ?></a>
    </div>   <!--mom_meta_group-->
</div> <!--mom meta wrap-->
