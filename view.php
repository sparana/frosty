<?php
class Sparana_Head{
	private $title;
	private $head;
	private $ttl;
	function __construct($title = 'Default Title'){
		$this->title = $title;
		$this->Title();
		$this->Header();
	}
	function Title(){
		
		$this->ttl = <<<EOF
		<head> 
<title>$this->title</title> 
<meta name="viewport" content="width=device-width, initial-scale=1.0  "> 
<link rel="icon" type="image/png/jpg/jpeg" href="images/Sparana.png">
<!-- Bootstrap --> 
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="Sparana.css">
 <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
 <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<script src="bootstrap/js/jquery.js" type="text/javascript"></script>
 <script src="bootstrap/js/bootstrap.min.js"type="text/javascript"></script>
<style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 100%;
      margin: auto;
  }
  .modal-header, h4, .close {
      background-color: navy;
      color:white !important;
      text-align: center;
      font-size: 30px;
  }
  .modal-footer {
      background-color: #f9f9f9;
  }
  
  </style>
  
      <script>
$(document).ready(function(){
    $("#register").click(function(){
        $("#RegModal").modal();
    });
});
$(document).ready(function(){
    $("#login").click(function(){
        $("#logModal").modal();
    });
});
</script>
</head>
<body>
EOF;
	}
	function Header(){
		$this->head= <<<EOF
  <div class="container">
  <div class="row">
  
  <div class="col-md-3">
  <img id="img1" src='images/upload.png' class="img-responsive"></img>
  </div>
  <div class="col-md-5">
       
  </div>
  <div class="col-md-4">
  <img id="img1" src='images/scloud.png' class="img-responsive"></img>
  </div>
  </div>
EOF;
	}
	public function __toString(){
		return $this->ttl . $this->head;
	}
	
}
class Sparana_Navbar{
	private $navtitle ;
	private $Username ;
	private $Status ;
	private $navContent_pre;
	private $navContent_post;
	
	function __construct($navtitle='Sparana',$Username='User',$Status='Login'){
		$this->navtitle=$navtitle;
		$this->Username=$Username;
		$this->Status=$Status;
		$this->genNavbar();
	}
	function genNavbar(){
		$this->navContent_pre=<<<EOF
  <div class="container">
  <div class="row">
  <div class="col-md-12" >
  <nav class="navbar navbar-inverse navbar-static" id="dd">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">$this->navtitle</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li> 
      
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span>$this->Username</a></li>
EOF;
	  
       if($this->Status=="Logout") {
      $this->navContent_post=<<<EOF
  <li><a href="index.php?action=logout"><span class="glyphicon glyphicon-off"></span>$this->Status</a></li>";
    </ul>
  </div>
  </nav>
  </div>
  </div>
EOF;
  
	   }
	  else { 
		$this->navContent_post=<<<EOF
<li><a href="#" id="register"><span class="glyphicon glyphicon-plus" ></span>Register</a></li>			
<li><a href="#" id="login"><span class="glyphicon glyphicon-log-in" ></span>$this->Status</a></li>		
  </ul>
  </div>
  </nav>
  </div>
  </div>
    <!-- Login Modal -->
  <div class="modal fade" id="logModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
					
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form" action="index.php?action=do_login" method="Post">
            <div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
              <input type="text" name="username"class="form-control" id="usrname" placeholder="Enter your Username (Ex: Vijay64)" maxlength="10">
            </div>
            <div class="form-group">
              <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
              <input type="password" name="password" class="form-control" id="psw" placeholder="Enter password" size="20" required>
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="" checked>Remember me</label>
            </div>
              <button type="submit" class="btn btn-success btn-block" id="logbt"><span class="glyphicon glyphicon-off"></span> Login</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
          <p>Not a member? <a href="dhom.html">Sign Up</a></p>
          
        </div>
      </div>
      
    </div>
  </div> 
  
   <!-- Register Modal -->
  <div class="modal fade" id="RegModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-plane"></span> Signup</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form" action="index.php?action=do_signup" method="Post">
            
			
			<div class="form-group">
              <label for="usrname">Username</label>
              <input type="text" name="username" class="form-control" id="i4" placeholder="Choose Your Username"  maxlength="10" required >
            </div>
		
			
            <div class="form-group">
              <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
              <input type="password"  name="password" class="form-control" id="i8" placeholder="Enter Your Password" size="20" required>
            </div>
			
			
			
            <div class="checkbox">
              <label><input type="checkbox" value="" checked>Remember me</label>
            </div>
              <button type="submit" class="btn btn-success btn-block" id="logbt"><span class="glyphicon glyphicon-plane"></span> &nbsp;Signup </button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Cancel</button>
          <p>Already a member? <a href="dhom.html">Login</a></p>
         
        </div>
      </div>
      
    </div>
  </div>
  </div>
  
  

EOF;
 	 }	
	
	  
  	
	}	
	
	public function __toString(){
		return $this->navContent_pre.$this->navContent_post;
	}
}

class Sparana_Body{
	private $html_message;
	private $file_arr=array();
	private $html_body_start;
	private $html_body_middle;
	private $html_body_end;
	private $html_upload;
	function __construct($html_message='Welcome to Sparana',$file_arr){
		$this->html_message=$html_message;
		$this->show_message();
		$this->show_upload();
		$this->file_arr=$file_arr;
		$this->show_body();
	}
	
