<?php
$data = get_option($scrollBoxKey);

function hb_condition_check() {
    global $data;
    if (is_user_logged_in() == true && isset($_COOKIE['hatchbuck_subscribed']))
        return 1;
    
    if (
        isset($_COOKIE['hatchbuck_subscribed']) ||
        !$data || 
        isset($data['hb_api_key']) && empty($data['hb_api_key']) || 
        isset($data['hb_tag_key']) && empty($data['hb_tag_key'])
    ) {
        return 0;
    }
    
    
    if (in_array('all-pages', $data['hb_show']) &&
        is_page() ||
        is_front_page() ||
        is_single()
        )
        return 1;

    if (in_array('no-pages', $data['hb_show']) &&
        is_front_page() == true
        )
        return 1;
    
    
    if (in_array('only-posts', $data['hb_show']) &&
        is_single() == true)
        return 1;
    
    if (in_array('only-pages', $data['hb_show']) && 
        is_page() ||
        is_front_page() &&
        is_single() == false
        )
        return 1;
    return 1;
    return 0;
}

add_action( 'wp_footer', 'hb_popup_html' );
add_action( 'wp_footer', 'hb_popup_css' );
add_action( 'wp_footer', 'hb_popup_js' );
add_action( "wp_ajax_nopriv_HatchbuckScrollBox", "hb_ajax_subscribe");
add_action( "wp_ajax_HatchbuckScrollBox", "hb_ajax_subscribe");

function hb_ajax_subscribe() {
    global $scrollBoxKey;
    require_once ('scroll-box-ajax.php');
    die(); //  otherwise it will print 0
}

function hb_popup_html() {
    if (!hb_condition_check()) return;
    global $data;
    ?>
    <div id="hatchbuck-slider">
        <div class="hb_close_btn" onclick="hb_closeBox();">
            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAABFFBMVEVMaXEAAAAAAAAAAABEQ0E+Qz1MTkxKSUkAAABGRkMICQkgICAAAAAJCQhGRkdHSUcJCglKTEpHSUQJCQlLUEsODg0GBwZVVVNXV1MNDQxWWlY1NjRqa2lhYmBaX1leYFxbXllTVlNaX1lVVlVZW1laXllZX1ozNDI1NTQ6OzleYF1gYF1wcW52d3NydXBYWVd3eXZ6end8fXp6e3h4eXWFh4KBgn9/gX17fXiHiYWEh4KFh4OOkIqPkIuPko2Qko2Rk46Rk4+TlJCTlJGVl5KWmJKYmpWZm5abnZibnpmdn5qen5udoJqeoJyfoJufoZyipJ6kpaClpqKkp6GmqKKmqKOnqaOoqqapqqaqq6e2uLO8vrdkKdc5AAAAPHRSTlMAAQIDAwMEBQgICQkJCgoOFhsbHyEoLzE2OFxfYWprbG1tbXBwcXF4en6nqK+xsrrFysrK0d3g4ufo6/RlLb4gAAAAjklEQVR42o3IVQ7CABRE0cHd3d3dXQu0uBbd/z5IeKT97YlM5kISdczz26gXJDSu6QCEmaaFQvl1rCsRZ59zGwVn+8SXEtvbKoI/e+tyfvDrNASq3maxT0LkH4xmw6JG+CmGm/QPXMMMEpxy14C1c2erBgqVzy4HOLrvpYuCL5+Bwgh3IasF0QNyyGCCJF+0FxHKKu8V2gAAAABJRU5ErkJggg==" alt="Close" width="16" height="16" />
        </div>

        <form action="" method="post" id="hatchbuck_scroll-box" class="">
            <div>
                <div class="hb_scroll_box_div">
                    <p class="hb_title"><?php print $data['hb_title']; ?></p>
                </div>
                <div class="hb_scroll_box_div">
                    <p class="hb_desc"><?php print $data['hb_desc']; ?></p>
                </div>
                <?php if($data['hb_first_name'] == 1): ?>
                <div class="hb_scroll_box_div">
                            <input type="text" name="firstName" placeholder="First Name" value="">
                </div>
                <?php endif; ?>
                <?php if($data['hb_last_name'] == 1): ?>
                <div class="hb_scroll_box_div">
                            <input type="text" name="lastName" placeholder="Last Name"  value="">
                </div>
                <?php endif; ?>
                <div class=" hb_scroll_box_div">
                            <input type="email" name="email" placeholder="Email" value="">
                </div>
                <div class="hb_scroll_box_div">
                            <button onclick="hatchbuck_post()" type="button" class="hb_scroll_box_btn"><?php print $data['hb_btn_text']; ?></button>
                </div>
                <div class="hb_scroll_box_div" id="hatchbuck_scroll-box_result">
                </div>
                <div class="hb_scroll_box_div">
                            <p class="hb_text hb_powered_by"><a target="_blank" href="https://www.projectarmy.net/" rel="external">Powered by ProjectArmy</a></p>
                </div>
            </div>
        </form>
    </div>
    <?php
}

