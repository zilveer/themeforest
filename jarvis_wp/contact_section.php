<?php global $smof_data; ?>
             <?php if( $smof_data['rnr_enable_googlemap']) { ?>          
              <div  class="row contact-map">
					  <script type="text/javascript">
                        jQuery(document).ready(function() {
                      function initialize() {
                              var secheltLoc = new google.maps.LatLng(<?php echo $smof_data['rnr_map_lat']; ?>,<?php echo $smof_data['rnr_map_lon']; ?>);
                              var myMapOptions = {
                                   center: secheltLoc
                                  ,mapTypeId: google.maps.MapTypeId.ROADMAP
                                  ,zoom: <?php echo $smof_data['rnr_map_zoom']; ?> , scrollwheel: false,mapTypeControl: true, zoomControl: true, draggable: false
                              };
                              var theMap = new google.maps.Map(document.getElementById("google-map"), myMapOptions);
                              var image = new google.maps.MarkerImage(
                                  '<?php echo get_template_directory_uri().'/images/pinMap.png'; ?>',
                                  new google.maps.Size(17,26),
                                  new google.maps.Point(0,0),
                                  new google.maps.Point(8,26)
                              );
                              var shadow = new google.maps.MarkerImage(
                                  '<?php echo get_template_directory_uri().'/images/pinMap-shadow.png'; ?>',
                                  new google.maps.Size(33,26),
                                  new google.maps.Point(0,0),
                                  new google.maps.Point(9,26)
                              );
                              var marker = new google.maps.Marker({
                                  map: theMap,
                                  icon: image,
                                  shadow: shadow,
                                  draggable: false,
                                  animation: google.maps.Animation.DROP,
                                  position: secheltLoc,
                                  visible: true
                              });
                      
                              var boxText = document.createElement("div");
                              boxText.innerHTML = '<div class="captionMap animated bounceInDown"><img src="<?php echo $smof_data['rnr_map_logo']; ?>" class="alignleft"  alt="Contact Address"> <span><?php $contact_address = $smof_data['rnr_contact_address']; echo  htmlentities($contact_address, ENT_QUOTES, "UTF-8"); ?></span></div>';
                      
                              var myOptions = {
                                   content: boxText
                                  ,disableAutoPan: false,maxWidth: 0
                                  ,pixelOffset: new google.maps.Size(-140, 0)
                                  ,zIndex: null
                                  ,boxStyle: { 
                                      width: "280px"
                                   }
                                  ,closeBoxURL: ""
                                  ,infoBoxClearance: new google.maps.Size(1, 1)
                                  ,isHidden: false
                                  ,pane: "floatPane"
                                  ,enableEventPropagation: false
                              };
                      
                              google.maps.event.addListener(theMap, "click", function (e) {
                                  ib.open(theMap, this);
                              });
                      
                              var ib = new InfoBox(myOptions);
                              ib.open(theMap, marker);
                              }
                              google.maps.event.addDomListener(window, 'load', initialize);
                              
                          });	
                          </script>   
                      <div id="google-map" class="embed clearfix">
                        <div class="mapPreLoading">
                            <span><h4>Loading</h4></span>
                            <span class="l-1"></span>
                            <span class="l-2"></span>
                            <span class="l-3"></span>
                            <span class="l-4"></span>
                            <span class="l-5"></span>
                            <span class="l-6"></span>
                        </div>
                      </div>
             </div>    
             
             <?php } ?> 

       <div class="container">
            <div class="row">				
              <div class="sixteen columns">
                <?php  the_content(); ?>
              </div>
             </div>
            </div><!-- END OF CONTAINER -->                  
