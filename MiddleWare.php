<?php
error_reporting(E_ALL);
include_once "dbhandle.php";
class MiddleWare
{
	private $user_name;
	$coll=new DBhandler("storage","users");
	public function findUser($username,$password)
	{
		$user=$coll->find(["username":$username,"password":$password]);
		$num_rows=$user->count();
		if($num>0)
		{
			return true;
		}
		else
			return false;
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
			$res=$this->setSession($username);

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
			$id=$coll->getId($username,$password);
			$res=$coll->insert(["_id"=>$id,"username"=>$username,"password"=>$password]);
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
	public function list($username)
	{
		//$files_name=json_decode();
		$total_files=count($files_name);
		$name_id=array(array("file_id"=>0,"file_name"=>"Nothing"));
		for($i=0;$i<$total_files;$i++)
		{
			$name_id[$i]['file_id']+=1;
			//			$name_id{$i}["file_name"]=$files_name["index_name"];

		}
		return $name_id;
	}
	public function upload($username,$file)
	{
		$file_json=json_encode($file);
		//	$msg=
		return $msg;	
	}
	public function download()
	{
		
	}
	public function display($action,$parameters)
	{
		if($action='list')
		{
			$file_id_name=$this->list($user_name);
			//View FUncitons
		}
		else if($action=='')
	}
}

?>
