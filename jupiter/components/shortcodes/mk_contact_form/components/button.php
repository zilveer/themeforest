<div class="mk-form-row" style="float:left;">
    <button class="<?php echo $view_params['button_class']; ?>" data-style="move-up" tabindex="<?php echo $view_params['tab_index']; ?>">
        <span class="mk-progress-button-content">
            <?php 
            	if(!empty($view_params['button_text'])) {
            	
            		_e($view_params['button_text'], 'mk_framework' );
            	
            	} else {

            		_e( 'Submit', 'mk_framework' );

            	}
            ?>
        </span>
        <span class="mk-progress">
            <span class="mk-progress-inner"></span>
        </span>

        <span class="state-success">
            <?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-moon-checkmark', 16); ?>
        </span>

        <span class="state-error">
            <?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-moon-close', 16); ?>
        </span>

    </button>
</div>
