<?php
/**
 * The Template for displaying all single posts.
 *
 */
get_header();


global $page_id; 
$page_id = $post->ID;

$sidebar_id = get_meta_option('custom_sidebar');
$sidebar_position = get_meta_option('sidebar_position_meta_box');

$views   = get_post_meta(get_the_ID(), "views", true);
$views = $views + 1;

update_post_meta(get_the_ID(), "views", $views);



$comm = $post->comment_status;

$category = get_the_category();
$tags_list = get_the_tag_list( '', ', ' );
$num_comments = absint(get_comments_number());
$format = 'standard';
if(get_post_meta($post->ID,'meta_blogposttype',true) && get_post_meta($post->ID,'meta_blogposttype',true) !=''){
$format = get_post_meta($post->ID,'meta_blogposttype',true); 
}

?>



<?php if( $sidebar_position == 'left' ) { ?>
	<section class="main-content col-lg-9 col-md-9 col-sm-9 col-lg-push-3 col-md-push-3 col-sm-push-3">
	<?php }
	if( $sidebar_position == 'right' ) { ?>
	<section class="main-content col-lg-9 col-md-9 col-sm-9">
	<?php }
	if( $sidebar_position == 'full' ) { ?>
	<section class="main-content col-lg-12 col-md-12 col-sm-12">
	<?php }  ?>
   
   <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
   
   <div class="row">
                    	
		<div class="col-lg-12 col-md-12 col-sm-12">
			
			<div class="carousel-heading">
				<h4><?php echo esc_html(get_the_title()); ?></h4>
			</div>
			
		</div>		
		
		
		 <div class="col-lg-12 col-md-12 col-sm-12">
                        	
			<div <?php post_class('blog-item'); ?> >
		
			<?php get_template_part( '/postformats/' . $format . '-format' ); ?>
		
			
			
			
			<div class="blog-info">
				<div class="blog-meta">
					<span class="date"><i class="icons icon-clock"></i> <?php  the_time('d M Y'); ?></span>
					<span class="cat"><i class="icons icon-tag"></i> <?php echo get_the_category_list( ', ', 'multiple', $post->ID ); ?></span>
					<span class="views"><i class="icons icon-eye-1"></i> <?php echo absint($views); ?> <?php _e( 'times', 'homeshop' ); ?></span>
					
					<div class="rating-box">
					<?php if(PostRatings()->getControl($post->ID, true)) { ?>
						<?php echo PostRatings()->getControl($post->ID, true); ?>
					<?php } ?>
					</div>
				</div>
				
				<?php the_content(); ?>

		
				<div class="social-share">
					<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px; width:100px;" allowTransparency="true"></iframe>
					
					<iframe allowtransparency="true" frameborder="0" scrolling="no"
					src="https://platform.twitter.com/widgets/tweet_button.html"
					style="width:100px; height:20px;"></iframe>

					<!-- Place this tag where you want the +1 button to render. -->
					<div class="g-plusone" data-size="medium"></div>
					
					<!-- Place this tag after the last +1 button tag. -->
					<script type="text/javascript">
					  (function() {
						var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
						po.src = 'https://apis.google.com/js/platform.js';
						var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
					  })();
					</script>
					
					
					<a href="//www.pinterest.com/pin/create/button/?url=http%3A%2F%2Fwww.flickr.com%2Fphotos%2Fkentbrew%2F6851755809%2F&media=http%3A%2F%2Ftest.ratkosolar.com%2Fhomeshop%2F15-blog_post.html&description=Next%20stop%3A%20Pinterest" data-pin-do="buttonPin" data-pin-config="beside"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png" /></a>
					<!-- Please call pinit.js only once per page -->
					<script type="text/javascript" async src="//assets.pinterest.com/js/pinit.js"></script>
					
				</div>
			
			</div>
			
			
			
			
			<div class="product-actions blog-actions-big">
				<span class="product-action blog_add_comment">
					<span class="action-wrapper">
					<a href="#comment-form">
						<i class="icons icon-pencil-1"></i>
						<span class="action-name"><?php esc_html_e( 'Add New Comment', 'homeshop' ); ?></span>
					</a>	
					</span>
				</span>
				<span class="product-action red">
					<span class="action-wrapper">
					<a href="#" class="print" onclick="window.print();" target="_blank" >
						<i class="icons icon-doc-text"></i>
						<span class="action-name"><?php esc_html_e( 'Print page', 'homeshop' ); ?></span>
					</a>	
					</span>
				</span>
				<span class="product-action home-green">
					<span class="action-wrapper">
					<a href="mailto:?body=<?php echo esc_url(get_permalink()); ?>" class="email" >
						<i class="icons icon-mail"></i>
						<span class="action-name"><?php esc_html_e( 'Send email', 'homeshop' ); ?></span>
					</a>
					</span>
				</span>
			</div>
			
			
			
			
		
			</div>
			
		</div>	
		
		<?php echo homeshop_link_pages(); ?>
		
	</div>

	<?php endwhile; // end of the loop. ?>
	
	
	<div class="row">
		
		<div class="col-lg-12 col-md-12 col-sm-12">
			
			<div class="carousel-heading no-margin">
				<h4><?php esc_html_e( 'Latest from', 'homeshop' ); ?></h4>
			</div>
			
			<div class="page-content">
				<ul>
				<?php homeshop_the_recent_posts(5); ?>
				</ul>
			</div>
                            
			<div class="page-content-footer">
				<p><?php esc_html_e( 'More in this category', 'homeshop' ); ?>: <a href="<?php echo esc_url(get_category_link( $category[0]->cat_ID )); ?>"><?php echo $category[0]->cat_name; ?> <i class="icons icon-right-dir"></i></a></p>
			</div>
		</div>
		
	</div>
                    
	
	
	
	
	
	
	
	
	
	
	 <?php if(  "open" == $comm ) { ?>   
   
    
    <div class="row">
                    	
		<div class="col-lg-12 col-md-12 col-sm-12">
			
			<div class="carousel-heading no-margin">
				<h4><?php esc_html_e( 'Latest Comments', 'homeshop' ); ?></h4>
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
				<h4><?php esc_html_e( 'Add A Comment', 'homeshop' ); ?></h4>
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
   
	
	
	
	
	
	
	
	
	<!-- Product Buttons -->
	<div class="row button-row">
		
		<div class="col-lg-5 col-md-5 col-sm-5">
		</div>

		<div class="col-lg-7 col-md-7 col-sm-7 align-right">
		
			<?php  
				if(get_adjacent_post() !='' && get_adjacent_post(0,'',0) != '') {
					previous_post_link( '%link', '<i class="icons icon-left-dir"></i> '. __( 'Prev Post', 'homeshop' ) .'' ); 
					next_post_link( '%link', ''. __( 'Next Post', 'homeshop' ) .' <i class="icons icon-right-dir"></i>' ); 
				} else {
				previous_post_link( '%link', '<i class="icons icon-left-dir"></i> '. __( 'Prev Post', 'homeshop' ) .'' ); 
				next_post_link( '%link', ''. __( 'Next Post', 'homeshop' ) .' <i class="icons icon-right-dir"></i>' ); 
				}	
			?> 
				
		</div>
	
	</div>
	<!-- /Product Buttons -->
	
	
	
	
    </section>
	<!-- /Main Content -->
   
   
   <?php 
	if( $sidebar_position != 'full' ) {
		if( $sidebar_position == 'left' ) { ?>
		<aside class="sidebar col-lg-3 col-md-3 col-sm-3  col-lg-pull-9 col-md-pull-9 col-sm-pull-9">
		<?php } if( $sidebar_position == 'right' ) { ?>
		<aside class="sidebar right-sidebar col-lg-3 col-md-3 col-sm-3">
		<?php } ?>
		
		<?php mm_sidebar('blog',$sidebar_id);?>
		</aside>
	<?php } ?>
   
  
<?php get_footer(); ?>
		
	