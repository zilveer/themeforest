;(function($, undefined)
{
    // Early versions of android really mess up when they fake mouse events so as a temporary hack
    // we disregard the mouse on these devices.
    var ua = navigator.userAgent.toLowerCase();
    var isMobileAndroid = ((ua.indexOf("android") > -1) && (ua.indexOf("mobile") > -1));
    
    var
      
      p = 'swinxytouch',
      
      defaults =
      {
          preventDefault: true,
          stopPropagation: false
      },
      
      // New events we will be adding
      sxyEvents = ['sxy-focus', 'sxy-blur', 'sxy-hover', 'sxy-down', 'sxy-move', 'sxy-up'];
      
    /**
     * Quick way to get the TouchPad instance of an element or instantiate
     * if needed.
     * 
     * @param element e TouchPad will be attatched to this element
     * @param object o Each TouchPad is allowed to have it's own options by using the swinxytouch helper first
     * 
     * @return TouchPad
     */
    function getInstance(e, o)  
    {
        var
          t;
          
        return (!(t = $.data(e, p))) ? $.data(e, p, t = new TouchPad(e, o)) : t;
    }
    
    /**
     * Angle based on the coordinates of 2 points, each point
     * takes the form of {x:int, y:int}
     * 
     * @param object p1 
     * @param object p2
     * 
     * @return float Calculated angle in degrees, 0-360 but the starting orientation is left not up.
     */
    function angle(p1, p2)
    {
        var
          t;

        return (((t = Math.atan2((p1.y - p2.y), (p1.x - p2.x))) > 0) ? (t * (180 / Math.PI)) : ((2 * Math.PI + t) * (180 / Math.PI)) );
    }
    
    /**
     * Simple distance between the specified points, each point
     * takes the form of {x:int, y:int}
     * 
     * @param object p1
     * @param object p2
     * 
     * @return float
     */
    function distance(p1, p2)
    {
        var
          x = p1.x - p2.x,
          y = p1.y - p2.y
          
        return Math.sqrt((x * x) + (y * y));
    }

    /**
     *
     */
    function midpoint(p1, p2)
    {
        return { x: ((p1.x + p2.x) / 2), y: ((p1.y + p2.y) / 2) };
    }

    /**
     * Helper allowing gestures to be registered with jQuery events 
     * then hooked into an appropriate TouchPad as and when needed.
     *
     * @param string event The name people will use to hook into the gesture
     * @param object handler Gesture definition
     * @param object defaults User overridable object of default options the gesture uses
     * 
     * @return void
     */
    function gesture(event, handler, defaults)
    {
        $.event.special[event] =
        {
            setup: function()
            {
                var
                  tp = getInstance(this),
                  n,
                  h;
                  
                h = tp.g[event] = new handler(tp, (tp.options[event]) ? $.extend({}, defaults, tp.options[event]) : defaults );
                
                $.each(h, function(k, v)
                {
                    if (k.substr(0, 4) == 'sxy-')
                        tp.el.on(k, h[k])
                });
            },
            teardown: function()
            {
                var
                  tp = getInstance(this),
                  n,
                  h = tp.g[event];
 
                $.each(h, function(k, v)
                {
                    if (k.substr(0, 4) == 'sxy-')
                        tp.el.off(k, h[k])
                });

                tp.g[event] = null;
            }
        };
    }

    /**
     *
     */
    function helper(name, obj)
    {
        TouchPad.prototype[name] = function()
        {
            this.h[name] = new obj(this);
        }
    }

    /**
     * 
     */
    function TouchPad(element, options)
    {
        var
        
          s = this,
          eventType = 'sxy-hover',
          mouseState = {x: 0, y: 0, down: false, type: 0},
          handlers = [],
          eventMap = {},
          originalEvent;
        
        this.options = options = $.extend({}, defaults, (($.isPlainObject(options))?options:{}));
        
        this.el = $(element);
        this.pt = [];
        this.g  = {};
        this.h  = {};
        this.hasFocus = false;
        
        for (var i = 0; i < sxyEvents.length; ++i)
            eventMap[sxyEvents[i]] = [];


        // Mouse specific event handlers

        if (!isMobileAndroid)
        {
            listen('mouseenter', [0, 2, 4], function(e)
            {
                if (!s.hasFocus)
                    focus(mouse, e);
                
                eventType = 'sxy-hover';
                mouse(e);
            });
            
            // 
            listen('mouseleave', [1, 2, 5], function(e)
            {
                mouseState.down ? eventType = 'sxy-up' : eventType = 'sxy-hover';
                mouseState.down = false;
                mouse(e);

                blur(mouse, e);
            });
            
            listen('mousedown', [3, 4], function(e)
            {
                eventType = 'sxy-down';
                mouseState.down = true;
                mouse(e);
                
                eventType = 'sxy-move';
            });
            
            listen('mouseup', [0, 1, 2, 3, 4, 5], function(e)
            {
                eventType = 'sxy-up';
                mouseState.down = false;
                mouse(e);
                
                eventType = 'sxy-hover';
            });
            
            listen('mousemove', [2, 4], mouse);
        }
        
        // Touch specific event handlers

        listen('touchstart', [0, 1, 2, 3, 4, 5], function(e)
        {
            eventType = 'sxy-down';
            
            if (!s.hasFocus)
                focus(touch, e);
            
            touch(e);
            
            eventType = 'sxy-move';
        });

        listen('touchend', [0, 1, 2, 3, 4, 5], function(e)
        {
            eventType = 'sxy-up';
            
            originalEvent = e;
            
            var
              tt = e.originalEvent.targetTouches,
              ct = e.originalEvent.changedTouches,
              pt = s.pt = [];

            for (var i = 0, c = tt.length; i < c; ++i)
                pt.push({x: tt[i].pageX, y: tt[i].pageY, type: 1, down: true});

            for (var i = 0, c = ct.length; i < c; ++i)
                pt.push({x: ct[i].pageX, y: ct[i].pageY, type: 1, down: false});

            s.trigger(eventType);
            
            eventType = 'sxy-hover';
        });
        
        listen('touchmove', [0, 1, 2, 3, 4, 5], touch);
        
        // Focus specific touch event
        
        var touchFocusHandler = function(e)
        {
            var allUp = true, pt = s.pt;
            
            for (var i = 0, c = pt.length; i < c; ++i)
            {
                if (pt[i].down == true)
                {
                    allUp = false;
                    break;
                }
            }
                
            if (allUp)
                blur(touch, e);
        };
        
        /*
         * Public Methods
         */
        
        var createEvent = $.Event;
        
        this.trigger = function(type, data)
        {
            if (this.options.preventDefault)
                originalEvent.preventDefault();

            data = data || {};

            data.pointers      = s.pt;
            data.originalEvent = originalEvent;

            s.el.trigger(createEvent(type, data));
        }
        
        this.eventEnabler = function(event, state)
        {
            var
              t,
              e = eventMap[event],
              n = ((state) ? 1 : -1);

            for (var i = 0, c = e.length; i < c; ++i)
            {
                switch(((t = e[i]).l += n)) 
                {
                    case 0: t.el.off(t.e, t.hnd); break;
                    case 1: t.el.on(t.e, t.hnd); break;
                }
            }
        };
        
        /*
         * Private Methods
         */

        function focus(handler, event)
        {
            $(document).on('touchstart', touchFocusHandler);
            
            s.hasFocus  = true;
            eventType = 'sxy-focus';
            
            if (handler)
                handler(event);
            
            eventType = 'sxy-hover';
        }
        
        s.focus = focus;
        
        function blur()
        {
            $(document).off('touchstart', touchFocusHandler);

            s.hasFocus = false;
            eventType = 'sxy-blur';

            s.el.triggerHandler(eventType);
            eventType = 'sxy-hover';
        }
        
        s.blur = blur;
        
        function mouse(e)
        {
            originalEvent = e;
            
            mouseState.x = e.pageX;
            mouseState.y = e.pageY;

            s.pt = [mouseState];

            s.trigger(eventType);
        }

        function touch(e)
        {
            originalEvent = e;
            
            var
              tt = e.originalEvent.targetTouches,
              pt = s.pt = [];

            for (var i = 0, c = tt.length; i < c; ++i)
                pt.push({x: tt[i].pageX, y: tt[i].pageY, type: 1, down: true});

            s.trigger(eventType);
        }
        
        function listen(event, dependents, cb, el)
        {
            var
              h;

            handlers.push(h =
            {
                e: event,
                hnd: cb,
                l: 0,
                el: el || s.el
            });

            for (var i = 0, c = dependents.length; i < c; ++i)
                eventMap[sxyEvents[dependents[i]]].push(h);
        }
    }

    /*
     * All done with our definitions, time to do some plumbing in jQuery
     */

    // Register our custom events

    var

      touchSetupFactory = function(e)
      {
          return function() { getInstance(this).eventEnabler(e, true); };
      },
      touchTeardownFactory = function(e)
      {
          return function() { getInstance(this).eventEnabler(e, false); };
      };

    for (var i = 0, c = sxyEvents.length; i < c; ++i)
    {
        var e = sxyEvents[i];
        
        $.event.special[e] =
        {
            setup: touchSetupFactory(e),
            teardown: touchTeardownFactory(e)
        };
    }
    
    // Register the main helper for use with selectors
    
    $.fn[p] = function(method)
    {
        return this.each(function()
        {
            var tp = getInstance(this, method);
            
            if (method && tp[method])
            {
                tp[method].apply(tp, Array.prototype.slice.call(arguments, 1));
            }
        });
    };
    
    // Register the rest of our helpers
    
    $.fn[p].g = gesture;
    $.fn[p].d = distance;
    $.fn[p].a = angle;
    $.fn[p].h = helper;
    $.fn[p].m = midpoint;
})
(jQuery);


