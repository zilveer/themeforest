<?php 
global $kowloonbay_redux_opts;
global $kowloonbay_cats;
global $kowloonbay_post_url;

$blog_infobar_items = $kowloonbay_redux_opts['blog_infobar_items'];
$blog_infobar_icons = array(
	'd' => $kowloonbay_redux_opts['blog_infobar_fa_icon_date'],
	'a' => $kowloonbay_redux_opts['blog_infobar_fa_icon_author'],
	'c' => $kowloonbay_redux_opts['blog_infobar_fa_icon_cat'],
	'co' => $kowloonbay_redux_opts['blog_infobar_fa_icon_comments']
);
?>

<?php if ($blog_infobar_items['d'] === '1'): ?>
<li><i class="fa <?php echo esc_attr( $blog_infobar_icons['d'] ); ?> fa-custom-sm primary-color"></i><a href="<?php echo esc_url( $kowloonbay_post_url ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></li>
<?php endif; ?>

<?php if ($blog_infobar_items['a'] === '1'): ?>
<li><i class="fa <?php echo esc_attr( $blog_infobar_icons['a'] ); ?> fa-custom-sm primary-color"></i><?php the_author(); ?></li>
<?php endif; ?>

<?php if ($blog_infobar_items['c'] === '1'): ?>

<?php foreach ($kowloonbay_cats as $cat): ?>
<li><i class="fa <?php echo esc_attr( $blog_infobar_icons['c'] ); ?> fa-custom-sm primary-color"></i><a href="<?php echo esc_url( get_category_link( $cat->cat_ID ) ); ?>"><?php echo esc_html($cat->cat_name); ?></a>
<?php endforeach; ?></li>

<?php endif; ?>

<?php if ($blog_infobar_items['co'] === '1'): ?>
<li><i class="fa <?php echo esc_attr( $blog_infobar_icons['co'] ); ?> fa-custom-sm primary-color"></i><a href="<?php the_permalink(); ?>#comments" class="comments"><?php esc_html_e('Comments', 'KowloonBay'); ?> <span class="number"><?php echo esc_html(wp_count_comments( get_the_id() ) -> approved); ?></span></a></li>
<?php endif; ?>
