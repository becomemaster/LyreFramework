Project Name : Lyre Framework version 1.0
Author : 倾旋
------------------------------------------
介绍：
Lyre Framework 意为像“琴”一样的框架 | 解决单项目架构的难点、耗时、繁琐。 | 为开发者提供更美妙的音乐框架
    1.本框架采用“命名空间自动加载”技术以及配置文件分布式装载。
    2.引入THINK PHP框架的优点、体积小、运行快
    3.引入各类框架成熟的公共类,是框架变得更加丰富和多彩。
    4.开发者可以阅读本框架说明开发自己的公共类库进行导入。
    5.不需要考虑框架运行不了、项目上线调制。

目录结构:
├─Application       #项目目录
│  ├─Admin          #后台目录
│  │  ├─Controller  #后台控制器目录
│  │  ├─Model       #后台模型目录
│  │  └─View        #后台视图目录
│  ├─Cache  #模板缓存目录
│  ├─Compile#模板编译目录
│  ├─Config #项目配置文件目录
│  └─Home   #前台目录
│      ├─Controller #前台控制器目录
│      ├─Model      #前台模型目录
│      └─View       #前台视图目录
├─Error #服务器状态提示信息
├─Lyre  #框架核心目录
│  ├─Conf #框架全局配置目录
│  ├─Expand #框架扩展类目录
│  └─Kernel #框架控制器、模型、基础类目录
│      └─Smarty #Smarty 引擎
│          ├─plugins
│          └─sysplugins
└─Public #静态资源及插件目录
    ├─css       #CSS目录 内含bootstrap前端框架
    ├─fonts     #字体
    ├─images    #图片
    ├─js        #内含bootstrap前端框架JS 及 JQuery
    ├─plugins   #插件目录
    └─Upload    #上传目录


致谢：感谢朋友们的支持。

联系方式：payloads@aliyun.com


