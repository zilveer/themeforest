<?php

class BFISEO {
    
    public static function run() {
        // override default canonical
        remove_action( 'wp_head', 'rel_canonical' );
        
        add_action('wp_head', array(__CLASS__, 'wpHead'));
        add_filter('wp_title', array(__CLASS__, 'wpTitle'), 10, 3);
    }
    
    public static function wpHead() {
        if (is_feed()) return;

        echo "<meta name='robots' content='NOODP,NOYDIR'/>\n";
        
        $url = self::formCanonicalURL();
        if ($url) {
            echo "<link rel='canonical' href='$url' />\n";
        }
    }
    
    public static function wpTitle($title, $sep, $seplocation) {
        return trim($title.get_bloginfo('name'));
    }
    
    // Inspired by All in One SEO Pack
    public static function formCanonicalURL() {
        global $wp_query;
        
		if ($wp_query->is_404 || $wp_query->is_search) return false;
		
		$haspost = count($wp_query->posts) > 0;

		if (get_query_var('m')) {
			$m = preg_replace('/[^0-9]/', '', get_query_var('m'));
			switch (strlen($m)) {
				case 4: 
				$link = get_year_link($m);
				break;
        		case 6: 
            	$link = get_month_link(substr($m, 0, 4), substr($m, 4, 2));
            	break;
        		case 8: 
            	$link = get_day_link(substr($m, 0, 4), substr($m, 4, 2), substr($m, 6, 2));
                break;
       			default:
       			return false;
			}
			
		} elseif (($wp_query->is_single || $wp_query->is_page) && $haspost) {
			$post = $wp_query->posts[0];
			$link = get_permalink($post->ID);
 			$link = self::yoast_get_paged($link); 
 			
		} elseif (($wp_query->is_single || $wp_query->is_page) && $haspost) {
			$post = $wp_query->posts[0];
			$link = get_permalink($post->ID);
 			$link = self::yoast_get_paged($link);
 			
		} elseif ($wp_query->is_author && $haspost) {
    		$author = get_userdata(get_query_var('author'));
 			if ($author === false)
    			return false;
    		$link = get_author_posts_url($author->ID, $author->user_nicename);
      		
  		} elseif ($wp_query->is_category && $haspost) {
    		$link = get_category_link(get_query_var('cat'));
			$link = self::yoast_get_paged($link);
			
		} else if ($wp_query->is_tag  && $haspost) {
			$tag = get_term_by('slug',get_query_var('tag'),'post_tag');
       		if (!empty($tag->term_id)) {
				$link = get_tag_link($tag->term_id);
			} 
			$link = self::yoast_get_paged($link);			
			
  		} elseif ($wp_query->is_day && $haspost) {
  			$link = get_day_link(get_query_var('year'),
	                             get_query_var('monthnum'),
	                             get_query_var('day'));
	                             
	    } elseif ($wp_query->is_month && $haspost) {
	        $link = get_month_link(get_query_var('year'),
	                               get_query_var('monthnum'));
	                               
	    } elseif ($wp_query->is_year && $haspost) {
	        $link = get_year_link(get_query_var('year'));
	        
		} elseif ($wp_query->is_home) {
	        if ((get_option('show_on_front') == 'page') &&
	            ($pageid = get_option('page_for_posts'))) {
	            $link = get_permalink($pageid);
				$link = self::yoast_get_paged($link);
				$link = trailingslashit($link);
			} else {
				if ( function_exists( 'icl_get_home_url' ) ) {
					$link = icl_get_home_url();
				} else {
					$link = home_url();
				}
				$link = self::yoast_get_paged($link);
				$link = trailingslashit($link);
			}
			
		} elseif ($wp_query->is_tax && $haspost ) {
			$taxonomy = get_query_var( 'taxonomy' );
			$term = get_query_var( 'term' );
			$link = get_term_link( $term, $taxonomy );
			$link = self::yoast_get_paged( $link );
			
	    } elseif ( $wp_query->is_archive && function_exists( 'get_post_type_archive_link' ) && ( $post_type = get_query_var( 'post_type' ) ) ) {
            $link = get_post_type_archive_link( $post_type );
	            
		} else {
	        return false;
		}

		return $link;
	}
	
	// from all in one seo pack
	public static function yoast_get_paged($link) {
		$page = get_query_var('paged');
        if ($page && $page > 1) {
            $link = trailingslashit($link) ."page/". "$page";
            if (function_exists('user_trailingslashit')) {
                $link = user_trailingslashit($link, 'paged');
            } else {
                $link .= '/';
            }
		}
		return $link;
	}
	
