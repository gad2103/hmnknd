!function($) {
  function range_slider_init() {

    $('.settings-slider').each( function(){ 
      var min, max, step, value;
      min = parseFloat($(this).data('slider-min'));
      max = parseFloat($(this).data('slider-max'));
      step = parseFloat($(this).data('slider-step'));
      value = parseFloat($(this).data('slider-value'));

      $(this).slider({
        min: min, 
        max: max,   
        step: step,
        value: value,
        slide: function( event, ui ){
          $(this).siblings('.range-input-selector').val(ui.value);
        }
      });
    });
  }
  range_slider_init();
}(window.jQuery);

