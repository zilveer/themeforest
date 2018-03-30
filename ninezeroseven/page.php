<?php 
/************************************************************************
* Default Page Template
*************************************************************************/

/* Load Header */
get_header();

global $wbc907_data;

?>

		<!-- BEGIN MAIN -->

	    <div class="main-content-area clearfix">

	    	<div class="container">
        
					<div class="row">

						<div class="col-sm-12">

							<div class="page-content clearfix">
								<?php

									while( have_posts()) : the_post();
										
										the_content();
										
								?>
							</div> <!-- ./page-content -->

							<?php wp_link_pages(); ?>

							<?php if ( comments_open() || '0' != get_comments_number() ) : ?>
					
								<div class="comment-block">

									<?php comments_template(); ?>

								</div>
								
							<?php endif;?>

							<?php endwhile; ?>


						</div><!-- ./col-sm-12 -->

					</div><!-- ./row -->

				</div><!-- ./container -->

	    <!-- END Main -->
		</div>


<?php
/* Load Footer */
get_footer();
?>