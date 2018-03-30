<?php
/**
 * Social networks sharing template part
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */
?>

<?php
$image_data = wp_get_attachment_image_src( get_the_ID(), 'medium' );
$text       = wp_strip_all_tags( esc_attr( urlencode( get_the_title() ) ) );
$show_links = get_mental_option( 'social_links_show' );
?>

<div class="social-block">
	<?php if( ! empty( $show_links['twitter'] ) ): ?>
		<a href="<?php echo('https://twitter.com/intent/tweet?source=webclient&amp;original_referer='.get_the_permalink().'&amp;text='.$text.'&amp;url='.get_the_permalink()) ?>" target="_blank"><i class="fa fa-twitter"></i></a>
	<?php endif; ?>
	<?php if( ! empty( $show_links['facebook'] ) ): ?>
		<a href="<?php echo('https://www.facebook.com/sharer/sharer.php?u='.get_the_permalink()) ?>" target="_blank"><i class="fa fa-facebook"></i></a>
	<?php endif; ?>
	<?php if( ! empty( $show_links['googleplus'] ) ): ?>
		<a href="<?php echo('https://plus.google.com/share?url='.get_the_permalink()) ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
	<?php endif; ?>
	<?php if( ! empty( $show_links['pinterest'] ) ): ?>
		<a href="<?php echo('http://pinterest.com/pin/create/bookmarklet/?media='.$image_data[0].'&amp;url='.get_the_permalink().'&amp;title='.$text.'&amp;description='.urlencode(strip_tags(get_the_excerpt()))) ?>" target="_blank"><i class="fa fa-pinterest"></i></a>
	<?php endif; ?>
	<?php if( ! empty( $show_links['likedin'] ) ): ?>
		<a href="<?php echo('http://www.linkedin.com/shareArticle?mini=true&amp;ro=true&amp;trk=JuizSocialPostSharer&amp;title='.$text.'&amp;url='.get_the_permalink()) ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
	<?php endif; ?>
	<?php if( ! empty( $show_links['vkontakte'] ) ): ?>
		<a href="<?php echo('http://vkontakte.ru/share.php?url='.get_the_permalink())?>" target="_blank"><i class="fa fa-vk"></i></a>
	<?php endif; ?>
</div>