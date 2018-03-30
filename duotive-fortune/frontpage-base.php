<?php
/** PAGE TEMPLATE **/
/**
 * Template Name: Front Page Base Template
 */
if ( !function_exists('_recaptcha_qsencode') ) require_once('includes/recaptchalib.php'); 
get_header(); 
	$dt_FrontPageID = get_post_meta($post->ID, "front-page-template", true);
    $frontpage_order = get_option('frontpage-order-'.$dt_FrontPageID, 'row-intro,row-widgets,row-page-content,row-posts,row-latest-news,row-slideshow,row-tabs,row-from-blog,row-latest-work,row-latest-work-description,row-calltoaction,row-contact,row-partners');
    $frontpage_rows = explode(',',$frontpage_order);
    $separatorValidator = 0;
	$frontpageOutput = '';
	/* INTRO ROW */ 
	$dt_FrontPageIntro = get_option('dt_FrontPageIntro_'.$dt_FrontPageID, 'no');
        if( $dt_FrontPageIntro == 'yes' ):
        	$dt_FrontPageIntroOnly = get_option('dt_FrontPageIntroOnly_'.$dt_FrontPageID, 'no');
            $dt_FooterSharing = get_option('dt_FooterSharing', 'no');
            $dt_Footer = get_option('dt_Footer', 'no');
			$dt_FrontPageIntroClass = '';
			if ( $dt_FrontPageIntroOnly == 'yes' && $dt_FooterSharing == 'no' && $dt_Footer == 'no' ) $dt_FrontPageIntroClass = ' intro-only';
            $frontpageOutput .= '<header id="frontpage-intro" class="clearfix'.$dt_FrontPageIntroClass.'">'."\n";
                $dt_FrontPageIntroHeading = get_option('dt_FrontPageIntroHeading_'.$dt_FrontPageID, '');
                if ( $dt_FrontPageIntroHeading != '' ):
                    $frontpageOutput .= '<h1>'.$dt_FrontPageIntroHeading.'</h1>'."\n";
                endif;
                $dt_FrontPageIntroMainParagraph = get_option('dt_FrontPageIntroMainParagraph_'.$dt_FrontPageID, '');
                $dt_FrontPageIntroSecondaryParagraph = get_option('dt_FrontPageIntroSecondaryParagraph_'.$dt_FrontPageID, '');
                if ( $dt_FrontPageIntroMainParagraph != '' ): 
                    $class = '';
                    if ( $dt_FrontPageIntroSecondaryParagraph == '' ) $class = ' main-intro-full';
                    $frontpageOutput .= '<p class="main-intro'.$class.'">'.$dt_FrontPageIntroMainParagraph.'</p>'."\n";
                endif;
                if ( $dt_FrontPageIntroSecondaryParagraph != '' ):
                    $frontpageOutput .= '<p class="secondary-intro">'.$dt_FrontPageIntroSecondaryParagraph.'</p>'."\n";
                endif;
                if ( $dt_FrontPageIntroOnly == 'no' ):
                $frontpageOutput .= '<div class="content-header-sep"></div>'."\n";
                endif;
            $frontpageOutput .= '</header>'."\n";
        endif;
	/*  END INTRO ROW */
	$dt_FrontPageIntroTogglerClass = '';
    if ( $dt_FrontPageIntro == 'no' ) $dt_FrontPageIntroTogglerClass = ' frontpage-no-intro';
    $frontpageOutput .= '<div id="frontpage" class="clearfix'.$dt_FrontPageIntroTogglerClass.'">'."\n";
        foreach($frontpage_rows as $frontpage_row):
        	/* PAGE CONTENT */
            if ( $frontpage_row == 'row-page-content' ) :
				$dt_FrontPageContent = get_option('dt_FrontPageContent_'.$dt_FrontPageID, 'no');
                if ( $dt_FrontPageContent == 'yes' ):
                     $frontpageOutput .= '<div class="front-page-row clearfix">'."\n";
                        if ( have_posts() ) while ( have_posts() ) : the_post();
                        	$content = get_the_content();
							$content = apply_filters('the_content', $content);
							$content = str_replace(']]>', ']]&gt;', $content);
                        endwhile;
                        $frontpageOutput .= $content;
                    $frontpageOutput .= '</div>'."\n";  
					$separatorValidator = $separatorValidator + 1;
                endif;
			endif;
        	/* END OF PAGE CONTENT */                
			/* WIDGETS ROW */
           if ( $frontpage_row == 'row-widgets' ) :
				$dt_FrontPageWidgets = get_option('dt_FrontPageWidgets_'.$dt_FrontPageID, 'no');
                if ( $dt_FrontPageWidgets == 'yes' ) :
                    $frontpageOutput .= '<div class="front-page-row clearfix front-page-widget-areas">'."\n";
                    $dt_FrontPageWidgetNumber = get_option('dt_FrontPageWidgetNumber_'.$dt_FrontPageID, '3');
                    $dt_FrontPageWidgetClass = '';
                    if ( $dt_FrontPageWidgetNumber == 1 ) { $dt_FrontPageWidgetClass = 'dt-fullwidth'; $dt_FrontPageWidgetClassLast = ''; }					
                    if ( $dt_FrontPageWidgetNumber == 2 ) { $dt_FrontPageWidgetClass = 'dt-onehalf'; $dt_FrontPageWidgetClassLast = ' dt-onehalflast'; }
                    if ( $dt_FrontPageWidgetNumber == 3 ) { $dt_FrontPageWidgetClass = 'dt-onethird'; $dt_FrontPageWidgetClassLast = ' dt-onethirdlast'; }
                    if ( $dt_FrontPageWidgetNumber == 4 ) { $dt_FrontPageWidgetClass = 'dt-oneforth'; $dt_FrontPageWidgetClassLast = ' dt-oneforthlast'; }
					$frontpages = frontpages_require(); 
					$dt_FrontPageName = '';
					foreach($frontpages as $frontpageInstance ):
						if ( $frontpageInstance->ID == $dt_FrontPageID ) $dt_FrontPageName = $frontpageInstance->NAME;
					endforeach;
                    for ($i=1;$i<=$dt_FrontPageWidgetNumber;$i++):
                        $dt_FrontPageWidgetID = str_replace(' ','-',strtolower($dt_FrontPageName)).'-'.$i;
                        if ( is_active_sidebar($dt_FrontPageWidgetID) ):
							if ( $i == $dt_FrontPageWidgetNumber) $dt_FrontPageWidgetClass .= $dt_FrontPageWidgetClassLast;
                            $frontpageOutput .= '<div class="'.$dt_FrontPageWidgetClass.'">'."\n";
                                $frontpageOutput .= '<ul>'."\n";
                                    $frontpageOutput .= get_dynamic_sidebar($dt_FrontPageWidgetID);
                                $frontpageOutput .= '</ul>'."\n";
                            $frontpageOutput .= '</div>'."\n";
                        endif;
                    endfor;
                    $frontpageOutput .= '</div>'."\n";   
                    $separatorValidator = $separatorValidator + 1;
                endif;
            endif;
            /* END OF WIDGETS ROW */
            /*  ROW POSTS */
                if ( $frontpage_row == 'row-posts' ) :
                    $dt_FrontPagePosts = get_option('dt_FrontPagePosts_'.$dt_FrontPageID, 'no');
                    if( $dt_FrontPagePosts == 'yes' ):
                    $separatorValidator = $separatorValidator + 1;
                     $frontpageOutput .= '<div class="front-page-row clearfix front-page-posts">'."\n";
                        $dt_FrontPagePostsCount = get_option('dt_FrontPagePostsCount_'.$dt_FrontPageID, '3');
                        $dt_FrontPagePostsCategory = get_option('dt_FrontPagePostsCategory_'.$dt_FrontPageID, '');
                        query_posts( 'post_type=post&cat='.$dt_FrontPagePostsCategory.'&posts_per_page='.$dt_FrontPagePostsCount );
                        $postCounter = 1;
                        while ( have_posts() ) : the_post();
							$dt_FrontPagePostsLast = '';
							if ( $postCounter%3 == 0 ) $dt_FrontPagePostsLast = ' one-third-last';
                             $frontpageOutput .= '<div class="one-third'.$dt_FrontPagePostsLast.'">'."\n";
                                if ( has_post_thumbnail() ):
									$dt_CropLocation = get_option('dt_CropLocation','c');
                                    $dt_PostImageCrop = get_post_meta($post->ID, "dt_croplocation", true);
                                    if ( $dt_PostImageCrop == '' || $dt_PostImageCrop == 'inherit' ) $dt_PostImageCrop = $dt_CropLocation;
                                    $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) );
                                    $frontpageOutput .= '<a class="image-wrapper" href="'.get_permalink().'" title="'.get_the_title().'">'."\n";
                                       $frontpageOutput .= '<img src="'.resizeimagenoecho($thumbnail_src,280,150,$dt_PostImageCrop).'" alt="'.get_the_title().'" />'."\n";
                                    $frontpageOutput .= '</a>'."\n";
                                endif;
                                $frontpageOutput .= '<h6><a href="'.get_permalink().'" title="'.dt_Permalink.the_title_attribute( 'echo=0' ).'" rel="bookmark">'.get_the_title().'</a></h6>'."\n";
                                global $more; $more = 0;
								$frontpageOutput .= wpautop(get_the_content(''));
                                $frontpageOutput .= '<a class="more-link" href="'.get_permalink().'" title="'.get_the_title().'"><span><span>'.dt_ReadMore.'</span></span></a>'."\n";
                            $frontpageOutput .= '</div>'."\n";
                            if ( $postCounter%3 == 0 ) $frontpageOutput .= '<div class="clearfix"></div>'."\n";
                            $postCounter++;
                        endwhile;
                        wp_reset_query();
                    $frontpageOutput .= '</div>'."\n";
                   	endif ;       
                endif;
            /*  END ROW POSTS */
            /*  LATEST NEWS ROW */
                if ( $frontpage_row == 'row-latest-news' ):
                    $dt_FrontPageLatest = get_option('dt_FrontPageLatestNews_'.$dt_FrontPageID, 'no'); 
                    if( $dt_FrontPageLatest == 'yes' ):        
                        $class = '';
                        $elementWidth = get_option('dt_FrontPageLatestNewsWidth_'.$dt_FrontPageID, 'half-width');
                        if ( $elementWidth == 'full-width' ) { $separatorValidator = $separatorValidator + 1; }
                        if ( $elementWidth == 'half-width' ) { $class = ' front-page-half-row'; $separatorValidator = $separatorValidator + 0.5; }                   
                         $frontpageOutput .= '<div class="front-page-row clearfix front-page-latest-news'.$class.'">'."\n";
                            $dt_FrontPageLatestHeading = get_option('dt_FrontPageLatestHeading_'.$dt_FrontPageID, '');
                            if ( $dt_FrontPageLatestHeading != '' ):
                                $frontpageOutput .= '<h4>'.$dt_FrontPageLatestHeading.'</h4>'."\n";
                            endif;    
                            $dt_FrontPageLatestPostsCount = get_option('dt_FrontPageLatestPostsCount_'.$dt_FrontPageID, '3');
                            $dt_FrontPageLatestCategory = get_option('dt_FrontPageLatestCategory_'.$dt_FrontPageID, '');
                            query_posts( 'post_type=post&cat='.$dt_FrontPageLatestCategory.'&posts_per_page='.$dt_FrontPageLatestPostsCount );
                            $frontpageOutput .= '<div class="accordion">'."\n";
                                while ( have_posts() ) : the_post();
                                    $frontpageOutput .= '<h6><a href="#"><span class="date">'.get_the_time('jS M Y').'</span>'.get_the_title().'</a></h6>'."\n";
                                    $frontpageOutput .= '<div class="ui-accordion-content">'."\n";
                                        if ( has_post_thumbnail() ):
											$dt_CropLocation = get_option('dt_CropLocation','c');
                                            $dt_PostImageCrop = get_post_meta($post->ID, "dt_croplocation", true);
                                            if ( $dt_PostImageCrop == '' || $dt_PostImageCrop == 'inherit' ) $dt_PostImageCrop = $dt_CropLocation;                                      
                                            $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) );         
                                            $frontpageOutput .= '<a class="image-wrapper" href="'.get_permalink().'" title="'.get_the_title().'">'."\n";
                                                $frontpageOutput .= '<img src="'.resizeimagenoecho($thumbnail_src,115,105,$dt_PostImageCrop).'" alt="'.get_the_title().'" />'."\n";
                                            $frontpageOutput .= '</a>'."\n";              
                                        endif;
                                        $frontpageOutput .= '<div class="post-content">'."\n"; 
                                            $frontpageOutput .= '<span class="date">'.get_the_time('jS F Y').'</span>'."\n"; 
                                            $frontpageOutput .= '<h5><a href="'.get_permalink().'" title="'.dt_Permalink.the_title_attribute( 'echo=0' ).'" rel="bookmark">'.get_the_title().'</a></h5>'."\n"; 
                                            global $more; $more = 0;
											$frontpageOutput .= wpautop(get_the_content(''));
                                            $frontpageOutput .= '<a class="read-more" href="'.get_permalink().'" title="'.get_the_title().'">'.dt_ReadMore.'</a> '."\n";                        
                                        $frontpageOutput .= '</div>'."\n"; 
                                    $frontpageOutput .= '</div>'."\n"; 
                                endwhile;
                            $frontpageOutput .= '</div>'."\n"; 
                            wp_reset_query();
                        $frontpageOutput .= '</div>'."\n"; 
                    endif;               
                endif;
            /* END LATEST NEWS ROW */
            /*  SLIDESHOW ROW */
			    if ( $frontpage_row == 'row-slideshow' ):
                    $dt_FrontPageSlideshow = get_option('dt_FrontPageSlideshow_'.$dt_FrontPageID, 'no');
                    if( $dt_FrontPageSlideshow == 'yes' ):
                        $class = '';
                        $elementWidth = get_option('dt_FrontPageSlideshowWidth_'.$dt_FrontPageID, 'half-width');
                        if ( $elementWidth == 'full-width' ) { $separatorValidator = $separatorValidator + 1; }
                        if ( $elementWidth == 'half-width' ) { $class = ' front-page-half-row'; $separatorValidator = $separatorValidator + 0.5; }
						$frontpageOutput .= '<div class="front-page-row clearfix front-page-slideshow'.$class.'">'."\n"; 
                            $dt_FrontPageSlideshowHeading = get_option('dt_FrontPageSlideshowHeading_'.$dt_FrontPageID, '');
                            if ( $dt_FrontPageSlideshowHeading != '' ):
                                $frontpageOutput .= '<h4>'.$dt_FrontPageSlideshowHeading.'</h4>'."\n";
                            endif;
                            $dt_FrontPageSlideshowImages = get_option('dt_FrontPageSlideshowImages_'.$dt_FrontPageID, '');
                            if ( $dt_FrontPageSlideshowImages != '' ):
                                $dt_FrontPageSlideshowImages = explode("\n", $dt_FrontPageSlideshowImages);
                                if ( $elementWidth == 'half-width' ) $imageWidth = '435'; else $imageWidth = '900';
                                $imageHeight = str_replace('px','',get_option('dt_FrontPageSlideshowHeight_'.$dt_FrontPageID, '246'));
                                $dt_FrontPageSlideshowTransition = get_option('dt_FrontPageSlideshowTransition_'.$dt_FrontPageID, 'fade');
                                $dt_FrontPageSlideshowPause = get_option('dt_FrontPageSlideshowPause_'.$dt_FrontPageID, '3000');
                                $dt_FrontPageSlideshowSlices = get_option('dt_FrontPageSlideshowSlices_'.$dt_FrontPageID, '8');
                                $dt_FrontPageSlideshowBoxRows = get_option('dt_FrontPageSlideshowBoxRows_'.$dt_FrontPageID, '2');
                                $dt_FrontPageSlideshowBoxCols = get_option('dt_FrontPageSlideshowBoxCols'.$dt_FrontPageID, '4');
                                $frontpageOutput .= "<script type=\"text/javascript\">"."\n";
                                    $frontpageOutput .= "$(document).ready(function($) {"."\n";		
                                        $frontpageOutput .= "$('.slideshow-in-content').nivoSlider({"."\n";
                                            $frontpageOutput .= "effect: '".$dt_FrontPageSlideshowTransition."',"."\n";															   
                                            $frontpageOutput .= "pauseTime: ".$dt_FrontPageSlideshowPause.", "."\n";															   
                                            $frontpageOutput .= "slices: ".$dt_FrontPageSlideshowSlices.","."\n";
                                            $frontpageOutput .= "boxCols: ".$dt_FrontPageSlideshowBoxCols.","."\n";
                                            $frontpageOutput .= "boxRows: ".$dt_FrontPageSlideshowBoxRows.","."\n";
                                            $frontpageOutput .= "controlNav:false"."\n";
                                         $frontpageOutput .= "}); "."\n";
                                     $frontpageOutput .= "});"."\n";
                                $frontpageOutput .= "</script>"."\n";
                                $frontpageOutput .= '<div class="slideshow-in-content" style=" width:'.$imageWidth.'px; height:'.$imageHeight.'px;">'."\n";
                                    foreach($dt_FrontPageSlideshowImages as $dt_FrontPageSlideshowImage):
                                        $frontpageOutput .= '<img src="'.resizeimagenoecho(trim($dt_FrontPageSlideshowImage),$imageWidth,$imageHeight).'" alt=""/>'."\n";
                                    endforeach;
                                $frontpageOutput .= '</div>'."\n";
                                $dt_FrontPageSlideshowText = get_option('dt_FrontPageSlideshowText_'.$dt_FrontPageID, '');                    
                                $dt_FrontPageSlideshowButton = get_option('dt_FrontPageSlideshowButton_'.$dt_FrontPageID, '');                    								
                                $dt_FrontPageSlideshowUrl = get_option('dt_FrontPageSlideshowUrl_'.$dt_FrontPageID, '');
                                if ( $dt_FrontPageSlideshowText != '' ):
                                    $frontpageOutput .= '<p>'.$dt_FrontPageSlideshowText.'</p>'."\n";
                                endif;
                                if ( $dt_FrontPageSlideshowUrl != '' ):
                                    $frontpageOutput .= '<a href="'.$dt_FrontPageSlideshowUrl.'" class="read-more">'.$dt_FrontPageSlideshowButton.'</a>'."\n";
                                endif;
                            endif;
                        $frontpageOutput .= '</div>'."\n";
                    endif;
                endif;
            /* END SLIDESHOW ROW */
            /* TABS ROW */
                if ( $frontpage_row == 'row-tabs' ):
                    $dt_FrontPageTabs = get_option('dt_FrontPageTabs_'.$dt_FrontPageID, 'no');
                    if ( $dt_FrontPageTabs == 'yes' ):
                        $class = '';
                        $elementWidth = get_option('dt_FrontPageTabsWidth_'.$dt_FrontPageID, 'half-width');
                        if ( $elementWidth == 'full-width' ) { $separatorValidator = $separatorValidator + 1; }
                        if ( $elementWidth == 'half-width' ) { $class = ' front-page-half-row'; $separatorValidator = $separatorValidator + 0.5; }
                        $frontpageOutput .= '<div class="front-page-row clearfix front-page-tabs'.$class.'">'."\n";
                            $dt_FrontPageTabsHeading = get_option('dt_FrontPageTabsHeading_'.$dt_FrontPageID, '');
                            if ( $dt_FrontPageTabsHeading != '' ):
                                $frontpageOutput .= '<h4>'.$dt_FrontPageTabsHeading.'</h4>'."\n";
                            endif;
                            $dt_FrontPageTabsElementHeading_01 = get_option('dt_FrontPageTabsElementHeading_01_'.$dt_FrontPageID, '');
                            $dt_FrontPageTabsElementContent_01 = get_option('dt_FrontPageTabsElementContent_01_'.$dt_FrontPageID, '');
                            $dt_FrontPageTabsElementHeading_02 = get_option('dt_FrontPageTabsElementHeading_02_'.$dt_FrontPageID, '');
                            $dt_FrontPageTabsElementContent_02 = get_option('dt_FrontPageTabsElementContent_02_'.$dt_FrontPageID, '');
                            $dt_FrontPageTabsElementHeading_03 = get_option('dt_FrontPageTabsElementHeading_03_'.$dt_FrontPageID, '');
                            $dt_FrontPageTabsElementContent_03 = get_option('dt_FrontPageTabsElementContent_03_'.$dt_FrontPageID, '');
                            $dt_FrontPageTabsElementHeading_04 = get_option('dt_FrontPageTabsElementHeading_04_'.$dt_FrontPageID, '');
                            $dt_FrontPageTabsElementContent_04 = get_option('dt_FrontPageTabsElementContent_04_'.$dt_FrontPageID, '');
                            $dt_FrontPageTabsElementHeading_05 = get_option('dt_FrontPageTabsElementHeading_05_'.$dt_FrontPageID, '');
                            $dt_FrontPageTabsElementContent_05 = get_option('dt_FrontPageTabsElementContent_05_'.$dt_FrontPageID, '');
                            $dt_FrontPageTabsElementHeading_06 = get_option('dt_FrontPageTabsElementHeading_06_'.$dt_FrontPageID, '');
                            $dt_FrontPageTabsElementContent_06 = get_option('dt_FrontPageTabsElementContent_06_'.$dt_FrontPageID, '');
                            $dt_FrontPageTabsElementHeading_07 = get_option('dt_FrontPageTabsElementHeading_07_'.$dt_FrontPageID, '');
                            $dt_FrontPageTabsElementContent_07 = get_option('dt_FrontPageTabsElementContent_07_'.$dt_FrontPageID, '');
                            $dt_FrontPageTabsElementHeading_08 = get_option('dt_FrontPageTabsElementHeading_08_'.$dt_FrontPageID, '');
                            $dt_FrontPageTabsElementContent_08 = get_option('dt_FrontPageTabsElementContent_08_'.$dt_FrontPageID, '');
                            $frontpageOutput .= '<div class="tabs">'."\n";
                                $frontpageOutput .= '<ul class="ui-tabs-nav">'."\n";
                                    if ( $dt_FrontPageTabsElementHeading_01 != '' ):
                                   		$frontpageOutput .= '<li class="ui-state-active"><a href="#tabs-1">'.$dt_FrontPageTabsElementHeading_01.'</a></li>'."\n";
                                    endif;
                                    if ( $dt_FrontPageTabsElementHeading_02 != '' ):
                                    	$frontpageOutput .= '<li><a href="#tabs-2">'.$dt_FrontPageTabsElementHeading_02.'</a></li>'."\n";
                                    endif;
                                    if ( $dt_FrontPageTabsElementHeading_03 != '' ):
                                    	$frontpageOutput .= '<li><a href="#tabs-3">'.$dt_FrontPageTabsElementHeading_03.'</a></li>'."\n";
                                    endif;
                                    if ( $dt_FrontPageTabsElementHeading_04 != '' ):
                                    	$frontpageOutput .= '<li><a href="#tabs-4">'.$dt_FrontPageTabsElementHeading_04.'</a></li>'."\n";
                                    endif;
                                    if ( $dt_FrontPageTabsElementHeading_05 != '' ):
                                    	$frontpageOutput .= '<li><a href="#tabs-5">'.$dt_FrontPageTabsElementHeading_05.'</a></li>'."\n";
                                    endif;
                                    if ( $dt_FrontPageTabsElementHeading_06 != '' ):
                                    	$frontpageOutput .= '<li><a href="#tabs-6">'.$dt_FrontPageTabsElementHeading_06.'</a></li>'."\n";
                                    endif;
                                    if ( $dt_FrontPageTabsElementHeading_07 != '' ):
                                    	$frontpageOutput .= '<li><a href="#tabs-7">'.$dt_FrontPageTabsElementHeading_07.'</a></li>'."\n";
                                    endif;
                                    if ( $dt_FrontPageTabsElementHeading_08 != '' ):
                                    	$frontpageOutput .= '<li><a href="#tabs-8">'.$dt_FrontPageTabsElementHeading_08.'</a></li>'."\n";
                                    endif;
                                $frontpageOutput .= '</ul>'."\n";
                                if ( $dt_FrontPageTabsElementContent_01 != '' ):
                                $frontpageOutput .= '<div id="tabs-1" class="ui-tabs-panel">'."\n";
                                    $frontpageOutput .= '<p>'.do_shortcode($dt_FrontPageTabsElementContent_01).'</p>'."\n";
                                $frontpageOutput .= '</div>'."\n";
                                endif;
                                if ( $dt_FrontPageTabsElementContent_02 != '' ):
                                $frontpageOutput .= '<div id="tabs-2" class="ui-tabs-panel ui-tabs-hide">'."\n";
                                    $frontpageOutput .= '<p>'.do_shortcode($dt_FrontPageTabsElementContent_02).'</p>'."\n";
                                $frontpageOutput .= '</div>'."\n";
                                endif;
                                if ( $dt_FrontPageTabsElementContent_03 != '' ):
                                $frontpageOutput .= '<div id="tabs-3" class="ui-tabs-panel ui-tabs-hide">'."\n";
                                    $frontpageOutput .= '<p>'.do_shortcode($dt_FrontPageTabsElementContent_03).'</p>'."\n";
                                $frontpageOutput .= '</div>'."\n";
                                endif;                           
                                if ( $dt_FrontPageTabsElementContent_04 != '' ):
                                $frontpageOutput .= '<div id="tabs-4" class="ui-tabs-panel ui-tabs-hide">'."\n";
                                    $frontpageOutput .= '<p>'.do_shortcode($dt_FrontPageTabsElementContent_04).'</p>'."\n";
                                $frontpageOutput .= '</div>'."\n";
                                endif;
                                if ( $dt_FrontPageTabsElementContent_05 != '' ):
                                $frontpageOutput .= '<div id="tabs-5" class="ui-tabs-panel ui-tabs-hide">'."\n";
                                    $frontpageOutput .= '<p>'.do_shortcode($dt_FrontPageTabsElementContent_05).'</p>'."\n";
                                $frontpageOutput .= '</div>'."\n";
                                endif;
                                if ( $dt_FrontPageTabsElementContent_06 != '' ):
                                $frontpageOutput .= '<div id="tabs-6" class="ui-tabs-panel ui-tabs-hide">'."\n";
                                    $frontpageOutput .= '<p>'.do_shortcode($dt_FrontPageTabsElementContent_06).'</p>'."\n";
                                $frontpageOutput .= '</div>'."\n";
                                endif;
                                if ( $dt_FrontPageTabsElementContent_07 != '' ):
                                $frontpageOutput .= '<div id="tabs-7" class="ui-tabs-panel ui-tabs-hide">'."\n";
                                    $frontpageOutput .= '<p>'.do_shortcode($dt_FrontPageTabsElementContent_07).'</p>'."\n";
                                $frontpageOutput .= '</div>'."\n";
                                endif; 
                                if ( $dt_FrontPageTabsElementContent_08 != '' ):
                                $frontpageOutput .= '<div id="tabs-8" class="ui-tabs-panel ui-tabs-hide">'."\n";
                                    $frontpageOutput .= '<p>'.do_shortcode($dt_FrontPageTabsElementContent_08).'</p>'."\n";
                                $frontpageOutput .= '</div>'."\n";
                                endif;                                                                                                                                                                                                    
                            $frontpageOutput .= '</div>'."\n";
						$frontpageOutput .= '</div>'."\n";                          
                    endif;
                endif;
			/* END TABS ROW */
            /* LATEST FROM BLOG */
            	if ( $frontpage_row == 'row-from-blog' ):
                    $dt_FrontPageFromBlog = get_option('dt_FrontPageFromBlog_'.$dt_FrontPageID, 'no');
                    if ( $dt_FrontPageFromBlog == 'yes' ):
                        $class = '';
                        $elementWidth = get_option('dt_FrontPageFromBlogWidth_'.$dt_FrontPageID, 'half-width');
                        if ( $elementWidth == 'full-width' ) { $separatorValidator = $separatorValidator + 1; }
                        if ( $elementWidth == 'half-width' ) { $class = ' front-page-half-row'; $separatorValidator = $separatorValidator + 0.5; }
                         $frontpageOutput .= '<div class="front-page-row clearfix front-page-from-the-blog'.$class.'">'."\n";
                            $dt_FrontPageFromBlogHeading = get_option('dt_FrontPageFromBlogHeading_'.$dt_FrontPageID, '');
                            if ( $dt_FrontPageFromBlogHeading != '' ):
                                $frontpageOutput .= '<h4>'.$dt_FrontPageFromBlogHeading.'</h4>'."\n";
                            endif;
                            $dt_FrontPageFBCount = get_option('dt_FrontPageFBCount_'.$dt_FrontPageID, 3);
                            $dt_FrontPageFromBlogCategory = get_option('dt_FrontPageFromBlogCategory_'.$dt_FrontPageID, '');
                            $dt_FrontPageFromBlogMore = get_option('dt_FrontPageFromBlogMore_'.$dt_FrontPageID, '');				

                            query_posts( 'post_type=post&cat='.$dt_FrontPageFromBlogCategory.'&posts_per_page='.$dt_FrontPageFBCount );
                            $dt_PostLocation = 0;
                            $dt_FromTheBlogClass = '';
                            while ( have_posts() ) : the_post();
                                if ( $dt_PostLocation == 0 ) $dt_FromTheBlogClass = 'blog-item-full-width';
                                if ( $dt_PostLocation > 0 ) $dt_FromTheBlogClass = 'blog-item-half-width';
                                $frontpageOutput .= '<div class="blog-item '.$dt_FromTheBlogClass.' clearfix">'."\n";
                                    $frontpageOutput .= '<span class="date"><span class="month">'.get_the_time('M').'</span><span class="day">'.get_the_time('j').'</span></span>'."\n";
                                    $frontpageOutput .= '<h6> <a href="'.get_permalink().'" title="'.dt_Permalink.the_title_attribute( 'echo=0' ).'" rel="bookmark">'.get_the_title().'</a></h6>';
                                    if ( has_post_thumbnail() && $dt_PostLocation == 0 ):
                                    	$dt_CropLocation = get_option('dt_CropLocation','c');
										$dt_PostImageCrop = get_post_meta($post->ID, "dt_croplocation", true);
                                        if ( $dt_PostImageCrop == '' || $dt_PostImageCrop == 'inherit' ) $dt_PostImageCrop = $dt_CropLocation;
                                        $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) );
                                        $frontpageOutput .= '<a class="image-wrapper" href="'.get_permalink().'" title="'.get_the_title().'">'."\n";
                                            $frontpageOutput .= '<img src="'.resizeimagenoecho($thumbnail_src,115,105,$dt_PostImageCrop).'" alt="'.get_the_title().'" />'."\n";
                                        $frontpageOutput .= '</a>'."\n";
                                    endif;
                                    global $more; $more = 0;
									$frontpageOutput .= wpautop(get_the_content(''));
									$frontpageOutput .= '<a class="read-more" href="'.get_permalink().'" title="'.get_the_title().'">'.dt_ReadMore.'</a>'."\n";                                   									
                                $frontpageOutput .= '</div>'."\n";
                                if ( $dt_PostLocation == 0 || $dt_PostLocation%2 == 0 ):
                                $frontpageOutput .= '<div class="blog-item-sep"></div>'."\n";
                                endif;
                                $dt_PostLocation++;
                            endwhile;
							if ( ( ($dt_PostLocation- 1)%2  ) == 1 ) $frontpageOutput .= '<div class="blog-item-sep"></div>'."\n";
							if ( $dt_FrontPageFromBlogMore != '' ) $frontpageOutput .= '<a href="'.(trim($dt_FrontPageFromBlogMore)).'" class="more-link"><span><span>'.dt_GoToBlog.'</span></span></a>'."\n";
                        $frontpageOutput .= '</div>'."\n";
					endif;                      
                endif;
            /* END LATEST FROM BLOG */
            /* LATEST WORK */
			if ( $frontpage_row == 'row-latest-work' ):
				$dt_FrontLatestWork = get_option('dt_FrontLatestWork_'.$dt_FrontPageID, 'no');
                if ( $dt_FrontLatestWork == 'yes' ):
				$frontpageOutput .= "<script type=\"text/javascript\">
                    $(document).ready(function() {	
                        function latestWorkHover()
                        {
							var projectDetails = $('#frontpage .front-page-projects-no-description .project-details');
							projectDetails.each(function(){
								$(this).find('.project-content').css('opacity','0');
								$(this).find('.blog-icon').css({'opacity':'0','top':'64','left':'82'});
								$(this).find('.zoom-icon').css({'opacity':'0','top':'64','left':'82'});
								$(this).find('.play-icon').css({'opacity':'0','top':'64','left':'82'});
							});		
							projectDetails.each(function(){
								$(this).hover(function(){
									$(this).find('.project-content').stop().animate({'opacity': 1});	
								}, function(){
									$(this).find('.project-content').stop().animate({'opacity': 0});
								});
							
							});	
							projectDetails.each(function(){
								$(this).hover(function(){
									$(this).find('.blog-icon').stop().animate({'opacity': 1,'top':36,'left':47}, 200, 'swing');
									$(this).find('.zoom-icon').stop().animate({'opacity':1,'top':36,'left':118}, 200, 'swing');
									$(this).find('.play-icon').stop().animate({'opacity':1,'top':36,'left':118}, 200, 'swing');
								}, function(){
									$(this).find('.blog-icon').stop().animate({'opacity': 0,'top':64,'left':82}, 400, 'swing');
									$(this).find('.zoom-icon').stop().animate({'opacity': 0,'top':64,'left':82}, 400, 'swing');
									$(this).find('.play-icon').stop().animate({'opacity': 0,'top':64,'left':82}, 400, 'swing');							
								});	
							});
							if($.browser.msie && $.browser.version.substring(0, 2) === \"8.\") 
							{
								$('#frontpage .front-page-projects-no-description .project-content').css('background','#333');
							}
                        }
						$('#frontpage .front-page-projects-no-description .front-page-projects-wrapper').carousel({pagination:false,continuous:true,itemsPerTransition:1});
                        latestWorkHover();
                    });
                    </script>"."\n";
                    $frontpageOutput .= '<div class="front-page-row clearfix front-page-projects front-page-projects-no-description">'."\n";
						$dt_FrontLatestWorkHeading = get_option('dt_FrontLatestWorkHeading_'.$dt_FrontPageID, '');
                        if ( $dt_FrontLatestWorkHeading != '' ):
                            $frontpageOutput .= '<h4>'.$dt_FrontLatestWorkHeading.'</h4>'."\n";
                        endif;
                        $frontpageOutput .= '<div class="front-page-projects-wrapper">'."\n";
                            $frontpageOutput .= '<ul class="front-page-projects rs-carousel-runner">'."\n";
	                            $dt_FrontLatestWorkPortfolioCount = get_option('dt_FrontLatestWorkPortfolioCount_'.$dt_FrontPageID, '4'); 
                           		$dt_FrontLatestWorkPortfolio = get_option('dt_FrontLatestWorkPortfolio_'.$dt_FrontPageID, '');                   
                                $random_gallery_id = rand(0,9999);
                                query_posts( 'post_type=project&ignore_sticky_posts=1&portfolio='.$dt_FrontLatestWorkPortfolio.'&posts_per_page='.$dt_FrontLatestWorkPortfolioCount);
                                while ( have_posts() ) : the_post();
                                    if ( has_post_thumbnail() ):
										$dt_CropLocation = get_option('dt_CropLocation','c');
                                        $dt_PostImageCrop = get_post_meta($post->ID, "dt_croplocation", true);
                                        if ( $dt_PostImageCrop == '' || $dt_PostImageCrop == 'inherit' ) $dt_PostImageCrop = $dt_CropLocation;
                                        $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) );
                                        $frontpageOutput .= '<li class="project rs-carousel-item">'."\n";
                                            $frontpageOutput .= '<div class="project-details">'."\n";
                                                $frontpageOutput .= '<img src="'.resizeimagenoecho($thumbnail_src,206,170,$dt_PostImageCrop).'" alt="'.get_the_title().'" />'."\n";
                                                $frontpageOutput .= '<div class="project-content">'."\n";
													$frontpageOutput .= '<h6>'.get_the_title().'</h6>'."\n";
                                                $frontpageOutput .= '</div>'."\n";
                                                $frontpageOutput .= '<a class="icon blog-icon" href="'.get_permalink().'" title="'.get_the_title().'">'.dt_ReadMore.'</a>'."\n";
                                                $video_url = get_post_meta($post->ID, "portfolio-video", true);
                                                if ( $video_url != '' ):
                                                $frontpageOutput .= '<a class="icon play-icon" href="<?php echo $video_url; ?>" rel="modal-window[<?php echo $random_gallery_id; ?>]" title="<?php the_title();?>">View Image</a>'."\n";
                                                else:
                                                $frontpageOutput .= '<a class="icon zoom-icon" href="'.$thumbnail_src.'" rel="modal-window['.$random_gallery_id.']" title="'.get_the_title().'">View Image</a>'."\n";                                   
                                                endif;
                                            $frontpageOutput .= '</div>'."\n";
                                        $frontpageOutput .= '</li>'."\n";             
                                    endif;
                                endwhile;
                            $frontpageOutput .= '</ul>'."\n";
                        $frontpageOutput .= '</div> '."\n";               
                    wp_reset_query();
                    $frontpageOutput .= '</div>'."\n";
                    $separatorValidator = $separatorValidator + 1;
				endif;
            endif;
            /* END LATEST WORK */
            /* LATEST WORK WITH DESCRIPTION */
            if ( $frontpage_row == 'row-latest-work-description' ):
            	$dt_FrontLatestWorkDesc = get_option('dt_FrontLatestWorkDesc_'.$dt_FrontPageID, 'no');
                if ( $dt_FrontLatestWorkDesc == 'yes' ):
				$frontpageOutput .= "<script type=\"text/javascript\">
                    $(document).ready(function($) {
                        function latestWorkDescriptionHover() 
                        {		
							var projectDetails = $('#frontpage .front-page-projects-description .project-details');
							projectDetails.each(function(){
								$(this).find('.project-content').css('opacity','0');
								$(this).find('.blog-icon').css({'opacity':'0','top':'64','left':'67'});
								$(this).find('.zoom-icon').css({'opacity':'0','top':'64','left':'67'});
								$(this).find('.play-icon').css({'opacity':'0','top':'64','left':'67'});							
							});		
							projectDetails.each(function(){
								$(this).hover(function(){
									$(this).find('.project-content').stop().animate({'opacity': 1});	
								}, function(){
									$(this).find('.project-content').stop().animate({'opacity': 0});
								});
							
							});	
							projectDetails.each(function(){
								$(this).hover(function(){
									$(this).find('.blog-icon').stop().animate({'opacity': 1,'top':36,'left':32}, 200, 'swing');
									$(this).find('.zoom-icon').stop().animate({'opacity':1,'top':36,'left':103}, 200, 'swing');
									$(this).find('.play-icon').stop().animate({'opacity':1,'top':36,'left':103}, 200, 'swing');								
								}, function(){
									$(this).find('.blog-icon').stop().animate({'opacity': 0,'top':64,'left':67}, 400, 'swing');
									$(this).find('.zoom-icon').stop().animate({'opacity': 0,'top':64,'left':67}, 400, 'swing');
									$(this).find('.play-icon').stop().animate({'opacity': 0,'top':64,'left':67}, 400, 'swing');								
								});	
							});
							if($.browser.msie && $.browser.version.substring(0, 2) === \"8.\") 
							{
								$('#frontpage .front-page-projects-description .project-content').css('background','#333');
							}							 
                        }
						$('#frontpage .front-page-projects-description .front-page-projects-wrapper').carousel({pagination:false,continuous:true,itemsPerTransition:1});
                        //$('#frontpage ul.front-page-projects-description').bxSlider({displaySlideQty: 3,moveSlideQty: 1,speed:500,onAfterSlide: function(currentSlide, totalSlides){}});
						latestWorkDescriptionHover();					
                    });
                    </script>"."\n";
                    $frontpageOutput .= '<div class="front-page-row clearfix front-page-projects front-page-projects front-page-projects-description">'."\n";
                        $frontpageOutput .= '<div class="projects-description">'."\n";
							$dt_FrontLatestWorkDescHeading = get_option('dt_FrontLatestWorkDescHeading_'.$dt_FrontPageID, '');
                            if ( $dt_FrontLatestWorkDescHeading != '' ):
                                $frontpageOutput .= '<h4>'.$dt_FrontLatestWorkDescHeading.'</h4>'."\n";
                            endif;
							$dt_FrontLatestWorkDescDescription = get_option('dt_FrontLatestWorkDescDescription_'.$dt_FrontPageID, '');
                            if ( $dt_FrontLatestWorkDescDescription != '' ):
                                $frontpageOutput .= '<p>'.$dt_FrontLatestWorkDescDescription.'</p>'."\n";
                            endif;
                            $dt_FrontLatestWorkDescButtonText = get_option('dt_FrontLatestWorkDescButtonText_'.$dt_FrontPageID, '');
                            $dt_FrontLatestWorkDescButtonUrl = get_option('dt_FrontLatestWorkDescButtonUrl_'.$dt_FrontPageID, '');
                            if ( $dt_FrontLatestWorkDescButtonText != '' && $dt_FrontLatestWorkDescButtonUrl != '' ):
                            $frontpageOutput .= '<a href="'.$dt_FrontLatestWorkDescButtonUrl.'" class="more-link"><span><span>'.$dt_FrontLatestWorkDescButtonText.'</span></span></a>'."\n";
                            endif;
                        $frontpageOutput .= '</div>'."\n";
                        $frontpageOutput .= '<div class="front-page-projects-wrapper">'."\n";
                            $frontpageOutput .= '<ul class="front-page-projects-description rs-carousel-runner">'."\n";
	                            $dt_FrontLatestWorkDescCount = get_option('dt_FrontLatestWorkDescCount_'.$dt_FrontPageID, '4');                        
                           		$dt_FrontLatestWorkDescPortfolio = get_option('dt_FrontLatestWorkDescPortfolio_'.$dt_FrontPageID, '');
                                $random_gallery_id = rand(0,9999);
                                query_posts( 'post_type=project&ignore_sticky_posts=1&portfolio='.$dt_FrontLatestWorkDescPortfolio.'&posts_per_page='.$dt_FrontLatestWorkDescCount);
                                while ( have_posts() ) : the_post();
                                    if ( has_post_thumbnail() ):
										$dt_CropLocation = get_option('dt_CropLocation','c');
                                        $dt_PostImageCrop = get_post_meta($post->ID, "dt_croplocation", true);
                                        if ( $dt_PostImageCrop == '' || $dt_PostImageCrop == 'inherit' ) $dt_PostImageCrop = $dt_CropLocation;
                                        $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) );
                                        $frontpageOutput .= '<li class="project rs-carousel-item">'."\n";
                                            $frontpageOutput .= '<div class="project-details">'."\n";
                                                $frontpageOutput .= '<img src="'.resizeimagenoecho($thumbnail_src,176,170,$dt_PostImageCrop).'" alt="'.get_the_title().'" />'."\n";
                                                $frontpageOutput .= '<div class="project-content">'."\n";
                                                    $frontpageOutput .= '<h6>'.get_the_title().'</h6>'."\n";
                                                $frontpageOutput .= '</div>'."\n";
                                                $frontpageOutput .= '<a class="icon blog-icon" href="'.get_permalink().'" title="'.get_the_title().'">'.dt_ReadMore.'</a>'."\n";
                                                $video_url = get_post_meta($post->ID, "portfolio-video", true);
                                                if ( $video_url != '' ):
                                                $frontpageOutput .= '<a class="icon play-icon" href="<?php echo $video_url; ?>" rel="modal-window[<?php echo $random_gallery_id; ?>]" title="<?php the_title();?>">View Image</a>'."\n";
                                                else:
                                                $frontpageOutput .= '<a class="icon zoom-icon" href="'.$thumbnail_src.'" rel="modal-window['.$random_gallery_id.']" title="'.get_the_title().'">View Image</a>'."\n";                                   
                                                endif;
                                            $frontpageOutput .= '</div>'."\n";
                                        $frontpageOutput .= '</li>'."\n";             
                                    endif;
                                endwhile;
                            $frontpageOutput .= '</ul>'."\n";
                        $frontpageOutput .= '</div>'."\n";      
                    wp_reset_query();
                    $frontpageOutput .= '</div>'."\n";
                    $separatorValidator = $separatorValidator + 1;
				endif;
            endif;
            /* END LATEST WORK WITH DESCRIPTION */
            /* CALLTOACTION */              
            if ( $frontpage_row == 'row-calltoaction' ):
            	$dt_FrontCallToAction = get_option('dt_FrontCallToAction_'.$dt_FrontPageID, 'no');
                if ( $dt_FrontCallToAction == 'yes' ): 
                	$dt_FrontCallToActionText = get_option('dt_FrontCallToActionText_'.$dt_FrontPageID, 'Text');
                    $dt_FrontCallToActionButtonText = get_option('dt_FrontCallToActionButtonText_'.$dt_FrontPageID, 'Button Text');
                    $dt_FrontCallToActionButtonUrl = get_option('dt_FrontCallToActionButtonUrl_'.$dt_FrontPageID, '#');
                    $frontpageOutput .= '<div class="front-page-row clearfix front-page-calltoaction">'."\n";
                        $frontpageOutput .= '<div class="calltoaction clearfix">'."\n";
                            $frontpageOutput .= '<h5><a class="more-link" href="'.$dt_FrontCallToActionButtonUrl.'"><span><span>'.$dt_FrontCallToActionButtonText.'</span></span></a>'.$dt_FrontCallToActionText.'</h5>'."\n";
                        $frontpageOutput .= '</div>'."\n";
                    $frontpageOutput .= '</div>'."\n";
				$separatorValidator = $separatorValidator + 1;
                endif;
            endif;
            /* END OF CALLTOACTION */
            /* CONTACT FORM */
			if ( $frontpage_row == 'row-contact' ):
            	$dt_FrontPageContact = get_option('dt_FrontPageContact_'.$dt_FrontPageID, 'no');
                if ( $dt_FrontPageContact == 'yes' ):
                    $frontpageOutput .= '<div class="front-page-row front-page-half-row clearfix front-page-contact">'."\n";
						$dt_FrontPageContactHeading = get_option('dt_FrontPageContactHeading_'.$dt_FrontPageID, '');
						if ( $dt_FrontPageContactHeading != '' ):
                        $frontpageOutput .= '<h4>'.$dt_FrontPageContactHeading.'</h4>'."\n";
						endif;
                        $frontpageOutput .= '<div id="front-page-contact-confirmation-message"></div>'."\n";
                        $frontpageOutput .= '<form id="front-page-contact" name="front_page_contact" action="'.get_bloginfo('template_url').'/page-contact-sender.php" method="POST">'."\n";
                        	$frontpageOutput .= '<input type="hidden" name="recaptcha_usage" value="'. get_option('dt_FrontPageContactRecaptcha_'.$dt_FrontPageID, 'no').'" />'."\n";
                        	$frontpageOutput .= '<input type="hidden" name="destination_email" value="'.get_option('dt_FrontPageContactDestination_'.$dt_FrontPageID, get_option('admin_email')).'" />'."\n";
                            $dt_FrontPageContactField1 = get_option('dt_FrontPageContactField1_'.$dt_FrontPageID, 'yes');
                            $dt_FrontPageContactField2 = get_option('dt_FrontPageContactField2_'.$dt_FrontPageID, 'yes');
                            $dt_FrontPageContactField3 = get_option('dt_FrontPageContactField3_'.$dt_FrontPageID, 'yes');
                            $dt_FrontPageContactField4 = get_option('dt_FrontPageContactField4_'.$dt_FrontPageID, 'yes');
                            $dt_FrontPageContactField5 = get_option('dt_FrontPageContactField5_'.$dt_FrontPageID, 'yes');
                            $frontpageOutput .= '<div class="one-half one-half-margin">'."\n";
                                $frontpageOutput .= '<label for="full_name">'.dt_ContactFormName.'</label>';
								if ( $dt_FrontPageContactField1 == 'yes' ) $frontpageOutput .= '<em>*</em>';
								$frontpageOutput .= '<br />'."\n";
                                $frontpageOutput .= '<div class="clear-content">'."\n";
                                	$frontpageOutput .= '<span class="button"></span>'."\n";
                                    if ( $dt_FrontPageContactField1 == 'yes' ) $dt_FrontPageContactField1Class = ' class="required"';
                                    $frontpageOutput .= '<input'.$dt_FrontPageContactField1Class.' type="text" value="" name="full_name" />'."\n";
                                $frontpageOutput .= '</div>'."\n";
                            $frontpageOutput .= '</div>'."\n";
                            $frontpageOutput .= '<div class="one-half">'."\n";
                                $frontpageOutput .= '<label for="company">'.dt_ContactFormCompany.'</label>';
								if ( $dt_FrontPageContactField2 == 'yes' ) $frontpageOutput .= '<em>*</em>';
								$frontpageOutput .= '<br />'."\n";
                                $frontpageOutput .= '<div class="clear-content">'."\n";
                                	$frontpageOutput .= '<span class="button"></span>'."\n";
									if ( $dt_FrontPageContactField2 == 'yes' ) $dt_FrontPageContactField2Class = ' class="required"';
                                    $frontpageOutput .= '<input'.$dt_FrontPageContactField2Class.' type="text" value="" name="company" />   '."\n";                  
                                $frontpageOutput .= '</div>'."\n";
                            $frontpageOutput .= '</div>'."\n";                 
                            $frontpageOutput .= '<div class="one-half one-half-margin">'."\n";
                                $frontpageOutput .= '<label for="email">'.dt_ContactFormEmail.'</label>';
								if ( $dt_FrontPageContactField3 == 'yes' ) $frontpageOutput .= '<em>*</em>';
								$frontpageOutput .= '<br />'."\n";
                                $frontpageOutput .= '<div class="clear-content">'."\n";
                                	$frontpageOutput .= '<span class="button"></span>'."\n";
									if ( $dt_FrontPageContactField3 == 'yes' ) $dt_FrontPageContactField3Class = ' class="required email"';
                                    $frontpageOutput .= '<input'.$dt_FrontPageContactField3Class.' type="text" value="" name="email" />'."\n";
                                $frontpageOutput .= '</div>'."\n";                     
                            $frontpageOutput .= '</div>'."\n";
                            $frontpageOutput .= '<div class="one-half">'."\n";
                                $frontpageOutput .= '<label for="phone">'.dt_ContactFormPhone.'</label>';
								if ( $dt_FrontPageContactField4 == 'yes' ) $frontpageOutput .= '<em>*</em>';
								$frontpageOutput .= '<br />'."\n";
								$frontpageOutput .= '<div class="clear-content">'."\n";
                                    $frontpageOutput .= '<span class="button"></span>'."\n";
									if ( $dt_FrontPageContactField4 == 'yes' ) $dt_FrontPageContactField4Class = ' class="required"';
                                    $frontpageOutput .= '<input'.$dt_FrontPageContactField4Class.' type="text" value="" name="phone" />'."\n";
                                $frontpageOutput .= '</div>   '."\n";                             
                            $frontpageOutput .= '</div>'."\n";
                            $frontpageOutput .= '<div class="full-width">'."\n";
								$frontpageOutput .= '<label>'.dt_ContactFormMessage.'</label>'."\n";
								if ( $dt_FrontPageContactField5 == 'yes' ) $frontpageOutput .= '<em>*</em>';
								$frontpageOutput .= '<br />'."\n";
								$frontpageOutput .= '<div class="clear-content clear-content-textarea">'."\n";
                                    $frontpageOutput .= '<span class="button"></span>'."\n";          
									if ( $dt_FrontPageContactField5 == 'yes' ) $dt_FrontPageContactField5Class = ' class="required"';                    
                                	$frontpageOutput .= '<textarea'.$dt_FrontPageContactField5Class.' spellcheck="false" name="message"></textarea>'."\n";                                                                                                             
								$frontpageOutput .= '</div>'."\n";                                    
                            $frontpageOutput .= '</div>'."\n";
                            if ( get_option('dt_FrontPageContactRecaptcha_'.$dt_FrontPageID, 'no') == 'yes' ):
                                 $frontpageOutput .= '<div class="full-width clearfix">'."\n";
                                     $frontpageOutput .= '<script type="text/javascript">'."\n";
                                          $frontpageOutput .= 'var RecaptchaOptions = {'."\n";
                                             $frontpageOutput .= 'theme : \'custom\','."\n";
                                             $frontpageOutput .= 'custom_theme_widget: \'recaptcha_widget\''."\n";
                                          $frontpageOutput .= '};'."\n";
                                     $frontpageOutput .= '</script>'."\n";                         
                                      $frontpageOutput .= '<div id="recaptcha_widget" style="display:none">'."\n";
                                        $frontpageOutput .= '<div id="recaptcha_image"></div>'."\n";
                                        $frontpageOutput .= '<div id="recaptcha_controls">'."\n";
                                            $frontpageOutput .= '<div class="recaptcha_reload"><a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a></div>'."\n";
                                            $frontpageOutput .= '<div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type(\'audio\')">Get an audio CAPTCHA</a></div>'."\n";
                                            $frontpageOutput .= '<div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type(\'image\')">Get an image CAPTCHA</a></div>'."\n";
                                            $frontpageOutput .= '<div class="recaptcha_help"><a href="javascript:Recaptcha.showhelp()">Help</a></div>'."\n";
                                        $frontpageOutput .= '</div>'."\n";
                                        $frontpageOutput .= '<div id="recaptcha_label_field">'."\n";
                                            $frontpageOutput .= '<span class="recaptcha_only_if_image"><label for="recaptcha_response_field">'.dt_RecaptchaWords.'</label><em>*</em></span>'."\n";
                                            $frontpageOutput .= '<span class="recaptcha_only_if_audio"><label for="recaptcha_response_field">'.dt_RecaptchaAudio.'</label><em>*</em></span>'."\n";
                                            $frontpageOutput .= '<input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />'."\n";
                                        $frontpageOutput .= '</div>'."\n";
                                      $frontpageOutput .= '</div>'."\n";
                                      $frontpageOutput .= '<script type="text/javascript" src="http://www.google.com/recaptcha/api/challenge?k='.get_option('dt_recaptchapublickey').'"></script>'."\n";
                                 $frontpageOutput .= '</div>'."\n";
                            endif;
                            $frontpageOutput .= '<input type="submit" value="Send" />'."\n";
                            $frontpageOutput .= '<div id="front-page-contact-loader" style="display:none;">sending</div>'."\n";
                        $frontpageOutput .= '</form>'."\n";
                        $separatorValidator = $separatorValidator + 0.5;
                    $frontpageOutput .= '</div>'."\n";
                endif;
			endif;
            /* END CONTACT FORM */
            /* PARTNERS */              
            if ( $frontpage_row == 'row-partners' ):
            	$dt_FrontPagePartners = get_option('dt_FrontPagePartners_'.$dt_FrontPageID, 'no');
                if ( $dt_FrontPagePartners == 'yes' ): 
                	$dt_FrontPagePartnersTitle = get_option('dt_FrontPagePartnersTitle_'.$dt_FrontPageID, '');
                    $dt_FrontPagePartnersDetails = get_option('dt_FrontPagePartnersDetails_'.$dt_FrontPageID, '');
                    $frontpageOutput .= '<div class="front-page-row clearfix front-page-partners">'."\n";
						if ( $dt_FrontPagePartnersTitle != '' ):
							$frontpageOutput .= '<h4>'.$dt_FrontPagePartnersTitle.'</h4>'."\n";
						endif;					
						$dt_FrontPagePartnersDetails = explode("\n", $dt_FrontPagePartnersDetails);
						$frontpageOutput .= '<div class="front-page-partners-wrapper">';
						$frontpageOutput .= '<ul class="rs-carousel-runner">';
						foreach ($dt_FrontPagePartnersDetails as $dt_FrontPagePartnersDetail):
							$dt_FrontPagePartnersDetailLenght = strlen($dt_FrontPagePartnersDetail);
							$dt_FrontPagePartnersDetailSep = strpos($dt_FrontPagePartnersDetail,'|');
							$dt_FrontPagePartnersDetailImage = trim(substr($dt_FrontPagePartnersDetail,0,$dt_FrontPagePartnersDetailSep));
							$dt_FrontPagePartnersDetailUrl = trim(substr($dt_FrontPagePartnersDetail,$dt_FrontPagePartnersDetailSep+1,$dt_FrontPagePartnersDetailLenght));
							$frontpageOutput .= '<li class="rs-carousel-item">';
								$frontpageOutput .= '<a rel="no-follow" target="_blank" href="'.$dt_FrontPagePartnersDetailUrl.'">';
									$frontpageOutput .= '<img src="'.$dt_FrontPagePartnersDetailImage.'">';
								$frontpageOutput .= '</a>';
							$frontpageOutput .= '</li>';								
						endforeach;		
 						$frontpageOutput .= '</ul>';
						$frontpageOutput .= '</div>'."\n";
                    $frontpageOutput .= '</div>'."\n";
				$separatorValidator = $separatorValidator + 1;
                endif;
            endif;
            /* END OF PARTNERS */			
            /* SEPARATOR HANDLER */
            if ( $separatorValidator >= 1 ):
                $frontpageOutput .= '<div class="front-page-row-sep"></div>'."\n";
				$separatorValidator = 0 ;
            endif;
            /* END SEPARATOR HANDLER */
        endforeach;     
    $frontpageOutput .= '</div>'."\n";
    echo $frontpageOutput;
	
	get_footer();
?>