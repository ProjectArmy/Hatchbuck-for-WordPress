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
            <img src="<?php echo plugins_url( 'close.ico', __FILE__ ); ?>">
        </div>

        <form action="" method="post" id="hatchbuck_scroll-box" class="">
            <div>
                <div class="hb_scroll_box_div">
                    <p class="hb_title"><?php print $data['hb_title']; ?></p>
                </div>
                <div class="hb_scroll_box_div">
                    <p class="hb_desc"><?php print $data['hb_desc']; ?></p>
                </div>
                <div class="hb_scroll_box_div">
                            <input type="text" name="firstName" placeholder="First Name" value="">
                </div>
                <div class="hb_scroll_box_div">
                            <input type="text" name="lastName" placeholder="Last Name"  value="">
                </div>
                <div class=" hb_scroll_box_div">
                            <input type="email" name="email" placeholder="Email" value="">
                </div>
                <div class="hb_scroll_box_div">
                            <button onclick="hatchbuck_post()" type="button" class="hb_scroll_box_btn"><?php print $data['hb_btn_text']; ?></button>
                </div>
                <div class="hb_scroll_box_div" id="hatchbuck_scroll-box_result">
                </div>
                <div class="hb_scroll_box_div">
                            <p class="hb_text hb_powered_by">Powered by <a class="hb_btn_color" target="_blank" href="https://www.projectarmy.net/"><strong>ProjectArmy</strong></a></p>
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
                                $("#hatchbuck_scroll-box_result").height(70);
                                $("#hatchbuck_scroll-box_result").html(data);                                 
                                // p tag return from Ajax file
                                
                                $("#hatchbuck_scroll-box_result p").delay(3000).fadeOut( "slow" );
                                    
                                setTimeout(function(){
                                    $("#hatchbuck_scroll-box_result").height(0);

                                    if (data.search("<?php echo $data['hb_thank_you']; ?>") != -1) {
                                        $("#hatchbuck-slider").remove();
                                        createCookie("hatchbuck_subscribed", true, 1);
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
                $('#hatchbuck-slider').animate({
                    bottom: -400
                }, "fast");
                //reached = false;
            }
             
            function hb_isScrolledPercent(limit) {
                var wintop = $(window).scrollTop(), 
                docheight = $(document).height(), 
                winheight = $(window).height();
                var percent = (wintop/(docheight-winheight)) * 100;
                return (percent >= limit);
            }
     
    $(document).ready(function() {
            
            $(window).scroll(function() {
                if(hb_isScrolledPercent(triggerPercent)) {
                    if(!reached){			
                        $('#hatchbuck-slider').animate({
                            bottom: 0
                        }, "fast");
                        
                        reached = true;
                    }
                } 
                
                if(!hb_isScrolledPercent(triggerPercent)) {

                    //slide CTA off of screen
                    if(reached){
                        hb_closeBox();
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
        padding:0;
        margin: 0;
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
        z-index:9999;
    }
    
    .hatchbuck_error {
        font-family: 'Source Sans Pro', Helvetica, sans-serif;
        font-size: 14px;
        margin:0px !important;
        width:100%;
        color: red;
        border: 2px solid red;
        padding:5px;
    }
    .hatchbuck_info {
        font-family: 'Source Sans Pro', Helvetica, sans-serif;
        font-size: 14px
        margin:0px !important;
        width:100%;
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
    }
    
    .hb_scroll_box_div {
        margin:0px;
        padding: 0 10px 0 10px !important;
    }
    
    .hb_title {
        color: rgb(20, 20, 18);
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
        font-size: 14px;    
        margin: 10px 0 0 0;
        padding:0px;
    }
    
    .hb_scroll_box_div input {
        font-family: 'Source Sans Pro', Helvetica, sans-serif;
        font-size: 13px;  
        margin: 10px 0 0 0;
        padding:0 5px 0 5px;
        height: 40px;
        border: 3px solid #ddd;
        background-color: #eee;
        color: grey;
        width: 100%;
        border-radius: 2px;
    }
    
    .hb_scroll_box_div input:focus { 
        background-color: #f7f7f7;
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
    }
    
    .hb_scroll_box_btn:hover {
        opacity:0.8;
    }
    
    .hb_text {
        font-family: 'Source Sans Pro', Helvetica, sans-serif;
        font-size: 14px;
    }
    
    .hb_powered_by {
        font-family: 'Source Sans Pro', Helvetica, sans-serif;
        font-size: 12px; 
        margin-top:10px;
        text-align:center;        
    }
    
    .hb_powered_by a{
        color: <?php print $data['hb_btn_color']; ?> !important; 
    }
    </style>
    <?php    
}

?>