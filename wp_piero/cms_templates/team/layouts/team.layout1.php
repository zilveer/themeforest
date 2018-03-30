<?php
    global $team_options;
    extract($team_options);
?>
<article <?php  post_class(); ?>>
    <?php if($show_image) : ?>
        <div class="cshero-team-image clearfix" <?php echo $crop_image_size;?>>
            <?php
                if($crop_image){
                    $image_resize = mr_image_resize( $full_image, $width_image, $height_image, true, 'c', false );
                    echo '<img alt="" src="'. esc_url($image_resize) .'" '.$image_style.' />';
                }else{
                    echo '<img alt="" src="'. esc_attr($full_image) .'" '.$image_style.' />';
                }
            ?>
            <?php if ($show_description) { ?>
            <div class="overlay <?php echo $overlay_appear;?>" <?php echo $overlay_style;?>>
                <div class="overlay-content">
                    <div class="cshero-team-description">
                        <?php echo substr(get_the_content($read_more), 0, $excerpt_length); ?>
                    </div>
                </div>
            </div>

            <?php } ?>
        </div>
    <?php endif; ?>
    <div class="cshero-team-content" <?php echo $content_style;?>>
        <div class="cshero-team-info-wrap">
            <?php if ($show_title) { ?>
                <<?php echo $item_heading_size;?> class="cshero-team-title" <?php echo $team_title_style;?>>
                    <a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php the_title() ?></a>
                </<?php echo $item_heading_size;?>>
            <?php } ?>
        
            <?php if ($show_category) { ?>
                <div class="cshero-team-category"><?php echo strip_tags (get_the_term_list($post->ID, 'team_category', '', ', ', '')); ?></div>
            <?php } ?>
            <?php  if($show_team_position) {                            
                $team_position = isset($custom['team_position'][0]) ? $custom['team_position'][0] : '';
                if ($team_position) { ?>
                <div class="cshero-team-info cshero-team-position"><?php echo strip_tags ($team_position); ?></div>
            <?php } } ?>
            <?php  ?>
            <?php  if($show_team_qualification) {                           
                $team_qualification = isset($custom['team_qualification'][0]) ? $custom['team_qualification'][0] : '';
                if ($team_qualification) { ?>
                <div class="cshero-team-info cshero-team_qualification"><i class="fa fa-user-md"></i> <?php echo strip_tags ($team_qualification); ?></div>
            <?php } } ?>
            <?php  ?>
            <?php  if($show_team_experience) {                          
                $team_experience = isset($custom['team_experience'][0]) ? $custom['team_experience'][0] : '';
                if ($team_experience) { ?>
                <div class="cshero-team-info cshero-team_experience"><i class="fa fa-clock-o"></i> <?php echo strip_tags ($team_experience); ?></div>
            <?php } }?>
            <?php  if($show_team_contact_info) {                               
                $team_contact_info = isset($custom['team_contact_info'][0]) ? $custom['team_contact_info'][0] : '';
                if ($team_contact_info) { ?>
                <div class="cshero-team-info cshero-team_contact_info"><i class="fa fa-info-circle"></i> <?php echo strip_tags ($team_contact_info); ?></div>
            <?php } } ?>
        </div>

        <?php if ($read_more || $show_socials) { ?>
                    <?php if ($show_socials) {
                        if (!empty($links)) {
                            $social_title = get_post_meta( $post->ID, '_cshero_team_social', true );
                            if(!empty($social_title)){
                                echo '<h3 class="cshero-content-header">'.$social_title.'</h3>';
                            }
                            echo '<div class="cshero-team-social">' . implode('', $links) . '</div>';
                        }

                     } ?>
                    <?php if($read_more) echo '<div class="cshero-readmore">'.$readmore_link.'</div>';  ?>
                
        <?php } ?>
    </div>
</article>
