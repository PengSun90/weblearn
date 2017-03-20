<!DOCTYPE html> 
<html> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<body> 

<?php
echo $_SERVER['PHP_SELF'];
echo "<br>";
echo $_SERVER['SERVER_NAME'];
echo "<br>";
echo $_SERVER['HTTP_HOST'];
echo "<br>";
echo $_SERVER['HTTP_REFERER'];
echo "<br>";
echo $_SERVER['HTTP_USER_AGENT'];
echo "<br>";
echo $_SERVER['SCRIPT_NAME'];
echo "<br>";
echo '该文件位于 " '  . __FILE__ . ' " ';
echo "<br>";
echo '该文件位于 " '  . __DIR__ . ' " ';


$runoob = new Site('www.runoob.com', '菜鸟教程'); 
$taobao = new Site('www.taobao.com', '淘宝'); 
$google = new Site('www.google.com', 'Google 搜索'); 




class Site { 
  /* 成员变量 */ 
  var $url; 
  var $title; 
   

function __construct( $par1, $par2 ) {
   $this->url = $par1;
   $this->title = $par2;
}

  /* 成员函数 */ 
  function setUrl($par){ 
     $this->url = $par; 
  } 
   
  function getUrl(){ 
     echo $this->url . PHP_EOL; 
  } 
   
  function setTitle($par){ 
     $this->title = $par; 
  } 
   
  function getTitle(){ 
     echo $this->title . PHP_EOL; 
  } 
} 


//$runoob = new Site('www.runoob.com', '菜鸟教程'); 
$runoob = new Site(); 
$taobao = new Site('www.taobao.com', '淘宝'); 
$google = new Site('www.google.com', 'Google 搜索'); 


$runoob->setTitle( "菜鸟教程" ); 
$runoob->setUrl( 'www.runoob.com' ); 


// 调用成员函数，获取标题和URL 
$runoob->getTitle(); 
$taobao->getTitle(); 
$google->getTitle(); 

$runoob->getUrl(); 
$taobao->getUrl(); 
$google->getUrl();



?>

</body> 
</html>