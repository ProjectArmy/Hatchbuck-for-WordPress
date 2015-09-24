<?php
$data = get_option($scrollBoxKey);

function hb_condition_check() {
    global $data;
    
    if (
        isset($_COOKIE['hatchbuck_subscribed']) ||
        !$data || 
        isset($data['hb_api_key']) && empty($data['hb_api_key']) || 
        isset($data['hb_tag_key']) && empty($data['hb_tag_key'])
    ) {
        return 0;
    }
    
    
    if (
            in_array('all-pages', $data['hb_show']) && (is_page() == true || is_front_page() == true) ||
            in_array('no-pages', $data['hb_show']) && (is_page() == false || is_front_page() == false) ||
            in_array('only-posts', $data['hb_show']) && is_single() == true &&
            in_array('only-pages', $data['hb_show']) && (is_page() == true || is_front_page() == true) && is_single() == false
    )
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
        <h4><?php print $data['hb_title']; ?></h4>
        <p><?php print $data['hb_desc']; ?></p>
        <form action="" method="post" id="hatchbuck_scroll-box">
            <table border=0>
                    <tr>
                        <td>
                            <input style="width:100%;" type="email" name="email" placeholder="Email" value="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input style="width:100%;" type="text" name="firstName" placeholder="First Name" value="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input style="width:100%;" type="text" name="lastName" placeholder="Last Name"  value="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input onclick="hatchbuck_post()" style="width:100%;" type="button" style="color:<?php print $data['hb_btn_color']; ?>" value="<?php print $data['hb_btn_text']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="width:100%;" id="hatchbuck_scroll-box_result"></div>
                        </td>
                    </tr>
            </table>

        </form>
    </div>
    <?php
}

function hb_popup_js() {
    if (!hb_condition_check()) return;
    global $data;
    ?>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
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
                        
                        $.ajax({   
                            type: "POST",
                            data : $("#hatchbuck_scroll-box").serialize(),
                            cache: false,  
                            url: "<?php print admin_url('admin-ajax.php?action=HatchbuckScrollBox'); ?>",
                            success: function(data){
                                $("#hatchbuck_scroll-box_result").html(data);                                 
                                $("#hatchbuck_scroll-box_result p").delay(3000).fadeOut( "slow" );
  
                                setTimeout(function(){
                                    if (data.search("<?php echo $data['hb_thank_you']; ?>") != -1) {
                                        $("#hatchbuck-slider").remove();
                                        createCookie("hatchbuck_subscribed", 1, 365);
                                    }
                                }, 4000);                                
                            }   
                        });   
                        return false;   
            }
    $(document).ready(function() {
                  
            function isScrolledPercent(limit) {
                var wintop = $(window).scrollTop(), 
                docheight = $(document).height(), 
                winheight = $(window).height();
                var percent = (wintop/(docheight-winheight)) * 100;
                return (percent >= limit);
            }
     
            var triggerPercent = 50;
            var reached = false;
            
            $(window).scroll(function() {
                if(isScrolledPercent(triggerPercent)) {
                    if(!reached){			
                        $('#hatchbuck-slider').animate({
                            bottom: 0
                        }, "fast");
                        
                        reached = true;
                    }
                } 
                
                if(!isScrolledPercent(triggerPercent)) {

                    //slide CTA off of screen
                    if(reached){
                        $('#hatchbuck-slider').animate({
                            bottom: -400
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
    if (!hb_condition_check()) return;
    ?>
    <style type="text/css">
    #hatchbuck-slider
    {
        padding-left:20px;
        position:fixed;
        bottom:-400px;
        right:0px;
        height:395px;
        width:350px;
        background-color:#fff;
        border-top:1px solid #000;
        border-left:1px solid #000;
        -moz-box-shadow:0px 0px 15px #888;
        -webkit-box-shadow:0px 0px 15px #888;
        box-shadow:0px 0px 15px #888;
    }
    
    .hatchbuck_error {
        width:100%;
        color: red;
        border: 2px solid red;
        padding:5px;
    }
    .hatchbuck_info {
        width:100%;
        color: green;
        border: 2px solid green;
        padding:5px;
    }
    </style>
    <?php    
}

?>