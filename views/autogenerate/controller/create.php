<?php echo '<?php'; ?>

class Controller_<?php echo $className; ?> extends Controller_Template {

	public $template = 'index';
	
	public function action_index()
	{
		$view = new View('<?php echo strtolower($className); ?>/index');
		
		$view-><?php echo Inflector::plural(strtolower($className)); ?> = ORM::factory('<?php echo strtolower($className); ?>')->find_all();
		
		$this->template->body = $view;
	}
	
	public function action_new()
	{
		$view = new View('<?php echo strtolower($className); ?>/new');
		
		$this->template->body = $view;
	}
	
	public function action_create()
	{
		$<?php echo strtolower($className); ?> = ORM::factory('<?php echo strtolower($className); ?>');
		
		$<?php echo strtolower($className); ?>->save();
		
		$this->request->redirect('<?php echo strtolower($className); ?>/new');
	}
	
	public function action_show()
	{
		$view = new View('<?php echo strtolower($className); ?>/show');
		
		$view-><?php echo strtolower($className); ?> = ORM::factory('<?php echo strtolower($className); ?>', $this->request->param('id'));
		
		$this->template->body = $view;
	}
	
	public function action_edit()
	{
		$view = new View('<?php echo strtolower($className); ?>/edit');
		
		$view-><?php echo strtolower($className); ?> = ORM::factory('<?php echo strtolower($className); ?>', $this->request->param('id'));
		
		$this->template->body = $view;
	}
	
	public function action_update()
	{	
		$<?php echo strtolower($className); ?> = ORM::factory('<?php echo strtolower($className); ?>', $_POST['id']);
		
		if($<?php echo strtolower($className); ?>->loaded())
		{
			$<?php echo strtolower($className); ?>->save();
		}
		
		$this->request->redirect('<?php echo strtolower($className); ?>/edit/'.$<?php echo strtolower($className); ?>->id);
	}
	
	public function action_delete()
	{
		$<?php echo strtolower($className); ?> = ORM::factory('<?php echo strtolower($className); ?>', $this->request->param('id'));
		
		if($<?php echo strtolower($className); ?>->loaded())
		{
			$<?php echo strtolower($className); ?>->delete();
		}
		
		$this->request->redirect('<?php echo strtolower($className); ?>/index');
	}
}
