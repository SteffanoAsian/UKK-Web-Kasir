<?php

namespace Modules\Hakakses\Models;

class Hakakses extends \App\Core\BaseModel
{
    public function __construct()
    {
        $model = array(
            'table' => array(
                'name' => 'user_role',
                'primary' => 'user_role_id',
                'fields' => array(
                    array('name' => 'user_role_id', 'unique' => true),
                    array('name' => 'user_role_role_id'),
                    array('name' => 'user_role_menu_id'),
                )
            ),
            'view' => array(
                'name' => 'v_user_role',
                'mode' => array(
                    'datatable' => array(
                        'user_role_id',
                        'user_role_role_id',
                        'user_role_menu_id',
                    )
                )
            )
        );
        parent::__construct($model);
    }
}
