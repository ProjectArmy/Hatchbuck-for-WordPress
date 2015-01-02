<?php
function getFeed(){
  $url = 'https://www.projectarmy.net/feed/';
  $rss = fetch_feed($url);
  if(is_wp_error($rss)){
    return false;
  }
  $maxitems = $rss->get_item_quantity(10);
  $rss_items = $rss->get_items(0,$maxitems);
  $html = '<ul>';
  if($maxitems != 0){
    foreach($rss_items as $item){
      $html .= '<li><a href="'.esc_url($item->get_permalink()).'" target="_blank">'.esc_html($item->get_title()).'</a></li>';
    }
  }
  $html .= '</ul>';
  return $html;
}
?>

<div id="postbox-container-1" class="postbox-container">
   <div class="hatchbuck-training"><a href="https://edu.projectarmy.net/hatchbuck/?utm_source=Hatchbuck%20for%20WordPress%20plugin&utm_medium=Image%20Banner&utm_campaign=Plugin%20Training%20Banner" target="_blank"><img src="<?php echo plugins_url(basename(dirname(dirname(__FILE__))).'/images/hatchbuck-training.png')?>" alt="Go to free Hatchbuck and marketing training resources" /></a></div>
   <div class="postbox ">
    <h3 class="hndle"><span>Title Sidebar 1</span></h3>
    <div class="inside">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla rutrum, massa eu imperdiet porttitor, metus augue tempor tortor, non iaculis ante ligula eget mauris. Nam tempor, elit ut tristique pellentesque, velit nulla volutpat felis, vitae vestibulum mi purus at nisi. Pellentesque tristique facilisis risus, eget tristique dui. In turpis ligula, rhoncus in euismod ut, ullamcorper vitae sapien. Pellentesque sed quam dignissim, cursus sapien vitae, scelerisque ante. Ut sit amet placerat ligula, a feugiat lectus. Suspendisse suscipit egestas metus sit amet cursus
    </div><!-- inside -->
  </div><!-- postbox -->
  
  <div class="postbox ">
    <h3 class="hndle"><span>Project Army Blog Feed</span></h3>
    <div class="inside">
      <?php echo getFeed(); ?>
    </div><!-- inside -->
  </div><!-- postbox -->
  
</div><!-- postbox-container-1 -->
