<?php

/**
 * controller for izap profile visitor
 */

class IzapVisitorController extends IzapController {

    public $owner;

    public function __construct($page) {
        parent::__construct($page);
    }

    /**
     * this is default page
     */
    public function actionIndex() {
        $this->actionAll();
    }

    /**
     * get all the entity
     * @global global var $CONFIG
     */
    public function actionAll() {
        global $CONFIG;
        
        $owner = elgg_get_page_owner_entity()->guid;
        if (!$owner)
            $owner = elgg_get_logged_in_user_entity ()->guid;
        $this->page_elements['buttons'] = '';
        $this->page_elements['filter'] = '';
        $this->page_elements['title'] = elgg_echo('izap-visitors:menu_title');

        $online_list = find_active_users(60, 9999);
        foreach ($online_list as $key => $val) {
            $return[] = $val->guid;
        }

        $CONFIG->IZAP_ONLINE_USERS = $return;
        $content = elgg_list_entities_from_metadata(array(
                    'type' => 'object',
                    'subtype' => GLOBAL_IZAP_VISITORS_SUBTYPE,
                    'metadata_name' => 'visited',
                    'metadata_value' => $owner,
                    'full_view' => false,
                ));

        $this->page_elements['content'] = $content;
        $this->drawpage();
    }

}

?>
