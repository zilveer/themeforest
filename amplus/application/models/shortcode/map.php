<?php

class BFIShortcodeMapModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'map'; 
    
    public $width = '100%';
    public $height = '300';
    public $lat = '0.0';
    public $lon = '0.0';
    public $zoom = '8';
    public $type = 'roadmap';
    public $controls = true;
    public $style = '';
    public $drawmarker = false;
    public $openmarker = true;
    
    public function render($content = NULL, $unusedAttributeString = '') {
        $randid = 'map'.rand(10000,99999);
        // $this->type = strtolower($this->type);
        $this->width .= $this->width[strlen($this->width)-1] == '%' ? '' : 'px';
        $this->height .= $this->height[strlen($this->height)-1] == '%' ? '' : 'px';
        
        bfi_wp_enqueue_script('googlemap', 'http://maps.google.com/maps/api/js?sensor=false', array(), NULL, true);
        
        if ($content) $this->drawmarker = 'true';
        if ($content) $content = str_ireplace("\n", " ", addslashes($content));
        
        $this->type = strtoupper($this->type);
        $this->controls = $this->controls ? 'true' : 'false';
        $this->drawmarker = $this->drawmarker ? 'true' : 'false';
        $this->openmarker = $this->openmarker ? 'true' : 'false';
        $hasContent = $content ? 'true' : 'false';
        
        return "<div id='$randid' class='map' style='width:$this->width; height:$this->height; $this->style' $unusedAttributeString></div>
                <script type='text/javascript'>
                jQuery(document).ready(function(\$){
                    var latlng = new google.maps.LatLng($this->lat, $this->lon);
                    var maptypeid = google.maps.MapTypeId.{$this->type};
                    var myOptions = {
                        zoom: $this->zoom,
                        center: latlng,
                        mapTypeId: maptypeid,
                        disableDefaultUI: !$this->controls
                    };
                    
                    var map = new google.maps.Map(document.getElementById('$randid'), myOptions);

                    if ($this->drawmarker) {
                        var marker = new google.maps.Marker({
                            position: latlng,
                            map: map
                        });
                    }

                    if (!$hasContent) {
                        return;
                    }

                    var infowindow = new google.maps.InfoWindow({
                        content: '$content'
                    });

                    google.maps.event.addListener(marker, 'click', function() {
                      infowindow.open(map,marker);
                      if (typeof Cufon != 'undefined') {
                          try {
                              Cufon.replace('div.map h1, div.map h2, div.map h3, div.map h4, div.map h5, div.map h6');
                          } catch (err) { }
                      }
                    });

                    if ($this->openmarker) { 
                         jQuery(window).load(function () {
                             google.maps.event.trigger(marker, 'click');
                         });
                     }
                });
                </script>";
    }
}
