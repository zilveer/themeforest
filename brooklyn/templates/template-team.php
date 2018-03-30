<?php

/**
 * Template Name: Team Template
 * by www.unitedthemes.com
 */

/* only include header for single pages */
if( is_page() ) { get_header(); } 

/* global member count */
global $ut_global_member_count;

/* local storage for member counter */
$ut_local_member_count = NULL;

/* get team data */
$team = get_post_meta( $post->ID , 'ut_team_member' , true );

/* needed vars */
$ut_page_skin = get_post_meta( $post->ID , 'ut_section_skin' , true);
$ut_page_class = get_post_meta( $post->ID , 'ut_section_class' , true);

/* member box layout and clear settings for style 3 */
$ut_member_box_layout 	= get_post_meta( $post->ID , 'ut_member_box_layout' , true);
$ut_member_box_size		= ''; // placeholder for future update
$ut_member_in_row   	= get_post_meta( $post->ID , 'ut_member_in_row' , true);
$clear 					= NULL;

$grid = array(  'three'  => array('class' => 'grid-33 tablet-grid-33 mobile-grid-100' , 'value' => '3'),
				'four' 	 => array('class' => 'grid-25 tablet-grid-50 mobile-grid-100' , 'value' => '4'), 
				'two'	 => array('class' => 'grid-50 tablet-grid-50 mobile-grid-50' , 'value' => '2'),
				'one'	 => array('class' => 'prefix-25 grid-50 mobile-grid-100 tablet-grid-50 tablet-prefix-25' , 'value' => '1')
		);
		

switch ( $grid[$ut_member_in_row]['value'] ) {
	
	case 2:
		$z = 0;
	break;
		
	case 3:
		$z = 4;
	break;
		
	case 4:
		$z = 5;
	break;
}

/* start output */
if( is_page() ) : ?>

