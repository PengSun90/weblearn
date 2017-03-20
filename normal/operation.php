<!DOCTYPE html> 
<html> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<body> 

<?php 
$x=10; 
$y=6;
echo ($x + $y); // 输出16
echo '<br>';  // 换行
 
echo ($x - $y); // 输出4
echo '<br>';  // 换行
 
echo ($x * $y); // 输出60
echo '<br>';  // 换行
 
$result;

$result = $x / $y;
echo ($result); // 输出1.6666666666667
echo '<br>';  // 换行
var_dump($result);
echo '<br>';  // 换行
 
echo ($x % $y); // 输出4
echo '<br>';  // 换行
 
echo -$x;

$x = array("a" => "red", "b" => "green"); 
$y = array("c" => "blue", "d" => "yellow"); 
$z = $x + $y; // $x 和 $y 数组合并
var_dump($z);
echo '<br>'; 
var_dump($x == $y);
echo '<br>'; 
var_dump($x === $y);
var_dump($x != $y);
echo '<br>'; 
var_dump($x <> $y);
echo '<br>'; 
var_dump($x !== $y);


?>

</body> 
</html>