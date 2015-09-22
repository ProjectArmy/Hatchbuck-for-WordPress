<?php
$scrollBoxKey = 'hatchbuck_scroll-box_data';
$data = get_option($scrollBoxKey);
if (!$data) $data = array();
/*
if (
    in_array('all-pages') ||
    
    in_array('no-pages') && is_page() == false
    in_array('only-posts') && is_single() == true &&
    in_array('only-pages') && is_page() == true
)*/
add_action( 'wp_footer', 'hb_trigger_point' );
add_action( 'wp_footer', 'hb_popup_html' );
add_action( 'wp_footer', 'hb_popup_css' );
add_action( 'wp_footer', 'hb_popup_js' );

add_action("wp_ajax_nopriv_HatchbuckScrollBox", "hb_ajax_subscribe");

function hb_ajax_subscribe() {
    require_once ('scroll-box-ajax.php');
    die(); //  otherwise it will print 0
}

function hb_trigger_point() {
    ?>
    <div id="hatchbuck_popup_trigger"></div>
    <?php
}

function hb_popup_html() {
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
    ?>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script type="text/javascript">            
   
            function hatchbuck_post() {
                        
                        $.ajax({   
                            type: "POST",
                            data : $("#hatchbuck_scroll-box").serialize(),
                            cache: false,  
                            url: "<?php print admin_url('admin-ajax.php?action=HatchbuckScrollBox'); ?>",
                            success: function(data){
                                $("#hatchbuck_scroll-box_result").html(data); 
                                $("#hatchbuck_scroll-box_result p").delay(3000).fadeOut( "slow" );                                
                            }   
                        });   
                        return false;   
            }
    $(document).ready(function() {
       
            function isScrolledTo(elem) {
                var docViewTop = $(window).scrollTop(); //num of pixels hidden above current screen
                var docViewBottom = docViewTop + $(window).height();
     
                var elemTop = $(elem).offset().top; //num of pixels above the elem
                var elemBottom = elemTop + $(elem).height();
     
                return (elemTop <= docViewBottom); //if the bottom of the current viewing area is lower than the top of the trigger
            }
     
            var trigger = $('#hatchbuck_popup_trigger'); 	//set the trigger
            var reached = false;
            
            $(window).scroll(function() {
                if(isScrolledTo(trigger)) {
                    //slide CTA onto screen
                    if(!reached){			
                        $('#hatchbuck-slider').animate({
                            bottom: 0
                        }, "fast");
                        
                        reached = true;
                    }
                } 
                
                if (!isScrolledTo(trigger)) {
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