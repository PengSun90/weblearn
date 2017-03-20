<meta charset="utf-8">
<?php
if(!file_exists("welcome.txt"))
{
	die("文件不存在");
}
else
{
	$file=fopen("welcome.txt","r");
}
?>