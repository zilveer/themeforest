<?php

/**
 *
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 5.0
 * @package     artbees
 */

// Exit if accessed directly
if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

// Don't duplicate me!
if (!class_exists('Mk_Options_Framework_Fields_Background_Selector')) {
    
    class Mk_Options_Framework_Fields_Background_Selector extends Mk_Options_Framework
    {
        
        /**
         * Field Constructor.
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        function __construct($value) {
            
            $this->field = $value['type'];
            $this->name = $value['name'];
            $this->id = $value['id'];
            $this->description = $value['desc'];
        }
        
        public function render() {
          
        $output = '<div class="mk-general-bg-selector">
             <div class="outer-wrapper">
                          <div rel="body" class="body-section"><span class="hover-state-body"><span class="section-indicator">'.__( 'Body', 'mk_framework' ).'</span></span>
                         <div class="mk-bg-preview-layer"></div><div class="mk-transparent-bg-indicator"></div></div><div class="main-sections-wrapper">
                        <div rel="header" class="header-section"><span class="hover-state"><span class="section-indicator">'.__( 'Header', 'mk_framework' ).'</span></span>
                        <div class="mk-bg-preview-layer"></div><div class="mk-transparent-bg-indicator"></div></div>
                          <div rel="banner" class="banner-section"><span class="hover-state"><span class="section-indicator">'.__( 'Page Title Section', 'mk_framework' ).'</span></span>
                          <div class="mk-bg-preview-layer"></div><div class="mk-transparent-bg-indicator"></div></div>
                        <div rel="page" class="page-section"><span class="hover-state"><span class="section-indicator">'.__( 'Page', 'mk_framework' ).'</span></span>
                          <div class="mk-bg-preview-layer"></div><div class="mk-transparent-bg-indicator"></div></div>
                        <div rel="footer" class="footer-section"><span class="hover-state"><span class="section-indicator">'.__( 'Footer', 'mk_framework' ).'</span></span>
                          <div class="mk-bg-preview-layer"></div><div class="mk-transparent-bg-indicator"></div></div>
                    </div>
              </div>
        <div id="mk-bg-edit-panel" class="mk-bg-edit-panel">
          <div class="mk-bg-panel-heading"> <a class="mk-bg-edit-panel-heading-cancel" href="#"><i class="icon-close2"></i></a> 
          <span class="mk-bg-edit-panel-heading-text">'.__( 'Edit color & texture', 'mk_framework' ).' - <span class="mk-edit-panel-heading"></span></span>
          </div>
          <div style="border-bottom:1px solid #ccc;">
            <div class="mk-bg-edit-right">

              <div class="mk-bg-edit-option mk-bg-edit-bg-color"> <span class="mk-bg-edit-label">'.__( 'Background color', 'mk_framework' ).'</span>
                
                <div class="bg-edit-panel-color">
                  <select class="mk-select bg-panel-color-style" name="bg_panel_color_style" id="bg_panel_color_style">
                    <option value="single">Single Color</option>
                    <option value="gradient">Gradient</option>
                  </select>
                </div>
                <div class="clearboth"></div>
                <div class="bg-edit-panel-color">
                  <span class="mk-bg-edit-label panel-gradient-element">'.__( 'From', 'mk_framework' ).'</span>
                  <div class="color-picker-holder"><input name="bg_panel_color" id="bg_panel_color" size="8" class="color-picker" value="" /></div>
                </div>

                <div class="bg-edit-panel-color panel-gradient-element">
                  <span class="mk-bg-edit-label">'.__( 'To', 'mk_framework' ).'</span>
                  <div class="color-picker-holder"><input name="bg_panel_color_2" id="bg_panel_color_2" size="8" class="color-picker" value="" /></div>
                </div>
                <div class="clearboth"></div>
                <div class="bg-edit-panel-color panel-gradient-element">
                  <span class="mk-bg-edit-label">'.__( 'Style', 'mk_framework' ).'</span>
                  <select class="mk-select" name="grandient_color_style" id="grandient_color_style">
                    <option value="linear">Linear</option>
                    <option value="radial">Radial</option>
                  </select>
                </div>

                <div class="bg-edit-panel-color panel-gradient-element panel-linear-gradient-el">
                  <span class="mk-bg-edit-label">'.__( 'Angle', 'mk_framework' ).'</span>
                  <select name="grandient_color_angle" id="grandient_color_angle" class="mk-select">
                    <option value="vertical">Vertical ↓</option>
                    <option value="horizontal">Horizontal →</option>
                    <option value="diagonal_left_bottom">Diagonal ↘</option>
                    <option value="diagonal_left_top">Diagonal ↗</option>
                  </select>
                </div>

                <div class="clearboth"></div>
              </div>

              <div class="mk-bg-edit-option"> <span class="mk-bg-edit-label">'.__( 'Background Image', 'mk_framework' ).'</span>
                <ul class="bg-background-type-tabs">
                  <li><a rel="no-image" href="#" class="mk-bg-edit-option-no-image-button bg-image-buttons">'.__( 'No Image', 'mk_framework' ).'</a></li>
                  <li><a rel="custom" href="#" class="mk-bg-edit-option-upload-button bg-image-buttons">'.__( 'Custom', 'mk_framework' ).'</a></li>
                </ul>
                <div class="clearboth"></div>

              <div class="bg-background-type-panes">
                <div class="bg-background-type-pane bg-no-image"> </div>
      
                <div class="bg-background-type-pane bg-edit-panel-upload">
                  <div class="upload-option">
                    
                    <span class="bg-edit-panel-upload-title">'.__( 'Upload a new custom image', 'mk_framework' ).'</span>


         <div class="mk-upload-bg-wrapper"><input class="mk-upload-url" type="text" id="bg_panel_upload" name="bg_panel_upload" size="40"  value="" />
         <a class="secondary-button option-upload-button thickbox" id="bg_panel_upload_button" href="#">'.__( 'Upload', 'mk_framework' ).'</a></div>
         <div id="bg_panel_upload-preview" class="custom-image-preview-block show-upload-image"><img src="" title="" /></div>
        </div>
                </div>
              </div>
              <div class="clearboth"></div>
            </div>
        </div>
            <div class="mk-bg-edit-left">
              <div class="mk-bg-edit-option mk-bg-edit-option-repeat"> <span class="mk-bg-edit-label">'.__( 'Background Repeat', 'mk_framework' ).'</span>
                <div class="bg-repeat-option"><a class="no-repeat" href="#" rel="no-repeat" title="no-repeat"></a><a href="#" rel="repeat" class="repeat" title="repeat"></a><a href="#" rel="repeat-x" class="repeat-x" title="repeat-x"></a><a href="#" rel="repeat-y" class="repeat-y" title="repeat-y"></a></div>
                <div class="clearboth"></div>
              </div>
              <div class="mk-bg-edit-option mk-bg-edit-option-attachment"> <span class="mk-bg-edit-label">'.__( 'Background Attachment', 'mk_framework' ).'</span>
                <div class="bg-attachment-option"> <a href="#" rel="fixed" class="fixed" title="fixed"></a><a href="#" rel="scroll" class="scroll" title="scroll"></a></div>
                <div class="clearboth"></div>
              </div>
              <div class="mk-bg-edit-option mk-bg-edit-option-position"> <span class="mk-bg-edit-label">'.__( 'Background Position', 'mk_framework' ).'</span>
                <div class="bg-position-option">
                    <a style="border-left:none" href="#" rel="left top" class="left-top" title="left top"></a><a href="#" rel="center top" class="center-top" title="center top"></a><a href="#" rel="right top" class="right-top" title="right top"></a>
                  <div class="clearboth"></div>
                  <a style="border-left:none" href="#" rel="left center" class="left-center" title="left center"></a><a href="#" rel="center center" class="center-center" title="center center"></a><a href="#" rel="right center" class="right-center" title="right center"></a>
                  <div class="clearboth"></div>
                  <a href="#" rel="left bottom" class="left-bottom" title="left bottom"></a><a style="border-bottom:none;" href="#" rel="center bottom" class="center-bottom" title="center bottom"></a><a style="border-bottom:none;" href="#" rel="right bottom" class="right-bottom" title="right bottom"></a>
              </div>
                <div class="clearboth"></div>
              </div>
              <div class="mk-bg-edit-option mk-bg-edit-option-stretch"> <span class="mk-bg-edit-label">'.__( 'Cover whole background', 'mk_framework' ).'</span>
                <span class="mk-toggle-button"><span class="toggle-handle"></span><input type="hidden" value="false" name="bg_panel_stretch" id="bg_panel_stretch"/></span>
                <div class="clearboth"></div>
              </div>
              <div class="clearboth"></div>
            </div>
            <div class="clearboth"></div>
          </div>
          <div class="mk-bg-edit-buttons"> <a id="mk_cancel_bg_selector" href="#" class="secondary-button full-rounded" style="padding: 14px 25px;"><span>'.__( 'Cancel', 'mk_framework' ).'</span></a> 
          <a id="mk_apply_bg_selector" href="#" class="primary-button blue-button"><span>'.__( 'Apply', 'mk_framework' ).'</span></a> </div>
        </div>
        </div>';
            
            return parent::field_wrapper($this->id, $this->name, $this->description, $output);
        }
        
        /**
         * Enqueue Function.
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function enqueue() {
        }
    }
}
