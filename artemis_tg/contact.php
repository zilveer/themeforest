<?php
/**
 * Template Name: Contact
 * The main template file for display contact page.
 *
 * @package WordPress
*/


/**
*	if not submit form
**/
if(!isset($_POST['your_name']))
{

/**
*	Get Current page object
**/
$current_page = get_page($post->ID);
$current_page_id = '';

if(isset($current_page->ID))
{
    $current_page_id = $current_page->ID;
}

//Get Page Sidebar
$page_sidebar = get_post_meta($current_page_id, 'page_sidebar', true);
if(empty($page_sidebar))
{
	$page_sidebar = 'Contact Sidebar';
}

get_header(); 

//Get Page background style
$bg_style = get_post_meta($current_page_id, 'page_bg_style', true);

//Check browser and version for performance tuning
$isIE8 = ereg('MSIE 8',$_SERVER['HTTP_USER_AGENT']);
if($isIE8)
{
	$bg_style = 'Static Image';
}

if($bg_style == 'Static Image')
{
    if(has_post_thumbnail($current_page_id, 'full'))
    {
        $image_id = get_post_thumbnail_id($current_page_id); 
        $image_thumb = wp_get_attachment_image_src($image_id, 'full', true);
        $pp_page_bg = $image_thumb[0];
    }
    else
    {
    	$pp_page_bg = get_stylesheet_directory_uri().'/example/bg.jpg';
    }
?>
<script type="text/javascript"> 
    jQuery.backstretch( "<?php echo $pp_page_bg; ?>", {speed: 'slow'} );
</script>

<?php
} // end if static image
else
{
    $page_bg_gallery_id = get_post_meta($current_page_id, 'page_bg_gallery_id', true);
    $args = array( 
    	'post_type' => 'attachment', 
    	'numberposts' => -1, 
    	'post_status' => null, 
    	'post_parent' => $page_bg_gallery_id,
    	'order' => 'ASC',
    	'orderby' => 'menu_order',
    ); 
    $bg_photo_arr = get_posts( $args );
?>

<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/supersized.css" type="text/css" media="screen" />

<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/supersized.3.1.3.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/supersized.shutter.js"></script>

<script type="text/javascript">  
    
    jQuery(function($){
    	$.supersized({
    	
    		//Functionality
    		slideshow               :   1,		//Slideshow on/off
    		autoplay				:	1,		//Slideshow starts playing automatically
    		start_slide             :   1,		//Start slide (0 is random)
    		random					: 	0,		//Randomize slide order (Ignores start slide)
    		<?php						
    			$pp_portfolio_slideshow_timer = get_option('pp_portfolio_slideshow_timer');
    			
    			if(empty($pp_portfolio_slideshow_timer))
    			{
    				$pp_portfolio_slideshow_timer = 5000;
    			}
    			else
    			{
    				$pp_portfolio_slideshow_timer = $pp_portfolio_slideshow_timer*1000;
    			}
    		?>
    		slide_interval          :   <?php echo $pp_portfolio_slideshow_timer; ?>,	//Length between transitions
    		<?php						
    			$pp_portfolio_slideshow_trans = get_option('pp_portfolio_slideshow_trans');
    			
    			if(empty($pp_portfolio_slideshow_trans))
    			{
    				$pp_portfolio_slideshow_trans = 1;
    			}
    		?>
    		transition              :   <?php echo $pp_portfolio_slideshow_trans; ?>, 		//0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
    		transition_speed		:	500,	//Speed of transition
    		new_window				:	1,		//Image links open in new window/tab
    		pause_hover             :   0,		//Pause slideshow on hover
    		keyboard_nav            :   1,		//Keyboard navigation on/off
    		performance				:	1,		//0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
    		image_protect			:	0,		//Disables image dragging and right click with Javascript

    		//Size & Position
    		min_width		        :   0,		//Min width allowed (in pixels)
    		min_height		        :   0,		//Min height allowed (in pixels)
    		vertical_center         :   1,		//Vertically center background
    		horizontal_center       :   1,		//Horizontally center background
    		<?php						
    			$pp_portfolio_enable_fit_image = get_option('pp_portfolio_enable_fit_image');
    			
    			if(empty($pp_portfolio_enable_fit_image))
    			{
    				$pp_portfolio_enable_fit_image = 1;
    			}
    			else
    			{
    				$pp_portfolio_enable_fit_image = 0;
    			}
    		?>
    		fit_portrait         	:   <?php echo $pp_portfolio_enable_fit_image; ?>,		//Portrait images will not exceed browser height
    		fit_landscape			:   <?php echo $pp_portfolio_enable_fit_image; ?>,		//Landscape images will not exceed browser width
    		
    		//Components
    		navigation              :   1,		//Slideshow controls on/off
    		thumbnail_navigation    :   0,		//Thumbnail navigation
    		slide_counter           :   0,		//Display slide numbers
    		slide_captions          :   0,		//Slide caption (Pull from "title" in slides array)
    		progress_bar			:	1,
    		slides 					:  	[		//Slideshow Images
    											  


<?php
    foreach($bg_photo_arr as $key => $photo)
    {
        $small_image_url = get_stylesheet_directory_uri().'/images/000_70.png';
        $hyperlink_url = get_permalink($photo->ID);
        
        if(!empty($photo->guid))
        {
        	$image_url[0] = $photo->guid;
        }

?>

	<?php $homeslides .= '{image : \''.$image_url[0].'\', thumb: \''.$small_image_url.'\', title: "<div id=\"gallery_title\">'.htmlentities($photo->post_title).'</div><div id=\"gallery_desc\">'.htmlentities($photo->post_content).'</div>"},'; ?>
	
<?php
	}
?>

    			<?php $homeslides = substr($homeslides,0,-1);
    			echo $homeslides; ?>						]
    									
    	}); 
    });
    
</script>

<div id="thumb-tray" class="load-item">
    <div id="thumb-back"></div>
    <div id="thumb-forward"></div>
    <a id="prevslide" class="load-item"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow_back.png" alt=""/></a>
    <a id="nextslide" class="load-item"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow_forward.png" alt=""/></a>
</div>

<div id="progress-back" class="load-item">
	<div id="progress-bar"></div>
</div>

<input type="hidden" id="pp_image_path" name="pp_image_path" value="<?php echo get_stylesheet_directory_uri(); ?>/images/"/>

<?php
}
?>

<!-- Begin content -->
<?php
	//Get social media sharing option
	$pp_social_sharing = get_option('pp_social_sharing');
	
	if(!empty($pp_social_sharing))
	{
?>
<div class="gallery_social">
    <div class="each">
    	<iframe class="facebook_button" src="//www.facebook.com/plugins/like.php?app_id=262802827073639&amp;href=<?php echo urlencode($page->guid); ?>&amp;send=false&amp;layout=box_count&amp;width=200&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=70" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:50px; height:70px;" allowTransparency="true"></iframe>
    </div>
    <div class="each">				
    	<a href="https://twitter.com/share" data-text="<?php echo $page->post_title; ?>" data-url="<?php echo $page->guid; ?>" class="twitter-share-button" data-count="vertical">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
    </div>
    <div class="each">
    	<!-- Place this tag where you want the +1 button to render -->
    	<g:plusone size="tall" href="<?php echo $page->guid; ?>"></g:plusone>
    	
    	<!-- Place this render call where appropriate -->
    	<script type="text/javascript">
    	  (function() {
    	    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    	    po.src = 'https://apis.google.com/js/plusone.js';
    	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
    	  })();
    	</script>
    </div>
</div>
<?php
	}
?>

<!-- Begin content -->
<?php
	//Get social media sharing option
	$pp_social_sharing = get_option('pp_social_sharing');
	
	if(!empty($pp_social_sharing))
	{
?>
<div class="gallery_social">
    <div class="each">
    	<iframe class="facebook_button" src="//www.facebook.com/plugins/like.php?app_id=262802827073639&amp;href=<?php echo urlencode($current_page->guid); ?>&amp;send=false&amp;layout=box_count&amp;width=200&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=90" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:50px; height:90px;" allowTransparency="true"></iframe>
    </div>
    <div class="each">				
    	<a href="https://twitter.com/share" data-text="<?php echo $current_page->post_title; ?>" data-url="<?php echo $current_page->guid; ?>" class="twitter-share-button" data-count="vertical">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
    </div>
    <div class="each">
    	<!-- Place this tag where you want the +1 button to render -->
    	<g:plusone size="tall" href="<?php echo $current_page->guid; ?>"></g:plusone>
    	
    	<!-- Place this render call where appropriate -->
    	<script type="text/javascript">
    	  (function() {
    	    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    	    po.src = 'https://apis.google.com/js/plusone.js';
    	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
    	  })();
    	</script>
    </div>
</div>
<?php
	}
?>

<div class="page_control">
    <a id="page_minimize" href="#">
    	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_minus.png" alt=""/>
    </a>
    <a id="page_maximize" href="#">
    	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_plus.png" alt=""/>
    </a>
</div>

<div id="page_content_wrapper">

    <div class="inner">
    
    <div id="page_caption" class="sidebar_content full_width" style="padding-bottom:0">
    	<h1 class="cufon"><?php the_title(); ?></h1>
    </div>
    
    <div class="sidebar_content">
    	
    	<!-- Begin main content -->
    	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>		

    				<?php the_content(); ?><br/>

    			<?php endwhile; ?>
    			
    			<h4><?php _e( 'Send Us Mail', THEMEDOMAIN ); ?></h4><br/>
    			
    			<?php
    				$pp_contact_form = unserialize(get_option('pp_contact_form_sort_data'));
    			?>
    			<form id="contact_form" method="post" action="<?php echo get_permalink($current_page->ID); ?>">
    				<?php 
			    		if(is_array($pp_contact_form) && !empty($pp_contact_form))
			    		{
			    			foreach($pp_contact_form as $form_input)
			    			{
			    				switch($form_input)
			    				{
			    					case 1:
			    	?>
			        				<input id="your_name" name="your_name" type="text" style="width:47%"/>
			        				<label for="your_name"><?php echo _e( 'Name', THEMEDOMAIN ); ?>*</label>
			        				<br/><br/>			
			    	<?php
			    					break;
			    					
			    					case 2:
			    	?>
			    					
			        				<input id="email" name="email" type="text" style="width:47%"/>
			        				<label for="email"><?php echo _e( 'Email', THEMEDOMAIN ); ?>*</label>
			        				<br/><br/>				
			    	<?php
			    					break;
			    					
			    					case 3:
			    	?>
			    					
			        				<textarea id="message" name="message" rows="7" cols="10" style="width:70%"></textarea>
			        				<label for="message"><?php echo _e( 'Message', THEMEDOMAIN ); ?>*</label>
			        				<br/><br/>				
			    	<?php
			    					break;
			    					
			    					case 4:
			    	?>
			    					
			        				<input id="address" name="address" type="text" style="width:47%"/>
			        				<label for="address"><?php echo _e( 'Address', THEMEDOMAIN ); ?></label>
			        				<br/><br/>			
			    	<?php
			    					break;
			    					
			    					case 5:
			    	?>
			    					
			        				<input id="phone" name="phone" type="text" style="width:47%"/>
			        				<label for="phone"><?php echo _e( 'Phone', THEMEDOMAIN ); ?></label>
			        				<br/><br/>			
			    	<?php
			    					break;
			    					
			    					case 6:
			    	?>
			    					
			        				<input id="mobile" name="mobile" type="text" style="width:47%"/>
			        				<label for="mobile"><?php echo _e( 'Mobile', THEMEDOMAIN ); ?></label>
			        				<br/><br/>				
			    	<?php
			    					break;
			    					
			    					case 7:
			    	?>
			    					
			        				<input id="company" name="company" type="text" style="width:47%"/>
			        				<label for="company"><?php echo _e( 'Company Name', THEMEDOMAIN ); ?></label>
			        				<br/><br/>				
			    	<?php
			    					break;
			    					
			    					case 8:
			    	?>
			    					
			        				<input id="country" name="country" type="text" style="width:47%"/>
			        				<label for="country"><?php echo _e( 'Country', THEMEDOMAIN ); ?></label>
			        				<br/><br/>				
			    	<?php
			    					break;
			    				}
			    			}
			    		}
			    	?>
			    	
			    	<?php
			    		$pp_contact_enable_captcha = get_option('pp_contact_enable_captcha');
			    		
			    		if(!empty($pp_contact_enable_captcha))
			    		{
			    	?>
			    		
			    		<br class="clear"/>
			    		<div id="captcha-wrap">
							<div class="captcha-box">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/get_captcha.php" alt="" id="captcha" />
							</div>
							<div class="text-box">
								<label>Type the two words:</label>
								<input name="captcha-code" type="text" id="captcha-code">
							</div>
							<div class="captcha-action">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/refresh.jpg"  alt="" id="captcha-refresh" />
							</div>
						</div>
					
					<?php
					}
					?>
			    			    
			    	<br class="clear"/>
			    	<p style="margin-top:20px">
    					<input type="submit" value="Send Message"/>
    				</p>
    			</form>
    			<div id="reponse_msg"></div>
    	<!-- End main content -->
    	</div>
    	
    	<div class="sidebar_wrapper">
    			<div class="sidebar">
    				
    				<div class="content">
    				
    					<ul class="sidebar_widget">
    						<?php dynamic_sidebar($page_sidebar); ?>
    					</ul>
    					
    				</div>
    			
    			</div>
    			<br class="clear"/>
    
    	</div>
    </div>
</div>   
<br class="clear"/>
<?php get_footer(); ?>		
				
<?php
}

