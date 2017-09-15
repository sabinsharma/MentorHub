<?php
/**
 * Created by PhpStorm.
 * User: sharm
 * Date: 21/04/2017
 * Time: 5:39 AM
 */

?>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <select id="storeList" class="form-control">
                <option value="0">Select Store</option>
                <?php
                foreach ($result as $store){
                    echo "<option value=".$store['Id'].">".$store['Name']."</option>";
                }

                ?>
            </select>
        </div>

    </div>
</div>
<hr/>
<div class="row">
    <table class="table table-hover table-striped table-responsive" id="CouponList">
        <thead>
        <tr>
            <th>Coupon Amount</th>
            <th>Quantity</th>
            <th>Quantity on hands</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="printCoupon">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Offers!!!</h4>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->