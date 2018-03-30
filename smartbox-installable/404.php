<?php

get_header(); ?>

	<div id="white_content">
	
		<div id="wrapper">
		
			<div class="container">
					<?php
						if (isset($type)){
							if ($type == "border"){
								?>
								<div class="borderline"></div> 
								<?php
							}	
						}
					?>
	<section id="primary" class="blogarchive twelve columns error-page">
		<div id="content">

			<div id="post-0" class="post error404 not-found" role="article">
				<header class="entry-header">
					<div class="error-c">
						<img src="<?php echo get_template_directory_uri() . "/img/error.png";?>" title=""/>						
						<p class="text-error"><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching one of the links in the right sidebar or in the top menu, can help.', 'smartbox' ); ?></p>
					</div>
					
				</header>

				
			</div>

		</div><!-- #content -->
	</section><!-- #primary -->
	
<div class="four columns"><?php get_sidebar(); ?></div>
<?php get_footer(); ?>