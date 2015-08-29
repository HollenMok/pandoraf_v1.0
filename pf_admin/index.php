<?php
//background administration system/后台管理员系统

$controller = $_GET['com'];
$task = $_GET['t'];
if($controller){
	require ROOT.'/pf_admin/pandoraf/components/com_'.$controller.'/'.$controller.'.php';
}else{
	require ROOT.'/pf_admin/pandoraf/components/com_index/index.php';
}

?>


