<?php
get_header(vibe_get_header());
$unit_comments = vibe_get_option('unit_comments');

if ( have_posts() ) : while ( have_posts() ) : the_post();
$id = get_the_ID();
?>
<section id="title">
    <div class="<?php echo vibe_get_container(); ?>">
        <div class="row">
            <div class="col-md-9 col-sm-8">
                <div class="pagetitle">
                    <h1 id="unit" data-unit="<?php echo get_the_ID(); ?>"><?php the_title(); ?></h1>
                    <?php the_sub_title(); ?>
                </div>
            </div>
            <div class="col-md-3 col-sm-4">
                <?php
                if(isset($_GET['id']) && is_numeric($_GET['id'])){
                  if(strpos($_SERVER["REQUEST_URI"],'/edit/')){
                    $edit_course = vibe_get_option('create_course');
                    if(isset($edit_course) && is_numeric($edit_course))
                        echo '<input id="course_id" type="hidden" value="'.$_GET['id'].'"><a href="'.get_permalink($edit_course).'?action='.$_GET['id'].'" class="course_button button full">'.__('Back to Edit Course','vibe').'</a>';
                  }
                
                  global $wpdb;
                  $uid=get_the_ID();
                  $course_id = '';
                  if(function_exists('bp_course_get_unit_course_id')){
                    $course_id = bp_course_get_unit_course_id($uid);
                  }
                  if(is_numeric($course_id) && get_post_type($course_id) == 'course'){
                    $extension = '';
                    $settings = WPLMS_tips::init();
                    if(!empty($settings->settings) && empty($settings->settings['course_curriculum_below_description'])){
                      
                      
                        $permalinks = get_option( 'vibe_course_permalinks' );
                        $curriculum_slug = (!empty($permalinks['curriculum_slug'])?$permalinks['curriculum_slug']:'curriculum');
                        if(!empty($curriculum_slug) && empty($settings->settings['revert_permalinks'])){
                           $extension = $curriculum_slug.'/';
                        }else{
                        $extension = '?action=curriculum&curriculum/';
                      }
                    }
                    
                    echo '<input id="course_id" type="hidden" value="'.$course_id.'"><a href="'.get_permalink($course_id).$extension.'" class="course_button button full">'.__('Back to Course','vibe').'</a>';
                  }else{
                    vibe_breadcrumbs();
                  }
                }
                ?>
            </div>
        </div>
    </div>
