<?php
/**
 * Template used for displaying single post information
 */

get_header();

the_post();
$journal_layout = (isset($smof_data['journal_layout'])) ? $smof_data['journal_layout'] : 'left';
$return_page = (isset($smof_data['journal_page'])) ? $smof_data['journal_page'] : '';

$header_image = rwmb_meta('header_image',array('type' => 'file' ));
$header_bg_color = rwmb_meta('header_bg_color');
$post_type = rwmb_meta("post_type2");

if ($return_page) {
	$return_page = get_permalink(get_page_by_path($return_page));
}
if ( (function_exists('has_post_thumbnail')) && has_post_thumbnail() ) :
	$post_thumb = get_the_post_thumbnail();
	$full_image_url = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
	$thumb_image_url = aq_resize( $full_image_url, 960, 640, true );
else :
	$thumb_image_url = get_template_directory_uri().'/img/480x320.gif';
endif; ?>

</section>
	<div class="flat_pagetop">
		<section id="content" class="container">
		<div class="grid12 col">
<?php if (!empty($return_page)) : ?>
			<h1 class="page-title left"><?php the_title(); ?></h1>
			<div class="subtitle">
				<p class="navigation"><a href="<?php echo $return_page; ?>" class="all no-border"><?php _e( 'View All Items', 'flatbox' ); ?><span></span></a></p>
			</div>
			<div class="clear"></div>
<?php else : ?>
			<h1 class="page-title"><?php the_title(); ?></h1>
<?php endif; ?>
		</div>

</section>
	</div>
		<section id="content" class="container">
			<p></p>

<?php if ( $journal_layout=='right' ) : ?>
		<div class="grid8 col">
						<div class="thumb<?php echo $smof_data['css3_animation_class']; ?>">
<?php if (!empty($full_image_url)) : ?>
				<a href="<?php echo $full_image_url; ?>" class="lightbox"><img src="<?php echo $thumb_image_url; ?>" class="scale" alt="" /></a>
				<div class="info pattern">
					<a href="<?php echo $full_image_url; ?>" class="button-fullsize"></a>
				</div>
<?php else : ?>
				<a><img src="<?php echo $thumb_image_url; ?>" class="scale" alt="" /></a>
<?php endif; ?>
			</div>


































<div class="inside_post">

 <?php if ($post_type == 'value3') :
 			$sfiles = rwmb_meta('sound_file',array('type' => 'file' ));
 			?><div class="audio_cont">
 			<audio preload="auto" class="blog-audio" controls><?php
 				foreach ( $sfiles as $sfile ) :
 					if (empty($sfile)) break;
					echo $sfile['url'];	?>
                    	<source src="<?php echo $sfile['url'];	?>">
					<?php
				endforeach; ?>
				</audio> 
				</div>
           
<?php elseif ($post_type == 'value2') : 
$videos = rwmb_meta('blog_video');
 ?>            	
			<?php if ( $videos && count($videos)>0 ) :
				foreach ( $videos as $video ) :
			  	if (empty($video)) break; ?>
					<div class="video-container video_post">
						<div class="video-wrapper video_post">
							<?php echo $video; ?>
						</div>
					</div>
			<?php break; endforeach; ?>
			<?php endif; ?>
		

	<?php elseif ($post_type == 'value4') : 
$notes = rwmb_meta('blog_note');
$a_note = rwmb_meta('blog_note_author');
 ?>            	
			
<div class="quote-note">
                        <blockquote>
                        <?php foreach ( $notes as $note ) :
			  				if (empty($note)) break; ?>
									<p><?php echo $note ?></p>
						<?php  endforeach; ?>
                        
                        	<cite><?php echo $a_note ?></cite></blockquote>
                        <div class="clear"></div>
                    </div>

			

<?php elseif ($post_type == 'value5') : 
 
$b_link = rwmb_meta('blog_link_url');
 ?>            	
<div class="link_post">
 					<h5 class="normal_title"><span class="link_post_img"></span><a class="link_post_title" href="<?php echo $b_link ; ?>"><?php the_title(); ?></a></h5>
 					<p>
						<?php echo $b_link ; ?>
 					</p>
</div>
			
<?php endif; ?>



</div>


































			<p class="btitledate">
			<div class="metablog">
				<span class="firasdate">
					<span class="icon-date"></span><?php the_time(get_option('date_format') . ' ' . get_option('time_format')); ?>
				</span>
				<?php if(has_tag( $tag, $post )){ ?>
				<span class="firasdate">
					<span class="icon-tag"></span><?php the_tags(); ?>
				</span>
				<?php } ?>
				<span class="firasdate">
					<span class="icon-comments"></span><a href="#comments"><?php comments_number(); ?></a>
				</span>
				<span class="firasdate zlike">
					<?php if( function_exists('zilla_likes') ) zilla_likes(); ?>
				</span>

			</div>
			</p>

		
			<div class="clearfix"></div>
			<p></p>
			<?php echo content() . do_shortcode($smof_data['single_post_extra']); wp_link_pages();  ?>
			<div class="clearfix"></div>
			<p></p>
				<?php comments_template( '', true ); ?>
			
			

		</div>
<?php endif; ?>
		<div class="grid4 col">
		<!-- 	<div class="thumb<?php echo $smof_data['css3_animation_class']; ?>">
<?php if (!empty($full_image_url)) : ?>
				<a href="<?php echo $full_image_url; ?>" class="lightbox"><img src="<?php echo $thumb_image_url; ?>" class="scale" alt="" /></a>
				<div class="info pattern">
					<a href="<?php echo $full_image_url; ?>" class="button-fullsize"></a>
				</div>
<?php else : ?>
				<a><img src="<?php echo $thumb_image_url; ?>" class="scale" alt="" /></a>
<?php endif; ?>
			</div> -->
		<!-- 	<p class="btitledate">
				<span class="firasdate">
					<span class="icon-date-gray"></span><?php the_time(get_option('date_format') . ' ' . get_option('time_format')); ?>
				</span>
			</p>
			<div class="clearfix"></div>
			<p class="btitledate">
				<span class="firasdate">
					<span class="icon-tag"></span><?php the_tags(); ?>
				</span>
			</p>
			<div class="clearfix"></div>
			<p class="btitledate">
				<span class="firasdate">
					<span class="icon-comments"></span><a href="#comments"><?php comments_number(); ?></a>
				</span>
			</p>
			<div class="clearfix"></div>
			<p></p> -->
			<!-- <div class="meta">

				<p class="smaller"><span class="icon-date"></span><?php _e( 'Posted on ', 'flatbox' ); echo the_time(get_option('date_format') . __( ' \a\t ', 'flatbox' ) . get_option('time_format')); ?></p>
<?php if (get_the_tags()) : ?>
				<p class="smaller"><span class="icon-tag"></span><?php the_tags(); ?></p>
<?php endif; ?>
				<p class="smaller"><span class="icon-comments"></span><a href="#comments"><?php comments_number(); ?></a></p>
			</div> -->

			<?php get_sidebar(); ?>
			<div class="clearfix"></div>
			<p></p>
			
		</div>
<?php if ( $journal_layout!='right' ) : ?>
		<div class="grid8 col">

			<?php echo content() . do_shortcode($smof_data['single_post_extra']); wp_link_pages(); ?>
			<div class="clearfix"></div>
			<p></p>
				<?php comments_template( '', true ); ?>

		</div>
<?php endif; ?>

<?php get_footer(); ?>