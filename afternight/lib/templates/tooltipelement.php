<div class="element-container">
	<input type="hidden" name="tooltips[places][<?php echo $this -> place;?>][elements][<?php echo $this -> id;?>][id]" value="<?php echo $this -> id;?>" class="element-id">
	<div class="on-overview">
        <div class="demo-tooltip tooltip-element">
            <span class="arrow top">&nbsp;</span>
            <header class="demo-steps">
                <strong class="fl has-hidden-input">
                    <span class="dblclickable-text"><?php echo $this -> title;?></span>
                    <input class="hidden-input hidden" value="<?php echo $this -> title;?>">
                </strong>
                <div class="sort-zone fr">&nbsp;</div>
            </header>
            <div class="demo-content has-hidden-input">
                <span class="dblclickable-text"><?php echo $this -> description_overview;?></span>
                <textarea name="tooltips[places][<?php echo $this -> place;?>][elements][<?php echo $this -> id;?>][description_overview]" class="hidden-input hidden"><?php echo $this -> description_overview;?></textarea>
            </div>
            <footer class="demo-buttons">
                <p class="fl button-small gray edit"><a class="next" href="javascript:void(0);"><?php echo __( 'Edit position' , 'cosmotheme' );?></a></p>
                <p class="fr button-small blue delete"><a class="skip" href="javascript:void(0);"><?php echo __( 'Delete' , 'cosmotheme' );?></a></p>
            </footer>
        </div>
		<div class="undo-container undo">
			<?php echo __( 'If you change your mind, you have' , 'cosmotheme' );?> <span class="countdown">5</span> <?php echo __( 'seconds to' , 'cosmotheme' );?> <a href="javascript:void(0);" class="undo"><?php echo __( 'Undo' , 'cosmotheme' );?></a>.
		</div>
	</div>
	<div class="on-edit">
        <div class="demo-tooltip tooltip-element">
            <span class="arrow <?php echo $this -> arrow;?>" title="<?php _e('Click on this arrow to change the possition','cosmotheme'); ?>" >&nbsp;</span>
            <input class="hidden arrow-position" name="tooltips[places][<?php echo $this -> place;?>][elements][<?php echo $this -> id;?>][arrow]" value="<?php echo $this -> arrow;?>">
            <header class="demo-steps">
                <strong class="fl has-hidden-input">
                    <span class="dblclickable-text"><?php echo $this -> title;?></span>
                    <input class="hidden-input hidden" name="tooltips[places][<?php echo $this -> place;?>][elements][<?php echo $this -> id;?>][title]" value="<?php echo $this -> title;?>">
                </strong>
                <div class="sort-zone fr">&nbsp;</div>
            </header>
            <div class="demo-content has-hidden-input">
                <span class="dblclickable-text"><?php echo $this -> description;?></span>
                <textarea name="tooltips[places][<?php echo $this -> place;?>][elements][<?php echo $this -> id;?>][description]" class="hidden-input hidden"><?php echo $this -> description;?></textarea>
            </div>
            <footer class="demo-buttons">
                <a class="has-popup fl fine-tuning" href="javascript:void(0);">
                    <span class="pos pos-x"><?php echo $this -> x;?></span><input name="tooltips[places][<?php echo $this -> place;?>][elements][<?php echo $this -> id;?>][x]" class="pos pos-x hidden" value="<?php echo $this -> x;?>"> x <span class="pos pos-y"><?php echo $this -> y;?></span><input name="tooltips[places][<?php echo $this -> place;?>][elements][<?php echo $this -> id;?>][y]" class="pos pos-y hidden" value="<?php echo $this -> y;?>">
                    <div class="popup">
                        <?php echo __( 'Double click to edit.', 'cosmotheme' );?><br>
                        <div class="maybe-pointer"></div>
                    </div>
                </a>
                <p class="fr button-small gray apply"><a class="skip" href="#"><?php echo __( 'Save' , 'cosmotheme' );?></a></p>
            </footer>
        </div>
	</div>
</div>