<?php  
/*
@	CSS head compiler
@	Loads on wp_head
*/

            $redux_wish = wish_redux(); 
            global $post;

            $wish_floating_menu = $redux_wish['wish-floating-menu'];
            $wish_menu_top_margin = $redux_wish['wish-menu-top-margin'];
            $wish_menu_bgcolor = $redux_wish['wish-menu-bgcolor'];
            $wish_menu_bgcolor_inner = $redux_wish['wish-menu-bgcolor-inner'];
            $wish_menu_title = $redux_wish['wish-menu-title'];
            $wish_float_menu_title_hover = $redux_wish['wish-menu-float-title-color-hover'];
            $wish_menu_border_radius = $redux_wish['wish-menu-border-radius'];
            $wish_submenu_bg_color = $redux_wish['wish-menu-dropdown-bgcolor'];    

            if(function_exists('rwmb_meta')){
                $force_float_menu = rwmb_meta('wish_force_float_menu');
            }else{
                $force_float_menu = false;
            }

            $wish_topbar_font = $redux_wish['wish-topbar-font'];
            $wish_topbar_font_regular = $redux_wish['wish-topbar-font-regular'];
            $wish_top_bar_only_floating = $redux_wish['wish-topbar-show-float'];

            if($wish_top_bar_only_floating){
                $wish_top_bar_status = "none";
            }else{
                $wish_top_bar_status = "block";
            }


            $css = "
                    .wish-primary-menu .menu > li.menu-full-width .wish-submenu-ddown, .wish-primary-menu .menu > li .wish-submenu-ddown{
                            background: ".esc_attr($wish_submenu_bg_color['rgba']).";

                    }";

            $css2 = $css;        


                        //floating menu css
                        $css .= "

                        @media (min-width: 1101px) {
                            .wish-rkt-menu-default{
                                position: absolute;
                                z-index: 99;
                                margin-top:15px;
                                right: 0px;
                                border: none;
                                left: 50%;
                                width: 1140px;
                                margin-left: -570px;
                            }
                        }

                        @media (min-width: 1200px) {
                            .wish-rkt-menu-default{
                                position: absolute;
                                z-index: 99;
                                margin-top:".esc_attr($wish_menu_top_margin['margin-top']).";
                                right: 0px;
                                border: none;
                                left: 50%;
                                width: 1140px;
                                margin-left: -585px;
                            }
                        }


                        .wish-primary-menu .menu > li > a{
                            line-height:80px;
                            color: ".esc_attr($wish_menu_title['color']).";
                            font-size: ".esc_attr($wish_menu_title['font-size']).";
                            font-weight: ".esc_attr($wish_menu_title['font-weight']).";
                            font-family: ".esc_attr($wish_menu_title['font-family']).";
                        }
                        
                        .wish-primary-menu .menu > li > a:hover{
                            color: ".esc_attr($wish_float_menu_title_hover).";
                        }    

                        .header, ul.tiny-cart, .mean-bar, .wish-rkt-menu-default .logo{
                            height:80px;
                        }
                         .wish-rkt-menu-default{
                            height:auto;
                            padding-bottom:0;
                            background-color : transparent;
                         }

                         .top-bar-list-right{
                            padding-right: 2px;
                         }

                    @media (max-width: 1200px){
                        .wish-rkt-menu-default{
                            background-color:".esc_attr($wish_menu_bgcolor['rgba']).";
                               
                        }
                        
                        .wish-rkt-menu-default > .container{
                            width:100%;
                            border-radius: ".esc_attr($wish_menu_border_radius)."px;
                        }

                        .header, ul.tiny-cart, .mean-bar, .wish-rkt-menu-default .logo{
                            height:80px;
                        }

                    }


                     .wish-rkt-menu-default > .container{
                        border-radius: ".esc_attr($wish_menu_border_radius)."px;
                    } 

                    .wish-primary-menu .menu > li:last-child{
                        padding-right:20px;
                    }

                    .wish-rkt-menu-default .logo a{
                        margin-left:10px;
                    }

                    .wish-rkt-menu-default > .container:last-child{
                        background-color:".esc_attr($wish_menu_bgcolor['rgba']).";
                    }

                    .top-bar-list-right{
                        padding-left:0;
                    }





                    .top-contact, .top-contact a{
                        font-family: ".esc_attr($wish_topbar_font['font-family']).";
                        font-weight: ".esc_attr($wish_topbar_font['font-weight']).";    
                        font-size: ".esc_attr($wish_topbar_font['font-size']).";    
                        color: ".esc_attr($wish_topbar_font['color']).";
                        line-height: ".esc_attr($wish_topbar_font['line-height']).";
                    }




                    @media (max-width: 1100px){
                        .wish-rkt-menu-default{
                            background-color:".esc_attr($wish_menu_bgcolor['rgba']).";
                        }
                        .header, ul.tiny-cart, .mean-bar, .wish-rkt-menu-default .logo{
                            height:60px;
                        }

                        .wish-rkt-menu-default .logo a{
                            position:relative;
                            top:-26px;
                        }

                    }



                        ";  
                    
                    //fixed menu css

                    $css2 .= ".wish-rkt-menu-default{
                        background-color:".esc_attr($wish_menu_bgcolor_inner).";
                    }
                    .wish-rkt-menu-default > .container{
                        background-color:".esc_attr($wish_menu_bgcolor_inner).";
                    }   

                    .wish-header-fixed-wrapper.wish-is-fixed{
                        background-color: ".esc_attr($wish_menu_bgcolor_inner).";
                    }


                    .top-contact, .top-contact a{
                        font-family: ".esc_attr($wish_topbar_font_regular['font-family']).";
                        font-weight: ".esc_attr($wish_topbar_font_regular['font-weight']).";    
                        font-size: ".esc_attr($wish_topbar_font_regular['font-size']).";    
                        color: ".esc_attr($wish_topbar_font_regular['color']).";
                        line-height: ".esc_attr($wish_topbar_font_regular['line-height']).";
                    }

                    #tc{
                        display:".esc_attr($wish_top_bar_status).";
                    }


                
                    ";
        


                wish_compile_menu_css($css2);
                wish_compile_menu_css_fixed($css);

?>