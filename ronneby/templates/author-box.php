<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
 * Author Box
 *
 * Displays author box with author description and thumbnail on single posts
 *
 * @package WordPress
 * @subpackage Dynamic theme, for WordPress
 */
?>

<?php
$author_info = get_the_author_meta('dfd_author_info');
?>

<?php
$author_name = '';
global $authordata;
if ( is_object( $authordata ) ) {
	$author_name =  ($authordata->display_name) ? $authordata->display_name : $authordata->user_nicename;
}
?>

<div class="about-author">
	<figure class="author-photo">
		<?php echo get_avatar( get_the_author_meta('ID') , 80 ); ?>
	</figure>
	<div class="author-content">
		<div class="author-top-inner">
			<div class="box-name"><?php echo $author_name ?></div>
			<?php echo author_social_networks(); ?>
				<?php /*if (!empty($author_info)): ?>
					<h4 class="widget-sub-title"><?php echo $author_info; ?></h4>
				<?php endif;*/ ?>
		</div>
		<div class="author-description">
			<p><?php the_author_meta('description'); ?></p>

		</div>
	</div>
</div>