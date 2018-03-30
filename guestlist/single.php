<?php 

include 'header-naked.php' ;

// check for header image. if not available, we include a different scrollbar (a longer one)

wp_reset_query();

// comments link

$comments_link = SimpleUtils::getCommentsLink(get_the_ID(), $bSettings);
    
if(has_post_thumbnail())
{
    $scrollbar_graphic = "scroll_long_bg";
    $scrollbar_height  = '372';
}else {
    $scrollbar_graphic = "scroll_longer_bg";
    $scrollbar_height  = '577';
}

?>

<style>
    #post_scrollbar .track { background: url(<?php bloginfo('stylesheet_directory'); ?>/images/main/<?php echo $scrollbar_graphic ?>.png) !important; }
    #post_scrollbar .viewport { height: <?php echo $scrollbar_height ?>px !important; }
</style>


      
    <div id="main_post" role="main">
		<div class="post_container">
            
			
            <?php echo the_post_thumbnail('page-detail-thumbnail', array('class' => 'postimage')); ?>
			<h1><?php the_title() ?></h1>
		
            <ul class="post_info">
                <li class="date"><?php the_time('M jS, Y H:i')?></li>
                <li class="commens"><?php echo $comments_link ?></li>
                <li class="author"><?php _e('Posted by', $bSettings->getPrefix()) ?> <?php the_author(); ?></li>
            </ul>
            <br class="clear">
			<div class="event_content">
				
                <div id="post_scrollbar">
                    <div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
                    <div class="viewport">
                        <div class="overview">
                        <div class="frameForBugfix">

                            

                            <?php the_content() ?>


                            <br class="clear">
                            <!-- comments begin -->

                            <?php echo comments_template() ?>

                            <!-- comments end -->
                             </div>                      
                        </div>
                    </div>
                </div>	
			</div>
		</div>				
    </div>
  </div> <!--! end of #container -->
  
<?php include 'footer-naked.php' ?>