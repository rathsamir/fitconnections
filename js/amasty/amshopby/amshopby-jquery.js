function amshopby_slider_ui_update_values( prefix, values ,slider ) {
    var parent     = slider.parents('ol');
    var sliderFrom = parent.find('#' + prefix + '-from');
    var sliderTo   = parent.find('#' + prefix + '-to');

    if(sliderFrom && sliderTo){
        sliderFrom.html(values[0])
        sliderTo.html(values[1])
    }

    sliderFrom = parent.find('#' + prefix + '-from-slider');
    sliderTo   = parent.find('#' + prefix + '-to-slider');
    if(sliderFrom && sliderTo){
        sliderFrom.html(values.from)
        sliderTo.html(values.to)
    }
}

function amshopby_slider_ui_apply_filter( evt, values, slider) {
    if (evt && evt.type == 'keypress' && 13 != evt.keyCode)
        return;

    var prefix = 'amshopby-price';

    if (typeof(evt) == 'string'){
        prefix = evt;
    }
    if(prefix == 'amshopby-price-top'){
        prefix = 'amshopby-price';
    }
    var a = prefix + '-from';
    var b = prefix + '-to';

    //var url =  $amQuery('#' + prefix + '-url').val().replace(a, values[0]).replace(b, values[1]);
    var param = prefix.replace('amshopby-','')+'='+values.from+'-'+values.to;

    if(typeof  $amQuery('#layer-navigation-param').find('#' + prefix + '-param-input').html() != 'undefined'){
        $amQuery('#layer-navigation-param #' + prefix + '-param-input').val(param);
    }else{
        var html = '<input type="hidden" name="' + prefix + '" id="' + prefix + '-param-input" value="'+param+'"/>';
        $amQuery('#layer-navigation-param').append(html);
    }
    //amshopby_set_location(url);
}
function amshopby_slider_ui_init(from, to, max, prefix, min, step, uiParamElement) {

    var slider = $amQuery('#' + prefix + '-ui');
//    if(!slider || typeof slider == 'undefined'){
//        slider = $amQuery('#' + prefix + '-ui');
//    }


    from = from ? from : min;
    to = to ? to : max;

    if (slider) {
//        slider.slider({
//            range: true,
//            min: parseFloat(min),
//            max: parseFloat(max),
//            step: parseFloat(step),
//            values: [parseFloat(from), parseFloat(to)],
//            slide: function (event, ui) {
//                amshopby_slider_ui_update_values(prefix, ui.values, slider);
//            },
//            change: function (event, ui) {
//                if (ui.values[0] != from || ui.values[1] != to) {
//                    amshopby_slider_ui_apply_filter(prefix, ui.values, slider);
//                }
//            }
//        });

        $j('#' + prefix + '-ui').ionRangeSlider({
            type: "double",
            min:  parseFloat(min),
            max: parseFloat(max),
            from: parseFloat(from),
            to: parseFloat(to),
            onChange:  function (data) {
                if (data.from != from || data.to != to) {
                    amshopby_slider_ui_apply_filter(prefix, data, slider);
                }},
            onFinish:  function (data) {
                amshopby_slider_ui_update_values(prefix,data, slider);
            }
        });

    }
    if(from != min || to != max){
        if(prefix == 'amshopby-price-top'){
            prefix = 'amshopby-price';
        }
        var param = prefix.replace('amshopby-','')+'='+from+'-'+to;
        var html = '<input type="hidden" name="' + prefix + '" id="' + prefix + '-param-input" value="'+param+'"/>';
        $amQuery('#layer-navigation-param').append(html);
    }

}

function amshopby_jquery_init () {
    $amQuery('.amshopby-slider-ui-param').each(function() {
        var params = this.value.split(',');
        amshopby_slider_ui_init( params[0], params[1], parseInt(params[2]), params[3], parseInt(params[4]), params[5], this );
    });
}
function amshopby_checkbox_change (input) {
    var target = $amQuery(input);
    if($amQuery(input).is(':checked')){
        var html = '<input type="hidden" name="' + target.attr('id') + '" id="' +target.attr('id') + '-param-input" value="'+target.val()+'"/>';
        $amQuery('#layer-navigation-param').append(html);
    }else{
        $amQuery('#layer-navigation-param').find('#'+target.attr('id') + '-param-input').remove();
    };
}
(function ($) {
    $('document').ready(function () {
        amshopby_jquery_init();
        $('#layer-search-go').click(function(){
            var param = $('#layer-navigation-param').serializeArray();

            var url_link = '';
            var url_param ='';
            $.each(param, function(i, field) {
                if(field.name == 'main_url'){
                    url_link = field.value;
                }else{
                    url_param += field.value+'&';
                }
            });
            amshopby_set_location(url_link+'?'+url_param);
        });
    });
})($amQuery);