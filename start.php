<?php

/**
 * Izap profile visitor plugin
 * This plugin allow the user to check who visited their profile and how many times.
 */
define('GLOBAL_IZAP_VISITORS_PLUGIN', 'izap-profile-visitors');
define('GLOBAL_IZAP_VISITORS_SUBTYPE', 'izap_visitor');
define('GLOBAL_IZAP_VISITORS_PAGEHANDLER', 'visitor');

elgg_register_event_handler('init', 'system', 'visitor_init');

function visitor_init() {

  //plugin initialisation through izap elgg bridge
  izap_plugin_init(GLOBAL_IZAP_VISITORS_PLUGIN);

  //registration of page handler
  elgg_register_page_handler(GLOBAL_IZAP_VISITORS_PAGEHANDLER, GLOBAL_IZAP_PAGEHANDLER);

  //registration of widget for profile visitor plugin
  elgg_register_widget_type('izap-profile-visitors', elgg_echo('izap-profile-visitors:widget_name'),
          elgg_echo('izap-profile-visitors:widget:description'), 'profile');

  elgg_register_event_handler('izap', 'link', 'izap_profile_visitor_link_hook');
  
  //extending profile plugin's owner_block view
  elgg_extend_view('profile/owner_block', GLOBAL_IZAP_VISITORS_PLUGIN . '/extended_profile');
  $item = new ElggMenuItem('visitors', elgg_echo('izap-visitors:menu_title'), 'pg/' .
                  GLOBAL_IZAP_VISITORS_PAGEHANDLER . '/');

  //registring menu item
  elgg_register_menu_item('site', $item);
  
}

function izap_profile_visitor_link_hook() {
  if (elgg_get_context() == GLOBAL_IZAP_VISITORS_PAGEHANDLER) {
    elgg_extend_view('page/elements/footer', 'output/ilink');
    return False;
  }
  return True;
}