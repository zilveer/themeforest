<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $description_position;

$share_style = DfdMetaBoxSettings::compared('folio_single_share_style', false);
if($share_style) $share_style = 'dfd-share-'.$share_style;

$show_read_more_share = DfdMetaBoxSettings::compared('folio_single_show_read_more_share', false);

if($show_read_more_share == 'on') :
?>
<div class="dfd-meta-container">
	<div class="dfd-commentss-tags">
		<div class="post-comments-wrap">
			<?php get_template_part('templates/entry-meta/mini', 'comments-number'); ?>
			<span class="box-name"><?php _e('Comments','dfd') ?></span>
		</div>
		<div class="dfd-single-tags clearfix">
			<?php get_template_part('templates/entry-meta/mini', 'folio-tags'); ?>
		</div>
	</div>
	<div class="dfd-like-share">
		<div class="post-like-wrap left">
			<?php get_template_part('templates/entry-meta/mini', 'like'); ?>
		</div>
		<div class="add-info-wrap left">
			<?php
			if(strcmp($description_position, 'top') === 0 || strcmp($description_position, 'bottom') === 0) {
				get_template_part('templates/entry-meta/mini', 'add-info');
			}
			?>
		</div>
		<div class="dfd-share-cover <?php echo esc_attr($share_style);  ?>">
			<?php get_template_part('templates/entry-meta/mini','share-blog') ?>
		</div>
	</div>
</div>
<?php endif;