<?php
session_start();
include_once "MiddleWare.php";

$mw=new MiddleWare();
if(isset($_GET['action']) && $_GET['action']!='')
{
	$action=$_GET['action'];
	if($action=='do_login')
	{
		if(isset($_POST['username']) && $_POST['username']!='' && isset($_POST['password']) && $_POST['password']!='')
		{
			$response=$mw->login($_POST['username'],$_POST['password']);
			$msg=$response['msg'];
			if($response['status'])
				$mw->display('list',[]);
			else
				$mw->display('no_action',['msg'=>$msg]);		
		}
		else
			$mw->display('no_action',['msg'=>"Please provide required fields."]);
	}
	else if($action=='do_signup')
	{
		if(isset($_POST['username']) && $_POST['username']!='' &&  isset($_POST['password']) && $_POST['password']!='')
		{
			$response=$mw->signup($_POST['username'],$_POST['password']);
			$msg=$response['msg'];
			if($response['status'])
			{
				$mw->display('list',[]);
			}	
			else
				$mw->display('no_action',['msg'=>$msg]);
		}
		else
			$mw->display('no_action',['msg'=>"Please provide required fields"]);
		
	}
	else if($action=="upload")
	{
		if(isset($_FILES['file_name']))
		{	
			
			$response=$mw->upload($_FILES['file_name']);
			if($response['status']==1)
				$mw->display('list',['msg'=>"File has been uploaded successfully."]);
			else
				$mw->display('list',['msg'=>"Something went wrong"]);		
		}
		else
		{
			$mw->display('list',['msg'=>"Please choose a file"]);
		}
			
	}
	else if($action=="download")
	{
		$file_id=$_GET['file_name'];
		$mw->download($file_id);
			
	}
	else if($action=='signout')
	{
		$mw->logout();
	}
	else
	{
		$mw->display("no_action",[]);
	}
}
else
{
	if(isset($_SESSION))
		$mw->display('list',['msg'=>"Successfull"]);
	else	
		$mw->display("no_action",[]);
}
?>
