<?php
/**
 *	Template Name: Blog Page Left
 *
 * The template for displaying blog posts
 */

get_header();
the_post();
$journal_grid_no = (empty($smof_data['journal_grid_no'])) ? 4 : $smof_data['journal_grid_no'];
$show_details_outside = $smof_data['journal_details_outside'];

$sidebar_layout = 'left';

$enable_infinitescroll = $smof_data['journal_infinitescroll'];
$subtitle = rwmb_meta("subtitle");

$header_image = rwmb_meta('header_image',array('type' => 'file' ));
$header_bg_color = rwmb_meta('header_bg_color');

$enable_sidebar = 1;

$journal_category = rwmb_meta("base_category"); ?>

</section>
<?php 
if ( $header_image && count($header_image)>0 ) :
				foreach ( $header_image as $himggg ) :
			  	if (empty($himggg)) break; 
			  	if ( $header_bg_color ) : ?>
					<div class="flat_pagetop" style="color:<?php echo $header_bg_color; ?> !important;background:url(<?php echo $himggg['url'];?>);">
				<?php else : ?>
					<div class="flat_pagetop" style="background:url(<?php echo $himggg['url']; ?>);">
				<?php endif; ?>
<?php break; endforeach;

else :
 ?>
	<div class="flat_pagetop">
<?php endif; ?>
		<section id="content" class="container">

		<div class="grid12 col">
<?php if ( !$enable_infinitescroll || !empty($subtitle) ) : ?>
			<h1 class="page-title left"><?php the_title(); ?></h1>
			<div class="subtitle">
				<p class="small gray"><?php echo $subtitle; ?></p>
			</div>
			<div class="clear"></div>
<?php else :
	if (!empty($journal_category) && $journal_category != 0 ) {
		$categories = get_categories(array(
			'child_of' => $journal_category,
			'hide_empty' => 1
		));
	} else {
		$categories = get_categories();
	}
	$count = count($categories); ?>
				<h1 class="page-title<?php if ( $count>1 ) echo " left"; ?>"><?php the_title(); ?></h1>
<?php 	if ( $count>1 ) : ?>
			<div class="subtitle">
				<p class="filter isotope-filter">
					<a href="#" data-value="all" class="active"><?php _e( 'All', 'flatbox' ); ?></a>
<?php foreach ($categories as $key => $value) : ?>
					<a href="#" data-value="category-<?php echo $value->slug; ?>"><?php echo $value->name; ?></a>
<?php endforeach; ?>
				</p>
			</div>
			<div class="clear"></div>
<?php 	endif; ?>
<?php endif; ?>
		</div>

</section>
	</div>
		<section id="content" class="container">

		<!-- <div class="grid12 col">
			<?php echo do_shortcode( get_the_content() ); ?>

		</div> -->


<?php if ($enable_sidebar) : ?>		

	<?php if ( $sidebar_layout!='right' ) : ?>

<div class="grid4 col">
	<p> </p>
	<div id="psidebar">
	<?php if ( is_active_sidebar( 'page-sidebar' )) dynamic_sidebar( 'page-sidebar' ); ?>
	</div>
</div>

	<?php endif; ?>

		<div class="grid8 col">

			<?php echo do_shortcode( get_the_content() ); ?>

<?php
$page_no = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
	'post_type' => 'post',
	'post_status' => 'publish',
	'paged' => $page_no
);
if (!empty($journal_category) && $journal_category != 0 ) {
	$args['cat'] = $journal_category;
}
query_posts($args);
if (have_posts()) : ?>
		<div class="clear"></div>
		<div class="isotope <?php if ($enable_infinitescroll) echo 'infinitescroll '; ?>clearfix">
<?php while(have_posts()) :
		the_post();
		$categories = get_the_category();
		$filter = '';
		foreach ($categories as $category_value) {
			$filter .= 'category-' . $category_value->slug . ' ';
		}
		$filter = trim($filter);
		if ( (function_exists('has_post_thumbnail')) && has_post_thumbnail() ) :
			$full_image_url = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
			$thumb_image_url = aq_resize( $full_image_url, 960, 500, true );
		else :
			$thumb_image_url = get_template_directory_uri().'/img/480x320.gif';
		endif;

		$post_type = rwmb_meta("post_type2");

		 ?>




<!-- 
			<div class="grid8 col isotope-item" data-id="item<?php the_id(); ?>" data-type="<?php echo $filter; ?>">
				<div class="thumb">
					<a href="<?php the_permalink(); ?>"><img src="<?php echo $thumb_image_url; ?>" class="scale" alt="" /></a>
					<div class="info pattern">
<?php if ($show_details_outside) : ?>
						<a href="<?php the_permalink(); ?>" class="button-link"></a>
<?php else: ?>
						<div class="text">
							<strong><?php the_title(); ?></strong>
							<em class="date"><span></span><?php the_time(get_option('date_format') . ' ' . get_option('time_format')); ?></em>
						</div>
<?php endif; ?>
					</div>
				</div>
