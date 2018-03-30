<?php 
$tpl_postid = $post->ID;
$tpl_default_settings = get_post_meta( $post->ID, '_tpl_default_settings', TRUE );
$tpl_default_settings = is_array( $tpl_default_settings ) ? $tpl_default_settings  : array();
?>

<?php 
$allow_space  =  array_key_exists("grid_space",$tpl_default_settings) ? " with-space " : " no-space ";
$post_layout	=	isset( $tpl_default_settings['portfolio-post-layout'] ) ? $tpl_default_settings['portfolio-post-layout'] : "one-half-column";
$post_per_page	=	isset( $tpl_default_settings['portfolio-post-per-page'] ) ? $tpl_default_settings['portfolio-post-per-page'] : -1;

$page_layout  = array_key_exists( "layout", $tpl_default_settings ) ? $tpl_default_settings['layout'] : "content-full-width";

if(is_page_template('tpl-onepage.php')) {
	$page_layout = 'fullwidth';
}

#TO SET POST LAYOUT
switch($post_layout):
	case 'one-half-column';
		$post_class = "gallery column dt-sc-one-half ";
		$columns = 2;
		$post_thumbnail = 'portfolio-two-column';
	break;
	
	case 'one-third-column':
		$post_class = "gallery column dt-sc-one-third ";
		$columns = 3;
		$post_thumbnail = 'portfolio-three-column';
	break;

	case 'one-fourth-column':
	default:
		$post_class = "gallery column dt-sc-one-fourth";
		$columns = 4;
		$post_thumbnail = 'portfolio-four-column';
	break;
endswitch;			


if($page_layout == 'fullwidth') $post_thumbnail .= '-fullwidth';
elseif($page_layout == 'with-left-sidebar' || $page_layout == 'with-right-sidebar') $post_thumbnail .= '-single-sidebar';
elseif($page_layout == 'both-sidebar') $post_thumbnail .= '-both-sidebar';

$categories =	isset($tpl_default_settings['portfolio-categories']) ? array_filter($tpl_default_settings['portfolio-categories']) : "";
if(empty($categories)):
	$categories = get_categories('taxonomy=portfolio_entries&hide_empty=1');
else:
	$args = array('taxonomy'=>'portfolio_entries','hide_empty'=>1,'include'=>$categories);
	$categories = get_categories($args);
endif;


if(is_page_template('tpl-onepage.php')) {
	echo '<div class="container">';
}
?>
        <?php 
        $portfolio_posts = get_post($post->ID);
        echo do_shortcode($portfolio_posts->post_content);
        ?>
        <div class="dt-sc-clear"></div>
        <?php if( sizeof($categories) > 1 ) :
                if( array_key_exists("filter",$tpl_default_settings) && (!empty($categories)) ):
                    $post_class .= " all-sort ";?>
                    <div class="sorting-container">
                        <a href="#" class="active-sort" title="" data-filter=".all-sort"><?php _e('All','dt_themes');?></a>
                        <?php foreach( $categories as $category ): 
							$cat_name = str_replace(' ', '-', $category->cat_name);
							?>
                            <a href='#' data-filter=".<?php echo strtolower($cat_name);?>-sort"><?php echo $category->cat_name;?></a>
                        <?php endforeach;?>
                    </div>
        <?php 	endif;
            endif;?>
        <div class="dt-sc-hr-invisible-small"></div>

