<li class="control-section accordion-section top" id="yit-<?php echo $model ?>-<?php echo $type ?>">
    <h3 class="accordion-section-title hndle" title="<?php echo $type ?>"><?php echo $label ?>
        <span class="spinner"></span></h3>

    <div class="accordion-section-content" style="display: none;" data-module="<?php echo $model ?>" data-type="<?php echo $type ?>">
        <div class="inside">
            <div id="<?php echo $model ?>-<?php echo $type ?>" class="posttypediv">
                <?php if ( $type != 'post_format' ) : ?>
                    <div class="all">
                        <a href="#" data-model="<?php echo $model ?>" data-type="<?php echo $type ?>" data-id="all"><?php echo ( $model != 'site' ) ? $label_all : __( 'All pages', 'yit' ) ?></a>
                    </div>
                <?php endif ?>
                <?php if ( $type == 'page' && isset( $static_pages ) ) : ?>
                    <div class="static-pages">
                        <?php foreach ( $static_pages as $id_page => $static_page ): ?>
                        <div class="<?php echo $id_page ?>">
                            <a href="#" data-model="<?php echo $model ?>" data-type="<?php echo $type ?>" data-id="<?php echo $id_page ?>"><?php echo $static_page ?></a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif ?>

                <ul id="<?php echo $model ?>-<?php echo $type ?>-tabs" class="add-menu-item-tabs">
                    <?php
                    $i = 0;
                    foreach ( $tabs as $tab_name => $tab ): ?>
                        <li <?php echo ( $i ++ == 0 ) ? 'class="tabs"' : ''  ?>>
                            <a class="nav-tab-link" data-type="tabs-panel-<?php echo $model ?>-<?php echo $type ?>-<?php echo $tab_name ?>" href="#"><?php echo $tab['title'] ?></a>
                        </li>
                    <?php endforeach ?>
                </ul>

                <?php
                if ( ! empty( $tabs ) ):
                    $i = 0;
                    foreach ( $tabs as $tab_name => $tab ):
                        if ( $tab_name != 'search' ):
                            ?>
                            <div id="tabs-panel-<?php echo $model ?>-<?php echo $type ?>-<?php echo $tab_name ?>" class="tabs-panel tabs-panel-<?php echo ( $i ++ == 0 ) ? 'active' : 'inactive' ?>">

                                <ul id="<?php echo $type ?>checklist-<?php echo $tab_name ?>" class="categorychecklist form-no-clear">
                                    <?php if ( isset( $tab['paginate'] ) ) {
                                        echo '<li class="paginate">' . $tab['paginate'] . '</li>';
                                    }  ?>
                                    <?php if ( $tab['content'] ):
                                        foreach ( $tab['content'] as $key => $content ):
                                            if ( $model == 'post_type' ) {
                                                $title = $content->post_title;
                                                $id    = $content->ID;
                                            }
                                            elseif ( $model == 'taxonomy' ) {
                                                $title = $content->name;
                                                $id    = $content->term_id;
                                            }
                                            else {
                                                $title = $content;
                                                $id    = $key;
                                            }
                                            ?>
                                            <li>
                                                <a href="#" data-model="<?php echo $model ?>" data-type="<?php echo $type ?>" data-id="<?php echo $id ?>"><?php echo $title ?></a>
                                            </li>
                                        <?php
                                        endforeach;
                                    else: ?>
                                        <p><?php _e( 'No items', 'yit' ) ?></p>
                                    <?php endif; ?>
                                </ul>
                            </div>

                        <?php endif;
                    endforeach;
                else:
                    ?>
                    <?php echo ( $model != 'site' ) ? ' <p>' . __( 'No items.', 'yit' ) . '</p>' : '' ?>
                <?php endif; ?>
                <?php if ( isset( $tabs['search'] ) ): ?>
                    <div id="tabs-panel-<?php echo $model ?>-<?php echo $type ?>-search" class="tabs-panel tabs-panel-inactive">
                        <p class="quick-search-wrap">
                            <input type="search" class="yit-quick-search-<?php echo $model ?> quick-search input-with-default-title " title="<?php esc_attr_e( 'Search', 'yit' ) ?>" value="" name="yit-quick-search-<?php echo esc_attr( $model ) ?>-<?php echo esc_attr( $type ) ?>" id="yit-quick-search-<?php echo esc_attr( $model ) ?>-<?php echo esc_attr( $type ) ?>" autocomplete="off">
                            <span class="spinner"></span>
                            <input type="submit" name="submit" id="submit-quick-search-<?php echo esc_attr( $model ) ?>-<?php echo esc_attr( $type ) ?>" class="button button-small quick-search-submit hide-if-js" value="<?php esc_attr_e( 'Search', 'yit' ) ?>">

                        <div class="clearfix"></div>
                        </p>
                        <ul id="<?php echo esc_attr( $type ) ?>-search-checklist" data-wp-lists="list:<?php echo esc_attr( $type ) ?>" class="categorychecklist form-no-clear">
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</li>