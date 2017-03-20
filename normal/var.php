<!DOCTYPE html> 
<html> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<body> 

<?php
class Car
{
    var $color;
    function Car($color="green") {
      $this->color = $color;
    }
    function what_color() {
      return $this->color;
    }
}

function print_vars($obj) {
   foreach (get_object_vars($obj) as $prop => $val) {
     echo "\t$prop = $val\n";
   }
}

// instantiate one object
$herbie = new Car("white");

// show herbie properties
echo "\herbie: Properties";
echo "<br>"; 
print_vars($herbie);
echo "<br>"; 

$x = 5985;
var_dump($x);
echo "<br>"; 
$x = -345; // 负数 
var_dump($x);
echo "<br>"; 
$x = 0x8C; // 十六进制数
var_dump($x);
echo "<br>";
$x = 047; // 八进制数
var_dump($x);
echo "<br>";
$x = "we love"; // 八进制数
var_dump($x);

echo "<br>"; 
$x = 10.365;
var_dump($x);
echo "<br>"; 
$x = 2.4e3;
var_dump($x);
echo "<br>"; 
$x = 8E-5;
var_dump($x);
?>

</body> 
</html>