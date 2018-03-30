<?php if(!$vertical): ?>
    
    <?php if($show_title): ?>
        <div class="cshero-progress-title">
            <<?php echo $title_size; ?> class="title" <?php echo $title_style; ?>><?php if($icon){?><i style="color:<?php echo $icon_color;?>;font-size:<?php echo $icon_size;?>;" class="<?php echo $icon; ?>"></i><?php }?><?php echo $title; ?><?php
                if($show_value){
                    echo '<span class="right">'.$value.$label_value.'</span>';
                } ?>
            </<?php echo $title_size; ?>>
        </div>
    <?php endif; ?>
    <div class="progress<?php if($vertical){ echo ' vertical bottom'; } ?><?php if($striped == true){ echo ' progress-striped'; if($animated){ echo ' active'; } } ?><?php if($right){ echo " pright"; } ?>" <?php echo $style; ?>>
        <div id="cshero-progress-item-<?php echo $progressbar_callback; ?>" class="progress-bar" role="progressbar" data-valuetransitiongoal="<?php echo $value; ?>" style="background-color: <?php echo $color; ?>;">
            
        </div>
    </div>

    <?php if($desc): ?>
        <div class="cshero-progress-desc">
            <span <?php echo $desc_style; ?>><em><?php echo esc_attr($desc); ?></em></span>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php if($vertical): ?>

    <div class="progress<?php if($vertical){ echo ' vertical bottom'; } ?><?php if($striped == true){ echo ' progress-striped'; if($animated){ echo ' active'; } } ?><?php if($right){ echo " pright"; } ?>" <?php echo $style; ?>>
        <div id="cshero-progress-item-<?php echo $progressbar_callback; ?>" class="progress-bar" role="progressbar" data-valuetransitiongoal="<?php echo $value; ?>" style="background-color: <?php echo $color; ?>;">
            <span>
                <?php
                if($show_value){
                    echo $value.$label_value;
                }?>
            </span>
            <?php if($show_title): ?>
                <div class="cshero-progress-title vertical">
                    <?php
                        foreach (str_split($title) as $char){
                            echo '<span '.$title_style.'>'.$char.'</span>';
                        }
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if($icon): ?>
        <div class="cshero-progress-icon vertical">
            <i style="color:<?php echo $icon_color;?>;font-size:<?php echo $icon_size;?>;" class="<?php echo $icon; ?>"></i>
        </div>
    <?php endif; ?>

    <?php if($desc): ?>
        <div class="cshero-progress-desc vertical">
            <span <?php echo $desc_style; ?>><em><?php echo esc_attr($desc); ?></em></span>
        </div>
    <?php endif; ?>

<?php endif; ?>