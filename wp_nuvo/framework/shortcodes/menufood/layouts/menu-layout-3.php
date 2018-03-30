<?php $count = 0; ?>

<?php while ($wp_query->have_posts()): $wp_query->the_post(); $count++; ?>

<?php if($r == 0){ echo '<div class="row">'; } $r++; ?>

<article id="post-<?php the_ID(); ?>" class="<?php echo $col; ?> cs-menuFood cs-menuFood-images layout2 post">
    <div class="cs-menuFood-main">
        <header class="cs-menuFood-header">
            <<?php echo $post_heading; ?> class="cs-post-title">
              <?php if($show_link): ?>
    		     <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    		  <?php else :
    		     the_title();
    		  endif; ?>
            </<?php echo $post_heading; ?>>
            <?php if($show_price == '1'): ?>
                <div class="price-food">
                    <span>
                    <?php
                    $price = get_post_meta(get_the_ID(), 'cs_menu_price', true);
                    $unit = get_post_meta(get_the_ID(), 'cs_price_unit', true);
                    if($unit){
                        if($smof_data['restaurant_menu_price_position']){
                            echo $unit.' '.$price;
                        } else {
                            echo $price.' '.$unit;
                        }
                    } else {
                        echo $price;
                    }
                    ?>
                    </span>
                </div><!-- .price -->
            <?php endif; ?>
        </header><!-- .entry-header -->
        <div class="menu-content">
            <?php if($image == '1'): ?>
                <div class="menu-image" style="width: <?php echo $width_image; ?>px">
                    <div class="menu-image-meta">
                        <?php
                        $attachment_full_image = "";
                        if (has_post_thumbnail()) {
                            $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
                            $attachment_full_image = $attachment_image[0];
                            if($crop_image == true || $crop_image == 1){
                                $image_resize = matthewruddy_image_resize( $attachment_image[0], $width_image, $height_image, true, false );
                                echo '<img alt="" class="attachment-featuredImageCropped" src="'. $image_resize['url'] .'" />';
                            }else{
                               echo '<img alt="" class="attachment-featured" src="'. $attachment_full_image .'" />';
                            }
                        }
                        ?>
                        <a class="menuFoood-zoom colorbox" href="<?php echo $attachment_full_image; ?>"><i class=" fa fa-search"></i></a>
                        <div class="menuFoood-overlay"></div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="cs-menuFood-content" style="padding-left: <?php echo $width_image; ?>px">
                <div class="padding">
                    <?php if($excerpt_length != ''){
                        echo cshero_string_limit_words(strip_tags(get_the_content()), $excerpt_length);
                    } else {
                        the_content();
                    }
                    ?>
                </div>
            </div><!-- .entry-content -->
            </div>
            <div class="cs-menuFood-footer table">
            <?php if(get_post_meta(get_the_ID(), 'cs_menu_special', true)=='yes'): ?>
                <div class="feature-icon table-cell">
                   <span><?php esc_html_e('CHEFS SPECIAL', 'wp_nuvo'); ?></span>
                </div>
            <?php endif; ?>
            <div class="description-icon table-cell cell-bottom">
            <?php for($i = 0 ; $i<5; $i++):
			$text = get_post_meta(get_the_ID(), 'cs_menu_custom_field_'.$i, true);
			$icon = get_post_meta(get_the_ID(), 'cs_menu_custom_field_icon_'.$i, true);
			$desc = get_post_meta(get_the_ID(), 'cs_menu_custom_field_desc_'.$i, true);
			?>
				<?php if($text || $icon): ?>
                	<span data-rel="tooltip" data-placement="top" data-original-title="<?php echo esc_attr($desc); ?>">
                	<?php
                	if($icon){
                	    echo '<i class="'.$icon.'"></i>';
                	} elseif ($text) {
                	    echo esc_attr($text);
                	}
                	?>
                	</span>
                <?php endif; ?>
            <?php endfor; ?>
            </div>
        </div>
    </div>
   </article><!-- #post-## -->
<?php if($r == $layout_colunm || $count == $wp_query->post_count) { echo '</div>'; $r = 0; } ?>
<?php endwhile; ?>