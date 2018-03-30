<?php if(!is_404()) : // Other normal pages ?>
    <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <span>
            <input type="text" name="s" placeholder="<?php echo esc_attr(__('Type and hit enter ...', 'uxbarn')); ?>" value="<?php echo trim( get_search_query() ); ?>" />
        </span>
	</form>

<?php else :  // Only on 404 template ?>
    
    <form id="form-404" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <div class="row collapse no-bg">
            <div class="uxb-col small-10 columns no-bg no-padding">
                <input type="text" name="s" placeholder="<?php echo esc_attr(__('Search ...', 'uxbarn')); ?>" value="<?php echo trim( get_search_query() ); ?>" />
            </div>
            <div class="uxb-col small-2 columns no-bg no-padding">
                <a href="javascript:;" class="flat button prefix" onclick="document.getElementById('form-404').submit();"><i class="fa fa-search"></i></a>
            </div>
        </div>
    </form>
    
<?php endif; ?>