<?php
/* 
 * Template Name: Contact
 *	
 * @package WordPress
 * @subpackage InTouch
 * @since InTouch 1.0
 *
 */

get_header(); ?>

<?php
$mb_sidebar_position = get_post_meta( $post->ID, 'ct_mb_sidebar_position', true);
$ct_breadcrumb = $ct_options['ct_breadcrumb'];

if ( $mb_sidebar_position == '' ) $mb_sidebar_position = 'right';

$col_lg_push = '';
$col_lg_pull = '';
$content_class = 'col-lg-8';
$sidebar_class = 'col-lg-4';

if ( $mb_sidebar_position == 'left-wide' ) :
	$col_lg_push = 'col-lg-push-4';
	$col_lg_pull = 'col-lg-pull-8';
elseif ( $mb_sidebar_position == 'right-narrow' ) :
	$content_class = 'col-lg-9';
	$sidebar_class = 'col-lg-3';
elseif ( $mb_sidebar_position == 'left-narrow' ) :
	$content_class = 'col-lg-9';
	$sidebar_class = 'col-lg-3';
	$col_lg_push = 'col-lg-push-3';
	$col_lg_pull = 'col-lg-pull-9';	
endif;
?>


<!-- InTouch -->
<?php if ( $ct_breadcrumb ) : ?>
<div class="entry-navigation">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="entry-breadcrumb ct-google-font">
					<?php ct_breadcrumb(); ?>
				</div><!-- .entry-breadcrumb -->
			</div><!-- .col-lg-12 -->
		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- .entry-navigation -->
<?php endif; ?>	


<?php if ( is_active_sidebar('ct_page_top') ): ?>
<!-- START TOP SINGLE WIDGETS AREA -->
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="top-widgets-area">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('ct_page_top') ) : ?>
				<?php endif; ?>
			</div> <!-- .top-widgets-area -->
		</div><!-- .col-lg-12 -->
	</div><!-- .row -->
</div><!-- .container -->
<!-- END TOP SINGLE WIDGETS AREA -->
<?php endif; ?>	

<div class="container">
	<div class="row">
		<div id="primary" class="site-content <?php echo $content_class.' '.$col_lg_push; ?>">
			<div id="content" role="main">
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>
						</header>

						<div class="entry-content clearfix">
							<?php the_content(); ?>

							<script  type="text/javascript">
								jQuery.noConflict()(function($){
									$(document).ready(function () { 
										$("#ajax-contact-form").submit(function () {
											var str = $(this).serialize();
											$.ajax( {
												type: "POST",
												url: "<?php echo get_template_directory_uri(); ?>/contact.php",
												data: str,
												success: function (msg)
											{
											
											$("#note").ajaxComplete(function (event, request, settings) {
												if (msg == 'OK') {
													result = '<div class="alert alert-success"><?php _e('Your message was sent to Website Manager. Thank you!','color-theme-framework');?></div>';
													$("#ct-contacts-form").hide();
												}
											else {
												result = msg;
											}
											$(this).html(result);
											});
										}
									});
									return false;
									});
								});
								});		
							</script>

							<fieldset class="info_fieldset">
								<div id="note"></div>

								<div id="ct-contacts-form">		
									<form id="ajax-contact-form" action="javascript:alert('Was send!');" class="clearfix">
										<div class="row">
							  				<div class="col-lg-6">
												<div class="input-group">
  													<span class="input-group-addon"><i class="icon-user"></i></span>
  													<input type="text" id="contact-name" class="form-control" title="<?php _e('Your Name','color-theme-framework'); ?>" name="name" required="" placeholder="<?php _e('Your Name','color-theme-framework'); ?>">
												</div><!-- .input-group -->

												<div class="input-group">
  													<span class="input-group-addon"><i class="icon-envelope"></i></span>
  													<input type="email" id="contact-email" class="form-control" title="<?php _e('Your Email Address','color-theme-framework'); ?>" name="email" required="" placeholder="<?php _e('Your Email Address','color-theme-framework'); ?>">
												</div><!-- .input-group -->

												<div class="input-group">
  													<span class="input-group-addon"><i class="icon-link"></i></span>
  													<input type="url" id="contact-url" class="form-control" title="<?php _e('Your URL','color-theme-framework'); ?>" name="url" placeholder="<?php _e('Your URL','color-theme-framework'); ?>">
												</div><!-- .input-group -->

												<div class="input-group">
  													<span class="input-group-addon"><i class="icon-user"></i></span>
  													<input type="text" id="contact-subject" class="form-control" title="<?php _e('Subject','color-theme-framework'); ?>" name="subject" required="" placeholder="<?php _e('Subject','color-theme-framework'); ?>">
												</div><!-- .input-group -->
					  						</div><!-- .col-lg-6 -->
					  					</div><!-- row -->

					   					<div class="row">
											<div class="col-lg-12 clearfix">
						  						<textarea id="textarea" name="message" required placeholder="<?php _e('Type your questions here...','color-theme-framework'); ?>" rows="10" class="span12"></textarea>
					  							<button type="submit" class="btn btn-default"><?php _e('Send Message','color-theme-framework'); ?></button>
											</div><!-- col-lg-12 -->
				   						</div><!-- row -->
										<span></span>
				  					</form>
								</div> <!-- end #contact-form -->
			 				</fieldset>

							<?php 
							// Displays a link to edit the current post, if a user is logged in and allowed to edit the post
							edit_post_link( __( 'Edit', 'color-theme-framework' ), '<span class="edit-link"><i class="icon-pencil"></i>', '</span>' );
							?>
						</div><!-- .entry-content -->
					</article><!-- #post -->
				<?php endwhile; // end of the loop. ?>
			</div><!-- #content -->				
		</div><!-- .col-lg-8 -->

		<div id="secondary" class="widget-area <?php echo $sidebar_class.' '.$col_lg_pull; ?>" role="complementary">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('ct_page_sidebar') ) : ?>
			<?php endif; ?>
		</div><!-- .col-lg-4 -->
	</div><!-- .row -->
</div> <!-- .container -->

<?php get_footer(); ?>