<?php

namespace Modules\main\Controllers;

use Modules\Users\Models\Users as UsersModel;
use Modules\Menu\Models\MenuRole as MenuModel;
use PhpParser\Node\Stmt\Echo_;

class Main extends \CodeIgniter\Controller
{
    public function index()
    {
        if (!session()->get('user_id')) {
            return redirect()->route('app-login');
        } else {
            $this->main(session()->get('rules'));
        }
    }

    public function getPage()
    {
        $data                   = $this->request->getPost();
        $module                 = explode('-', $data['menu']);
        $viewPath                = 'Modules\\' . $module[0] . '\Views\\' . $module[1];
        $operation['view']      = base64_encode((view($viewPath)));
        $operation['isLogin']   = (session()->get('user_id') != '') ? true : false;

        echo json_encode($operation);
    }

    protected function main($rules)
    {
        $html = '';
        $menus = $this->getMenuUser(session()->get('role_id'));
        foreach ($menus as $vRule) {
            if ($vRule['menu_hassub'] == 1) {
                $html .= '<div data-kt-menu-trigger="click" data-kt-menu-placement="right-start" data-kt-menu-flip="bottom" class="menu-item py-4">
                                <span class="menu-link menu-center " title="' . $vRule['menu_title'] . '" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                    <i class="menu-icon ' . $vRule['menu_icon'] . ' fa-lg " id="menu-icon_' . $vRule['menu_code'] . '"></i>
                                </span>';
                if ($vRule['child']) {
                    $html .=     '<div class="menu-sub menu-sub-dropdown w-225px px-1 py-4">
                                    <div class="menu-item">
                                        <div class="menu-content">
                                            <span class="menu-section fs-5 fw-bolder ps-1 py-1">' . $vRule['menu_title'] . '</span>
                                        </div>
                                    </div>';
                    foreach ($vRule['child'] as $menuChild) {
                        $html .= '<div class="menu-item">
                                        <a class="menu-link" href="javascript:void(0)" title="' . $menuChild['menu_title'] . '" data-isChild ="true" data-parent="' . $vRule['menu_code'] . '" data-menu="' . $menuChild['menu_code'] . '" onclick="HELPER.loadPage(this)" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                                            <span class="menu-title" id="menu-icon_' . $menuChild['menu_code'] . '"><i class="menu-icon ' . $menuChild['menu_icon'] . '"></i>' . $menuChild['menu_title'] . '</span>
                                        </a>
                                    </div>';
                    }
                    $html .= '</div>
                            </div>';
                }
            } else {
                $html .= '<div class="menu-item py-4">
                            <a class="menu-link menu-center" id="' . $vRule['menu_code'] . '" href="javascript:void(0)" title="' . $vRule['menu_title'] . '" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right" onclick="HELPER.loadPage(this)" data-menu="' . $vRule['menu_code'] . '">
                                <i class="menu-icon ' . $vRule['menu_icon'] . ' fa-lg" id="menu-icon_' . $vRule['menu_code'] . '"></i>
                            </a>
                            </div>';
            }
        }

        $data['menu'] = $html;
        $data['rules'] = session()->get('rules');
        echo view('../../modules/main/Views/main.php', $data);
    }

    protected function getRules($menu)
    {
        $search = explode('-', $menu);
        return $search;
    }

    protected function getMenuUser($role_id = null, $level = 1, $parent = null)
    {
        $data = (new MenuModel())->select([
            'filter' => [
                'role_id' => $role_id,
                'menu_active'  => 1,
                'menu_level'    => $level,
                'menu_parent'   => $parent
            ],
            'sort'   => 'menu_order asc'
        ]);

        $result = [];

        if ($data['total'] > 0) {
            foreach ($data['data'] as $k => $v) {
                $temp = $v;
                $temp['child'] = [];
                if ($v['menu_hassub'] == 1) {
                    $temp['child'] = $this->getMenuUser($role_id, ($level + 1), $v['menu_id']);
                }
                $result[] = $temp;
            }
        }
        return $result;
    }
}
