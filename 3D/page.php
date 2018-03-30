<?php
/**
 * @package WordPress
 * @subpackage 3D
 * @since Idea 3D
 * Graphic Desing : Ilkay ALPGIRAY
 * Code : Mustafa TANRIVERDI
 */
?>

<?php get_header(); ?>
  
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<!-- Tab Menu Slide -->
    <div class="tabmenu-back-two"></div>
    <div class="grid_24 bigtitle">
    	<h1 class="tabmenu-bigtitle-two"><strong><?php the_title(); ?></strong></h1>
    </div>
    
    <div class="clear"></div>
    
     <?php if(get_post_meta(get_the_id(), 'im_theme_full_normal_page', true) == 'NORMAL') { ?>
		<?php if(get_option('im_theme_sidebar_page_lr', true) == 'LEFT')
        {
            echo '<div class="grid_6">';
                get_sidebar(); 
            echo '</div><!-- /.grid16 -->';
            
            echo '<div class="grid_16 prefix_1 bloglist-main">'; 
        } 
        else 
        {
            echo '<div class="grid_16 suffix_1 bloglist-main-two">';
        } 
        ?>
	<?php } else { ?>
    	<div class="grid_24">
    <?php } ?>
     	
        <!-- Blog List #1 -->
        <div class="blogsingle">
            
			
            <?php if(get_post_meta(get_the_id(), 'im_theme_full_normal_page', true) == 'NORMAL') { ?>
        
                 <?php if(wp_get_attachment_url( get_post_thumbnail_id(get_the_id()))) { ?>
                 <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_id())); ?>" class="fancypicture" title="<?php the_title(); ?>">
                    <?php the_post_thumbnail('single-thumb', array('class' => 'bloglist-big')); ?> 
                </a>
                <?php } ?>
    
			<?php } else { ?>
                 
				 <?php if(wp_get_attachment_url( get_post_thumbnail_id(get_the_id()))) { ?>
                 <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_id())); ?>" class="fancypicture" title="<?php the_title(); ?>">
                    <?php the_post_thumbnail('page-full-thumb', array('class' => 'bloglist-big')); ?> 
                </a>
                <?php } ?>
                
            <?php } ?>
            
			
			
            
            
            <?php if(get_post_meta(get_the_ID(), 'im_theme_page_type', true) == 'CONTACT') { ?>
            	<?php echo str_replace('\\', '', get_option('im_theme_contact_maps_iframe_code',true)); ?>
            <?php } ?>
            
            
            
				<?php the_content(); ?>
		</div>
    <div class="clear"></div>

<?php endwhile; ?> 


<?php if(get_post_meta(get_the_ID(), 'im_theme_page_type', true) == 'CONTACT') { ?>



<div class="comment-blog">
    <h1 class="comment-title"><?php lang('Contact Form'); ?></h1>
    <div class="comment-form">
    <form name="form_im_theme_contact_form_mail" id="form_im_theme_contact_form_mail" method="POST" action="<?php bloginfo('template_url'); ?>/inc/contact.php">
        
        <fieldset><input name="name" type="text" value="<?php lang('Name'); ?>:" onfocus="if(this.value=='<?php lang('Name'); ?>:')this.value='';" onblur=	"if(this.value=='')this.value='<?php lang('Name'); ?>:';"/></fieldset>  
        <fieldset><input name="email" type="text" value="<?php lang('E-Mail'); ?>:" onfocus="if(this.value=='<?php lang('E-Mail'); ?>:')this.value='';" onblur=	"if(this.value=='')this.value='<?php lang('E-Mail'); ?>:';"/></fieldset>
        <fieldset><input name="web" type="text" value="<?php lang('Web'); ?>:" onfocus="if(this.value=='<?php lang('Web'); ?>:')this.value='';" onblur=	"if(this.value=='')this.value='<?php lang('Web'); ?>:';"/></fieldset>
        <fieldset><textarea name="message" onfocus="if(this.value=='<?php lang('Message'); ?>:')this.value='';" onblur=	"if(this.value=='')this.value='<?php lang('Message'); ?>:';"><?php lang('Message'); ?>:</textarea></fieldset>
        <input type="hidden" name="im_theme_contact_form_mail" value="" />
        <a href="#" class="More3d comment-button" onclick="document.getElementById('form_im_theme_contact_form_mail').submit();"><?php lang('Send'); ?></a>
     </form>
    </div>
</div>
<?php } ?>


<?php if(get_post_meta(get_the_ID(), 'im_theme_page_type', true) == 'LOGO_PAGE') { ?>
 <div class="sponsor-page">
        
        	<div class="sponsorListHolder">

				
                <?php
				global $wpdb;	$prefix = $wpdb->prefix;
				$query_homepage_slider = mysql_query("SELECT * FROM ".$prefix."iam WHERE title='logo_page' ORDER BY ord ASC");
				while($list_homepage_slider = mysql_fetch_assoc($query_homepage_slider))
				{
					$q_slider_id = $list_homepage_slider['id'];
					$q_slider_image_url = $list_homepage_slider['value1'];
					$q_slider_url = $list_homepage_slider['value3'];
					$q_slider_description = str_replace('\\','',$list_homepage_slider['value4']);
				?>
                <!-- # -->
                <div class="sponsor" title="<?php lang('Click to flip'); ?>">
					<div class="sponsorFlip">
						<img src="<?php echo $q_slider_image_url; ?>" width="140" height="140" />
					</div>
					
					<div class="sponsorData">
						<div class="sponsorDescription">
							<?php echo $q_slider_description; ?>
						</div>
                        <div class="sponsorURL">
							<a href="<?php echo $q_slider_url; ?>"><?php echo $q_slider_url; ?></a>
						</div>
						
					</div>
				</div>
                
                <?php 
				} 
				?>
        	</div>
    	<div class="clear"></div>
    </div>
        
       
<?php } ?>




<?php if ( comments_open() ) :?>
	<?php comments_template( '', true ); ?>
<?php endif; ?>

</div><!-- Blog Post List .grid_18 -->
    
	<?php if(get_post_meta(get_the_id(), 'im_theme_full_normal_page', true) == 'NORMAL') { ?>
		<?php if(get_option('im_theme_sidebar_page_lr', true) == 'RIGHT')
        {
            echo '<div class="grid_6 sidebar-floatright">';
			get_sidebar(); 
		echo '</div><!-- /.grid16 prefix_1 -->';
        }
        ?>
    <?php } ?>
	
    <div class="clear"></div> 
    
    
<?php get_footer(); ?>
