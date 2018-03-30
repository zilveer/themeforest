<?php

the_post();
$the_cat = get_the_terms( get_the_id(), 'kowloonbay_portfolio_cat' );
if ($the_cat === false) $the_cat = array();

global $kowloonbay_portfolio_current_assignment;
$kowloonbay_portfolio_current_assignment = rwmb_meta( 'kowloonbay_portfolio_assignment');
if ($kowloonbay_portfolio_current_assignment === '') $kowloonbay_portfolio_current_assignment = '1';

global $kowloonbay_redux_opts;
$breadcrumb_portfolio_display = $kowloonbay_redux_opts['breadcrumb_portfolio_display'];
$breadcrumb_portfolio_display_cat = $kowloonbay_redux_opts['breadcrumb_portfolio_display_cat'];
$breadcrumb_home_label = $kowloonbay_redux_opts['breadcrumb_home_label'];
$breadcrumb_portfolio_label = $kowloonbay_redux_opts['breadcrumb_portfolio_label'];
$breadcrumb_icon = $kowloonbay_redux_opts['breadcrumb_icon'];
$breadcrumb_portfolio_page = $kowloonbay_redux_opts['breadcrumb_portfolio_page_'.$kowloonbay_portfolio_current_assignment];
$breadcrumb_portfolio_page = empty($breadcrumb_portfolio_page) ? '#' : get_permalink($breadcrumb_portfolio_page);

$portfolio_show_related_projects = $kowloonbay_redux_opts['portfolio_show_related_projects'];
$portfolio_related_projects_label = $kowloonbay_redux_opts['portfolio_related_projects_label'];

$desc = rwmb_meta( 'kowloonbay_portfolio_desc');
$layout = rwmb_meta( 'kowloonbay_portfolio_layout');
$slider_images = rwmb_meta( 'kowloonbay_portfolio_slider_images', array('type'=>'image_advanced') );
$slider_videos = rwmb_meta( 'kowloonbay_portfolio_slider_videos', array('type'=>'text') );
$slider_pos = rwmb_meta( 'kowloonbay_portfolio_slider_pos');
$info_bar_content =  rwmb_meta( 'kowloonbay_portfolio_info_bar_content', array('type'=>'text'));
$cols = rwmb_meta( 'kowloonbay_portfolio_cols');
$end_mark = rwmb_meta( 'kowloonbay_portfolio_end_mark');
$related_items =  rwmb_meta( 'kowloonbay_portfolio_related_items', array('type'=>'select', 'multiple'=>true));
$max_width_img_stack = rwmb_meta('kowloonbay_portfolio_dim_max_width_img_stack');
if (empty($max_width_img_stack)) $max_width_img_stack = '100%';


$slider_height = rwmb_meta('kowloonbay_portfolio_dim_slider_height');
$slider_custom_height = rwmb_meta('kowloonbay_portfolio_dim_slider_custom_height');

if ($slider_custom_height === '') $slider_custom_height = 'auto';

$slider_height_style = '';
$slider_height_class = 'height-1-plus-half-x';

switch ($slider_height) {
	case '1x':
		$slider_height_class = 'height-1x';
		break;
	case '1.5x':
		$slider_height_class = 'height-1-plus-half-x';
		break;
	case '2x':
		$slider_height_class = 'height-2x';
		break;
	case '3x':
		$slider_height_class = 'height-3x';
		break;
	case 'c':
		$slider_height_class = '';
		$slider_height_style = $slider_custom_height;
		break;
	default:
		$slider_height_class = 'height-1-plus-half-x';
		break;
}

$video_slider_ratio = rwmb_meta('kowloonbay_portfolio_dim_video_slider_ratio');

if ($video_slider_ratio === '') $video_slider_ratio = '16by9';
if ($layout === 'video_slider' && $video_slider_ratio !== 'n'){
	$slider_height_style = '';
	$slider_height_class = 'item-video-'.$video_slider_ratio;
}

$slider_stretch = rwmb_meta('kowloonbay_portfolio_dim_slider_stretch');

$slider_stretch_class = '';
$eq_col_height_class = '';

