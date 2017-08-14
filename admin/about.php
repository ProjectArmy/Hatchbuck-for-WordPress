<?php 
/*** Modal Pop Up ***/
add_thickbox(); 
?>
<div id="poststuff">
  <div id="post-body" class="metabox-holder columns-2">
    <div id="postbox-container-2" class="postbox-container">
      <div class="postbox">

        <h3 class="hndle"><span>Tutorials & Help</span></h3>
        <div class="inside">
        <div class="hb-inside-row">
            <div class="hb-col-3">
            <div id="hb-video-1" style="display:none;"><div style="padding-top:15px;"><iframe width="600" height="338" src="//www.youtube.com/embed/JcAxAiNuza0?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe></div></div>
            <a href="#TB_inline?width=600&height=365&inlineId=hb-video-1" class="thickbox"><img src="<?php echo plugin_dir_url(HATCHBUCK_PLUGIN_FILE).'/images/hb-tutorial-thumb.png'; ?>" alt="Getting Started with Hatchbuck for WordPress Plugin" /></a>
            <p>Learn how to setup and use Hatchbuck for WordPress plugin.</p>
            </div>
            <div class="hb-col-3">
            <div id="hb-video-2" style="display:none;"><div style="padding-top:15px;"><iframe width="600" height="338" src="//www.youtube.com/embed/GKpo2AM73GE?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe></div></div>
            <a href="#TB_inline?width=600&height=365&inlineId=hb-video-2" class="thickbox"><img src="<?php echo plugin_dir_url(HATCHBUCK_PLUGIN_FILE).'/images/hb-scroll-box-thumb.png'; ?>" alt="How to Set Up Scroll Box in Hatchbuck for WordPress Plugin" /></a>
            <p>Learn how to setup Scroll Box addon to build your email list.</p>
            </div>
            <div class="hb-col-3 hb-support-col">
                <p><h3>Get Support on WordPress.org</h3></p>
          <p>If you run into issues or need help with the plugin, submit your issue on WordPress.org forum with as many details as possible. We'll try to respond in a timely fashion.</p>
          <p><a class="button-primary" href="https://wordpress.org/support/plugin/hatchbuck" target="_blank">Visit Forum to Get Help &raquo;</a></p>    
                
            </div>
        </div>
        </div><!-- inside -->
      </div><!-- postbox -->
    </div><!-- postbox-container-2 -->


  <?php require( dirname( __FILE__ ) . '/sidebar.php' ); ?>

  </div><!-- postbody -->
</div><!-- poststuff -->
