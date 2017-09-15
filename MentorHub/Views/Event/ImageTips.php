<?php
/**
 * Created by PhpStorm.
 * User: Asuka
 * Date: 2017/03/28
 * Time: 13:03
 */
$hostId = 2; // who's image host_id

require_once "Model/CRUD.php";
$crud=new CRUD();
$hostId=array('Id'=>$hostId);
$viewCount2=$crud->Find('tbl_member_mst',$_host);
?>


<!--This method can read jpg image only...-->
<?php echo '<img style="width: 100%;" src="data:image/jpeg;base64,'.base64_encode( $viewCount2[0]['Pic_path'] ).'"/>'; ?>