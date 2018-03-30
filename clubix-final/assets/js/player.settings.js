/**
 * This is the file responsible for the simple player settings.
 * @author StylishThemes
 * @since 1.0.0
 */

swfPath = jQuery('body').attr('data-swfpath');

jQuery.fn.hasAttr = function(name) {
    return this.attr(name) !== undefined;
};

(function(jQuery) {
    jQuery.fn.getAttributes = function() {
        var attributes = {};

        if( this.length ) {
            jQuery.each( this[0].attributes, function( index, attr ) {
                attributes[ attr.name ] = attr.value;
            } );
        }

        return attributes;
    };
})(jQuery);

if (typeof String.prototype.startsWith != 'function') {
    // see below for better implementation!
    String.prototype.startsWith = function (str){
        return this.indexOf(str) == 0;
    };
}

function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}

String.prototype.ucwords = function() {
    var str = this.toLowerCase();
    return str.replace(/(^([a-zA-Z\p{M}]))|([ -][a-zA-Z\p{M}])/g,
        function(jQuery1){
            return jQuery1.toUpperCase();
        });
};


var PlayersController = {

    _components : {},
    ActiveComponents : 0,

    Init : function() {
        var obj = this;

        obj._mapComponents();

        jQuery.each(obj._components, function(index, value){
            if(value.type === 'audio-player') {

                var info = [];

                info.id = value.id;
                info.type = value.type;
                info.container = value.container;

                value.player = new AudioPlayer(info);

            } else if(value.type === 'audio-player-large') {

                var info = [];

                info.id = value.id;
                info.type = value.type;
                info.container = value.container;

                value.player = new BigAudioPlayer(info);

            }
        });
    },

    _mapComponents : function() {
        var obj = this;

        jQuery('.component').each(function(index){
            var attr = jQuery(this).attr('data-component');

            if (typeof attr !== 'undefined' && attr !== false) {
                var component = [];

                component['id'] = index;
                component['type'] = attr;
                component['container'] = jQuery(this);

                obj._components[index] = component;
                obj.ActiveComponents++;
            }
        });
    }

};


/* The big player */
function BigAudioPlayer(info) {

    this.ComponentId        = 0;
    this.Container          = null;
    this.ContainerId        = null;
    this.PlayerContainer    = null;
    this.PlayerContainerId  = null;
    this.BigContainer       = null;
    this.TrackList          = {};
    this.TrackCount         = 0;
    this.CurrentTrackNumber = 0;


    this.Container = info.container;
    this.ComponentId = info.id;

    this.BigContainer =  this.Container.parent().parent().parent().parent();

    if(!this.Container.hasAttr('id'))
        this.Container.attr('id', 'component-audio-player-' + this.ComponentId);

    this.ContainerId = this.Container.attr('id');

    this.Container.hide();
    this._setPlayer();
    this.Container.fadeIn('slow');

}

