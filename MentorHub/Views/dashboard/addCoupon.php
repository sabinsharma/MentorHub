<?php
/**
 * Created by PhpStorm.
 * User: sharm
 * Date: 21/04/2017
 * Time: 1:04 AM
 */
?>

<h4>Store Registration Form</h4>
<hr>
<div class="row">
    <div class="col-md-offset-4"></div>
    <div class="col-md-12">
        <form class="form-horizontal">
            <div class="form-group">
                <label for="txtAmount" class="col-sm-4 control-label">Coupon Amount</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="txtAmount" placeholder="Enter your coupon amount" required>
                </div>
            </div>
            <div class="form-group">
                <label for="txtQuantity" class="col-sm-4 control-label">Quantity</label>
                <div class="col-sm-8">
                    <input type="number" min=1 class="form-control" id="txtQuantity" placeholder="Enter quantiy">
                </div>
            </div>
            <input type="hidden" value="<?php echo $storeid ?>" id="txtstoreId">
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-4">
                    <input type="button" class="btn btn-default" id="btnAddCoupon" value="Add Coupon" />
                </div>
                <div class="col-sm-4">
                    <a href="?controller=dashboard&action=index" class="btn btn-default" id="btnBack">Back to Dashboard</a>
                </div>

            </div>
        </form>
    </div>
    <div class="col-md-offset-4"></div>
</div>

