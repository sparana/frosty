<?php
error_reporting(E_ALL);
//include_once "dbhandle.php";
include_once "httpful.phar";
include_once "view.php";

class MiddleWare
{
	private $user_name;
	private $coll;
	private $file_id_name_arr=array(array("file_id"=>0,"files_name"=>"Nofil"));
	function __construct()
	{
		$d=new MongoClient();
		$this->coll=$d->selectDB("storage")->selectCollection("users");
	}
	public function findUser($username,$password)
	{
		$user=$this->coll->find(["username"=>$username,"password"=>$password]);
		$num_rows=$user->count();
		if($num_rows>0)
			return true;
		else
			return false;
	}
	public function getId()
	{
		$max = $this->coll->find(array(), array('_id' => 1))->sort(array('_id' => -1))->limit(1);
		return ($max+1);
	}
	public function setSession($values)
	{
		$cnt=count($valuse);
		for($i=0;$i<$cnt;$i++)
			$_SESSION[$values[0]]=$values[0];
		return true;
	}
	public function login($username,$password)
	{
		$user_exists=$this->findUser($username,$password);
		if($user_exists)
		{
			$this->user_name=$username;
			$res=$this->setSession(array($username));

			return ["status"=>true,"msg"=>"User Logged In Successfully."];
		}
		else
		{
			return ["status"=>false,"mag"=>"User does not exist"];
		}
	}
	public function signup($username,$password)
	{
		$user_exists=$this->findUser($username,$password);
		if($user_exists)
		{
			return ['status'=>false,"msg"=>"User already exists. Please choose another username."];
		}
		else{
			$id=$this->getId();
			$res=$this->coll->insert(["_id"=>$id,"username"=>$username,"password"=>$password]);
			$num=$res->getInsertedId();
			if($num<=0)
			{
				return ["status"=>false,"msg"=>"Something Went Wrong"];
			}
			else
			{
				return ["status"=>true,"msg"=>"Signed Up successfully."];
			}		
		}
		
	}
	public function is_user_logged_in($action)
	{
		if(isset($_SESSION))
			return true;
		else
			return false;
	}

	public function file_list()
	{

	//	$this->file_id_name_arr_name=json_decode(); //will be retrived from piyush api
		
		
	}
	public function upload($file)
	{
		$file_json=json_encode($file);

		
		$this->display('list',['msg'=>"This functionality has not added so far"]);
	//	$uri="from piyush";
		// $file_json will be sent to piyush api and status will be recreived  and display next page according to the reponse and call display function according.
//		$response = \Httpful\Request::put($uri)                 
//			    ->sendsJson()                              
			   // ->authenticateWith('username', 'password')
//			    ->body('{"username":$this->username,"file":$file_json}')
//			    ->send();
		//check status and do according to the response

	}
	public function download($file_id)
	{
	//	$file_name=$this->file_id_name_arr[$file_id-1];
		$this->display("list",["msg"=>"This functionality has not been added."]);	
//		$uri="Piyush api url";
//		$response = \Httpful\Request::get($uri)->send();
		//pass the usernam and this file id to piyush api and file will e
	}
	public function display($action,$parameters=array())
	{
	//	echo $action;
		//var_dump($parameters);
		if($action=="list")
		{
			$msg="You are welcome";
			if(isset($parameters['msg']))
				$msg=$parameters['msg'];
			$this->file_list();
			$Sparana_nav = new Sparana_Navbar('Sparana',"vijay ",'Logout');
		 	echo $Sparana_nav;
		 
		 $Sparana_head = new Sparana_Head('Sparana');
			echo $Sparana_head;

		 $sparana_body = new Sparana_Body($msg,[]);
		  echo $sparana_body;	
			// call View FUncitons
		}
		else if($action=="no_action")
		{
		//	die("i am from display");
			 $sparana_default_body = new Sparana_Default();
			   echo $sparana_default_body;
		// Call view functions 
		}
	
	}
	public function logout()
	{
		unset($_SESSTION);
		$this->display('no_action',['msg'=>"Signed out Successfully."]);
	}
}


?>
