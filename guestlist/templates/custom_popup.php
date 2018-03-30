<?php


define('WP_USE_THEMES', false);
include_once '../../../../wp-load.php';
include_once TEMPLATEPATH.'/functions.php';



foreach($_GET as $key => $value)
{
    $valid_data[esc_attr($key)] = esc_attr($value);
}


switch($_GET['get'])
{
    case 'terms':
        $text = $bSettings->get('events_terms_conditions');
        break;
    
    default:
        $text = "error";
}

include '../header-naked.php' ;

$scrollbar_graphic = "scroll_longer_bg";
$scrollbar_height  = '577';
?>

<style>
    #post_scrollbar .track { background: url(<?php bloginfo('stylesheet_directory'); ?>/images/main/<?php echo $scrollbar_graphic ?>.png) !important; }
    #post_scrollbar .viewport { height: <?php echo $scrollbar_height ?>px !important; }
</style>

<div id="main_post" role="main">
    <div class="post_container" style="padding-top: 40px;">
        <div class="event_content">
			<div id="post_scrollbar">
                <div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
                <div class="viewport">
                    <div class="overview">
                        <div class="frameForBugfix">
                            <?php echo html_entity_decode($text) ?>
                        </div>
                    </div>
                </div>
            </div>	
        </div>
    </div>				
</div>
<!--! end of #container -->


<?php include '../footer-naked.php' ?>