;(function($, undefined)
{
    var g = 'sxy-scale', p = 'swinxytouch';
    
    var defaults =
    {
        'minScale': 0.2
    }
    
    function ScaleGesture(tp, o)
    {
        var
        
          s = this,

          distance = $.fn[p].d,
          midpoint = $.fn[p].m,
          
          isScaling,
          startDistance,
          
          eventData = {};
        
        function trigger(e, state)
        {
            var
              pt = e.pointers,
              d  = distance(pt[0], pt[1]);
            
            eventData.state    = state;
            eventData.scale    = (d / startDistance);
            eventData.distance = (d - startDistance);
            eventData.position = midpoint(pt[0], pt[1]);
            
            tp.trigger(g, eventData);
        }

        s['sxy-down'] = function(e)
        {
            var
              pt = e.pointers;
            
            if (pt.length == 2)
            {
                isScaling = false;
                startDistance = distance({x:pt[0].x, y:pt[0].y}, {x:pt[1].x, y:pt[1].y});
            }
        };
            
        s['sxy-up'] = function(e)
        {
            if (isScaling)
                trigger(e, 3);
        };
        
        s['sxy-move'] = function(e)
        {
            var pt = e.pointers;
            
            if (pt.length == 2)
            {
                if (isScaling)
                {
                    trigger(e, 2);
                }
                else
                {
                    if (Math.abs(1 - (distance(pt[0], pt[1]) / startDistance)) > o.minScale)
                    {
                        isScaling = true;
                        trigger(e, 1);
                    }
                }
            }
        };
    }
    
    $.fn[p].g(g, ScaleGesture, defaults);
})
(jQuery);


