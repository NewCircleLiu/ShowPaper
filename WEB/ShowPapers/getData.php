<?php
$conn = mysqli_connect('localhost', 'root', '', 'paper');
if (mysqli_connect_errno($conn))
{
    echo "连接 MySQL 失败: " . mysqli_connect_error();
}
$result=mysqli_query($conn,"select * from paper WHERE date = '2010'"); //依次取出论文并求数量
$y2010=mysqli_num_rows($result);
$array[]=$y2010;

$result=mysqli_query($conn,"select * from paper WHERE date = '2011'"); //依次取出论文并求数量
$y2011=mysqli_num_rows($result);
$array[]=$y2011;

$result=mysqli_query($conn,"select * from paper WHERE date = '2012'"); //依次取出论文并求数量
$y2012=mysqli_num_rows($result);
$array[]=$y2012;

$result=mysqli_query($conn,"select * from paper WHERE date = '2013'"); //依次取出论文并求数量
$y2013=mysqli_num_rows($result);
$array[]=$y2013;

$result=mysqli_query($conn,"select * from paper WHERE date = '2014'"); //依次取出论文并求数量
$y2014=mysqli_num_rows($result);
$array[]=$y2014;

$result=mysqli_query($conn,"select * from paper WHERE date = '2015'"); //依次取出论文并求数量
$y2015=mysqli_num_rows($result);
$array[]=$y2015;

$result=mysqli_query($conn,"select * from paper WHERE date = '2016'"); //依次取出论文并求数量
$y2016=mysqli_num_rows($result);
$array[]=$y2016;

$result=mysqli_query($conn,"select * from paper WHERE date = '2017'"); //依次取出论文并求数量
$y2017=mysqli_num_rows($result);
$array[]=$y2017;

$data=json_encode($array);
// echo "{".'"user"'.":".$data."}";
echo $data;
?>