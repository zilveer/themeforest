<?php 
/*---------------------------------------------------------------------------------*/
/* Flickr widget */
/*---------------------------------------------------------------------------------*/
class themeteam_flickr extends WP_Widget {
	
	function themeteam_flickr(){
		$widget_desc = array('description' => 'This Flickr widget populates photos from a Flickr ID.' );

		parent::WP_Widget(false, __('Theme Team - Flickr', 'themeteam'),$widget_desc); 
	}
	
	function widget($args, $instance) {  
		extract( $args );
		$id = $instance['id'];
		$number = $instance['number'];
		$type = $instance['type'];
		$sorting = $instance['sorting'];
		$size = $instance['size'];
		
		?>
		
		<?php
		echo $before_widget;
		echo $before_title; ?>
		<?php _e('Flickr','themeteam'); ?>
        <?php echo $after_title; ?>
            
        <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=<?php echo $sorting; ?>&amp;&amp;layout=x&amp;source=<?php echo $type; ?>&amp;<?php echo $type; ?>=<?php echo $id; ?>&amp;size=<?php echo $size; ?>"></script>        

		<div style="clear:both;"></div>

	   <?php			
	   echo $after_widget;

   }
   
   function update($new_instance, $old_instance) {                
       return $new_instance;
   }
   
