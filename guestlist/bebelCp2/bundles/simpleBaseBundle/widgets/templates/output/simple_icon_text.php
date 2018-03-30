          <!-- widget icon_text start -->
          <div class="bebel_widget_icon_text">
            <h2>
                <?php echo $values['title'] ?>
            </h2>
            <div class="text">
              <?php echo $values['text'] ?>
            </div>
              
              <?php if(!empty($values['link'])): ?>
                <a href="<?php echo $values['link'] ?>" class="readmore_small"><?php echo __('more', $this->settings->getPrefix()) ?></a>
              <?php endif; ?>
          </div>
          <!-- widget icon_text end -->