</section>
<section id="content">
    <div class="<?php echo vibe_get_container(); ?>">
        <div class="row">
            <div class="col-md-9 col-sm-8">
                <div class="unit_wrap <?php if(isset($unit_comments) && is_numeric($unit_comments)){echo 'enable_comments';} ?>">
                    <div id="unit_content" class="unit_content">
                    <?php
                    $unit_class = 'unit_class single_unit_content';
                    $unit_class=apply_filters('wplms_unit_classes',$unit_class,$id);
                    ?>
                    <div class="main_unit_content <?php echo $unit_class;?>">
                    <?php if(has_post_thumbnail()){ ?>
                    <div class="featured">
                        <?php the_post_thumbnail(get_the_ID(),'full'); ?>
                    </div>
                    <?php
                    }
                        the_content();
                    ?>
                    <?php wp_link_pages('before=<div class="unit-page-links page-links"><div class="page-link">&link_before=<span>&link_after=</span>&after=</div></div>'); 
                    do_action('wplms_after_every_unit',get_the_ID());
                    ?>
                    </div> 
                    <div class="tags">
                    <?php the_unit_tags('<ul><li>','</li><li>','</li></ul>'); ?>
                    </div>   
                    <?php
                      $attachments =& get_children( 'post_type=attachment&output=ARRAY_N&orderby=menu_order&order=ASC&post_parent='.$id);
                      if($attachments && count($attachments)){
                        $att= '';

                        $count=0;
                      foreach( $attachments as $attachmentsID => $attachmentsPost ){
                      
                      $type=get_post_mime_type($attachmentsID);

                      if($type != 'image/jpeg' && $type != 'image/png' && $type != 'image/gif'){
                          
                          if($type == 'application/zip')
                            $type='icon-compressed-zip-file';
                          else if($type == 'video/mpeg' || $type== 'video/mp4' || $type== 'video/quicktime')
                            $type='icon-movie-play-file-1';
                          else if($type == 'text/csv' || $type== 'text/plain' || $type== 'text/xml')
                            $type='icon-document-file-1';
                          else if($type == 'audio/mp3' || $type== 'audio/ogg' || $type== 'audio/wmv')
                            $type='icon-music-file-1';
                          else if($type == 'application/pdf')
                            $type='icon-text-document';
                          else
                            $type='icon-file';

                          $count++;

                          $att .='<li><i class="'.$type.'"></i>'.wp_get_attachment_link($attachmentsID).'</li>';
                        }
                      }
                        if($count){
                          echo '<div class="unitattachments"><h4>'.__('Attachments','vibe').'<span><i class="icon-download-3"></i>'.$count.'</span></h4><ul id="attachments">';
                          echo $att;
                         echo '</ul></div>';
                        }
                      }

                      $forum=get_post_meta($id,'vibe_forum',true);
                      if(!empty($forum) && get_post_type($forum) == 'forum'){
                        echo '<div class="unitforum"><a href="'.get_permalink($forum).'">'.__('Have Questions ? Ask in the Unit Forums','vibe').'</a></div>';
                      }
                     ?>
                 </div>
                  <div class="side_comments"><a id="all_comments_link" data-href="<?php if(isset($unit_comments) && is_numeric($unit_comments)){echo get_permalink($unit_comments);} ?>"><?php _e('SEE ALL','vibe'); ?></a>
                    <ul class="main_comments">
                        <li class="hide">
                            <div class="note">
                            <?php
                            $author_id = get_current_user_id();
                            echo get_avatar($author_id).' <a href="'.bp_core_get_user_domain($author_id).'" class="unit_comment_author"> '.bp_core_get_user_displayname( $author_id) .'</a>';
                            
                            $link = vibe_get_option('unit_comments');
                            if(isset($link) && is_numeric($link))
                                $link = get_permalink($link);
                            else
                                $link = '#';
                            ?>
                            <div class="unit_comment_content"></div>
                            <ul class="actions">
                                <li><a class="tip edit_unit_comment" title="<?php _e('Edit','vibe'); ?>"><i class="icon-pen-alt2"></i></a></li>
                                <li><a class="tip public_unit_comment" title="<?php _e('Make Public','vibe'); ?>"><i class="icon-fontawesome-webfont-3"></i></a></li>
                                <li><a class="tip private_unit_comment" title="<?php _e('Make Private','vibe'); ?>"><i class="icon-fontawesome-webfont-4"></i></a></li>
                                <li><a class="tip reply_unit_comment" title="<?php _e('Reply','vibe'); ?>"><i class="icon-curved-arrow"></i></a></li>
                                <li><a class="tip instructor_reply_unit_comment" title="<?php _e('Request Instructor reply','vibe'); ?>"><i class="icon-forward-2"></i></a></li>
                                <li><a data-href="<?php echo $link; ?>" class="popup_unit_comment" title="<?php _e('Open in Popup','vibe'); ?>" target="_blank"><i class="icon-windows-2"></i></a></li>
                                <li><a class="tip remove_unit_comment" title="<?php _e('Remove','vibe'); ?>"><i class="icon-cross"></i></a></li>
                            </ul>
                            </div>
                        </li>
                    </ul>

                    <a class="add-comment"><?php _e('Add a note','vibe');?></a>
                    <div class="comment-form">
                        <?php
                        echo get_avatar($author_id); echo ' <span>'.__('YOU','vibe').'</span>';
                        ?>
                        <article class="live-edit" data-model="article" data-id="1" data-url="/articles">
                            <div class="new_side_comment" data-editable="true" data-name="content" data-text-options="true">
                            <?php _e('Add your Comment','vibe'); ?>
                            </div>
                        </article>
                        <ul class="actions">
                            <li><a class="post_unit_comment tip" title="<?php _e('Post','vibe'); ?>"><i class="icon-fontawesome-webfont-4"></i></a></li>
                            <li><a class="remove_side_comment tip" title="<?php _e('Remove','vibe'); ?>"><i class="icon-cross"></i></a></li>
                        </ul>
                    </div>       
                </div>
                </div>
                <?php

                endwhile;
                endif;
                ?>
                <?php
                if(isset($unit_comments) && is_numeric($unit_comments)){
                    echo "<script>jQuery(document).ready(function($){ $('.unit_content').trigger('load_comments'); });</script>
                    <style>.note.user$post->post_author img{border: 2px solid #70c989;}</style><div class='unit_prevnext'>&nbsp;</div>";
                }
                wp_nonce_field('security','hash');
                do_action('wplms_unit_end_front_end_controls');
                ?>
            </div>
            <div class="col-md-3 col-sm-4">
                <?php
                global $wp_query;
                if(isset($_GET['edit']) || isset($wp_query->query_vars['edit'])){
                    do_action('wplms_front_end_unit_controls');
                }else{
                    $sidebar = apply_filters('wplms_sidebar','coursesidebar',get_the_ID());
                    if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar($sidebar) ) {}
                }
                ?>
            </div>
        </div>
    </div>
</section>
<?php
get_footer(vibe_get_footer());