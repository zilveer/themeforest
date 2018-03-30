<?php
/**
* 
*Template Name: Contact Us
* 
* @author : VanThemes ( http://www.vanthemes.com )
* @license : GNU General Public License version 2.0
*/
get_header(); 
$van_page_type = van_page_type(); 
?>

<?php van_breadcrumb(); ?>

<div id="main-content"  class="<?php echo $van_page_type['type'] . ' ' . $van_page_type['container']; ?>">

	<div id="single-outer">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( array('content','post-inner') ); ?>>
					
					<div class="entry-container">

						<header id="entry-header">
							<h1 class="entry-title">
								<?php the_title(); ?>
							</h1><!-- .entry-title -->
						</header>

						<div class="entry-content">

							<?php the_content(); ?>
							 
							<div id="contact">
								<p class="message" style="display:none;"></p>
								<form action="<?php the_permalink(); ?>" id="contactform" method="post">
									<p>
										<label for="msg-name"><?php _e("Name:","van"); ?><span class="required">*</span></label>
										<input type="text" id="msg-name" name="msg_name" style=" width: 40%; display: block; " value="<?php if( isset( $_POST['msg_name'] ) ) {echo esc_attr($_POST['msg_name']); } ?>">
									</p>
									<p>
										<label for="msg-email"><?php _e("Email:","van"); ?><span class="required">*</span></label>
										<input type="text" id="msg-email"  name="msg_email" style=" width: 40%; display: block; " value="<?php if( isset( $_POST['msg_email'] ) ) {echo esc_attr($_POST['msg_email']);} ?>">
									</p>
									<p>
										<label for="msg-text"><?php _e("Message:","van"); ?><span class="required">*</span></label>
										<textarea type="text" id="msg-text" name="msg_text" rows="8"><?php if( isset( $_POST['msg_text'] ) ) { echo esc_textarea($_POST['msg_text']);} ?></textarea>
									</p>
									<?php $human1 = substr(rand(0,9),0,1); $human2= substr(rand(0,9),0,1); ?>
									<p class="msg-human">
										<label for="msg-human"><?php _e("Human Verification: ","van"); ?><span class="required">*</span> <?php echo $human1  . " + " .  $human2 . " = "; ?></label>
										<input type="text" id="msg-human" style="width: 60px;margin-right: 8px;" name="msg_human"><span style="display:none" class="btn-loading"></span>
									</p>
									<p>
										<input type="submit" value="<?php _e('Send', 'van'); ?>">
									</p>
									<input type="hidden" id ="human1" name="human1" value="<?php echo $human1; ?>">
									<input type="hidden" id ="human2" name="human2" value="<?php echo $human2; ?>">
								</form>
							</div>

							<?php wp_link_pages(array('before' => '<p><strong>'.__( 'Pages:','van').'</strong> ', 'after' => '</p>')); ?>										
						
							<?php edit_post_link( __( '(Edit)', 'van' ), '<span class="edit-post">', '</span>' ); ?>
				
						</div><!-- .entry-content -->
						
					</div><!-- .entry-container -->

				</article>

			<?php endwhile; ?>

		<?php endif;  ?>

		<?php comments_template( '', true ); ?>

	</div> <!-- #single-outer -->

</div><!-- #main-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>