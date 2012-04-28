<?php


$max = $vars['entity']->num_visits;
$max = ($max) ? $max : 5;

$guid = elgg_get_page_owner_guid();
if(!$guid) {
    $guid = elgg_get_logged_in_user_guid();
}

echo elgg_list_entities_from_metadata(array(
    'type' => 'object',
    'subtype' => GLOBAL_IZAP_VISITORS_SUBTYPE,
    'metadata_name' => 'visited',
    'metadata_value' => $guid,
    'limit' => $max,
    'pagination' => false
));