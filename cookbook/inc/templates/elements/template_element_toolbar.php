<?php
    
    // GET OPTIONS
    $canon_options_frame = get_option('canon_options_frame');

?>

                                    <ul class="header_toolbar">
                                        
                                        <?php if ($canon_options_frame['toolbar_search_button'] == "checked") { echo '<li class="toolbar-search-btn"><em class="fa fa-search"></em></li>'; } ?>

                                    </ul>