<?php if ($show_details_outside) : ?>
				<h5 class="bold_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
				<p class="btitledate"><span class="firasdate"><span class="icon-date-gray"></span><?php the_time(get_option('date_format') . ' ' . get_option('time_format')); ?></span></p>
				<div class="btitletext"><?php the_excerpt(); ?></div>
<?php endif; ?>
			</div>

 -->
 <?php if ($show_details_outside) : ?>
<div class="grid8 col isotope-item" data-id="item<?php the_id(); ?>" data-type="<?php echo $filter; ?>">
			
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
            <div class="audio_blog_post blog_item">
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
			<div class="audio_blog_post blog_item">

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

			<div class="note_blog_post blog_item"> 

<?php elseif ($post_type == 'value5') : 

$b_link = rwmb_meta('blog_link_url');
 ?>            	
<div class="link_post">
 			
 				
 					
 					<h5 class="normal_title"><span class="link_post_img"></span><a class="link_post_title" href="<?php echo $b_link ; ?>"><?php the_title(); ?></a></h5>

 					<p>
						<?php echo $b_link ; ?>
 					</p>


 			
</div>

			<div class="link_blog_post blog_item"> 
<?php else :  ?>    


	 	<div class="thumb blog_item">
					<a href="<?php the_permalink(); ?>"><img src="<?php echo $thumb_image_url; ?>" class="scale" alt="" /></a>
					<div class="info pattern">
		
						<a href="<?php the_permalink(); ?>" class="button-link"></a>

					</div>
				</div>
			<div class="blog_post blog_item"> 
<?php endif; ?>

<?php if (!($post_type == 'value5')) :  ?>    
				<h5 class="normal_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
<?php endif; ?>			      
				<div class="metablog">
					<p class="btitledate"><span class="firasdate"><span class="icon-date"></span><?php the_time(get_option('date_format') . ' ' . get_option('time_format')); ?></span></p>
				<?php if( function_exists('zilla_likes') ) {?>
				<span class="firasdate zlike">
					<?php if( function_exists('zilla_likes') ) zilla_likes(); ?>
				</span>
				<?php }?>

			</div>
				<div class="clearfix"></div>
				<div class="btitletext small_text3"><?php the_excerpt(); ?></div>
			</div>
</div>
<?php else: ?>
	<div class="grid8 col isotope-item" data-id="item<?php the_id(); ?>" data-type="<?php echo $filter; ?>">
				<ul class="grid ngrid-s cs-style-3" id="firas" >
					<li>
						<figure>
							<img src="<?php echo $thumb_image_url; ?>" href="<?php echo $full_image_url; ?>" alt="img04">
							<figcaption>
								<h3><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
								<span><?php the_time(get_option('date_format') . ' ' . get_option('time_format')); ?></span>
								
								<a href="<?php echo $full_image_url; ?>" class="fullsize car_fullport"></a>
								<?php if( function_exists('zilla_likes') ) {?>
							<div href="<?php the_permalink(); ?>" class="car_like2"><?php if( function_exists('zilla_likes') ) zilla_likes(); ?></div>				
								<?php }?>
							</figcaption>
						</figure>
					</li>
					</ul>
			</div>

<?php endif; ?>



<?php endwhile; ?>
		</div>
		

		<div class="clear"></div>
		<?php pagination_links(); ?>
		<div class="clear"></div>
<?php
	else:
		get_template_part( 'noresult' );
	endif; ?>
</div>

<?php if ( $sidebar_layout=='right' ) : ?>


<div class="grid4 col">
	<p> </p>
	<div id="psidebar">
	<?php if ( is_active_sidebar( 'page-sidebar' )) dynamic_sidebar( 'page-sidebar' ); ?>
	</div>
</div>

<?php endif; ?>















<?php else: ?>

		<!-- <div class="grid12 col">
			<?php echo do_shortcode( get_the_content() ); ?>

		</div> -->
		

			<?php echo do_shortcode( get_the_content() ); ?>

<?php
$page_no = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
	'post_type' => 'post',
	'post_status' => 'publish',
	'paged' => $page_no
);
if (!empty($journal_category) && $journal_category != 0 ) {
	$args['cat'] = $journal_category;
}
query_posts($args);
if (have_posts()) : ?>
		<div class="clear"></div>
		<div class="isotope <?php if ($enable_infinitescroll) echo 'infinitescroll '; ?>clearfix">
<?php while(have_posts()) :
		the_post();
		$categories = get_the_category();
		$filter = '';
		foreach ($categories as $category_value) {
			$filter .= 'category-' . $category_value->slug . ' ';
		}
		$filter = trim($filter);
		if ( (function_exists('has_post_thumbnail')) && has_post_thumbnail() ) :
			$full_image_url = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
			$thumb_image_url = aq_resize( $full_image_url, 960, 420, true );
		else :
			$thumb_image_url = get_template_directory_uri().'/img/480x320.gif';
		endif; 
		$post_type = rwmb_meta("post_type2");
		?>



