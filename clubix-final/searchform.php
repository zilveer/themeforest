<form action="<?php echo home_url( '/' ); ?>" class="navbar-form navbar-right clearfix" role="search" method="get">

    <div class="form-group">

        <input name="s" id="s" type="text" class="form-control" placeholder="<?php _e('Search...', LANGUAGE_ZONE); ?>" value="">

        <?php if ( defined('ICL_LANGUAGE_CODE') ) : ?>
            <input type="hidden" name="lang" value="<?php echo(ICL_LANGUAGE_CODE); ?>" />
        <?php endif; ?>

    </div>
    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>


</form>