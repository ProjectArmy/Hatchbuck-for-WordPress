<?php
class pa_feed extends WP_Widget {
  var $url = 'https://www.projectarmy.net/feed/';

	// constructor
	function pa_feed() {
		parent::WP_Widget(false, $name = __('Project Army Blog Feed', 'pa_feed') );
	}

	// widget form creation
	function form($instance) {	
    echo '<br>Feed from <br><em>'.$this->url.'</em>';
    echo '<br><br>';
	}

	// widget update
	function update($new_instance, $old_instance) {
		/* ... */
	}

	// widget display
	function widget($args, $instance) {
    echo $this->getFeed();
	}
  
  function getFeed(){
    $url = $this->url;
		$rss = fetch_feed($url);
    if(is_wp_error($rss)){
      return false;
    }
    $maxitems = $rss->get_item_quantity(10);
    $rss_items = $rss->get_items(0,$maxitems);
    $html = '<ul>';
    if($maxitems != 0){
      foreach($rss_items as $item){
        $html .= '<li>'.esc_html($item->get_title()).'</li>';
      }
    }
    $html .= '</ul>';
    return $html;
  }
  
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("pa_feed");'));