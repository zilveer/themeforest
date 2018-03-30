<?php

the_post();

global $kowloonbay_redux_opts;
$breadcrumb_team_display = $kowloonbay_redux_opts['breadcrumb_team_display'];
$breadcrumb_home_label = $kowloonbay_redux_opts['breadcrumb_home_label'];
$breadcrumb_team_label = $kowloonbay_redux_opts['breadcrumb_team_label'];
$breadcrumb_icon = $kowloonbay_redux_opts['breadcrumb_icon'];
$breadcrumb_team_page = $kowloonbay_redux_opts['breadcrumb_team_page'];

$team_label_others = $kowloonbay_redux_opts['team_label_others'];
$team_show_others = $kowloonbay_redux_opts['team_show_others'] === '1';

$pos = rwmb_meta( 'kowloonbay_team_pos');
$photo = rwmb_meta( 'kowloonbay_team_photo', array('type'=>'image_advanced') );
$photo = reset($photo);
$photo_pos = rwmb_meta( 'kowloonbay_team_photo_pos');
$photo_stretch = rwmb_meta( 'kowloonbay_team_photo_stretch');

$padding_class = 'page-padding-h page-padding-h-sm ';
if ($photo_stretch === '1'){
	if ($photo_pos === 'right'){
		$padding_class .= 'padding-r-2x-md padding-l-3x-md';
	}
	else{
		$padding_class .= 'padding-l-2x-md padding-r-3x-md';
	}
}

get_header();
?>


<section>
	<div class="section-heading">
		<?php if ($breadcrumb_team_display === '1'): ?>
		<p class="margin-v-none small-text"><a href="<?php echo esc_url(home_url()); ?>"><?php echo esc_html( $breadcrumb_home_label ); ?></a><i class="fa <?php echo esc_attr($breadcrumb_icon); ?>"></i><a href="<?php echo esc_url(empty($breadcrumb_team_page) ? '#' : get_permalink($breadcrumb_team_page)); ?>"><?php echo esc_html(empty($breadcrumb_team_label) ? get_the_title($breadcrumb_team_page ) : $breadcrumb_team_label); ?></a><i class="fa <?php echo esc_attr( $breadcrumb_icon ); ?>"></i></p>
		<?php endif; ?>
		<h2><a href="#"><?php the_title(); ?></a></h2>
		<p class="section-desc"><?php echo esc_html( $pos ); ?></p>
	</div>

	<div class="team-member row no-page-padding <?php echo esc_attr($photo_stretch === '1' ? 'eq-col-height':''); ?>">
		
		<div class="col-sm-6 img-bg-cover margin-b-1x margin-b-none-sm <?php echo esc_attr(($photo_pos === 'left')?'':'pull-right-sm'); ?> wow <?php echo esc_attr( ($photo_pos === 'left') ? $kowloonbay_redux_opts['animation_team_member_photo_left'] : $kowloonbay_redux_opts['animation_team_member_photo_right'] ); ?>" data-wow-delay="0.1s">
			<img src="<?php echo esc_url( $photo['full_url'] ); ?>" alt="">
		</div>

		<div class="col-sm-6 <?php echo esc_attr( $padding_class ); ?>">
			<?php the_content(); ?>
		</div>

	</div>
	
	<?php if ($team_show_others): ?>
	<h3 class="margin-t-4x margin-b-2x uppercase"><?php echo esc_html( $team_label_others ); ?></h3>
	<div class="no-page-padding margin-t-2x">
		<div class="owl-carousel carousel-related-items">

			<?php 
				$kowloonbay_team_member_query = array(
					'posts_per_page'	=> '-1',
					'post_type'			=> 'kowloonbay_team',
					'order'				=> 'ASC',
					'orderby'			=> 'menu_order',
					'paged'				=> '1',
					'post__not_in'		=> array(get_the_id()),
				);
				$kowloonbay_team_members = new WP_Query( $kowloonbay_team_member_query );

				global $kowloonbay_carousel_related_items_count;
				$kowloonbay_carousel_related_items_count = $kowloonbay_team_members->post_count;


				if ($kowloonbay_team_members->have_posts()):
					while($kowloonbay_team_members->have_posts()):
						$kowloonbay_team_members->the_post();
						$kowloonbay_team_photo = rwmb_meta( 'kowloonbay_team_photo',array('type'=>'image_advanced') );
						$kowloonbay_team_photo = reset($kowloonbay_team_photo);
						$kowloonbay_team_pos = rwmb_meta( 'kowloonbay_team_pos');
						$permalink = get_permalink(get_the_id());
			?>

				<div class="hover-effect-move-right height-1x">
					<div class="img-bg-cover"><img src="<?php echo esc_url( $kowloonbay_team_photo['full_url'] ); ?>" alt=""></div>
					<div class="caption">
						<div class="v-centered-container">
							<div class="v-centered">	
								<h2><?php the_title(); ?></h2>
								<p><?php echo esc_html( $kowloonbay_team_pos ); ?></p>
							</div>
						</div>
						<a href="<?php echo esc_url($permalink); ?>">View More</a>
					</div>
				</div>
				
			<?php
					endwhile;
				endif;

				wp_reset_postdata();
			?>
			
		</div>
	</div>
	<?php endif; ?>

</section>

<?php

get_footer();