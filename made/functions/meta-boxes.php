<?php
global $oswcPostTypes;

// custom field help
add_action('add_meta_boxes', 'oswc_add_custom_box');

function oswc_add_custom_box() {
	
	global $oswcPostTypes;

	//PAGES
	//featured image size
	add_meta_box( 'oswc_featured_image_size', __( 'Featured Image Size', 'made' ), 'oswc_featured_image_size', 'page', 'side', 'low' );	
	//video input box
	add_meta_box( 'oswc_meta_video', __( 'Featured Video', 'made' ), 'oswc_meta_video', 'page', 'side', 'low' );	
	//misc meta box
	add_meta_box( 'oswc_meta_misc_page', __( 'Layout', 'made' ), 'oswc_meta_misc_page', 'page', 'normal', 'high' );	
	
	//POSTS
	//featured image size
	add_meta_box( 'oswc_featured_image_size', __( 'Featured Image Size', 'made' ), 'oswc_featured_image_size', 'post', 'side', 'low' );	
	//video input box
	add_meta_box( 'oswc_meta_video', __( 'Featured Video', 'made' ), 'oswc_meta_video', 'post', 'side', 'low' );	
	//misc meta box
	add_meta_box( 'oswc_meta_misc', __( 'Layout', 'made' ), 'oswc_meta_misc', 'post', 'normal', 'high' );		
	
	//REVIEWS
	foreach($oswcPostTypes->postTypes as $postType){
		//featured image size
		add_meta_box( 'oswc_featured_image_size', __( 'Featured Image Size', 'made' ), 'oswc_featured_image_size', $postType->id, 'side', 'low' );	
		//video input box
		add_meta_box( 'oswc_meta_video', __( 'Featured Video', 'made' ), 'oswc_meta_video', $postType->id, 'side', 'low' );	
		//rating info box
		add_meta_box( 'oswc_meta_rating', __( 'Rating Info', 'made' ), 'oswc_meta_rating', $postType->id, 'normal', 'high' );	
		//misc meta box
		add_meta_box( 'oswc_meta_misc', __( 'Layout', 'made' ), 'oswc_meta_misc', $postType->id, 'normal', 'high' );	
	}
	
}

