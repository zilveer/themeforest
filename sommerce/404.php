<?php      
/**
 * @package WordPress
 * @subpackage Beauty & Clean
 * @since 1.0
 */

get_header() ?>           
         
    <div class="p404 group">   
        <h1><strong>404</strong> <?php _e('error', 'yiw') ?></h1>
        <h3><?php _e('Page not found', 'yiw') ?> <img src="<?php echo get_template_directory_uri() ?>/images/icons/search.png" alt="<?php _e('Page not found', 'yiw') ?>" /></h3>    
    
        <p>
            <?php _e('We are sorry but the page you are looking for does not exist.', 'yiw') ?><br/>
            <?php printf( __('You could return to the <a href="%s">homepage</a> or search using the search box below.', 'yiw'), home_url() ) ?>
        </p>

        <!-- START SEARCH -->
        <form method="get" id="searchform" action="<?php echo home_url(); ?>/">
            <fieldset>
                <input type="text" name="s" id="s" value="<?php the_search_query(); ?>" />
                <input type="submit" id="searchsubmit" value="<?php _e('GO', 'yiw') ?>" />
            </fieldset>
        </form>
        <!-- END SEARCH -->
    </div>
    
<?php get_footer() ?>
