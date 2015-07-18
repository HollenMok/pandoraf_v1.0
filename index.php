<?php
//-+---------------------------------------------------------------------------------------------+
//   A Simple and Innovative PHP Framework about Foreign Trade E-commerce @2015-07-01 Version 1.0 
//   一个简单和创新的PHP框架，为外贸电子商务开发， 始于中国共产党建党日,7月1日，版本1.0
//-+---------------------------------------------------------------------------------------------+
//   Update from/更新地址@https://github.com/HollenMok/pandoraf_v1.0 
//-+---------------------------------------------------------------------------------------------+
//   Display on/项目效果展示地址 @http://www.pandoraf.com
//-+---------------------------------------------------------------------------------------------+
//   Apache License/开源许可协议 @http://www.apache.org/licenses/LICENSE-2.0
//-+---------------------------------------------------------------------------------------------+
//   Document support multi-language, aim to invite people worldwide join this project 
//   文档目标是支持多语言，让全世界的人有机会了解并参加设计这个项目，目前只支持中文与英语。
//-+---------------------------------------------------------------------------------------------+


//check the PHP version, require PHP version more than 5.3.0/要求PHP版本大于5.3.0
if(version_compare(PHP_VERSION,'5.3.0','<'))
	die('require PHP version >5.3.0 !');

//start time/开始时间
$GLOBALS['startTime'] = microtime(TRUE);
//start memory used/开始使用内存
$GLOBALS['startMemoryUsed'] = memory_get_usage();

//root directory/根目录
define('ROOT',__DIR__);
//dispatch the core file/调用核心文件
require ROOT.'/pf_core/core.php';

?>