//if submit form
else
{
	check_ajax_referer( 'tgajax-post-contact-nonce', 'tg_security' );

	/*
	|--------------------------------------------------------------------------
	| Mailer module
	|--------------------------------------------------------------------------
	|
	| These module are used when sending email from contact form
	|
	*/
	
	//Get your email address
	$contact_email = get_option('pp_contact_email');
	
	//Enter your email address, email from contact form will send to this addresss. Please enter inside quotes ('myemail@email.com')
	define('DEST_EMAIL', $contact_email);
	
	//Change email subject to something more meaningful
	define('SUBJECT_EMAIL', __( 'Email from contact form', THEMEDOMAIN ));
	
	//Thankyou message when message sent
	define('THANKYOU_MESSAGE', __( 'Thank you! We will get back to you as soon as possible', THEMEDOMAIN ));
	
	//Error message when message can't send
	define('ERROR_MESSAGE', __( 'Oops! something went wrong, please try to submit later.', THEMEDOMAIN ));
	
	
	/*
	|
	| Begin sending mail
	|
	*/
	
	$from_name = $_POST['your_name'];
	$from_email = $_POST['email'];
	
	$headers = "";
   	$headers.= 'From: '.$from_name.'<'.$from_email.'>'.PHP_EOL;
   	$headers.= 'Reply-To: '.$from_name.'<'.$from_email.'>'.PHP_EOL;
   	$headers.= 'Return-Path: '.$from_name.'<'.$from_email.'>'.PHP_EOL;        // these two to set reply address
   	$headers.= "Message-ID: <".time()."webmaster@".$_SERVER['SERVER_NAME'].">".PHP_EOL;
   	$headers.= "X-Mailer: PHP v".phpversion().PHP_EOL;                  // These two to help avoid spam-filters
	
	$message = 'Name: '.$from_name.PHP_EOL;
	$message.= 'Email: '.$from_email.PHP_EOL.PHP_EOL;
	$message.= 'Message: '.PHP_EOL.$_POST['message'];
	
	if(isset($_POST['address']))
	{
		$message.= 'Address: '.$_POST['address'].PHP_EOL;
	}
	
	if(isset($_POST['phone']))
	{
		$message.= 'Phone: '.$_POST['phone'].PHP_EOL;
	}
	
	if(isset($_POST['mobile']))
	{
		$message.= 'Mobile: '.$_POST['mobile'].PHP_EOL;
	}
	
	if(isset($_POST['company']))
	{
		$message.= 'Company: '.$_POST['company'].PHP_EOL;
	}
	
	if(isset($_POST['country']))
	{
		$message.= 'Country: '.$_POST['country'].PHP_EOL;
	}
	    
	
	if(!empty($from_name) && !empty($from_email) && !empty($message))
	{
		wp_mail(DEST_EMAIL, SUBJECT_EMAIL, $message, $headers);
	
		echo THANKYOU_MESSAGE;
		
		exit;
	}
	else
	{
		echo ERROR_MESSAGE;
		
		exit;
	}
	
	/*
	|
	| End sending mail
	|
	*/
}

?>