<?php if (!(isset($_POST["ishome"]) && $_POST["ishome"] == 1)) 
	$firmIsPage = true;


if ($firmIsPage) {
?>
	<?php get_header(); ?>

<?php }; ?>
<div class="homepostload homereadyinner">
	
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <?php if (has_post_thumbnail()) {
    $style = 'style= "float: right;" ' ;
    $style2 = 'style="width: 611px;"';
    }
    else {
    $style = '';
    $style2 = '';
    }
    ?>
    <?php $subtitle = get_post_custom_values("title"); ?>
    <?php $content = get_post_custom_values("pex"); ?>
<div class="pthumbnail">
        <?php $thumb = get_post_thumbnail_id();
        if (has_post_thumbnail()) $image = vt_resize( $thumb,'' , 227, 500, true ); ?>
	<?php if (has_post_thumbnail()) { ?><img src="<?php echo $image['url']; ?>" width="227" height="500" alt="<?php the_title(); ?>" /><?php }; ?></div>
<div class="pcowrap"  <?php echo $style; ?> >
            <h1 class="pageposttitle"><?php the_title(); ?></h1>
            <h2 class="pagepostsub"><?php echo $subtitle[0]; ?></h2>
	    <div style="height: 10px;"></div>
	<?php if (!$firmIsPage) { ?><img src="<?php echo get_template_directory_uri(); ?>/images/close.png"  alt= "<?php __('Close', 'eet_textdomain'); ?>" class="close"  /> <?php }; ?>
<div class="pcontent" <?php echo $style2; ?> >
	<div class="pconinnwr">
	   <?php the_content(); ?>
	</div>
</div>
</div>
    <?php endwhile; else: ?>
    <?php endif; ?>
</div> 
<?php if ($firmIsPage) { ?>
	<?php get_footer(); ?>
<?php }; ?>