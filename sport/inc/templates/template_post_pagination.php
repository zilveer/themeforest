<?php 

     $canon_options_post = get_option('canon_options_post');

     $prev_post = get_previous_post();
     $next_post = get_next_post();

     if (get_post_type() == "post") {
          if ($canon_options_post['post_nav_same_cat'] == "checked") {
               $prev_post = get_previous_post(true);
               $next_post = get_next_post(true);
          }
               
     }

     if (get_post_type() == "cpt_people") {
          if ($canon_options_post['person_nav_same_cat'] == "checked") {
               $prev_post = get_previous_post(true, '', 'people_category');
               $next_post = get_next_post(true, '', 'people_category');
          }
               
     }

?>


                                   <div class="paging clearfix">

                                        <?php

                                             if (!empty( $prev_post )): ?>

                                                  <div class="half prev">
                                                       <div class="meta"><?php _e("Prev post", "loc_canon"); ?></div>
                                                       <a href="<?php echo get_permalink( $prev_post->ID ); ?>"><h4><?php echo $prev_post->post_title; ?></h4></a>
                                                  </div>

     
                                             <?php else : ?>

                                                  <div class="half prev eol">
                                                       <div class="meta"><?php _e("End of line", "loc_canon"); ?></div>
                                                       <h4><?php _e("No more posts", "loc_canon"); ?></h4>
                                                  </div>

                                             <?php endif; ?>


                                        <?php

                                             if (!empty( $next_post )): ?>

                                                  <div class="half next last">
                                                       <div class="meta"><?php _e("Next post", "loc_canon"); ?></div>
                                                       <a href="<?php echo get_permalink( $next_post->ID ); ?>"><h4><?php echo $next_post->post_title; ?></h4></a>
                                                  </div>


                                             <?php else : ?>

                                                  <div class="half next last eol">
                                                       <div class="meta"><?php _e("End of line", "loc_canon"); ?></div>
                                                       <h4><?php _e("No more posts", "loc_canon"); ?></h4>
                                                  </div>

                                             <?php endif; ?>

                                   </div>