<?php
/*
* Template Name: Filterable Gallery
*/
get_header();

get_template_part( 'template-part-page-slider', 'childtheme' ); 

//get all post meta for gallery setting.
global $post;
$st_gallery_layout          = get_post_meta($post->ID,'meta_truethemes_gallery_layout',true);
//$st_gallery_category        = get_post_meta($post->ID,'meta_truethemes_gallery_category',true);
$st_gallery_filter_linktext = get_post_meta($post->ID,'meta_truethemes_gallery_filter_linktext',true);
$st_gallery_itemcount       = get_post_meta($post->ID,'meta_truethemes_gallery_itemcount',true);

//check user selected layout to determine values.
switch($st_gallery_layout){
case "tt-2-col":
  $tt_column_size  = 'one_half';
  $image_frame_class = 'full-half';
  $image_width     = 445;
  $image_height    = 273;  
  break;
case "tt-3-col":
  $tt_column_size  = 'one_third';
  $image_frame_class = 'full-third';
  $image_width     = 280;
  $image_height    = 179;  
  break;

case "tt-4-col":
  $tt_column_size  = 'one_fourth';
  $image_frame_class = 'full-fourth';  
  $image_width     = 197;
  $image_height    = 133;  
  break;

case "tt-3-col-portrait":
  $tt_column_size  = 'one_third';
  $image_frame_class = 'full-third-portrait';  
  $image_width     = 280;
  $image_height    = 354;  
  break;

case "tt-4-col-portrait":
  $tt_column_size  = 'one_fourth';
  $image_frame_class = 'full-fourth-portrait';  
  $image_width     = 183;
  $image_height    = 276;  
  break;
}

//@since 2.2 mod by denzel to use category id from gallery category id text input added in custom-metaboxes.php
//as a fail safe in case gallery category dropdown does not save the correct category id.

    $tt_sterling_gallery_cat_id       = get_post_meta($post->ID, 'gallery_cat_id',true);
    if($tt_sterling_gallery_cat_id!=''){
    $tt_sterling_gallery_cat_id    = $tt_sterling_gallery_cat_id;
    }else{
    //if user does not enter a gallery category id, we use back the category dropdown
	$tt_sterling_gallery_cat_id      =   get_post_meta($post->ID, 'meta_truethemes_gallery_category', true);
    }  
    
    //Uncomment to see what is being saved? They should be string now not array.
    //var_dump($tt_sterling_gallery_cat_id);
    
    //remember line 80, line 106 and line 122 uses the same $tt_karma_gallery_cat_id   

?>