	public static function sitemapEscapestring($url) {
	    $url = preg_replace('#&#', '&amp;amp;', $url);
	    $url = preg_replace("#'#", '&amp;apos;', $url);
	    $url = preg_replace('#"#', '&amp;quot;', $url);
	    $url = preg_replace('#>#', '&amp;gt;', $url);
	    $url = preg_replace('#<#', '&amp;lt;', $url);
	    return $url;
	}
	
	public static function generateSitemapXML($excludes = array(), $echo = true) {
        $args = array(
            'exclude' => $excludes,
        );
	    
	    // This variable holds everything
	    $urls = array();
	    
	    // list homepage priority 1
	    $urls[] = array(
	       "loc" => self::sitemapEscapestring(home_url()),
	       "priority" => "1.0",
	       "changefreq" => "always",
	    );
	    
	    
	    // list all pages (excluding homepage) priority .8
	    // template pages .9
	    // list all portfolio priority .7
        // list all blog posts priority .6
	    $a = get_posts(array(
            'posts_per_page' => -1,
            'post_type' => array('page', 'post', BFIPortfolioModel::POST_TYPE),
        ));
	    foreach ($a as $post) {
	        if (in_array($post->ID, $excludes)) continue;
	        
            // list all blog posts priority .6
	        $priority = "0.6";
	        
    	    // list all pages (excluding homepage) priority .8
	        if ($post->post_type == 'page') {
	            $currTemplate = get_post_meta($post->ID, '_wp_page_template', true);
	            if ($currTemplate == "default") {
	                $priority = "0.8";
	            } else {
	                $priority = "0.9";
	            }
    	    // list all portfolio priority .7
	        } else if ($post->post_type == BFIPortfolioModel::POST_TYPE) {
	            $priority = "0.7";
	        }
	        
	        $arr = array(
	           'loc' => self::sitemapEscapestring(get_permalink($post->ID)),
	           'lastmod' => date('Y-m-d', strtotime($post->post_modified)),
	           'priority' => $priority,
	           'changefreq' => 'weekly',
	           'id' => $post->ID,
            );
	        
	        if (!$echo) {
	            $arr['title'] = $post->post_title;
                $arr['post_type'] = $post->post_type;
	        }
	        
	        $urls[] = $arr;
	    }
	    
	    if (!$echo) {
	        return $urls;
	    }
            
	    // list all portfolio categories .priority .5
        $a = bfi_get_all_portfolio_categories();
        foreach ($a as $category) {
   	        $urls[] = array(
	           'loc' => self::sitemapEscapestring(get_term_link($category->slug, BFIPortfolioModel::TAXONOMY_ID)),
	           'priority' => "0.5",
	           'changefreq' => 'monthly',
	        );
        }
	    
	    // list all blog categories priority .4
	    $a = get_categories(array('hide_empty' => 0));
	    foreach ($a as $category) {
	        $urls[] = array(
	           'loc' => self::sitemapEscapestring(get_category_link($category->cat_ID)),
	           'priority' => "0.4",
	           'changefreq' => 'monthly',
	        );
	    }
	    unset($a);
	    
	    
	    // apply multilanguage if available
	    $languages = bfi_get_option(BFI_SHORTNAME."_multilanguages");
        if ($languages) {
            $languages = unserialize($languages);
            if (count($languages)) {
                foreach ($urls as $key => $url) {
                    foreach ($languages as $lang => $locale) {
                        $locale = preg_replace('#_#', '-', $locale);
                        $langURL = bfi_add_get_var($url['loc'], 'l', $lang);
                        $langURL = self::sitemapEscapestring($langURL);
                        $url["xhtml:link rel='alternate' hreflang='$locale' href='{$langURL}'"] = '';
                        $urls[$key] = $url;
                    }
                }
            }
        }
        
        
        // write the xml urls
        $xml = "\n";
        foreach ($urls as $url) {
            $xml .= "&nbsp;&nbsp;&nbsp;&nbsp;<url>\n";
            foreach ($url as $tag => $value) {
                if ($value == "") {
                    $xml .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<{$tag}/>\n";
                } else {
                    $xml .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<{$tag}>{$value}</{$tag}>\n";
                }
            }
            $xml .= "&nbsp;&nbsp;&nbsp;&nbsp;</url>\n";
        }

        // write xml container
        $xml = "<?xml version='1.0' encoding='UTF-8'?>
        <urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9' xmlns:xhtml='http://www.w3.org/1999/xhtml'>$xml</urlset>";
        
        $xml = preg_replace('#<#', "&lt;", $xml);
        $xml = preg_replace('#>#', "&gt;", $xml);
        $xml = preg_replace('#\n#', "<br>", $xml);
        
        echo $xml;
	}
}

if (!is_admin()) {
    BFISEO::run();
}
