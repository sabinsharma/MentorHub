<?php
/**
 * Created by PhpStorm.
 * User: sharm
 * Date: 21/04/2017
 * Time: 3:28 AM
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
                    <input type="text" class="form-control" id="txtAmount" placeholder="Enter your coupon amount" value="<?php echo $result[0]['Amount']?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="txtQuantity" class="col-sm-4 control-label">Quantity</label>
                <div class="col-sm-8">
                    <input type="number" min="<?php echo $minValue ?>" class="form-control" id="txtQuantity" placeholder="Enter quantiy" value="<?php echo $result[0]['Quantity']?>">
                </div>
            </div>
            <input type="hidden" value="<?php echo $couponId ?>" id="txtCouponId">
            <input type="hidden" value="<?php echo $result[0]['StoreId'] ?>" id="txtStoreId" >
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-4">
                    <input type="button" class="btn btn-default" id="btnEditCoupon" value="Edit Coupon" />
                </div>
                <div class="col-sm-4">
                    <a href="?controller=dashboard&action=index" class="btn btn-default" id="btnBack">Back to Dashboard</a>
                </div>

            </div>
        </form>
    </div>
    <div class="col-md-offset-4"></div>
</div>
