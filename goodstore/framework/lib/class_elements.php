<?php

/**
 * Library of HTML elements. Use only in admin area
 * 
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 */
if (!class_exists('jwElements')) {

    class jwElements {

        public static $_layout = 'options';
        private static $_instance = null;
        private static $_search_title = '';

        static function setLayout($layout = 'options') {
            self::$_layout = $layout;
        }

        public static function getInstance() {
            if (self::$_instance == null) {
                self::$_instance = new jwElements();
            }


            return self::$_instance;
        }

        static function defaults($value) {
            $defaults = array();
            if (isset($value['type']) && $value['type'] == 'multicheck') {
                if (is_array($value['std'])) {
                    foreach ($value['std'] as $key) {
                        $defaults[$value['id']][$key] = true;
                    }
                } else {
                    $defaults[$value['id']][$value['std']] = true;
                }
            } else if (isset($value['type']) && $value['type'] == 'range_measurement') {
                if (isset($value['id']) && isset($value['std']))
                    $defaults[$value['id']] = $value['std'];
                if (isset($value['id']) && isset($value['unit_std']))
                    $defaults[$value['id']['unit_std']] = $value['unit_std'];
            }else {
                if (isset($value['id']) && isset($value['std']))
                    $defaults[$value['id']] = $value['std'];
            }

            return $defaults;
        }

        /**
         * Validate options data
         *
         * @uses get_option()
         *
         * @access public
         * @since 1.0.0
         *
         * @return array
         */
        public static function elements_valitate($value, $data = null, $args = array()) {
            $error = "";

            if (!is_null($value['type']))
                switch ($value['type']) {

//   todo overeni u sidebaru bz m2lo byt unikatni id email, file, value
                }

            return array($value, $error);
        }

        public static function renderPages($options, $data) {
            $pages = '';
            foreach ($options as $opt) {
                if (isset($opt['id']) && isset($data[$opt['id']]))
                    $val = $data[$opt['id']];
                else
                    $val = null;
                if ($opt['type'] == 'layout') {
                    
                }

                $pages .= self::elements_machine($opt, $val);
            }

            return $pages;
        }

        public static function elements_render($elements, $data = null, $layout = 'default') {
            $out = '';
            foreach ($elements as $element) {
                $out .= self::elements_machine($element, $data, $layout);
            }
            return $out;
        }

        /*
         * Render element for taxonomies (Category option)
         * @param $value array
         * @param $data mixed
         * $param layout mixed (add or edit)
         */

        public static function render_metatax($value, $data = null, $layout = 'default') {

            $defaults = array();
            $menu = '';
            $output = '';



            $val = '';

            if (isset($value['type']) && !in_array($value['type'], array('headingstart', 'headingend'))) {
                $class = '';
                if (isset($value['class'])) {
                    $class = $value['class'];
                }
//hide items in checkbox group
                $fold = '';

                if (is_array($value) && array_key_exists("fold", $value)) {
                    if (isset($data[$value['fold']])) {
                        $fold = "f_" . $value['fold'] . " ";
                    } else {
                        $fold = "f_" . $value['fold'] . " temphide ";
                    }
                }


//only show header if 'name' value exists

                if ($value['name']) {
                    switch ($layout) {
                        case 'edit':
                            $output .= '<tr class="form-field">';
                            $output .= '<th scope="row" valign="top"><label for="' . $value['id'] . '">' . $value['name'] . '</label></th>' . "\n";
                            $output .= '<td>';
                            $output .= '<div id="section-' . self::convert($value['id']) . '" class="' . $fold . 'section jw_option section-' . $value['type'] . ' ' . $class . '">' . "\n";
                            break;
                        default:
                            $output .= '<div id="section-' . self::convert($value['id']) . '" class="' . $fold . 'section jw_option section-' . $value['type'] . ' ' . $class . ' form-field">' . "\n";

                            $output .= '<h4 class="heading">' . $value['name'] . '</h4>' . "\n";
                            break;
                    }
                }

                if (isset($value['space']) && $value['space'])
                    $output .= '<div class="space">&nbsp;</div>';

                $output .= '<div class="option">' . "\n" . '<div class="controls">' . "\n";
            }
            $c = "element_" . $value['type'];
            if (method_exists(get_class(), $c)) {
                $output .= jwElements::$c($value, $data);
            } else {
                $output .= 'Element not found in class_elements.php';
            }


//description of each option
            if (isset($value['type']) && $value['type'] != "headingstart" && $value['type'] != "headingend") {

                if (!isset($value['desc'])) {
                    $explain_value = '';
                } else {
                    $explain_value = '<div class="explain">' . $value['desc'] . '</div>' . "\n";
                }

                $output .= '</div><!-- end controls -->' . $explain_value . "\n";

                $output .= '<div class="clear"></div>
                </div><!-- end options -->
                </div><!-- end section jw_option -->' . "\n";

                if ($layout == 'edit') {
                    $output .= '</div></td></tr>';
                }
            }






            return $output;
        }

        /**
         * Process options data and build option fields
         *
         * @uses get_option()
         *
         * @access public
         * @since 1.0.0
         *
         * @return array
         */
        public static function elements_machine($value, $data = null, $layout = 'default') {

            $defaults = array();
            $menu = '';
            $output = '';



            $val = '';


//Start Heading
            if (isset($value['type']) && $value['type'] != "headingstart" && $value['type'] != "headingend" && $value['type'] != "sectionstart" && $value['type'] != "sectionend") {

                $class = '';
                if (isset($value['class'])) {
                    $class = $value['class'];
                }
                if (!isset($value['ng-click'])) {
                    $value['ng-click'] = '';
                }
                if (!isset($value['ng-class'])) {
                    $value['ng-class'] = '';
                }

//hide items in checkbox group
                $fold = '';

                if (is_array($value) && array_key_exists("fold", $value)) {
                    if (isset($data[$value['fold']])) {
                        $fold = "f_" . $value['fold'] . " ";
                    } else {
                        $fold = "f_" . $value['fold'] . " temphide ";
                    }
                }
//Skutečnej button
                if (isset($value['mod']) && $value['mod'] == 'button') {
                    $output .= '<div class="show-settings element_button">';
                    $output .= '<h4 class="button ' . $value['id'] . '"  ng-click="' . $value['ng-click'] . '" ng-class="' . $value['ng-class'] . '">' . $value['name'] . '</h4>' . "\n";
                    $output .= '</div>';
                }
//only show header if 'name' value exists
                //$output .= apply_filters('jaw_before_each_option',$value['id']);
                if ($value['name']) {
                    switch ($layout) {
                        case 'template':
                            $output .= '<script id="section-' . self::convert($value['id']) . '" class="' . $fold . 'section jw_option section-' . $value['type'] . ' ' . $class . '" type="text/ng-template">' . "\n";
                        case 'metabox':
                            $output .= '<div id="section-' . self::convert($value['id']) . '" class="' . $fold . 'section jw_option section-' . $value['type'] . ' ' . $class . '">' . "\n";

                            $click = '';
                            if (isset($value['mod']) && $value['mod'] == 'button') {
                                $click = ' ng-click="' . $value['ng-click'] . '" ';
                            }
                            if (!isset($value['header']) || $value['header'] == true) {
                                $output .= '<h4 class="heading" ' . $click . '>' . $value['name'] . '</h4>' . "\n";
                            }
                            break;
                        case 'cat':

                            $output .= '<tr class="form-field">';
                            $output .= '<th scope="row" valign="top"><label for="' . $value['id'] . '">' . $value['name'] . '</label></th>' . "\n";
                            $output .= '<td>';
                            $output .= '<div id="section-' . self::convert($value['id']) . '" class="' . $fold . 'section jw_option section-' . $value['type'] . ' ' . $class . '">' . "\n";

                            break;
                        case 'builder_dropdown':
                        case 'builder':
                            $output .= '<div id="section-' . self::convert($value['id']) . '" class="' . $fold . 'section jw_option section-' . $value['type'] . ' ' . $class . '">' . "\n";
                            break;
                        case 'default':
                        default:
                            $output .= '<div id="section-' . self::convert($value['id']) . '" class="' . $fold . 'section jw_option section-' . $value['type'] . ' ' . $class . '" >' . "\n";
                            $output .= '<h3 class="heading">' . $value['name'] . '</h3>' . "\n";
                            break;
                    }
                    if (!isset($value['type']) || $value['type'] != 'builder') {
                        if (isset($value['space']) && $value['space'])
                            $output .= '<div class="space">&nbsp;</div>';

                        $output .= '<div class="option">' . "\n" . '<div class="controls ';
                        if ($value['type'] == 'importpreset') {
                            $output .= 'control_fw';
                        }
                        $output .= '">' . "\n";
                    }
                }
            }

            $c = "element_" . $value['type'];
            if (method_exists(get_class(), $c)) {
                $output .= jwElements::$c($value, $data);
            } else {
                $output .= 'Element not found in class_elements.php';
            }


//description of each option
            if (isset($value['type']) && $value['type'] != "headingstart" && $value['type'] != "headingend" && $value['type'] != "sectionstart" && $value['type'] != "sectionend" && $value['type'] != 'builder') {
                if (!isset($value['desc']) || ($value['type'] == 'builder_dropdown')) {
                    $explain_value = '';
                } else {
                    if ($layout == 'cat') {
                        $explain_value = ' <p class="description">' . $value['desc'] . '</p>' . "\n";
                    } else {
                        $explain_value = '<div class="explain">' . $value['desc'] . '</div>' . "\n";
                    }
                }


                $output .= '</div><!-- end controls -->' . $explain_value . "\n";



                $output .= '<div class="clear"></div>
                </div><!-- end options -->
                </div><!-- end section jw_option -->' . "\n";

                switch ($layout) {
                    case 'template':
                        $output .= '</script><!-- end controls -->' . "\n";
                        break;
                    case 'cat':
                        $output .= '</div></td></tr>';
                        break;
                }
            } else if (isset($value['type']) && $value['type'] == 'builder') {
                $output .= '</div><!-- end section jw_option -->';
            }

            return $output;
        }

        private static function _box() {
            
        }

        private function _layout($part, $type) {
            
        }

        public static function element_headingstart($value, $data = null) {

            $output = '';
            $jquery_click_hook = str_replace(' ', '', strtolower($value['name']));
            $jquery_click_hook = "of-option-" . $jquery_click_hook;

            $output .= '<div class="group" id="' . $jquery_click_hook . '"><h2>' . $value['name'] . '</h2>' . "\n";

            return $output;
        }

        public static function element_headingend($value, $data = null) {
            return '</div>' . "\n";
        }

        public static function element_sectionstart($value, $data = null) {
            $output = '';
            $output .= '<div class="section sub_all" ><h3>' . $value['name'] . '</h3>';
            $output .= '<div class="section sub" >';
            return $output;
        }

        public static function element_sectionend($value, $data = null) {
            return '</div></div>';
        }

        public static function element_text($value, $data = null) {
            $output = '';
            $a_default = '';
            if (isset($data)) {
                if (is_array($data)) {
                    $data = implode(',', $data); // zpetna komatibilita - nektere metaboxy jsme predelali z multidropdownu na texty - kvuli naroscnosti na memory.
                }
                $evalue = $data;
            } else if (isset($value['std'])) {
                $evalue = $value['std'];
            } else {
                $evalue = '';
            }
            $evalue = str_replace('"', '&quot;', str_replace('\'', '&quot;', ((string) $evalue)));
            $a_default = 'init_edit(\'' . $value['id'] . '\',\'' . $evalue . '\');';
            $t_value = (string) $evalue;

            $class = '';
            if (isset($value['mod'])) {
                $class .= $value['mod'];
            }
            if (isset($value['class'])) {
                $class .= ' ' . $value['class'];
            }
            if (isset($value['maxlength'])) {
                $maxlength = 'maxlength=' . $value['maxlength'];
            } else {
                $maxlength = '';
            }
            if (!isset($value['type'])) {
                $value['type'] = 'text';
            }

            $output .= '<input class="of-input ' . $class . '" name="' . $value['id'] . '"  ' . $maxlength . ' id="' . self::convert($value['id']) . '" type="' . $value['type'] . '" value="' . $t_value . '" ng-model="edit[\'' . $value['id'] . '\']" ng-init="' . $a_default . '"/>';
            return $output;
        }

        public static function element_icon($value, $data = null) {
            $output = '';
            $a_default = '';
            if (isset($data)) {
                if (is_array($data)) {
                    $data = implode(',', $data); // zpetna komatibilita - nektere metaboxy jsme predelali z multidropdownu na texty - kvuli naroscnosti na memory.
                }
                $evalue = $data;
            } else if (isset($value['std'])) {
                $evalue = $value['std'];
            } else {
                $evalue = '';
            }
            $evalue = str_replace('"', '&quot;', str_replace('\'', '&quot;', ((string) $evalue)));
            $a_default = 'init_edit(\'' . $value['id'] . '\',\'' . $evalue . '\');';
            $t_value = (string) $evalue;

            $class = '';
            if (isset($value['mod'])) {
                $class .= $value['mod'];
            }
            if (isset($value['class'])) {
                $class .= ' ' . $value['class'];
            }
            if (isset($value['maxlength'])) {
                $maxlength = 'maxlength=' . $value['maxlength'];
            } else {
                $maxlength = '';
            }
            if (!isset($value['type'])) {
                $value['type'] = 'text';
            }
            $output .= '<div class="show-icon" ><i class="{{edit[\'' . $value['id'] . '\']}}"></i></div>';
            $output .= '<input class="show-icon-input of-input ' . $class . '" name="' . $value['id'] . '"  ' . $maxlength . ' id="' . self::convert($value['id']) . '" type="' . $value['type'] . '" value="' . $t_value . '" ng-model="edit[\'' . $value['id'] . '\']" ng-init="' . $a_default . '"/>';
            return $output;
        }

        public static function element_list($value, $data = null) {
            $output = '';

            if (isset($data))
                $evalue = $data;
            else if (isset($value['std']))
                $evalue = $value['std'];
            else
                $evalue = '';
            $t_value = '';
            $t_value = stripslashes((string) $evalue);

            if (isset($value['mod'])) {
                $mod = $value['mod'];
            } else {
                $mod = 'text';
            }


            $output .= '<input type="hidden" ng-init="init_object(\'' . $value['id'] . '\')" />';
            $output .= '<div class="list-li ' . $mod . '" ng-repeat="(ied, ed) in edit.' . $value['id'] . '">';
            if ($mod == 'text') {
                $output .= '<input class="of-input" name="' . $value['id'] . '" id="' . self::convert($value['id']) . '" type="text" value="' . $t_value . '"  ng-model="ed[\'' . $value['id'] . '\']" />';
            } else {
                $output .= '<textarea class="of-input" name="' . $value['id'] . '" id="' . self::convert($value['id']) . '" type="text"   ng-model="ed[\'' . $value['id'] . '\']" >' . $t_value . '</textarea>';
            }
            $output .= '<button type="button" class="list_delete_button button-primary builder red jaw" ng-click="del_edit(\'' . $value['id'] . '\',ied)" ><i class="icon-white icon-remove"></i></button>';
            $output .= '</div>';
            $output .= '<a href="#" class="button-primary blue jaw add-list" ng-click="add_edit(\'' . $value['id'] . '\');"><i class="icon-white icon-plus"></i></a>';
            return $output;
        }

        public static function element_advanced_list($value, $data = null) {
            $output = '';

            if (isset($data))
                $evalue = $data;
            else if (isset($value['std']))
                $evalue = $value['std'];
            else
                $evalue = '';
            $t_value = '';
            $t_value = stripslashes((string) $evalue);

            $output .= '<div class="show-icon" ><i class="{{icon}}"></i></div>';
            $output .= '<input class="show-icon-input of-input" name="' . $value['id'] . '-icon" placeholder="badge-change-of-icon-class" id="' . self::convert($value['id']) . '-icon" type="text"  ng-model="icon" ng-change="badgeList(icon,edit.' . $value['id'] . ')" />';

            $output .= '<input type="hidden" ng-init="init_object(\'' . $value['id'] . '\')" />';
            $output .= '<div class="list-li-container" ui-sortable="listSortableOptions" ng-model="edit.' . $value['id'] . '">';
            $output .= '<div ng-repeat="(ied, ed) in edit.' . $value['id'] . '">';
            $output .= '<tg-dynamic-directive ng-model="ed" tg-dynamic-directive-view="getView" tg-dynamic-directive-level="0" ></tg-dynamic-directive>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '<div class="clear"></div>';
            $output .= '<a href="#" class="button-primary blue jaw add-list" ng-click="add_edit(\'' . $value['id'] . '\');"><i class="icon-white icon-plus"></i></a>';


            $output .= '<script type="text/ng-template" id="list_item.html">';
            $output .= '<div class="list-li-adv " >';
            $output .= '<div class="list-handle"><i class="icon-arrow4"></i></div>';
            $output .= '<div class="show-icon" ><i class="{{ngModelItem.bullet}}"></i></div>';
            $output .= '<input class="of-input show-icon-input list-bullet-input" placeholder="icon-class" name="bullet" id="' . self::convert($value['id']) . '-bullet" type="text"   ng-change="badgeList(ngModelItem.bullet,ngModelItem.items)" ng-init="ngModelItem.bullet = ngModelItem.bullet || icon; ngModelItem.items = ngModelItem.items || []; ngModelItem[\'' . $value['id'] . '\'] = ngModelItem[\'' . $value['id'] . '\'] || \'\'  " ng-model="ngModelItem.bullet" />';
            $output .= '<input class="of-input list-text" placeholder="Some text" name="' . $value['id'] . '" id="' . self::convert($value['id']) . '" type="text"   ng-model="ngModelItem[\'' . $value['id'] . '\']" />';
            //$output .= '<button type="button" class="list_delete_button button-primary builder rngModelItem jaw"  ><i class="icon-white icon-remove"></i></button>';
            $output .= '<div class="clear"></div>';
            $output .= '</div>';
            $output .= '<div ng-show="viewNextLevel" class="list-li-container list-li-adv-inner" ui-sortable="listSortableOptions" ng-model="ngModelItem.items">';
            $output .= '<div ng-repeat="(iied, inner) in ngModelItem.items">';
            $output .= '<tg-dynamic-directive ng-model="inner" tg-dynamic-directive-view="getView" tg-dynamic-directive-level="tgDynamicDirectiveLevel"></tg-dynamic-directive>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '<div class="clear"></div>';
            $output .= '</script>';

            return $output;
        }
        
        
        public static function element_grid_content($value, $data = null) {
            $output = '';

            if (isset($data))
                $evalue = $data;
            else if (isset($value['std']))
                $evalue = $value['std'];
            else
                $evalue = '';

           
            $output .= '<input type="hidden" ng-init="init_object(\'' . $value['id'] . '\')" />';
            $output .= '<div class="jw-grid-container" ui-sortable="listSortableOptions" ng-model="edit.' . $value['id'] . '">';
            $output .= '<div ng-repeat="(ied, ed) in edit.' . $value['id'] . '">';
            
            $output .= '<div class="list-li-adv " >';
            $output .= '<div class="list-handle"><i class="icon-arrow4"></i></div>';
            
            $output .= '<div class="jw-grid-content">';
            
            $output .= "<label>Background image</label>";
            $output .= '<div simplemediapicker ng-model="ed.img" multiple="false"></div>';

            $output .= '<label>Link URL</label><input class="of-input list-text" placeholder="http://"  type="text" ng-model="ed.link" />';
            $output .= '<label>Title</label><input class="of-input list-text" placeholder="Title"  type="text" ng-model="ed.title" />';
            $output .= '<label>Description (html)</label><textarea class="of-input list-text"  ng-model="ed.content" ></textarea>';
            
            $output .= '<button type="button" class="list_delete_button button-primary builder rngModelItem jaw" ng-click="del_edit(\''.$value['id'].'\', ied)" ><i class="icon-white icon-remove"></i></button>';     
            
            $output .= '<div class="clear"></div>';
            $output .= '</div>';
            $output .= '</div>';
            
            
            $output .= '</div>';
            $output .= '</div>';
            $output .= '<div class="clear"></div>';
            $output .= '<a href="#" class="button-primary blue jaw add-list" ng-click="add_edit(\'' . $value['id'] . '\');"><i class="icon-white icon-plus"></i></a>';


            

            return $output;
        }

        public static function element_circle_chart($value, $data = null) {
            $output = '';

            if (isset($data))
                $evalue = $data;
            else if (isset($value['std']))
                $evalue = $value['std'];
            else
                $evalue = '';
            $t_value = '';
            $t_value = stripslashes((string) $evalue);


            $output .= '<input type="hidden" ng-init="init_object(\'' . $value['id'] . '\')" />';
            $output .= '<div class="chart-li section-color" ng-repeat="(ied, ed) in edit.' . $value['id'] . '">';
            $output .= '<input class="of-input"   type="text" value="' . $t_value . '"  ng-model="ed[\'title\']" placeholder="Item Name" />';
            $output .= '<input class="of-input"   type="text" value="' . $t_value . '"  ng-model="ed[\'value\']" placeholder="Value" />';
            $output .= '<div class="input-append color" data-color="rgb(128, 0, 0)" >';
            $output .= '<input type="text" colorpicker ng-model="ed[\'color\']" value="{{ed[\'color\']}}" />';
            $output .= '<span class="add-on"><i ng-style="getColor(ed[\'color\'])"></i></span>';
            $output .= '</div>';
            $output .= '<button type="button" class="chart_delete_button button-primary builder red jaw" ng-click="del_edit(\'' . $value['id'] . '\',ied)" ><i class="icon-white icon-remove"></i></button>';
            $output .= '</div>';
            $output .= '<a href="#" class="button-primary blue jaw add-list" ng-click="add_edit(\'' . $value['id'] . '\');"><i class="icon-white icon-plus"></i></a>';
            return $output;
        }

        public static function element_pricing_table($value, $data = null) {
            $output = '';

            $output .= '<input type="hidden" ng-init="init_object(\'' . $value['id'] . '\')" />';
            $output .= '<div class="chart-li" ng-repeat="(ied, ed) in edit.' . $value['id'] . '">';
            $output .= '<input class="of-input"   type="text"   ng-model="ed[\'title\']" placeholder="Name" />';
            $output .= '<input class="of-input"   type="text"   ng-model="ed[\'price\']" placeholder="Price (e.g. $9.99)" />';
            $output .= '<textarea class="of-input"   type="text"   ng-model="ed[\'details\']" placeholder="Details" ></textarea>';
            $output .= '<input class="of-input"   type="text"   ng-model="ed[\'btn-title\']" placeholder="Button" />';
            $output .= '<input class="of-input"   type="text"   ng-model="ed[\'btn-link\']" placeholder="Link" />';
            $output .= '<button type="button" class="chart_delete_button button-primary builder red jaw" ng-click="del_edit(\'' . $value['id'] . '\',ied)" ><i class="icon-white icon-remove"></i></button>';
            $output .= '</div>';
            $output .= '<a href="#" class="button-primary blue jaw add-list" ng-click="add_edit(\'' . $value['id'] . '\');"><i class="icon-white icon-plus"></i></a>';
            return $output;
        }

        public static function element_select($value, $data = null, $type = 'default') {
            $output = '';
            $a_default = '';
            if (isset($data)) {
                $evalue = $data;
            } else if (isset($value['std'])) {
                $evalue = $value['std'];
                $a_default = 'init_edit(\'' . $value['id'] . '\',\'' . $value['std'] . '\');';
            } else {
                $evalue = '';
            }
            if (!isset($value['mod'])) {
                $mini = '';
            } else {
                $mini = $value['mod'];
            }
            if (!isset($value['options'])) {
                $value['options'] = '';
            }
            $output .= '<div class="select_wrapper ' . $mini . '">';
            $angular = '';
            if (isset($value['builder']) && $value['builder'] == 'true') {
                $output .= '<span>{{options[\'' . $value['id'] . '\'][edit[\'' . $value['id'] . '\']]}}</span>';
                $angular .= 'ng-model="edit[\'' . $value['id'] . '\']" ng-init="options[\'' . $value['id'] . '\'] = ' . str_replace('"', "'", json_encode($value['options'])) . '; ' . $a_default . '"';
            }
            $output .= '<select class="select of-input" name="' . $value['id'] . '" id="' . self::convert($value['id']) . '"  ' . $angular . '>';
            if (isset($value['options']) && count($value['options']) > 0)
                foreach ((array) $value['options'] as $select_ID => $option) {
                    $output .= '<option id="' . $select_ID . '" value="' . $select_ID . '" ' . selected($evalue, $select_ID, false) . ' >' . $option . '</option>';
                }
            $output .= '</select></div>';
            return $output;
        }

        public static function element_textarea($value, $data = null) {
            $output = '';

            if (isset($data)) {
                $evalue = $data;
            } else if (isset($value['std'])) {
                $evalue = $value['std'];
            } else {
                $evalue = '';
            }
            $a_default = 'init_edit(\'' . $value['id'] . '\',(\'' . addslashes(str_replace('"', '\'', $evalue)) . '\'));';

            $cols = '20';
            $rows = '4';
            $class = '';

            if (isset($value['cols'])) {
                $cols = $value['cols'];
            }
            if (isset($value['rows'])) {
                $rows = $value['rows'];
            }

            if (isset($value['style'])) {
                $class = $value['style'];
            }


            $ta_value = stripslashes($evalue);
            $output .= '<textarea class="of-input wp-editor-area ' . $class . '" name="' . $value['id'] . '" id="' . self::convert($value['id']) . '" cols="' . $cols . '" rows="' . $rows . '" ng-init="' . $a_default . '" ng-model="edit[\'' . $value['id'] . '\']" value="{{edit[\'' . $value['id'] . '\']}}">' . $ta_value . '</textarea>';
            return $output;
        }

        public static function element_tinymce_editor($value, $data = null) {
            $output = '';

            if (isset($data)) {
                $evalue = $data;
            } else if (isset($value['std'])) {
                $evalue = $value['std'];
            } else {
                $evalue = '';
            }
            $a_default = 'init_edit(\'' . $value['id'] . '\',\'' . addslashes(str_replace('"', '\'', $evalue)) . '\');';

            $ta_value = stripslashes($evalue);
            $output .= '<a title="Add Media" data-editor="' . $value['id'] . '" class="button insert-media jaw_add_media" id="insert-media-button" href="#"><span class="wp-media-buttons-icon"></span> Add Media</a>';

            $output .= '<div class = "tinymce-tabs">';
            $output .= '<a class="html ' . $value['id'] . '">HTML</a>';
            $output .= '<a class="visual ' . $value['id'] . '" class="active">Visual</a>';
            $output .= ' <div style="clear: both;"></div>';
            $output .= '</div> ';
            $output .= '<textarea ng-init="' . $a_default . '" id="' . $value['id'] . '" class="jaw-editor-area" name="' . $value['id'] . '" cols="40" rows="20" ng-model="edit[\'' . $value['id'] . '\']"/></textarea>';

            return $output;
        }

        public static function element_upload($value, $data = null) {
            $output = '';

            if (isset($data))
                $evalue = $data;
            else
                $evalue = '';

            if (!isset($value['mod'])) {
                $value['mod'] = '';
            }



            $output .= jwElements::elements_uploader_function($value['id'], $value['std'], $value['mod'], $evalue);


            return $output;
        }

        public static function element_media($value, $data = null) {
            $output = '';

            if (isset($data))
                $evalue = $data;
            else if (isset($value['std']))
                $evalue = $value['std'];
            else
                $evalue = '';
            $_id = strip_tags(strtolower($value['id']));
            $int = '';
            $int = jwElements::elements_mlu_get_silentpost($_id);
            if (!isset($value['mod']))
                $value['mod'] = '';
            $output .= jwElements::elements_media_uploader_function($value['id'], $value['std'], $int, $value['mod'], $evalue); // New AJAX Uploader using Media Library			


            return $output;
        }

        public static function element_google_address($value, $data = null) {
            $output = '';
            $output .= '<div id="google-map-' . $value['id'] . '">';
            $output .= '<textarea id="address-' . $value['id'] . '" ng-model="edit[\'' . $value['id'] . '\']" value="{{edit[\'' . $value['id'] . '\']}}"  name="' . $value['id'] . '">{{edit[\'' . $value['id'] . '\']}}</textarea>';
            $output .= '<div data-id="' . $value['id'] . '" class="button convert_to_gps">Convert to GPS <i class="icon-arrow-down3"></i></div>';
            $output .= '</div>';
            return $output;
        }

        public static function element_media_picker($value, $data = null) {
            $output = '';

            if (isset($data)) {
                $evalue = $data;
            } else if (isset($value['std'])) {
                $evalue = $value['std'];
            } else {
                $evalue = '';
            }
            $a_default = 'init_edit(\'' . $value['id'] . '\',json_decode(\'' . addslashes(str_replace('"', '\'', $evalue)) . '\'));';
            $_id = strip_tags(strtolower($value['id']));
            if (!isset($value['mod']))
                $value['mod'] = '';

            $output .= '<span ng-init="' . $a_default . '" ></span>';
            $output .= '<div gallerypicker ng-model="edit[\'' . $value['id'] . '\']" name="' . $value['id'] . '"></div>';

            return $output;
        }

        public static function element_simple_media_picker($value, $data = null) {
            $output = '';

            if (isset($data)) {
                $evalue = $data;
            } else if (isset($value['std'])) {
                $evalue = $value['std'];
            } else {
                $evalue = '';
            }
            $a_default = 'init_edit(\'' . $value['id'] . '\',json_decode(\'' . addslashes(str_replace('"', '\'', $evalue)) . '\'));';
            $_id = strip_tags(strtolower($value['id']));
            if (!isset($value['mod'])) {
                $value['mod'] = '';
            }
            $multiple = '';
            if (isset($value['multiple']) && $value['multiple']) {
                $multiple = 'multiple="' . $value['multiple'] . '"';
            }

            $output .= '<span ng-init="' . $a_default . '" ></span>';
            $output .= '<div simplemediapicker ng-model="edit[\'' . $value['id'] . '\']" name="' . $value['id'] . '" ' . $multiple . ' mod="' . $value['mod'] . '"></div>';


            return $output;
        }

        public static function media_view_settings($settings, $post) {
            if (!is_object($post))
                return $settings;

            // Create our own shortcode string here
            $shortcode = get_post_meta($post->ID, '_portfolio_test', true); //'[gallery ids="1528, 1512, 1439, 1417, 1511, 1448, 1416" ]';

            $settings['jaw_mediapicker'] = array('shortcode' => $shortcode);
            return $settings;
        }

        public static function element_color($value, $data = null) {
            $output = '';
            $a_default = '';
            if (isset($data)) {
                $evalue = $data;
            } else if (isset($value['std'])) {
                $evalue = $value['std'];
            } else {
                $evalue = '';
            }
            $a_default = 'init_edit(\'' . $value['id'] . '\',\'' . $evalue . '\');';
            if (isset($value['format'])) {
                $format = $value['format'];
            } else {
                $format = 'hex';
            }
            $output .= '<div class="input-append color" data-color="rgb(0, 0, 0)"  ng-init="' . $a_default . '" >';
            $output .= '<input type="text" colorpicker="' . $format . '" ng-model="edit[\'' . $value['id'] . '\']" value="{{edit[\'' . $value['id'] . '\']}}"  name="' . $value['id'] . '"/>';
            $output .= '<span class="add-on"><i ng-style="getColor(edit[\'' . $value['id'] . '\'])"></i></span>';
            $output .= '</div>';
            return $output;
        }

        public static function element_typography($value, $data = null) {
            $output = '';

            if (isset($data))
                $evalue = $data;
            else if (isset($value['std']))
                $evalue = $value['std'];
            else
                $evalue = '';
            $typography_stored = $evalue;
            /* Font Size */

            if (isset($value['mod'])) {
                $mod = $value['mod'];
            } else {
                $mod = '';
            }

            if (isset($typography_stored['size'])) {
                $output .= '<div class="select_wrapper typography-size" original-title="Font size">';
                $output .= '<select class="of-typography of-typography-size select" name="' . $value['id'] . '[size]" id="' . $value['id'] . '_size">';
                for ($i = 9; $i < 30; $i++) {
                    $test = $i . 'px';
                    $output .= '<option value="' . $i . 'px" ' . selected($typography_stored['size'], $test, false) . '>' . $i . 'px</option>';
                }

                $output .= '</select></div>';
            }

            /* Line Height */
            if (isset($typography_stored['height'])) {

                $output .= '<div class="select_wrapper typography-height" original-title="Line height">';
                $output .= '<select class="of-typography of-typography-height select" name="' . $value['id'] . '[height]" id="' . $value['id'] . '_height">';
                for ($i = 20; $i < 38; $i++) {
                    $test = $i . 'px';
                    $output .= '<option value="' . $i . 'px" ' . selected($typography_stored['height'], $test, false) . '>' . $i . 'px</option>';
                }

                $output .= '</select></div>';
            }

            /* Font Face */
            if (isset($typography_stored['face'])) {

                $output .= '<div class="typography-face" original-title="Font family">';
                $output .= '<input class=" of-typography of-typography-face" name="' . $value['id'] . '[face]" id="' . $value['id'] . '_face" type="text" value="' . $typography_stored['face'] . '" />';

                $output .= '</div>';
            }

            /* Font Weight */
            if ($mod == 'big') {
                if (isset($typography_stored['style'])) {
                    $output .= '<div class="select_wrapper typography-style" original-title="Font style">';
                    $output .= '<select class="of-typography of-typography-style select" name="' . $value['id'] . '[style]" id="' . $value['id'] . '_style">';
                    $styles = array(
                        'normal' => 'Normal',
                        'italic' => 'Italic',
                        'bold' => 'Bold',
                        'bold italic' => 'Bold Italic'
                    );
                    foreach ($styles as $i => $style) {

                        $output .= '<option value="' . $i . '" ' . selected($typography_stored['style'], $i, false) . '>' . $style . '</option>';
                    }
                    $output .= '</select></div>';
                }
            }

            /* Font Color */
            if ($mod == 'big') {
                if (isset($typography_stored['color'])) {
                    $output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector typography-color"><div style="background-color: ' . $typography_stored['color'] . '"></div></div>';
                    $output .= '<input class="of-color of-typography of-typography-color" original-title="Font color" name="' . $value['id'] . '[color]" id="' . $value['id'] . '_color" type="text" value="' . $typography_stored['color'] . '" />';
                }
            }


            return $output;
        }

        public static function element_info($value, $data = null) {
            $output = '';

            if (isset($value['message']))
                $message = $value['message'];
            else
                $message = '';

            $info_text = $value['text'];
            $output .= '<div class="of-info ' . $message . '">' . $info_text . '</div>';

            return $output;
        }

// only for metabox layout + sidebars_delect 
        public static function element_sidebar_select($value, $data = null) {
            $output = '';
            $sdbs = jwOpt::get_option('sidebars');

            if (isset($sdbs) && count($sdbs) > 0)
                foreach ((array) $sdbs as $k => $sdb) {
                    $value['options'][$k] = $sdb['name'];
                }
            $output = jwElements::element_select($value, $data);


            return $output;
        }

        public static function element_authors($value, $data = null) {
            $output = '';
            $sdbs = get_users();
            if (isset($sdbs) && count($sdbs) > 0) {
                foreach ((array) $sdbs as $k => $sdb) {
                    $value['options'][$sdb->data->ID] = $sdb->data->display_name;
                }
            }
            $output = jwElements::element_select($value, $data);


            return $output;
        }

        public static function element_sidebars($value, $data = null) {
            $output = '';

            if (isset($data))
                $evalue = $data;
            else if (isset($value['std']))
                $evalue = $value['std'];
            else
                $evalue = '';


            $output .= '<div class="sidebars">';
            $output .= '<input name="sidebar_name" id="sidebar_name" value="" /><a href="#" class="button sidebar_add_button">Add New Sidebar</a>';
            $output .= '<ul class="sidebras_list" id="' . $value['id'] . '">';
            $sidebars = $evalue;

            $count = count($sidebars);
            $i = 0;
            if (is_array($sidebars))
                foreach ($sidebars as $sidebar) {

                    $i++;
                    $order = $i;
                    $output .= jwElements::elements_sidebar_function($value['id'], $sidebar);
                }
            $output .= '</ul>';
            $output .= '</div>';

            return $output;
        }

        public static function jaw_add_sidebar() {
            if (isset($_POST['name']) && $_POST['name'] != '' && isset($_POST['id']) && $_POST['id'] != '') {

                $new_sidebar = array($_POST['name'] => array('name' => $_POST['name'], 'id' => $_POST['id'], 'desc' => ''));

                jwOpt::set_option('sidebars', array_merge(jwOpt::get_option('sidebars', array()), $new_sidebar));

                jwOpt::update_option(jwOpt::get_options());
            }
            die();
        }

        public static function element_layout_pb($value, $data = null) {
            $output = '';

            if (isset($data))
                $evalue = $data;
            else if (isset($value['std']))
                $evalue = $value['std'];
            else
                $evalue = '';
            $i = 0;
            foreach ($value['options'] as $key => $option) {
                $i++;

                $check = '';
                $checked = '';
                if (NULL != checked($evalue, $key, false)) {
                    $checked = checked($evalue, $key, false);
                    $check = 'check';
                }

                $output .= '<div ng-class="{layout_selected: current.layout == \'' . $key . '\'}" class="pb-settings radio-layout_pb" ng-click="change_layout(\'' . $key . '\')">';
                $output .= '<label val="' . $key . '"   for="' . $value['id'] . '-' . $key . '-sidebar">';
                $output .= '<img alt="page-option-sidebar-template" src="' . $option . '" />';
                $output .= '</label>';
                $output .= '</div>';
            }
            return $output;
        }

        public static function element_layout($value, $data = null) {
            $output = '';

            if (isset($data))
                $evalue = $data;
            else if (isset($value['std']))
                $evalue = $value['std'];
            else
                $evalue = '';
            $i = 0;

            $select_value = $evalue;
            if (isset($value['extend']) && !empty($value['extend'])) {
                $rel = ' rel="' . $value['extend'] . '"';
                $page = 'page_layout ';
            } else {
                $rel = '';
                $page = '';
            }
            if(isset($value["builder"]) && $value["builder"] == "true"){
                $output.='<span ng-init="init_edit(\'' . $value['id'] . '\',\'' . $evalue . '\');"></span>';
            }
            foreach ($value['options'] as $key => $option) {
                $i++;

                $check = '';
                $checked = '';
                $selected = '';
                if (NULL != checked($evalue, $key, false)) {
                    $checked = checked($evalue, $key, false);
                    $selected = 'of-radio-img-selected';
                    $check = 'check';
                }
                $ng_class = "";
                $ng_model = "";
                if(isset($value["builder"]) && $value["builder"] == "true"){
                    $ng_class = 'ng-class="{\'of-radio-img-selected\': edit[\'' . $value['id'] . '\'] == \'' . $key . '\'}"';
                    $ng_model = 'ng-model="edit[\'' . $value['id'] . '\']"';
                    $selected = "";
                }



                $output .= '<div class="radio-layout ' . $selected . '" '.$ng_class.'>';
                $output .= '<label val="' . $key . '" ' . $rel . '  for="' . $value['id'] . '-' . $key . '-sidebar">';
                $output .= '<img alt="page-option-sidebar-template" src="' . $option . '" />';
                $output .= '</label>';
                $output .= '<input autocomplete="off" type="radio" ' . $checked . ' id="' . $value['id'] . '-' . $key . '-sidebar" '.$ng_model.' value="' . $key . '" name="' . $value['id'] . '"> ';
                $output .= '</div>';
            }
            return $output;
        }

        public static function element_tabs($value, $data = null) {
            $output = '';

            if (isset($data))
                $evalue = $data;
            else if (isset($value['std']))
                $evalue = $value['std'];
            else
                $evalue = '';

            $_id = strip_tags(strtolower($value['id']));
            $int = '';
            $int = jwElements::elements_mlu_get_silentpost($_id);
            $output .= '<div class="slider"><ul id="' . $value['id'] . '" rel="' . $int . '" ng-init="init_object(\'' . $value['id'] . '\')" >';
            $slides = $evalue;
            $count = count($slides);
            if ($count < 2) {
                $oldorder = 1;
                $order = 1;
                $output .= jwElements::elements_tabs_function($value['id'], $value['std'], $oldorder, $order, $int);
            } else {
                $i = 0;
                foreach ($slides as $slide) {
                    $oldorder = $slide['order'];
                    $i++;
                    $order = $i;
                    $output .= jwElements::elements_tabs_function($value['id'], $value['std'], $oldorder, $order, $int);
                }
            }
            $output .= '</ul>';
            $output .= '<a href="#" class="button tabs_add_button" ng-click="add_edit(\'' . $value['id'] . '\')" >Add New Slide</a></div>';

            return $output;
        }
        public static function jaw_locale_default(  $locale, $domain ) {
            return 'en_US';
        }
        public static function element_translation($value, $data = null) {
            $output = '';
            $translatings = get_translations_for_domain( 'jawtemplates' );
            if(sizeof($translatings->entries) == 0){
                add_filter( 'theme_locale', array('jwElements','jaw_locale_default'), 10, 2);
                jaw_language();
                $translatings = get_translations_for_domain( 'jawtemplates' );
            }
            if(sizeof($translatings->entries) == 0){
                $output .= '<div class="jw_option section-info ">
                            <div class="option">
                            <div class="controls ">
                            <div class="of-info warnings">Please re-upload new en_US.po and en_US.mo files into '.get_template_directory().'/languages/ folder</div></div>
                            <div class="clear"></div>
                            </div>
                            </div>';
            }
            foreach((array) $translatings->entries as $translate_key => $translate_entry){
                if(isset($data[$translate_key]['singular'])){
                    $singular = $data[$translate_key]['singular'];
                }else{
                    $singular = $translate_entry->singular;
                }
                if(isset($data[$translate_key]['plural'])){
                    $plural = $data[$translate_key]['plural'];
                }else{
                    $plural = $translate_entry->plural;
                }
                $output .= '<div class="jw-tranlation-item" >';
                $output .= '<label class="jw-tranlation-label">';
                $output .= $translate_key;
                $output .= '</label>';      
                $output .= '<div class="jw-tranlation-item-input jw-tranlation-singular" >';
                if($translate_entry->is_plural){
                    $output .= '<span class="jw-tranlation-item-subtitle">Singular:</span>';
                }
                $output .= '<input autocomplete="off" type="text" value="' . esc_html($singular) . '"  name="' . $value['id'] . '['.htmlentities($translate_key).'][singular]" > ';
                $output .= '</div>';     
                if($translate_entry->is_plural){
                    $output .= '<div class="jw-tranlation-item-input jw-tranlation-plural" >';
                    $output .= '<span class="jw-tranlation-item-subtitle">Plural:</span><input autocomplete="off" type="text" value="' . esc_html( $plural ) . '" name="' . $value['id'] . '['.htmlentities($translate_key).'][plural]"> ';
                    $output .= '</div>';
                }
                $output .= '</div>';  
            }
            return $output;
        }
        

        public static function element_tiles($value, $data = null) {
            $output = '';
            $a_default = '';

            if (isset($data)) {
                $evalue = $data;
            } else if (isset($value['std'])) {
                $evalue = $value['std'];
                $a_default = 'init_edit(\'' . $value['id'] . '\',\'' . $value['std'] . '\');';
            } else {
                $evalue = '';
            }

            $i = 0;
            $select_value = $evalue;

            if (isset($value['mod'])) {
                $mod = $value['mod'];
            } else {
                $mod = '';
            }
            if (isset($value['index']) && $value['index']) {
                $index = $value['index'];
            } else {
                $index = null;
            }
            if (isset($value['builder']) && $value['builder'] == 'true') {
                $output .='<div class="overflow">';
                $output .= '<input type="hidden" ng-init="' . $a_default . ' "  value="{{edit[\'' . $value['id'] . '\']}}"   ng-model="edit[\'' . $value['id'] . '\']" name="' . $value['id'] . '"  > ';


                foreach ($value['options'] as $key => $option) {
                    $i++;
                    if ($index) {
                        $v = $key;
                    } else {
                        $v = $option;
                    }
                    $checked = '';
                    if (NULL != checked($select_value, $v, false)) {
                        $checked = checked($select_value, $v, false);
                    }

                    $output .= '<span>';
                    $output .= '<div class="of-radio-tile-img  ' . $option . '" ng-class="{item_selected: edit[\'' . $value['id'] . '\'] == \'' . $key . '\'}" class="pb-settings radio-layout_pb" ng-click="edit[\'' . $value['id'] . '\'] = \'' . $key . '\'"></div>';
                    $output .= '</span>';
                }
                $output .='</div>';
            } else {

                $output .='<div class="' . $mod . '">';

                foreach ((array) $value['options'] as $key => $option) {
                    $i++;
                    if ($index) {
                        $v = $key;
                    } else {
                        $v = $option;
                    }
                    $data_js = array();
                    if (is_array($option)) {
                        $opt = $option['thumbnail'];
                        unset($option['thumbnail']);
                        foreach ((array) $option as $key => $option) {
                            $data_js[] = 'data-' . $key . '="' . $option . '"';
                        }
                    } else {
                        $opt = $option;
                    }
                    $checked = '';
                    $selected = '';
                    if (NULL != checked($select_value, $v, false)) {
                        $checked = checked($select_value, $v, false);
                        $selected = 'of-radio-tile-selected';
                    }
                    $output .= '<span>';
                    $output .= '<input type="radio" id="of-radio-tile-' . $value['id'] . $i . '" class="checkbox of-radio-tile-radio" value="' . $v . '" name="' . $value['id'] . '" ' . $checked . ' />';
                    $output .= '<div class="of-radio-tile-img ' . $selected . '" style="background: url(' . $opt . ') repeat scroll -5px rgba(0, 0, 0, 0)" onClick="document.getElementById(\'of-radio-tile-' . $value['id'] . $i . '\').checked = true; " ' . implode(' ', $data_js) . '></div>';
                    $output .= '</span>';
                }
                $output .='</div>';
            }


            return $output;
        }

        public static function element_backup($value, $data = null) {
            $output = '';


            $instructions = $value['desc'];
            $backup = jwOpt::get_backups();

            if (!isset($backup['backup_log'])) {
                $log = 'No backups yet';
            } else {
                $log = $backup['backup_log'];
            }

            $output .= '<div class="backup-box">';
            $output .= '<div class="instructions">' . $instructions . "\n";
            $output .= '<p><strong>Last Backup : <span class="backup-log">' . $log . '</span></strong></p></div>' . "\n";
            $output .= '<a href="#" id="of_backup_button" class="button" title="Backup Options">Backup Options</a>';
            $output .= '<a href="#" id="of_restore_button" class="button" title="Restore Options">Restore Options</a>';
            $output .= '</div>';

            return $output;
        }

        public static function element_gdrive($value, $data = null) {
            $output = '';

            $output .= "<script type='text/javascript'>
                        (function(w) {
                          if (!(w.gapi && w.gapi._pl)) {
                          var d = w.document;
                          var po = d.createElement('script'); po.type = 'text/javascript'; po.async = true;
                          po.src = 'https://apis.google.com/js/platform.js';
                          var s = d.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                        }})(window);
                      </script>";
            $output .= ' <div id="gdrive_container"><div class="g-savetodrive"   data-src="' . THEME_URI . '/opt_backup-' . get_current_blog_id() . '.txt' . '"   data-filename="' . get_bloginfo('name') . '-' . date("Y-m-d") . '.txt"   data-sitename="' . get_bloginfo('name') . '-' . date("Y-m-d") . '"></div></div>';

            return $output;
        }

        public static function element_button($value, $data = null) {
            $output = '';
            $ng_click = '';
            if (isset($value['ng-click'])) {
                $ng_click = $value['ng-click'];
            }

            $output .= '<div class="el_button">';
            $output .= '<a href="' . $value['href'] . '" target="' . $value['target'] . '" id="' . $value['id'] . 'element_button" ng-click="' . $ng_click . '" class="element_button" title="' . $value['title'] . '">' . $value['title'] . '</a>';
            $output .= '</div>';



            return $output;
        }

        public static function element_none($value, $data = null) {
            $output = '';
            return $output;
        }

        public static function element_importpreset($value, $data = null) {
            $output = '';
            $output .= '<div class="demoimport">';
            for ($i = 0; $i < sizeof($value['file']); $i++) {

                $output .= '<div class="demoimport_image">';
                $output .= '<a href="#" id="of_importdemodata_button"title="Import" file="' . $value['file'][$i] . '">';
                $output .= ' <img src="' . THEME_URI . '/demo/images/' . $value['img'][$i] . '"/>';
                $output .= '</a>';
                $output .= '</div>';
                $output .= '<div class="demoimport_desc">';
                if (isset($value['description'][$i])) {
                    $output .= $value['description'][$i];
                }
                $output .= '</div>';
                $output .= '<div class="clear"></div>';
            }
            $output .= '</div>';
            return $output;
        }

        public static function element_instagram($value, $data = null) {

            if (isset($data)) {
                $evalue = $data;
            } else if (isset($value['std'])) {
                $evalue = $value['std'];
            } else {
                $evalue = '';
            }
            $a_default = '';
            $output = '';
            if (jwOpt::get_option('i_client_id', '') != '' && jwOpt::get_option('i_client_secret', '') != '') {
                $output .= "<a href='https://api.instagram.com/oauth/authorize?client_id=" . jwOpt::get_option('i_client_id', '') . "&redirect_uri=" . SITE_URL . "/wp-admin/themes.php?page=optionsframework&response_type=code'>Get Instagram Access Token</a><div class='clear'></div>";
            } else {
                $output .= 'To make this option available, please set both the Client ID and Client Secret items above. Save and refresh this page (F5).';
            }

            if (isset($_GET['code'])) {

                $post = array(
                    'method' => 'POST',
                    'body' => array('grant_type' => "authorization_code",
                        'client_id' => jwOpt::get_option('i_client_id', ''),
                        'client_secret' => jwOpt::get_option('i_client_secret', ''),
                        'redirect_uri' => SITE_URL . "/wp-admin/themes.php?page=optionsframework",
                        'code' => $_GET['code']
                    )
                );

                $reponse = wp_remote_retrieve_body(wp_remote_request('https://api.instagram.com/oauth/access_token', $post));
                $instagram = json_decode($reponse);
            }
            if (isset($instagram) && isset($instagram->access_token)) {
                $evalue = $instagram->access_token;
            }
            if ($evalue != '') {
                $a_default = 'init_edit(\'' . $value['id'] . '\',\'' . $evalue . '\');';
                $output .= '<input class="of-input" name="' . $value['id'] . '"   id="' . self::convert($value['id']) . '" type="text" value="' . $evalue . '" ng-model="edit[\'' . $value['id'] . '\']" ng-init="' . $a_default . '"/>';
                $output .= 'The string before dot is your User ID (needed in the J&W - Social Widget).';
            }

            return $output;
        }
        
        public static function element_youtube($value, $data = null) {

            if (isset($data)) {
                $evalue = $data;
            } else if (isset($value['std'])) {
                $evalue = $value['std'];
            } else {
                $evalue = array();
            }
            $a_default = '';
            $output = '';
            if (jwOpt::get_option('y_client_id', '') != '' && jwOpt::get_option('y_client_secret', '') != '') {
                $output .= "<a href='https://accounts.google.com/o/oauth2/auth?client_id=".jwOpt::get_option('y_client_id', '')."&redirect_uri=" . SITE_URL ."/wp-admin/themes.php?page=optionsframework&scope=https://www.googleapis.com/auth/youtube&response_type=code&access_type=offline'>Get YouTube Access Token</a><div class='clear'></div>";
            } else {
                $output .= 'To make this option available, please set both the Client ID and Client Secret items above. Save and refresh this page (F5).';
            }
            if (isset($_GET['code'])) {
                $post = array(
                    'method' => 'POST',
                    'body' => array('grant_type' => "authorization_code",
                        'client_id' => jwOpt::get_option('y_client_id', ''),
                        'client_secret' => jwOpt::get_option('y_client_secret', ''),
                        'redirect_uri' => SITE_URL . "/wp-admin/themes.php?page=optionsframework",
                        'code' => $_GET['code']
                    )
                );
                $reponse = wp_remote_retrieve_body(wp_remote_request('https://accounts.google.com/o/oauth2/token', $post));
                $token_info = json_decode($reponse);
                if (isset($token_info->access_token)) {
                    $evalue['access_token'] = $token_info->access_token;
                }
                if(isset($token_info->refresh_token)){
                    $evalue['refresh_token'] = $token_info->refresh_token;
                    jwOpt::update_one_option($value['id'],$evalue);
                    wp_redirect(SITE_URL ."/wp-admin/themes.php?page=optionsframework");
                    exit();
                }else{
                    $output .= '<strong>Error: Cannot recieve refresh token.</strong><br>Please remove your application from <a href="https://security.google.com/settings/u/0/security/permissions" target="_blank">here</a><br>';
                }
                if(isset($token_info->error)){
                    $output .= '<strong>Error: '.$token_info->error . '</strong><br>';
                }
                if(isset($token_info->error_description)){
                    $output .= $token_info->error_description.'<br>';
                }
            } 
            if (!empty($evalue)) {
                if (isset($evalue['access_token'] )) {
                    $a_default = 'init_edit(\'' . $value['id'] . '_access_token\',\'' . $evalue['access_token'] . '\');';
                    $output .= '<input class="of-input" name="' . $value['id'] . '[access_token]"   id="' . self::convert($value['id']) . '_access_token" type="text" value="' . $evalue['access_token'] . '" ng-model="edit[\'' . $value['id'] . '_access_token\']" ng-init="' . $a_default . '"/><br>';
                }
                if (isset($evalue['refresh_token'] )) {
                    $a_default = 'init_edit(\'' . $value['id'] . '_refresh_token\',\'' . $evalue['refresh_token'] . '\');';
                    $output .= '<input class="of-input" name="' . $value['id'] . '[refresh_token]"   id="' . self::convert($value['id']) . '_refresh_token" type="text" value="' . $evalue['refresh_token'] . '" ng-model="edit[\'' . $value['id'] . '_refresh_token\']" ng-init="' . $a_default . '"/><br>';           
                    
                    $output .= 'To get your YouTube Channel ID, please go <a href="https://www.youtube.com/account_advanced" target="_blank">HERE</a>.';
                }
            }

            return $output;
        }

        public static function element_facebook($value, $data = null) {

            if (isset($data)) {
                $evalue = $data;
            } else if (isset($value['std'])) {
                $evalue = $value['std'];
            } else {
                $evalue = '';
            }
            $a_default = '';
            $output = '';
            $reponse = '';
            if (jwOpt::get_option('fbcomments_appid', '') != '' && jwOpt::get_option('fbcomments_secret', '') != '' && $evalue == '') {      
                 $reponse = wp_remote_retrieve_body(wp_remote_request("https://graph.facebook.com/oauth/access_token?client_id=".jwOpt::get_option('fbcomments_appid', '')."&client_secret=" .jwOpt::get_option('fbcomments_secret', '')."&grant_type=client_credentials", array('method' => 'GET')));     
                if ($reponse instanceof WP_Error) {
                    $output .= 'Error';
                }
                $json_reponse = json_decode($reponse);
                if(isset($json_reponse->error)){
                    $output .= 'Error: '.$json_reponse->error->message;
                }
                if ($reponse != '' && strpos($reponse,'access_token') !== false) {
                    $evalue = substr($reponse, 13); 
                }
            }
            
            if($evalue != ''){
                $a_default = 'init_edit(\'' . $value['id'] . '\',\'' . $evalue . '\');';
                $output .= '<input class="of-input large" name="' . $value['id'] . '"   id="' . self::convert($value['id']) . '" type="text" value="' . $evalue . '" ng-model="edit[\'' . $value['id'] . '\']" ng-init="' . $a_default . '"/><br>';
            }else{
                $output .= 'To make this option available, please set both the Client ID and Client Secret items above. Save and refresh this page (F5).';
            }
            
            return $output;
        }


        public static function element_transfer($value, $data = null) {
            $output = '';

            $instructions = $value['desc'];
            switch ($value['target']) {
                case 'themeoptions': $output .= '<textarea id="export_data_themeoptions" rows="8">' . base64_encode(serialize(jwOpt::get_options())) . '</textarea>' . "\n";
                    $output .= '<a href="#" id="of_import_button" target="themeoptions" class="button" title="Restore Options">Import Theme Options</a>';
                    break;
                case 'menus': $output .= '<textarea id="export_data_menus" rows="8">' . base64_encode(serialize(jwOpt::get_options('menus'))) . '</textarea>' . "\n";
                    $output .= '<a href="#" id="of_import_button" target="menus" class="button" title="Restore Options">Import Menu Options</a>';
                    break;
                case 'category': $output .= '<textarea id="export_data_category" rows="8">' . base64_encode(serialize(jwOpt::get_options('category'))) . '</textarea>' . "\n";
                    $output .= '<a href="#" id="of_import_button" target="category" class="button" title="Restore Options">Import Category Options</a>';
                    break;
                case 'builder': $output .= '<textarea id="export_data_builder" rows="8">' . base64_encode(serialize(jwOpt::get_options('builder'))) . '</textarea>' . "\n";
                    $output .= '<a href="#" id="of_import_button" target="builder" class="button" title="Restore Options">Import PageBuilder presets</a>';
                    break;
            }
            return $output;
        }

        public static function title_filter($where, &$wp_query) {
            global $wpdb;
            if (self::$_search_title = $wp_query->get('search_title')) {
                $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql(like_escape(self::$_search_title)) . '%\'';
            }
            return $where;
        }

        public static function load_multidropdown() {
            $offset = 0;
            $items_per_page = 5;
            $items_in = array();
            $items_not_in = array();
            global $wp_query;
            if (isset($_POST['data']['items_per_page'])) {
                $items_per_page = $_POST['data']['items_per_page'];
            }
            if (isset($_POST['data']['offset'])) {
                $offset = $_POST['data']['offset'];
            }
            if (isset($_POST['data']['search_title'])) {
                self::$_search_title = $_POST['data']['search_title'];
            }
            if (isset($_POST['data']['items_in'])) {
                $items_in = $_POST['data']['items_in'];
            }
            if (isset($_POST['data']['items_not_in'])) {
                $items_not_in = $_POST['data']['items_not_in'];
            }
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => $items_per_page,
                'post__in' => $items_in,
                'post__not_in' => $items_not_in,
                'offset' => $offset,
                'search_title' => self::$_search_title,
            );
            $wp_query = new WP_Query($args);
            $ajax_post = $wp_query->posts;


            $return = array();
            foreach ($ajax_post as $key => $value) {
                $return[$value->ID] = $value->post_title;
            }

            die(json_encode($return));
        }

        public static function element_advselect($value, $data = null) {
            $output = '';

            if (isset($data)) {
                $evalue = $data;
            } else if (isset($value['std'])) {
                $evalue = $value['std'];
            } else {
                $evalue = '';
            }
            $a_default = 'init_edit(\'' . $value['id'] . '\',\'' . $evalue . '\');';
            $options = array();
            if (isset($value['target']) && !is_null($value['target'])) {
                $options += jwElements::get_select_target($value['target']);
            }
            if (isset($value['chosen']) && $value['chosen'] == true) {
                $class[] = 'jaw-chosen';
            }

            $class = $class ? ' class="' . implode(' ', $class) . '"' : '';


            $output.= '<select ng-init="' . $a_default . '" ng-model="edit[\'' . $value['id'] . '\']" ' . $class . ' name="' . $value['id'] . '" id="' . self::convert($value['id']) . '">';
            if (isset($value['prompt']) && !is_null($value['prompt'])) {
                $output.= '<option value="">' . $value['prompt'] . '</option>';
            }

            if (is_array($options)) {
                foreach ($options as $key => $option) {
                    if (is_array($option)) {
                        $output.= '<optgroup label="' . $key . '">';
                        foreach ($option as $k => $o) {
                            $output.= '<option value="' . $k . '"';
                            if ($k == $evalue) {
                                $output.= ' selected="selected"';
                            }
                            $output.= '>' . $o . '</option>';
                        }
                        $output.= "</optgroup>";
                    } else {
                        $output.= '<option value="' . $key . '"';
                        if ($key == $evalue) {
                            $output.= ' selected="selected"';
                        }
                        $output.= '>' . $option . '</option>';
                    }
                }
            }
            if (isset($value['page']) && !is_null($value['page'])) {
                $depth = $value['page'];
                $args = array(
                    'depth' => $value['depth'], 'child_of' => 0,
                    'selected' => $evalue, 'echo' => 1,
                    'name' => 'page_id', 'id' => '',
                    'show_option_none' => '', 'show_option_no_change' => '',
                    'option_none_value' => ''
                );
                $pages = get_pages($args);

                $output.= walk_page_dropdown_tree($pages, $depth, $args);
            }

            $output.= '</select>';


            return $output;
        }

        public static function element_ajax_multidropdown($value, $data = null) {

            $output = '';
            if (isset($data)) {
                $evalue = $data;
            } else if (isset($value['std'])) {
                $evalue = $value['std'];
            } else {
                $evalue = '';
            }

            $class = array();
            $class[] = 'ajax_multidropdown';
            $target = '';
            $default_items = 5;
            if (isset($value['target']) && !is_null($value['target'])) {
                $target = 'data-target="' . $value['target'] . '"';
                $class[] = $value['target'];
            }
            if (isset($value['default_items']) && !is_null($value['default_items'])) {
                $default_items = $value['default_items'];
            }

            if (isset($value['chosen']) && $value['chosen'] == true) {
                $class[] = 'jaw-chosen';
            }
            if (isset($value['mod']))
                $class[] = $value['mod'];

            $class = $class ? ' class="' . implode(' ', $class) . ' jaw-chosen"' : '';

            if (!isset($value['size'])) {
                $value['size'] = '6';
            }

            $output.= '<select  ' . $class . '  ' . $target . '  default_items="' . $default_items . '" default_value=\'' . json_encode($evalue) . '\' multiple="true" size="' . $value['size'] . '" style="height:auto" name="' . $value['id'] . '[]" id="' . $value['id'] . '" >';

            $output.= '</select>';


            return $output;
        }

        public static function element_multidropdown($value, $data = null) {
            $output = '';
            $a_default = '';
            if (isset($data)) {
                $evalue = $data;
            } else if (isset($value['std'])) {
                $evalue = $value['std'];
            } else {
                $evalue = '';
            }

            if (isset($value['builder']) && $value['builder'] == "false") {
                $a_default = '';
            } else {
                $a_default = 'init_edit(\'' . $value['id'] . '\',\'' . implode(',', (array) $evalue) . '\');';
            }
            if (isset($value['options']))
                $options = $value['options'];
            else
                $options = array();
            if (isset($value['target']) && !is_null($value['target'])) {
                $options += jwElements::get_select_target($value['target']);
            }

            if (isset($value['chosen']) && $value['chosen'] == true) {
                $class[] = 'jaw-chosen';
            }
            if (isset($value['mod']))
                $class[] = $value['mod'];

            $class = $class ? ' class="' . implode(' ', $class) . '"' : '';

            if (!is_null($value['page'])) {
                $depth = $value['page'];
                $pages = get_pages();
            }
            if (!empty($value['prompt'])) {
                $value['prompt'] = 'data-placeholder="' . $value['prompt'] . '"';
            }

            if (!isset($value['size'])) {
                $value['size'] = '6';
            }
            $angular = '';
            if (isset($value['builder']) && $value['builder'] == "false") {
                $angular = '';
            } else {
                $angular = 'ng-model="edit[\'' . $value['id'] . '\']" ng-init="' . $a_default . '"';
            }

            $output.= '<select  ' . $class . ' ' . $value['prompt'] . '  multiple="true" size="' . $value['size'] . '" style="height:auto" name="' . $value['id'] . '[]" id="' . $value['id'] . '" ' . $angular . '>';

            foreach ($options as $key => $option) {
                if (is_array($option)) {
                    $output.= '<optgroup label="' . $key . '">';
                    foreach ($option as $k => $o) {
                        $output.= '<option value="' . $k . '"';
                        if (is_array($value) && in_array($k, $value)) {
                            $output.= ' selected="selected"';
                        }
                        $output.= '>' . $o . '</option>';
                    }
                    $output.= "</optgroup>";
                } else {
                    $output.= '<option value="' . $key . '"';
                    if (is_array($evalue) && in_array($key, $evalue)) {
                        $output.= ' selected="selected"';
                    }
                    $output.= '>' . $option . '</option>';
                }
            }
            if (!is_null($value['page'])) {
                $args = array(
                    'depth' => $value['page'], 'child_of' => 0,
                    'selected' => $evalue, 'echo' => 1,
                    'name' => 'page_id', 'id' => '',
                    'show_option_none' => '', 'show_option_no_change' => '',
                    'option_none_value' => ''
                );
                $output.= jwElements::walk_page_multi_select_tree($pages, $depth, $args);
            }
            $output.= '</select>';


            return $output;
        }

        public static function element_toggle($value, $data = null) {
            $output = $yes = $no = $yess = $nos = '';
            $a_default = '';
            if (isset($data)) {
                $evalue = $data;
            } else if (is_null($data) && isset($value['std']) && $value['std'] != '') {
                $evalue = $value['std'];
            } else {
                $evalue = '0';
            }
            $a_default = 'init_edit(\'' . $value['id'] . '\',\'' . $evalue . '\');';

            $angular = '';

            $angular = 'ng-init="' . $a_default . '"';
            if (!isset($value['options'])) {
                $value['options'] = array("1" => "On", "0" => "Off");
            }

            $output.='<div class="tooglebutton btn-group" id="' . self::convert($value['id']) . '"  ' . $angular . '>';
            foreach ($value['options'] as $key => $option) {
                $output.='<label  type="button" for="' . self::convert($value['id']) . $key . '" class=" btn button-primary jaw toggle" ng-model="edit[\'' . $value['id'] . '\']" btn-radio="\'' . $key . '\'">' . $option . '</label >';
                $output.='<input class="hide" type="radio" id="' . self::convert($value['id']) . $key . '"  ng-model="edit[\'' . $value['id'] . '\']" name="' . $value['id'] . '"  value="' . $key . '" />';
            }
            $output.='</div>';

            return $output;
        }

        /*
         * upravi vstupni ID elementu pro pouziti menu
         * 
         */

        public static function convert($id) {
            $id = str_replace('[', '-', $id);
            $id = str_replace(']', '', $id);

            return $id;
        }

        public static function element_editor($value, $data = null) {
            $output = '';
            if (isset($data))
                $evalue = $data;
            else if (isset($value['std']))
                $evalue = $value['std'];
            else
                $evalue = '';

            if (isset($value['class']))
                $class = $value['class'];
            else
                $class = '';
            $settings = array(
                'textarea_name' => $value['id'],
                'editor_class' => $class
            );

            ob_start();

            wp_editor($evalue, $value['id'], $settings);

            return $output.=ob_get_clean();
        }

        public static function element_range($value, $data = null) {
            $output = '';
            $a_default = '';
            if (isset($data)) {
                $evalue = $data;
            } else if (isset($value['std'])) {
                $evalue = $value['std'];
            } else {
                $evalue = '';
            }
            $a_default = 'init_edit(\'' . $value['id'] . '\',\'' . $evalue . '\');';

            if (isset($value['min']) && !is_null($value['min'])) {
                $min = $value['min'];
            }
            if (isset($value['max']) && !is_null($value['max'])) {
                $max = $value['max'];
            }
            if (isset($value['step']) && !is_null($value['step'])) {
                $step = $value['step'];
            }

            $output.='<div class="slider">';
            $output.= '<div ui-slider min="' . $min . '" max="' . $max . '" step="' . $step . '" ng-model="edit[\'' . $value['id'] . '\']" ng-init="' . $a_default . '"></div>';
            $output.= '<input type="text" name="' . $value['id'] . '" id="' . self::convert($value['id']) . '"  class="regular-text" value="{{edit[\'' . $value['id'] . '\']}}" ng-model="edit[\'' . $value['id'] . '\']" />';
            if (!is_null($value['unit'])) {
                $output.= '<div class="unit">' . $value['unit'] . '</div>';
            }
            $output.='</div>';




            return $output;
        }

        public static function element_builder($value, $data = null) {
            global $jaw_shortcodes;
            if (!isset($value['editor'])) {
                $value['editor'] = 'true';
            }
            if (!isset($value['edit_name'])) {
                $value['edit_name'] = 'true';
            }
            if (!isset($value['img'])) {
                $value['img'] = '';
            }
            if (!isset($value['icon'])) {
                $value['icon'] = '';
            }
            $output = '';
            $desc = '';
            if (isset($value['desc'])) {
                $desc = 'ng-mouseover="show_desc(\'.button-' . $value['id'] . '\', \'' . $value['name'] . '\', \'' . $value['desc'] . '\', \'' . $value['img'] . '\')" ng-mouseout="hide_desc()"';
            }

            $output .= '<div class="element_button button-' . $value['id'] . '" ng-click="add_element(\'' . $value['id'] . '\', \'' . $value['sizes'] . '\', \'' . $value['size'] . '\',\'' . $value['icon'] . '\')" ' . $desc . ' >';
            $output .= '<input type="hidden" ng-init="desc.' . $value['id'] . '.name = \'' . $value['name'] . '\'" />';
            $output .= '<span class="element_icon ' . $value['icon'] . '"></span>';
            $output .= '<span class="element_text ">' . $value['name'] . '</span>';
            $output .= '</div>';

            return $output;
        }

        public static function element_builder_bookmark($value, $data = null) {
            $output = '';
            $icon = '';
            if (isset($value['icon'])) {
                $icon = '<i class="' . $value['icon'] . '"></i>';
            }
            $output .= '<div class="builder_bookmark" >';
            $output .= '<div class="element_button" ng-class="{active: current.bookmark == \'bookmark-' . $value['id'] . '\'}"  ng-click="current.bookmark = \'bookmark-' . $value['id'] . '\'; searchText = \'\';" >' . $icon . $value['name'] . '</div>';
            if (isset($value['content'])) {
                $output .= '<script id="bookmark-' . $value['id'] . '" type="text/ng-template">';

                if (is_array($value['content'])) {
                    foreach ((array) $value['content'] as $sub) {
                        $element = 'element_' . $sub['type'];
                        $output .= '<li class="' . $sub['id'] . '" ng-show="isSearch(\'' . $sub['name'] . '\');">' . jwElements::$element($sub) . '</li>';
                    }
                }

                $output .= '</script>';
            }
            $output .= '</div>';



            return $output;
        }

        public static function element_revo_composer_live($value, $data = null) {
            $output = '';


            $output .= '<div class="builder_live_switch" ng-click="' . $value['ng-click'] . '" ng-class="{live: live_preview_switch == true}">';
            $output .= $value['name'];
            $output .= '<span class="live_switcher" >';
            $output .= '<span class="live_button"><i class="' . $value['icon'] . '"></i></span>';
            $output .= '<span class="live_info">OFF</span>';
            $output .= '</span>';
            $output .= '</div>';

            return $output;
        }

        public static function element_preset($value, $data = null) {
            $output = '';

            foreach ($value['options'] as $key => $option) {
                $output .= "<div  class='pb-settings radio-preset'  ng-click='load_preset(\"" . addslashes(json_encode($option['content'])) . "\",\"" . addslashes($option['layout']) . "\",\"" . addslashes(json_encode($option['layout-size'])) . "\")'>";
                $output .= '<label >';
                $output .= '<img alt="page-option-preset" src="' . $option['img'] . '" />';
                $output .= '</label>';
                $output .= '</div>';
            }

//CUSTOM
            $output .= "<div  class='pb-settings radio-preset' ng-repeat='(ip,preset) in custom_presets track by ip' >";
            $output .= '<label >';
            $output .= '<div class="custom_preset">';
            $output .= '<div><h5>{{preset.name}}</h5></div>';
            $output .= '<span class="load-preset" title="Load this preset" ng-click="load_preset(preset.content,preset.layout,preset.layout_size)"><i class="icon-folder-open"></i></span>';
            $output .= '<span class="save-preset" title="Save to this preset" ng-click="save_preset(ip)"><i class="icon-disk "></i></span>';
            $output .= '<span class="delete-preset" title="Delete this preset" ng-click="delete_preset(ip)"><i class=" icon-close "></i></span>';
            $output .= '</div>';
            $output .= '</label>';
            $output .= '</div>';

//PLUS    
            $output .= "<div  class='pb-settings radio-preset' title='Add new preset' ng-click='add_preset();'>";
            $output .= '<label >';
            $output .= '<img alt="page-option-preset" src="' . ADMIN_DIR . 'assets/images/plus.png' . '" />';
            $output .= '</label>';
            $output .= '</div>';
            return $output;
        }

        public static function element_element_preset($value, $data = null) {
            $output = '';



//CUSTOM
            $output .= "<div  class='pb-settings radio-preset' ng-repeat='(ip,preset) in custom_element_presets track by ip' >";
            $output .= '<label >';
            $output .= '<div class="custom_element_presets">';
            $output .= '<div><h5>{{preset.name}}</h5></div>';
            $output .= '<span class="load-preset" title="Load this preset" ng-click="load_element_preset(preset.content)"><i class="icon-folder-open"></i></span>';
            $output .= '<span class="delete-preset" title="Delete this preset" ng-click="delete_element_preset(ip)"><i class=" icon-close "></i></span>';
            $output .= '</div>';
            $output .= '</label>';
            $output .= '</div>';


            return $output;
        }

        public static function element_resize_sidebar($value, $data = null) {
            if ($data == null) {
                $data = $value['std'];
            }
            $name = str_replace("build_re_sidebar_", "", $value['id']);
            $output = '    <div class="tools">';
            $output .= '    <div class="controls">';
            $output .= '        <div class="minus" ng-click="resize_sidebar(\'' . $name . '\',false)"><i class="icon-caret-left"></i></div>';
            $output .= '        <div class="text" >size</div>';
            $output .= '        <div class="plus" ng-click="resize_sidebar(\'' . $name . '\',true)"><i class="icon-caret-right"></i></div>';
            $output .= '    </div>';
            $output .= '    <div class="edit controls">';
            $output .= '        <div class="live control_btn" title="Show live preview of this element" ng-click="control_live(\'' . $name . '\')"><i class="icon-eye"></i></div>';
            $output .= '        <div class="edit control_btn" title="Show settings of this sidebar" ng-click="control_edit(\'' . $name . '\')"><i class="icon-pencil"></i></div>';
            $output .= '    </div>';
            $output .= '    </div>';
            $output .= '<div class="builder_sidebar_content"></div>';
            return $output;
        }

        /**
         * Ajax image uploader - supports various types of image types
         *
         * @uses get_option()
         *
         * @access public
         * @since 1.0.0
         *
         * @return string
         */
        public static function elements_uploader_function($id, $std, $mod, $data) {


            $uploader = '';
            $upload = $data;
            $hide = '';



            if ($upload != "") {
                $val = $upload;
            } else {
                $val = $std;
            }

            $uploader .= '<input class="' . $mod . ' upload of-input" name="' . $id . '" id="' . $id . '_upload" value="' . $val . '" />';

            $uploader .= '<div class="upload_button_div"><span class="button image_upload_button" id="' . $id . '">' . _('Upload') . '</span>';

            if (!empty($upload)) {
                $hide = '';
            } else {
                $hide = 'hide';
            }
            $uploader .= '<span class="button image_reset_button ' . $hide . '" id="reset_' . $id . '" title="' . $id . '">Remove</span>';
            $uploader .='</div>' . "\n";
            $uploader .= '<div class="clear"></div>' . "\n";
            if (!empty($upload) && $mod != 'hide-thumbnail') {
                $uploader .= '<div class="screenshot">';
                $uploader .= '<a class="of-uploaded-image" href="' . $upload . '">';
                $uploader .= '<img class="of-option-image" id="image_' . $id . '" src="' . $upload . '" alt="" />';
                $uploader .= '</a>';
                $uploader .= '</div>';
            }
            $uploader .= '<div class="clear"></div>' . "\n";

            return $uploader;
        }

        /**
         * Native media library uploader
         *
         * @uses get_option()
         *
         * @access public
         * @since 1.0.0
         *
         * @return string
         */
        public static function elements_media_uploader_function($id, $std, $int, $mod, $data) {

            $uploader = '';
            $upload = $data;
            $hide = '';

            if ($mod == "min") {
                $hide = 'hide';
            }

            if ($upload != "") {
                $val = $upload;
            } else {
                $val = $std;
            }

            $uploader .= '<input class="' . $hide . ' upload of-input" name="' . $id . '" id="' . $id . '_upload" value="' . $val . '" />';

            $uploader .= '<div class="upload_button_div"><span class="button media_upload_button" id="' . $id . '" rel="' . $int . '">Upload</span>';

            if (!empty($upload)) {
                $hide = '';
            } else {
                $hide = 'hide';
            }
            $uploader .= '<span class="button mlu_remove_button ' . $hide . '" id="reset_' . $id . '" title="' . $id . '">Remove</span>';
            $uploader .='</div>' . "\n";
            $uploader .= '<div class="screenshot">';
            if (!empty($upload)) {
                $uploader .= '<a class="of-uploaded-image" href="' . $upload . '">';
                $uploader .= '<img class="of-option-image" id="image_' . $id . '" src="' . $upload . '" alt="" />';
                $uploader .= '</a>';
            }
            $uploader .= '</div>';
            $uploader .= '<div class="clear"></div>' . "\n";

            return $uploader;
        }

        /**
         * Drag and drop slides manager
         *
         * @uses get_option()
         *
         * @access public
         * @since 1.0.0
         *
         * @return string
         */
        public static function elements_slider_function($id, $std, $oldorder, $order, $int, $data) {


            $slider = '';
            $slide = array();
            $slide = $data;

            if (isset($slide[$oldorder])) {
                $val = $slide[$oldorder];
            } else {
                $val = $std;
            }

//initialize all vars
            $slidevars = array('title', 'url', 'link', 'description');

            foreach ($slidevars as $slidevar) {
                if (!isset($val[$slidevar])) {
                    $val[$slidevar] = '';
                }
            }

//begin slider interface	
            if (!empty($val['title'])) {
                $slider .= '<li><div class="slide_header"><strong>' . stripslashes($val['title']) . '</strong>';
            } else {
                $slider .= '<li><div class="slide_header"><strong>Slide ' . $order . '</strong>';
            }

            $slider .= '<input type="hidden" class="slide of-input order" name="' . $id . '[' . $order . '][order]" id="' . $id . '_' . $order . '_slide_order" value="' . $order . '" />';

            $slider .= '<a class="slide_edit_button" href="#">Edit</a></div>';

            $slider .= '<div class="slide_body">';

            $slider .= '<label>Title</label>';
            $slider .= '<input class="slide of-input of-slider-title" name="' . $id . '[' . $order . '][title]" id="' . $id . '_' . $order . '_slide_title" value="' . stripslashes($val['title']) . '" />';

            $slider .= '<label>Image URL</label>';
            $slider .= '<input class="slide of-input" name="' . $id . '[' . $order . '][url]" id="' . $id . '_' . $order . '_slide_url" value="' . $val['url'] . '" />';

            $slider .= '<div class="upload_button_div"><span class="button media_upload_button" id="' . $id . '_' . $order . '" rel="' . $int . '">Upload</span>';

            if (!empty($val['url'])) {
                $hide = '';
            } else {
                $hide = 'hide';
            }
            $slider .= '<span class="button mlu_remove_button ' . $hide . '" id="reset_' . $id . '_' . $order . '" title="' . $id . '_' . $order . '">Remove</span>';
            $slider .='</div>' . "\n";
            $slider .= '<div class="screenshot">';
            if (!empty($val['url'])) {

                $slider .= '<a class="of-uploaded-image" href="' . $val['url'] . '">';
                $slider .= '<img class="of-option-image" id="image_' . $id . '_' . $order . '" src="' . $val['url'] . '" alt="" />';
                $slider .= '</a>';
            }
            $slider .= '</div>';
            $slider .= '<label>Link URL (optional)</label>';
            $slider .= '<input class="slide of-input" name="' . $id . '[' . $order . '][link]" id="' . $id . '_' . $order . '_slide_link" value="' . $val['link'] . '" />';

            $slider .= '<label>Description (optional)</label>';
            $slider .= '<textarea class="slide of-input" name="' . $id . '[' . $order . '][description]" id="' . $id . '_' . $order . '_slide_description" cols="8" rows="8">' . stripslashes($val['description']) . '</textarea>';

            $slider .= '<a class="slide_delete_button" href="#">Delete</a>';
            $slider .= '<div class="clear"></div>' . "\n";

            $slider .= '</div>';
            $slider .= '</li>';

            return $slider;
        }

        /**
         * Drag and drop sidebar manager
         *
         * @uses get_option()
         *
         * @access public
         * @since 1.0.0
         *
         * @return string
         */
        public static function elements_sidebar_function($id, $data) {

            $out = '';


            $out .= '<li>';
            $out .= '<div class="sidebar_header">';
            $out .= '<input type="hidden" name="' . $id . '[' . $data['id'] . '][name]" value="' . stripslashes($data['name']) . '" />';
            $out .= '<input type="hidden" name="' . $id . '[' . $data['id'] . '][id]"  value="' . stripslashes($data['id']) . '" />';
            $out .= '<input type="hidden" name="' . $id . '[' . $data['id'] . '][desc]" value="' . stripslashes($data['desc']) . '" />';
            $out .= '<strong>' . $data['name'] . '</strong><a class="sidebar_delete_button" href="#">Delete</a>';
            $out .= '</li>';
            return $out;
        }

        /**
         * Uses "silent" posts in the database to store relationships for images.
         * This also creates the facility to collect galleries of, for example, logo images.
         * 
         * Return: $_postid.
         *
         * If no "silent" post is present, one will be created with the type "optionsframework"
         * and the post_name of "of-$_token".
         *
         * Example Usage:
         * elements_mlu_get_silentpost ( 'of_logo' );
         */
        public static function elements_mlu_get_silentpost($_token) {

            global $wpdb;
            $_id = 0;

// Check if the token is valid against a whitelist.
// Sanitise the token.

            $_token = strtolower(str_replace(' ', '_', $_token));


            if ($_token) {

// Tell the function what to look for in a post.

                $_args = array('post_type' => 'options', 'post_name' => 'of-' . $_token, 'post_status' => 'draft', 'comment_status' => 'closed', 'ping_status' => 'closed');

// Look in the database for a "silent" post that meets our criteria.
                $query = 'SELECT ID FROM ' . $wpdb->posts . ' WHERE post_parent = 0';
                foreach ($_args as $k => $v) {
                    $query .= ' AND ' . $k . ' = "' . $v . '"';
                } // End FOREACH Loop

                $query .= ' LIMIT 1';
                $_posts = $wpdb->get_row($query);

// If we've got a post, loop through and get it's ID.
                if (count($_posts)) {
                    $_id = $_posts->ID;
                } else {

// If no post is present, insert one.
// Prepare some additional data to go with the post insertion.
                    $_words = explode('_', $_token);
                    $_title = join(' ', $_words);
                    $_title = ucwords($_title);
                    $_post_data = array('post_title' => $_title);
                    $_post_data = array_merge($_post_data, $_args);
                    $_id = wp_insert_post($_post_data);
                }
            }
            return $_id;
        }

        public static function elements_tabs_function($id, $std, $oldorder, $order, $int) {

            $data = get_option(OPTIONS);
            $slider = '';
            $slide = array();
            if (isset($data[$id]))
                $slide = $data[$id];

            if (isset($slide[$oldorder])) {
                $val = $slide[$oldorder];
            } else {
                $val = $std;
            }

//initialize all vars
            $slidevars = array('title', 'url', 'link', 'description');

            foreach ($slidevars as $slidevar) {
                if (!isset($val[$slidevar])) {
                    $val[$slidevar] = '';
                }
            }
            $slider .= '<li ng-repeat="(ide,ed) in edit.' . $id . '"><div class="slide_header" >';
//begin slider interface	
            if (!empty($val['title'])) {
                $slider .= '<strong>' . stripslashes($val['title']) . '</strong>';
            } else {
                $slider .= '<strong>Content {{ide+1}}</strong>';
            }

            $slider .= '<input type="hidden" class="slide of-input order" name="' . $id . '[' . $order . '][order]" id="' . $id . '_' . $order . '_slide_order" value="' . $order . '" />';

            $slider .= '<a class="slide_edit_button" href="#">Edit</a></div>';

            $slider .= '<div class="slide_body">';

            $slider .= '<label>Title</label>';
            $slider .= '<input ng-model="ed[\'title\']" class="slide of-input of-slider-title" name="' . $id . '[' . $order . '][title]" id="' . $id . '_' . $order . '_slide_title" value="' . stripslashes($val['title']) . '" />';

            $slider .= '<label>Description (optional)</label>';
            $slider .= '<textarea ng-model="ed[\'description\']" class="slide of-input" name="' . $id . '[' . $order . '][description]" id="' . $id . '_' . $order . '_slide_description" cols="8" rows="8">' . stripslashes($val['description']) . '</textarea>';

            $slider .= '<a class="slide_delete_button" href="#" ng-click="del_edit(\'' . $id . '\',ide);">Delete</a>';
            $slider .= '<div class="clear"></div>' . "\n";

            $slider .= '</div>';
            $slider .= '</li>';

            return $slider;
        }

        function walk_page_multi_select_tree() {
            $args = func_get_args();
            if (empty($args[2]['walker']))
                $walker = new Walker_PageMultiSelect;
            else
                $walker = $args[2]['walker'];

            return call_user_func_array(array(&$walker, 'walk'), $args);
        }

        /**
         * Target generator
         */
        public static function get_select_target($typ) {
            $options = array();
            switch ($typ) {
                case 'cat':
                    $entries = get_categories('orderby=name&hide_empty=0');
                    foreach ($entries as $key => $entry) {
                        $options[$entry->term_id] = $entry->name;
                    }
                    break;
                case 'tag':
                    $entries = get_tags('orderby=name&hide_empty=0');
                    foreach ($entries as $key => $entry) {
                        $options[$entry->term_id] = $entry->name;
                    }
                    break;
                case 'page':
                    $entries = get_pages('title_li=&orderby=name');
                    foreach ($entries as $key => $entry) {
                        $options[$entry->ID] = $entry->post_title;
                    }
                    break;
                case 'post':
                    $entries = get_posts('orderby=title&numberposts=-1&order=ASC&suppress_filters=0');
                    foreach ($entries as $key => $entry) {
                        $options[$entry->ID] = $entry->post_title;
                    }
                    break;
                case 'author':
                    global $wpdb;
                    $order = 'user_id';
                    $user_ids = $wpdb->get_col($wpdb->prepare("SELECT $wpdb->usermeta.user_id FROM $wpdb->usermeta where meta_key='wp_user_level' and meta_value>=1 ORDER BY %s ASC", $order));
                    foreach ($user_ids as $user_id) :
                        $user = get_userdata($user_id);
                        $options[$user_id] = $user->display_name;
                    endforeach;
                    break;

                case 'portfolio':
                    $entries = get_posts('post_type=portfolio&orderby=title&numberposts=-1&order=ASC&suppress_filters=0');
                    foreach ($entries as $key => $entry) {
                        $options[$entry->ID] = $entry->post_title;
                    }
                    break;

                case 'portfolio-category':
                    $entries = get_terms('jaw-portfolio-category', 'orderby=name&hide_empty=0&suppress_filters=0');
                    foreach ((array) $entries as $key => $entry) {
                        if (isset($entry->slug) && isset($entry->name)) {
                            $options[$entry->slug] = $entry->name;
                        }
                    }
                    break;
                case 'faq-category':
                    $entries = get_terms('jaw-faq-category', 'orderby=name&hide_empty=0&suppress_filters=0');
                    foreach ((array) $entries as $key => $entry) {
                        if (isset($entry->slug) && isset($entry->name)) {
                            $options[$entry->slug] = $entry->name;
                        }
                    }
                    break;

                case 'team-category':
                    $entries = get_terms('jaw-team-category', 'orderby=name&hide_empty=0&suppress_filters=0');
                    foreach ((array) $entries as $key => $entry) {
                        if (isset($entry->slug) && isset($entry->name)) {
                            $options[$entry->slug] = $entry->name;
                        }
                    }
                    break;
                case 'testimonial-category':
                    $entries = get_terms('jaw-testimonial-category', 'orderby=name&hide_empty=0&suppress_filters=0');
                    foreach ((array) $entries as $key => $entry) {
                        if (isset($entry->slug) && isset($entry->name)) {
                            $options[$entry->slug] = $entry->name;
                        }
                    }
                    break;

                case 'post_types':
                    foreach (get_post_types(array('public' => true), 'objects') as $post_type) {
                        $options[$post_type->name] = esc_html($post_type->labels->name) . ' (' . esc_html($post_type->name) . ')';
                    }
                    break;
                case 'taxonomies':
                    $options = get_taxonomies();
                    break;
                case 'products':
                    $entries = get_posts('post_type=product&orderby=title&numberposts=-1&order=ASC&suppress_filters=0');
                    foreach ($entries as $key => $entry) {
                        $options[$entry->ID] = $entry->post_title;
                    }
                    break;
                case 'product_cat':
                    $entries = get_terms('product_cat', 'orderby=name&hide_empty=0&suppress_filters=0');
                    foreach ((array) $entries as $key => $entry) {
                        if (isset($entry->slug) && isset($entry->name)) {
                            $options[$entry->slug] = $entry->name;
                        }
                    }
                    break;

                case 'product_cat_id':
                    $entries = get_terms('product_cat', 'orderby=name&hide_empty=0&suppress_filters=0');
                    foreach ((array) $entries as $key => $entry) {
                        if (isset($entry->term_id) && isset($entry->name)) {
                            $options[$entry->term_id] = $entry->name;
                        }
                    }
                    break;
                case 'product_tag':
                    $entries = get_terms('product_tag', 'orderby=name&hide_empty=0&suppress_filters=0');
                    foreach ((array) $entries as $key => $entry) {
                        if (isset($entry->slug) && isset($entry->name)) {
                            $options[$entry->slug] = $entry->name;
                        }
                    }
                    break;
                default:
                    $entries = get_terms($typ, 'orderby=name&hide_empty=0&suppress_filters=0');
                    foreach ((array) $entries as $key => $entry) {
                        if (isset($entry->slug) && isset($entry->name)) {
                            $options[$entry->slug] = $entry->name;
                        }
                    }
                    break;
            }
            return $options;
        }

//todo
        function validate($input, $type, $field_id) {

            /* exit early if missing data */
            if (!$input || !$type || !$field_id)
                return $input;

            $input = apply_filters('validate', $input, $type, $field_id);

            if ('background' == $type) {

                $input['background-color'] = validate($input['background-color'], 'colorpicker', $field_id);

                $input['background-image'] = validate($input['background-image'], 'upload', $field_id);
            } else if ('colorpicker' == $type) {

                /* return empty & set error */
                if (0 === preg_match('/^#([a-f0-9]{6}|[a-f0-9]{3})$/i', $input)) {

                    $input = '';

                    add_settings_error('option-tree', 'invalid_hex', 'The Colorpicker only allows valid hexadecimal values.', 'error');
                }
            } else if (in_array($type, array('css', 'text', 'textarea', 'textarea-simple'))) {

                if (!current_user_can('unfiltered_html')) {

                    $input = wp_kses_post($input);
                }
            } else if ('measurement' == $type) {

                $input[0] = sanitize_text_field($input[0]);
            } else if ('typography' == $type) {

                $input['font-color'] = validate($input['font-color'], 'colorpicker', $field_id);
            } else if ('upload' == $type) {

                $input = sanitize_text_field($input);
            }

            $input = apply_filters('ot_after_validate_setting', $input, $type, $field_id);

            return $input;
        }

    }

}
/**
 * Create HTML MultiSelect list of pages.
 *
 * @package WordPress
 * @since 2.1.0
 * @uses Walker
 */
