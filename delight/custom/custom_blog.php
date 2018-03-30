<div class="my_meta_control">
 
    <div class="block_separator">
        <label>Use this page as a blog page</label>
		<?php $mb->the_field('blogpage'); ?>
        <select name="<?php $mb->the_name(); ?>">
            <option value="no"<?php $mb->the_select_state('no'); ?>>No, use it as a simple static page</option>
            <option value="yes"<?php $mb->the_select_state('yes'); ?>>Yes, use it to display the posts from the categories here below</option>
        </select>
    </div>


    <div class="block_separator" id="custom_blog_block">
        <label>Select your categories</label>
		<?php $mb->the_field('categories'); ?>
        <?php $the_value = explode(',',$metabox->get_the_value()); ?>
        <input type="hidden" id="<?php $mb->the_id(); ?>"  name="<?php $mb->the_name(); ?>" value="<?php $metabox->the_value(); ?>">
        <select multiple size="10" style="height:auto!important; width: 300px;">
        	<?php echo $metabox->the_value(); ?>
            <option value="0"<?php if ((is_array($the_value) && in_array('0',$the_value)) || $metabox->get_the_value()=='0') { echo ' selected="selected"'; } ?>>All the categories</option>
            <?php 
            $categories =  get_categories(); 
            foreach ($categories as $category) { ?>
                <option value="<?php echo $category->term_id; ?>"<?php if ((is_array($the_value) && in_array($category->term_id,$the_value)) || $metabox->get_the_value()==$category->term_id) { echo ' selected="selected"'; } ?>><?php echo $category->cat_name; ?></option>
            <?php } ?>
        </select>



	</div><!-- .block_separator -->


    <div class="block_separator" id="custom_blog_block">
        <label>How many posts per page</label>
		<?php $mb->the_field('ppp'); ?>
        <input type="text" id="<?php $mb->the_id(); ?>"  name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>">
	</div><!-- .block_separator -->


    <div class="block_separator" id="custom_blog_block">
        <label>What do you want to display</label>
		<?php $mb->the_field('content_excerpt'); ?>
        <select style="height:auto!important; width: 300px;" name="<?php $mb->the_name(); ?>">
            <option value="excerpt"<?php $mb->the_select_state('excerpt'); ?>>The excerpt</option>
            <option value="content"<?php $mb->the_select_state('content'); ?>>The content</option>
        </select>
	</div><!-- .block_separator -->

    <div class="block_separator">
    <?php $mb->the_field('hide_images'); ?>
        <label for="<?php $mb->the_name(); ?>">Hide the featured images</label>
        <input type="checkbox" name="<?php $metabox->the_name(); ?>" value="true"<?php if ($metabox->get_the_value()) echo ' checked="checked"'; ?>/>
    </div><!-- .block_separator -->

        
</div>