jQuery(document).ready(function($) {
  $('#signup-form').submit(function(){
    var data = {
      'action': 'subscribe',
      'name': $('.subscribe #name').val(),
      'lname': $('.subscribe #LastName').val(),
      'email': $('.subscribe #email').val()
    };

    // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
    $.post(ajaxurl, data, function(response) {
      if(response == 1){
        $('.subscribe #name').val('');
        $('.subscribe #LastName').val('');
        $('.subscribe #email').val('');
        $('.subscribe #status').
          html('Thank you for Subscribing! ').
          removeClass('danger').
          addClass('success');
      }else{
        $('.subscribe #status').
          html(response).
          removeClass('success').
          addClass('danger');
      }
    });
    return false;
  });
});

jQuery(document).ready(function() {
  var screen = '\
  <div class="noArrowdown hb-tab-market-help" id="screen-options-link-wrap">\
    <a class="show-settings" href="admin.php?page=hatchbuck-manage&hb-mh=1">Get Marketing Help &raquo;</a>\
  </div>\
';
  jQuery('#wpbody #screen-meta-links').prepend(screen);
	jQuery('.hb-tab-market-help').hide();
	var data = {
		'action': 'hb-screen-option'
	};
	jQuery.post(ajaxurl, data, function(response) {
		if (response == 1) {
			jQuery('.hb-tab-market-help').hide();
		} else {
			jQuery('.hb-tab-market-help').show();
		}
	});
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

function hatchbuck_modealLoad(){
	jQuery( '#itsec_intro_modal' ).dialog({
		dialogClass   : 'wp-dialog itsec-setup-dialog',
		modal         : true,
		closeOnEscape : false,
		title         : 'Request Your FREE Consultation',
		width         : '400px',
		resizable     : false,
		draggable     : false,
		close         : function ( event, ui ) {
			var data = {
				action : 'itsec_tooltip_ajax',
				module : 'close',
				nonce  : itsec_tooltip_text.nonce
			};

			//call the ajax
			jQuery.post( ajaxurl, data, function () {

				var url = window.location.href;
				console.log( url );
				url = url.substring( 0, url.lastIndexOf( "&" ) );

				window.location.replace( url );

			} );
		}
	});
}