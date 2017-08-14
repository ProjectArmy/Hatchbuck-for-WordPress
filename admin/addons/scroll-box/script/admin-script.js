jQuery(document).ready(function ($) {    
    jQuery('.color-picker').iris();   
    jQuery( "<a href='#' title='Close' class='cp-close'>x</a>" ).prependTo( ".iris-picker-inner" );
    jQuery('.cp-close').click(function (e) {
        if (!jQuery(e.target).is(".color-picker, .iris-picker, .iris-picker-inner")) {
            jQuery('.color-picker').iris('hide');
            return false;
        }
    });
    jQuery('.color-picker').click(function (event) {
        jQuery('.color-picker').iris('hide');
        jQuery(this).iris('show');
        return false;
    });
});