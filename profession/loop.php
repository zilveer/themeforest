<div  <?php post_class(); ?> id="post_<?php the_ID(); ?>">

	<?php 
			
		$content_type = get_post_meta(get_the_ID(), 'content_type', true);
		$vType = get_post_meta(get_the_ID(), 'video_server', true);
		$vID = get_post_meta(get_the_ID(), 'video_id', true); 
		
		$content_span = 'span4';
		
		if(opt('blog_sidebar_position') == 0)
			$content_span = 'span7';
	?>
		
	<!-- item  -->
	<div class="row clearfix">
	
	<?php if ( $content_type == 2 || $content_type == 3  ){ ?>

		<div class="post-image span5">

			<?php if($vType == '' || $vType == '1') { ?>
			
				<iframe width="380" height="220" src="http://www.youtube.com/embed/<?php echo $vID; ?>" ></iframe>
		
			<?php } else { ?>	
				
				<iframe src="http://player.vimeo.com/video/<?php echo $vID; ?>?color=f0e400" width="380" height="220"></iframe>
			
			<?php } ?>
							
		</div>
						
	<?php } else { ?>
	
		<?php if ( has_post_thumbnail() ){ ?>
		
			<div class="post-image span5">
				<?php the_post_thumbnail('full'); ?>
				<a title="<?php printf( esc_attr__('Permalink to %s', TEXTDOMAIN), the_title_attribute('echo=0') ); ?>" href="<?php the_permalink(); ?>" rel="bookmark"><div class="post-hover"></div></a>
			</div>
			
		<?php } else {  $content_span = 'span9'; } ?>
		
	<?php } ?>
	
		<div class="post-content <?php echo $content_span; ?>">
			<div class="blog-post-title">
				<h5>
					<a title="<?php printf( esc_attr__('Permalink to %s', TEXTDOMAIN), the_title_attribute('echo=0') ); ?>" href="<?php the_permalink(); ?>" rel="bookmark"><?php echo px_filter ( get_the_title() ? get_the_title() : get_the_time('F j') ); ?></a>
				</h5>
			</div>
			<div class="blog-post-seperator"></div>
			<div class="blog-post-meta">
				<?php echo ( get_the_time('F') ); ?>  &nbsp;<?php echo ( get_the_time('Y') ); ?> / <?php echo ( get_the_time('j') ); ?> <span class="blog-post-meta-seperator">|</span>
				<span class="post_comments"><?php comments_popup_link( __('No Comments', TEXTDOMAIN) , __('1 Comment', TEXTDOMAIN), __('% Comments', TEXTDOMAIN) ); ?></span>
			</div>
			<div class="blog-post-content">
				<?php the_excerpt(); ?>
			</div>
		</div>
	</div>	
	<!-- item  Ends -->
</div>