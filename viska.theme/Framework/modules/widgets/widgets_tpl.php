<!--
Author: wiloke
Author Uri: wiloke.com
date: 04/252014
time:11:34 pm
-->

<form id="awe_form" method="POST" action="">
    <div id="md-framewp" class="md-framewp">
        <div id="md-framewp-header">

            <!-- /////////////////// ALERT BOX ///////////////// -->
            <div class="md-alert-boxs">
                <?php echo $this->messages; ?>
            </div>
        </div>
        <!-- /#md-framewp-header -->
        <div id="md-framewp-body" class="md-tabs">  
           

                <!-- /////////////////// MD UI COMPONENT ///////////////// -->

                <div id="md-tabs-framewp" class="md-tabs-framewp">
                    <ul class="clearfix">
                        <li><a href="#md-widget"><?php _e('Widgets', self::LANG); ?></a></li>
                        <span class="add-tabs"><i class="icon-add-tabs"></i></span>
                    </ul>
                </div>
                <!-- /.md-tabs-framewp -->

                <div class="md-content-framewp">
                    <div id="md-widget" class="md-tabcontent clearfix">
                        <div class="md-content-main">

                            <div class="md-tabcontent-header">
                                <h3 class="md-tabcontent-title"><?php _e('Enable/Disable', self::LANG) ?></h3>

                                <p class="md-tabcontent-description"><?php _e('Each widget item is enable will display on', self::LANG) ?> <a
                                        href="<?php echo admin_url('widgets.php') ?>/widgets.php" target="_blank">Widget</a> page </p>
                            </div>


                            <div id="home-setting" class="md-main-home">
                                <?php 
                                    if ( is_array($this->aDefaults) ) 
                                    {
                                       
                                        foreach ($this->aDefaults  as $k => $v) :
                                            if ( !in_array($k, (array)$this->KillIt) ) : //disbale widget
                                            $title =   ucfirst(str_replace(array("_","-"), array(" "," "), $k));
                                            if (isset($this->aWidgetValues[$k]))
                                            {
                                                $v = $this->aWidgetValues[$k];
                                            }
                                            ?>
                                            <div class="md-tabcontent-row has-column" data-title="<?php echo $title; ?>">
                                                <div class="md-row-description">
                                                    <h4 class="md-row-title"><?php echo WO_THEMENAME  . ' '; ?> <?php echo $title; ?> </h4>
                                                </div>
                                                <div class="md-row-element">
                                                    <!-- if ( (  in_array($k, $this->aWidgetValues) && (empty($this->aWidgetValues[$k])) )  || (!in_array($k, $this->aWidgetValues) && $v  == 0 ) ){ echo 'disabled';} -->
                                                    <div class="md-switch-option on-off   <?php  if (empty($v)){echo 'disabled';} ?>">
                                                        <label class="click-enable" data-id="switch-off">
                                                            <span>ON</span>
                                                        </label>
                                                        <label class="click-disable" data-id="switch-on">
                                                            <span>OFF</span>
                                                        </label>
                                                        <input class="input-checkbox" type="checkbox" value="1"
                                                               name="widgets[<?php echo $k ?>]" <?php checked($v, 1); ?>>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php 
                                            endif;
                                        endforeach;
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            
        </div>

        <div id="md-framewp-footer" class="md-framewp-footer">
            <div class="footer-left">
                <p class="md-copyright">Designed and Developed by <a href="http://awethemes.com/">AweThemes</a></p>
            </div>

            <div class="footer-right">
                <div class="md-button-group">
                    <input type="submit" value="Reset" name="reset-widgets" class="btn btn-reset">
                    <input type="submit" value="Save" name="save-widgets" class="btn btn-save">
                </div>
            </div>
        </div>
    <!-- /#md-framewp-footer -->
    </div>
    <!-- /.md-framewp -->
</form>

<div id="save-alert">
<i class="dashicons dashicons-update"></i>
</div>