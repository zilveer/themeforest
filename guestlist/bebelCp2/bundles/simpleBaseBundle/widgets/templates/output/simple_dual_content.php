          <!-- widget split content begin -->
          <div class="bebel_widget_split_content">
            <div class="grid_6 prefix_1 ">
              <h2>
                <?php if(!empty($values['link_left'])): ?>
                  <a href="<?php echo $values['link_left'] ?>"><?php echo $values['title_left'] ?></a>
                <?php else: ?>
                  <?php echo $values['title_left'] ?>
                <?php endif ?>
              </h2>
              <div class="text"><?php echo $values['text_left'] ?></div>
              <a href="<?php echo $values['link_left'] ?>" class="readmore_main"><?php _e('more', $this->settings->getPrefix()) ?></a>
            </div>
            <div class="grid_6 prefix_1 right">
              <h2>
                <?php if(!empty($values['link_right'])): ?>
                  <a href="<?php echo $values['link_right'] ?>"><?php echo $values['title_right'] ?></a>
                <?php else: ?>
                  <?php echo $values['title_right'] ?>
                <?php endif ?>
              </h2>
              <div class="text"><?php echo $values['text_right'] ?></div>
              <a href="<?php echo $values['link_right'] ?>" class="readmore_main"><?php _e('more', $this->settings->getPrefix()) ?></a>
            </div><br class="clear" />
          </div>
          <!-- widget split content end -->