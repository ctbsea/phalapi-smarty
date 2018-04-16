#最新更新

	***支持自定义分隔符
	***修改目录统一小写

#基于PhalApi 2.*的Smarty拓展 

#本版本基于1.0 smarty 做的修改 我只是搬运工

![](http://webtools.qiniudn.com/master-LOGO-20150410_50.jpg)

##前言##
***先在这里感谢phalapi框架创始人@dogstar,为我们提供了这样一个优秀的开源框架.***

用过的童鞋都知道PhalApi是一个Api框架不提供view层的功能,但是很多童鞋有开发一个自己管理自己API的web界面的需求,或者是个人后台,那么是否意味着要去在学习另外一种框架来实现呢?**当然不是**在之前也有童鞋放出过一个View拓展,使用之后还是有一些不方便的地方,所以引入一个比较老牌的PHP模版引擎**Smarty**来解决这类问题,本拓展提供了对Smarty的封装,而且Smarty内容比较多在此处不会依依交与大家使用,希望的童鞋可以自己探索关于Smarty的功能,有不便之处需要封装与之联系!

**注:本拓展并没有开发完成,也没进行严格的测试,此版本为还处于开发阶段的鉴赏版.**

附上:

官网地址:[http://www.phalapi.net/](http://www.phalapi.net/ "PhalApi官网")

开源中国Git地址:[http://git.oschina.net/dogstar/PhalApi/tree/release](http://git.oschina.net/dogstar/PhalApi/tree/release "开源中国Git地址")

PhalApi Library:[http://git.oschina.net/dogstar/PhalApi-Library](http://git.oschina.net/dogstar/PhalApi-Library "PhalApi Library")

##安装  
composer.json添加

    "require": {
        "ctbsea/phalapi-smarty": "dev-master"
    },

##初始化Smarty

	//接受一个参数,参数为view的路径  定界符可以自己定义
	$di->smarty = new \ctbsea\phalapiSmarty\Lite('view',  '<{' , '}>');


现在我们就已经初始化好了PhalApi-Smarty

##一个简单的例子

我们在Default.Index接口中做如下修改:

	public function index() {

        $param = array(
            'name' => '喵咪',
            'list' => array(
                array(
                    "id"   => 1,
                    "name" => "test"
                ),
                array(
                    "id"   => 2,
                    "name" => "test2"
                )
            )
        );
        \PhalApi\DI()->smarty->setParams($param);
        \PhalApi\DI()->smarty->show();
    }

同时修改index.tpl:

    Hello <{$name}>, welcome to smarty<br/>

##其他

如果大家在使用IDE开发的时候嫌DI->smarty没有提示的话可以在如下目录加入此注释

	\PhalApi\PhalApi\DI.php

![](http://i.imgur.com/anwqdWh.png)

##总结

当前只是提供了一个简单的封装还有很多需要优化封装的功能其他各位小伙伴的补充.