BigAudioPlayer.prototype = {

    constructor : BigAudioPlayer,

    _setPlayer : function() {
        this._setTrackList();
        this._definePlayerContainer();
        this._setPlayerInstance();
        this._setPlayerLoadingBar();
    },

    _setTrackList : function() {
        var objectInstance = this;

        this.Container.find('.track').each(function(index){
            objectInstance.TrackList[index] = {};
            objectInstance.TrackList[index].index = index;

            var attributes = jQuery(this).getAttributes();

            jQuery(this).attr('data-track-number', index);

            jQuery.each(attributes, function(key, value){
                if(key.startsWith('data-')) {
                    var theKey = key.substr(5).replace('-', ' ').ucwords().replace(' ', '');
                    theKey = theKey.charAt(0).toLowerCase() + theKey.substr(1);

                    objectInstance.TrackList[index][theKey] = value;
                }
            });

            objectInstance.TrackCount++;
        });
    },

    _definePlayerContainer : function() {
        this.PlayerContainerId = 'player-container-' + this.ContainerId;

        this.Container.before('<div id="' + this.PlayerContainerId + '"></div>');

        this.PlayerContainer = jQuery('#' + this.PlayerContainerId);
    },

    _setPlayerInstance : function() {
        var objectInstance = this;

        this.PlayerContainer.jPlayer({
            ready: function () {
                objectInstance.Container.find('.play-pause-button').bind('click', function(){
                    if(jQuery(this).hasClass('pause-playing'))
                        objectInstance.PauseSong();
                    else {
                        if(jQuery(this).parent('li').find('.name > .time-bar > span').width() != 0)
                            objectInstance.StartSong();
                        else
                            objectInstance.PlaySong(jQuery(this).parent('li').attr('data-track-number'));
                    }
                });

                objectInstance.BigContainer.find('div.buttons > .play-pause').bind('click', function(){
                    if(jQuery(this).hasClass('pause'))
                        objectInstance.PauseSong();
                    else {
                        if(objectInstance.BigContainer.find('.sound-bar-content > .progress-sound').width() != 0)
                            objectInstance.StartSong();
                        else
                            objectInstance.PlaySong(objectInstance.CurrentTrackNumber);
                    }
                });

                objectInstance.BigContainer.find('.buttons .prev').bind('click', function(){
                    if(objectInstance.CurrentTrackNumber == 0)
                        objectInstance.PlaySong((objectInstance.TrackCount - 1));
                    else
                        objectInstance.PlaySong(parseInt(objectInstance.CurrentTrackNumber) - 1);
                });

                objectInstance.BigContainer.find('.buttons .next').bind('click', function(){
                    if(objectInstance.CurrentTrackNumber == (objectInstance.TrackCount - 1))
                        objectInstance.PlaySong(0);
                    else
                        objectInstance.PlaySong((parseInt(objectInstance.CurrentTrackNumber) + 1));
                });

                if(objectInstance.Container.attr('data-autoplay') == 1) {
                    objectInstance.PlaySong(0);
                }
            },
            timeupdate: function(event) {
                var timeLeft = parseInt(event.jPlayer.status.duration, 10) - parseInt(event.jPlayer.status.currentTime, 10);

                if(timeLeft == 0)
                    timeLeft = parseInt(event.jPlayer.status.duration, 10);

                if(timeLeft == 0) {
                    objectInstance.Container.find('li.track').eq(objectInstance.CurrentTrackNumber).find('time').html('');
                    objectInstance.BigContainer.find('.sound-bar-container > .sound-bar-content > .content > time').html('');
                    objectInstance.BigContainer.find('.sound-bar-content > .progress-sound').css('width', '0px');
                    return;
                }

                var minutesLeft = parseInt(timeLeft / 60),
                    secondsLeft = timeLeft % 60;

                secondsLeft = secondsLeft < 10 ? '0' + secondsLeft : secondsLeft;

                //objectInstance.Container.find('li.track').eq(objectInstance.CurrentTrackNumber).find('time').html('- ' + minutesLeft + ':' + secondsLeft);
                objectInstance.BigContainer.find('.sound-bar-container > .sound-bar-content > .content > time').html('- ' + minutesLeft + ':' + secondsLeft);
                objectInstance.BigContainer.find('.sound-bar-content > .progress-sound').css('width', parseInt(event.jPlayer.status.currentPercentAbsolute, 10) + '%');
            },
            play: function(event) {

            },
            pause: function(event) {

            },
            ended: function(event) {
                objectInstance.PauseSong();

                if(objectInstance.CurrentTrackNumber == (objectInstance.TrackCount - 1))
                    objectInstance.PlaySong(0);
                else
                    objectInstance.PlaySong((parseInt(objectInstance.CurrentTrackNumber) + 1));
            },
            swfPath: swfPath,
            cssSelectorAncestor: "#" + objectInstance.PlayerContainerId,
            supplied: "mp3",
            wmode: "window"
        });
    },

    _setPlayerLoadingBar : function() {
        var objectInstance = this;

        this.BigContainer.find('.sound-bar-content').bind('click', function(event) {

            var container = jQuery(this),
                containerWidth = parseInt(container.width(), 10),
                containerClickPosition = (event.pageX - container.offset().left);

            var percent = parseInt(containerClickPosition/containerWidth * 100, 10);

            objectInstance.PlayerContainer.jPlayer('playHead', percent);

        });
    },

    SetSongAtIndexAsPlaying : function(songIndex) {
        var songInformation = this.TrackList[songIndex];

        this.PlayerContainer.jPlayer("setMedia", {
            mp3: songInformation.songPath
        });

        this.BigContainer.find('span.author').text(songInformation.authorName);
        this.BigContainer.find('span.song-name').text(songInformation.songName);
        this.BigContainer.find('img.feat-img').attr('src', songInformation.songImg);
        this.BigContainer.find('.content > .additional-buttons').html('');
        if(songInformation.soundcloud) {this.BigContainer.find('.content > .additional-buttons').append('<a href="'+ songInformation.soundcloud +'" target="_blank" title="Soundcloud"><i class="fa fa-cloud-download"></i></a>');}
        if(songInformation.beatport) {this.BigContainer.find('.content > .additional-buttons').append('<a href="'+ songInformation.beatport +'" target="_blank" title="Soundcloud"><i class="fa fa-headphones"></i></a>');}
        if(songInformation.itunes) {this.BigContainer.find('.content > .additional-buttons').append('<a href="'+ songInformation.itunes +'" target="_blank" title="Soundcloud"><i class="fa fa-apple"></i></a>');}
        if(songInformation.youtube) {this.BigContainer.find('.content > .additional-buttons').append('<a href="'+ songInformation.youtube +'" target="_blank" title="Soundcloud"><i class="fa fa-youtube-square"></i></a>');}

    },

    PlaySong : function(songIndex) {
        var songInformation = this.TrackList[songIndex];

        this.SetSongAtIndexAsPlaying(songIndex);
        this.CurrentTrackNumber = songIndex;

        this.PlayerContainer.jPlayer("setMedia", {
            mp3: songInformation.songPath
        });

        this.StartSong();
    },

    _pauseOtherPlayerComponentSongs : function() {
        var objectInstance = this,
            components = PlayersController._components;


        jQuery.each(components, function(key, component) {
            if(typeof component.player.PauseSong != "undefined"
                && component.id != objectInstance.ComponentId)
                component.player.PauseSong();
        })
    },

    StartSong : function() {
        this.Container.find('li.track').removeClass('active').find('.play-pause-button').removeClass('pause-playing');
        this.BigContainer.find('div.buttons > .play-pause').removeClass('play').addClass('pause');

        this.Container.find('li.track')
            .eq(this.CurrentTrackNumber)
            .addClass('active').find('.play-pause-button').addClass('pause-playing');

        this._pauseOtherPlayerComponentSongs();
        this.PlayerContainer.jPlayer("play");
    },

    PauseSong : function() {
        this.Container.find('li.track').removeClass('active').find('.play-pause-button').removeClass('pause-playing');
        this.BigContainer.find('div.buttons > .play-pause').removeClass('pause').addClass('play');

        this.PlayerContainer.jPlayer("pause");
    }

};


