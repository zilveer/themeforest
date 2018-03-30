                            <!-- SIDEBAR WIDGET AREA -->
                            <aside class="right-aside fourth last">

                                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("canon_blog_sidebar_widget_area")) : ?>  
                                    
                                    <h4><?php _e("Blog / Category Sidebar Widget Area", "loc_canon"); ?></h4>
                                    <p><i><?php _e("Please login and add some widgets to this widget area.", "loc_canon"); ?></i></p> 

                                <?php endif; ?>  
                                    
                            </aside> 
                            <!-- end sidebar -->
