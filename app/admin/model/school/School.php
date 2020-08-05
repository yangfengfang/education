<?php

namespace app\admin\model\school;

use crmeb\traits\ModelTrait;
use crmeb\basic\BaseModel;

class School extends BaseModel
{
    /**
     * 数据表主键
     * @var string
     */
    protected $pk = 'id';

    /**
     * 模型名称
     * @var string
     */
    protected $name = 'school';

    use ModelTrait;

}