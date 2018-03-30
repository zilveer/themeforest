<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php wp_title(); ?></title>
</head>
<body>
<!-- Page wrap -->
<div id="page-wrap">
    <div id="ajaxpage" class="ajaxpage">
        <div class="container">
            <div class="row">
                <?php while(have_posts()) : the_post(); ?>
                	<?php 
                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),false,false );
                        $format=get_post_meta(get_the_ID(),'format',true); 
                        $class = 'class="col col-md-8"';
                        if($format!='standard'){
                            $class = '';
                        }
                    ?>
                    <div <?php echo $class; ?>>
                    <?php 
                        switch ($format) {
                            case 'gallery': 
                                $gallery = get_post_meta(get_the_ID(),'gallery',true);
                            ?>
                                
                                <?php
                                if($gallery && is_array($gallery)){ 
                                    echo '<div class="owl-box">';
                                    foreach ($gallery as $value) {
                                        echo '<div class="item"><img src="'.$value.'" alt="'. get_the_title() .'"></div>';
                                    }
                                    echo '</div>';
                                }else{
                                    echo "<h3>No gallery exists</h3>";
                                } ?>
                                </div>
                            <?php
                                break;
                            case 'image':
                                $gallery = get_post_meta(get_the_ID(),'gallery',true);
                                ?>
                                <div class="item">
                                <?php if($gallery && is_array($gallery)){ ?>
                                    <img src="<?php echo $gallery[0] ;?>" alt="<?php the_title(); ?>"></div>
                                <?php }else{
                                    echo "<h3>no Image exists</h3>";
                                    } ?>
                                <?php
                                break;
                            case 'video':
                                $videos=get_post_meta(get_the_ID(),'videos',true);
                                if($videos && is_array($videos)){
                                    $video = (array)json_decode($videos[0]);
                                    if($video['type']=='youtube')
                                        echo '<div class="w-video"><iframe height="650" width="100%" src="//www.youtube.com/embed/'.$video['id'].'" frameborder="0" allowfullscreen></iframe></div>';
                                    if($video['type']=='vimeo')
                                        echo '<div class="w-video"><iframe height="650" width="100%" src="//player.vimeo.com/video/'.$video['id'].'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>';
                                }else{
                                    echo '<h3>No video exists</h3>';
                                }
                                break;
                            
                            default:
                                ?>
                                <?php
                                    $gallery = get_post_meta(get_the_ID(),'gallery',true);
                                    $html = '';
                                    if($gallery && is_array($gallery)){
                                        foreach ($gallery as $value) {
                                            $html .= '<div class="item"><img src="'.$value.'" alt="'. get_the_title() .'"></div>';
                                        }
                                    }
                                    $videos=get_post_meta(get_the_ID(),'videos',true);
                                    if($videos && is_array($videos)){
                                        $video = (array)json_decode($videos[0]);
                                        if($video['type']=='youtube')
                                            $html .= '<div class="w-video item"><iframe height="650" width="100%" src="//www.youtube.com/embed/'.$video['id'].'" frameborder="0" allowfullscreen></iframe></div>';
                                        if($video['type']=='vimeo')
                                            $html.= '<div class="w-video item"><iframe height="650" width="100%" src="//player.vimeo.com/video/'.$video['id'].'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>';
                                    }

                                ?>
                                <?php 
                                    if($html!='') {
                                        echo '<div class="owl-box">';
                                        echo $html;
                                        echo '</div>';
                                    }else{
                                        echo "No Content exists";
                                    } 
                                ?>
                                <?php
                                break;
                        }
                    ?>
                        
                    </div>
                <?php if($format=='standard') : ?>
                    <div class="col col-md-4">
                        <div class="about-pj">
                            <h4><?php _e('About project',LANGUAGE); ?></h4>
                           <?php the_content(); ?>
                        </div>
                        <div class="detail-pj">
                            <h4><?php _e('Project details',LANGUAGE) ?></h4>
                            <ul>
                                <li class="clearfix">
                                <?php 
                                $categories = get_the_terms(get_the_ID(),'portfolio_cat');
                                $cat_names=array();
                                $cat_slugs=array();
                                if(is_array($categories))
                                    foreach($categories as $cat)
                                    {
                                        $cat_names[]=$cat->name;
                                    }
                                ?>
                                    <div class="pull-left list-tt"><?php _e('Category',LANGUAGE) ?></div>
                                    <div class="pull-right list-desc">
                                    <?php
                                        $i=0; $cat='';
                                        if(is_array($cat_names)): foreach ($cat_names as $value) {
                                            if($i>0) $cat .= ' & '.$value;
                                            else $cat .= $value;
                                            $i++;
                                        }
                                        echo $cat; 
                                        endif; 
                                        ?>
                                    </div>
                                </li>
                                <li class="clearfix">
                                    <div class="pull-left list-tt"><?php _e('Date',LANGUAGE); ?></div>
                                    <div class="pull-right list-desc"><?php echo get_the_date(); ?></div>
                                </li>
                                <li class="clearfix">
                                    <div class="pull-left list-tt"><?php _e('Client',LANGUAGE) ?></div>
                                    <div class="pull-right list-desc"><?php $meta_data = get_post_meta(get_the_ID(),'client_list',true); echo get_the_title($meta_data); ?></div>
                                </li>
                                <?php $link_project = get_post_meta(get_the_ID(),'project_link',true); ?>
                                <?php if($link_project!='') : ?>
                                    <li class="clearfix">
                                        <div class="pull-left list-tt"><a href="<?php echo $link_project ?>" class="link"><?php _e('View project',LANGUAGE) ?></a></div>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
                <?php endwhile; wp_reset_query(); ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>