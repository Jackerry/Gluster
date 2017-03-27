-
<?php
function w(){
$str=header("Content-type: text/xml");
$str=$str."<?xml version='1.0' encoding='ISO-8859-1'?>";
$str=$str."<note>";
$str=$str."<from>Jani</from>";
$str=$str."<to>Tove</to>";
$str=$str."<message>Remember me this weekend</message>";
$str=$str."</note>";
return $str;
}

$str=w();
$myfile = fopen("xml/tt.xml", "w") or die("Unable to open file!");
			fwrite($myfile, $str);
			fclose($myfile);
?>