	function show_message(){
		$this->html_message=<<<EOF
        <div class="container">
		<div class="row">
		<div class="col-md-12">
		<p class="bg-info">$this->html_message</p>
		</div>
		</div>
        		
EOF;
		
	}
	
	function show_upload(){
		$this->html_upload=<<<EOF
		<div class="row">
		
		<div class="col-md-3">
         <form role="form" action="index.php?action=upload" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              
              <input type="file" name="file_name" class="form-control" id="file_data"  maxlength="10">
            </div>
            
              <button type="submit" class="btn btn-success btn-block" id="uploadbt"><span class="glyphicon glyphicon-upload"></span>GO</button>
          </form>
		  </div>
		  </div>
EOF;
		
	}
	
	function show_body(){
		$this->html_body_start=<<<EOF
        <div class="jumbotron">
		<div class="row">
EOF;
        $length_file_arr=sizeof($this->file_arr);
		for($i=0;$i<$length_file_arr;$i++){
			$temp=$this->file_arr[$i];
			$url='index.php?action=download&file_id='.($i+1);
			$ext=pathinfo($temp)['extension'];
			if($ext=='mp3'||$ext=='ogg'||$ext=='m4a'||$ext=='amr'||$ext=='wma'){
				$this->html_body_middle.=<<<EOF
        <div class="col-md-3">
    <div class="well">
	 <img id="imgg" src='images/music.png' class="img-responsive"></img>
      <center><p class="bg-primary">$temp</p><center>
     <center><a href=$url><img id="imgg" src='images/d1.png' class="img-responsive"></img></a></center>	  
    </div>
   </div>                        
EOF;
			}
			
			else if($ext=='mp4'||$ext=='3gp'||$ext=='mkv'||$ext=='webm'){
				$this->html_body_middle.=<<<EOF
                     <div class="col-md-3">
    <div class="well">
	 <img id="imgg" src='images/video.png' class="img-responsive"></img>
      <center><p class="bg-primary">$temp</p></center>
     <center><a href=$url><img id="imgg" src='images/d1.png' class="img-responsive"></img></a></center>	  
    </div>
   </div> 				
EOF;
				
			}
			
			else if($ext=='docx'||$ext=='xlsx'||$ext=='ppt'||$ext=='odt'){
				$this->html_body_middle.=<<<EOF
                     <div class="col-md-3">
    <div class="well">
	 <img id="imgg" src='images/doc.png' class="img-responsive"></img>
      <center><p class="bg-primary">$temp</p></center>
     <center><a href=$url><img id="imgg" src='images/d1.png' class="img-responsive"></img></a></center>	  
    </div>
   </div> 				
EOF;
				
			}
			
			else if($ext=='jpg'||$ext=='psd'||$ext=='jpeg'||$ext=='png'){
				$this->html_body_middle.=<<<EOF
                     <div class="col-md-3">
    <div class="well">
	 <img id="imgg" src='images/image.png' class="img-responsive"></img>
      <center><p class="bg-primary">$temp</p></center>
     <center><a href=$url><img id="imgg" src='images/d1.png' class="img-responsive"></img></a></center>	  
    </div>
   </div> 				
EOF;
				
			}
			
			else if($ext=='pdf'){
				$this->html_body_middle.=<<<EOF
                     <div class="col-md-3">
    <div class="well">
	 <img id="imgg" src='images/pdf.png' class="img-responsive"></img>
      <center><p class="bg-primary">$temp</p></center>
     <center><a href=$url><img id="imgg" src='images/d1.png' class="img-responsive"></img></a></center>	  
    </div>
   </div> 				
EOF;
				
			}
				
		}
		
		
		
		$this->html_body_end=<<<EOF
		</div>
        </div> 		
		
EOF;
		
	}
	
	function __toString(){
		return $this->html_upload.$this->html_message.$this->html_body_start.$this->html_body_middle.$this->html_body_end;
	}
}


class Sparana_Default{
  private $html_default;
  private $html_nav;
  private $html_head;
    function __construct(){
    $this->html_nav=new Sparana_Navbar('Sparana','Login');  
    $this->html_head=new Sparana_Head('Sparana');
    $this->show_default();
	}
    function show_default(){
     $this->html_default=<<<EOF
     <div class="container">
     <div class="jumbotron">
      <div class="well">
      <img id="imgg" src='images/bg1.jpg' class="img-responsive"></img>     
      </div>
     </div>
     </div>
EOF;

     }
    function __toString(){
    return $this->html_nav.$this->html_head.$this->html_default;
     
    }
 }


//$Sparana_nav = new Sparana_Navbar('Sparana');
 //echo $Sparana_nav;
 
 //$Sparana_head = new Sparana_Head('Sparana');
//echo $Sparana_head;

 //$sparana_body = new Sparana_Body('Hello',['gif.mp3','Biography.mkv','CV.docx','view.jpeg','Resume.pdf']);
  //echo $sparana_body;

 //$sparana_default_body = new Sparana_Default();
  //echo $sparana_default_body;
 ?>
