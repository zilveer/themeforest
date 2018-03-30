<?php
/**
 * @package cshero
 */
global $counter, $masonry_columns;
$class='portfolio-item clearfix portfolio-blog-layout3';
$portfolio_link = get_post_meta(get_the_ID(), 'cs_portfolio_link', true);

$cls ='';
$cls1 ='';
$cls2='';
if($masonry_columns ==1){
	$cls1 ='col-xs-12 col-sm-12 col-md-7 col-lg-7';
	$cls2 ='col-xs-12 col-sm-12 col-md-5 col-lg-5';
	if($counter%2 != '1') $cls = 'right';
} else {
	$cls1 ='col-xs-12 col-sm-12 col-md-6 col-lg-6';
	$cls2 ='col-xs-12 col-sm-12 col-md-6 col-lg-6';
	if($counter>$masonry_columns) $cls = 'right';
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
	<div class="row nomarginall clearfix">
		<div class="cs-portfolio-thumbnail nopaddingall <?php echo $cls1.' '.$cls;?>">
			<?php if (has_post_thumbnail() && ! post_password_required() && ! is_attachment() && wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false)) { ?>
				<?php
					$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
	                $image_resize = mr_image_resize( $attachment_image[0], 690, 443, true, 'c', false );
	                echo '<img alt="" class="" src="'. esc_url($image_resize)  .'"/>';
				?>
			<?php } else { 
				$no_image = get_template_directory_uri().'/assets/images/no-image.jpg';
	    		$image_resize = mr_image_resize( $no_image, 690, 443, true,'c', false );
				?>
				<img alt="" src="<?php echo $image_resize; ;?>" />
			<?php } ?>
		</div><!-- .entry-thumbnail -->
		<content class="cs-portfolio-content-wrap  nopaddingall <?php echo $cls2;?>">
			<div class="">
				<header class="cs-portfolio-title">
					<?php echo cshero_title_render(); ?>
					<?php echo cshero_getPortfolioCategory(); ?>
				</header>
				<content class="cs-portfolio-content">
					<?php cshero_portfolio_content_render(); ?>
				</content>
				<?php if($portfolio_link!='') {?>
					<div class="clearfix"><a class="portfolio-link btn btn-primary" href="<?php echo $portfolio_link;?>" alt="" title=""><?php echo _e('VIEW PROJECTS', THEMENAME);?></a></div>
				<?php } else {?>
					<div class="clearfix"><a class="portfolio-link btn btn-primary" href="<?php the_permalink();?>" alt="" title=""><?php echo _e('VIEW DETAILS', THEMENAME);?></a></div>
				<?php } ?>
			</div>
		</content><!-- .entry-content -->
	</div>
</article><!-- #post-## -->
