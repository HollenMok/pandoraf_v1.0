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
//   Document support multi-language, aim to invite people worldwide to join this project
//   文档目标是支持多语言，让全世界的人有机会了解并参加设计这个项目，目前只支持中文与英语。
//-+---------------------------------------------------------------------------------------------+

//factory pattern design/工厂设计模式 
class PFactory{
	
	public function __construct(){
		
	}
	
    /*
	* get database operation instance/获取数据库操作实例
	* @author HollenMok
	* @date 2015/08/01
	*/
	public static function dbInstance(){
		require ROOT.'/applications/pandoraf/install/config.php';
		$pConfig = new config();
		echo "<pre>";print_r($pConfig->connection);exit;  
	}
}