/* The simple player */
function AudioPlayer(info) {

    this.ComponentId        = 0;
    this.Container          = null;
    this.ContainerId        = null;
    this.PlayerContainer    = null;
    this.PlayerContainerId  = null;
    this.TrackList          = {};
    this.TrackCount         = 0;
    this.CurrentTrackNumber = 0;


    this.Container = info.container;
    this.ComponentId = info.id;

    if(!this.Container.hasAttr('id'))
        this.Container.attr('id', 'component-audio-player-' + this.ComponentId);

    this.ContainerId = this.Container.attr('id');

    this.Container.hide();
    this._setPlayer();
    this.Container.fadeIn('slow');

}

AudioPlayer.prototype = {

    constructor : AudioPlayer,

    _setPlayer : function() {
        this._setTrackList();
        this._definePlayerContainer();
        this._setPlayerInstance();
        this._setPlayerLoadingBar();
    },

    _setTrackList : function() {
        var objectInstance = this;

        this.Container.find('.track').each(function(index){
            objectInstance.TrackList[index] = {};
            objectInstance.TrackList[index].index = index;

            var attributes = jQuery(this).getAttributes();

            jQuery(this).attr('data-track-number', index);

            jQuery.each(attributes, function(key, value){
                if(key.startsWith('data-')) {
                    var theKey = key.substr(5).replace('-', ' ').ucwords().replace(' ', '');
                    theKey = theKey.charAt(0).toLowerCase() + theKey.substr(1);

                    objectInstance.TrackList[index][theKey] = value;
                }
            });

            objectInstance.TrackCount++;
        });
    },

    _definePlayerContainer : function() {
        this.PlayerContainerId = 'player-container-' + this.ContainerId;

        this.Container.before('<div id="' + this.PlayerContainerId + '"></div>');

        this.PlayerContainer = jQuery('#' + this.PlayerContainerId);
    },

    _setPlayerInstance : function() {
        var objectInstance = this;

        this.PlayerContainer.jPlayer({
            ready: function () {
                objectInstance.Container.find('.play-pause-button').bind('click', function(){
                    if(jQuery(this).hasClass('pause-playing'))
                        objectInstance.PauseSong();
                    else {
                        if(jQuery(this).parent('li').find('.name > .time-bar > span').width() != 0)
                            objectInstance.StartSong();
                        else
                            objectInstance.PlaySong(jQuery(this).parent('li').attr('data-track-number'));
                    }
                });
            },
            timeupdate: function(event) {
                var timeLeft = parseInt(event.jPlayer.status.duration, 10) - parseInt(event.jPlayer.status.currentTime, 10);

                if(timeLeft == 0)
                    timeLeft = parseInt(event.jPlayer.status.duration, 10);

                if(timeLeft == 0) {
                    objectInstance.Container.find('li.track').eq(objectInstance.CurrentTrackNumber).find('time').html('');
                    objectInstance.Container.find('li.track').eq(objectInstance.CurrentTrackNumber).find('.name > .time-bar > span').css('width', '0px');
                    return;
                }

                var minutesLeft = parseInt(timeLeft / 60),
                    secondsLeft = timeLeft % 60;

                secondsLeft = secondsLeft < 10 ? '0' + secondsLeft : secondsLeft;

                objectInstance.Container.find('li.track').eq(objectInstance.CurrentTrackNumber).find('time').html('- ' + minutesLeft + ':' + secondsLeft);

                objectInstance.Container.find('li.track').eq(objectInstance.CurrentTrackNumber).find('.name > .time-bar > span').css('width', parseInt(event.jPlayer.status.currentPercentAbsolute, 10) + '%');
            },
            play: function(event) {

            },
            pause: function(event) {

            },
            ended: function(event) {
                objectInstance.PauseSong();

                if(objectInstance.CurrentTrackNumber == (objectInstance.TrackCount - 1))
                {
                    objectInstance.PlaySong(0);
                }
                else
                {
                    objectInstance.PlaySong((parseInt(objectInstance.CurrentTrackNumber) + 1));
                }

            },
            swfPath: swfPath,
            cssSelectorAncestor: "#" + objectInstance.PlayerContainerId,
            supplied: "mp3",
            wmode: "window"
        });
    },

    _setPlayerLoadingBar : function() {
        var objectInstance = this;

        this.Container.find('.name').bind('click', function(event) {
            if(!(jQuery(this).parents('li:first').hasClass('active')))
                return;

            var container = jQuery(this),
                containerWidth = parseInt(container.width(), 10) - 40,
                containerClickPosition = (event.pageX - container.offset().left - 40);

            var percent = parseInt(containerClickPosition/containerWidth * 100, 10);

            objectInstance.PlayerContainer.jPlayer('playHead', percent);
        });
    },

    SetSongAtIndexAsPlaying : function(songIndex) {
        var songInformation = this.TrackList[songIndex];

        this.PlayerContainer.jPlayer("setMedia", {
            mp3: songInformation.songPath
        });
    },

    PlaySong : function(songIndex) {
        var songInformation = this.TrackList[songIndex];

        this.SetSongAtIndexAsPlaying(songIndex);
        this.CurrentTrackNumber = songIndex;

        this.PlayerContainer.jPlayer("setMedia", {
            mp3: songInformation.songPath
        });

        this.StartSong();
    },

    _pauseOtherPlayerComponentSongs : function() {
        var objectInstance = this,
            components = PlayersController._components;


        jQuery.each(components, function(key, component) {
            if(typeof component.player.PauseSong != "undefined"
                && component.id != objectInstance.ComponentId)
                component.player.PauseSong();
        })
    },

    StartSong : function() {
        this.Container.find('li.track').removeClass('active').find('.play-pause-button').removeClass('pause-playing');

        this.Container.find('li.track')
            .eq(this.CurrentTrackNumber)
            .addClass('active').find('.play-pause-button').addClass('pause-playing');

        this._pauseOtherPlayerComponentSongs();
        this.PlayerContainer.jPlayer("play");
    },

    PauseSong : function() {
        this.Container.find('li.track').removeClass('active').find('.play-pause-button').removeClass('pause-playing');

        this.PlayerContainer.jPlayer("pause");
    }

};


PlayersController.Init();