<!-- 			<div class="grid<?php echo $journal_grid_no; ?> col isotope-item" data-id="item<?php the_id(); ?>" data-type="<?php echo $filter; ?>">
				<div class="thumb<?php echo $smof_data['css3_animation_class']; $allClasses = get_post_class(); foreach ($allClasses as $class) { echo " " . $class; } ?>">
					<a href="<?php the_permalink(); ?>"><img src="<?php echo $thumb_image_url; ?>" class="scale" alt="" /></a>
					<div class="info pattern">
<?php if ($show_details_outside) : ?>
						<a href="<?php the_permalink(); ?>" class="button-link"></a>
<?php else: ?>
						<div class="text">
							<strong><?php the_title(); ?></strong>
							<em class="date"><span></span><?php the_time(get_option('date_format') . ' ' . get_option('time_format')); ?></em>
						</div>
<?php endif; ?>
					</div>
				</div>
<?php if ($show_details_outside) : ?>
				<h5 class="bold"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
				<p class="smaller"><span class="icon-date-gray"></span><?php the_time(get_option('date_format') . ' ' . get_option('time_format')); ?></p>
				<div class="small"><?php the_excerpt(); ?></div>
<?php endif; ?>
			</div>
 -->
<?php if ($show_details_outside) : ?>
		<div class="grid<?php echo $journal_grid_no; ?> col isotope-item" data-id="item<?php the_id(); ?>" data-type="<?php echo $filter; ?>">
					
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
            <div class="audio_blog_post blog_item">
<?php elseif ($post_type == 'value2') : 
$videos = rwmb_meta('blog_video');
 ?>            	
			<?php if ( $videos && count($videos)>0 ) :
				foreach ( $videos as $video ) :
			  	if (empty($video)) break; ?>
					<div class="video-container  video_post2">
						<div class="video-wrapper  video_post2">
							<?php echo $video; ?>
						</div>
					</div>
			<?php break; endforeach; ?>
			<?php endif; ?>
			<div class="audio_blog_post blog_item">

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

			<div class="note_blog_post blog_item"> 

<?php elseif ($post_type == 'value5') : 
 
$b_link = rwmb_meta('blog_link_url');
 ?>            	
<div class="link_post">
 			
 				
 					
 					<h5 class="normal_title"><span class="link_post_img"></span><a class="link_post_title" href="<?php echo $b_link ; ?>"><?php the_title(); ?></a></h5>

 					<p>
						<?php echo $b_link ; ?>
 					</p>

</div>

			<div class="blog_post blog_item"> 
<?php else :  ?>    


	 	<div class="thumb blog_item">
					<a href="<?php the_permalink(); ?>"><img src="<?php echo $thumb_image_url; ?>" class="scale" alt="" /></a>
					<div class="info pattern">

						<a href="<?php the_permalink(); ?>" class="button-link"></a>

					</div>
				</div>
			<div class="blog_post blog_item"> 
<?php endif; ?>
	<div class="blog_post_title">
		<?php if (!($post_type == 'value5')) :  ?>    
				<h5 class="normal_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
			<?php endif; ?>
			</div>
				<!-- <p class="btitledate"><span class="firasdate"><span class="icon-date-gray"></span><?php the_time(get_option('date_format') . ' ' . get_option('time_format')); ?></span></p> -->
				<div class="metablog">
					<p class="btitledate"><span class="firasdate"><span class="icon-date"></span><?php the_time(get_option('date_format') . ' ' . get_option('time_format')); ?></span></p>
				<?php if( function_exists('zilla_likes') ) {?>
				<span class="firasdate zlike">
					<?php if( function_exists('zilla_likes') ) zilla_likes(); ?>
				</span>
				<?php }?>

				</div>
				<div class="clearfix"></div>

				<div class="small_text3"><?php the_excerpt(); ?></div>
		</div>

			</div>
<?php else: ?>
	<div class="grid<?php echo $journal_grid_no; ?> col isotope-item" data-id="item<?php the_id(); ?>" data-type="<?php echo $filter; ?>">
				<ul class="grid ngrid<?php echo $journal_grid_no; ?> cs-style-3" id="firas" >
					<li>
						<figure>
							<img src="<?php echo $thumb_image_url; ?>" href="<?php echo $full_image_url; ?>" alt="img04">
							<figcaption>
								<h3><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
								<span><?php the_time(get_option('date_format') . ' ' . get_option('time_format')); ?></span>
								
								<a href="<?php echo $full_image_url; ?>" class="fullsize car_fullport"></a>
<?php if( function_exists('zilla_likes') ) {?>
							<div href="<?php the_permalink(); ?>" class="car_like2"><?php if( function_exists('zilla_likes') ) zilla_likes(); ?></div>				
								<?php }?>
							</figcaption>
						</figure>
					</li>
					</ul>
			</div>

<?php endif; ?>










<?php endwhile; ?>
		</div>

		<div class="clear"></div>
		<?php pagination_links(); ?>
<?php
	else:
		get_template_part( 'noresult' );
	endif; ?>

<?php endif; ?>

<?php get_footer(); ?>