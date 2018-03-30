// noCarouselThumbnails module for Slider Pro.
// 
// Custom module for the Total WordPress Theme
;(function( window, $ ) {

    "use strict";

    var NS = 'ThumbnailsNc.' + $.SliderPro.namespace;

    var ThumbnailsNc = {

        // Reference to the thumbnail scroller 
        $thumbnailsNc: null,

        // Reference to the container of the thumbnail scroller
        $thumbnailsNcContainer: null,

        // List of Thumbnail objects
        thumbnailsNc: null,

        // Index of the selected thumbnail
        selectedThumbnailNcIndex: 0,

        // Total size (width or height, depending on the orientation) of the thumbnailsNc
        thumbnailsNcSize: 0,

        // Size of the thumbnail's container
        thumbnailsNcContainerSize: 0,

        // Indicates the 'left' or 'top' position based on the orientation of the thumbnailsNc
        thumbnailsNcPositionProperty: null,

        initThumbnailsNc: function() {
            var that = this;

            this.thumbnailsNc = [];
            this.on( 'update.' + NS, $.proxy( this._thumbnailsOnUpdateNc, this ) );
            this.on( 'gotoSlide.' + NS, function( event ) {
                that._gotoThumbnailNc( event.index );
            });
        },

        // Called when the slider is updated
        _thumbnailsOnUpdateNc: function() {
            var that = this;

            // Create the container of the thumbnail scroller, if it wasn't created yet
            if ( this.$thumbnailsNcContainer === null ) {
                this.$thumbnailsNcContainer = $( '<div class="sp-nc-thumbnails-container"></div>' ).insertAfter( this.$slidesContainer );
            }

            // If the thumbnailsNc' main container doesn't exist, create it, and get a reference to it
            if ( this.$thumbnailsNc === null ) {
                if ( this.$slider.find( '.sp-nc-thumbnails' ).length !== 0 ) {
                    this.$thumbnailsNc = this.$slider.find( '.sp-nc-thumbnails' ).appendTo( this.$thumbnailsNcContainer );

                    // Shuffle/randomize the thumbnailsNc
                    if ( this.settings.shuffle === true ) {
                        var thumbnailsNc = this.$thumbnailsNc.find( '.sp-nc-thumbnail' ),
                            shuffledThumbnails = [];

                        // Reposition the thumbnailsNc based on the order of the indexes in the
                        // 'shuffledIndexes' array
                        $.each( this.shuffledIndexes, function( index, element ) {
                            var $thumbnail = $( thumbnailsNc[ element ] );

                            if ( $thumbnail.parent( 'a' ).length !== 0 ) {
                                $thumbnail = $thumbnail.parent( 'a' );
                            }

                            shuffledThumbnails.push( $thumbnail );
                        });
                        
                        // Append the sorted thumbnailsNc to the thumbnail scroller
                        this.$thumbnailsNc.empty().append( shuffledThumbnails ) ;
                    }
                } else {
                    this.$thumbnailsNc = $( '<div class="sp-nc-thumbnails"></div>' ).appendTo( this.$thumbnailsNcContainer );
                }
            }

            // Check if there are thumbnailsNc inside the slides and move them in the thumbnailsNc container
            this.$slides.find( '.sp-nc-thumbnail' ).each( function( index ) {
                var $thumbnail = $( this ),
                    thumbnailIndex = $thumbnail.parents( '.sp-slide' ).index(),
                    lastThumbnailIndex = that.$thumbnailsNc.find( '.sp-nc-thumbnail' ).length - 1;

                if ( $thumbnail.parent( 'a' ).length !== 0 ) {
                    $thumbnail = $thumbnail.parent( 'a' );
                }

                // If the index of the slide that contains the thumbnail is greater than the total number
                // of thumbnailsNc from the thumbnailsNc container, position the thumbnail at the end.
                // Otherwise, add the thumbnailsNc at the corresponding position.
                if ( thumbnailIndex > lastThumbnailIndex ) {
                    $thumbnail.appendTo( that.$thumbnailsNc );
                } else {
                    $thumbnail.insertBefore( that.$thumbnailsNc.find( '.sp-nc-thumbnail' ).eq( thumbnailIndex ) );
                }
            });

            // Loop through the Thumbnail objects and if a corresponding element is not found in the DOM,
            // it means that the thumbnail might have been removed. In this case, destroy that Thumbnail instance.
            for ( var i = this.thumbnailsNc.length - 1; i >= 0; i-- ) {
                if ( this.$thumbnailsNc.find( '.sp-nc-thumbnail[data-index="' + i + '"]' ).length === 0 ) {
                    var thumbnail = this.thumbnailsNc[ i ];

                    thumbnail.destroy();
                    this.thumbnailsNc.splice( i, 1 );
                }
            }

            // Loop through the thumbnailsNc and if there is any uninitialized thumbnail,
            // initialize it, else update the thumbnail's index.
            this.$thumbnailsNc.find( '.sp-nc-thumbnail' ).each(function( index ) {
                var $thumbnail = $( this );

                if ( typeof $thumbnail.attr( 'data-init' ) === 'undefined' ) {
                    that._createThumbnailNc( $thumbnail, index );
                } else {
                    that.thumbnailsNc[ index ].setIndexNc( index );
                }
            });

            // Check if the pointer needs to be created
            if ( this.settings.thumbnailPointer === true ) {
                this.$thumbnailsNcContainer.addClass( 'sp-has-pointer' );
            } else {
                this.$thumbnailsNcContainer.removeClass( 'sp-has-pointer' );
            }

            // Mark the thumbnail that corresponds to the selected slide
            this.selectedThumbnailNcIndex = this.selectedSlideIndex;
            this.$thumbnailsNc.find( '.sp-nc-thumbnail-container' ).eq( this.selectedThumbnailNcIndex ).addClass( 'sp-nc-selected-thumbnail' );
            
            // Calculate the total size of the thumbnailsNc
            this.thumbnailsNcSize = 0;

            $.each( this.thumbnailsNc, function( index, thumbnail ) {
                thumbnail.setSizeNc( that.settings.thumbnailWidth, that.settings.thumbnailHeight );
            });

        },

        // Create an individual thumbnail
        _createThumbnailNc: function( element, index ) {
            var that = this,
                thumbnail = new ThumbnailNc( element, this.$thumbnailsNc, index );

            // When the thumbnail is clicked, navigate to the corresponding slide
            thumbnail.on( 'thumbnailClick.' + NS, function( event ) {
                that.gotoSlide( event.index );
            });

            // Add the thumbnail at the specified index
            this.thumbnailsNc.splice( index, 0, thumbnail );
        },

        // Selects the thumbnail at the indicated index and moves the thumbnail scroller
        _gotoThumbnailNc: function( index ) {

            var previousIndex = this.selectedThumbnailNcIndex;

            this.selectedThumbnailNcIndex = index;

            // Set the 'selected' class to the appropriate thumbnail
            this.$thumbnailsNc.find( '.sp-nc-selected-thumbnail' ).removeClass( 'sp-nc-selected-thumbnail' );
            this.$thumbnailsNc.find( '.sp-nc-thumbnail-container' ).eq( this.selectedThumbnailNcIndex ).addClass( 'sp-nc-selected-thumbnail' );

            // Fire the 'gotoThumbnail' event
            this.trigger({ type: 'gotoThumbnail' });
            if ( $.isFunction( this.settings.gotoThumbnail ) ) {
                this.settings.gotoThumbnail.call( this, { type: 'gotoThumbnail' });
            }

        },

        thumbnailsNcDefaults: {

            // Sets the width of the thumbnail
            thumbnailWidth: 100,

            // Sets the height of the thumbnail
            thumbnailHeight: 80,

            // Indicates if a pointer will be displayed for the selected thumbnail
            thumbnailPointer: false,

            // Called when a new thumbnail is selected
            gotoThumbnail: function() {},

        }
    };

    var ThumbnailNc = function( thumbnail, thumbnailsNc, index ) {

        // Reference to the thumbnail jQuery element
        this.$thumbnail = thumbnail;

        // Reference to the thumbnail scroller
        this.$thumbnailsNc = thumbnailsNc;

        // Reference to the thumbnail's container, which will be 
        // created dynamically.
        this.$thumbnailContainer = null;

        // The width and height of the thumbnail
        this.width = 0;
        this.height = 0;

        // Indicates whether the thumbnail's image is loaded
        this.isImageLoaded = false;

        // Set the index of the slide
        this.setIndexNc( index );

        // Initialize the thumbnail
        this._init();
    };

    ThumbnailNc.prototype = {

        _init: function() {
            var that = this;

            // Mark the thumbnail as initialized
            this.$thumbnail.attr( 'data-init', true );

            // Create a container for the thumbnail and add the original thumbnail to this container.
            // Having a container will help crop the thumbnail image if it's too large.
            this.$thumbnailContainer = $( '<div class="sp-nc-thumbnail-container"></div>' ).appendTo( this.$thumbnailsNc );

            
            this.$thumbnail.appendTo( this.$thumbnailContainer );

            // When the thumbnail container is clicked, fire an event
            this.$thumbnailContainer.on( 'click.' + NS, function() {
                that.trigger({ type: 'thumbnailClick.' + NS, index: that.index });
            });
        },

        // Set the width and height of the thumbnail
        setSizeNc: function( width, height ) {
            this.width = width;
            this.height = height;

            // Apply the width and height to the thumbnail's container
            this.$thumbnailContainer.css({ 'width': this.width, 'height': this.height });

            // If there is an image, resize it to fit the thumbnail container
            if ( this.$thumbnail.is( 'img' ) && typeof this.$thumbnail.attr( 'data-src' ) === 'undefined' ) {
                this.resizeImageNc();
            }
        },

        // Return the width and height of the thumbnail
        getSizeNc: function() {
            return {
                width: this.$thumbnailContainer.outerWidth( true ),
                height: this.$thumbnailContainer.outerHeight( true )
            };
        },

        // Set the index of the thumbnail
        setIndexNc: function( index ) {
            this.index = index;
            this.$thumbnail.attr( 'data-index', this.index );
        },

        // Resize the thumbnail's image
        resizeImageNc: function() {
            var that = this;

            // If the image is not loaded yet, load it
            if ( this.isImageLoaded === false ) {
                SliderProUtils.checkImagesComplete( this.$thumbnailContainer , function() {
                    that.isImageLoaded = true;
                    that.resizeImageNc();
                });

                return;
            }

            // Get the reference to the thumbnail image again because it was replaced by
            // another img element during the loading process
            this.$thumbnail = this.$thumbnailContainer.find( '.sp-nc-thumbnail' );

            // Calculate whether the image should stretch horizontally or vertically
            var imageWidth = this.$thumbnail.width(),
                imageHeight = this.$thumbnail.height();

            if ( imageWidth / imageHeight <= this.width / this.height ) {
                this.$thumbnail.css({ width: '100%', height: 'auto' });
            } else {
                this.$thumbnail.css({ width: 'auto', height: '100%' });
            }

        },

        // Attach an event handler to the slide
        on: function( type, callback ) {
            return this.$thumbnailContainer.on( type, callback );
        },

        // Detach an event handler to the slide
        off: function( type ) {
            return this.$thumbnailContainer.off( type );
        },

        // Trigger an event on the slide
        trigger: function( data ) {
            return this.$thumbnailContainer.triggerHandler( data );
        }
    };

    $.SliderPro.addModule( 'ThumbnailsNc', ThumbnailsNc );

})( window, jQuery );