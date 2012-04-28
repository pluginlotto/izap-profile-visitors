<?php

/**
 * this class is used to calculate the visitor of profile
 */
class IzapProfileVisitors {

  public $user;
  public $visitor;
  
/**
 *
 * @param ElggUser $user
 * @param ElggUser $visitor
 */
  public function __construct($user, $visitor) {

    $this->user = $user;
    $this->visitor = $visitor;
  }

  /**
   * tracking who is visiting the profile
   */
  public function trackVisitors() {

    $current_visitor = $this->getVisitor($this->visitor);
    $current_visitor_temp = new ElggObject($current_visitor->guid);
    $current_visitor_temp->access_id = ACCESS_LOGGED_IN;
    $current_visitor_temp->subtype = GLOBAL_IZAP_VISITORS_SUBTYPE;
    $current_visitor_temp->total_visits = (int) $current_visitor->total_visits + 1;
    $current_visitor_temp->title = $this->visitor->name . ' visited u ' . $current_visitor_temp->total_visits . ' times';
    $current_visitor_temp->description = $this->visitor->name;
    $current_visitor_temp->visited = $this->user->guid;

    $current_visitor_temp->save();
  }

  /**
   * @param ElggUse $visitor
   */
  public function getVisitor($visitor) {

    $returned_visitor = elgg_get_entities_from_metadata(array(
                'type' => 'object',
                'subtype' => GLOBAL_IZAP_VISITORS_SUBTYPE,
                'metadata_name' => 'visited',
                'metadata_value' => $this->user->guid,
                'container_guid' => $visitor->guid,
                'limit' => 1
            ));
    if ($returned_visitor)
      return $returned_visitor[0];
  }

}