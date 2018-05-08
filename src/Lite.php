<?php

namespace ctbsea\phalapiSmarty;

/**
 * Created by PhpStorm.
 * Author: yidiec
 * alert:  chentb
 * CreateTime: 2017/8/24 14:04
 * Description: 支持phalapi2.0
 * Versioncode: 2.0.0
 */
require_once(dirname(__FILE__) . '/Smarty/Smarty.class.php');

class Lite extends \Smarty
{

    //模板相对路径
    protected $p_dir = 'View';
    //视图类型
    protected $p_type = 'Default';
    //接口模块名称
    protected $module = "";
    //接口类名称
    protected $apiClassName = "";
    //接口名称
    protected $action = "";

    //目录根据s参数目录定位view的目录
    public function __construct($templateDir = "View" ,$leftDelimiter = '<{' ,$right_delimiter='}>')
    {
        $this->left_delimiter = $leftDelimiter; 
        $this->right_delimiter = $right_delimiter; 
        //获取模块名
        $service = \PhalApi\DI()->request->getService();
        list($this->module, $this->apiClassName, $this->action) = explode('.', $service);
        $this->module = strtolower($this->module);

        parent::__construct();
        if (!empty($templateDir)) {
            $this->p_dir = $templateDir;
        }
        if (!empty($this->apiClassName)) {
            $this->p_type = $this->apiClassName;
        }
        //只精确到view目录 不精确到具体的类和action
        $dir = array(API_ROOT . "/src/$this->module/$this->p_dir/");
        $this->setTemplateDir($dir);
        $this->setCompileDir(API_ROOT . "/runtime/template_c/");
    }

    /**
     * 注入参数
     */
    public function setParams($param = array())
    {

        foreach ($param as $k => $v) {
            $this->assign($k, $v);
        }
    }

    /**
     * 渲染模板
     *  如果$tpl 不为空 则应该输入全局路径
     */
    public function show($tpl = "")
    {
        if (!empty($tpl)) {
            $this->display($tpl);
        } else {
            $this->display(strtolower($this->apiClassName) .'/'.strtolower($this->action) . '.tpl');
        }
        exit();
    }

}
