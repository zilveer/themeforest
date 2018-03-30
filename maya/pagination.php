                    <?php if(function_exists('yiw_pagination')) : yiw_pagination(); else : ?> 
            
                        <div class="navigation group">
                            <div class="alignleft"><?php next_posts_link(__('Next &raquo;', 'yiw')) ?></div>
                            <div class="alignright"><?php previous_posts_link(__('&laquo; Back', 'yiw')) ?></div>
                        </div>
                    
                    <?php endif; ?>  