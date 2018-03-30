<?php
// Template Name: Page Event
 ?>
 
<?php
get_header(); 




$sidebar_id = get_meta_option('custom_sidebar', $post->ID);
$sidebar_position = get_meta_option('sidebar_position_meta_box', $post->ID);
$sidebar_class = 'col-lg-12 col-md-12 col-sm-12';
$comm = $post->comment_status;


if($sidebar_position == '') {
	$sidebar_position = 'full';
}


	if( $sidebar_position == 'left' ) { 
	$sidebar_class = 'col-lg-9 col-md-9 col-sm-8 col-lg-push-3 col-md-push-3 col-sm-push-4';
	 }
	if( $sidebar_position == 'right' ) { 
	$sidebar_class = 'col-lg-9 col-md-9 col-sm-8';
	 }
	if( $sidebar_position == 'full' ) {
	$sidebar_class = 'col-lg-12 col-md-12 col-sm-12';
	 }  
?>
   
   

<section id="content">	
			
			<!-- Page Heading -->
			<section class="section page-heading animate-onscroll">
				
				<div class="row">
					<div class="col-lg-9 col-md-9 col-sm-9">
						
						<h1 class="entry-title" ><?php echo esc_html(get_the_title()); ?></h1>
						
						
						
						<?php if(get_option('sense_show_breadcrumb') == 'show') { ?>
						<?php candidat_the_breadcrumbs(); ?>
						<?php } ?>
	
					</div>

				</div>
				
			</section>
			<!-- Page Heading -->
	
		<!-- Section -->
		<section class="section full-width-bg gray-bg">
			
			<div class="row">
			
				<div class="<?php echo esc_attr($sidebar_class); ?>">
				
					<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>	

		<?php 
		if (  comments_open() &&  $comm == 'open' ) { ?>
			<!-- Post Comments -->
			<div class="post-comments">
				<h3 class="animate-onscroll"><?php _e( 'Comments', 'candidate' ); ?></h3>
				<ul>
				<?php comments_template( '', true ); ?>	
				</ul>			
			</div>
			<!-- /Post Comments -->
			<h3 class="animate-onscroll"><?php _e( 'Leave a reply', 'candidate' ); ?></h3>
			<p class="animate-onscroll"><?php _e( 'Your email address will not be published. Fields marked * are mandatory.', 'candidate' ); ?></p>
			
			<?php
				$comment_field = '<div class="col-lg-12 col-md-12 col-sm-12"><label>'. __( 'Comment*', 'candidate' ) .'</label>
								<textarea  rows="10" name="comment" ></textarea>
								</div>';
				$fields =  array(
				'author' => '<div class="col-lg-4 col-md-4 col-sm-4"><label>'. __( 'Name*', 'candidate' ) .'</label>
							<input type="text" name="author" value="" >
							</div>',  
				'email'  => '<div class="col-lg-4 col-md-4 col-sm-4"><label>'. __( 'E-mail*', 'candidate' ) .'</label>
							<input type="email" name="email" value="" >
							</div>',  
				'url'    => '<div class="col-lg-4 col-md-4 col-sm-4"><label>'. __( 'Website', 'candidate' ) .'</label>
							<input type="text" name="url" value="" >
							</div>'  
				);   
				
			
				
				$comments_args = array(
						'fields' => (apply_filters( 'comment_form_default_fields', $fields )),
						'id_form'=>'comment-form',
						'id_submit' => 'submit_none',
						'label_submit' => '',
						'title_reply' => '',  
						'title_reply_to' => __( '<h4 style="margin-top:0; margin-bottom:10px;" >Leave a Reply to %s</h4>', 'candidate' ),   
						'cancel_reply_link' => __( '<h4 style="margin-top:0; margin-bottom:5px;" >Cancel reply</h4>', 'candidate' ),  					
						'comment_field' => $comment_field,
						'comment_notes_before' => '',
						'comment_notes_after'=>'<input type="submit" name="submit" value="'. __( 'Post Comment', 'candidate' ) .'">'
						);
						
				comment_form($comments_args);
			?>
			<?php } ?>
				
		
				</div>

				
				<!-- Sidebar -->
			    <?php 
				if( $sidebar_position != 'full' ) {
					if( $sidebar_position == 'left' ) { ?>
					<div class="col-lg-3 col-md-3 col-sm-4 col-lg-pull-9 col-md-pull-9 col-sm-pull-8 sidebar">
					<?php } if( $sidebar_position == 'right' ) { ?>
					<div class="col-lg-3 col-md-3 col-sm-4 sidebar">
					<?php } ?>
					
					<?php candidat_mm_sidebar('blog',$sidebar_id);?>
					</div>
				<?php } ?>

			</div>
	
		</section>
		<!-- /Section -->
		
	</section>

<?php get_footer(); ?> 