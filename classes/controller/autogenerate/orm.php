<?php

class Controller_Autogenerate_Orm extends Controller_Template {

	public $template = 'autogenerate/index';
	
	public function action_index()
	{
		$view = new View('autogenerate/orm/index');
		$this->template->body = $view;
	}
	
	public function action_create()
	{
		$view = new View('autogenerate/orm/create');
		$view->className = $_POST['className'];
		
		$fields = explode(' ', $_POST['migrateFields']);
		
		foreach($fields as $field):
			if(strstr($field, 'belongs_to')):
				list($name, $model) = explode(':', str_replace('belongs_to:', '', $field));
				$view->belongs_to[$name] = array('model' => $model, 'foreign_key' => $model.'_id');
			endif;
			if(strstr($field, 'has_one')):
				list($name, $model) = explode(':', str_replace('has_one:', '', $field));
				$view->has_one[$name] = array('model' => $model, 'foreign_key' => strtolower($_POST['className']).'_id');
			endif;
			if(strstr($field, 'has_many')):
				list($name, $model) = explode(':', str_replace('has_many:', '', $field));
				$view->has_many[$name] = array('model' => $model, 'foreign_key' => strtolower($_POST['className']).'_id');
			endif;
		endforeach;
		
		$filename = APPPATH.'classes/model/'.strtolower($_POST['className']).'.php';
		$f = fopen($filename, 'w+');
		fwrite($f, $view->render());
		fclose($f);
		$this->request->redirect('autogenerate/orm/index');
	}

}