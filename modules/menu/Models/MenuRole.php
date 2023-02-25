<?php

namespace Modules\Menu\Models;

class MenuRole extends \App\Core\BaseModel
{
    public function __construct()
    {
        $model = array(
            'table' => array(
                'name' => 'v_menu_role',
                'orderBy' => 'menu_order',
                'primary' => 'role_id',
                'fields' => array(
                    array('name' => 'role_id'),
                    array('name' => 'menu_id'),
                    array('name' => 'menu_code'),
                    array('name' => 'menu_title'),
                    array('name' => 'menu_parent'),
                    array('name' => 'menu_order'),
                    array('name' => 'menu_hassub'),
                    array('name' => 'menu_level'),
                    array('name' => 'menu_module'),
                    array('name' => 'menu_navbar'),
                    array('name' => 'menu_icon'),
                    array('name' => 'menu_description'),
                    array('name' => 'menu_active'),
                )
            ),
        );
        parent::__construct($model);
    }
    
}
