                              <div class="call">
                              
                                  <h1 style="float: left"><?php echo get_option('icy_home_welcome'); ?></h1>

                                  <?php if (get_option('icy_enable_welcome_btn') == 'true') : ?>
                                      <?php $color = get_option('icy_enable_welcome_btn_color'); ?>
                                      <?php $text  = get_option('icy_enable_welcome_btn_text'); ?>
                                      <?php $link = get_option('icy_enable_welcome_btn_link'); ?>
                                      <a class="button <?php echo $color; ?>" style="float: right; margin-right: 0; margin-bottom: 5px" href="<?php echo $link; ?>">
                                        <?php if($text != '') { echo $text; } else {_e('Buy Now!', 'framework');} ?>
                                      </a>
                                  
                                  <?php endif; ?>
                              
                              </div>