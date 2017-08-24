#基于PhalApi 2.*的Smarty拓展

![](http://webtools.qiniudn.com/master-LOGO-20150410_50.jpg)

##前言##
***先在这里感谢phalapi框架创始人@dogstar,为我们提供了这样一个优秀的开源框架.***


借鉴于 第一个版本的 https://github.com/phalapi/phalapi-library/tree/master/Smarty

使用同第一个版本基本无差异

**注:本拓展并没有开发完成,也没进行严格的测试,此版本为还处于开发阶段的鉴赏版.**

附上:

官网地址:[http://www.phalapi.net/](http://www.phalapi.net/ "PhalApi官网")

开源中国Git地址:[http://git.oschina.net/dogstar/PhalApi/tree/release](http://git.oschina.net/dogstar/PhalApi/tree/release "开源中国Git地址")

PhalApi Library:[http://git.oschina.net/dogstar/PhalApi-Library](http://git.oschina.net/dogstar/PhalApi-Library "PhalApi Library")

##初始化Smarty

PhalApi-Smarty的初始化也和其他拓展一样,我们只需要把上方**PhalApi Library**中的Smarty文件目录放到需要用到的项目的拓展中即可.

但是view拓展和其他拓展有一些本质的区别就是需要有存放view页面的地方,这里使用一个干净的PhalApi项目进行演示,我们在public下创建如下结构

![](http://i.imgur.com/rTNjNgC.png)

然后我们在init末尾中加入如下代码:
	
	//接受一个参数,参数为view的路径
	$di->smarty = new \PhalApi\Smarty\Lite() ;

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
        DI()->smarty->setParams($param);
        DI()->smarty->show();
    }

同时修改index.tpl:

	<HTML>
	<HEAD>
	    <style type="text/css">
	        p,table{
	            margin: auto;
	            width: 60%;
	        }
	    </style>
	</HEAD>
	<BODY>
	Hello {$name}, welcome to smarty<br/>
	
	<table border="1">
	    {section name = sec loop = $list}
	        <tr>
	            <td>{$list[sec].id}</td>
	            <td>{$list[sec].name}</td>
	        </tr>
	    {/section}
	</table>
	
	</BODY>
	</HTML>


## 支持多命名空间

s=Hello.word

这个时候我们访问App.Hello.word接口(App默认是省略的)

访问的目录 src/app/View/Hello/word.tpl

s=User.Weibo.login
这个时候我们访问User.Hello.word接口 

访问的目录 src/user/View/Weibo/login.tpl

##其他

如果大家在使用IDE开发的时候嫌DI->smarty没有提示的话可以在如下目录加入此注释

	\PhalApi\PhalApi\DI.php

![](http://i.imgur.com/anwqdWh.png)

这样就可以看到如下效果

![](http://i.imgur.com/sGwfd3h.png)

##总结

当前只是提供了一个简单的封装还有很多需要优化封装的功能其他各位小伙伴的补充.
