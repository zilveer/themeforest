<div class="bebel_widget_socialize">
    <h2><?php echo $values['title'] ?></h2>
    <ul class="socialize_icon_list">
    <?php 

    $icons = simpleUtils::getSocialIconList();

    foreach($icons as $icon): 
        if(!empty($values['social_icon_'.$icon]) && BebelUtils::isValidUrl($values['social_icon_'.$icon])):
    ?>
        <li>
            <a href="<?php echo $values['social_icon_'.$icon] ?>" title="<?php echo ucfirst($icon) ?>" class="social_<?php echo $icon ?>"></a>
        </li>

    <?php 

        endif; 
    endforeach; ?>
    </ul>
    <br class="clear" />
</div>