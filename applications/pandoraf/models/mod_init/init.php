<?php 
/**
 * --------------------------------------------------------------------------
* public model for initialization
* 初始化公用模型
* --------------------------------------------------------------------------
* @author HollenMok
* @date 2015-12-06
*/
class modInit{ 
	public function __construct(){
     require ROOT.'/applications/pandoraf/models/mod_init/initConfig.php';
     foreach ($initConfig as $ic){
     	echo $ic['name'];exit; 
     }
	}
}
	






