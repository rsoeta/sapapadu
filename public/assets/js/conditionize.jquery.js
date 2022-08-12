(function($) {
  $.fn.conditionize = function(options){

     var settings = $.extend({
        hideJS: true
    }, options );

    $.fn.doAction = function(status, $section, listenAction) {

      if( ! listenAction.length || jQuery.inArray('show', listenAction) > -1 ) {
        if(status) $section.slideDown();
        else $section.slideUp();
      }

      if( jQuery.inArray('require', listenAction) > -1 ) {
        if(status) $section.attr('required', 'required');
        else $section.removeAttr('required');
      }

      if( jQuery.inArray('enable', listenAction) > -1 ) {
        if(status) $section.removeAttr('disabled');
        else $section.attr('disabled', 'disabled');
      }

    }

    $.fn.showOrHide = function(listenTo, listenFor, $section, listenAction) {
      if ($(listenTo).is('select, input[type=text]') && $(listenTo).val() == listenFor ) {
        $.fn.doAction(true, $section, listenAction);
        return true;
      }
      else if ($(listenTo + ":checked").val() == listenFor) {
        $.fn.doAction(true, $section, listenAction);
        return true;
      }
      else {
        $.fn.doAction(false, $section, listenAction);
        return false;
      }
    }

    return this.each( function() {
      var listenTo = "[name=" + $(this).data('cond-option') + "]";
      var listenFor = $(this).data('cond-value');
      var listenForAlt = $(this).data('cond-value-alt');
      var listenAction = $(this).data('cond-action');

      listenAction = ( typeof listenAction == 'undefined') ? [] : listenAction.split('|');

      var $section = $(this);

      //Set up event listener
      $(listenTo).on('change', function() {
        var ret = $.fn.showOrHide(listenTo, listenFor, $section, listenAction);

        if( typeof listenForAlt != 'undefined' && !ret ) {
          $.fn.showOrHide(listenTo, listenForAlt, $section, listenAction);
        }
      });
      //If setting was chosen, hide everything first...
      if (settings.hideJS) {
        // $(this).hide();
      }
      //Show based on current value on page load
      var ret = $.fn.showOrHide(listenTo, listenFor, $section, listenAction);

      if( typeof listenForAlt != 'undefined' && !ret ) {
        $.fn.showOrHide(listenTo, listenForAlt, $section, listenAction);
      }
    });
  }
}(jQuery));
