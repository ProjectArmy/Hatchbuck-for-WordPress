<?php 
add_action('admin_bar_menu', 'add_hatchbuck_menu', 100);
function add_hatchbuck_menu($admin_bar){
    $admin_bar->add_menu( array(
        'id'    => 'hatchback-parent',
        'title' => 'Hatchbuck',
        'href'  => '#',
        'meta'  => array(
            'title' => __('Quick way to access your Hatchbuck app.'),            
        ),
    ));
    $admin_bar->add_menu( array(
        'id'    => 'hb-dashboard',
        'parent' => 'hatchback-parent',
        'title' => 'Dashboard',
        'href'  => 'https://app.hatchbuck.com/Dashboard/Dashboard',
        'meta'  => array(
            'title' => __('Shortcut to Hatchbuck Dashboard page'),
            'target' => '_blank',
            'class' => 'hb_dashboard_menu_item'
        ),
    ));
    $admin_bar->add_menu( array(
        'id'    => 'hb-contacts',
        'parent' => 'hatchback-parent',
        'title' => 'Contacts',
        'href'  => 'https://app.hatchbuck.com/Contact/ContactList#1',
        'meta'  => array(
            'title' => __('Shortcut to Hatchbuck Contacts page'),
            'target' => '_blank',
            'class' => 'hb_contacts_menu_item'
        ),
    ));
	$admin_bar->add_menu( array(
        'id'    => 'hb-deals',
        'parent' => 'hatchback-parent',
        'title' => 'Deals',
        'href'  => 'https://app.hatchbuck.com/Deal/Deals',
        'meta'  => array(
            'title' => __('Shortcut to Hatchbuck Deals page'),
            'target' => '_blank',
            'class' => 'hb_deals_menu_item'
        ),
    ));
	$admin_bar->add_menu( array(
        'id'    => 'hb-tasks',
        'parent' => 'hatchback-parent',
        'title' => 'Tasks',
        'href'  => 'https://app.hatchbuck.com/Task/Task',
        'meta'  => array(
            'title' => __('Shortcut to Hatchbuck Tasks page'),
            'target' => '_blank',
            'class' => 'hb_tasks_menu_item'
        ),
    ));
	$admin_bar->add_menu( array(
        'id'    => 'hb-reports',
        'parent' => 'hatchback-parent',
        'title' => 'Reports',
        'href'  => 'https://app.hatchbuck.com/Report/EmailReport',
        'meta'  => array(
            'title' => __('Shortcut to Hatchbuck Reports page'),
            'target' => '_blank',
            'class' => 'hb_reports_menu_item'
        ),
    ));
}
?>