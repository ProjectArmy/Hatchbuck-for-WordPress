<?php
$data = Array();
$data = get_option($scrollBoxKey);

if ($data == false) {
    // Default
    $data = Array();        // get_options will set it to false; re-init to array
    $data['hb_title']       = 'Sign Up for Free Updates!';
    $data['hb_desc']        = 'Receive free updates directly to your inbox.';
    $data['hb_thank_you']   = 'Thank you for signing up.';
    $data['hb_btn_text']    = 'Sign up now &raquo;';
    $data['hb_show_mobile'] = 0;
    $data['hb_api_key']     = "";
    $data['hb_btn_color']   = "#ff5936";
    $data['hb_tag_key']     = "";
    $data['hb_tag_name']    = "Scroll Box";
    
    $data['hb_show']        = Array('all-pages');
    $data['hb_first_name']     = 1;
    $data['hb_last_name']      = 1;
}

if ( isset( $_POST['hb_nonce'] ) && wp_verify_nonce( $_POST['hb_nonce'], 'hb_scroll_box_setting' )) {
    $data['hb_show']        = ($_POST['hb_show']) ? $_POST['hb_show'] : Array();
    $data['hb_title']       = $_POST['hb_title'];
    $data['hb_desc']        = $_POST['hb_desc'];
    $data['hb_thank_you']   = trim($_POST['hb_thank_you']);
    $data['hb_btn_text']    = $_POST['hb_btn_text'];
    $data['hb_btn_color']   = $_POST['hb_btn_color'];
    $data['hb_show_mobile'] = $_POST['hb_show_mobile'];
    $data['hb_api_key']     = $_POST['hb_api_key'];
    $data['hb_tag_key']     = $_POST['hb_tag_key'];
    $data['hb_tag_name']    = $_POST['hb_tag_name'];
    
    $data['hb_first_name']     = $_POST['hb_first_name'];
    $data['hb_last_name']     = $_POST['hb_last_name'];
    
    // $scrollBoxKey add in scroll-box.php
    if (get_option($scrollBoxKey) == $data || update_option($scrollBoxKey, $data)) {
        print " <div class='updated'>
                    <p>Settings saved successfully.</p>
                </div>
        ";        
    }
    else {
        print " <div class='error'>
                    <p>Failed to save settings.</p>
                </div>
        ";          
    }
}

if ($data && empty($data['hb_api_key']) || empty($data['hb_tag_key'])) {
    print " <div class='error'>
                <p>You will need to enter keys to show scroll box.</p>
            </div>
    ";     
}


 
require( plugin_dir_path(HATCHBUCK_PLUGIN_FILE) . 'admin/header.php'); 

?>
<div id="poststuff">
    <div id="post-body"  class="metabox-holder columns-2">

        <div id="postbox-container-2" class="postbox-container">
            <div class="postbox" style="max-width:600px;">

                <h3 class="hndle"><span>Scroll Box - Settings</span></h3>
                <div class="inside">
                    <form method="post">
                        <?php wp_nonce_field( 'hb_scroll_box_setting', 'hb_nonce' ); ?>

                            <table class="form-table" border=0>
                                    <tr>
                                        <td style="vertical-align:text-top;">
                                            Show scroll box on
                                        </td>
                                        <td>
                                            <input type="radio" <?php print (in_array('no-pages',$data['hb_show'])) ? "checked" : ""; ?> name="hb_show[]" value="no-pages">Only front page
                                            <br />
                                            <input type="radio" <?php print (in_array('all-pages',$data['hb_show'])) ? "checked" : ""; ?>  name="hb_show[]" value="all-pages">Pages and Posts
                                            <br />
                                            <input type="radio" <?php print (in_array('only-posts',$data['hb_show'])) ? "checked" : ""; ?>  name="hb_show[]" value="only-posts">Only Posts
                                            <br />
                                            <input type="radio" <?php print (in_array('only-pages',$data['hb_show'])) ? "checked" : ""; ?>  name="hb_show[]" value="only-pages">Only Pages
                                            <br />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:text-top;">Header title</td>
                                        <td>
                                            <input type="text" style="width:100%;" name="hb_title" value="<?php print $data['hb_title']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:text-top;">Description text</td>
                                        <td>
                                            <textarea style="width:100%;" name="hb_desc"><?php print $data['hb_desc']; ?></textarea>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:text-top;">Thank you text</td>
                                        <td>
                                            <textarea style="width:100%;" name="hb_thank_you"><?php print $data['hb_thank_you']; ?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:text-top;">Button text</td>
                                        <td>
                                            <input type="text" style="width:100%;" name="hb_btn_text" value="<?php print $data['hb_btn_text']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:text-top;">Button color</td>
                                        <td>         
                                            <input type="text" style="width:100%;" name="hb_btn_color" value="<?php print $data['hb_btn_color']; ?>" class="color-picker" />

                                        </td>
                                    </tr>
									<tr>
                                        <td style="vertical-align:text-top;">
                                            Ask for first and/or last name?
                                        </td>
                                        <td>
                                            <input type="checkbox" <?php print ($data['hb_first_name'] == 1) ? "checked" : ""; ?> name="hb_first_name" value="1">First Name
                                            <br />
                                            <input type="checkbox" <?php print ($data['hb_last_name'] == 1) ? "checked" : ""; ?>  name="hb_last_name" value="1">Last Name
                                            <br />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:text-top;">Show on mobile?</td>
                                        <td>
                                            <input type="radio" <?php print ($data['hb_show_mobile']) ? "checked" : ""; ?> name="hb_show_mobile" value="1"> Yes
                                            <br />
                                            <input type="radio" <?php print (!$data['hb_show_mobile']) ? "checked" : ""; ?> name="hb_show_mobile" value="0"> No
                                            <br />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:text-top;">Hatchbuck Tag Name</td>
                                        <td>
                                            <input type="text" style="width:100%;" name="hb_tag_name" value="<?php print $data['hb_tag_name']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:text-top;">Hatchbuck API Key</td>
                                        <td>
                                            <input type="text" style="width:100%;" name="hb_api_key" value="<?php print $data['hb_api_key']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:text-top;">Hatchbuck Tag Key</td>
                                        <td>
                                            <input type="text" style="width:100%;" name="hb_tag_key" value="<?php print $data['hb_tag_key']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="submit" class="button-primary" value="Save Settings">
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                            </table>
                    </form>
                </div>
            </div>
        </div>
        <?php require(  plugin_dir_path(HATCHBUCK_PLUGIN_FILE) . 'admin/sidebar.php'); ?>
    </div>
</div>
<?php require(  plugin_dir_path(HATCHBUCK_PLUGIN_FILE) . 'admin/footer.php'); ?>