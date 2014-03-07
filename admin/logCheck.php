<?php
include_once('../sys/config.php');

if (isset($_POST['submit']) && !empty($_POST['user']) && !empty($_POST['pass'])) {
	include_once('../header.php');
	//在使用SQL注入的时候，可以使用以下方式实现SQL注入
	//$name的输入为以下内容
	//1 ' or 1=1 or ' 
	//即可实现不用密码也可以进入的方法
	$name = $_POST['user'];
	$pass = $_POST['pass'];

    $query = "SELECT * FROM admin WHERE admin_name = '$name' AND admin_pass = SHA('$pass')";
    $data = mysqli_query($dbc, $query) or die('Error!!');

    if (mysqli_num_rows($data) == 1) {
		$_SESSION['admin'] = $name;
        header('Location: manage.php');
        }
	else {
		$_SESSION['error_info'] = '用户名或密码错误';
		header('Location: login.php');
	}
		
}
else {
	not_find($_SERVER['PHP_SELF']);
}
?>
