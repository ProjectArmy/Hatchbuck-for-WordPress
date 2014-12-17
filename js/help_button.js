jQuery( document ).ready( function () {
  var screen = '\
  <div class="noArrowdown hb-tab-market-help" id="screen-options-link-wrap">\
    <a class="show-settings" href="admin.php?page=hatchbuck-manage&hb-mh=1">Get Marketing Help</a>\
  </div>\
';
  jQuery('#wpbody #screen-meta-links').prepend(screen);
});