<?php
if(is_page_template('tpl-onepage.php')) {
	echo '</div>';
}
?>
<!-- **Portfolio Container** -->
<div class="portfolio-container <?php echo $allow_space;?>">
    <?php
    $args = array();
	$categories = isset($tpl_default_settings['portfolio-categories']) ? array_filter($tpl_default_settings['portfolio-categories']) : '';

    if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
    elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
    else { $paged = 1; }

    if(is_array($categories) && !empty($categories)):
        $terms = $categories;
        $args = array( 
            'orderby' => 'ID',
            'order' => 'ASC',
            'paged' => $paged,
            'posts_per_page' => $post_per_page,
            'tax_query' => array( array( 'taxonomy'=>'portfolio_entries', 'field'=>'id', 'operator'=>'IN', 'terms'=>$terms ) ) );
    else:
        $args = array( 'paged' => $paged ,'posts_per_page' => $post_per_page,'post_type' => 'dt_portfolios');
    endif;

    query_posts($args);
    if( have_posts() ):
        $i = 1;
        while( have_posts() ):
            the_post();
            
            $temp_class = $post_class;
            
            $the_id = get_the_ID();

            $portfolio_item_meta = get_post_meta($the_id,'_portfolio_settings',TRUE);
            $portfolio_item_meta = is_array($portfolio_item_meta) ? $portfolio_item_meta  : array();

            #Find sort class by using the portfolio_entries
            $sort = " ";
            if( array_key_exists("filter",$tpl_default_settings) ):
                $item_categories = get_the_terms( $the_id, 'portfolio_entries' );
                if(is_object($item_categories) || is_array($item_categories)):
                    foreach ($item_categories as $category):
						$cat_slug = str_replace(' ', '-', $category->name);
                        $sort .= strtolower($cat_slug).'-sort ';
                    endforeach;
                endif;
             endif;?>
            <!-- Portfolio Item -->
            <div id="<?php echo "portfolio-{$the_id}";?>" class="<?php echo $temp_class.$sort.$allow_space;?>">
                <figure>
                
                    <?php 
                        $popup = "http://placehold.it/1160";
                        if( array_key_exists('items_name', $portfolio_item_meta) ) {
                            $item =  $portfolio_item_meta['items_name'][0];
                            $popup = $portfolio_item_meta['items'][0];
							
                            if( "video" === $item ) {
                                $items = array_diff( $portfolio_item_meta['items_name'] , array("video") );
                                if( !empty($items) ) {
                                    echo "<img src='".$portfolio_item_meta['items'][key($items)]."' width='1160' height='1160' alt='' />";	
                                } else {
                                    echo '<img src="http://placehold.it/1160" width="1160" height="1160" alt="" />';
                                }
                            } else {
								$attachment_id = dt_get_attachment_id_from_url($portfolio_item_meta['items'][0]);
								$img_attributes = wp_get_attachment_image_src($attachment_id, $post_thumbnail);
                                echo "<img src='".$img_attributes[0]."' width='".$img_attributes[1]."' height='".$img_attributes[2]."' />";
                            }
                        } else {
                            echo "<img src='{$popup}' width='1160' height='1160' alt='' />";
                        }
                    ?>
                        
                    <div class="image-overlay">
                        <span class="white-box"></span>
                        <div class="image-overlay-text">
                            <h4><a href="<?php the_permalink();?>" title="<?php printf( esc_attr__('%s'), the_title_attribute('echo=0'));?>"><?php the_title();?></a></h4> 
                            <span class="small-line"></span>
                            <?php if( array_key_exists("sub-title",$portfolio_item_meta) ): ?>
                                <p><a href="<?php the_permalink();?>"><?php echo $portfolio_item_meta["sub-title"];?></a></p>
                            <?php endif;?>
                            <ul class="links">
                                <li><a href="<?php echo $popup;?>" class="zoom" data-gal="prettyPhoto[gallery]" title="<?php printf( esc_attr__('%s'), the_title_attribute('echo=0'));?>"><span class="hexagon"><span class="corner1"></span><span class="corner2"></span><i class="fa fa-search"></i></span></a></li>
                                <li><a href="<?php the_permalink();?>" class="link" title="<?php printf( esc_attr__('%s'), the_title_attribute('echo=0'));?>"><span class="hexagon"><span class="corner1"></span><span class="corner2"></span><i class="fa fa-external-link"></i></span></a></li>
                            </ul>
                        </div>
                        <span class="border-line"></span>
                    </div>
                        
                </figure>
            </div><!-- Portfolio Item -->
        <?php endwhile;
    endif;
    wp_reset_query();?></div><!-- **Portfolio Container** -->

<?php if($post_per_page != -1) { ?>	
<div class="dt-sc-margin70"></div>
<a class="dt-sc-button medium portfolio-load-more aligncenter" data-post-per-page="<?php echo $post_per_page; ?>" data-page="<?php echo $paged+1; ?>" data-postid="<?php echo $tpl_postid; ?>" data-taxonomy="<?php echo implode(',', $categories); ?>" data-page-layout="<?php echo $page_layout; ?>" ><?php _e('Load More', 'dt_themes'); ?></a>
<?php } ?>    