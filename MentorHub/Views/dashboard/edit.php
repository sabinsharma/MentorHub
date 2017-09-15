<?php
/**
 * Created by PhpStorm.
 * User: sharm
 * Date: 20/04/2017
 * Time: 11:45 PM
 */
?>
<h4>Update Store Information</h4>
<hr>
<div class="row">
    <div class="col-md-offset-4"></div>
    <div class="col-md-12">
        <form class="form-horizontal">
            <div class="form-group">
                <label for="txtStoreName" class="col-sm-2 control-label">Store Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="txtStoreName" placeholder="Enter your store name" value="<?php echo $result[0]['Name']; ?>" required >
                </div>
            </div>
            <div class="form-group">
                <label for="txtUnit" class="col-sm-2 control-label">Unit Number</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="txtUnit" placeholder="Enter unit number" value="<?php echo $result[0]['Unit']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="txtAddress" class="col-sm-2 control-label">Address</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="txtAddress" placeholder="Enter your Address" value="<?php echo $result[0]['StreetAddress']; ?>"required>
                </div>
            </div>
            <input type="hidden" value="<?php echo $storeid ?>" id="storeID">
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-4">
                    <input type="button" class="btn btn-default" id="btnUpdateStore" value="Update Store Information" data-id="<?php echo $result[0]['Manager_Id']; ?>" />
                </div>
                <div class="col-sm-4">
                    <a href="?controller=dashboard&action=index" class="btn btn-default" id="btnBack">Back to Dashboard</a>
                </div>

            </div>
        </form>
    </div>
    <div class="col-md-offset-4"></div>
</div>

