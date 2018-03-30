//emulate jquery live to preserve jQuery.live() call
if( typeof jQuery.fn.live == 'undefined' ) {
    jQuery.fn.live = function( types, data, fn ) {
        jQuery( this.context ).on( types, this.selector, data, fn );
        return this;
    };
}