<div class="grid-container">
	
    <div id="primary" class="grid-parent grid-100 tablet-grid-100 mobile-grid-100 <?php echo $ut_page_skin; ?> <?php echo $ut_page_class; ?>">
	    
		<?php while ( have_posts() ) : the_post(); ?>
    
            <?php get_template_part( 'partials/content', 'page' ); ?>
    
        <?php endwhile; // end of the loop. ?>
    
	<?php endif; ?>
		
        <?php if( !empty( $team ) && is_array($team)  ) : ?>
        
        <div class="member-wrap">
            
            <?php
            /*
            |--------------------------------------------------------------------------
            | Box Style One / Default
            |--------------------------------------------------------------------------
            */		
            ?>
            
            <?php if( $ut_member_box_layout == 'style_one' || empty($ut_member_box_layout) ) : ?>
            
            <?php $member_ID = $ut_global_member_count; foreach ( $team as $key => $member ) : ?>
            
                <div class="member-box ut-member-style-1 <?php echo $ut_member_box_size; ?> <?php echo $grid[$ut_member_in_row]['class']; ?>">            
                    
                    <?php $avatar_style = 'ut-square'; ?>
                    <?php //$avatar_style = $member['ut_avatar_style']; ?>
                    
                    <div class="mp-holder">
                            
                        <figure class="member-photo ut-touch-event">
                            
                            <?php 
                            
                            if( $avatar_style == 'ut-circle' ) {
                                
                                $member['ut_member_pic'] = ut_resize( $member['ut_member_pic'] , '560' , '560', true , true , true );						
                                
                            } else {
                                
                                $member['ut_member_pic'] = ut_resize( $member['ut_member_pic'] , '560' , '420', true , true , true );
                            
                            } 
                            
                            /* fallback */
                            if( empty( $member['ut_member_pic'] ) && function_exists( 'vc_asset_url' ) ) {
                                
                                 $member['ut_member_pic'] = vc_asset_url( 'vc/no_image.png' );
                                
                            }
                            
                            ?>
                            
                            <img class="utlazy" src="<?php echo THEME_WEB_ROOT; ?>/images/placeholder/team-member.png" alt="<?php echo $member['ut_member_name']; ?>" data-original="<?php echo $member['ut_member_pic']; ?>">
                        
                            <figcaption class="member-description">
                                <h3><?php echo $member['ut_member_name']; ?></h3>
                                <span><?php echo ut_translate_meta( $member['ut_member_title'] ); ?></span>
                                <a data-member="<?php echo $member_ID; ?>" href="#" class="ut-member-details ut-show-member-details <?php echo $avatar_style; ?>"><?php esc_html_e('View Details' , 'unitedthemes'); ?><i class="fa fa-arrow-circle-right"></i></a>
                            </figcaption>
                                
                        </figure>
                    
                    </div><!-- close mp-holder -->
                                
                </div>
                
                <?php $member_ID ++; endforeach; $ut_local_member_count = $member_ID; ?>
            
            <?php endif; ?>
            
            
            
            <?php
            /*
            |--------------------------------------------------------------------------
            | Box StyleTwo
            |--------------------------------------------------------------------------
            */		
            ?>
            
            <?php if( $ut_member_box_layout == 'style_two' ) : ?>
            
            <?php $member_ID = $ut_global_member_count; foreach ( $team as $key => $member ) : ?>
            
                <div class="member-box ut-member-style-2 <?php echo $ut_member_box_size; ?> <?php echo $grid[$ut_member_in_row]['class']; ?>">            
                    
                    <?php $avatar_style = 'ut-square'; ?>
                    <?php //$avatar_style = $member['ut_avatar_style']; ?>
                    
                    <div class="mp-holder">
                            
                        <figure class="member-photo ut-touch-event">
                            
                            <?php if( $avatar_style == 'ut-circle' ) {
                                
                                $member['ut_member_pic'] = ut_resize( $member['ut_member_pic'] , '560' , '560', true , true , true );						
                                
                            } else {
                                
                                $member['ut_member_pic'] = ut_resize( $member['ut_member_pic'] , '560' , '420', true , true , true );
                            
                            } 
                            
                            /* fallback */
                            if( empty( $member['ut_member_pic'] ) && function_exists( 'vc_asset_url' ) ) {
                                
                                 $member['ut_member_pic'] = vc_asset_url( 'vc/no_image.png' );
                                
                            }
                            
                            ?>
                            
                            <img class="utlazy" src="<?php echo THEME_WEB_ROOT; ?>/images/placeholder/team-member.png" alt="<?php echo $member['ut_member_name']; ?>" data-original="<?php echo $member['ut_member_pic']; ?>">
                        
                            <figcaption class="member-description">
                                
                                <h3 class="ut-member-name"><?php echo $member['ut_member_name']; ?></h3>
                                <span class="ut-member-title"><?php echo ut_translate_meta( $member['ut_member_title'] ); ?></span>
                                <?php echo apply_filters( 'the_content' , $member['ut_member_description'] ); ?>
                                
                                <?php if( !empty($member['ut_member_email']) ) : ?>    
                                    <a class="ut-so-link" href="mailto:<?php echo $member['ut_member_email']; ?>"><i class="fa fa-envelope fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_website']) ) : ?>    
                                    <a class="ut-so-link" href="<?php echo $member['ut_member_website']; ?>"><i class="fa fa-home fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_facebook']) ) : ?>    
                                    <a class="ut-so-link" href="<?php echo $member['ut_member_facebook']; ?>"><i class="fa fa-facebook fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_twitter']) ) : ?>    
                                    <a class="ut-so-link" href="<?php echo $member['ut_member_twitter']; ?>"><i class="fa fa-twitter fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_google']) ) : ?>    
                                    <a class="ut-so-link" href="<?php echo $member['ut_member_google']; ?>"><i class="fa fa-google-plus fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_github']) ) : ?>    
                                    <a class="ut-so-link" href="<?php echo $member['ut_member_github']; ?>"><i class="fa fa-github fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_skype']) ) : ?>    
                                    <a class="ut-so-link" href="<?php echo $member['ut_member_skype']; ?>"><i class="fa fa-skype fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_dribbble']) ) : ?>    
                                    <a class="ut-so-link" href="<?php echo $member['ut_member_dribbble']; ?>"><i class="fa fa-dribbble fa-lg"></i></a>
                                <?php endif; ?> 
                                
                                <?php if( !empty($member['ut_member_dropbox']) ) : ?>    
                                    <a class="ut-so-link" href="<?php echo $member['ut_member_dropbox']; ?>"><i class="fa fa-dropbox fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_flickr']) ) : ?>    
                                    <a class="ut-so-link" href="<?php echo $member['ut_member_flickr']; ?>"><i class="fa fa-flickr fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_xing']) ) : ?>    
                                    <a class="ut-so-link" href="<?php echo $member['ut_member_xing']; ?>"><i class="fa fa-xing fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_youtube']) ) : ?>    
                                    <a class="ut-so-link" href="<?php echo $member['ut_member_youtube']; ?>"><i class="fa fa-youtube fa-lg"></i></a>
                                <?php endif; ?>                
                                
                                <?php if( !empty($member['ut_member_vimeo']) ) : ?>    
                                    <a class="ut-so-link" href="<?php echo $member['ut_member_vimeo']; ?>"><i class="fa fa-vimeo-square fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_linkedin']) ) : ?>    
                                    <a class="ut-so-link" href="<?php echo $member['ut_member_linkedin']; ?>"><i class="fa fa-linkedin fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_instagram']) ) : ?>    
                                    <a class="ut-so-link" href="<?php echo $member['ut_member_instagram']; ?>"><i class="fa fa-instagram fa-lg"></i></a>
                                <?php endif; ?> 
                                
                            </figcaption>
                                
                        </figure>
                                                                             
                    
                    </div><!-- close mp-holder -->
                                
                </div>
                
                <?php $member_ID ++; endforeach; $ut_local_member_count = $member_ID; ?>
            
            <?php endif; ?>
            
            
            
            <?php
            /*
            |--------------------------------------------------------------------------
            | Box Style Three
            |--------------------------------------------------------------------------
            */		
            ?>
            
            <?php if( $ut_member_box_layout == 'style_three' ) : ?>
            
            <?php $member_ID = $ut_global_member_count; foreach ( $team as $key => $member ) : $clear = ''; ?>
            
                <div class="member-box ut-member-style-3 <?php echo $ut_member_box_size; ?> <?php echo $grid[$ut_member_in_row]['class']; ?>">            
                    
                    <?php $avatar_style = 'ut-square'; ?>
                    <?php //$avatar_style = $member['ut_avatar_style']; ?>
                    
                    <div class="mp-holder">
                        
                        <figure class="member-photo-style-3">
                            
                            <?php if( $avatar_style == 'ut-circle' ) {
                                
                                $member['ut_member_pic'] = ut_resize( $member['ut_member_pic'] , '560' , '560', true , true , true );						
                                
                            } else {
                                
                                $member['ut_member_pic'] = ut_resize( $member['ut_member_pic'] , '560' , '420', true , true , true );
                            
                            } 
                            
                            /* fallback */
                            if( empty( $member['ut_member_pic'] ) && function_exists( 'vc_asset_url' ) ) {
                                
                                 $member['ut_member_pic'] = vc_asset_url( 'vc/no_image.png' );
                                
                            }
                            
                            ?>
                            
                            <img class="utlazy" src="<?php echo THEME_WEB_ROOT; ?>/images/placeholder/team-member.png" alt="<?php echo $member['ut_member_name']; ?>" data-original="<?php echo $member['ut_member_pic']; ?>">
                            
                         </figure>
                         
                            <div class="member-description-style-3">
                                <h3 class="ut-member-name"><?php echo $member['ut_member_name']; ?></h3>
                                <span class="ut-member-title"><?php echo ut_translate_meta( $member['ut_member_title'] ); ?></span>
                                <?php echo apply_filters( 'the_content' , $member['ut_member_description'] ); ?>
                                
                                <div class="member-social">
                                <?php if( !empty($member['ut_member_email']) ) : ?>    
                                    <a href="mailto:<?php echo $member['ut_member_email']; ?>"><i class="fa fa-envelope fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_website']) ) : ?>    
                                    <a href="<?php echo $member['ut_member_website']; ?>"><i class="fa fa-home fa-lg"></i></a>
                                <?php endif; ?>
                
                                <?php if( !empty($member['ut_member_facebook']) ) : ?>    
                                    <a href="<?php echo $member['ut_member_facebook']; ?>"><i class="fa fa-facebook fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_twitter']) ) : ?>    
                                    <a href="<?php echo $member['ut_member_twitter']; ?>"><i class="fa fa-twitter fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_google']) ) : ?>    
                                    <a href="<?php echo $member['ut_member_google']; ?>"><i class="fa fa-google-plus fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_github']) ) : ?>    
                                    <a href="<?php echo $member['ut_member_github']; ?>"><i class="fa fa-github fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_skype']) ) : ?>    
                                    <a href="<?php echo $member['ut_member_skype']; ?>"><i class="fa fa-skype fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_dribbble']) ) : ?>    
                                    <a href="<?php echo $member['ut_member_dribbble']; ?>"><i class="fa fa-dribbble fa-lg"></i></a>
                                <?php endif; ?> 
                                
                                <?php if( !empty($member['ut_member_dropbox']) ) : ?>    
                                    <a href="<?php echo $member['ut_member_dropbox']; ?>"><i class="fa fa-dropbox fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_flickr']) ) : ?>    
                                    <a href="<?php echo $member['ut_member_flickr']; ?>"><i class="fa fa-flickr fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_xing']) ) : ?>    
                                    <a href="<?php echo $member['ut_member_xing']; ?>"><i class="fa fa-xing fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_youtube']) ) : ?>    
                                    <a href="<?php echo $member['ut_member_youtube']; ?>"><i class="fa fa-youtube fa-lg"></i></a>
                                <?php endif; ?>                
                                
                                <?php if( !empty($member['ut_member_vimeo']) ) : ?>    
                                    <a href="<?php echo $member['ut_member_vimeo']; ?>"><i class="fa fa-vimeo-square fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_linkedin']) ) : ?>    
                                    <a href="<?php echo $member['ut_member_linkedin']; ?>"><i class="fa fa-linkedin fa-lg"></i></a>
                                <?php endif; ?> 
                                
                                <?php if( !empty($member['ut_member_instagram']) ) : ?>    
                                    <a href="<?php echo $member['ut_member_instagram']; ?>"><i class="fa fa-instagram fa-lg"></i></a>
                                <?php endif; ?>
                                
                                </div><!-- close member social -->    
            
                            </div>                     
                    
                    </div><!-- close mp-holder -->
                                
                </div>
                
                <?php
				
				if( $grid[$ut_member_in_row]['value'] != '3' ) {
					
					if( $grid[$ut_member_in_row]['value'] == 2 ) { (($z%2)==0) ? $clear = '' : $clear = '<div class="clear"></div>'; }
					if( $grid[$ut_member_in_row]['value'] == 4 ) { (($z%4)==0) ? $clear = '<div class="clear"></div>' : $clear = ''; }
					
				} else { 
					
					if( ($z%3) == 0) { $clear = '<div class="clear"></div>'; $z = 3; } 
					
				} 
				
				echo !empty( $clear ) ? $clear : '';
				
				$member_ID++; $z++; endforeach; $ut_local_member_count = $member_ID; 
				
			endif; ?>
          	
            
            <?php
            /*
            |--------------------------------------------------------------------------
            | Box Style Four
            |--------------------------------------------------------------------------
            */		
            ?>
            
            <?php if( $ut_member_box_layout == 'style_four' || empty($ut_member_box_layout) ) : ?>
            
                        <?php $member_ID = $ut_global_member_count; foreach ( $team as $key => $member ) : $clear = ''; ?>
            
                <div class="member-box ut-member-style-4 <?php echo $ut_member_box_size; ?> <?php echo $grid[$ut_member_in_row]['class']; ?>">            
                    
                    <?php $avatar_style = 'ut-square'; ?>
                    <?php //$avatar_style = $member['ut_avatar_style']; ?>
                    
                    <div class="mp-holder">
                            
                        <div class="member-photo-style-4-wrap">
                        
                            <figure class="member-photo-style-4">
                                
                                <?php if( $avatar_style == 'ut-circle' ) {
                                    
                                    $member['ut_member_pic'] = ut_resize( $member['ut_member_pic'] , '560' , '640', true , true , true );
                                    
                                } else {
                                    
                                    $member['ut_member_pic'] = ut_resize( $member['ut_member_pic'] , '560' , '640', true , true , true );
                                
                                } 
                                
                                /* fallback */
                                if( empty( $member['ut_member_pic'] ) && function_exists( 'vc_asset_url' ) ) {
                                    
                                     $member['ut_member_pic'] = vc_asset_url( 'vc/no_image.png' );
                                    
                                }
                                
                                ?>
                                
                                <img class="utlazy" src="<?php echo THEME_WEB_ROOT; ?>/images/placeholder/team-member560x640.png" alt="<?php echo $member['ut_member_name']; ?>" data-original="<?php echo $member['ut_member_pic']; ?>">
                                                                
                             </figure>
                             
                             <?php if(!empty( $member['ut_member_pic_alt'] )) : ?>
                                    
                                     <?php if( $avatar_style == 'ut-circle' ) {
                                    
                                    $member['ut_member_pic_alt'] = ut_resize( $member['ut_member_pic_alt'] , '560' , '640', true , true , true );						
                                    
                                } else {
                                    
                                    $member['ut_member_pic_alt'] = ut_resize( $member['ut_member_pic_alt'] , '560' , '640', true , true , true );
                                
                                } 
                                
                                /* fallback */
                                if( empty( $member['ut_member_pic_alt'] ) && function_exists( 'vc_asset_url' ) ) {
                                    
                                     $member['ut_member_pic_alt'] = vc_asset_url( 'vc/no_image.png' );
                                    
                                }                                
                                
                                ?>
                                
                                <figure class="member-photo-style-4-hover">
                                    
                                    <img src="<?php echo $member['ut_member_pic_alt']; ?>" alt="<?php echo $member['ut_member_name']; ?>">
                                
                                </figure>
                                
                             <?php endif; ?>
                             
                             <div class="member-social">
                                
                                <?php if( !empty($member['ut_member_email']) ) : ?>    
                                    <a href="mailto:<?php echo $member['ut_member_email']; ?>"><i class="fa fa-envelope fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_website']) ) : ?>    
                                    <a href="<?php echo $member['ut_member_website']; ?>"><i class="fa fa-home fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_facebook']) ) : ?>    
                                    <a href="<?php echo $member['ut_member_facebook']; ?>"><i class="fa fa-facebook fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_twitter']) ) : ?>    
                                    <a href="<?php echo $member['ut_member_twitter']; ?>"><i class="fa fa-twitter fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_google']) ) : ?>    
                                    <a href="<?php echo $member['ut_member_google']; ?>"><i class="fa fa-google-plus fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_github']) ) : ?>    
                                    <a href="<?php echo $member['ut_member_github']; ?>"><i class="fa fa-github fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_skype']) ) : ?>    
                                    <a href="<?php echo $member['ut_member_skype']; ?>"><i class="fa fa-skype fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_dribbble']) ) : ?>    
                                    <a href="<?php echo $member['ut_member_dribbble']; ?>"><i class="fa fa-dribbble fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_dropbox']) ) : ?>    
                                    <a href="<?php echo $member['ut_member_dropbox']; ?>"><i class="fa fa-dropbox fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_flickr']) ) : ?>    
                                    <a href="<?php echo $member['ut_member_flickr']; ?>"><i class="fa fa-flickr fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_xing']) ) : ?>    
                                    <a href="<?php echo $member['ut_member_xing']; ?>"><i class="fa fa-xing fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_youtube']) ) : ?>    
                                    <a href="<?php echo $member['ut_member_youtube']; ?>"><i class="fa fa-youtube fa-lg"></i></a>
                                <?php endif; ?>                
                                
                                <?php if( !empty($member['ut_member_vimeo']) ) : ?>    
                                    <a href="<?php echo $member['ut_member_vimeo']; ?>"><i class="fa fa-vimeo-square fa-lg"></i></a>
                                <?php endif; ?>
                                
                                <?php if( !empty($member['ut_member_linkedin']) ) : ?>    
                                    <a href="<?php echo $member['ut_member_linkedin']; ?>"><i class="fa fa-linkedin fa-lg"></i></a>
                                <?php endif; ?> 
                                
                                <?php if( !empty($member['ut_member_instagram']) ) : ?>    
                                    <a href="<?php echo $member['ut_member_instagram']; ?>"><i class="fa fa-instagram fa-lg"></i></a>
                                <?php endif; ?>
                                
                                </div><!-- close member social -->                                
                         
                         </div>
                         
                            <div class="member-description-style-4">
                                <h3 class="ut-member-name"><?php echo $member['ut_member_name']; ?></h3>
                                <span class="ut-member-title"><?php echo ut_translate_meta( $member['ut_member_title'] ); ?></span>
                                <?php echo apply_filters( 'the_content' , $member['ut_member_description'] ); ?>
            
                            </div>                     
                                                 
                    
                    </div><!-- close mp-holder -->
                                
                </div>
                
                <?php
				
				if( $grid[$ut_member_in_row]['value'] != '3' ) {
					
					if( $grid[$ut_member_in_row]['value'] == 2 ) { (($z%2)==0) ? $clear = '' : $clear = '<div class="clear"></div>'; }
					if( $grid[$ut_member_in_row]['value'] == 4 ) { (($z%4)==0) ? $clear = '<div class="clear"></div>' : $clear = ''; }
					
				} else { 
					
					if( ($z%3) == 0) { $clear = '<div class="clear"></div>'; $z = 3; } 
					
				} 
				
				echo !empty( $clear ) ? $clear : '';
				
				$member_ID++; $z++; endforeach; $ut_local_member_count = $member_ID; ?>
            
            <?php endif; ?>
            
        </div>


		<?php
        
        /**
         * Markup for POPUP
         */
        
        $member_ID = $ut_global_member_count;
         
        ?>


		<?php foreach ( $team as $key => $member ) : ?>
        <div id="member_<?php echo $member_ID; ?>" class="ut-modal-box ut-modal-box-effect" data-id="<?php echo $post->post_name; ?>">
        
            <div class="member-detail-box grid-parent grid-100 mobile-grid-100 tablet-grid-100 section-content">
                
                <div class="grid-70 prefix-15 tablet-grid-100 mobile-grid-100 add-bottom">
                    <a class="ut-hide-member-details" href="#"><i class="fa fa-times-circle  fa-large"></i></a>
                </div>
                
                <div class="clear"></div>
                
                <?php 
                
                /* fallback */
                if( empty( $member['ut_member_pic'] ) && function_exists( 'vc_asset_url' ) ) {
                    
                     $member['ut_member_pic'] = vc_asset_url( 'vc/no_image.png' );
                    
                }
                
                if(!empty( $member['ut_member_pic'] )) : ?>
                    
                    <?php $avatar_style = 'ut-square'; ?>
                    <?php //$avatar_style = $member['ut_avatar_style']; ?>
                    
                    <!-- member photo -->
                    <div class="ut-mfh grid-70 prefix-15 tablet-grid-100 mobile-grid-100">
                        <figure class="member-photo-large <?php echo $avatar_style; ?>"><img class="<?php echo $avatar_style; ?>" alt="<?php echo $member['ut_member_name']; ?>" src="<?php echo $member['ut_member_pic']; ?>"></figure>
                    
                    <!-- member social -->
                    
                    <div class="member-social">
                    
                    <?php if( !empty($member['ut_member_email']) ) : ?>    
                        <a href="mailto:<?php echo $member['ut_member_email']; ?>"><i class="fa fa-envelope fa-lg"></i></a>
                    <?php endif; ?>
                    
                    <?php if( !empty($member['ut_member_website']) ) : ?>    
                        <a href="<?php echo $member['ut_member_website']; ?>"><i class="fa fa-home fa-lg"></i></a>
                    <?php endif; ?>
                        
                    <?php if( !empty($member['ut_member_facebook']) ) : ?>    
                        <a href="<?php echo $member['ut_member_facebook']; ?>"><i class="fa fa-facebook fa-lg"></i></a>
                    <?php endif; ?>
                    
                    <?php if( !empty($member['ut_member_twitter']) ) : ?>    
                        <a href="<?php echo $member['ut_member_twitter']; ?>"><i class="fa fa-twitter fa-lg"></i></a>
                    <?php endif; ?>
                    
                    <?php if( !empty($member['ut_member_google']) ) : ?>    
                        <a href="<?php echo $member['ut_member_google']; ?>"><i class="fa fa-google-plus fa-lg"></i></a>
                    <?php endif; ?>
                    
                    <?php if( !empty($member['ut_member_github']) ) : ?>    
                        <a href="<?php echo $member['ut_member_github']; ?>"><i class="fa fa-github fa-lg"></i></a>
                    <?php endif; ?>
                    
                    <?php if( !empty($member['ut_member_skype']) ) : ?>    
                        <a href="<?php echo $member['ut_member_skype']; ?>"><i class="fa fa-skype fa-lg"></i></a>
                    <?php endif; ?>
                    
                    <?php if( !empty($member['ut_member_dribbble']) ) : ?>    
                        <a href="<?php echo $member['ut_member_dribbble']; ?>"><i class="fa fa-dribbble fa-lg"></i></a>
                    <?php endif; ?> 
                    
                    <?php if( !empty($member['ut_member_dropbox']) ) : ?>    
                        <a href="<?php echo $member['ut_member_dropbox']; ?>"><i class="fa fa-dropbox fa-lg"></i></a>
                    <?php endif; ?>
                    
                    <?php if( !empty($member['ut_member_flickr']) ) : ?>    
                        <a href="<?php echo $member['ut_member_flickr']; ?>"><i class="fa fa-flickr fa-lg"></i></a>
                    <?php endif; ?>
                    
                    <?php if( !empty($member['ut_member_xing']) ) : ?>    
                        <a href="<?php echo $member['ut_member_xing']; ?>"><i class="fa fa-xing fa-lg"></i></a>
                    <?php endif; ?>
                    
                    <?php if( !empty($member['ut_member_youtube']) ) : ?>    
                        <a href="<?php echo $member['ut_member_youtube']; ?>"><i class="fa fa-youtube fa-lg"></i></a>
                    <?php endif; ?>                
                    
                    <?php if( !empty($member['ut_member_vimeo']) ) : ?>    
                        <a href="<?php echo $member['ut_member_vimeo']; ?>"><i class="fa fa-vimeo-square fa-lg"></i></a>
                    <?php endif; ?> 
                    
                    <?php if( !empty($member['ut_member_linkedin']) ) : ?>    
                        <a href="<?php echo $member['ut_member_linkedin']; ?>"><i class="fa fa-linkedin fa-lg"></i></a>
                    <?php endif; ?> 
                    
                    </div><!-- close member social -->    
                        
                </div><!-- close member photo -->
                    
                <?php endif; ?>
                
                <!-- memeber box -->
                <div class="grid-70 prefix-15 tablet-grid-100 mobile-grid-100">
                <div class="member-box">
                    <h3 class="ut-member-name"><?php echo $member['ut_member_name']; ?></h3>
                    <span class="ut-member-title"><?php echo ut_translate_meta( $member['ut_member_title'] ); ?></span>
                    <?php echo apply_filters( 'the_content' , $member['ut_member_description'] ); ?>
                </div>
                </div><!-- close member box -->
                
                <div class="clear"></div>
                            
            </div>
        
        </div>
         
        <?php $member_ID ++; endforeach; ?>
    
	<div class="ut-overlay"></div>
	
    <?php endif; ?>
    
	<?php if( is_page() ) : ?>

	</div><!-- close #primary -->
</div><!-- close grid-container -->

<?php endif; ?>

<?php $ut_global_member_count = $ut_local_member_count; ?>

<?php if( is_page() ) { get_footer(); } ?>