<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
$titles = explode('^', $instance['acc_titles']);
$bodies = explode('^', $instance['acc_bodies']);
?>
<div class="widget widget_accordion">
    <?php if (!empty($instance['title'])): ?>
        <h3 class="widget-title"><?php echo esc_html($instance['title']); ?></h3>
    <?php endif; ?>
    <?php if (!empty($titles)){ ?>
        <ul class="accordion">
            <?php foreach($titles as $key => $title){ ?>
                <li class="accordion-navigation">
                    <a href="#" class="acc-trigger" data-mode=""><?php echo esc_html($title); ?></a>
                    <div class="content">
                       <?php echo wp_kses($bodies[$key], 'default'); ?>
                    </div>
                </li>
            <?php } ?>
        </ul>
    <?php
    } ?>
</div><!--/ .widget-container-->

