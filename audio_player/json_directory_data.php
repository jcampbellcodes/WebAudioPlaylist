<?php
header("Content-Type: application/json");
$folder = $_POST["folder"];
//$folder = 'tags';
$jsonData = '{';
$dir = $folder."/";
$dirHandle = opendir($dir); 
$i = 0;
while ($file = readdir($dirHandle)) {
	//if(is_dir($file)){ figure out why this isn't working
	if($file[0] != '.')
	{	$i++;
		$src = "$dir$file";
		$jsonData .= '"directory'.$i.'":{ "src":"'.$src.'", "name":"'.$file.'" },';
	}
    //}
}
closedir($dirHandle);
$jsonData = chop($jsonData, ",");
$jsonData .= '}';
//$cleanData = rawurlencode($jsonData);
//echo $cleanData;
echo $jsonData;
?>