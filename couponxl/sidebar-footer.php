<?php if( is_active_sidebar( 'sidebar-bottom-1' ) || is_active_sidebar( 'sidebar-bottom-2' ) || is_active_sidebar( 'sidebar-bottom-3' )): ?>
    <section class="widget-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <?php 
                    if( is_active_sidebar( 'sidebar-bottom-1' ) ){
                        dynamic_sidebar( 'sidebar-bottom-1' );
                    }
                    ?>                

                </div>

                <div class="col-sm-4">
                    <?php 
                    if( is_active_sidebar( 'sidebar-bottom-2' ) ){
                        dynamic_sidebar( 'sidebar-bottom-2' );
                    }
                    ?>                

                </div>
                <div class="col-sm-4">
                    <?php 
                    if( is_active_sidebar( 'sidebar-bottom-3' ) ){
                        dynamic_sidebar( 'sidebar-bottom-3' );
                    }
                    ?>                

                </div>                
            </div>
        </div>
    </section>
<?php endif; ?>