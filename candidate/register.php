<?php  
/* 
Template Name: Register Page
*/

get_header(); 


$sidebar_id = get_meta_option('custom_sidebar', $post->ID);
$sidebar_position = get_meta_option('sidebar_position_meta_box', $post->ID);
$sidebar_class = 'col-lg-12 col-md-12 col-sm-12';

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
						
						<h1><?php echo esc_html(get_the_title()); ?></h1>
						
						
						
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
					
					
					
					
						<?php
	$err = '';
	$success = '';

	global $wpdb, $PasswordHash, $current_user, $user_ID;

	if(isset($_POST['task']) && $_POST['task'] == 'register' ) {

		
		$pwd1 = $wpdb->escape(trim($_POST['pwd1']));
		$pwd2 = $wpdb->escape(trim($_POST['pwd2']));
		$first_name = $wpdb->escape(trim($_POST['first_name']));
		$last_name = $wpdb->escape(trim($_POST['last_name']));
		$email = $wpdb->escape(trim($_POST['email']));
		$username = $wpdb->escape(trim($_POST['username']));
		
		if( $email == "" || $pwd1 == "" || $pwd2 == "" || $username == "" ) {
			$err = __('Please don\'t leave the required fields.', 'candidate');
		} else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$err = __('Invalid email address.', 'candidate');
		} else if(email_exists($email) ) {
			$err = __('Email already exist.', 'candidate');
		} else if($pwd1 <> $pwd2 ){
			$err = __('Password do not match.', 'candidate');		
		} else {

			$user_id = wp_insert_user( array ('first_name' => apply_filters('pre_user_first_name', $first_name), 'last_name' => apply_filters('pre_user_last_name', $last_name), 'user_pass' => apply_filters('pre_user_user_pass', $pwd1), 'user_login' => apply_filters('pre_user_user_login', $username), 'user_email' => apply_filters('pre_user_user_email', $email), 'role' => 'subscriber' ) );
			if( is_wp_error($user_id) ) {
				$err = __('Error on user creation.', 'candidate');
			} else {
				do_action('user_register', $user_id);
				
				$success = __('You\'re successfully register.', 'candidate');
			}
			
		}
		
	}
	?>

        <!--display error/success message-->
	<div id="message">
		<?php 
			if(! empty($err) ) :
				echo '<p class="error">'.$err.'';
			endif;
		?>
		
		<?php 
			if(! empty($success) ) :
				echo '<p class="error">'.$success.'';
			endif;
		?>
	</div>

	<form method="post">
		<h5><?php _e( 'Don\'t have an account?', 'candidate' ); ?><br /> <?php _e( 'Create one now.', 'candidate' ); ?></h5>
		
		<div class="row">	
			<div class="col-lg-4 col-md-4 col-sm-4">
				<p><?php _e( 'First name', 'candidate' ); ?></p>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8">
				<input type="text" name="first_name" id="reg_billing_first_name" value="" />
			</div>	
		</div>
		
		<div class="row">	
			<div class="col-lg-4 col-md-4 col-sm-4">
				<p><?php _e( 'Last Name', 'candidate' ); ?></p>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8">
				<input type="text" name="last_name" id="last_name" value="" />
			</div>	
		</div>
		
		<div class="row">	
			<div class="col-lg-4 col-md-4 col-sm-4">
				<p><?php _e( 'Email', 'candidate' ); ?>*</p>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8">
				<input type="text" name="email" id="email" value="" />
			</div>	
		</div>
		
		<div class="row">	
			<div class="col-lg-4 col-md-4 col-sm-4">
				<p><?php _e( 'Username', 'candidate' ); ?>*</p>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8">
				<input type="text" name="username" id="username" value="" />
			</div>	
		</div>
		
		<div class="row">	
			<div class="col-lg-4 col-md-4 col-sm-4">
				<p><?php _e( 'Password', 'candidate' ); ?>*</p>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8">
				<input type="password" name="pwd1" id="pwd1" value="" />
			</div>	
		</div>
		
		<div class="row">	
			<div class="col-lg-4 col-md-4 col-sm-4">
				<p><?php _e( 'Password again', 'candidate' ); ?>*</p>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8">
				<input type="password" name="pwd2" id="pwd2" value="" />
			</div>	
		</div>
		
		
		<input type="submit" class="big button" name="btnregister" value="<?php _e( 'REGISTER', 'candidate' ); ?>" style="padding: 5px 15px;" />
		
		<input type="hidden" name="task" value="register" />
		
		
		
		
	</form>
					
					
					


					<?php endwhile; ?>	

	
				
		
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





<?php get_footer() ?>