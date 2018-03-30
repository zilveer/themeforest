<?php 

include 'header-naked.php' ;





// check for header image. if not available, we include a different scrollbar (a longer one)

if(has_post_thumbnail())
{
    $scrollbar = '';
}

wp_reset_query();

$post_id = get_the_ID();

// check if page == blog
if($post_id == $bSettings->get('blog_overview_page'))
{
    include('blog.php');
}elseif($post_id == $bSettings->get('contact_page')) {
    include('contact.php');
}else {

    
    // get scrollbar length
    
    if(has_post_thumbnail())
    {
        $scrollbar_graphic = "scroll_long_bg";
        $scrollbar_height  = '397';
    }else {
        $scrollbar_graphic = "scroll_longer_bg";
        $scrollbar_height  = '552';
    }

?>

<style>
    #post_scrollbar .track { background: url(<?php bloginfo('stylesheet_directory'); ?>/images/main/<?php echo $scrollbar_graphic ?>.png) !important; }
    #post_scrollbar .viewport { height: <?php echo $scrollbar_height ?>px !important; }
    
    .post_container {
        padding-top: 20px;
    }
</style>

      
    <div id="main_post" role="main">
		<div class="post_container">
            
			
            <?php echo the_post_thumbnail('page-detail-thumbnail', array('class' => 'postimage')); ?>
			<h1><?php the_title() ?></h1>
		
		
			<div class="event_content">
				
            <div id="post_scrollbar">
                <div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
                <div class="viewport">
                    <div class="overview">
                    <div class="frameForBugfix">


                        <?php the_content() ?>


                        <br class="clear">
                         </div>                      
                    </div>
                </div>
            </div>	
			</div>
		</div>				
    </div>
   <!--! end of #container -->
  
<?php 
} // end else started above when checking for blogpage
include 'footer-naked.php' ?>