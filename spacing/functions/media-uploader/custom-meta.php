<?php global $wpalchemy_media_access; ?>
<div class="my_meta_control">  

	<div class="meta-title-column">Gallery Type</div>
    
    <div class="meta-content-column select-fields">

	<?php $mb->the_field('gallery_type'); ?>
		<span><input class="to-check" type="radio" name="<?php $mb->the_name(); ?>" value="lightbox"<?php if($mb->is_value('lightbox') || !$mb->is_value) { echo 'checked="checked"'; } ?>/> Lightbox</span>
        <span><input class="to-disable" type="radio" name="<?php $mb->the_name(); ?>" value="image_list"<?php echo $mb->is_value('image_list')?' checked="checked"':''; ?>/> Image List</span>
        <span><input class="to-disable" type="radio" name="<?php $mb->the_name(); ?>" value="none"<?php echo $mb->is_value('none')?' checked="checked"':''; ?>/> None</span>
    
    </div>
    <div style="clear:both;"></div>
 	
    <?php while($mb->have_fields_and_multi('docs')): ?>
    <?php $mb->the_group_open(); ?>
         
        <?php $mb->the_field('imgurl'); ?>
        <?php $wpalchemy_media_access->setGroupName('img-n'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
 		<div class="meta-title-column meta-image-url">Image URL</div>
        
        <div class="meta-content-column">
        <p class="image-upload-input">
            <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
            <?php echo $wpalchemy_media_access->getButton(); ?>
            <span class="button-or">or</span>
            <a href="#" class="dodelete button image-delete">Remove Image</a>
        </p>
 		</div>  
        
        <div style="clear:both;"></div>
 
    <?php $mb->the_group_close(); ?>
    <?php endwhile; ?>
 
    <p class="add-new-image"><a href="#" class="docopy-docs button">Add New Image</a></p>
 
</div>