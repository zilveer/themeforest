<?php if ( resume_manager_user_can_view_resume( $post->ID ) ) : ?>

	<div class="resume-card vc_row">
		<div class="vc_col-lg-3 vc_col-md-3 vc_col-sm-12"><?php the_candidate_photo( 'workscout-resume', get_template_directory_uri() . '/img/candidate.png' ); ?></div>
		<div class="vc_col-lg-5 vc_col-md-5 vc_col-sm-12">
			<?php the_terms( $post->ID, 'resume_skill', '<div class="skills"><h4>'. __('Skills', 'jobseek') . '</h4>', ' ', '</h4></div>' );

			$resume_links = get_resume_links();

			if( !empty( $resume_links ) ) { ?>
				<div class="resume_links">
					<h4><?php _e('Links', 'jobseek'); ?></h4><?php
					foreach( get_resume_links() as $link ) {
						$parsed_url = parse_url( $link['url'] );
						$host = isset( $parsed_url['host'] ) ? current( explode( '.', $parsed_url['host'] ) ) : ''; ?>
						<a rel="nofollow" href="<?php echo esc_url( $link['url'] ); ?>"><?php echo esc_html( $link['name'] ); ?></a><?php
					} ?>
				</div>
			<?php } ?>

		</div>
		<div class="vc_col-lg-4 vc_col-md-4 vc_col-sm-12"><?php

			if ( class_exists( 'Jetpack_Likes' ) ) { 
			    $custom_likes = new Jetpack_Likes;
			    echo($custom_likes->post_likes( '' ));
			}

			if ( function_exists( 'sharing_display' ) ) { ?>
				<div class="sharing-widget">
			    	<?php sharing_display( '', true ); ?>
			    </div><?php
			}

			get_job_manager_template( 'contact-details.php', array( 'post' => $post ), 'wp-job-manager-resumes', RESUME_MANAGER_PLUGIN_DIR . '/templates/' );

			if ( resume_has_file() ) {
				if ( ( $resume_files = get_resume_files() ) && apply_filters( 'resume_manager_user_can_download_resume_file', true, $post->ID ) ) {
					foreach ( $resume_files as $key => $resume_file ) { ?>
						<a rel="nofollow" class="resume_file_button" href="<?php echo esc_url( get_resume_file_download_url( null, $key ) ); ?>"><?php _e('Resume File', 'jobseek'); ?></a>
					<?php }
				}
			} ?>

		</div>
	</div>
	
	<hr class="resume-row">

	<div class="vc_row">
		<div class="<?php if( is_active_sidebar('resume') ) { ?>vc_col-md-8<?php } else { ?>vc_col-md-12<?php } ?>">

			<div class="resume-description">

				<?php do_action( 'single_resume_start' ); ?>

				<h2><?php _e( 'About', 'jobseek' ); ?></h2>
				<div class="video-wrapper">
					<?php the_candidate_video(); ?>
				</div>

				<?php echo apply_filters( 'the_resume_description', get_the_content() ); ?>
				
			</div>

			<div class="experience">
				<?php if ( $items = get_post_meta( $post->ID, '_candidate_experience', true ) ) : ?>
					<h2><?php _e( 'Experience', 'wp-job-manager-resumes' ); ?></h2>
					<?php
						foreach( $items as $item ) : ?>
						<div class="work-experience">
							<h4 class="date"><?php echo esc_html( $item['date'] ); ?></h4>
							<h5><?php printf( __( '%s at %s', 'wp-job-manager-resumes' ), '<strong class="job_title">' . esc_html( $item['job_title'] ) . '</strong>', '<strong class="employer">' . esc_html( $item['employer'] ) . '</strong>' ); ?></h5>
							<?php echo wpautop( wptexturize( $item['notes'] ) ); ?>
						</div>
						<?php endforeach; ?>
				<?php endif; ?>
			</div>

			<div class="experience">
			<?php if ( $items = get_post_meta( $post->ID, '_candidate_education', true ) ) : ?>
				<h2><?php _e( 'Education', 'wp-job-manager-resumes' ); ?></h2>
				<?php
					foreach( $items as $item ) : ?>
					<div class="work-experience">
						<h4 class="date"><?php echo esc_html( $item['date'] ); ?></h4>
						<h5><?php printf( __( '%s at %s', 'wp-job-manager-resumes' ), '<strong class="qualification">' . esc_html( $item['qualification'] ) . '</strong>', '<strong class="location">' . esc_html( $item['location'] ) . '</strong>' ); ?></h5>
						<?php echo wpautop( wptexturize( $item['notes'] ) ); ?>
					</div>
					<?php endforeach; ?>
			<?php endif; ?>
			</div>

			<?php do_action( 'single_resume_end' ); ?>

		</div>

		<?php if( is_active_sidebar('resume') ) { ?>
			<div class="vc_col-md-4 sidebar">
				<?php dynamic_sidebar( 'resume' ); ?>
			</div>
		<?php } ?>

	</div>

<?php else : ?>

	<?php get_job_manager_template_part( 'access-denied', 'single-resume', 'wp-job-manager-resumes', RESUME_MANAGER_PLUGIN_DIR . '/templates/' ); ?>

<?php endif; ?>