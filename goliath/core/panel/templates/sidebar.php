<?php
global $_SETTINGS;
$head = $_SETTINGS->admin_head;
?>
    <!-- BEGIN .sidebar -->
    <div class="sidebar">
        <div class="logo">
            <img src="<?php echo PLSH_ADMIN_ASSET_URL; ?>images/logo-1.png" alt="Planetshine Control Panel" />
        </div>
        <?php

            if(!empty($head))
            {   
                $view = plsh_get($_GET, 'view', $head[key($head)]['slug']);   //get view; defaults to first element of header
                $section = plsh_get($_GET, 'section', 'ads_manager');   //get section; defaults to ads_manager (no other section use this)

                echo '<ul class="menu">';

                foreach($head as $h)
                {
                     echo '<li class="' . $h['slug'];
                     if($view == $h['slug']) echo ' active';
                     echo '">';

                     if($h['type'] == 'plsh_visual_editor')
                     {
                        echo '<a href="' . $h['link'] . '"><i class="fa fa-' . $h['icon'] . '"></i>' . $h['name'] . '</a>';
                     }
                     else
                     {
                        echo '<a href="' . get_admin_url() . 'admin.php?page=' . plsh_gs('theme_slug') . '-admin' . '&view=' . $h['slug'] . '"><i class="fa fa-' . $h['icon'] . '"></i>' . $h['name'] . '</a>';
                     }

                     if(!empty($h['children']))
                     {
                         //determine the amount of levels
                         $has_multiple_levels = false;
                         foreach($h['children'] as $ch)
                         {
                             if(!empty($ch['children'])) //if there are sub levels
                             {
                                 $has_multiple_levels = true;
                             }
                         }
                         
                         //output menu items
                         if($has_multiple_levels)
                         {
                            foreach($h['children'] as $ch)
                            {
                                $class = '';
                                $link = get_admin_url() . 'admin.php?page=' . plsh_gs('theme_slug') . '-admin' . '&view=' . $h['slug'] . '&section=' . $ch['slug'];
                                $class = 'has-children';
                                if($view == $h['slug'] && $section == $ch['slug'])
                                {
                                    $class = ' active';
                                }

                                echo '<ul class="multi-level ' . $class . '">';
                                    echo '<li><a href="' . $link . '"><i class="fa fa-caret-right"></i><i class="fa fa-caret-down"></i>' . $ch['name'] . '</a></li>';

                                    foreach($ch['children'] as $ch_ch)
                                    {
                                        echo '<li><a href="' . $link . '#' . $ch_ch['slug'] . '"><span>•</span>' . $ch_ch['name'] . '</a></li>';
                                    }

                                echo '</ul>';
                            }
                         }
                         else
                         {
                            echo '<ul>';
                            foreach($h['children'] as $ch)
                            {
                                $class = '';
                                $link = '#' . $ch['slug'];
                            
                                echo '<li class="' . $class . '"><a href="' . $link . '"><span>•</span>' . $ch['name'] . '</a>';
                            }
                            echo '</ul>';
                         }

                     }

                     echo '</li>';
                }

                echo '</ul>';
            }
        ?>
    <!-- END .sidebar -->
    </div>