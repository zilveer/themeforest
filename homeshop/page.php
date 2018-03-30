<?php
/**

 * The template for about pages.

 */
 ?>

<?php
get_header(); 

$sidebar_position_mobile = get_option('sense_settings_sidebar_mobile');



$sidebar_id = get_meta_option('custom_sidebar', $post->ID);
$sidebar_position = get_meta_option('sidebar_position_meta_box', $post->ID);
$comm = $post->comment_status;
?>
   
   
   
   
   
     <?php 
	if( $sidebar_position != 'full'  && $sidebar_position_mobile == 'top' ) {
		if( $sidebar_position == 'left' ) { ?>
		<aside class="sidebar col-lg-3 col-md-3 col-sm-3">
		<?php } if( $sidebar_position == 'right' ) { ?>
		<aside class="sidebar right-sidebar col-lg-3 col-md-3 col-sm-3">
		<?php } ?>
		
		<?php mm_sidebar('blog',$sidebar_id);?>
		</aside>
	<?php } ?>
   
   
   
   
   
   <?php if( $sidebar_position == 'left' ) { ?>
	<section class="main-content s-left col-lg-9 col-md-9 col-sm-9">
	<?php }
	if( $sidebar_position == 'right' ) { ?>
	<section class="main-content col-lg-9 col-md-9 col-sm-9">
	<?php }
	if( $sidebar_position == 'full' ) { ?>
	<section class="main-content col-lg-12 col-md-12 col-sm-12">
	<?php }  ?>
   
   
   <div class="row">
                    	
		<div class="col-lg-12 col-md-12 col-sm-12">
			
			<div class="carousel-heading no-margin">
				<h4><?php echo esc_html(get_the_title()); ?></h4>
			</div>
			
			<div class="page-content">
  		   
		   <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		   <?php the_content(); ?>
		   <?php endwhile; ?>
   
			</div>
                            
		</div>
		  
	</div>
   

   
   
 <?php if(  "open" == $comm ) { ?>   
   
    
    <div class="row">
                    	
		<div class="col-lg-12 col-md-12 col-sm-12">
			
			<div class="carousel-heading no-margin">
				<h4><?php _e( 'Latest Comments', 'homeshop' ); ?></h4>
			</div>
			
			<div class="page-content">
				<ul class="comments">	
				<?php comments_template( '', true ); ?>		
				</ul>	
			</div>
                            
		</div>
		
	</div>
                 
   
   
   
   

    <div class="row">
                    	
		<div class="col-lg-12 col-md-12 col-sm-12">
			
			<div class="carousel-heading no-margin">
				<h4><?php _e( 'Add A Comment', 'homeshop'); ?></h4>
			</div>
			
			<div class="page-content">
   
   
   
                <div class="row">
                                	
				<div class="col-lg-6 col-md-6 col-sm-8">
	
				
				<?php
				$comment_field = '<label>'. __( 'Comment (required)', 'homeshop' ) .'</label>
								<textarea  name="comment" ></textarea>
								<br><br>';
				$fields =  array(
				'author' => '<label>'. __( 'Name (required)', 'homeshop' ) .'</label>
							<input type="text" name="author" value="" >
							<br><br>',  
				'email'  => '<label>'. __( 'E-mail (required, but will not display)', 'homeshop' ) .'</label>
							<input type="email" name="email" value="" >
							<br><br>',  
				'url'    => '<label>'. __( 'Website (required)', 'homeshop' ) .'</label>
							<input type="text" name="url" value="" >
							<br><br>'  
				);   
				
				$submit_btn = '<input type="submit" name="submit" value="'. __( 'Submit comment', 'homeshop' ) .'" class="dark-blue big">';
				
				
				$comments_args = array(
						'fields' => (apply_filters( 'comment_form_default_fields', $fields )),
						'id_form'=>'comment-form',
						'id_submit' => 'submit_none',
						'label_submit' => '',
						'title_reply' => '',  
						'title_reply_to' => __( '<h4 style="margin-top:0; margin-bottom:15px;" >Leave a Reply to %s</h4>', 'homeshop' ),   
						'cancel_reply_link' => __( '<h4 style="margin-top:0; margin-bottom:5px;" >Cancel reply</h4>', 'homeshop' ),  					
						'comment_field' => $comment_field,
						'comment_notes_after'=>$submit_btn
						);
						
				comment_form($comments_args);?>


				</div>
				  
				</div>
		   
   
   
   
			</div>
                            
		</div>
		  
	</div>
   
   <?php } ?>
   
   
   
   
    </section>
	<!-- /Main Content -->
   
   
   <?php 
	if( $sidebar_position != 'full'  && $sidebar_position_mobile != 'top' ) {
		if( $sidebar_position == 'left' ) { ?>
		<aside class="sidebar col-lg-3 col-md-3 col-sm-3">
		<?php } if( $sidebar_position == 'right' ) { ?>
		<aside class="sidebar right-sidebar col-lg-3 col-md-3 col-sm-3">
		<?php } ?>
		
		<?php mm_sidebar('blog',$sidebar_id);?>
		</aside>
	<?php } ?>
   
   
   
   

<?php get_footer(); ?>






