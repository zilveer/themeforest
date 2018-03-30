<?php
if(plsh_pagination_exists())
{
?>
    <!-- Pages -->
    <div class="pages">
        <ul class="pagination">
            <?php
                $pages = plsh_get_pagination();
                foreach($pages as $page)
                {
                    echo '<li>' . $page . '</li>';
                }
                
                if(plsh_get_current_page_num() == plsh_get_max_pages())
                {
                    echo '<li class="next"><a href="#" class="next disabled"><i class="fa fa-angle-right"></i></a></li>';
                }
                else
                {
                    echo '<li class="next"><a href="' . esc_url(plsh_get_next_page_link()) . '" class="next"><i class="fa fa-angle-right"></i></a></li>';
                }

                if(plsh_get_current_page_num() == 1)
                {
                    echo '<li class="previous"><a href="#"><i class="fa fa-angle-left"></i></a></li>';
                }
                else
                {
                    echo '<li class="previous"><a href="' . esc_url(plsh_get_prev_page_link()) . '"><i class="fa fa-angle-left"></i></a></li>';
                }
            ?>
        </ul>
    </div>
<?php 
}
?>