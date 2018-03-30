<?php 
global $ievent_data;

	if ($ievent_data['speaker_view']=='single-page'):
		get_header();
		$class_single='speaker-single-page';
	elseif ($ievent_data['speaker_view']=='pop-up'):
		$class_single='speaker-pop-up';
	endif;

		
?>

 <!-- BOF Main Content -->
    <div id="main" role="main" class="main">
        <div id="primary" class="content-area">
            <div class="container">
                <div class="sixteen columns jx-ievent-padding <?php echo $class_single; ?>">
                
                
                	<?php while ( have_posts() ) : the_post(); ?>
            
                        <?php get_template_part( 'template-parts/content', 'speakers' ); ?>
            
                    <?php endwhile; // End of the loop. ?>                    

                </div>

            </div>
            <!-- EOF Container -->
        </div><!-- #primary -->
    </div>
    
<?php 


	if ($ievent_data['speaker_view']=='single-page'):
		get_footer();
	endif;

 ?>
