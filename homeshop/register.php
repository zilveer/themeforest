<?php  
/* 
Template Name: Register Page
*/

get_header(); 

$sidebar_position_mobile = get_option('sense_settings_sidebar_mobile');


$sidebar_id = get_meta_option('custom_sidebar');
$sidebar_position = get_meta_option('sidebar_position_meta_box');
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
			
			<div class="page-content register-account">
  		   
		   <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		   
		   
	<?php
	$err = '';
	$success = '';

	global $wpdb, $PasswordHash, $current_user, $user_ID;

	if(isset($_POST['task']) && $_POST['task'] == 'register' ) {

		
		$pwd1 = $wpdb->prepare(trim($_POST['pwd1']));
		$pwd2 = $wpdb->prepare(trim($_POST['pwd2']));
		$first_name = $wpdb->prepare(trim($_POST['first_name']));
		$last_name = $wpdb->prepare(trim($_POST['last_name']));
		$email = $wpdb->prepare(trim($_POST['email']));
		$username = $wpdb->prepare(trim($_POST['username']));
		
		if( $email == "" || $pwd1 == "" || $pwd2 == "" || $username == "" ) {
			$err = __('Please don\'t leave the required fields.', 'homeshop');
		} else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$err = __('Invalid email address.', 'homeshop');
		} else if(email_exists($email) ) {
			$err = __('Email already exist.', 'homeshop');
		} else if($pwd1 <> $pwd2 ){
			$err = __('Password do not match.', 'homeshop');		
		} else {

			$user_id = wp_insert_user( array ('first_name' => apply_filters('pre_user_first_name', $first_name), 'last_name' => apply_filters('pre_user_last_name', $last_name), 'user_pass' => apply_filters('pre_user_user_pass', $pwd1), 'user_login' => apply_filters('pre_user_user_login', $username), 'user_email' => apply_filters('pre_user_user_email', $email), 'role' => 'subscriber' ) );
			if( is_wp_error($user_id) ) {
				$err = __('Error on user creation.', 'homeshop');
			} else {
				do_action('user_register', $user_id);
				
				$success = __('You\'re successfully register.', 'homeshop');
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
		<h5><?php _e( 'Don\'t have an account?', 'homeshop' ); ?><br /> <?php _e( 'Create one now.', 'homeshop' ); ?></h5>
		
		<div class="row">	
			<div class="col-lg-4 col-md-4 col-sm-4">
				<p><?php _e( 'First name', 'homeshop' ); ?></p>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8">
				<input type="text" name="first_name" id="reg_billing_first_name" value="" />
			</div>	
		</div>
		
		<div class="row">	
			<div class="col-lg-4 col-md-4 col-sm-4">
				<p><?php _e( 'Last Name', 'homeshop' ); ?></p>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8">
				<input type="text" name="last_name" id="last_name" value="" />
			</div>	
		</div>
		
		<div class="row">	
			<div class="col-lg-4 col-md-4 col-sm-4">
				<p><?php _e( 'Email', 'homeshop' ); ?>*</p>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8">
				<input type="text" name="email" id="email" value="" />
			</div>	
		</div>
		
		<div class="row">	
			<div class="col-lg-4 col-md-4 col-sm-4">
				<p><?php _e( 'Username', 'homeshop' ); ?>*</p>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8">
				<input type="text" name="username" id="username" value="" />
			</div>	
		</div>
		
		<div class="row">	
			<div class="col-lg-4 col-md-4 col-sm-4">
				<p><?php _e( 'Password', 'homeshop' ); ?>*</p>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8">
				<input type="password" name="pwd1" id="pwd1" value="" />
			</div>	
		</div>
		
		<div class="row">	
			<div class="col-lg-4 col-md-4 col-sm-4">
				<p><?php _e( 'Password again', 'homeshop' ); ?>*</p>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8">
				<input type="password" name="pwd2" id="pwd2" value="" />
			</div>	
		</div>
		
		
		<input type="submit" class="big button" name="btnregister" value="<?php _e( 'REGISTER', 'homeshop' ); ?>" style="padding: 5px 15px;" />
		
		<input type="hidden" name="task" value="register" />
		
		
		
		
	</form>
		   
	

		   <?php endwhile; ?>
   
			</div>
                            
		</div>
		  
	</div>
   

   
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
   
   


<?php get_footer() ?>