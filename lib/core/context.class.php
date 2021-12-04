<?php

class Route 
{
	/**
	 * @var string
	 */
	public $controller;

	/**
	 * @var string
	 */
	public $action;

	/**
	 * @var bool
	 */
	public $anonymous;

	public function __construct(string $controller, string $action, bool $anonymous)
	{
		$this->controller = $controller;
		$this->action = $action;
		$this->anonymous = $anonymous;
	}
}

class Router {
	/**
	 * @var string[]
	 */
	private $mapping;

	public function __construct(string $routesTemplate) 
	{
		$mapping = [];
		
		include $routesTemplate;
		
		$this->mapping = $mapping;
	}

	

	public function check(string $action): ?Route
	{
		if (array_key_exists($action, $this->mapping)) {
			$routeData = $this->mapping[$action];
			
			return new Route($routeData['controller'], $routeData['action'], $routeData['anonymous'] ?? false);
		}

		return null;
	}
}

class context
{
    private $data;
    const SUCCESS="Success";
    const ERROR="Error";
    const NONE="None";
    private $name;
    private static $instance=null;
	
	 /**
     * @return context
     */
	public static function getInstance()
	{
		if(self::$instance==null)
		  self::$instance=new context();
		return self::$instance; 
	}

	public function setRouter(Router $router) 
	{
		$this->router = $router;
	}
	
	private function __construct()
	{
	  			
	}
	public function init($name)
	{
       $this->name=$name;
       
	}
	
	public function getLayout()
	{
		 return $this->layout;
	}

	public function setLayout($layout)
	{
		$this->layout=$layout;
	}	
	
	public function redirect($url)
	{
		header("location:".$url); 
	}

	public function executeAction($action,$request)
	{
		$this->layout="layout";

		if ($route = $this->router->check($action)) {
			$controller = $route->controller;

			if (!$route->anonymous && !$this->getSessionAttribute('userId')) {
				return false;
			}

			return $controller->{$route->action()}($request, $this);
		}

		return false;
	}
	
	public function getSessionAttribute($attribute)
	{
		if(array_key_exists($attribute, $_SESSION))		
			return $_SESSION[$attribute];
		else
			return NULL;
	}
	
	public function setSessionAttribute($attribute,$value)
	{
		$_SESSION[$attribute]=$value;
	}
    
	
	
	public function __get($prop)
    	{
		if(array_key_exists($prop, $this->data))        	
			return $this->data[$prop];
		else
			return NULL;      
    	}
    
   	public function __set($prop,$value) 
    	{
        	$this->data[$prop]=$value;      
    	}
	
		
}