;(function($, undefined)
{
    var g = 'sxy-tap', p = 'swinxytouch';
    
    var defaults =
    {
        'maxDelay': 150,
        'maxMove': 2
    }
    
    function TapGesture(tp, o)
    {
        var
        
          s = this,
          a = Math.abs,

          startTime,
          startPoint;
        
        s['sxy-down'] = function(e)
        {
            var pt = e.pointers;

            if (pt.length == 1)
            {
                startTime  = (new Date()).getTime();
                startPoint = {x: pt[0].x, y: pt[0].y};
            }
        };
            
        s['sxy-up'] = function(e)
        {
            var pt = e.pointers;

            if ((pt.length == 1) && (((new Date()).getTime() - startTime) < o.maxDelay) && (a(startPoint.x - pt[0].x) < o.maxMove) && (a(startPoint.y - pt[0].y) < o.maxMove))
                tp.trigger(g, {position: startPoint});
        };
    }
    
    $.fn[p].g(g, TapGesture, defaults);
})
(jQuery);

;(function($, undefined)
{
    var h = 'bound', p = 'swinxytouch';
    
    /**
     * 
     */
    function BoundHelper(tp)
    {
        var

          offset = tp.el.offset(),

          left   = offset.left,
          top    = offset.top,
          right  = left + tp.el.width(),
          bottom = top + tp.el.height();
         
        tp.el.on('sxy-hover sxy-down sxy-up sxy-move sxy-focus', function(e)
        {
            var p = e.pointers[0];

            if (p.y < top || p.x > right || p.y > bottom || p.x < left)
            {
                if (tp.hasFocus)
                    tp.blur();
            }
            else
            {
                if (!tp.hasFocus)
                {
                    tp.focus();
                    tp.el.trigger($.Event('sxy-focus', { pointers: e.pointers, originalEvent: e.originalEvent }));
                }
            }
        });
    }
    
    $.fn[p].h(h, BoundHelper);    
})
(jQuery);