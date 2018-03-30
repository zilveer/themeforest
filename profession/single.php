<?php 
	get_header();
	
	// Intro
	get_template_part('article', 'menu'); 
	
	$postType = get_post_meta(get_the_ID(), 'content_type', true);

?>

<div class="blog-content wrap">
	<div class="container">
		<div class="blog-detail-header span12"></div>
		<div class="row clearfix">
			<?php 
		
				$blogClass = 'span9';
				
				if(opt('blog_sidebar_position') == 0)
					$blogClass = 'span12';

			?>
			<div class="<?php echo $blogClass; ?>">
				<!--post 1-->
				<div class="post blog-detail-post">
					
					<?php if ($postType == '2' || $postType == '3' ) {
					
						$vType = get_post_meta(get_the_ID(), 'video_server', true);
						$vID = get_post_meta(get_the_ID(), 'video_id', true);
						
					?>
						
						<div class="post_video">
						
							<?php if($vType == '' || $vType == '1') { ?>
							
								<iframe width="560" height="315" src="http://www.youtube.com/embed/<?php echo $vID; ?>" ></iframe>
						
							<?php } else { ?>	
								
								<iframe src="http://player.vimeo.com/video/<?php echo $vID; ?>?color=f0e400" width="500" height="281"></iframe>
							
							<?php } ?>
							
						</div>
					
					<?php } if( $postType == '1' ||  $postType == '3' ) { ?>
					
                    		<div class="flexslider">
				                <ul class="slides">
					                <?php 
					                for($i=1; $i <= 10; $i++)
                                        px_blog_detail_slide('post_image_'.$i);
					                ?>
				                </ul>
			                </div>
						
					<?php } ?>
								
							<?php if ( have_posts() )
									{ 
										while ( have_posts() ) { 
											the_post(); 
											get_template_part( 'content', 'single' ); 
										} 
										
									} ?>
						
					</div>	
					
				<div class="row">
					<div class="span8">
						<div class="blog_comments">
							<!-- Comments -->
							<?php 
								comments_template('', true); 
							?>
						</div>
					</div>
				</div>
			</div>

			<!--  Side bar -->
			<?php  if( opt('blog_sidebar_position') != 0) get_sidebar();  ?>	
		</div>
			
			
		</div>
	</div>
</div>
<?php get_footer(); 