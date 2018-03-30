/**
 * Created by pirates on 4/28/14.
 */

(function($){
    $(document).ready(function(){
        $(document).ajaxComplete(function(event, xhr, settings)
        {
            console.log(settings.data);
            var getData = settings.data, pattern =/widget-awew_advanced/g, myArray;
            myArray = getData.match(pattern);

            if (typeof myArray !='null' && typeof myArray != 'undefined')
            {
                colorPicker(".wo-color-picker");
            }


        })
        colorPicker(".wo-color-picker");
        function colorPicker(className)
        {
            if ($(className).length > 0)
            {
                $(className).wpColorPicker();
            }
        }
    })
})(jQuery)