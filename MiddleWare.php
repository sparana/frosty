<?php
session_start();
include_once "httpful.phar";
include_once "Sparana/view.php";

class MiddleWare
{
	//private $user_name;
	private $coll;
	private $base_uri="10.44.78.44:9090";
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

		$_SESSION["username"]=$values;
		return true;
	}
	public function login($username,$password)
	{
		$user_exists=$this->findUser($username,$password);
		if($user_exists)
		{
			$res=$this->setSession($username);
			return ["status"=>true,"msg"=>"User Logged In Successfully.","username"=>$username];
		}
		else
		{
			return ["status"=>false,"msg"=>"User does not exist"];
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
			$res=$this->coll->insert(["username"=>$username,"password"=>$password]);
			return ["status"=>true,"msg"=>"Signed Up successfully.","username"=>$username];				
		}
		
	}
	public function file_list()
	{
		$url=$this->base_uri."/api/list/".$_SESSION['username'];
		$response = \Httpful\Request::get($url)->send();
		$file_names=array();
		$files=json_decode($response,TRUE);
		foreach($files as $file)
			$file_names[]=$file['filename'];
		return $file_names;
		
		
	}
	public function upload($file)
	{
		$data=array('username'=>$_SESSION['username'],'filename'=>$file['name'],'filecontent'=>base64_encode(file_get_contents($file['tmp_name'])),'type'=>$file['type'],'size'=>$file['size']);
		$file_json=json_encode($data);
		$uri=$this->base_uri."/api/file/upload";
		$response = \Httpful\Request::post($uri)                 
			    ->sendsJson()                              
			    ->body($file_json)
			    ->send();
		$respons=json_decode($response, TRUE);
		return $respons;
	}
	public function download($file_name)
	{
		$username=$_SESSION['username'];
		$url=$this->base_uri."/api/file";
		$response = \Httpful\Request::post($url)                 
			    ->sendsJson()                              
			    ->body(json_encode(['username'=>$username,'filename'=>$file_name]))
			    ->send();
		$file=json_decode($response,TRUE);
		 header('Content-Description: File Transfer');
    		header('Content-Type: '.$file['type']);
		    header('Content-Disposition: attachment; filename='. $file['filename']);
		    header('Content-Transfer-Encoding: binary');
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate');
		    header('Pragma: public');
		    header('Content-Length: ' .$file['size']);
		    ob_clean();
		    flush();
		   echo base64_decode($file['filecontent']);
		    exit;
		
	}
	public function display($action,$parameters=array())
	{
		if($action=="list")
		{
			$msg="You are welcome";
			if(isset($parameters['msg']))
				$msg=$parameters['msg'];
			$user=$_SESSION['username'];
			$file_names=$this->file_list();
			echo (new Sparana_Navbar('Sparana',$user,'Logout'));
		 	echo (new Sparana_Head('Sparana'));
			echo (new Sparana_Body($msg,$file_names));
		}
		else if($action=="no_action")
		{
			$msg=" ";
			if(isset($parameters['msg']))
				$msg=$parameters['msg'];
			echo (new Sparana_Default($msg));
		}
	
	}
	public function logout()
	{
		unset($_SESSTION);
		$this->display('no_action',['msg'=>"Signed out Successfully."]);
	}
}


?>
