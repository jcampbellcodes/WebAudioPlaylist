<?php
header("Content-Type: application/json");
//$folder = $_POST["folder"];
$folder = 'tags';
$jsonData = '{';
$dir = $folder."/";
$dirHandle = opendir($dir);
$j = 0; 
$i = 0;
while ($file = readdir($dirHandle)) { // in tags folder

    if(is_dir($folder . '/' . $file) && $file[0] != '.'){ // in individual folders
    	$j++;
    	$innerHandle = opendir($folder . '/' . $file);
    	while($f = readdir($innerHandle))
		{
			if(!is_dir($f) && preg_match("/.mp3|.ogg|.wav/i", $f)){
				$i++;
				$src = "$dir$file/$f";         //      path             filename      directory container   
				$jsonData .= '"snd'.$i.'":{ "src":"'.$src.'", "name":"'.$f.'", "tag":"'.$file.'" },';
    		} 
			
		}
    } 

}
closedir($dirHandle);
$jsonData = chop($jsonData, ",");
$jsonData .= '}';
//$cleanData = rawurlencode($jsonData);
//echo $cleanData;
echo $jsonData;
?>