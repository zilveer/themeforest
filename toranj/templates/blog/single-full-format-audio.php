<?php
/**
 *  format-audio
 * 
 * @package toranj
 * @author owwwlab
 */

?>

<?php if ( has_post_thumbnail() ): ?>
<!-- Post header -->
<div id="post-header" class="parallax-parent">

	<!-- Header image -->
	<div class="header-cover set-bg">
		<?php the_post_thumbnail('full',array(
			'class' => 'img-fit'
		)); ?>
	</div>
	<!-- /Header image -->

	<!-- Header content -->
	<div class="header-content tj-parallax" data-ratio="1">
		<div class="container">
			<h1 class="post-title">
				<?php the_title(); ?>
			</h1>
		</div>
	</div>
	<!-- /Header content -->
	

</div>
<!-- /Post header -->
<?php endif; ?>


<div class="container">

	<!-- Post body -->
	<div id="post-body">
		<div class="row">

			<!-- Post sidebar -->
			<div id="post-side" class="col-md-3">

				<!-- Post meta -->
				<div class="post-meta">
					<?php owlab_post_meta_single_full(); ?>
				</div>
				<!-- /Post meta -->

				<?php owlab_sharing_btns_style1(); ?>

			</div>
			<!-- /Post sidebar -->

			<!-- Post main area -->
			<div class="col-md-9">
				<div class="post mb-xlarge">
					<?php if ( !has_post_thumbnail() ): ?>
					<h1 class="lined"><?php the_title(); ?></h1>
					<?php endif; ?>

					<div class="mb-large post-format-audio">
			
					<?php 
						$audio = get_post_meta(get_the_ID() , 'audio' , true);
				        $mp3 = get_post_meta(get_the_ID() , 'mp3' , true);
				        $ogg = get_post_meta(get_the_ID() , 'ogg' , true);
				        
				        //if we have the embeded audio we dont need the mp3 and the image of the post
				        if($audio != '')
				        {
				            echo '<div class="embed-audio-code">' . $audio .'</div><!-- end audio code -->';
				        }
				        elseif($mp3 != '' || $ogg != '') 
				        {

							if ( has_post_thumbnail() && ! post_password_required() ) 
							{
								echo '<a href="';the_permalink();echo'">';
									the_post_thumbnail('blog-thumb',array(
										'class' => 'img-fit'
									)); 	
								echo "</a>";
							}
						?>
							<div class="audio-wrapper">
			                    <!-- wrap -->
			                    <div class="me-wrap">
			                        <audio class="mejs-player video-html5">
										<source src="<?php echo $ogg; ?>" type="audio/ogg">
										<source src="<?php echo $mp3; ?>" type="audio/mpeg">
			                        	<p><?php echo __('Your browser does not support the audio element.' , 'toranj'); ?></p>
			                        </audio> 
			                     </div><!-- end wrap -->
			            	</div><!-- end audio wrapper -->

			            <?php } ?>
					</div>


					<?php include(locate_template(OWLAB_TEMPLATES . '/blog/single-full-content.php')); ?>