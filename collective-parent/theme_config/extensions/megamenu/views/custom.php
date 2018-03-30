<?php
$item = $settings['item_settings'];

$children = $settings['children'];

if(!empty($children)): ?>
    <div class="widget_container widget_links <?php echo $settings['tf_megamenu_column']; ?>">
        <h3 class="widget_title"><?php echo $item['item_title']; ?></h3>
        <ul class="<?php echo $settings['tf_megamenu_list']; ?>">
            <?php foreach ($children as $child) :
                $target = $class = $class_style = '';
                if(!empty($child['classes'])) $class = implode(' ',$child['classes']);
                if($class != '') $class_style = 'class="'.$class.'"';
                if($child['target'] != '') $target = 'target="'.$child['target'].'"';
            ?>
                <li class="menu-level-2">
                    <a <?php echo $target; echo $class_style; ?> href="<?php echo $child['url'];?>">
                        <span><?php echo $child['title'];?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif;?>