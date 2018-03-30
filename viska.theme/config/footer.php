<?php
/**
 * Project of Megadrupal.com
 * Author: duongle
 * Date: 5/27/14
 * Time: 10:18 AM
 */

/**
 * Display Footer content
 * @return mixed
 */
function display_footer(){
    $show = apply_filters('display_footer_content',1);
    return $show;
}

function display_social_footer()
{
    $content =  apply_filters('awe_social',array());
    if(isset($content['enable']) && $content['enable']==0)
        return '';
    $socials = array(
        'facebook'  =>  'fa fa-facebook',
        'google'    =>  'fa fa-google-plus',
        'twitter'   =>  'fa fa-twitter',
        'github'    =>  'fa fa-github',
        'instagram' =>  'fa fa-instagram',
        'pinterest' =>  'fa fa-pinterest',
        'linkedin'  =>  'fa fa-linkedin',
        'skype'     =>  'fa fa-skype',
        'tumblr'    =>  'fa fa-tumblr',
        'youtube'   =>  'fa fa-youtube',
        'vimeo'     =>  'fa fa-vimeo-square',
        'flickr'    =>  'fa fa-flickr',
        'dribbble'  =>  'fa fa-dribbble',
    );
    $html='';
    $count=0.4;
    foreach($socials as $k=>$v)
    {
        $count +=0.2;
        if(isset($content[$k]) && $content[$k]['enable']==1  && !empty($content[$k]['url']))
            
            $html .= "<a href=\"{$content[$k]['url']}\" class=\"wow fadeInLeft\" data-wow-delay=\"{$count}\"><i class=\"awe-icon {$v}\"></i></a>";

    }
    if($html)
        $html = sprintf("<div class=\"share\">%s</div>",$html);
    echo $html;

}

function display_copyright()
{
    $copyright = apply_filters('awe_copyright',true);
    if($copyright != 1)
    {
        echo ($copyright);
    }
}