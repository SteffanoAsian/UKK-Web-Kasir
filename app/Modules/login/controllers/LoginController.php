<?php namespace BackEnd\Login\Controllers;

use BackEnd\Configuration\Models\Configuration;
use BackEnd\User\Models\User;

use App\Libraries\Parser;
use App\Libraries\Collection;

class LoginController extends \App\Core\BaseController
{
	/**
	 * @return view page login
	 * */
	public function index()
	{
        $configRecatcha = (new Configuration())->where(['config_group' => 'google_recaptcha'])->find();
        $collect        = new Collection($configRecatcha);
        $data = [
            'secretKey' => $collect->where('config_code', 'captcha.secretKey')->find()['config_value'],
            'siteKey'   => $collect->where('config_code', 'captcha.siteKey')->find()['config_value'],
        ];
		Parser::view('BackEnd\Login\Views\view_login', $data);
	}

    /**
     * @param array
     * @return response
     * */
	static function validateCaptcha($data)
    {
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $captcha = [
            'secret' => $data['secret'],
            'response' => $data['Captcha'],
            'remoteip' => $_SERVER['REMOTE_ADDR']
        ];

        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($captcha)
            ]
        ];

        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        return json_decode($response, true);
    }

    /**
     * action login
     * set session
     * @return array
     * */
    public function login()
    {
        $data = getPost();

        $validateForm = [
            'Email'     => 'required|valid_email',
            // 'Password'  => 'required', 
            'Captcha'   => 'required',
        ];

        if ($this->validate($validateForm)) {

            $dataConfig = (new Configuration())->whereIn('config_code',['captcha.secretKey','app.logo','app.setTitle'])->findAll();
            $collect    = new Collection($dataConfig);

            $data['secret']  =  $collect->where('config_code','captcha.secretKey')->first()['config_value'];
            $validateCaptcha = self::validateCaptcha($data);

            if ($validateCaptcha['success']) {
                
                $user = (new User())->where([
                    "user_email = BINARY '" . $data['Email'] . "'" => null,
                    'user_active'  => 1
                ])->first();

                if (password_verify($data['Password'], $user['user_password'])) {
                    session()->set([
                        'UserId'    => $user['user_id'],
                        'Fullname'  => $user['user_name'],
                        'Email'     => $user['user_email'],
                        'TypeModul' => 2,
                        'IsLogin'   => true,
                        'RoleId'    => $user['user_role_id'],
                        'Gender'    => ($user['user_gender'] == '1') ? 'Male' : 'Woman',
                        'Rules'     => $this->getRoles($user['user_id']),
                        'googleToken' => null,
                        'logo'      => '',//$collect->where('config_code','app.logo')->first()['config_value'],
                        'titleApp'  => '',//$collect->where('config_code','app.setTitle')->first()['config_value'],
                    ]);
                    $response = [
                        'success'   => true,
                        'message'   => 'login successfully',
                        'redirectTo'=> 'main'
                    ];
                } else {
                    $response = [
                        'success' => false,
                        'message' => 'Wrong username or password.'
                    ];
                }
            } else {
                $response = [
                    'success' => false,
                    'title' => 'Failed',
                    'message' => 'Captcha timeout or duplicate, Please reload your browser!'
                ];
            }
        }else{
            $response = [
                'success' => false,
                'message' => $this->validator->getErrors()
            ];
        }
        return $this->respond($response);
    }

    public function getRoles($userId)
    {
        $operation = (new User())->setView('v_role_menus')->setMode('roles')->where([
            'user_id' => $userId,
            'menu_code IS NOT NULL' => null,
        ])->findAll();

        return $operation;
    }

	public function logout()
	{

	}

}