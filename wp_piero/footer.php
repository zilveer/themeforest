<?php global $smof_data; ?>
        <?php if($smof_data['bottom_1_widgets'] == '1'){ ?>
        <?php
        /** data parallax */
        $bottom_parallax = '';
        $bottom_class = '';
        if($smof_data['bottom_1_bg_parallax'] && !empty($smof_data['background-bottom']['media'])){
            $bottom_parallax = " data-stellar-background-ratio='0.6' data-background-width='{$smof_data['background-bottom']['media']['width']}' data-background-height='{$smof_data['background-bottom']['media']['height']}'";
            $bottom_class = ' stripe-parallax-bg';
        } 
        ?>
        <div id="cs-bottom-wrap" class="clearfix<?php echo esc_attr($bottom_class); ?>"> 
            <div class="container">
                <div class="row">
                    <div id="bottom-top" class="bottom-top clearfix">
                    <?php for ($i = 1 ; $i <= (int)$smof_data['bottom_1_widgets_columns']; $i++):?>
                        <div class='bottom-top-<?php echo $i; ?> <?php echo esc_attr($smof_data['bottom_1_widgets_'.$i.'']);?>'>
                        <?php dynamic_sidebar("cshero-bottom-widget-$i"); ?>
                        </div>
                    <?php endfor;?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
		<?php cshero_footer(); ?>
		</div>
        <!--Meny-->
        <?php
        if($smof_data['enable_hidden_sidebar']){
            ?>
            <div class="control" style="position:fixed;top:100px;left:0;z-index:99999999;">
            </div>
            <div class="meny-sidebar">
                <div class="control">
                    <span class="cs_close right"><i class="ion-ios7-close-empty"></i></span>
                </div>
                <?php dynamic_sidebar('cshero-widget-hidden-menu');?>
            </div>
            <?php
        }
        ?>
		<?php if($smof_data['footer_to_top'] == '1'): ?>
		<a id="back_to_top" class="back_to_top">
			<span class="go_up">
				<i style="" class="fa fa-arrow-up"></i>
			</span></a>
		<?php endif; ?>
		<?php wp_footer(); ?>
	</body>
</html>