<?php
get_header();

global $wp_query, $houzez_local;
$current_author = $wp_query->get_queried_object();
$current_author_meta = get_user_meta( $current_author->ID );
$agent_name = $current_author->display_name;
$agent_email = $current_author->user_email;
$agent_bio = $current_author->description;
$agent_mobile_call = isset( $current_author_meta['fave_author_mobile'][0] ) ? $current_author_meta['fave_author_mobile'][0] : '';
$agent_office_call = isset( $current_author_meta['fave_author_phone'][0] ) ? $current_author_meta['fave_author_phone'][0] : '';

$agent_mobile_call = str_replace(array('(',')',' ','-'),'', $agent_mobile_call );
$agent_office_call = str_replace(array('(',')',' ','-'),'', $agent_office_call );
$sticky_sidebar = houzez_option('sticky_sidebar');
?>

<div class="page-title breadcrumb-top">
	<div class="row">
		<div class="col-sm-12">
			<?php get_template_part( 'inc/breadcrumb' ); ?>
			<div class="page-title-left">
				<?php if( !empty( $agent_name ) ) { ?>
					<h2><?php echo esc_attr( $agent_name ); ?></h2>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">

		<div class="profile-detail-block">
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<div class="profile-image">
						<?php
						if( !empty( $current_author_meta['fave_author_custom_picture'][0] ) ) {
							echo '<img src="'.esc_url( $current_author_meta['fave_author_custom_picture'][0] ).'" width="300" height="300">';
						}else{
							houzez_image_placeholder( 'houzez-image350_350' );
						}
						?>

						<?php if( !empty( $agent_company_logo ) ) {
							$logo_url = wp_get_attachment_url( $agent_company_logo );
							?>
							<div class="company-logo">
								<img src="<?php echo esc_url( $logo_url ); ?>" alt="" width="105" height="75">
							</div>
						<?php } ?>

					</div>
				</div>
				<div class="col-md-4 col-sm-8 col-xs-12">
					<div class="profile-description">

						<?php if( !empty( $agent_name ) ) { ?>
							<h3><?php echo esc_attr( $agent_name ); ?></h3>
						<?php } ?>

						<h4 class="position">
							<?php
							if( !empty( $current_author_meta['fave_author_title'][0] ) ) { echo esc_attr( $current_author_meta['fave_author_title'][0] ).' '; }

							if( !empty( $current_author_meta['fave_author_company'][0] ) ) {
								echo $houzez_local['at'];
								echo ' ' . esc_attr( $current_author_meta['fave_author_company'][0] );
							}
							?>
						</h4>

						<p><?php echo wp_kses_post( $agent_bio ); ?></p>
						<ul class="profile-contact">
							<?php if( !empty($current_author_meta['fave_author_phone'][0]) ) { ?>
								<li><span><?php echo $houzez_local['office']; ?></span> <a href="tel:<?php echo esc_attr( $agent_office_call ); ?>"><?php echo esc_attr( $current_author_meta['fave_author_phone'][0] ); ?></a></li>
							<?php } ?>

							<?php if( !empty( $current_author_meta['fave_author_mobile'][0] ) ) { ?>
								<li><span><?php echo $houzez_local['mobile']; ?></span> <a href="tel:<?php echo esc_attr( $agent_mobile_call ); ?>"><?php echo esc_attr( $current_author_meta['fave_author_mobile'][0] ); ?></a></li>
							<?php } ?>

							<?php if( !empty( $current_author_meta['fave_author_fax'][0] ) ) { ?>
								<li><span><?php echo $houzez_local['fax']; ?></span> <a><?php echo esc_attr( $current_author_meta['fave_author_fax'][0] ); ?></a></li>
							<?php } ?>

							<?php if( !empty( $agent_email ) ) { ?>
								<li class="email"><span><?php echo $houzez_local['email']; ?></span> <a href="mailto:<?php echo esc_attr( $agent_email ); ?>"><?php echo esc_attr( $agent_email ); ?></a></li>
							<?php } ?>
						</ul>
						<ul class="profile-social">

							<?php if( !empty( $current_author_meta['fave_author_facebook'][0] ) ) { ?>
								<li><a class="btn-facebook" href="<?php echo esc_url( $current_author_meta['fave_author_facebook'][0] ); ?>" target="_blank"><i class="fa fa-facebook-square"></i></a></li>
							<?php } ?>

							<?php if( !empty( $current_author_meta['fave_author_twitter'][0] ) ) { ?>
								<li><a class="btn-twitter" href="<?php echo esc_url( $current_author_meta['fave_author_twitter'][0] ); ?>" target="_blank"><i class="fa fa-twitter-square"></i></a></li>
							<?php } ?>

							<?php if( !empty( $current_author_meta['fave_author_linkedin'][0] ) ) { ?>
								<li><a class="btn-linkedin" href="<?php echo esc_url( $current_author_meta['fave_author_linkedin'][0] ); ?>" target="_blank"><i class="fa fa-linkedin-square"></i></a></li>
							<?php } ?>

							<?php if( !empty( $current_author_meta['fave_author_googleplus'][0] ) ) { ?>
								<li><a class="btn-google-plus" href="<?php echo esc_url( $current_author_meta['fave_author_googleplus'][0] ); ?>" target="_blank"><i class="fa fa-google-plus-square"></i></a></li>
							<?php } ?>

							<?php if( !empty( $current_author_meta['fave_author_youtube'][0] ) ) { ?>
								<li><a class="btn-youtube" href="<?php echo esc_url( $current_author_meta['fave_author_youtube'][0] ); ?>" target="_blank"><i class="fa fa-youtube-square"></i></a></li>
							<?php } ?>

							<?php if( !empty( $current_author_meta['fave_author_instagram'][0] ) ) { ?>
								<li><a class="btn-instagram" href="<?php echo esc_url( $current_author_meta['fave_author_instagram'][0] ); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
							<?php } ?>

							<?php if( !empty( $current_author_meta['fave_author_pinterest'][0] ) ) { ?>
								<li><a class="btn-pinterest" href="<?php echo esc_url( $current_author_meta['fave_author_pinterest'][0] ); ?>" target="_blank"><i class="fa fa-pinterest-square"></i></a></li>
							<?php } ?>

							<?php if( !empty( $current_author_meta['fave_author_vimeo'][0] ) ) { ?>
								<li><a class="btn-vimeo" href="<?php echo esc_url( $current_author_meta['fave_author_vimeo'][0] ); ?>" target="_blank"><i class="fa fa-vimeo-square"></i></a></li>
							<?php } ?>

						</ul>
					</div>
				</div>
				<div class="col-md-4 col-sm-12 col-xs-12">

					<?php get_template_part( 'template-parts/agent-detail-contact'); ?>

				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-12 list-grid-area container-contentbar">
		<div id="content-area">

			<!--start property items-->
			<div class="property-listing list-view">
				<div class="row">
					<?php
					$agent_listing_args = array(
						'post_type' => 'property',
						'posts_per_page' => '-1',
						'author' => $current_author->ID
					);

					$wp_query = new WP_Query( $agent_listing_args );

					if ( $wp_query->have_posts() ) :
						while ( $wp_query->have_posts() ) : $wp_query->the_post();

							get_template_part('template-parts/property-for-listing');

						endwhile;
						wp_reset_postdata();
					else:
						get_template_part('template-parts/property', 'none');
					endif;
					?>
				</div>
			</div>
			<!--end property items-->

			<hr>

		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-6 col-md-offset-0 col-sm-offset-3 container-sidebar <?php if( isset( $sticky_sidebar['agent_sidebar'] ) && $sticky_sidebar['agent_sidebar'] != 0 ) { echo 'houzez_sticky'; }?>">
		<?php get_sidebar('houzez_agents'); ?>
	</div>
</div>

<?php get_footer(); ?>
