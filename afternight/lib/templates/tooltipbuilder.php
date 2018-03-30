<div id="frontpage_builder">
	<div id="invisible-fixed-point"></div>
	<div id="the-closet">
		<?php
			$template = new TooltipPlace( array(
                    'elements' => array(
                        '_id_' => array(
                            'id' => '_id_'
                        )
                    )
                )
            );
			$template -> render_backend();
		?>
	</div>

	<div id="add_to_frontpage" class="add_fpb fpb button">
		<a href="javascript:void(0);" class="fpb_icon">&nbsp;</a>
		<a href="javascript:void(0);" class="fpb_label">
			<?php echo __( 'Add a tooltip on frontpage' , 'cosmotheme' );?>
		</a>
	</div>
    <div id="add_to_post" class="add_fpb fpb button">
        <a href="javascript:void(0);" class="fpb_icon">&nbsp;</a>
        <a href="javascript:void(0);" class="fpb_label">
            <?php echo __( 'Add a tooltip on a post' , 'cosmotheme' );?>
        </a>
    </div>
    <div id="add_to_page" class="add_fpb fpb button">
        <a href="javascript:void(0);" class="fpb_icon">&nbsp;</a>
        <a href="javascript:void(0);" class="fpb_label">
            <?php echo __( 'Add a tooltip on a page' , 'cosmotheme' );?>
        </a>
    </div>

	<div id="elements-container">
		<?php
			foreach( $this -> places as $place ){
                $place -> render_backend();
			}
		?>
	</div>

    <div class="pages taxonomies fly-left">
        <div class="search-holder">
            <input class="search">
            <a href="javascript:void(0);" class="clear-input" title="<?php echo __( 'Clear input' , 'cosmotheme' );?>"></a>
        </div>
        <div class="content">
            <?php echo $this -> list_pages();?>
        </div>
    </div>

    <div class="posts taxonomies fly-left">
        <div class="search-holder">
            <input type="hidden" name="" class="generic-record generic-value" value="" />
            <input type="hidden" class="generic-params" value="%7B%22post_type%22%3A%22post%22%2C%22post_status%22%3A%22publish%22%7D" />
            <input class="search generic-record-search" value="" onchange="javascript:act.search( this , '-');">
            <a href="javascript:void(0);" class="clear-input" title="<?php echo __( 'Clear input' , 'cosmotheme' );?>"></a>
        </div>
        <div class="content">
            <?php echo $this -> list_posts();?>
        </div>
    </div>

    <?php 
        $view_port_width = options::get_value( 'styling' , 'viewport_width' );

    ?>
    <div id="tooltip-builder-iframe" style="width:<?php echo $view_port_width; ?>">
        <iframe></iframe>
        <div class="filler"></div>
        <div id="fake-container"></div>
    </div>
</div>