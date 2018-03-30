(function(){(function(a){a.easyPieChart=function(c,k){var e,f,h,i,j,d,b,g=this;this.el=c;this.$el=a(c);this.$el.data("easyPieChart",this);this.init=function(){var l;g.options=a.extend({},a.easyPieChart.defaultOptions,k);l=parseInt(g.$el.data("percent"),10);g.percentage=0;g.canvas=a("<canvas width='"+g.options.size+"' height='"+g.options.size+"'></canvas>").get(0);g.$el.append(g.canvas);if(typeof G_vmlCanvasManager!=="undefined"&&G_vmlCanvasManager!==null){G_vmlCanvasManager.initElement(g.canvas)}g.ctx=g.canvas.getContext("2d");if(window.devicePixelRatio>1.5){a(g.canvas).css({width:g.options.size,height:g.options.size});g.canvas.width*=2;g.canvas.height*=2;g.ctx.scale(2,2)}g.ctx.translate(g.options.size/2,g.options.size/2);g.$el.addClass("easyPieChart");g.$el.css({width:g.options.size,height:g.options.size,lineHeight:""+g.options.size+"px"});g.update(l);return g};this.update=function(l){if(g.options.animate===false){return h(l)}else{return f(g.percentage,l)}};d=function(){var m,n,l;g.ctx.fillStyle=g.options.scaleColor;g.ctx.lineWidth=1;l=[];for(m=n=0;n<=24;m=++n){l.push(e(m))}return l};e=function(l){var m;m=l%6===0?0:g.options.size*0.017;g.ctx.save();g.ctx.rotate(l*Math.PI/12);g.ctx.fillRect(g.options.size/2-m,0,-g.options.size*0.05+m,1);return g.ctx.restore()};b=function(){var l;l=g.options.size/2-g.options.lineWidth/2;if(g.options.scaleColor!==false){l-=g.options.size*0.08}g.ctx.beginPath();g.ctx.arc(0,0,l,0,Math.PI*2,true);g.ctx.closePath();g.ctx.strokeStyle=g.options.trackColor;g.ctx.lineWidth=g.options.lineWidth;return g.ctx.stroke()};j=function(){if(g.options.scaleColor!==false){d()}if(g.options.trackColor!==false){return b()}};h=function(l){var m;j();g.ctx.strokeStyle=a.isFunction(g.options.barColor)?g.options.barColor(l):g.options.barColor;g.ctx.lineCap=g.options.lineCap;g.ctx.lineWidth=g.options.lineWidth;m=g.options.size/2-g.options.lineWidth/2;if(g.options.scaleColor!==false){m-=g.options.size*0.08}g.ctx.save();g.ctx.rotate(-Math.PI/2);g.ctx.beginPath();g.ctx.arc(0,0,m,0,Math.PI*2*l/100,false);g.ctx.stroke();return g.ctx.restore()};f=function(p,o){var m,n,l;n=30;l=n*g.options.animate/1000;m=0;g.options.onStart.call(g);g.percentage=o;if(g.animation){clearInterval(g.animation);g.animation=false}return g.animation=setInterval(function(){g.ctx.clearRect(-g.options.size/2,-g.options.size/2,g.options.size,g.options.size);j.call(g);h.call(g,[i(m,p,o-p,l)]);m++;if((m/l)>1){clearInterval(g.animation);g.animation=false;return g.options.onStop.call(g)}},1000/n)};i=function(n,m,q,o){var l,p;l=function(r){return Math.pow(r,2)};p=function(r){if(r<1){return l(r)}else{return 2-l((r/2)*-2+2)}};n/=o/2;return q/2*p(n)+m};return this.init()};a.easyPieChart.defaultOptions={barColor:"#ef1e25",trackColor:"#f2f2f2",scaleColor:"#dfe0e0",lineCap:"round",size:110,lineWidth:3,animate:false,onStart:a.noop,onStop:a.noop};a.fn.easyPieChart=function(b){return a.each(this,function(d,e){var c;c=a(e);if(!c.data("easyPieChart")){return c.data("easyPieChart",new a.easyPieChart(e,b))}})};return void 0})(jQuery)}).call(this);

jQuery(window).load(function(){
    jQuery('.graph-circle').each(function(){
     var $t = jQuery(this);
        var scaleColor = $t.attr('data-scalecolor');
        var trackColor = $t.attr('data-trackcolor');

        $t.easyPieChart({
        animate: $t.attr('data-animate'),
        barColor: $t.attr('data-barcolor'),
        trackColor: trackColor,
        scaleColor: scaleColor == 'false'?false:scaleColor,
        lineCap: $t.attr('data-linecap'),
        lineWidth: $t.attr('data-linewidth'),
        size: $t.attr('data-size')
        });
    });
    
});