<?php

if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

/**
 * Schema.org addtions for better SEO
 * @param 	string 	Type of the element
 * @return  string  HTML Attribute
 */

function get_schema_markup($type, $echo = false) {
    
    if (empty($type)) return false;
    
    $attributes = '';
    $attr = array();
    
    switch ($type) {
        case 'body':
            $attr['itemscope'] = 'itemscope';
            $attr['itemtype'] = 'https://schema.org/WebPage';
            break;

        case 'header':
            $attr['role'] = 'banner';
            $attr['itemscope'] = 'itemscope';
            $attr['itemtype'] = 'https://schema.org/WPHeader';
            break;

        case 'nav':
            $attr['role'] = 'navigation';
            $attr['itemscope'] = 'itemscope';
            $attr['itemtype'] = 'https://schema.org/SiteNavigationElement';
            break;

        case 'title':
            $attr['itemprop'] = 'headline';
            break;

        case 'sidebar':
            $attr['role'] = 'complementary';
            $attr['itemscope'] = 'itemscope';
            $attr['itemtype'] = 'https://schema.org/WPSideBar';
            break;

        case 'footer':
            $attr['role'] = 'contentinfo';
            $attr['itemscope'] = 'itemscope';
            $attr['itemtype'] = 'https://schema.org/WPFooter';
            break;

        case 'main':
            $attr['role'] = 'main';
            $attr['itemprop'] = 'mainContentOfPage';
            if (is_search()) {
                $attr['itemtype'] = 'https://schema.org/SearchResultsPage';
            }
            
            break;

        case 'author':
            $attr['itemprop'] = 'author';
            $attr['itemscope'] = 'itemscope';
            $attr['itemtype'] = 'https://schema.org/Person';
            break;

        case 'person':
            $attr['itemscope'] = 'itemscope';
            $attr['itemtype'] = 'https://schema.org/Person';
            break;

        case 'comment':
            $attr['itemprop'] = 'comment';
            $attr['itemscope'] = 'itemscope';
            $attr['itemtype'] = 'https://schema.org/UserComments';
            break;

        case 'comment_author':
            $attr['itemprop'] = 'creator';
            $attr['itemscope'] = 'itemscope';
            $attr['itemtype'] = 'https://schema.org/Person';
            break;

        case 'comment_author_link':
            $attr['itemprop'] = 'creator';
            $attr['itemscope'] = 'itemscope';
            $attr['itemtype'] = 'https://schema.org/Person';
            $attr['rel'] = 'external nofollow';
            break;

        case 'comment_time':
            $attr['itemprop'] = 'commentTime';
            $attr['itemscope'] = 'itemscope';
            $attr['datetime'] = get_the_time('c');
            break;

        case 'comment_text':
            $attr['itemprop'] = 'commentText';
            break;

        case 'author_box':
            $attr['itemprop'] = 'author';
            $attr['itemscope'] = 'itemscope';
            $attr['itemtype'] = 'https://schema.org/Person';
            break;

        case 'video':
            $attr['itemprop'] = 'video';
            $attr['itemtype'] = 'https://schema.org/VideoObject';
            break;

        case 'audio':
            $attr['itemscope'] = 'itemscope';
            $attr['itemtype'] = 'https://schema.org/AudioObject';
            break;

        case 'blog':
            $attr['itemscope'] = 'itemscope';
            $attr['itemtype'] = 'https://schema.org/Blog';
            break;

        case 'name':
            $attr['itemprop'] = 'name';
            break;

        case 'url':
            $attr['itemprop'] = 'url';
            break;

        case 'email':
            $attr['itemprop'] = 'email';
            break;

        case 'job':
            $attr['itemprop'] = 'jobTitle';
            break;

        case 'post_time':
            
            $attr['itemprop'] = 'datePublished';
            $attr['datetime'] = get_the_time('c', $args['id']);
            break;

        case 'post_title':
            $attr['itemprop'] = 'headline';
            break;

        case 'post_content':
            $attr['itemprop'] = 'text';
            break;
    }
    
    foreach ($attr as $key => $value) {
        $attributes.= $key . '="' . $value . '" ';
    }
    
    if ($echo) {
        echo $attributes;
    } 
    else {
        return $attributes;
    }
}