<section id="content-container" class="clearfix">
<?php //@since 2.6 - ability for page content above galery items
if(have_posts()) : while(have_posts()) : the_post(); ?>
    <section class="sterling-wrap">
        <?php the_content(); truethemes_link_pages(); ?>
    </section><!-- END .sterling-wrap -->
        <?php endwhile; endif;?>
    <ul id="gallery-nav">
        <li class="active"><a href="#" data-filter="*"><?php printf( __( '%s','tt_theme_framework' ), $st_gallery_filter_linktext );?></a></li>
        <?php
            wp_list_categories(
                array(
                    'title_li'          => '',
                    'show_option_none'  => '',
                    'taxonomy'          => 'gallery-category',
                    'child_of' => $tt_sterling_gallery_cat_id,
                    'walker'            => new truethemes_gallery_walker()
                )
            );
        ?>
    </ul>

    <div id="gallery-outer-wrap" class="clearfix">
        <div id="main-wrap" class="main-wrap-slider clearfix">
            <div id="iso-wrap" class="clearfix <?php if($st_gallery_layout != "tt-2-col"){echo "iso-space";}?>">
                <?php
                    // Reset post data.
                    wp_reset_postdata();
                    $photo_group    = 0; // For prettyPhoto grouping.
                    $count          = 1; // For unique id of gallery item

                    // Build query.
                    $num_of_gallery_posts = $st_gallery_itemcount;
                    if ( $num_of_gallery_posts == '' ) :
                       $query_string = array(
											'post_type'      => 'gallery',
											'posts_per_page' => -1,
											'tax_query'      => array(
															array(
										    				    'taxonomy' => 'gallery-category',
										    				    'field'    => 'id',
										    				    'terms'    => array(0 => $tt_sterling_gallery_cat_id),
										    				    )
										    				)
										    			);

                        $query = new WP_Query( $query_string );
                    else :
                        $num_per_page   = (int) $num_of_gallery_posts;
                        $query_string = array(
											'post_type'      => 'gallery',
											'posts_per_page' => $num_per_page,
											'paged' => get_query_var('paged'),
											'tax_query'      => array(
															array(
										    				    'taxonomy' => 'gallery-category',
										    				    'field'    => 'id',
										    				    'terms'    => array(0 => $tt_sterling_gallery_cat_id),
										    				    )
										    				)
										    			);                       
                        
                        $query = new WP_Query( $query_string );
                    endif;


                    //Start the WordPress Loop after querying the posts.
                    if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
                        $terms = get_the_terms( get_the_ID(), 'gallery-category' );

                        // Prepare all post meta values.
                        $gal_thumbnail          = get_post_meta( $post->ID, 'gal_thumbnail', true );
                        $gal_thumbnail_crop     = truethemes_crop_image( null, $gal_thumbnail, $image_width,$image_height);
                        $gal_description        = get_post_meta( $post->ID, 'gal_description', true );
                        $gal_description_select = get_post_meta( $post->ID, 'gal_description_select', true );
                        $gal_lightbox           = get_post_meta( $post->ID, 'gal_lightbox', true );
                        $gal_lightbox2          = get_post_meta( $post->ID, 'gal_lightbox2', true );
                        $gal_lightbox2_crop     = truethemes_crop_image( null, $gal_lightbox2, $image_width, $image_height);
                        $gal_lightbox3          = get_post_meta( $post->ID, 'gal_lightbox3', true );
                        $gal_lightbox3_crop     = truethemes_crop_image( null, $gal_lightbox3, $image_width,$image_height);
                        $gal_lightbox4          = get_post_meta( $post->ID, 'gal_lightbox4', true );
                        $gal_lightbox4_crop     = truethemes_crop_image( null, $gal_lightbox4, $image_width,$image_height);
                        $gal_lightbox5          = get_post_meta( $post->ID, 'gal_lightbox5', true );
                        $gal_lightbox5_crop     = truethemes_crop_image( null, $gal_lightbox5, $image_width,$image_height);
                        $gal_title_select       = get_post_meta( $post->ID, 'gal_title_select', true );
                        $gal_lightbox_title     = get_post_meta( $post->ID, 'gal_lightbox_title', true );
                        $gal_lightbox_title_2     = get_post_meta( $post->ID, 'gal_lightbox_title_2', true );
                        $gal_lightbox_title_3     = get_post_meta( $post->ID, 'gal_lightbox_title_3', true );
                        $gal_lightbox_title_4     = get_post_meta( $post->ID, 'gal_lightbox_title_4', true );
                        $gal_lightbox_title_5     = get_post_meta( $post->ID, 'gal_lightbox_title_5', true );                                       
                        $cat                    = get_the_category( $post->ID );
                        $gal_link_to_page       = get_post_meta( $post->ID, 'gal_link_to_page', true );
                        $gal_link_target        = get_post_meta( $post->ID, 'gal_link_target', true );

                        // Determine whether to print prettyPhoto in group or single.
                        if ( ! empty( $gal_lightbox2 ) )
                            $prettyPhoto_group = 'prettyPhoto[group' . $photo_group . ']';
                        else
                            $prettyPhoto_group = 'prettyPhoto';
                        ?>

                        <div data-id="id-<?php echo absint( $count ); ?>" class="<?php echo $tt_column_size; ?> <?php if ( $terms ) : foreach ( $terms as $term ) : echo sanitize_html_class( 'term-' . absint( $term->term_id ) ) . ' '; endforeach; endif; ?>">
                            <div class="img-frame <?php echo $image_frame_class; ?>">
                                <?php if ( ! empty( $gal_link_to_page ) ) : // Process a linked lightbox. ?>
                                    <div class="lightbox-linked">
                                        <a class="hover-item" href="<?php echo esc_url( $gal_link_to_page ); ?>" target="<?php echo esc_attr( $gal_link_target ); ?>" title="<?php echo esc_attr( $gal_lightbox_title ); ?>">
                                            <img src="<?php echo esc_url( $gal_thumbnail_crop ); ?>" alt="" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" />
                                        </a>
                                <?php else: // Process a normal lightbox. ?>
                                    <div class="lightbox-zoom">
                                        <a class="hover-item" data-gal="<?php echo esc_attr( $prettyPhoto_group ); ?>" href="<?php echo esc_url( $gal_lightbox ); ?>" title="<?php echo esc_attr( $gal_lightbox_title ); ?>">
                                            <img src="<?php echo esc_url( $gal_thumbnail_crop ); ?>" alt="" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" />
                                        </a>
                                <?php endif; ?>
                                </div><!-- end .lightbox-linked or .lightbox-zoom -->
                            </div><!-- end .img-frame -->

                            <?php // Start with lightbox2 since lightbox1 is already shown as the main item. ?>
                            <?php if ( ! empty( $gal_lightbox2 ) ) : ?>
                                <a data-gal="prettyPhoto[group<?php echo esc_attr( $photo_group ); ?>]" href="<?php echo esc_url( $gal_lightbox2 ); ?>" title="<?php echo esc_attr( $gal_lightbox_title_2 ); ?>">
                                    <img src="<?php echo esc_url( $gal_lightbox2_crop ); ?>" alt="" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" style="display:none" />
                                </a>
                            <?php endif; ?>

                            <?php if ( ! empty( $gal_lightbox3 ) ) : ?>
                                <a data-gal="prettyPhoto[group<?php echo esc_attr( $photo_group ); ?>]" href="<?php echo esc_url( $gal_lightbox3 ); ?>" title="<?php echo esc_attr( $gal_lightbox_title_3 ); ?>">
                                    <img src="<?php echo esc_url( $gal_lightbox3_crop ); ?>" alt="" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" style="display:none" />
                                </a>
                            <?php endif; ?>

                            <?php if ( ! empty( $gal_lightbox4 ) ) : ?>
                            <a data-gal="prettyPhoto[group<?php echo esc_attr( $photo_group ); ?>]" href="<?php echo esc_url( $gal_lightbox4 ); ?>" title="<?php echo esc_attr( $gal_lightbox_title_4 ); ?>">
                                <img src="<?php echo esc_url( $gal_lightbox4_crop ); ?>" alt="" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" style="display:none" />
                            </a>
                            <?php endif; ?>

                            <?php if ( ! empty( $gal_lightbox5 ) ) : ?>
                                <a data-gal="prettyPhoto[group<?php echo esc_attr( $photo_group ); ?>]" href="<?php echo esc_url( $gal_lightbox5 ); ?>" title="<?php echo esc_attr( $gal_lightbox_title_5 ); ?>">
                                    <img src="<?php echo esc_url( $gal_lightbox5 ); ?>" alt="" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" style="display:none" />
                                </a>
                            <?php endif;

                            // Check if the user has selected to display the gallery title.
                            if ( 'yes' == $gal_title_select )
                                the_title( '<h4>', '</h4>' );

                            // Check if the user has selected to display the gallery description.
                            if( 'yes' == $gal_description_select )
                                echo '<p>' . esc_html( $gal_description ) . '</p>'; ?>

                        </div><!-- end .one-half -->
                        <?php $count++; $photo_group++; endwhile; endif; ?>
            </div><!-- end #iso-wrap -->

            <div class="gallery-wp-navi">
                <?php
                    if ( function_exists( 'wp_pagenavi' ) )
                        // Pass in custom query array - do not change the code below!
                        wp_pagenavi( $custom_query = $query );
                    else
                        paginate_links();
                ?>
            </div><!-- end .gallery-wp-navi -->
        </div><!-- end #main-wrap -->
    </div><!-- end #gallery-outer-wrap -->

<?php get_footer(); ?>