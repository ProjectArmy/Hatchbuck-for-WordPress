<?php
function getFeed(){
  $url = 'https://www.projectarmy.net/feed/';
  $rss = fetch_feed($url);
  if(is_wp_error($rss)){
    return false;
  }
  $maxitems = $rss->get_item_quantity(5);
  $rss_items = $rss->get_items(0,$maxitems);
  $html = '<ul>';
  if($maxitems != 0){
    foreach($rss_items as $item){
      $html .= '<li><a href="'.esc_url($item->get_permalink()).'?utm_source=Blog%20Feed&utm_medium=Text%20Link&utm_campaign=HB%20for%20WP%20Plugin" target="_blank">'.esc_html($item->get_title()).'</a></li>';
    }
  }
  $html .= '</ul>';
  return $html;
}
?>

<div id="postbox-container-1" class="postbox-container">
   <div class="hatchbuck-training"><a href="https://edu.projectarmy.net/hatchbuck/?utm_source=Hatchbuck%20for%20WordPress%20plugin&utm_medium=Image%20Banner&utm_campaign=Plugin%20Training%20Banner" target="_blank"><img src="<?php echo plugins_url(basename(dirname(dirname(__FILE__))).'/images/hatchbuck-training.png')?>" alt="Go to free Hatchbuck and marketing training resources" /></a></div>
   <div class="postbox subscribe">
    <h3 class="hndle"><span>FREE Hatchbuck Insider Updates!</span></h3>
    <div class="inside">
        <form method="POST" accept-charset="utf-8" name="signup-form" id="signup-form">
         <p id="status" align="center"></p>
        <table>
          <tr>
            <td>First Name:</td>
            <td><input type="text" name="name" id="name"/></td>
          </tr>
          <tr>
            <td>Last Name:</td>
            <td><input type="text" name="lname" id="LastName"/></td>
          </tr>
          <tr>
            <td>Email</td>
            <td><input type="text" name="email" id="email"/></td>
          </tr>
        </table>
        <div style="margin-left:90px;"><input type="submit" value="Sign up now &raquo;" id="submit-btn"/></div> 
      </form>
    </div><!-- inside -->
  </div><!-- postbox -->
  
  <div class="postbox ">
    <h3 class="hndle"><span>ProjectArmy Blog</span></h3>
    <div class="inside">
      <?php echo getFeed(); ?>
    </div><!-- inside -->
  </div><!-- postbox -->
  
</div><!-- postbox-container-1 -->
