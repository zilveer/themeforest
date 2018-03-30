/**
 * ThemeFuse Events utility
 * provides some useful functionality to work with custom events
 */
var TFE = new (function()
{
    var $ = jQuery;

    /**
     * Element on what is added, removed and triggered custom events
     *
     * @private
     */
    var eventsBox = $('<div></div>');

    /**
     * Enable logging of what's happening inside class
     * if you want to debug, change this to true
     *
     * @public
     * @type {Boolean}
     */
    this.logsEnabled = false;

    /**
     * Log something
     *
     * @private
     * @param message Title for log
     * @param data Some data for debugging
     */
    this.log = function(message, data)
    {
        if (!this.logsEnabled) {
            return;
        }

        if (data !== undefined) {
            console.log('[TFE] ' + getIndentation()+ message, '◼', data);
        } else {
            console.log('[TFE] ' + getIndentation() + message);
        }
    };

    /**
     * Add event listener
     *
     * @public
     * @param event Custom event name (can be used with namespaces because internally it work with jQuery.on())
     * @param callback Function executed when event is triggered
     */
    this.on = function(event, callback)
    {
        eventsBox.on(event, callback);

        this.log('✚ '+ event);
    };

    /**
     * Same as .on(), but executed only once
     */
    this.one = function(event, callback)
    {
        eventsBox.one(event, callback);

        this.log('✚ '+ event);
    };

    /**
     * Remove event listener
     *
     * @public
     * @param event Name or Name.Namespace or .Namespace (like in jQuery.off())
     */
    this.off = function(event)
    {
        eventsBox.off(event);

        this.log('✖ '+ event);
    };

    /**
     * Trigger event
     *
     * @public
     * @param event
     * @param data Second parameter passed to listener (first parameter is event object, like in jQuery.trigger())
     */
    this.trigger = function(event, data)
    {
        data = data || {};

        this.log('╭╼▓ '+ event, data);

        changeIndentation(+1);

        try {
            eventsBox.trigger(event, data);
        } catch (e) {
            console.log('[TFE] Exception ', {exception: e});

            if (console.trace) {
                console.trace();
            }
        }

        changeIndentation(-1);

        this.log('╰╼░ '+ event, data);
    };

    /**
     * Return attached events
     *
     * @public
     * @return object|undefined
     */
    this.getAttachedEvents = function()
    {
        return $._data(eventsBox[0], 'events');
    };

    /**
     * If event triggered in process of triggering of another event
     * logs will be indented
     * @private
     */
    var getIndentation = function()
    {
        return new Array(currentIndentation).join('│   ');
    };
    var currentIndentation  = 1;
    var changeIndentation   = function(increment)
    {
        if (increment !== undefined) {
            currentIndentation += (increment > 0 ? +1 : -1);
        }

        if (currentIndentation < 0) {
            currentIndentation = 0;
        }
    };
})();