if ($slider_stretch === '1' && $layout !== 'free_layout' && $slider_pos !== 'top' && $layout === 'image_slider'){
	$slider_stretch_class = 'owl-custom-stretch';
	$eq_col_height_class = 'eq-col-height';
}

$slider_img_bg_contain_class = '';
if (rwmb_meta('kowloonbay_portfolio_slider_image_resize_mode') === 'contain'){
	$slider_img_bg_contain_class = 'img-bg-cover-contain';
}

global $kowloonbay_allowed_html;

get_header();
?>


<section>
	<div class="section-heading">
		<?php if ($breadcrumb_portfolio_display === '1'): ?>
		<p class="margin-v-none small-text"><a href="<?php echo esc_url(home_url()); ?>"><?php echo esc_html( $breadcrumb_home_label ); ?></a><i class="fa <?php echo esc_attr( $breadcrumb_icon ); ?>"></i><a href="<?php echo esc_url( $breadcrumb_portfolio_page ); ?>"><?php echo empty($breadcrumb_portfolio_label) ? get_the_title($breadcrumb_portfolio_page ) : esc_html( $breadcrumb_portfolio_label ); ?></a><i class="fa <?php echo esc_attr( $breadcrumb_icon ); ?>"></i><?php 
			if (kowloonbay_portfolio_cat_attr($the_cat) !== ' ' && $breadcrumb_portfolio_display_cat === '1'):
		?><a href="<?php echo esc_url( $breadcrumb_portfolio_page ); ?>"><?php echo esc_html( kowloonbay_portfolio_cat_names($the_cat) ); ?></a><i class="fa <?php echo esc_attr( $breadcrumb_icon ); ?>"></i></p><?php 
			endif;
		?>
		<?php endif; ?>
		<h2><a href="#"><?php the_title(); ?></a></h2>
		<p class="section-desc"><?php echo esc_html( $desc ); ?></p>
	</div>
	
	<div class="row margin-v-1x">
		<div class="col-sm-3 margin-b-1x margin-b-none-sm pull-right-sm">
			<ul class="list-inline small-text title-font margin-b-none text-right-sm wow-array">
				<?php
					$prevItem = get_previous_post_link( $format = '%link', $link = '<i class="fa fa-angle-left fa-custom-sm"></i>', false);
					if ($prevItem !== ''){
						$prevItem = substr_replace($prevItem, 'class="fa-custom-hover-effect" ', 3, 0);
					}

					$nextItem = get_next_post_link( $format = '%link', $link = '<i class="fa fa-angle-right fa-custom-sm"></i>', false);
					if ($nextItem !== ''){
						$nextItem = substr_replace($nextItem, 'class="fa-custom-hover-effect" ', 3, 0);
					}
				?>
				<?php if ($prevItem !== ''): ?><li><?php echo wp_kses($prevItem, $kowloonbay_allowed_html); ?></li><?php endif; ?>
				<?php if ($nextItem !== ''): ?><li><?php echo wp_kses($nextItem, $kowloonbay_allowed_html); ?></li><?php endif; ?>
				<li><a class="fa-custom-hover-effect" href="<?php echo esc_url( $breadcrumb_portfolio_page ); ?>"><i class="fa fa-th fa-custom-sm"></i></a></li>
			</ul>
		</div>
		<div class="col-sm-9">
			<ul class="project-info list-inline small-text title-font margin-b-none wow-array">
				<?php foreach ($info_bar_content as $info) {
						$info = explode('|', $info);

						echo '<li>';
						foreach ($info as $subinfo) {
							$subinfo = trim($subinfo);
							if (strpos($subinfo, 'fa-') === 0){
								echo '<i class="fa fa-custom-sm ' .esc_attr( $subinfo ). '"></i>';
							} else {
								echo esc_html($subinfo);
							}
						}
						echo '</li>';
				?>
				<?php } ?>
			</ul>
		</div>
	</div>

	<?php
		if ($layout === 'free_layout'):
			the_content();
		endif;
	?>

	
	<?php
		if ($layout !== 'free_layout' && ($slider_pos === 'top' || $slider_pos === 'stack')):
			
	?>

		<?php if ($slider_pos === 'top'): ?>
		<div class="no-page-padding">
			<?php
			if ($layout === 'image_slider'):
			?>

			<div class="owl-carousel carousel-single-item">
				<?php 
					global $kowloonbay_carousel_single_item_count;
					$kowloonbay_carousel_single_item_count = count($slider_images);
				?>
				<?php foreach ($slider_images as $img) : ?>
					<div class="item img-bg-cover <?php echo esc_attr( $slider_img_bg_contain_class ); ?> <?php echo esc_attr( $slider_height_class ); ?>" <?php echo 'style="height: '.esc_attr($slider_height_style).';"'; ?> >
						<img src="<?php echo esc_url( $img['full_url'] ); ?>" />
						<p class="caption text-shadow"><?php echo esc_html( $img['caption'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>

			<?php
			elseif ($layout === 'video_slider'):
			?>

			<div class="owl-carousel carousel-single-item-video carousel-controls-outside">
				<?php 
					global $kowloonbay_carousel_single_item_video_count;
					$kowloonbay_carousel_single_item_video_count = count($slider_videos);
				?>
				<?php foreach ($slider_videos as $video) : ?>
					<div class="item-video <?php echo esc_attr( $slider_height_class ); ?>" <?php echo 'style="height: '.esc_attr($slider_height_style).';"'; ?> ><a class="owl-video" href="<?php echo esc_url( $video ); ?>"></a></div>
				<?php endforeach; ?>
			</div>

			<?php
			endif;
			?>
		</div>
		<?php else: ?>

		<div class="stack margin-b-2x text-center">
			<?php foreach ($slider_images as $img) : ?>
				<div class="margin-b-half">
					<a href="<?php echo esc_url( $img['full_url'] ); ?>" class="popup-img"><img src="<?php echo esc_url( $img['full_url'] ); ?>" style="max-width: <?php echo esc_attr( $max_width_img_stack ); ?>;"></a>
					<p class="caption"><?php echo esc_html( $img['caption'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>

		<?php endif; ?>
		<div class="<?php echo esc_attr($cols === 'double'? 'newspaper-two-cols':''); ?> <?php echo esc_attr($end_mark === 'show'? 'ending-indicator':''); ?>">
			<?php the_content(); ?>
		</div>

	<?php
		elseif ($layout !== 'free_layout'):
	?>

		<div class="row no-page-padding <?php echo esc_attr( $eq_col_height_class ); ?>">
			
			<div class="col-md-6 <?php echo esc_attr($layout === 'image_slider'?'margin-b-2x':'margin-b-1x');?> margin-b-none-md <?php echo esc_attr(($slider_pos === 'left')? '':'pull-right-md'); ?>  <?php echo esc_attr( $slider_height_class ); ?>"  <?php echo 'style="height: '.esc_attr($slider_height_style).';"'; ?>>
				<?php
				if ($layout === 'image_slider'):
				?>

				<div class="owl-carousel carousel-single-item owl-custom-vertical <?php echo esc_attr( $slider_stretch_class ); ?>">
					<?php 
						global $kowloonbay_carousel_single_item_count;
						$kowloonbay_carousel_single_item_count = count($slider_images);
					?>
					<?php foreach ($slider_images as $img) : ?>
						<div class="item img-bg-cover <?php echo esc_attr( $slider_img_bg_contain_class ); ?> <?php echo esc_attr( $slider_height_class ); ?>" <?php echo 'style="height: '.esc_attr($slider_height_style).';"'; ?> >
							<img src="<?php echo $img['full_url']; ?>" />
							<p class="caption text-shadow"><?php echo esc_html( $img['caption'] ); ?></p>
						</div>
					<?php endforeach; ?>
				</div>

				<?php
				elseif ($layout === 'video_slider'):
				?>

				<div class="owl-carousel carousel-single-item-video carousel-controls-outside owl-custom-vertical">
					<?php 
						global $kowloonbay_carousel_single_item_video_count;
						$kowloonbay_carousel_single_item_video_count = count($slider_videos);
					?>
					<?php foreach ($slider_videos as $video) : ?>
						<div class="item-video <?php echo esc_attr( $slider_height_class ); ?>" <?php echo 'style="height: '.esc_attr($slider_height_style).';"'; ?> ><a class="owl-video" href="<?php echo esc_url( $video ); ?>"></a></div>
					<?php endforeach; ?>
				</div>

				<?php
				endif;
				?>
			</div>

			<div class="col-md-6 <?php echo esc_attr(($slider_pos === 'left')? 'page-padding-h page-padding-h-sm padding-l-2x-md padding-r-3x-md':'page-padding-h page-padding-h-sm padding-r-2x-md padding-l-3x-md'); ?> <?php echo esc_attr($end_mark === 'show'? 'ending-indicator':''); ?>">
				<?php the_content(); ?>
			</div>
			
		</div>

	<?php
		endif;
	?>

	<?php if ( is_array($related_items) && !empty($related_items) && $portfolio_show_related_projects === '1'): ?>
	<h3 class="margin-t-4x"><?php echo esc_html( $portfolio_related_projects_label ); ?></h3>
	<div class="no-page-padding margin-t-1x">
		<div class="owl-carousel carousel-related-items">
			<?php 
				global $kowloonbay_carousel_related_items_count;
				$kowloonbay_carousel_related_items_count = count($related_items);

				$related_items = array_reverse($related_items);
				foreach ($related_items as $post_id):
					$cover_img = rwmb_meta( 'kowloonbay_portfolio_cover_img', array('type'=>'image_advanced'), $post_id);
					$cover_img = reset($cover_img);
					$title = get_the_title($post_id);
					$cat = get_the_terms( $post_id, 'kowloonbay_portfolio_cat' );
					if ($cat === false) $cat = array();
					$permalink = get_permalink($post_id);



					$kowloonbay_portfolio_layout = rwmb_meta( 'kowloonbay_portfolio_layout', array(), $post_id);
					$kowloonbay_portfolio_slider_pos = rwmb_meta( 'kowloonbay_portfolio_slider_pos', array(), $post_id);

					$mfpAtts = '';
					if ($kowloonbay_portfolio_slider_pos === 'lightbox'){
						if ($kowloonbay_portfolio_layout === 'image_slider'){
							$slider_images = rwmb_meta( 'kowloonbay_portfolio_slider_images', array('type'=>'image_advanced'), $post_id );
							foreach ($slider_images as $img){
								$mfpAtts .= esc_url($img['full_url']).',';
							}
						} else if ($kowloonbay_portfolio_layout === 'video_slider'){
							$slider_videos = rwmb_meta( 'kowloonbay_portfolio_slider_videos', array('type'=>'text'), $post_id );
							foreach ($slider_videos as $video){
								$mfpAtts .= esc_url($video).',';
							}
						}
					}
			?>

				<div class="hover-effect-move-right height-1x">
					<div class="img-bg-cover"><img src="<?php echo esc_url( $cover_img['full_url'] ); ?>" alt=""></div>
					<div class="caption">
						<div class="v-centered-container">
							<div class="v-centered">	
								<h2><?php echo esc_html( $title ); ?></h2>
								<p><?php echo esc_html( kowloonbay_portfolio_cat_names($cat) ); ?></p>
							</div>
						</div>
						<a href="<?php echo $permalink; ?>" <?php
							if ($kowloonbay_portfolio_slider_pos === 'lightbox'){
								if ($kowloonbay_portfolio_layout === 'image_slider'){
									echo 'class="mfpGalleryImgs" data-mfp-imgs="'. esc_attr($mfpAtts) .'"';
								} else if ($kowloonbay_portfolio_layout === 'video_slider'){
									echo 'class="mfpGalleryVideos" data-mfp-videos="'. esc_attr($mfpAtts) .'"';
								}
							}
						?> >View More</a>
					</div>
				</div>

			<?php
				endforeach;
			?>
		</div>
	</div>
	<?php endif; ?>

</section>

<?php

get_footer();