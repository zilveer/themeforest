<?php

class BFIShortcodeStreetviewModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'streetview'; 
    
    public $width = '100%';
    public $height = '300';
    public $lat = '0.0';
    public $lon = '0.0';
    public $heading = '0';
    public $pitch = '0';
    public $zoom = '0';
    public $controls = true;
    public $style = '';
    
    public function render($content = NULL, $unusedAttributeString = '') {
        bfi_wp_enqueue_script('googlemap', 'http://maps.google.com/maps/api/js?sensor=false', array(), NULL, true);
        
        $randid = 'streetview'.rand(10000,99999);
        $this->width .= $this->width[strlen($this->width)-1] == '%' ? '' : 'px';
        $this->height .= $this->height[strlen($this->height)-1] == '%' ? '' : 'px';
        $this->controls = $this->controls ? 'true' : 'false';
        
        return "<div id='$randid' class='map' style='width:$this->width; height:$this->height; $this->style' $unusedAttributeString></div>
                <script type='text/javascript'>
                jQuery(document).ready(function(\$){
                    var latlng = new google.maps.LatLng($this->lat, $this->lon);
                    var panoramaOptions = {
                        position:latlng,
                        pov: {
                            heading: $this->heading,
                            pitch: $this->pitch,
                            zoom: $this->zoom
                        },
                        addressControl: $this->controls,
                        zoomControl: $this->controls,
                        panControl: $this->controls,
                        linksControl: $this->controls
                    };
                    
                    var myPano = new google.maps.StreetViewPanorama(document.getElementById('$randid'), panoramaOptions);
                    myPano.setVisible(true);
                });
                </script>";
    }
}