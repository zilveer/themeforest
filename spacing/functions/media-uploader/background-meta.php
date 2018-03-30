<?php global $wpalchemy_media_access; ?>
<div class="my_meta_control"> 	
    
    <?php $mb->the_field('imgurl'); ?>
    <?php $wpalchemy_media_access->setGroupName('nn')->setInsertButtonLabel('Insert'); ?>
 
	<?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
    <?php echo $wpalchemy_media_access->getButton(); ?>
    
    <div class="fixed-holder clearfix" style="margin-top:10px;">
        <div class="meta-title-column">Fixed size?</div>
        <div class="meta-content-column" style="width:20px; margin-left:0;"> 
        	<?php $mb->the_field('fixed'); ?>
   			<span><input type="checkbox" name="<?php $metabox->the_name(); ?>" value="1"<?php if ($metabox->get_the_value()) echo ' checked="checked"'; ?>/></span>
        </div>
    </div>
 
 
</div>