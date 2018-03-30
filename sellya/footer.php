<?php
/**
 * @package sellya
 * @subpackage sellya
 */
global $smof_data ,$woocommerce;

?>

<footer id="footer">

	<?php if(is_active_sidebar('footer1')):?>
    <div id="footer_cnc" class="footer_sidebars">
        <div class="container">
            <div id="footer_cnc_content" class="row">
              <?php if ( ! dynamic_sidebar( 'footer1' ) ) : ?>				
            
              <?php endif; // end Footer1 widget area ?>
            
              
            </div>
        </div>
    </div>
    <?php endif;?>
    
    <?php if(is_active_sidebar('footer2')):?>
    <div id="footer_info" class="footer_sidebars">
        <div class="container">
            <div id="footer_info_content" class="row">
              <?php if ( ! dynamic_sidebar( 'footer2' ) ) : ?>				
            
              <?php endif; // end Footer2 widget area ?> 
            </div>
        </div>
    </div>
    <?php endif;?>
 

<div id="footer_cr">
<div class="container">
<div id="footer_cr_content" class="row">
	<?php if($smof_data['sellya_payment_status'] != 0):?>

    <div class="span4">  
        <div id="payment_logos"> 
            
            <?php if($smof_data['sellya_paypal']!=''):?>
            
            <img src="<?php echo $smof_data['sellya_paypal'] ;  ?>" alt="PayPal" title="PayPal">
            
            <?php endif;?>
            
            <?php if($smof_data['sellya_visa']!=''):?>
            
            <img src="<?php echo $smof_data['sellya_visa'] ;  ?>" alt="Visa" title="Visa">
            
            <?php endif;?>
            
            
            <?php if($smof_data['sellya_mastercart']!=''):?>
            
            <img src="<?php echo $smof_data['sellya_mastercart'] ;  ?>" alt="Master Card" title="Master Card">
            
            <?php endif;?>
            
            
            <?php if($smof_data['sellya_maestro']!=''):?>
            
            <img src="<?php echo $smof_data['sellya_maestro'] ;  ?>" alt="Maestro" title="Maestro">
            
            <?php endif;?>

            <?php if($smof_data['sellya_discover']!=''):?>
            
            <img src="<?php echo $smof_data['sellya_discover'] ;  ?>" alt="Discover" title="Discover">
            
            <?php endif;?>
            
            <?php if($smof_data['sellya_moneybookers']!=''):?>
            
            <img src="<?php echo $smof_data['sellya_moneybookers'] ;  ?>" alt="Moneybookers" title="Moneybookers">
            
            <?php endif;?>
            
            <?php if($smof_data['sellya_american_express']!=''):?>
            
            <img src="<?php echo $smof_data['sellya_american_express'] ;  ?>" alt="American Express" title="American Express">
            
            <?php endif;?>
        </div>
    </div>
	<?php endif;?>


<div class="span4">
<?php if($smof_data['sellya_credits_status'] != 0):?>

<div id="powered_content">
 <?php echo $smof_data['sellya_credits'];?>                   
</div>
<?php endif;?>

</div>
<?php if($smof_data['sellya_follow_status'] != 0):?>
<div class="span4">      
    <div id="follow_us">  
    
	<?php if(!empty($smof_data['sellya_facebook_id'])):?>
    
            <a href="<?php echo $smof_data['sellya_facebook_id'];?>" class="tiptip" title="Facebook" target="_blank">
            <img src="<?php echo get_template_directory_uri(); ?>/image/follow_us/f_logo.png" alt="Facebook" title="Facebook"></a>
           
    <?php endif;?>
    
   	<?php if(!empty($smof_data['sellya_twitter_id'])):?>
            <a href="<?php echo $smof_data['sellya_twitter_id'];?>" class="tiptip" title="Twitter" target="_blank">
            <img src="<?php echo get_template_directory_uri(); ?>/image/follow_us/t_logo.png" alt="Twitter" title="Twitter"></a>
    <?php endif;?>
    
    <?php if(!empty($smof_data['sellya_google_id'])):?>
			<a href="<?php echo $smof_data['sellya_google_id'];?>" class="tiptip" title="Google+" target="_blank">
            <img src="<?php echo get_template_directory_uri(); ?>/image/follow_us/g_logo.png" alt="Google+" title="Google+"></a>
    <?php endif;?>
               
    <?php if(!empty($smof_data['sellya_rss_id'])):?>
			<a href="<?php echo $smof_data['sellya_rss_id'];?>" class="tiptip" title="RSS" target="_blank">
            <img src="<?php echo get_template_directory_uri(); ?>/image/follow_us/r_logo.png" alt="RSS" title="RSS"></a>
    <?php endif;?>			
	
	<?php if(!empty($smof_data['sellya_pinterest_id'])):?>
                                
            <a href="<?php echo $smof_data['sellya_pinterest_id'];?>" class="tiptip" title="Pinterest" target="_blank">
            <img src="<?php echo get_template_directory_uri(); ?>/image/follow_us/p_logo.png" alt="Pinterest" title="Pinterest"></a>
    <?php endif;?>
    
    <?php if(!empty($smof_data['sellya_vimeo_id'])):?>
                
            <a href="<?php echo $smof_data['sellya_vimeo_id'];?>" class="tiptip" title="Vimeo" target="_blank">
            <img src="<?php echo get_template_directory_uri(); ?>/image/follow_us/v_logo.png" alt="Vimeo" title="Vimeo"></a>
            
    <?php endif;?>
        
	<?php if(!empty($smof_data['sellya_flickr_id'])):?>
            
			<a href="<?php echo $smof_data['sellya_flickr_id'];?>"  class="tiptip" title="Flickr" target="_blank">
            <img src="<?php echo get_template_directory_uri(); ?>/image/follow_us/fl_logo.png" alt="Flickr" title="Flickr"></a>
    <?php endif;?>
    
    <?php if(!empty($smof_data['sellya_linkedin_id'])):?>
            
			<a href="<?php echo $smof_data['sellya_linkedin_id'];?>"  class="tiptip" title="Linkedin" target="_blank">
            <img src="<?php echo get_template_directory_uri(); ?>/image/follow_us/l_logo.png" alt="Linkedin" title="Linkedin"></a>
    <?php endif;?>
    
    <?php if(!empty($smof_data['sellya_youtube'])):?>
            
			<a href="<?php echo $smof_data['sellya_youtube'];?>"  class="tiptip" title="Youtube" target="_blank">
            <img src="<?php echo get_template_directory_uri(); ?>/image/follow_us/y_logo.png" alt="Youtube" title="Youtube"></a>
    <?php endif;?>
    
    <?php if(!empty($smof_data['sellya_dribbble'])):?>
            
			<a href="<?php echo $smof_data['sellya_dribbble'];?>"  class="tiptip" title="Dribbble" target="_blank">
            <img src="<?php echo get_template_directory_uri(); ?>/image/follow_us/d_logo.png" alt="Dribbble" title="Dribbble"></a>
    <?php endif;?>
    
    
                   
    </div><!--#follow_us --> 
</div>     
<?php endif; ?>
</div>
</div>
</div>

<?php if($smof_data['sellya_faboutus_status'] != 0):?> 
<div id="footer_about">
<div id="footer_about_content" class="row">
	<?php echo $smof_data['sellya_faboutus_text'] ;?>
</div>
</div>
<?php endif;?>
</footer>

</div>

<?php wp_footer(); ?>

</body>
</html>