   function form($instance) {        
		$id = esc_attr($instance['id']);
		$number = esc_attr($instance['number']);
		$type = esc_attr($instance['type']);
		$sorting = esc_attr($instance['sorting']);
		$size = esc_attr($instance['size']);
		?>
        <p>
            <label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('Flickr ID (<a href="http://www.idgettr.com">idGettr</a>):','woothemes'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('id'); ?>" value="<?php echo $id; ?>" class="widefat" id="<?php echo $this->get_field_id('id'); ?>" />
        </p>
       	<p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number:','woothemes'); ?></label>
            <select name="<?php echo $this->get_field_name('number'); ?>" class="widefat" id="<?php echo $this->get_field_id('number'); ?>">
                <?php for ( $i = 1; $i <= 10; $i += 1) { ?>
                <option value="<?php echo $i; ?>" <?php if($number == $i){ echo "selected='selected'";} ?>><?php echo $i; ?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Type:','woothemes'); ?></label>
            <select name="<?php echo $this->get_field_name('type'); ?>" class="widefat" id="<?php echo $this->get_field_id('type'); ?>">
                <option value="user" <?php if($type == "user"){ echo "selected='selected'";} ?>><?php _e('User', 'woothemes'); ?></option>
                <option value="group" <?php if($type == "group"){ echo "selected='selected'";} ?>><?php _e('Group', 'woothemes'); ?></option>            
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('sorting'); ?>"><?php _e('Sorting:','woothemes'); ?></label>
            <select name="<?php echo $this->get_field_name('sorting'); ?>" class="widefat" id="<?php echo $this->get_field_id('sorting'); ?>">
                <option value="latest" <?php if($sorting == "latest"){ echo "selected='selected'";} ?>><?php _e('Latest', 'woothemes'); ?></option>
                <option value="random" <?php if($sorting == "random"){ echo "selected='selected'";} ?>><?php _e('Random', 'woothemes'); ?></option>            
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('size'); ?>"><?php _e('Size:','woothemes'); ?></label>
            <select name="<?php echo $this->get_field_name('size'); ?>" class="widefat" id="<?php echo $this->get_field_id('size'); ?>">
                <option value="s" <?php if($size == "s"){ echo "selected='selected'";} ?>><?php _e('Square', 'woothemes'); ?></option>
                <option value="m" <?php if($size == "m"){ echo "selected='selected'";} ?>><?php _e('Medium', 'woothemes'); ?></option>
                <option value="t" <?php if($size == "t"){ echo "selected='selected'";} ?>><?php _e('Thumbnail', 'woothemes'); ?></option>
            </select>
        </p>
		<?php
	}
}

register_widget('themeteam_flickr');
/*---------------------------------------------------------------------------------*/
/* Twitter widget */
/*---------------------------------------------------------------------------------*/
class themeteam_twitter extends WP_Widget {
	function themeteam_twitter() {
	   $widget_ops = array('description' => 'Add your Twitter feed to your sidebar.' );
       parent::WP_Widget(false, __('Theme Team - Twitter Stream', 'origami'),$widget_ops);      
   	}
   
   	function widget($args, $instance) {  
    	extract( $args );
   		$title = $instance['title'];
    	$limit = $instance['limit']; if (!$limit) $limit = 5;
		$username = $instance['username'];
		?>
		<?php echo $before_widget; ?>
        <?php if ($title) echo $before_title . $title . $after_title; ?>
        <div id="tweet_list">
		</div>
		<!--<a href="http://www.twitter.com/<-?php echo $username ?>" class="button">Follow us on Twitter</a>-->
		<script type="text/javascript">
		jQuery(function(){
 			jQuery('#tweet_list').tweetable({username: '<?php echo $username; ?>', time: false, limit: <?php echo $limit; ?>, replies:false});
		});
		</script>
		<div style="clear:both;"></div>	 	 
        <?php echo $after_widget; ?>
        
   		
	<?php
   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {        
   
       $title = esc_attr($instance['title']);
       $limit = esc_attr($instance['limit']);
	   $username = esc_attr($instance['username']);
       ?>
       <p>
	   	   <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','origami'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
       </p>
       <p>
	   	   <label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Username:','origami'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('username'); ?>"  value="<?php echo $username; ?>" class="widefat" id="<?php echo $this->get_field_id('username'); ?>" />
       </p>
       <p>
	   	   <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Limit:','origami'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('limit'); ?>"  value="<?php echo $limit; ?>" class="" size="3" id="<?php echo $this->get_field_id('limit'); ?>" />

       </p>
      <?php
   }
}
register_widget('themeteam_twitter');
/*---------------------------------------------------------------------------------*/
/* banner ads widget */
/*---------------------------------------------------------------------------------*/
class themeteam_banners extends WP_Widget {
	function themeteam_banners() {
	   $widget_ops = array('description' => 'Add your Banner Adsto the sidebar.' );
       parent::WP_Widget(false, __('Theme Team - Banner Ads', 'themeteam'),$widget_ops);      
   	}
   	
   	function widget($args, $instance) {  
		extract( $args );
		$bannerLink1 = $instance['bannerLink1'];
		$bannerUrl1 = $instance['bannerUrl1'];
		$bannerLink2 = $instance['bannerLink2'];
		$bannerUrl2 = $instance['bannerUrl2'];
		$bannerLink3 = $instance['bannerLink3'];
		$bannerUrl3 = $instance['bannerUrl3'];
		$bannerLink4 = $instance['bannerLink4'];
		$bannerUrl4 = $instance['bannerUrl4'];
		$bannerLink5 = $instance['bannerLink5'];
		$bannerUrl5 = $instance['bannerUrl5'];
		$bannerLink6 = $instance['bannerLink6'];
		$bannerUrl6 = $instance['bannerUrl6'];
		
		echo $before_widget; ?>
		  <h2>Sponsors</h2> 
          <?php if($bannerUrl1){ ?>
          <div class="sponsor"><a href="<?php echo $bannerLink1;?>"><img src="<?php echo $bannerUrl1;?>" alt="" /></a></div>
          <?php } if($bannerUrl2){ ?>
          <div class="sponsor even"><a href="<?php echo $bannerLink2;?>"><img src="<?php echo $bannerUrl2; ?>" alt="" /></a></div>
          <?php } if($bannerUrl3){ ?>
          <div class="sponsor"><a href="<?php echo $bannerLink3;?>"><img src="<?php echo $bannerUrl3; ?>" alt="" /></a></div>
          <?php } if($bannerUrl4){ ?>
          <div class="sponsor even"><a href="<?php echo $bannerLink4;?>"><img src="<?php echo $bannerUrl4;?>" alt="" /></a></div>
          <?php } if($bannerUrl5){ ?>
          <div class="sponsor"><a href="<?php echo $bannerLink5;?>"><img src="<?php echo $bannerUrl5; ?>" alt="" /></a></div>
          <?php } if($bannerUrl6){ ?>
          <div class="sponsor even"><a href="<?php echo $bannerLink6;?>"><img src="<?php echo $bannerUrl6; ?>" alt="" /></a></div>
          <?php } ?>

		  <div style="clear:both;"></div>	 
	   <?php			
	   echo $after_widget;
   }
   
   function update($new_instance, $old_instance) {                
       return $new_instance;
   }
   
   function form($instance) {        
		$bannerLink1 = esc_attr($instance['bannerLink1']);
		$bannerUrl1 = esc_attr($instance['bannerUrl1']);
		$bannerLink2 = esc_attr($instance['bannerLink2']);
		$bannerUrl2 = esc_attr($instance['bannerUrl2']);
		$bannerLink3 = esc_attr($instance['bannerLink3']);
		$bannerUrl3 = esc_attr($instance['bannerUrl3']);
		$bannerLink4 = esc_attr($instance['bannerLink4']);
		$bannerUrl4 = esc_attr($instance['bannerUrl4']);
		$bannerLink5 = esc_attr($instance['bannerLink5']);
		$bannerUrl5 = esc_attr($instance['bannerUrl5']);
		$bannerLink6 = esc_attr($instance['bannerLink6']);
		$bannerUrl6 = esc_attr($instance['bannerUrl6']);
		?>
        <p>
            <label for="<?php echo $this->get_field_id('bannerLink1'); ?>">Banner Link 1</label>
            <input type="text" name="<?php echo $this->get_field_name('bannerLink1'); ?>" value="<?php echo $bannerLink1; ?>" class="widefat" id="<?php echo $this->get_field_id('bannerLink1'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('bannerUrl1'); ?>">Banner Image URL 1</label>
            <input type="text" name="<?php echo $this->get_field_name('bannerUrl1'); ?>" value="<?php echo $bannerUrl1; ?>" class="widefat" id="<?php echo $this->get_field_id('bannerUrl1'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('bannerLink2'); ?>">Banner Link 2</label>
            <input type="text" name="<?php echo $this->get_field_name('bannerLink2'); ?>" value="<?php echo $bannerLink2; ?>" class="widefat" id="<?php echo $this->get_field_id('bannerLink2'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('bannerUrl2'); ?>">Banner Image URL 2</label>
            <input type="text" name="<?php echo $this->get_field_name('bannerUrl2'); ?>" value="<?php echo $bannerUrl2; ?>" class="widefat" id="<?php echo $this->get_field_id('bannerUrl2'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('bannerLink3'); ?>">Banner Link 3</label>
            <input type="text" name="<?php echo $this->get_field_name('bannerLink3'); ?>" value="<?php echo $bannerLink3; ?>" class="widefat" id="<?php echo $this->get_field_id('bannerLink3'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('bannerUrl3'); ?>">Banner Image URL 3</label>
            <input type="text" name="<?php echo $this->get_field_name('bannerUrl3'); ?>" value="<?php echo $bannerUrl3; ?>" class="widefat" id="<?php echo $this->get_field_id('bannerUrl3'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('bannerLink4'); ?>">Banner Link 4</label>
            <input type="text" name="<?php echo $this->get_field_name('bannerLink4'); ?>" value="<?php echo $bannerLink4; ?>" class="widefat" id="<?php echo $this->get_field_id('bannerLink4'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('bannerUrl4'); ?>">Banner Image URL 4</label>
            <input type="text" name="<?php echo $this->get_field_name('bannerUrl4'); ?>" value="<?php echo $bannerUrl4; ?>" class="widefat" id="<?php echo $this->get_field_id('bannerUrl4'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('bannerLink5'); ?>">Banner Link 5</label>
            <input type="text" name="<?php echo $this->get_field_name('bannerLink5'); ?>" value="<?php echo $bannerLink5; ?>" class="widefat" id="<?php echo $this->get_field_id('bannerLink5'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('bannerUrl5'); ?>">Banner Image URL 5</label>
            <input type="text" name="<?php echo $this->get_field_name('bannerUrl5'); ?>" value="<?php echo $bannerUrl5; ?>" class="widefat" id="<?php echo $this->get_field_id('bannerUrl5'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('bannerLink6'); ?>">Banner Link 6</label>
            <input type="text" name="<?php echo $this->get_field_name('bannerLink6'); ?>" value="<?php echo $bannerLink6; ?>" class="widefat" id="<?php echo $this->get_field_id('bannerLink6'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('bannerUrl6'); ?>">Banner Image URL 6</label>
            <input type="text" name="<?php echo $this->get_field_name('bannerUrl6'); ?>" value="<?php echo $bannerUrl6; ?>" class="widefat" id="<?php echo $this->get_field_id('bannerUrl6'); ?>" />
        </p>
       	
		<?php
	}
}
register_widget('themeteam_banners');
/*---------------------------------------------------------------------------------*/
/* Contact Us widget */
/*---------------------------------------------------------------------------------*/
class themeteam_contactus extends WP_Widget {
	function themeteam_contactus() {
	   $widget_ops = array('description' => 'Add your contact us form to the sidebar.' );
       parent::WP_Widget(false, __('Theme Team - Contact Us', 'themeteam'),$widget_ops);      
   	}
   	
   	function widget($args, $instance) {  
		extract( $args );
		$contactUsEmail = $instance['contactUsEmail'];
		
		echo $before_widget; 
		
		?>
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.defaultvalue.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/contact_us_widget.js"></script>
		
		
		<h2>Get in Touch</h2>
		<div class="contactform">
		<?php if(isset($emailSent) && $emailSent == true) { ?>
				<div>
			          <p>Your message has been sent</p>
			          <h4>thank you!</h4>
				</div>

		<?php } else { ?>
			<?php if(isset($hasError) || isset($captchaError)) { ?>
			<p class="error">There was an error submitting the form.<p>
			<?php } ?>
			
			<?php if(!$contactUsEmail) { ?>
			<p class="error">You have not set your email address in the options widget admin panel<p>
			<?php } ?>
			<form action="/wp-content/themes/origami/submit_widget.php" id="contactForm" method="post">
			<p>
				<input name="contactName" id="contactName" class="requiredField" type="text" value="<?php if(isset($_POST['contactName'])){ echo $_POST['contactName'];} ?>" onblur="if(this.value==''){this.value='Name'}" onfocus="if(this.value=='Name'){this.value=''}"/>
				<?php if($nameError != '') { ?>
					<br/>
					<span class="error"><?=$nameError;?></span> 
				<?php } ?>
			</p>
			<p>	
				<input name="email" type="email" id="email" class="email requiredField" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>" onblur="if(this.value==''){this.value='Email'}" onfocus="if(this.value=='Email'){this.value=''}"/>
				<?php if($emailError != '') { ?>
					<br/>
					<span class="error"><?=$emailError;?></span>
				<?php } ?>
			</p>
			<p>
				<textarea rows="5" name="comments" id="commentsText" class="requiredField" onBlur="if(this.value==''){this.value='Message'}" onFocus="if(this.value=='Message'){this.value=''}" ><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
				<?php if($commentError != '') { ?>
					<br/>
					<span class="error"><?=$commentError;?></span> 
				<?php } ?>
			</p>
			<p>
				<input type="hidden" name="submitted" id="submitted" value="true" />
				<input type="hidden" name="emailTo" id="emailTo" value="<?php echo nospam($instance['contactUsEmail']);?>" />
				<button class="button small <?php echo $GLOBALS['button_css'];?>" ><span><span>SUBMIT</span></span></button>
				
			</p>

			</form>
		<?php } ?>
		</div>
		<?php			
	    echo $after_widget;
	}
	function update($new_instance, $old_instance) {                
       return $new_instance;
    }
   
   	function form($instance) {
   		$contactUsEmail = esc_attr($instance['contactUsEmail']);
		?>
		<p>
            <label for="<?php echo $this->get_field_id('contactUsEmail'); ?>">Set the email address:</label>
            <input type="text" name="<?php echo $this->get_field_name('contactUsEmail'); ?>" value="<?php echo $contactUsEmail; ?>" class="widefat" id="<?php echo $this->get_field_id('contactUsEmail'); ?>" />
        </p>
		<?php
   	}
}
register_widget('themeteam_contactus');
/*---------------------------------------------------------------------------------*/
/* Contact Info widget */
/*---------------------------------------------------------------------------------*/
class themeteam_contact_info extends WP_Widget {
	function themeteam_contact_info() {
	   $widget_ops = array('description' => 'Add your contact info to the sidebar.' );
       parent::WP_Widget(false, __('Theme Team - Contact Info', 'themeteam'),$widget_ops);      
   	}
   	
   	function widget($args, $instance) {  
		extract( $args );
		$contactLabel = $instance['contactLabel'];
		$contactName = $instance['contactName'];
		$contactAddress = $instance['contactAddress'];
		$contactPhone = $instance['contactPhone'];
		$contactFax = $instance['contactFax'];
		$contactEmail = $instance['contactEmail'];
		$contactUrl = $instance['contactUrl'];
		$googleMapURL = $instance['googleMapURL'];
		
		echo $before_widget; ?>
		<div id="widget contactinfo">
			<h2><?php echo $contactLabel; ?></h2>
			<p>
				<?php if($contactName){ ?>
					<?php echo $contactName;?><br />
				<?php } if($contactAddress){ ?>
					<?php echo $contactAddress;?><br />
				<?php } if($contactPhone){ ?>
					<?php echo $contactPhone;?><br />
				<?php } if($contactFax){ ?>
					Fax: <?php echo $contactFax;?><br />
				<?php } if($contactEmail){ ?>
					<a href="mailto:<?php echo $contactEmail;?>"><?php echo $contactEmail;?></a><br />
				<?php } if($contactUrl){ ?>
					<a href="<?php echo $contactUrl;?>"><?php echo $contactUrl;?></a><br /><br />
				<?php } if($googleMapURL){ ?>
					<div class="left googleMap"><?php echo $googleMapURL;?></div>
				<?php } ?>
			</p>
		</div>
		<?php			
	    echo $after_widget;
	}
	function update($new_instance, $old_instance) {                
       return $new_instance;
    }
   
   	function form($instance) {
   		$contactLabel = esc_attr($instance['contactLabel']);
   		$contactName = esc_attr($instance['contactName']);
   		$contactAddress = esc_attr($instance['contactAddress']);
   		$contactPhone = esc_attr($instance['contactPhone']);
   		$contactFax = esc_attr($instance['contactFax']);
   		$contactEmail = esc_attr($instance['contactEmail']);
   		$contactUrl = esc_attr($instance['contactUrl']);
   		$googleMapURL = esc_attr($instance['googleMapURL']);
		?>
		<p>
            <label for="<?php echo $this->get_field_id('contactLabel'); ?>">Label:</label>
            <input type="text" name="<?php echo $this->get_field_name('contactLabel'); ?>" value="<?php echo $contactLabel; ?>" class="widefat" id="<?php echo $this->get_field_id('contactLabel'); ?>" />
        </p>
		<p>
            <label for="<?php echo $this->get_field_id('contactName'); ?>">Set the Contact/Company Name:</label>
            <input type="text" name="<?php echo $this->get_field_name('contactName'); ?>" value="<?php echo $contactName; ?>" class="widefat" id="<?php echo $this->get_field_id('contactName'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('contactAddress'); ?>">Set the Contact Address:</label>
            <input type="text" name="<?php echo $this->get_field_name('contactAddress'); ?>" value="<?php echo $contactAddress; ?>" class="widefat" id="<?php echo $this->get_field_id('contactAddress'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('contactPhone'); ?>">Set the Contact Phone:</label>
            <input type="text" name="<?php echo $this->get_field_name('contactPhone'); ?>" value="<?php echo $contactPhone; ?>" class="widefat" id="<?php echo $this->get_field_id('contactPhone'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('contactFax'); ?>">Set the Contact Fax:</label>
            <input type="text" name="<?php echo $this->get_field_name('contactFax'); ?>" value="<?php echo $contactFax; ?>" class="widefat" id="<?php echo $this->get_field_id('contactFax'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('contactEmail'); ?>">Set the Contact Email Address:</label>
            <input type="text" name="<?php echo $this->get_field_name('contactEmail'); ?>" value="<?php echo $contactEmail; ?>" class="widefat" id="<?php echo $this->get_field_id('contactEmail'); ?>" />
        </p>
		<p>
            <label for="<?php echo $this->get_field_id('contactUrl'); ?>">Set the Website Address:</label>
            <input type="text" name="<?php echo $this->get_field_name('contactUrl'); ?>" value="<?php echo $contactUrl; ?>" class="widefat" id="<?php echo $this->get_field_id('contactUrl'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('googleMapURL'); ?>">Set Google map url:</label>
            <textarea name="<?php echo $this->get_field_name('googleMapURL'); ?>" cols="25" rows="10" id="<?php echo $this->get_field_id('googleMapURL'); ?>"><?php echo $googleMapURL; ?></textarea>
        </p>
		<?php
   	}
}
register_widget('themeteam_contact_info');
/*---------------------------------------------------------------------------------*/
/* Search widget */
/*---------------------------------------------------------------------------------*/
class themeteam_search extends WP_Widget {

   function themeteam_search() {
	   $widget_ops = array('description' => 'Theme Team search widget.' );
       parent::WP_Widget(false, __('Theme Team - Search', 'themeteam'),$widget_ops);      
   }

   function widget($args, $instance) {  
    extract( $args );
   	$title = $instance['title'];
	?>
		<?php echo $before_widget; ?>
        <?php if ($title) { echo $before_title . $title . $after_title; } ?>
        <?php include(TEMPLATEPATH . '/searchform.php'); ?>
		<?php echo $after_widget; ?>   
   <?php
   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {        
   
       $title = esc_attr($instance['title']);

       ?>
       <p>
	   	   <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','themeteam'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
       </p>
      <?php
   }
} 

register_widget('themeteam_search');
/*---------------------------------------------------------------------------------*/
/* Popular posts */
/*---------------------------------------------------------------------------------*/
class themeteam_popular extends WP_Widget {

   function themeteam_popular() {
	   $widget_ops = array('description' => 'Theme Team Popular Posts widget.' );
       parent::WP_Widget(false, __('Theme Team - Popular Posts', 'themeteam'),$widget_ops);      
   }

   function widget($args, $instance) {
    	global $wpdb;  
    	extract( $args );
   		$title = $instance['title'];
   	
   		if ( !$number = (int) $instance['number'] )
			$number = 3;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 10 )
			$number = 10;
		
		$disable_thumb = $instance['disable_thumb'] ? '1' : '0';
	
		$pop = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}posts WHERE post_type='post' ORDER BY comment_count DESC LIMIT ".$number."");
   	
	?>
		
		<?php echo $before_widget;
       	if($pop){ ?>
			<h2>Popular Posts</h2>
			<ul>
			<?php foreach($pop as $post){ 
					$post_title = stripslashes($post->post_title);
					$post_date = $post->post_date;
					$post_date = mysql2date('M j, Y', $post_date, false);
					$permalink = get_permalink($post->ID);
					$attachments = get_the_post_thumbnail($post->ID, 'thumb60');
					$comments_count = $post->comment_count;
					if(!$attachments){
						$attachments = get_template_directory_uri() .'/images/thumb1.jpg';
					}
				?>
				<li>
					<?php if(!$disable_thumb) { ?>
						<div class="thumbnail left">
							<a href="<?php echo $permalink; ?>" title="<?php echo $post_title; ?>">
								<?php echo $attachments; ?><span><em></em></span>
							</a>
						</div>
					<?php } ?>
					<div>
						<h3><a href="<?php echo $permalink; ?>"><?php echo $post_title; ?></a></h3>
                        <p><time><?php echo $post_date;?></time>  | <a href="<?php echo $permalink; ?>#comments"><?php echo $comments_count; ?> Comments</a> | <a href="<?php echo $permalink; ?>">read</a></p>
					</div>
				</li>
			<?php } ?>
			</ul>
		<?php } ?>
		<?php echo $after_widget; ?>
		  
   <?php
   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {        
   
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$disable_thumb = isset( $instance['disable_thumb'] ) ? (bool) $instance['disable_thumb'] : false;
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 3;
        ?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('number'); ?>">Enter the number of popular posts you'd like to display:</label>
		<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></p>
		
		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('disable_thumb'); ?>" name="<?php echo $this->get_field_name('disable_thumb'); ?>"<?php checked( $disable_thumb ); ?> />
		<label for="<?php echo $this->get_field_id('disable_thumb'); ?>"><?php _e( 'Disable Post Thumbnail?' ); ?></label></p>
      <?php
   }
} 

register_widget('themeteam_popular');
/*---------------------------------------------------------------------------------*/
/* Popular posts */
/*---------------------------------------------------------------------------------*/
class themeteam_recent extends WP_Widget {

   function themeteam_recent() {
	   $widget_ops = array('description' => 'Theme Team Recent Posts widget.' );
       parent::WP_Widget(false, __('Theme Team - Recent Posts', 'themeteam'),$widget_ops);      
   }

   function widget($args, $instance) {
    	global $wpdb;  
    	extract( $args );
   		$title = $instance['title'];
   	
   		if ( !$number = (int) $instance['number'] )
			$number = 3;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 10 )
			$number = 10;
		
		$disable_thumb = $instance['disable_thumb'] ? '1' : '0';
	
		$pop = get_posts("numberposts=$number&offset=0");
   	
	?>
		<?php echo $before_widget;
       	if($pop){ ?>
			<h2>Recent Posts</h2>
			<ul>
			<?php foreach($pop as $post){ 
					$post_title = stripslashes($post->post_title);
					$post_date = $post->post_date;
					$post_date = mysql2date('M j, Y', $post_date, false);
					
					$permalink = get_permalink($post->ID);
					$attachments = get_the_post_thumbnail($post->ID, 'thumb60');
					$comments_count = $post->comment_count;
					if(!$attachments){
						$attachments = get_template_directory_uri() .'/images/thumb1.jpg';
					}
				?>
				<li>
					<?php if(!$disable_thumb) { ?>
						<div class="thumbnail left">
							<a href="<?php echo $permalink; ?>" title="<?php echo $post_title; ?>">
								<?php echo $attachments; ?><span><em> </em></span>
							</a>
						</div>
					<?php } ?>
					<div>
						<h3><a href="<?php echo $permalink; ?>"><?php echo $post_title; ?></a></h3>
                        <p><time><?php echo $post_date;?></time>  | <a href="<?php echo $permalink; ?>#comments"><?php echo $comments_count; ?> Comments</a> | <a href="<?php echo $permalink; ?>">read</a></p>
					</div>
				</li>
			<?php } ?>
			</ul>
		<?php } ?>
		<?php echo $after_widget; ?>   
   <?php
   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {        
   
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$disable_thumb = isset( $instance['disable_thumb'] ) ? (bool) $instance['disable_thumb'] : false;
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 3;
        ?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('number'); ?>">Enter the number of recent posts you'd like to display:</label>
		<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></p>
		
		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('disable_thumb'); ?>" name="<?php echo $this->get_field_name('disable_thumb'); ?>"<?php checked( $disable_thumb ); ?> />
		<label for="<?php echo $this->get_field_id('disable_thumb'); ?>"><?php _e( 'Disable Post Thumbnail?' ); ?></label></p>
      <?php
   }
} 

register_widget('themeteam_recent');

/*---------------------------------------------------------------------------------*/
/* sunscribe widget */
/*---------------------------------------------------------------------------------*/
class themeteam_subscribe extends WP_Widget {

   function themeteam_subscribe() {
	   $widget_ops = array('description' => 'Theme Team subscribe widget.' );
       parent::WP_Widget(false, __('Theme Team - Subscribe', 'themeteam'),$widget_ops);      
   }

   function widget($args, $instance) {  
    extract( $args );
   	$title = $instance['title'];
	?>
		<?php echo $before_widget; ?>
        
        <div class="widget" id="subscribe">
        	<?php if ($title) { echo $before_title . $title . $after_title; } ?>
     		<?php if (class_exists('ajaxNewsletter')): ?>
				<?php ajaxNewsletter::newsletterForm() ?>
	  		<?php endif ?>
    	</div>
		<?php echo $after_widget; ?>   
   <?php
   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {        
   
       $title = esc_attr($instance['title']);

       ?>
       <?php if (class_exists('ajaxNewsletter')) { ?>
			<p>
	   	   		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','themeteam'); ?></label>
	       		<input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
       		</p>
	   <?php } else { ?>
       		<p>
	   	   		<label>You do not have ajax newsletter form installed</label>
	       		
       		</p>
       <?php } ?>
      <?php
   }
} 

register_widget('themeteam_subscribe');

/*---------------------------------------------------------------------------------*/
/* banner ads widget */
/*---------------------------------------------------------------------------------*/
class themeteam_social_twitter extends WP_Widget {
	function themeteam_social_twitter() {
	   $widget_ops = array('description' => 'Add your Social Links and Twitter.' );
       parent::WP_Widget(false, __('Theme Team - Twitter/Social Links', 'themeteam'),$widget_ops);      
   	}
   	
   	function widget($args, $instance) {  
		extract( $args );
		$title = $instance['title'];
		$social_title = $instance['social_title'];
    	$limit = $instance['limit']; if (!$limit) $limit = 5;
		$username = $instance['username'];
		
		$twitterName = $instance['twitterName'];
		$facebookName = $instance['facebookName'];
		$linkedInName = $instance['linkedInName'];
		$flickrName = $instance['flickrName'];
		$youTubeName = $instance['youTubeName'];

		echo $before_widget; ?>
		  <h3><?php echo $social_title; ?></h3>
          <ul id="social-links">
          <?php if($twitterName){ ?>
          	<li>
          		<a href="http://www.twitter.com/<?php echo $twitterName; ?>" target="_blank">
          			<img src="<?php bloginfo('template_directory'); ?>/images/i_twitter.gif" alt="Twitter1"/>
          		</a>
          	</li>
          <?php } if($facebookName){ ?>
          	<li>
          		<a href="http://www.facebook.com/<?php echo $facebookName; ?>" target="_blank">
          			<img src="<?php bloginfo('template_directory'); ?>/images/i_facebook.gif" alt="Facebook"/>
          		</a>
          	</li>
          <?php } if($linkedInName){ ?>
          	<li>
          		<a href="http://www.linkedin.com/in/<?php echo $linkedInName; ?>" target="_blank">
          			<img src="<?php bloginfo('template_directory'); ?>/images/i_linkedin.gif" alt="Linkedin"/>
          		</a>
          	</li>
          <?php } if($flickrName){ ?>
          	<li>
          		<a href="http://www.flickr.com/<?php echo $flickrName; ?>" target="_blank">
          			<img src="<?php bloginfo('template_directory'); ?>/images/i_flickr.gif" alt="Flickr"/>
          		</a>
          	</li>
          <?php } if($youTubeName){ ?>
          	<li>
          		<a href="http://www.youtube.com/user/<?php echo $youTubeName; ?>" target="_blank">
          			<img src="<?php bloginfo('template_directory'); ?>/images/i_socialYoutube.png" alt="Facebook" width="22" height="22"/>
          		</a>
          	</li>
          <?php } ?>
          	<li><a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/i_rss.gif" alt="RSS" /></a></li>
		  </ul>
		  <div style="clear:both;"></div>
		  <h3><?php echo $title;?></h3>
          <div id="tweet_list_comb">
		  </div>
		
		  <script type="text/javascript">
			jQuery(function(){
 				jQuery('#tweet_list_comb').tweetable({id: 'recent-tweets-<?php echo $username; ?>',username: '<?php echo $username; ?>', time: false, limit: <?php echo $limit; ?>, replies:false});
			});
		  </script>	 
	   <?php			
	   echo $after_widget;
   }
   
   function update($new_instance, $old_instance) {                
       return $new_instance;
   }
   
   function form($instance) {        
		$social_title = esc_attr($instance['social_title']);
		$title = esc_attr($instance['title']);
        $limit = esc_attr($instance['limit']);
	    $username = esc_attr($instance['username']);

       
		$twitterName = esc_attr($instance['twitterName']);
		$facebookName = esc_attr($instance['facebookName']);
		$linkedInName = esc_attr($instance['linkedInName']);
		$flickrName = esc_attr($instance['flickrName']);
		$youTubeName = esc_attr($instance['youTubeName']);
		?>
		<h3>Twitter Feed</h3>
		<p>
	   	   <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','origami'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>
        <p>
	   	   <label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Username:','origami'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('username'); ?>"  value="<?php echo $username; ?>" class="widefat" id="<?php echo $this->get_field_id('username'); ?>" />
        </p>
        <p>
	   	   <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Limit:','origami'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('limit'); ?>"  value="<?php echo $limit; ?>" class="" size="3" id="<?php echo $this->get_field_id('limit'); ?>" />

        </p>
        <h3>Social Links</h3>
        <p>
	   	   <label for="<?php echo $this->get_field_id('social_title'); ?>"><?php _e('Title:','origami'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('social_title'); ?>"  value="<?php echo $social_title; ?>" class="widefat" id="<?php echo $this->get_field_id('social_title'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('twitterName'); ?>">Twitter Name</label>
            <input type="text" name="<?php echo $this->get_field_name('twitterName'); ?>" value="<?php echo $twitterName; ?>" class="widefat" id="<?php echo $this->get_field_id('twitterName'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('facebookName'); ?>">Facebook Name</label>
            <input type="text" name="<?php echo $this->get_field_name('facebookName'); ?>" value="<?php echo $facebookName; ?>" class="widefat" id="<?php echo $this->get_field_id('facebookName'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('linkedInName'); ?>">Linkedin Name</label>
            <input type="text" name="<?php echo $this->get_field_name('linkedInName'); ?>" value="<?php echo $linkedInName; ?>" class="widefat" id="<?php echo $this->get_field_id('linkedInName'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('flickrName'); ?>">Flickr Name</label>
            <input type="text" name="<?php echo $this->get_field_name('flickrName'); ?>" value="<?php echo $flickrName; ?>" class="widefat" id="<?php echo $this->get_field_id('flickrName'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('youTubeName'); ?>">YouTube Name</label>
            <input type="text" name="<?php echo $this->get_field_name('youTubeName'); ?>" value="<?php echo $youTubeName; ?>" class="widefat" id="<?php echo $this->get_field_id('youTubeName'); ?>" />
        </p>
        
       	
		<?php
	}
}
register_widget('themeteam_social_twitter');
/*---------------------------------------------------------------------------------*/
/* footer links widget */
/*---------------------------------------------------------------------------------*/
class themeteam_footer_links extends WP_Widget {

   function themeteam_footer_links() {
	   $widget_ops = array('description' => 'Theme Team footer links.' );
       parent::WP_Widget(false, __('Theme Team - Footer Links', 'themeteam'),$widget_ops);      
   }

   function widget($args, $instance) {  
    extract( $args );
   	$title = $instance['title'];
	?>
		<?php echo $before_widget; ?>

        <?php if ($title) { echo $before_title . $title . $after_title; } ?>
		<?php wp_nav_menu(array('menu' => 'Widget Footer Links', 'theme_location' => 'footer_links', 'container' => '')); ?>
		<?php echo $after_widget; ?>   
   <?php
   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {        
   
       $title = esc_attr($instance['title']);

       ?>

			<p>
	   	   		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','themeteam'); ?></label>
	       		<input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
       		</p>
	   
      <?php
   }
} 

register_widget('themeteam_footer_links');
