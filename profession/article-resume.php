	<!-- Resume -->
	<article class="cvpage <?php if ( opt('vertical_template') == 0 ) { ?> wrap <?php } ?>" id="resume">

		<div class="charts clearfix">
				
				<?php if ( opt('skill_title') ) { ?>
				<!-- DESKTOP -->
					<div class="<?php if ( opt('vertical_template') == 0 ) { ?> border-resume-title <?php }?> visible-desktop">
						<div class="chart-title">
							<h4><?php eopt('skill_title'); ?></h4>
						</div>
					</div>
				<?php } ?>
				
				<?php if ( opt('skill_title') ) { ?>
					<!-- Tablet & Phone -->
					<div class="hidden-desktop">
						<div class="chart-title">
							<h4><?php eopt('skill_title'); ?></h4>
						</div>
					</div>
				<?php } ?>
				
				<!-- skill -->
				<div class="<?php if ( opt('vertical_template') == 0 ) { ?> border-skill <?php }?>">
					<?php get_template_part( 'skill', 'resume' ); ?>
				</div>

			<div class="visible-desktop">	
				<div class="clearfix"></div>
				<a id="prev2" class="resume-skill-prev"  href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/back-resume.png"></a>
				<a id="next2" class="resume-skill-next"  href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/next-resume.png"></a>
			</div>
			
		</div>
		
		<div class="skills clearfix">

				<?php if ( opt('work_experience_title') ) { ?>
					<span class="resume-seperator"></span>
				
					<div class="<?php if ( opt('vertical_template') == 0 ) { ?> border-resume-title <?php }?> visible-desktop">
						<div class="chart-title skills-title">
							<h4><?php eopt('work_experience_title'); ?></h4>
						</div>
					</div>
					
					<div class="hidden-desktop">
						<div class="chart-title skills-title">
							<h4><?php eopt('work_experience_title'); ?></h4>
						</div>
					</div>
				
				<?php } ?>
				
				<!-- Work Expreince -->
				<div class="<?php if ( opt('vertical_template') == 0 ) { ?> border-exp <?php }?>">
					<?php get_template_part( 'exp', 'resume' ); ?>
				</div>	
				
			<div class="visible-desktop">	
				<div class="clearfix"></div>
				<a id="resume-exp-prev" class="resume-skill-prev"  href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/back-resume.png"></a>
				<a id="resume-exp-next" class="resume-skill-next"  href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/next-resume.png"></a>
			</div>
			
		</div>					
				
	</article>
	<!-- Resume End -->
