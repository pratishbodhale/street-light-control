<?php 

$mode = $_GET['mode'];
if($mode==1){

	$myfile = fopen("override.txt", "r") or die("Unable to open file!");
	$op = fread($myfile,filesize("override.txt"));
	fclose($myfile);

	if($_GET['param']=='true'){
		$param = 1;
	}
	elseif($_GET['param']=='false'){
		$param = 0;
	}
	$write = $param.'~'.explode('~',$op)[1].'~'.explode('~',$op)[2].'~'.explode('~',$op)[3];

}
else{

	if($_GET['param1']=='true'){
		$param1 = 1;
	}
	elseif($_GET['param1']=='false'){
		$param1 = 0;
	}

	if($_GET['param2']=='true'){
		$param2 = 1;
	}
	elseif($_GET['param2']=='false'){
		$param2 = 0;
	}
	$write = $param1.'~'.$param2.'~'.$_GET['t1'].'~'.$_GET['t2'];


}

$myfile = fopen("override.txt", "w") or die("Unable to open file!");
fwrite($myfile, $param);
fclose($myfile);
?>