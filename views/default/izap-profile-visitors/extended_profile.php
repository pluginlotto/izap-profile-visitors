<?php

$owner=elgg_get_page_owner_entity();
$visitor=elgg_get_logged_in_user_entity();
$object=new IzapProfileVisitors($owner,$visitor);
if($owner->guid!=$visitor->guid){
    $object->trackVisitors();

}