<?php
/*
 * @desc background public data list model/后台公用数据列表模型
 * @author HollenMok
 * @date 2015/09/04
 * 
 */

class modTable{
	public $field_path = null; 
	public $data_tpl = 'web/libs/common_data.html';
	public $sql = null; 
	public $dbInstance;
	public $fields = null; 
	public function __construct(){
		require ROOT.'/pf_core/factory.php';
		$this->dbInstance = pFactory::dbInstance();
	}
	public function display(){
	    //Smarty engine/Smarty 引擎
		require ROOT.'/pf_core/smarty/libs/Smarty.class.php';
		$smarty = new Smarty();
		$table_fields =  $this->initSqlFields();
		$smarty->assign('table_fields',$table_fields);
		$data_list = $this->loadData();
		$smarty->assign('data_list',$data_list);
		if(0){
		$contents = $smarty->fetch($this->data_tpl);
		$result = array();
		$result['page'] = 1;
		$result['total_page'] = 2;
		$result['contents'] = $contents;
		echo json_encode($result);
		return; 
		}
		$smarty->display('web/table.html');exit;
	}
	
	
	public function initSqlFields(){
		require $this->field_path.'/fields.php';
		
		foreach ($fields as $field){
			$this->addFields($field['field']);
		}
		return $this->fields;
	}
	public function setComPath($path = null){
		$this->field_path = $path;
		return $this->field_path;
	}
	public function addFields($field){
		$fields = $this->fields; 
		$setField = array();
		$setField['field'] = $field;
		$fields[$field] = $setField;
		$this->fields = $fields;
	}
	public function loadData(){
		$sql = $this->initSql();
		$this->dbInstance->dbQuery($sql);
		$result = $this->dbInstance->getAll();
		return $result;
	}
	public function initSql(){
		return $this->sql; 
	}
	public function setSql($sql){
		$this->sql = $sql;
	}
}






