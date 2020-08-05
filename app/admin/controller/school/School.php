<?php

namespace app\admin\controller\school;

use app\admin\controller\AuthController;
use crmeb\traits\CurdControllerTrait;
use app\admin\model\system\SystemCity as SystemCityModel;
use app\admin\model\school\School as SchoolModel;
use crmeb\services\{FormBuilder as Form, JsonService as Json, UtilService as Util};
use think\Request;
use think\facade\Route as Url;

class School extends AuthController
{
    use CurdControllerTrait;
 
    /**
     * 学校列表显示
     */
    public function index()
    {
        // 省份
        $this->assign('province', SystemCityModel::where('parent_id', '0')->field(['id', 'name'])->select());

        // $this->assign('pid', $this->request->get('province_id', 0));
        
        // $school = SchoolModel::select();
        // $this->assign('school', );
        // if($school->isEmpty()) echo 'yes';
        // return json(SystemCityModel::where('parent_id', '0')->field(['id', 'name'])->select());
        return $this->fetch();
        // return 'ok';
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $field = [
            Form::select('province_id', '省份')->setOptions(function () {
                $list = SystemCityModel::where('parent_id', '0')->field(['id', 'name'])->select();
                $menus = [['value' => 0, 'label' => '顶级菜单']];
                foreach ($list as $menu) {
                    $menus[] = ['value' => $menu['id'], 'label' => $menu['html'] . $menu['name']];
                }
                return $menus;
            })->filterable(1),
            Form::input('name', '学校名称'),
            Form::frameImageOne('image', '学校图标(180*180)', Url::buildUrl('admin/widget.images/index', array('fodder' => 'pic')))->icon('image')->width('100%')->height('500px'),
            // Form::content(),
            Form::number('sort', '排序'),
            Form::radio('status', '状态', 1)->options([['label' => '显示', 'value' => 1], ['label' => '隐藏', 'value' => 0]])
        ];
        $form = Form::make_post_form('添加学院', $field, Url::buildUrl('save'), 2);
        $this->assign(compact('form'));
        return $this->fetch('public/form-builder');
    }

    /**
     * 保存新建的资源
     *
     * @param \think\Request $request
     * @return \think\Response
     */
    // public function save(Request $request)
    // {
    //     $data = Util::postMore([
    //         'pid',
    //         'cate_name',
    //         ['pic', []],
    //         'sort',
    //         ['is_show', 0]
    //     ], $request);
    //     if ($data['pid'] == '') return Json::fail('请选择父类');
    //     if (!$data['cate_name']) return Json::fail('请输入分类名称');
    //     if (count($data['pic']) < 1) return Json::fail('请上传分类图标');
    //     if ($data['sort'] < 0) $data['sort'] = 0;
    //     $data['pic'] = $data['pic'][0];
    //     $data['add_time'] = time();
    //     CategoryModel::create($data);
    //     return Json::successful('添加分类成功!');
    // }

    /*
     *  异步获取分类列表
     *  @return json
     */
    public function category_list()
    {
        // $where = Util::getMore([
        //     ['is_show', ''],
        //     ['pid', $this->request->param('pid', '')],
        //     ['cate_name', ''],
        //     ['page', 1],
        //     ['limit', 20],
        //     ['order', '']
        // ]);
        // return Json::successlayui(CategoryModel::CategoryList($where));
    }


    /**
     * 学校添加
     */



}