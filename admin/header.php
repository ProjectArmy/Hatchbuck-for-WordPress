<div id="screen-meta-links">
  <!--<div class="" id="screen-options-link-wrap">
    <a aria-expanded="false" aria-controls="screen-options-wrap" class="show-settings" id="show-settings-link" href="#screen-options-wrap">Screen Options</a>
  </div>-->
  <div class="noArrowdown" id="screen-options-link-wrap">
    <a class="show-settings" href="admin.php?page=hatchbuck-manage&hb-mh=1">Get Marketing Help</a>
  </div>
</div>

<?php 
  $pageName = 'Form';
  $page = 'hatchbuck-manage';
  if (isset($_GET)) {
    if ($_GET['page'] == 'hatchbuck-settings') {
      $pageName = 'Settings';
      $page = 'hatchbuck-settings';
    } elseif ($_GET['page'] == 'hatchbuck-help') {
      $pageName = 'Help';
      $page = 'hatchbuck-help';
    }
  }
?>

<div class="wrap">
  <h2><?php echo PLUGIN_NAME; ?> - <?php echo $pageName; ?></h2>

  <h2 class="nav-tab-wrapper">
    <a href="?page=hatchbuck-manage" class="nav-tab <?php echo ($page == 'hatchbuck-manage')?'nav-tab-active':''; ?>">Forms</a><a href="?page=hatchbuck-settings" class="nav-tab <?php echo ($page == 'hatchbuck-settings')?'nav-tab-active':''; ?>">Settings</a><a href="?page=hatchbuck-help" class="nav-tab <?php echo ($page == 'hatchbuck-help')?'nav-tab-active':''; ?>">Help</a>
  </h2>