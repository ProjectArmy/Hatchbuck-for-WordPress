var hb = jQuery.noConflict();
hb( document ).ready(function() {
    setTimeout(function(){ hb( "button.form-submit-button" ).prop('disabled', null); },5000);
    hb( "*[class*='required']" ).prop('required', 'required');
    
    //form counter
    if(window.location.href.indexOf("cnt=0") == -1){ 
        var fileref=document.createElement("script" ); 
        fileref.setAttribute("type","text/javascript");
        fileref.setAttribute("src", "https://app.hatchbuck.com/OnlineForm/counter.php?page=" + jQuery( "input:hidden[name=formID]").val());
        document.getElementsByTagName("head")[0].appendChild(fileref); 
    } 
});