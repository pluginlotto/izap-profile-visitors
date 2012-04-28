<?php

global $CONFIG;
$visitor = $vars['entity'];
$icon = elgg_view_entity_icon($visitor->getownerentity(), 'small');
$text = $visitor->title;
if (in_array($visitor->getownerentity()->guid, $CONFIG->IZAP_ONLINE_USERS))
  echo '<img src=' . $vars['url'] . 'mod/izap-profile-visitors/_graphics/online.jpg align=right alt="o1121212132132line" title="Online">';
echo elgg_view_image_block($icon, $text);
