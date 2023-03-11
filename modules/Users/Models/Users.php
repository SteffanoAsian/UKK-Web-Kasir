<?php

namespace Modules\Users\Models;

class Users extends \App\Core\BaseModel
{
    public function __construct()
    {
        $model = array(
            'table' => array(
                'name' => 'user',
                'primary' => 'user_id',
                'fields' => array(
                    array('name' => 'user_id', 'unique' => true),
                    array('name' => 'user_name'),
                    array('name' => 'user_username'),
                    array('name' => 'user_role_id'),
                    array('name' => 'user_password'),
                    array('name' => 'user_status'),
                    array('name' => 'user_email'),
                )
            ), 'view' => array(
                'name' => 'v_user',
                'mode' => array(
                    'datatable' => array(
                        'user_id',
                        'user_name',
                        'user_username',
                        'role_nama',
                        'user_status',
                        'user_email',
                    )
                )
            )
        );
        parent::__construct($model);
    }
}
