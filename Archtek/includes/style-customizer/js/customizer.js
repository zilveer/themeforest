jQuery(document).ready(function($) {
    
    // For "Pixel Input" custom control
    $('.pixel-input-field').numeric(false, function() { 
        alert('Only number is allowed.'); 
        this.value = ''; 
        this.focus(); 
    });
    
});