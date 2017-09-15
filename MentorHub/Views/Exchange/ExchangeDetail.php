<?php
$exchange_id='';
if (isset($_GET['Id'])){
//    echo "exchange id is=".$_GET['Id'];
    $exchange_id= filter_input(INPUT_GET, 'Id', FILTER_VALIDATE_INT);
    $_SESSION['exchange_id']=$exchange_id;
    if ($exchange_id == NULL || $exchange_id == FALSE){
        $exchange_id =1;//defalt
    }
}
if (isset($_POST['delete']) || isset($_POST['apply']) ||isset($_POST['submit'])) {
    $exchange_id = $_SESSION['exchange_id'];
}

$memberId = 2; // who view it* ->member_id
$_SESSION['memberId']=$memberId;

require_once "Model/CRUD.php";
require_once "Model/ExchangeInfo.php";

$crud=new CRUD();
$exchange_id=array('Id'=>$exchange_id);
$viewCount=$crud->Find('tbl_exchange_info',$exchange_id);

$traders_Id=$viewCount[0]['Traders_id'];
$_SESSION['tradersId']=$traders_Id;
$_traders=array('Id'=>$traders_Id);
$viewCount2=$crud->Find('tbl_member_mst',$_traders);

//var_dump($exchange_id);
//
//echo "memberId is" . $memberId;

// Jump to message box.

//if(isset($_POST['apply'])) {
//    $_SESSION['tradersId']=$tradersId;
//
//    $URL = "?controller=message&action=index";
//    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
//}

if (isset($_POST['delete'])) {
    $rows = $crud->DeleteInfo('tbl_exchange_info', $exchange_id);
    $URL="?controller=exchange&action=index";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}

if (isset($_POST['submit'])) {
    $isPrivate = 1;

    $item_Id =1;

    $timeStamp = date('Y-m-d', time());// timestamp -> YYYY-MM-DD
    $exchangeInfo = new ExchangeInfo();

    $exchangeInfo->setId($_SESSION['exchange_id']);

    $exchangeInfo->setIsOffer($_POST['exchange_is_offer']);
    $exchangeInfo->setTradersId($traders_Id);
    $exchangeInfo->setTitle($_POST['exchange_title-input']);
    $exchangeInfo->setDesc($_POST['exchange_desc-input']);
    $exchangeInfo->setItemId($item_Id);
    $exchangeInfo->setPostDate($timeStamp);
    $exchangeInfo->setImage($_POST['exchange_image-input']);
    $exchangeInfo->setIsPrivate($isPrivate);

    $crud->UpdateInfo('tbl_exchange_info', $exchangeInfo);
//    var_dump($exchangeInfo);
    $URL="?controller=exchange&action=index";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}

?>
<div id ="exchange_title" class="row">
    <h2>
        <?php if ($viewCount[0]['Is_offer']  == 1):?>
            <span class="exchange_title">TRADE - </span>
        <?php else :?>
            <span class="exchange_title">NEEDED - </span>
        <?php endif; ?>
        <?php echo $viewCount[0]['Title'] ?>
    </h2>
</div>

<div id="exchange_field" class="row">
    <div class="col-md-9 exchange_description">
        <h3>Item: <?php echo $viewCount[0]['Item_id'] ?></h3>
        <h5>Post Description</h5>
        <p><?php echo $viewCount[0]['Description'] ?></p>
    </div>
    <div class="col-md-3 exchange_image">
        <?php if (isset($viewCount[0]['Image'])) :?>
            <h5>Item Image</h5>
            <p><?php echo '<img style="width: 250px;" src="data:image/jpeg;base64,'.base64_encode( $viewCount[0]['Image'] ).'"/>'; ?></p>
        <?php endif; ?>
    </div>

    <div class="col-xs-12 exchange_buttons">
        <?php if ($traders_Id != $_SESSION['member_id']) :?>
            <form action="?controller=exchange&action=view" method="post" name="applyform">
                <input class="btn btn-lg viewPost_btn btn-primary" type="submit" name="apply" value="Apply now" id="apply">
            </form>
        <?php else :?>
            <a class="btn btn-lg viewPost_btn btn-primary" data-toggle="modal" data-target="#editModal">Edit</a>
            <form action="?controller=exchange&action=view" method="post" name="deleteform">
                <input class="btn btn-lg viewPost_btn btn-primary" type="submit" name="delete" value="Delete" id="delete">
            </form>
        <?php endif; ?>
    </div>

    <div class="col-xs-5 col-xs-offset-7 exchange_memberInfo row">
        <div class="col-md-4 exchange_image">
            <?php echo '<img style="width: 100%;" src="data:image/jpeg;base64,'.base64_encode( $viewCount2[0]['pic_path'] ).'"/>'; ?>
        </div>
        <div class="col-md-8">
            <p>Posted by  <?php echo $viewCount2[0]['first_name'] ?></p>
            <p>Posted time <?php echo $viewCount[0]['Post_date'] ?></p>
        </div>
    </div>
    <a class="btn viewPost_btn btn-primary" href="?controller=exchange&action=index" role="button">Back to Exchange List</a>




    <!-- editModal -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="?controller=exchange&action=view" method="post" name="editform">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                        <h4 class="modal-title">Post Edit Form</h4>
                    </div>

                    <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-sm-6 control-label">What do you Post?</label>
                                <div class="col-sm-6">
                                    <label class="radio-inline"> <input type="radio" name="exchange_is_offer" value="1" checked> Offer </label>
                                    <label class="radio-inline"> <input type="radio" name="exchange_is_offer" value="0"> Give </label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exchange_title-input" class="col-2 col-form-label">Post Title</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" name="exchange_title-input" required>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="exchange_desc-input">Description</label>
                                <textarea class="form-control" name="exchange_desc-input" rows="5" required></textarea>
                            </div>

                            <!--    <div class="form-group row">-->
                            <!--        <label for="exchange_desc-input" class="col-2 col-form-label">Description</label>-->
                            <!--        <div class="col-10">-->
                            <!--            <input class="form-control" type="text"  name="exchange_desc-input" required>-->
                            <!--        </div>-->
                            <!--    </div>-->

                            <div class="form-group">
                                <label for="exchange_itemId-input">Item</label>
                                <select class="form-control" name="exchange_itemId-input">
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Image Upload</label>
                                <input type="file" class="form-control-file" name="exchange_image-input" aria-describedby="fileHelp">
                            </div>

                     </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

