<?php
/**
 Template Name: Contact Page
 **/
$tpl_body_id = 'contactpage';
get_header(); 
global $postParentPageID,$data;
$postParentPageID = $post->ID; //Page POSTID


//comments enabled OR not checking
$comment_status = $post->comment_status;

//comments enabled OR not checking
$CommentsEnabled = false;
if ( $data['wm_show_comments'] == 1  && $comment_status != "closed" ){
	$CommentsEnabled = true;
}elseif ( $data['wm_show_comments'] != 0   && $comment_status != "closed"  ) {
	$CommentsEnabled = true;
}

?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<!--Page title start-->
			<?php if ( $data['wm_show_page_post_headers'] == "" || $data['wm_show_page_post_headers'] == "0" ) {?>
            <div class="row header">
                <div class="blog_title">
                    <h2 class="title-page"><?php the_title(); ?></h2>
                </div>
            </div>
			<?php } else { ?>
            <div class="row header">
                <div class="blog_title">
                    <h2 class="title-page"></h2>
                </div>
            </div>
			<?php } ?>
			<!--Page title ends-->
			
			<!-- Begin Breadcrumbs -->
			<div class="row">
				<div class="twelve columns">
					<?php if ( function_exists('yoast_breadcrumb') ) {
						yoast_breadcrumb('<p id="breadcrumbs" class="yoast-bc">','</p>');
					} ?>
				</div>
			</div>
			<!-- End Breadcrumbs -->

			<!--Contact Form Start-->          
            <div class="row">
            	<div class="blog page_content">
					<div class="blog_block_left">
                    	<div class="blog_post">                                                    
                        	<div class="blog_text"><?php the_content(); ?></div>
                        </div>
                        <div class="blog_post">
                        	<form  action="php/contact-send.php" id="contact_form" method="post">
                                <div class="row">
								   <label class="form_label" for='form_name'><?php _e('Name', 'kslang'); ?></label>	
								   <input id="form_name"  type="text" class="six columns text center"  name="name" value="<?php _e('Name', 'kslang'); ?>">
                                </div>
                                
								<br/>   

                                <div class="row">
								 <label class="form_label" for='form_email'><?php _e('E-mail', 'kslang'); ?></label>
								 <input id="form_email"  type="text" class="six columns" name="email" value="<?php _e('E-mail', 'kslang'); ?>">
                                </div>
                                
								<br/>
                                
								<div class="row">
								   <label class="form_label" for='form_message'><?php _e('Message', 'kslang'); ?></label>
								   <textarea id="form_message" class="twelve columns" rows="12" name="message" placeholder="Message"></textarea>
                                </div>
                                
								<br/>
                                
								<div class="row">
								  <input id="form_submit" type="submit" class="send-link" value="<?php _e('Send message', 'kslang'); ?>">
                                </div>

								<!-- hidden input for basic spam protection -->
								<div class='hide'>
									<label for='spamCheck'>Do not fill out this field</label>
									<input id="spamCheck" name='spam_check' type='text' value='' />
								</div>
                            </form>

							<!-- This div will be shown if mail was sent successfully -->		
							<div class="hide success">
								<p><?php if ( $data['wm_contact_email_template']!= "" ) {?><?php echo $data['wm_contact_email_template'];?><?php } else { ?><?php _e('Thank you for contacting us! Your message has been successfully delivered and we will be getting in touch real soon!', 'kslang'); ?><?php } ?></p>
							</div>

                        </div>
                    </div>

					<!-- Sidebar -->
                    <div class="sidebar_contact blog_block_right">
						<?php if ( !function_exists('generated_dynamic_sidebar') || !generated_dynamic_sidebar("Contact Page Sidebar") ) : ?>
						<?php endif; ?>
                    </div>
					<!-- Sidebar ends here--> 

                </div>  
            </div>
            <!--Contact Form End-->
	
<?php endwhile; endif; ?>

<?php get_footer(); ?>
