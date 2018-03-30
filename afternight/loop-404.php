<article <?php post_class() ?>>
    <footer class="entry-footer">
        <div class="excerpt">
            <?php
                if( is_search () ){
                    _e( 'Unfortunately we did not find any results for your request.' , 'cosmotheme' );
                }else{
                    _e( 'We apologize but this page, post or resource does not exist or can not be found. Perhaps it is necessary to change the call method to this page, post or resource.' , 'cosmotheme' );
                }

                wp_link_pages();
            ?>
        </div>
    </footer>
</article>

