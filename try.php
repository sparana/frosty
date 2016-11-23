<?php
$file_arr=array('HHH.amr');
$length_file_arr=sizeof($file_arr);
for($i=0;$i<$length_file_arr;$i++){
			$ext=pathinfo($file_arr[$i])['extension'];
			if( $ext=="mp3"||$ext=="m4a"||$ext=="ogg"||$ext=="wma"||$ext=="amr")
			{
			echo "yes".$ext; 
            }
}
			?>