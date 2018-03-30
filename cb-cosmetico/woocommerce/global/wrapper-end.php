<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
?>

<?php /* if(function_exists('wp_pagenavi')) { wp_pagenavi(); }
else if ($wp_query->max_num_pages > 1) : ?>
<div id="nav-below" class="navigation">
<div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&larr;</span> Older posts','cb-cosmetico')); ?></div>
<div class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&rarr;</span>','cb-cosmetico')); ?></div>
</div>
<?php endif; */ ?>

</div>
<!--/ page end-->





<?php
global $post;
require(get_template_directory().'/inc/cb-general-options.php');
require(get_template_directory().'/inc/cb-page-options.php');

require(get_template_directory().'/inc/cb-little-head.php');

if ($sidebar_shop=='right') { ?>
<div id="sidebar_r">
	<ul>
	<?php dynamic_sidebar('shop'); ?>
	</ul>
</div>
<!-- sidebar #end -->
	<?php } ?>

<div class="cl"></div>

</div>
<!-- wrapper #end -->
</div>
<!-- middle #end -->
