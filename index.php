<?php
/**
 * 
 *
 * @author EpicDewd
 * @version 1.0
 * @copyright HalpMeh, 11 November, 2010
 * @package 4chan
 **/
error_reporting(E_ALL);


# Config
include_once dirname(__FILE__) . "/Config.php";

# Classes
include_once dirname(__FILE__) . "/Classes/Mysql.Class.php";
# Fuck globals
global $db;
$db = new MySql($user, $pass, $name, $host, 3306);

include_once dirname(__FILE__) . "/Classes/Install.Class.php";
include_once dirname(__FILE__) . "/Classes/GetCategories.Class.php";
include_once dirname(__FILE__) . "/Classes/GetPosts.Class.php";
include_once dirname(__FILE__) . "/General.Functions.php";

# Check if we're installed
if(!isset($host)) {
	$Install = new Install;
	if(isset($_GET['install']))
	{
		$pass = safe($_POST['pass']);
		if($pass == "SQL Pass")
		{
			$pass = '';
		}
		$Install->Generate(safe($_POST['host']), safe($_POST['user']), $pass, safe($_POST['name']));
		$Install->Done();
	}
	$Install->HTML();
	$Install->Done();
	die();
}
else

# HardCore Code

# General Functions

# Get Setting from DB

# HTML & PHP Include
include_once dirname(__FILE__) . "/Header.index.php";


if(isset($_GET['category']) && GetCategories::categoryExists($_GET['category'])) {
	include_once dirname(__FILE__) . "/Posts.index.php";
} else if(isset($_GET['post']) && (count(GetPosts::getPostId($_GET['post'])) > 1)) {
	include_once dirname(__FILE__) . "/Post.index.php";
} else {
	include_once dirname(__FILE__) . "/Categories.index.php";
}



include_once dirname(__FILE__) . "/Footer.index.php";
?>
