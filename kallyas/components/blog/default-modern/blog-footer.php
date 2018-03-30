<?php if(! defined('ABSPATH')){ return; }
/*
 * Get post footer
 * @since v4.0.12
 */

// Fill with conditions if needed
if ( has_tag() ) { ?>

	<div class="kl-blog-item-bottom clearfix">

	    <?php if ( has_tag() ) { ?>
	        <div class="kl-blog-item-tags">
	            <?php echo WpkZn::getPostTags(get_the_ID()); ?>
	            <div class="clearfix"></div>
	        </div><!-- end tags blocks -->
	    <?php } ?>

	</div>

<?php } ?>