function hb_popup_js() {
    if (!hb_condition_check()) return;
    global $data;
    ?>
    <script type="text/javascript">            
   
            function createCookie(name, value, days) {
                var expires;
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toGMTString();
                } else {
                    expires = "";
                }
                document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
            }
   
            function hatchbuck_post() {
                        
                        jQuery.ajax({   
                            type: "POST",
                            data : jQuery("#hatchbuck_scroll-box").serialize(),
                            cache: false,  
                            url: "<?php print admin_url('admin-ajax.php?action=HatchbuckScrollBox'); ?>",
                            success: function(data){
                                jQuery("#hatchbuck_scroll-box_result").css( "display", "block");
                                jQuery("#hatchbuck_scroll-box_result").height(70);
                                jQuery("#hatchbuck_scroll-box_result").html(data);                                 
                                // p tag return from Ajax file
                                
                                jQuery("#hatchbuck_scroll-box_result").delay(3000).fadeOut( "slow" );
                                    
                                setTimeout(function(){
                                    jQuery("#hatchbuck_scroll-box_result").height(0);

                                    if (data.search("<?php echo $data['hb_thank_you']; ?>") != -1) {
                                        jQuery("#hatchbuck-slider").remove();
                                        createCookie("hatchbuck_subscribed", true, 2);
                                        // 1 day;
                                    }
                                }, 4000);                                
                            }   
                        });   
                        return false;   
            }
            
            var triggerPercent = 50;
            var reached = false;
            
            function hb_closeBox() {
                createCookie("hatchbuck_subscribed", true, 2);
                
                jQuery('#hatchbuck-slider').animate({
                    bottom: (jQuery('#hatchbuck-slider').height() + 10) * -1
                }, "fast");
                
                jQuery("#hatchbuck-slider").remove();
                //reached = false;
            }
             
            function hb_isScrolledPercent(limit) {
                var wintop = jQuery(window).scrollTop(), 
                docheight = jQuery(document).height(), 
                winheight = jQuery(window).height();
                var percent = (wintop/(docheight-winheight)) * 100;
                return (percent >= limit);
            }
     
    //$(document).ready(function(){ 
    jQuery(document).ready(function(){
        
            jQuery('#hatchbuck-slider').css('bottom', (jQuery('#hatchbuck-slider').height() + 10) * -1);
        
            jQuery(window).scroll(function() {
                if(hb_isScrolledPercent(triggerPercent)) {
                    if(!reached){			
                        jQuery('#hatchbuck-slider').animate({
                            bottom: 0
                        }, "fast");
                        
                        reached = true;
                    }
                } 
                
                if(!hb_isScrolledPercent(triggerPercent)) {

                    //slide CTA off of screen
                    if(reached){
                        jQuery('#hatchbuck-slider').animate({
                            bottom: (jQuery('#hatchbuck-slider').height() + 10) * -1
                        }, "fast");
                        reached = false;
                    }
                }
            });
            
            
        });
    </script>    
    <?php    
}

