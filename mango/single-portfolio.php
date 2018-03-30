<?php
/**
Single Portfolio Template
 */
global $mango_settings,$args,$mango_layout_columns, $post;
$mango_layout_columns = mango_page_columns();
$mango_class_name = mango_class_name ();
get_header();
$portfolio_type = get_post_meta ( $post->ID, 'mango_portfolio_single_type', true ) ? get_post_meta ( $post->ID, 'mango_portfolio_single_type', true ) : '';
if(!$portfolio_type){
    $portfolio_type = ( isset( $mango_settings[ 'mango_portfolio_single_type' ] ) ) ? $mango_settings[ 'mango_portfolio_single_type' ] : 'boxed';
}
$video_embed = '';
$app_gallery = array();
$path = '';
$author = get_post_meta ( $post->ID, 'mango_portfolio_author', true ) ? get_post_meta ( $post->ID, 'mango_portfolio_author', true ) : '';
$link = get_post_meta ( $post->ID, 'mango_portfolio_link', true ) ? get_post_meta ( $post->ID, 'mango_portfolio_link', true ) : '';
$client = get_post_meta ( $post->ID, 'mango_portfolio_client', true ) ? get_post_meta ( $post->ID, 'mango_portfolio_client', true ) : '';
$banner_type = get_post_meta ( $post->ID, 'mango_banner_portfolio', true ) ? get_post_meta ( $post->ID, 'mango_banner_portfolio', true ) : '';
if($banner_type=='gallery'){
    $app_gallery = get_post_meta($post->ID, 'mango_portfolio_option_image', false);
}elseif($banner_type=='video'){
    $video_embed = get_post_meta($post->ID, 'mango_portfolio_video_embed', true);
}
$tag_slug = array();
$class = "col-md-12";
the_post();
$post_id = get_the_ID();
$containerClass = mango_main_container_class();
?>
    <div class="<?php echo esc_attr($containerClass); ?> main">
                <div>
                    <div class="<?php echo esc_attr($mango_class_name); ?>">
                        <div class="row">
                        <?php if($portfolio_type == 'boxed'){
                                if($banner_type == 'video' && filter_var($video_embed, FILTER_VALIDATE_URL) ){
                                    $class = "col-md-4"; ?>
                                    <div class="col-md-8">
                                        <div class="portfolio-media">
                                            <div class="embed-responsive embed-responsive-16by9">
                                           <?php echo wp_oembed_get($video_embed); ?>
                                            </div>
                                        </div>
                                    </div>
                        <?php  }elseif($banner_type=="gallery" && !empty($app_gallery)){
                                    $class = "col-md-4";
                                    ?>
                                    <div class="col-md-8">
                                        <div id="project-gallery" class="portfolio-media carousel slide" data-ride="carousel" data-interval="7000">
                                            <ol class="carousel-indicators">
                                            <?php for($i = 0; $i< count($app_gallery); $i++){  ?>
                                                <li data-target="#project-gallery" data-slide-to="<?php echo esc_attr($i); ?>" <?php echo ($i==0)? 'class="active"':'' ?>></li>
                                            <?php } ?>
                                            </ol>
                                            <div class="carousel-inner">
                                                <?php
                                                $class2 = "active";
                                                foreach ($app_gallery as $image_id) { ?>
                                                    <div class="item <?php echo esc_attr($class2); ?>">
                                                        <?php $class2 = '';
                                                        $img_src = wp_get_attachment_image_src( $image_id, 'full' ) ;?>
                                                            <img src="<?php echo esc_url($img_src[0]) ?>" alt="">
                                                    </div><!-- End .item -->
                                                <?php } ?>
                                            </div>
                                            <a class="left carousel-control" href="#project-gallery" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                            <a class="right carousel-control" href="#project-gallery" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
                                        </div>
                                    </div>
                         <?php }elseif(has_post_thumbnail($post->ID)){
                                    $class = "col-md-4";
                                        $path = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
                                    <div class="col-md-8">
                                        <div class="portfolio-media">
                                            <img src="<?php echo esc_url($path[0]) ?>" alt="<?php the_title(); ?>">
                                        </div><!-- End .portfolio-media -->
                                    </div><!-- End .col-md-8 -->
                        <?php  }  ?>
                                <div class="<?php echo esc_attr($class); ?>">
                                    <div class="portfolio-details">
                                        <h2 class="regular-title"><?php the_title(); ?></h2>
                                        <h3><?php _e("PROJECT DESCRIPTION","mango") ?></h3>
                                        <?php the_content(); ?>
                                        <ul class="portfolio-details-list">
                                            <?php if($author !=''){ ?>
                                                    <li><span><?php _e("Author","mango")?>:</span> <?php echo esc_attr($author) ?></li>
                                            <?php } ?>
                                            <li><span><?php _e("Date",'mango')?>:</span> <?php the_time("g.i a, j F Y");?></li>
                                            <?php $terms =  get_the_terms($post->ID,"portfolio-category");
                                            if ( $terms && ! is_wp_error( $terms )) {
                                                $term_slugs ='';
                                                foreach ($terms as $term) {
                                                    $term_link = get_term_link( $term );
                                                    $tag_slug[] = $term->slug;
                                                    $portfolio_tags[] = "<a href='".esc_url($term_link)."'>".$term->name."</a>";
                                                } ?>
                                                <li><span><?php _e("Category","mango")?>:</span> <?php echo rtrim(implode(", ",$portfolio_tags),', '); ?></li>
                                        <?php } ?>
                                            <?php if($client !=''){ ?>
                                                <li><span><?php _e("Client",'mango')?>:</span> <?php echo esc_attr($client) ?></li>
                                            <?php } ?>
                                            <?php if($link !='' && filter_var($link, FILTER_VALIDATE_URL)){ ?>
                                                <li><span><?php _e("Link",'mango')?>:</span> <a href="<?php echo esc_url($link); ?>"><?php echo esc_attr($link) ?></a></li>
                                           <?php } ?>
                                            <!-- social share icons -->
                                           <?php  mango_add_social_share() ?>
                                        </ul>
                                    </div>
                                </div>
                    <?php    }elseif($portfolio_type=="full-width"){ //boxed layout  ?>
                            <div class="row">
                                <div class="col-md-12">
                                <?php    if($banner_type == 'video' && filter_var($video_embed, FILTER_VALIDATE_URL) ){ ?>
                                        <div class="portfolio-media fullwidth-media">
                                            <div class="embed-responsive embed-responsive-16by9">
                                                <?php echo wp_oembed_get($video_embed); ?>
                                            </div>
                                        </div>
                                    <?php  }elseif($banner_type=="gallery" && !empty($app_gallery)){
                                        ?>
                                            <div id="project-gallery" class="portfolio-media fullwidth-media carousel slide" data-ride="carousel" data-interval="7000">
                                                <ol class="carousel-indicators">
                                                    <?php for($i = 0; $i< count($app_gallery); $i++){  ?>
                                                        <li data-target="#project-gallery" data-slide-to="<?php echo esc_attr($i); ?>" <?php echo ($i==0)? 'class="active"':'' ?>></li>
                                                    <?php } ?>
                                                </ol>
                                                <div class="carousel-inner">
                                                    <?php
                                                    $class2 = "active";
                                                    foreach ($app_gallery as $image_id) { ?>
                                                        <div class="item <?php echo esc_attr($class2); ?>">
                                                            <?php $class2 = '';
                                                            $img_src = wp_get_attachment_image_src( $image_id, 'full' ) ;?>
                                                            <img src="<?php echo esc_url($img_src[0]) ?>" alt="">
                                                        </div><!-- End .item -->
                                                    <?php } ?>
                                                </div>
                                                <a class="left carousel-control" href="#project-gallery" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                                <a class="right carousel-control" href="#project-gallery" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
                                            </div>
                                    <?php }elseif(has_post_thumbnail($post->ID)){
                                        $path = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
                                            <div class="portfolio-media fullwidth-media">
                                                <img src="<?php echo esc_url($path[0]) ?>" alt="<?php the_title(); ?>">
                                            </div><!-- End .portfolio-media -->
                                    <?php  }  ?>
                                    <div class="portfolio-details">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h2 class="regular-title"><?php the_title(); ?></h2>
                                                <h3><?php _e("PROJECT DESCRIPTION",'mango') ?></h3>
                                                <p><?php the_content(); ?></p>
                                            </div><!-- End -->
                                            <div class="col-md-4">
                                                <div class="portfolio-details-box">
                                                    <ul class="portfolio-details-list">
                                                        <?php if($author !=''){ ?>
                                                            <li><span><?php _e("Author","mango")?>:</span> <?php echo esc_attr($author) ?></li>
                                                        <?php } ?>
                                                        <li><span><?php _e("Date",'mango')?>:</span> <?php the_time("g.i a, j F Y");?></li>
                                                        <?php $terms =  get_the_terms($post->ID,"portfolio-category");
                                                        if ( $terms && ! is_wp_error( $terms )) {
                                                            $term_slugs ='';
                                                            foreach ($terms as $term) {
                                                                $term_link = get_term_link( $term );
                                                                $tag_slug[] = $term->slug;
                                                                $portfolio_tags[] = "<a href='".esc_url($term_link)."'>".$term->name."</a>";
                                                            } ?>
                                                            <li><span><?php _e("Category","mango")?>:</span> <?php echo rtrim(implode(", ",$portfolio_tags),', '); ?></li>
                                                        <?php } ?>
                                                        <?php if($client !=''){ ?>
                                                            <li><span><?php _e("Client",'mango')?>:</span> <?php echo esc_attr($client) ?></li>
                                                        <?php } ?>
                                                        <?php if($link !='' && filter_var($link, FILTER_VALIDATE_URL)){ ?>
                                                            <li><span><?php _e("Link",'mango')?>:</span> <a href="<?php echo esc_url($link); ?>"><?php echo esc_attr($link) ?></a></li>
                                                        <?php } ?>
                                                        <?php  mango_add_social_share() ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                        <!-- Related Work row new -->
                        <?php $related_work = ( isset( $mango_settings[ 'mango_portfolio_related_work' ] ) ) ? $mango_settings[ 'mango_portfolio_related_work' ] : ''; ?>
                        <?php if($related_work){
                                $args = array(
                                    'posts_per_page' => '-1',
                                    'post_type' =>   'portfolio',
                                    'post__not_in' => array($post_id),
                                    'post_status' => 'publish',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'portfolio-category',
                                            'field' => 'slug',
                                            'terms' =>$tag_slug
                                        )
                                    )
                                );
                            $related = new WP_Query($args);
                            if($related->have_posts()){ ?>
                                 <div class="row">
                                     <div class="col-md-12 portfolio-related-container">
                                         <h3><?php _e("Related Work","mango") ?></h3>
                                         <div class="portfolio-related-carousel owl-carousel nav-animate popup-gallery">
                                             <?php
                                             $portfolio_settings['page_style']="grid";
                                             while($related->have_posts()){ $related->the_post();
                                                 $images = mango_portfolio_img_src(get_the_ID(),"2col-portfolio");
                                                 ?>

                                                 <div class="portfolio-item">
                                                 <figure>
                                                     <a href="<?php echo esc_url($images['anchor']) ?>" class="zoom-item <?php echo esc_attr($images['class']) ?> " title="<?php the_title() ?>">
                                                         <img src="<?php echo esc_url($images['img']) ?>" alt="<?php the_title() ?>"></a>
                                                 </figure>

                                                 <h2 class="portfolio-title">
                                                     <a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
                                                 <div class="portfolio-meta-wrapper">
                                                     <?php
                                                     $terms = get_the_terms(get_the_ID(), 'portfolio-category' );
                                                     if ( $terms && ! is_wp_error( $terms )) {
                                                         $term_slugs ='';
                                                         $portfolio_tags = array();
                                                         foreach ($terms as $term) {
                                                             $term_slugs.= ' category-'.$term->term_id;
                                                             $term_link = get_term_link( $term );
                                                             $portfolio_tags[] = "<a href='".esc_url($term_link)."'>".$term->name."</a>";
                                                         }
                                                     }
                                                     ?>
                                                     <span class="portfolio-tags"><?php echo rtrim(implode(", ",$portfolio_tags),', '); ?></span><!-- End .portfolio-tags -->
                                                     <?php $comments_count = wp_count_comments(get_the_ID());
                                                     $total_comments = $comments_count->total_comments; ?>
                                                     <a href="#" class="portfolio-comment-link"><?php echo esc_attr($total_comments).' '.(($total_comments=='' || $total_comments >1)?__("Comments","mango"):__("Comment","mango") )?></a>
                                                 </div>
                                                 <p><?php the_excerpt(); ?></p>
                                             </div>
                                             <?php } ?>
                                         </div>
                                     </div>
                                 </div>
                            <?php }
                            wp_reset_postdata();
                        } ?>
                        <?php  if($mango_settings['mango_portfolio_comment']){
                            comments_template ();
                        } ?>
                    </div><!-- End .col-md-* -->
                    <div class="md-margin2x clearfix visible-sm visible-xs"></div><!-- space -->
                <?php  get_sidebar() ?>
                </div><!-- End .row -->
    </div><!-- End .container -->
        <div class="lg-margin hidden-xs hidden-sm"></div><!-- space -->
    </section><!-- End #content -->
<?php get_footer() ?>