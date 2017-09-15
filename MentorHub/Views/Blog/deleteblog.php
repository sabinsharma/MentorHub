<?php
//session_start();
//require_once "../../Model/Connection.php";
require_once "Model/CRUD.php";
require_once "Model/BlogModel.php";

//require_once "header.php";
//require_once "banner.php";
$value = "";
//$myconn = new Connection();
//$conn = $myconn->dbConnect();

$blogobj = new BlogModel();

$blogcrud = new CRUD();
$value = $_GET['id'];
$blogobj->setId($value);
$blogcrud->deleteBlog($blogobj);
//echo "return: ";
//header('location:controller=blog&action=index');

?>



<?php //include_once "right-section.php";?>
<?php //require_once "footer.php"; ?>