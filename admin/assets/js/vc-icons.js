!function($) {
  if ( $('.vc_icons_type').val() != "" ) {
    $('.vc-icons-preview i').addClass($('.vc_icons_type').val()); 
  }

  $('body').on('click', '.vc-icons-wrap-inner a', function(e){
    e.preventDefault();
    var $this = $(this),
    icon_name = $this.children('i').attr('class');
    $('.vc-icons-wrap-inner a').removeClass('active');
    $this.addClass('active');
    $('.vc-icons-preview i').removeClass();
    $('.vc-icons-preview i').addClass(icon_name);
    //$('input[name="icon"]').val('&lt;i class=&quot;' + icon_name + '&quot;&gt;&lt;/i&gt;');
    $('input[name="icon"]').val(icon_name);
  });

  $('body').on('change keyup', '.vc-icon-searchbox', function(){
    var $this = $(this),
    filter = $this.val();
    if ( filter ) {
      $this.siblings('.vc-icons-wrap-inner').find('span:not(span[class*="' + filter + '"])').parent().hide();
      $this.siblings('.vc-icons-wrap-inner').find('span[class*="' + filter + '"]').parent().show();
    } else {
      $this.siblings('.vc-icons-wrap-inner a').show();
    }
  });

}(window.jQuery);

