<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/6/2015
 * Time: 4:28 PM
 */
?>
<div class="entry-meta-tag-wrap social-share-hover">
<?php  the_tags('<div class="entry-meta-tag tagcloud"><label>'.wp_kses_post(__('<i class="fa fa-tags"></i>','g5plus-academia')) .'</label>',', ','</div>');?>
<?php g5plus_share(); ?>
</div>