//featured image size
function oswc_featured_image_size( )
{
	global $post;
	// Get values for filling in the inputs if we have them.
	$size = get_post_meta( $post->ID, 'Featured Image Size', true ); 

	// Nonce to verify intention later
	wp_nonce_field( 'oswc_meta_box_nonce', 'meta_box_nonce' );
	?>
	<p>
        <select name="Featured_Image_Size" id="Featured_Image_Size"> 
            <option value="medium" <?php selected( $size, 'medium' ); ?>><?php _e( 'Medium','made'); ?></option> 
            <option value="small" <?php selected( $size, 'small' ); ?>><?php _e( 'Small','made'); ?></option> 
            <option value="full" <?php selected( $size, 'full' ); ?>><?php _e( 'Full','made'); ?></option> 
            <option value="none" <?php selected( $size, 'none' ); ?>><?php _e( 'Hidden','made'); ?></option> 
        </select> 
	</p>
    
    <p style="border:1px solid #DDD;padding:12px;background:#FCFCFC;font-style:italic;color:#666;">
    
        <?php _e( 'These settings overwrite the site-wide settings in the theme options pages.','made'); ?>
        
    </p>
	<?php
}
//video input box
function oswc_meta_video( )
{
	global $post;
	// Get values for filling in the inputs if we have them.
	$video = get_post_meta( $post->ID, 'Video', true ); 

	// Nonce to verify intention later
	wp_nonce_field( 'oswc_meta_box_nonce', 'meta_box_nonce' );
	?>

	<textarea class="widefat" rows="5" id="Video" name="Video"><?php echo $video; ?></textarea>        
	
    <p style="border:1px solid #DDD;padding:12px;background:#FCFCFC;font-style:italic;color:#666;">
    
        <?php _e( 'Copy + Paste video embed code here. If you use this feature, the single post view will display the video instead of the featured image, and the rest of the site will use the featured image when displaying this post (e.g. home page and archive pages).','made'); ?>
        
    </p>
	<?php
}
//miscellaneous settings
function oswc_meta_misc( )
{
	global $post;
	// Get values for filling in the inputs if we have them.
	$dontmiss = get_post_meta( $post->ID, "Hide Don't Miss", true ); 
	$latest = get_post_meta( $post->ID, 'Hide Latest', true ); 
	$sharebox = get_post_meta( $post->ID, 'Hide Sharebox', true ); 
	$related = get_post_meta( $post->ID, 'Hide Related', true ); 
	$authorbox = get_post_meta( $post->ID, 'Hide Authorbox', true );
	$trending = get_post_meta( $post->ID, 'Hide Trending', true );
	$headerad = get_post_meta( $post->ID, 'Hide Header Ad', true );
	$menuad = get_post_meta( $post->ID, 'Hide Menu Ad', true );
	$latestad = get_post_meta( $post->ID, 'Hide Latest Ad', true );
	$overviewad = get_post_meta( $post->ID, 'Hide Overview Ad', true );
	$reviewad = get_post_meta( $post->ID, 'Hide Review Ad', true );
	$textad = get_post_meta( $post->ID, 'Hide Text Ad', true );
	$commentsad = get_post_meta( $post->ID, 'Hide Comments Ad', true );
	$background = get_post_meta( $post->ID, 'Background Image URL', true );

	// Nonce to verify intention later
	wp_nonce_field( 'oswc_meta_box_nonce', 'meta_box_nonce' );
	?>
    
    	<div style="border:1px solid #DDD;padding:12px;background:#FCFCFC;font-style:italic;color:#666;">
            
            <?php _e( "These settings overwrite the global settings in the theme options pages. Select 'Null' or leave blank to defer to the global setting. Note: not all settings will apply to all post types. For instance, Review Ad will only apply to review pages, not regular blog posts (so selecting it would be a moo point. You know, like a cow's opinion - it doesn't matter).","made"); ?>
        
        </div>
    
    	<table cellpadding="10" cellspacing="0" border="0">            
        <tr>
        <td valign="top"> 
        	
            <table cellpadding="4" cellspacing="0" border="0">  
            <tr>
            <td valign="top">        
        	<?php _e( "Don't Miss:",'made'); ?>
            </td>
            <td valign="top">
        	<input type="radio" name="DontMiss" id="DontMissShow" value="false" <?php checked( $dontmiss, 'false' ); ?> />
            <label for="DontMissShow"><?php _e( 'Show','made'); ?></label>
            <input type="radio" name="DontMiss" id="DontMissHide" value="true" <?php checked( $dontmiss, 'true' ); ?> />
            <label for="DontMissHide"><?php _e( 'Hide','made'); ?></label>
            <input type="radio" name="DontMiss" id="DontMissNone" value="null" <?php checked( $dontmiss, 'null' ); ?> />
            <label for="DontMissNone"><?php _e( 'Null','made'); ?></label>
            </td>
            </tr>          
            <tr>
            <td valign="top">        
        	<?php _e( 'Latest:','made'); ?>
            </td>
            <td valign="top">
        	<input type="radio" name="Latest" id="LatestShow" value="false" <?php checked( $latest, 'false' ); ?> />
            <label for="LatestShow"><?php _e( 'Show','made'); ?></label>
            <input type="radio" name="Latest" id="LatestHide" value="true" <?php checked( $latest, 'true' ); ?> />
            <label for="LatestHide"><?php _e( 'Hide','made'); ?></label>
            <input type="radio" name="Latest" id="LatestNone" value="null" <?php checked( $latest, 'null' ); ?> />
            <label for="LatestNone"><?php _e( 'Null','made'); ?></label>
            </td>
            </tr>
            <tr>
            <td valign="top">        
        	<?php _e( 'Sharebox:','made'); ?>
            </td>
            <td valign="top">
        	<input type="radio" name="Sharebox" id="ShareboxShow" value="false" <?php checked( $sharebox, 'false' ); ?> />
            <label for="ShareboxShow"><?php _e( 'Show','made'); ?></label>
            <input type="radio" name="Sharebox" id="ShareboxHide" value="true" <?php checked( $sharebox, 'true' ); ?> />
            <label for="ShareboxHide"><?php _e( 'Hide','made'); ?></label>
            <input type="radio" name="Sharebox" id="ShareboxNone" value="null" <?php checked( $sharebox, 'null' ); ?> />
            <label for="ShareboxNone"><?php _e( 'Null','made'); ?></label>
            </td>
            </tr>
            <tr>
            <td valign="top">
            <?php _e( 'Related:','made'); ?>
            </td>
            <td valign="top">
        	<input type="radio" name="Related" id="RelatedShow" value="false" <?php checked( $related, 'false' ); ?> />
            <label for="RelatedShow"><?php _e( 'Show','made'); ?></label>
            <input type="radio" name="Related" id="RelatedHide" value="true" <?php checked( $related, 'true' ); ?> />
            <label for="RelatedHide"><?php _e( 'Hide','made'); ?></label>
            <input type="radio" name="Related" id="RelatedNone" value="null" <?php checked( $related, 'null' ); ?> />
            <label for="RelatedNone"><?php _e( 'Null','made'); ?></label>
            </td>
            </tr>
            <tr>
            <td valign="top">        
            <?php _e( 'Authorbox:','made'); ?>
            </td>
            <td valign="top">
        	<input type="radio" name="Authorbox" id="AuthorboxShow" value="false" <?php checked( $authorbox, 'false' ); ?> />
            <label for="AuthorboxShow"><?php _e( 'Show','made'); ?></label>
            <input type="radio" name="Authorbox" id="AuthorboxHide" value="true" <?php checked( $authorbox, 'true' ); ?> />
            <label for="AuthorboxHide"><?php _e( 'Hide','made'); ?></label>
            <input type="radio" name="Authorbox" id="AuthorboxNone" value="null" <?php checked( $authorbox, 'null' ); ?> />
            <label for="AuthorboxNone"><?php _e( 'Null','made'); ?></label>
            </td>
            </tr>
            <tr>
            <td valign="top">
        	<?php _e( 'Trending:','made'); ?>
            </td>
            <td valign="top">
        	<input type="radio" name="Trending" id="TrendingShow" value="false" <?php checked( $trending, 'false' ); ?> />
            <label for="TrendingShow"><?php _e( 'Show','made'); ?></label>
            <input type="radio" name="Trending" id="TrendingHide" value="true" <?php checked( $trending, 'true' ); ?> />
            <label for="TrendingHide"><?php _e( 'Hide','made'); ?></label>
            <input type="radio" name="Trending" id="TrendingNone" value="null" <?php checked( $trending, 'null' ); ?> />
            <label for="TrendingNone"><?php _e( 'Null','made'); ?></label>
            </td>
            </tr>
            </table>
        
        </td>
        <td valign="top">
        
        	<table cellpadding="4" cellspacing="0" border="0">            
            <tr>
            <td valign="top">        
        	<?php _e( 'Header Ad:','made'); ?>
            </td>
            <td valign="top">
        	<input type="radio" name="Header_Ad" id="Header_AdShow" value="false" <?php checked( $headerad, 'false' ); ?> />
            <label for="Header_AdShow"><?php _e( 'Show','made'); ?></label>
            <input type="radio" name="Header_Ad" id="Header_AdHide" value="true" <?php checked( $headerad, 'true' ); ?> />
            <label for="Header_AdHide"><?php _e( 'Hide','made'); ?></label>
            <input type="radio" name="Header_Ad" id="Header_AdNone" value="null" <?php checked( $headerad, 'null' ); ?> />
            <label for="Header_AdNone"><?php _e( 'Null','made'); ?></label>
            </td>
            </tr>
            <tr>
            <td valign="top">        
            <?php _e( 'Menu Ad:','made'); ?>
            </td>
            <td valign="top">
        	<input type="radio" name="Menu_Ad" id="Menu_AdShow" value="false" <?php checked( $menuad, 'false' ); ?> />
            <label for="Menu_AdShow"><?php _e( 'Show','made'); ?></label>
            <input type="radio" name="Menu_Ad" id="Menu_AdHide" value="true" <?php checked( $menuad, 'true' ); ?> />
            <label for="Menu_AdHide"><?php _e( 'Hide','made'); ?></label>
            <input type="radio" name="Menu_Ad" id="Menu_AdNone" value="null" <?php checked( $menuad, 'null' ); ?> />
            <label for="Menu_AdNone"><?php _e( 'Null','made'); ?></label>
            </td>
            </tr>
            <tr>
            <td valign="top">            
            <?php _e( 'Latest Ad:','made'); ?>
            </td>
            <td valign="top">
        	<input type="radio" name="Latest_Ad" id="Latest_AdShow" value="false" <?php checked( $latestad, 'false' ); ?> />
            <label for="Latest_AdShow"><?php _e( 'Show','made'); ?></label>
            <input type="radio" name="Latest_Ad" id="Latest_AdHide" value="true" <?php checked( $latestad, 'true' ); ?> />
            <label for="Latest_AdHide"><?php _e( 'Hide','made'); ?></label>
            <input type="radio" name="Latest_Ad" id="Latest_AdNone" value="null" <?php checked( $latestad, 'null' ); ?> />
            <label for="Latest_AdNone"><?php _e( 'Null','made'); ?></label>
            </td>
            </tr>
            <tr>
            <td valign="top">
            <?php _e( 'Overview Ad:','made'); ?>
            </td>
            <td valign="top">
        	<input type="radio" name="Overview_Ad" id="Overview_AdShow" value="false" <?php checked( $overviewad, 'false' ); ?> />
            <label for="Overview_AdShow"><?php _e( 'Show','made'); ?></label>
            <input type="radio" name="Overview_Ad" id="Overview_AdHide" value="true" <?php checked( $overviewad, 'true' ); ?> />
            <label for="Overview_AdHide"><?php _e( 'Hide','made'); ?></label>
            <input type="radio" name="Overview_Ad" id="Overview_AdNone" value="null" <?php checked( $overviewad, 'null' ); ?> />
            <label for="Overview_AdNone"><?php _e( 'Null','made'); ?></label>
            <span style="color:#888;font-style:italic;">(reviews only)</span>
            </td>
            </tr>
            <tr>
            <td valign="top">
            <?php _e( 'Review Ad:','made'); ?>
            </td>
            <td valign="top">
        	<input type="radio" name="Review_Ad" id="Review_AdShow" value="false" <?php checked( $reviewad, 'false' ); ?> />
            <label for="Review_AdShow"><?php _e( 'Show','made'); ?></label>
            <input type="radio" name="Review_Ad" id="Review_AdHide" value="true" <?php checked( $reviewad, 'true' ); ?> />
            <label for="Review_AdHide"><?php _e( 'Hide','made'); ?></label>
            <input type="radio" name="Review_Ad" id="Review_AdNone" value="null" <?php checked( $reviewad, 'null' ); ?> />
            <label for="Review_AdNone"><?php _e( 'Null','made'); ?></label>
            <span style="color:#888;font-style:italic;">(reviews only)</span>
            </td>
            </tr>
            <tr>
            <td valign="top">
            <?php _e( 'Content Ad:','made'); ?>
            </td>
            <td valign="top">
        	<input type="radio" name="Text_Ad" id="Text_AdShow" value="false" <?php checked( $textad, 'false' ); ?> />
            <label for="Text_AdShow"><?php _e( 'Show','made'); ?></label>
            <input type="radio" name="Text_Ad" id="Text_AdHide" value="true" <?php checked( $textad, 'true' ); ?> />
            <label for="Text_AdHide"><?php _e( 'Hide','made'); ?></label>
            <input type="radio" name="Text_Ad" id="Text_AdNone" value="null" <?php checked( $textad, 'null' ); ?> />
            <label for="Text_AdNone"><?php _e( 'Null','made'); ?></label>
            <span style="color:#888;font-style:italic;">(posts only)</span>
            </td>
            </tr>
            <tr>
            <td valign="top">
            <?php _e( 'Comments Ad:','made'); ?>
            </td>
            <td valign="top">
        	<input type="radio" name="Comments_Ad" id="Comments_AdShow" value="false" <?php checked( $commentsad, 'false' ); ?> />
            <label for="Comments_AdShow"><?php _e( 'Show','made'); ?></label>
            <input type="radio" name="Comments_Ad" id="Comments_AdHide" value="true" <?php checked( $commentsad, 'true' ); ?> />
            <label for="Comments_AdHide"><?php _e( 'Hide','made'); ?></label>
            <input type="radio" name="Comments_Ad" id="Comments_AdNone" value="null" <?php checked( $commentsad, 'null' ); ?> />
            <label for="Comments_AdNone"><?php _e( 'Null','made'); ?></label>
            </td>
            </tr>
            </table>
        
        </td>
        </tr>
        </table>  
        
        <p>
            <label for="Background"><?php _e( 'Page-Specific Background Image URL','made'); ?></label> 
            <textarea class="widefat" id="Background" name="Background"><?php echo $background; ?></textarea>        
        </p>      
	
	<?php
}
//miscellaneous settings for pages only
function oswc_meta_misc_page( )
{
	global $post;
	// Get values for filling in the inputs if we have them.
	$dontmiss = get_post_meta( $post->ID, "Hide Don't Miss", true ); 
	$latest = get_post_meta( $post->ID, 'Hide Latest', true ); 
	$sharebox = get_post_meta( $post->ID, 'Hide Sharebox', true ); 
	$trending = get_post_meta( $post->ID, 'Hide Trending', true );
	$headerad = get_post_meta( $post->ID, 'Hide Header Ad', true );
	$menuad = get_post_meta( $post->ID, 'Hide Menu Ad', true );
	$latestad = get_post_meta( $post->ID, 'Hide Latest Ad', true );
	$background = get_post_meta( $post->ID, 'Background Image URL', true );

	// Nonce to verify intention later
	wp_nonce_field( 'oswc_meta_box_nonce', 'meta_box_nonce' );
	?>
    
    	<div style="border:1px solid #DDD;padding:12px;background:#FCFCFC;font-style:italic;color:#666;">
            
            <?php _e( 'These settings overwrite the global settings in the theme options pages. Select "Null" or leave blank to defer to the global setting.','made'); ?>
        
        </div>
    
    	<table cellpadding="10" cellspacing="0" border="0">            
        <tr>
        <td valign="top"> 
        	
            <table cellpadding="4" cellspacing="0" border="0">   
            <tr>
            <td valign="top">        
        	<?php _e( "Don't Miss:",'made'); ?>
            </td>
            <td valign="top">
        	<input type="radio" name="DontMiss" id="DontMissShow" value="false" <?php checked( $dontmiss, 'false' ); ?> />
            <label for="DontMissShow"><?php _e( 'Show','made'); ?></label>
            <input type="radio" name="DontMiss" id="DontMissHide" value="true" <?php checked( $dontmiss, 'true' ); ?> />
            <label for="DontMissHide"><?php _e( 'Hide','made'); ?></label>
            <input type="radio" name="DontMiss" id="DontMissNone" value="null" <?php checked( $dontmiss, 'null' ); ?> />
            <label for="DontMissNone"><?php _e( 'Null','made'); ?></label>
            </td>
            </tr>          
            <tr>
            <td valign="top">        
        	<?php _e( 'Latest:','made'); ?>
            </td>
            <td valign="top">
        	<input type="radio" name="Latest" id="LatestShow" value="false" <?php checked( $latest, 'false' ); ?> />
            <label for="LatestShow"><?php _e( 'Show','made'); ?></label>
            <input type="radio" name="Latest" id="LatestHide" value="true" <?php checked( $latest, 'true' ); ?> />
            <label for="LatestHide"><?php _e( 'Hide','made'); ?></label>
            <input type="radio" name="Latest" id="LatestNone" value="null" <?php checked( $latest, 'null' ); ?> />
            <label for="LatestNone"><?php _e( 'Null','made'); ?></label>
            </td>
            </tr>
            <tr>
            <td valign="top">        
        	<?php _e( 'Sharebox:','made'); ?>
            </td>
            <td valign="top">
        	<input type="radio" name="Sharebox" id="ShareboxShow" value="false" <?php checked( $sharebox, 'false' ); ?> />
            <label for="ShareboxShow"><?php _e( 'Show','made'); ?></label>
            <input type="radio" name="Sharebox" id="ShareboxHide" value="true" <?php checked( $sharebox, 'true' ); ?> />
            <label for="ShareboxHide"><?php _e( 'Hide','made'); ?></label>
            <input type="radio" name="Sharebox" id="ShareboxNone" value="null" <?php checked( $sharebox, 'null' ); ?> />
            <label for="ShareboxNone"><?php _e( 'Null','made'); ?></label>
            </td>
            </tr>
            <tr>
            <td valign="top">
        	<?php _e( 'Trending:','made'); ?>
            </td>
            <td valign="top">
        	<input type="radio" name="Trending" id="TrendingShow" value="false" <?php checked( $trending, 'false' ); ?> />
            <label for="TrendingShow"><?php _e( 'Show','made'); ?></label>
            <input type="radio" name="Trending" id="TrendingHide" value="true" <?php checked( $trending, 'true' ); ?> />
            <label for="TrendingHide"><?php _e( 'Hide','made'); ?></label>
            <input type="radio" name="Trending" id="TrendingNone" value="null" <?php checked( $trending, 'null' ); ?> />
            <label for="TrendingNone"><?php _e( 'Null','made'); ?></label>
            </td>
            </tr>    
            <tr>
            <td valign="top">        
        	<?php _e( 'Header Ad:','made'); ?>
            </td>
            <td valign="top">
        	<input type="radio" name="Header_Ad" id="Header_AdShow" value="false" <?php checked( $headerad, 'false' ); ?> />
            <label for="Header_AdShow"><?php _e( 'Show','made'); ?></label>
            <input type="radio" name="Header_Ad" id="Header_AdHide" value="true" <?php checked( $headerad, 'true' ); ?> />
            <label for="Header_AdHide"><?php _e( 'Hide','made'); ?></label>
            <input type="radio" name="Header_Ad" id="Header_AdNone" value="null" <?php checked( $headerad, 'null' ); ?> />
            <label for="Header_AdNone"><?php _e( 'Null','made'); ?></label>
            </td>
            </tr>
            <tr>
            <td valign="top">        
            <?php _e( 'Menu Ad:','made'); ?>
            </td>
            <td valign="top">
        	<input type="radio" name="Menu_Ad" id="Menu_AdShow" value="false" <?php checked( $menuad, 'false' ); ?> />
            <label for="Menu_AdShow"><?php _e( 'Show','made'); ?></label>
            <input type="radio" name="Menu_Ad" id="Menu_AdHide" value="true" <?php checked( $menuad, 'true' ); ?> />
            <label for="Menu_AdHide"><?php _e( 'Hide','made'); ?></label>
            <input type="radio" name="Menu_Ad" id="Menu_AdNone" value="null" <?php checked( $menuad, 'null' ); ?> />
            <label for="Menu_AdNone"><?php _e( 'Null','made'); ?></label>
            </td>
            </tr>
            <tr>
            <td valign="top">            
            <?php _e( 'Latest Ad:','made'); ?>
            </td>
            <td valign="top">
        	<input type="radio" name="Latest_Ad" id="Latest_AdShow" value="false" <?php checked( $latestad, 'false' ); ?> />
            <label for="Latest_AdShow"><?php _e( 'Show','made'); ?></label>
            <input type="radio" name="Latest_Ad" id="Latest_AdHide" value="true" <?php checked( $latestad, 'true' ); ?> />
            <label for="Latest_AdHide"><?php _e( 'Hide','made'); ?></label>
            <input type="radio" name="Latest_Ad" id="Latest_AdNone" value="null" <?php checked( $latestad, 'null' ); ?> />
            <label for="Latest_AdNone"><?php _e( 'Null','made'); ?></label>
            </td>
            </tr>
            </table>
        
        </td>
        </tr>
        </table>   
        
        <p>
            <label for="Background"><?php _e( 'Page-Specific Background Image URL','made'); ?></label> 
            <textarea class="widefat" id="Background" name="Background"><?php echo $background; ?></textarea>        
        </p>     
	
	<?php
}
function oswc_meta_rating( )
{
	global $post;
	// Nonce to verify intention later
	wp_nonce_field( 'oswc_meta_box_nonce', 'meta_box_nonce' );
	// Get values for filling in the inputs if we have them.
	$positives = get_post_meta( $post->ID, 'Positives', true ); 
	$negatives = get_post_meta( $post->ID, 'Negatives', true ); 
	?>
    
    <p>
    	<label for="positives"><?php _e( 'Positives','made'); ?></label> 
		<textarea class="widefat" id="Positives" name="Positives"><?php echo $positives; ?></textarea>        
	</p>
    <p>
    	<label for="negatives"><?php _e( 'Negatives','made'); ?></label> 
		<textarea class="widefat" id="Negatives" name="Negatives"><?php echo $negatives; ?></textarea>        
	</p>    
    
    <?php 	
	// get review-specific meta fields
	global $oswcPostTypes; 
	$postTypeId = get_post_type( $post->ID );	
	$postType = $oswcPostTypes->get_type_by_id($postTypeId);
	$meta_fields = $postType->meta_fields;
	foreach($meta_fields as $meta){
		//make backwards compatible
		if(is_object($meta)){
			$metaName = $meta->name;
		}else{
			$metaName = $meta;
		}
		$metaNameSafe = str_replace(" ","_",$metaName);
		$theMeta = get_post_meta($post->ID, $metaName, $single = true);	?>		
    	<p>
        <label for="<?php echo $metaNameSafe; ?>"><?php echo $metaName; ?></label> </td>
       	<textarea class="widefat" id="<?php echo $metaNameSafe; ?>" name="<?php echo $metaNameSafe; ?>"><?php echo $theMeta; ?></textarea>
        </p>
        
	<?php 
	} ?>  
   
    <div style="float:left;margin-right:20px;border:1px solid #CCC;background:#E3E3E3;padding:10px;display:inline-block;margin-top:10px;">    
        <table cellpadding="3" cellspacing="0" border="0">
        <?php 
        // get review-specific rating type
        $rating_type = $postType->rating_type;	
        $meta_fields = $postType->rating_criteria;	
        switch ($rating_type) {
            case 'stars': ?>
                <tr>
                <td colspan="2">
                    <b><?php _e( 'Rating','made'); ?></b>                           
                    <p class="description"><?php _e( 'Select number of stars','made'); ?></p>
                </td>
                </tr>
                <?php foreach($meta_fields as $meta) {	
                    //make backwards compatible
                    if(is_object($meta)){
                        $metaName = $meta->name;
                    }else{
                        $metaName = $meta;
                    }
                    $metaNameSafe = str_replace(" ","_",$metaName);
                    $theMeta = get_post_meta($post->ID, $metaName, $single = true);
                    ?>                
                    <tr>
                    <td><label for="<?php echo $metaNameSafe; ?>"><?php echo $metaName; ?></label></td>
                    <td>
                        <select name="<?php echo $metaNameSafe; ?>" id="<?php echo $metaNameSafe; ?>"> 
                            <option value="5" <?php selected( $theMeta, '5' ); ?>>5</option> 
                            <option value="4.5" <?php selected( $theMeta, '4.5' ); ?>>4.5</option>
                            <option value="4" <?php selected( $theMeta, '4' ); ?>>4</option>
                            <option value="3.5" <?php selected( $theMeta, '3.5' ); ?>>3.5</option>
                            <option value="3" <?php selected( $theMeta, '3' ); ?>>3</option>
                            <option value="2.5" <?php selected( $theMeta, '2.5' ); ?>>2.5</option>
                            <option value="2" <?php selected( $theMeta, '2' ); ?>>2</option>
                            <option value="1.5" <?php selected( $theMeta, '1.5' ); ?>>1.5</option>
                            <option value="1" <?php selected( $theMeta, '1' ); ?>>1</option>
                            <option value=".5" <?php selected( $theMeta, '.5' ); ?>>0.5</option>
                            <option value="0" <?php selected( $theMeta, '0' ); ?>>0</option>
                        </select> 
                    </td>
                    </tr>			 
                <?php } 
                break;
            case 'percentage': ?>
                <tr>
                <td colspan="2">
                    <b><?php _e( 'Rating','made'); ?></b>                           
                    <p class="description"><?php _e( 'Enter whole numbers from 0 to 100','made'); ?></p>
                </td>
                </tr>
                <?php foreach($meta_fields as $meta) {	
                    //make backwards compatible
                    if(is_object($meta)){
                        $metaName = $meta->name;
                    }else{
                        $metaName = $meta;
                    }
                    $metaNameSafe = str_replace(" ","_",$metaName);
                    $theMeta = get_post_meta($post->ID, $metaName, $single = true);
                    ?>
                    <tr>
                        <td><label for="<?php echo $metaNameSafe; ?>"><?php echo $metaName; ?></label> </td>
                        <td><input type="text" name="<?php echo $metaNameSafe; ?>" id="<?php echo $metaNameSafe; ?>" value="<?php echo $theMeta; ?>" style="width:40px;" /></td>       
                    </tr>			 
                <?php } 		
                break;
            case 'number': ?>
                <tr>
                <td colspan="2">
                    <b><?php _e( 'Rating','made'); ?></b>                           
                    <p class="description"><?php _e( 'Enter decimals from 0 to 10','made'); ?></p>
                </td>
                </tr>
                <?php foreach($meta_fields as $meta) {	
                    //make backwards compatible
                    if(is_object($meta)){
                        $metaName = $meta->name;
                    }else{
                        $metaName = $meta;
                    }
                    $metaNameSafe = str_replace(" ","_",$metaName);
                    $theMeta = get_post_meta($post->ID, $metaName, $single = true);
                    ?>                
                    <tr>
                        <td><label for="<?php echo $metaNameSafe; ?>"><?php echo $metaName; ?></label></td> 
                        <td><input type="text" name="<?php echo $metaNameSafe; ?>" id="<?php echo $metaNameSafe; ?>" value="<?php echo $theMeta; ?>" style="width:40px;" /></td>       
                    </tr>			 
                <?php }
            
                break;
            case 'letter': ?>
                <tr>
                <td colspan="2">
                    <b><?php _e( 'Rating','made'); ?></b>                           
                    <p class="description"><?php _e( 'Select letter grades','made'); ?></p>
                </td>
                </tr>        
                <?php foreach($meta_fields as $meta) {	
                    //make backwards compatible
                    if(is_object($meta)){
                        $metaName = $meta->name;
                    }else{
                        $metaName = $meta;
                    }
                    $metaNameSafe = str_replace(" ","_",$metaName);
                    $theMeta = get_post_meta($post->ID, $metaName, $single = true);
                    ?>
                    <tr>
                        <td><label for="<?php echo $metaNameSafe; ?>"><?php echo $metaName; ?></label></td>
                        <td>
                        <select name="<?php echo $metaNameSafe; ?>" id="<?php echo $metaNameSafe; ?>"> 
                            <option value="A+" <?php selected( $theMeta, 'A+' ); ?>>A+</option> 
                            <option value="A" <?php selected( $theMeta, 'A' ); ?>>A</option>
                            <option value="A-" <?php selected( $theMeta, 'A-' ); ?>>A-</option>
                            <option value="B+" <?php selected( $theMeta, 'B+' ); ?>>B+</option>
                            <option value="B" <?php selected( $theMeta, 'B' ); ?>>B</option>
                            <option value="B-" <?php selected( $theMeta, 'B-' ); ?>>B-</option>
                            <option value="C+" <?php selected( $theMeta, 'C+' ); ?>>C+</option>
                            <option value="C" <?php selected( $theMeta, 'C' ); ?>>C</option>
                            <option value="C-" <?php selected( $theMeta, 'C-' ); ?>>C-</option>
                            <option value="D+" <?php selected( $theMeta, 'D+' ); ?>>D+</option>
                            <option value="D" <?php selected( $theMeta, 'D' ); ?>>D</option>
                            <option value="D-" <?php selected( $theMeta, 'D-' ); ?>>D-</option>
                            <option value="F+" <?php selected( $theMeta, 'F+' ); ?>>F+</option>
                            <option value="F" <?php selected( $theMeta, 'F' ); ?>>F</option>
                        </select> 
                        </td>
                    </tr>			 
                <?php } 
            
                break;			
        } ?>
        </table>
    </div>
    <div style="float:left;width:380px;padding-top:25px;">
    	<?php $ratinghide = get_post_meta( $post->ID, 'Hide Rating', true ); ?>
        <b><?php _e( 'Hide Rating','made'); ?></b>                           
        <p class="description"><?php _e( 'You can post reviews that do not have ratings. If you select Hide, there will be no rating assigned to this post.','made'); ?></p>
        <input type="radio" name="Rating" id="RatingShow" value="false" <?php checked( $ratinghide, 'false' ); ?> />
        <label for="RatingShow"><?php _e( 'Show','made'); ?></label>
        <input type="radio" name="Rating" id="RatingHide" value="true" <?php checked( $ratinghide, 'true' ); ?> />
        <label for="RatingHide"><?php _e( 'Hide','made'); ?></label>
        <br /><br />
        
        <?php $overviewhide = get_post_meta( $post->ID, 'Hide Overview', true ); ?>
        <b><?php _e( 'Hide Overview','made'); ?></b>                           
        <p class="description"><?php _e( 'You can post reviews that do not have the overview section. If you select Hide, the entire overview section will not be displayed on this single review page.','made'); ?></p>
        <input type="radio" name="Overview" id="OverviewShow" value="false" <?php checked( $overviewhide, 'false' ); ?> />
        <label for="OverviewShow"><?php _e( 'Show','made'); ?></label>
        <input type="radio" name="Overview" id="OverviewHide" value="true" <?php checked( $overviewhide, 'true' ); ?> />
        <label for="OverviewHide"><?php _e( 'Hide','made'); ?></label>
        <br /><br />
        
        <?php $bottomlinehide = get_post_meta( $post->ID, 'Hide Bottom Line', true ); ?>
        <b><?php _e( 'Hide Bottom Line','made'); ?></b>                           
        <p class="description"><?php _e( 'The Bottom Line just grabs your post excerpt and displays it as the bottom line text. If you select Hide, the bottom line area will not be displayed on this single review page.','made'); ?></p>
        <input type="radio" name="BottomLine" id="BottomLineShow" value="false" <?php checked( $bottomlinehide, 'false' ); ?> />
        <label for="BottomLineShow"><?php _e( 'Show','made'); ?></label>
        <input type="radio" name="BottomLine" id="BottomLineHide" value="true" <?php checked( $bottomlinehide, 'true' ); ?> />
        <label for="BottomLineHide"><?php _e( 'Hide','made'); ?></label>
        <br /><br />
        
        <?php $fullarticlehide = get_post_meta( $post->ID, 'Hide Full Article Bar', true ); ?>
        <b><?php _e( 'Hide "Full Article" Bar','made'); ?></b>                           
        <p class="description"><?php _e( 'You can post reviews that do not have the full article bar. If you select Hide, the info bar with the "Full Article" text and the author will not be displayed on this single review page.','made'); ?></p>
        <input type="radio" name="FullArticle" id="FullArticleShow" value="false" <?php checked( $fullarticlehide, 'false' ); ?> />
        <label for="FullArticleShow"><?php _e( 'Show','made'); ?></label>
        <input type="radio" name="FullArticle" id="FullArticleHide" value="true" <?php checked( $fullarticlehide, 'true' ); ?> />
        <label for="FullArticleHide"><?php _e( 'Hide','made'); ?></label>
    </div> 
    <div style="clear:both;">&nbsp;</div>
<?php
}

