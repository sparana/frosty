<?php
include_once "MiddleWare.php";

$mw=new MiddleWare;
if(isset($_GET['action']) && $_GET['action']!='')
{
	$action=$_GET['action'];
	if($action=='do_login')
	{
		if(isset($_POST['username']) && $_POST['username']!='' isset($_POST['password']) && $_POST['password']!='')
		{
			$response=$mw->login($_POST['username'],$_POST['password']);
			$msg=$response['msg'];
			if($response['status'])
				$mw->display('list',[]);

			else
				$mw->display('no_action',[]'msg'=>$msg);
//				header("Location:index.php?action=''&msg=".$msg);
		
		}
		else
			$mw->display('no_action',['msg'=>"Please provide required fields."]);
	}
	else if($action=='do_signup')
	{
		if(isset($_POST['username']) && $_POST['username']!='' isset($_POST['password']) && $_POST['password']!='')
		{
			$response=$mw->signup($_POST['username'],$_POST['password']);
			$msg=$response['msg'];
			if($response['status'])
			{
//				header("Location:index.php?action=signup&msg=".$msg);
				$mw->display('list',[]);
			}
				
			else
				$mw->display('no_action',['msg'=>$msg]);
//				header("Location:index.php?action=''&msg=".$msg);
		
		}
		else
			$mw->display('no_action',['msg'=>"Please provide required fields"]);
		//	header("Location:index.php?action=''&msg="."Please provide required fields.");
		
	}
	else if($action=='upload')
	{
		if(isset($_FILES['file_name']) && $_FILES['file_name'])
		{
			$mw->upload($_FILES['file_name']);
		}
		else
		{
			$mw->display('no_action',['msg',"Please choose a file"]);
		}


	}

}

?>