if (!class_exists('Walker_PageMultiSelect')) {

    class Walker_PageMultiSelect extends Walker {

        /**
         * @see Walker::$tree_type
         * @since 2.1.0
         * @var string
         */
        var $tree_type = 'page';

        /**
         * @see Walker::$db_fields
         * @since 2.1.0
         * @todo Decouple this
         * @var array
         */
        var $db_fields = array('parent' => 'post_parent', 'id' => 'ID');

        /**
         * @see Walker::start_el()
         * @since 2.1.0
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param object $page Page data object.
         * @param int $depth Depth of page in reference to parent pages. Used for padding.
         * @param array $args Uses 'selected' argument for selected page to set selected HTML attribute for option element.
         */
        function start_el(&$output, $page, $depth = 0, $args = array(), $current_object_id = 0) {
            $pad = str_repeat('&nbsp;', $depth * 3);

            $output .= "\t<option class=\"level-$depth\" value=\"$page->ID\"";
            if (is_array($args['selected'])) {
                if (in_array($page->ID, $args['selected'])) {
                    $output .= ' selected="selected"';
                }
            } else {
                if ($page->ID == $args['selected']) {
                    $output .= ' selected="selected"';
                }
            }
            $output .= '>';
            $title = apply_filters('list_pages', $page->post_title);
            $output .= $pad . esc_html($title);
            $output .= "</option>\n";
        }

    }

}