function hb_popup_css() {
    global $data;
    if (!hb_condition_check()) return;
    ?>
    <style type="text/css">
    #hatchbuck-slider
    {
        padding: 0 20px 0 20px;
        margin: 0;
        position:fixed;
        bottom:-400px;
        right:0px;
        height: auto;
        width:350px;
        background-color: #f9f9f9;
		-moz-box-shadow: 0px 0px 3px #888;
		-webkit-box-shadow: 0px 0px 3px #888;
		box-shadow: 0px 0px 3px #888;
		z-index: 9999;
		border-top: 5px solid <?php print $data['hb_btn_color']; ?>;
		-webkit-border-top-left-radius: 5px;
		-moz-border-radius-topleft: 5px;
		border-top-left-radius: 5px;
    }
    
    .hatchbuck_error {
        font-family: 'Source Sans Pro', Helvetica, sans-serif;
        font-size: 14px;
        margin:0px !important;
        color: red;
        border: 2px solid red;
        padding:5px;
    }
    .hatchbuck_info {
        font-family: 'Source Sans Pro', Helvetica, sans-serif;
        font-size: 14px;
        margin:0px !important;
        color: green;
        border: 2px solid green;
        padding:5px;
    }
    
    .hb_close_btn {
        position:absolute;
        top:0;
        right:0;
        text-align:right;
    }
    
    .hb_close_btn img {
        width:16px;
        height:16px;
        margin: 5px;
    }
    
    .hb_close_btn img:hover {
        opacity:0.7;
		cursor: pointer;
    }
    
    .hb_scroll_box_div {
        margin:0px;
        padding: 0 10px 0 10px !important;
    }
    
    .hb_title {
        color: rgba(50,50,50,1);
        line-height:36px;
        font-size:24px;
        font-weight: bold;
        text-align:left;
        margin: 16px 0 0 0;
        padding:0px;
        font-family: 'Source Sans Pro', Helvetica, sans-serif;
    }
    
    .hb_desc {
        font-family: 'Source Sans Pro', Helvetica, sans-serif;
        font-size: 16px;
		margin: 10px 0 0 0;
		padding: 0px;
		color: #666;
    }
    
    .hb_scroll_box_div input {
        font-family: 'Source Sans Pro', Helvetica, sans-serif;
        font-size: 13px;  
        margin: 10px 0 0 0;
        padding:0 5px 0 5px;
        height: 40px;
        border: 2px solid #ddd;
        background-color: #eee;
        color: grey;
        width: 100%;
        border-radius: 2px;
    }
    
    .hb_scroll_box_div input:focus { 
        background-color: #f7f7f7;
		border-color: <?php print $data['hb_btn_color']; ?>;
    }
    
    
    .hb_scroll_box_btn {
        font-family: 'Source Sans Pro', Helvetica, sans-serif;
        font-size: 14px;
        margin: 10px 0 10px 0;
        padding: 0px;
        height: 40px;
        width: 100%;
        border: 1px solid <?php print $data['hb_btn_color']; ?>;
        border-radius: 5px !important;
        background:<?php print $data['hb_btn_color']; ?> !important;
		color: #fff;
    }
    
    .hb_scroll_box_btn:hover {
        opacity:0.8;
    }
    
    .hb_text {
        font-family: 'Source Sans Pro', Helvetica, sans-serif;
        font-size: 14px;
    }
    
    .hb_powered_by, .hb_powered_by a {
        font-family: 'Source Sans Pro', Helvetica, sans-serif;
        font-size: 12px; 
        margin-top:10px;
        text-align:center;  
		color: #999 !important;
		text-decoration: none !important;
    }
    </style>
    <?php    
}

?>