//save all the meta boxes
add_action( 'save_post', 'oswc_meta_save' );
function oswc_meta_save( $id )
{
	global $post;
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

	if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'oswc_meta_box_nonce' ) ) return;

	if( !current_user_can( 'edit_post' ) ) return;

	$allowed = array(
		'p'	=> array()
	);

	update_post_meta( $id, 'Video', $_POST['Video'] );
	//update_post_meta( $id, 'Positives', wp_kses($_POST['Positives'], $allowed) );
	//update_post_meta( $id, 'Negatives', wp_kses($_POST['Negatives'], $allowed) );
	update_post_meta( $id, 'Positives', $_POST['Positives'] );
	update_post_meta( $id, 'Negatives', $_POST['Negatives'] );
	if( isset( $_POST['Featured_Image_Size'] ) )
		update_post_meta( $id, 'Featured Image Size', esc_attr( $_POST['Featured_Image_Size'] ) );
	if( isset( $_POST["DontMiss"] ) )
		update_post_meta( $id, "Hide Don't Miss", $_POST["DontMiss"] );
	if( isset( $_POST['Latest'] ) )
		update_post_meta( $id, 'Hide Latest', $_POST['Latest'] );
	if( isset( $_POST['Sharebox'] ) )
		update_post_meta( $id, 'Hide Sharebox', $_POST['Sharebox'] );
	if( isset( $_POST['Related'] ) )
		update_post_meta( $id, 'Hide Related', $_POST['Related'] );
	if( isset( $_POST['Authorbox'] ) )
		update_post_meta( $id, 'Hide Authorbox', $_POST['Authorbox'] );
	if( isset( $_POST['Trending'] ) )
		update_post_meta( $id, 'Hide Trending', $_POST['Trending'] );
	if( isset( $_POST['Header_Ad'] ) )
		update_post_meta( $id, 'Hide Header Ad', $_POST['Header_Ad'] );
	if( isset( $_POST['Menu_Ad'] ) )
		update_post_meta( $id, 'Hide Menu Ad', $_POST['Menu_Ad'] );
	if( isset( $_POST['Latest_Ad'] ) )
		update_post_meta( $id, 'Hide Latest Ad', $_POST['Latest_Ad'] );
	if( isset( $_POST['Overview_Ad'] ) )
		update_post_meta( $id, 'Hide Overview Ad', $_POST['Overview_Ad'] );
	if( isset( $_POST['Review_Ad'] ) )
		update_post_meta( $id, 'Hide Review Ad', $_POST['Review_Ad'] );
	if( isset( $_POST['Text_Ad'] ) )
		update_post_meta( $id, 'Hide Text Ad', $_POST['Text_Ad'] );
	if( isset( $_POST['Comments_Ad'] ) )
		update_post_meta( $id, 'Hide Comments Ad', $_POST['Comments_Ad'] );
	if( isset( $_POST['Rating'] ) )
		update_post_meta( $id, 'Hide Rating', $_POST['Rating'] );
	if( isset( $_POST['Overview'] ) )
		update_post_meta( $id, 'Hide Overview', $_POST['Overview'] );
	if( isset( $_POST['BottomLine'] ) )
		update_post_meta( $id, 'Hide Bottom Line', $_POST['BottomLine'] );
	if( isset( $_POST['FullArticle'] ) )
		update_post_meta( $id, 'Hide Full Article Bar', $_POST['FullArticle'] );
	if( isset( $_POST['Background'] ) )
		update_post_meta( $id, 'Background Image URL', $_POST['Background'] );
		
	// get review-specific meta fields
	global $oswcPostTypes; 
	$postTypeId = get_post_type( $post->ID );	
	$postType = $oswcPostTypes->get_type_by_id($postTypeId);
	$meta_fields = $postType->meta_fields;
	if(!empty($meta_fields)) {
		foreach($meta_fields as $meta){
			//make backwards compatible
			if(is_object($meta)){
				$metaName = $meta->name;
			}else{
				$metaName = $meta;
			}
			$metaNameSafe = str_replace(" ","_",$metaName); 
			//update_post_meta( $id, $metaName, wp_kses($_POST[$metaNameSafe], $allowed) );
			update_post_meta( $id, $metaName, $_POST[$metaNameSafe] );
		}
	}
	// get review-specific rating type
	$rating_type = $postType->rating_type;	
	$meta_fields = $postType->rating_criteria;	
	if(!empty($meta_fields)) {	
		foreach($meta_fields as $meta) {	
			//make backwards compatible
			if(is_object($meta)){
				$metaName = $meta->name;
			}else{
				$metaName = $meta;
			}
			$metaNameSafe = str_replace(" ","_",$metaName);
			$theMeta = get_post_meta($post->ID, $metaName, $single = true);
			//update_post_meta( $id, $metaName, wp_kses($_POST[$metaNameSafe], $allowed) );
			update_post_meta( $id, $metaName, $_POST[$metaNameSafe] );
		} 
	} 
}

?>