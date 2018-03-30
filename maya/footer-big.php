<?php global $layout_page_type; ?>
<div id="footer" class="<?php if($layout_page_type) echo $layout_page_type; else echo yiw_layout_page() ?>">
    <?php for( $i = 1; $i <= yiw_get_option( 'footer_rows', 1 ); $i++ ) : ?>
    <div class="group inner footer_row_<?php echo $i ?> footer_cols_<?php echo yiw_get_option( 'footer_columns', 1 ) ?>">            
                <?php dynamic_sidebar( "Footer Row $i" ) ?>
    </div>
    <?php endfor; ?>         
</div>
