/**
Vertigo Tip by www.vertigo-project.com
Requires jQuery
*/

this.vtip = function() {    
    this.xOffset = -10; // x distance from mouse
    this.yOffset = 10; // y distance from mouse       
    
    jQuery(".vtip").unbind().hover(    
        function(e) {
            // console.log(this);
            this.t = jQuery(this).attr('data-title');
            // this.title = ''; 
            this.top = (e.pageY + yOffset); this.left = (e.pageX + xOffset);
            
            // BFI edit:
            jQuery('body').append( '<p id="vtip"><span id="vtipArrow">&nbsp;</span>' + this.t + '</p>' );
                        
            //jQuery('p#vtip #vtipArrow').attr("src", 'images/vtip_arrow.png');
            jQuery('p#vtip').css("top", this.top+"px").css("left", this.left+"px").fadeIn("slow");
            
        },
        function() {
            // this.attr('d') = this.t;
            jQuery("p#vtip").fadeOut("slow").remove();
        }
    ).mousemove(
        function(e) {
            this.top = (e.pageY + yOffset);
            this.left = (e.pageX + xOffset);
                         
            jQuery("p#vtip").css("top", this.top+"px").css("left", this.left+"px");
        }
    );            
    
};