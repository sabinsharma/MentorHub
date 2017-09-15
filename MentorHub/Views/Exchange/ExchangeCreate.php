<?php

if (isset($_POST['submit'])) {

    $traders_Id = $_SESSION['member_id'];// who write it* ->Host_id
    $item_Id=1;
    $isPrivate = 1;
    $timeStamp = date('Y-m-d', time());// timestamp -> YYYY-MM-DD
    require_once "Model/ExchangeInfo.php";
    $exchangeInfo = new ExchangeInfo();
//    var_dump($exchangeInfo);
    $exchangeInfo->setIsOffer($_POST['exchange_is_offer']);
    $exchangeInfo->setTradersId($traders_Id);
    $exchangeInfo->setTitle($_POST['exchange_title-input']);
    $exchangeInfo->setDesc($_POST['exchange_desc-input']);
    $exchangeInfo->setItemId($item_Id);
    $exchangeInfo->setPostDate($timeStamp);
    $exchangeInfo->setImage($_POST['exchange_image-input']);
    $exchangeInfo->setIsPrivate($isPrivate);
//    var_dump($exchangeInfo);

    require_once "Model/CRUD.php";
    $crud = new CRUD();
    $crud->InsertInfo('tbl_exchange_info', $exchangeInfo);

    $URL="?controller=exchange&action=index";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
}
?>

<div id ="exchange_title" class="row">
    <h2>Exchange Post Form</h2>
</div>
<a class="btn viewPost_btn btn-primary" href="?controller=exchange&action=index" role="button">Back to Exchange List</a>

<div id="exchange_field" class="row">
    <div>
        <form action="?controller=exchange&action=create" method="post">

            <div class="form-group row">
                <label class="col-sm-6 control-label">What do you Post?</label>
                <div class="col-sm-6">
                    <label class="radio-inline"> <input type="radio" name="exchange_is_offer" value="1" checked> TRADE </label>
                    <label class="radio-inline"> <input type="radio" name="exchange_is_offer" value="0"> NEEDED </label>
                </div>
            </div>

            <div class="form-group">
                <label for="exchange_title-input" class="col-form-label">Post Title</label>

                    <input class="form-control" type="text" name="exchange_title-input" required>
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

            <div id="addPost_btn">
                <input class="btn btn-primary" type="submit" name="submit" value="Submit">
                <input class="btn btn-primary" type="reset" name="reset" value="Reset">
            </div>

        </form>
    </div>
</div>
