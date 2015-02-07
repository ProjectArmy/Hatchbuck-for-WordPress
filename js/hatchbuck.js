jQuery( document ).ready( function () {
  var screen = '\
  <div class="noArrowdown hb-tab-market-help" id="screen-options-link-wrap">\
    <a class="show-settings" href="admin.php?page=hatchbuck-manage&hb-mh=1">Get Marketing Help &raquo;</a>\
  </div>\
';
  jQuery('#wpbody #screen-meta-links').prepend(screen);
});

jQuery(document).ready(function() {
  jQuery('#system_notice_area').animate({
    opacity : 'show',
    height : 'show'
  }, 500);

  jQuery('#system_notice_area_dismiss').click(function() {
    jQuery('#system_notice_area').animate({
      opacity : 'hide',
      height : 'hide'
    }, 500);

  });

});