<?php get_header(); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
    
<?php

    $member_id = get_the_ID();
    
    $thumbnail ='';
    $member_info_col_class = '';
    
    if(has_post_thumbnail()) {
        $thumbnail = get_the_post_thumbnail($member_id, 'rectangle');
    } else {
        $member_info_col_class = 'uxb-col large-12 columns';
    }
    
    $position = uxbarn_get_translated_text_from_qTranslate(uxbarn_get_array_value(get_post_meta($member_id, 'uxbarn_team_meta_info_position'), 0));
    $email = uxbarn_get_array_value(get_post_meta($member_id, 'uxbarn_team_meta_info_email'), 0);
    
    $social_list_item_string = uxbarn_get_member_social_list_string($member_id);

?>
    
<div id="team-single">

    <div class="row bottom-line top-margin">
        
        <?php if(has_post_thumbnail()) : ?>
                
            <div id="member-thumbnail" class="no-padding columns">
                <?php echo $thumbnail; ?>
            </div>
        
        <?php endif; ?>
        
        <div id="member-info" class="columns">
            <h1 class="member-name"><?php the_title(); ?></h1>
            
            <?php if(trim($position) != '') : ?>
            
                <h2 class="member-position light"><?php echo $position; ?></h2>
                
            <?php endif; ?>
            
            <?php if(trim($email) != '') : ?>
                
                <p>
                    <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
                </p>
                
            <?php endif; ?>
            
            <?php if($social_list_item_string != '') : ?>
                
                <ul class="team-social">
                    <?php echo $social_list_item_string; ?>
                </ul>
                
            <?php endif; ?>
        </div>
    </div>
    
    <?php echo uxbarn_get_final_post_content(); ?>
    
</div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>