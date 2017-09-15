<?php
/**
 * Created by PhpStorm.
 * User: sharm
 * Date: 20/04/2017
 * Time: 2:40 AM
 */
/*echo $_SESSION['Store_ID'];*/
?>
<h4>Welcome to the dashboard</h4>
<hr/>
<div class="row">
    <?php

        if($_SESSION['Store_ID']==0) {
           echo " <div class='col-md-12'>";
            echo "<a href='?controller=dashboard&action=create' class='btn btn-primary'>Register Store</a>";
        echo "</div>";
        }
        else {
            echo "<div class='col-md-6'>";
            echo "<a href='?controller=dashboard&action=edit&id=".$storeid[0]['storeid']."' class='btn btn-primary'>Edit Store Information</a>";
            echo "</div>";
            echo "<div class='col-md-6'>";
            echo "<a href='?controller=dashboard&action=addCoupon&id=".$storeid[0]['storeid']."' class='btn btn-primary'>Create Coupon</a>";
            echo "</div>";
        }
    ?>
</div>
<hr/>
<div class="row">
    <table class="table table-hover table-striped table-responsive" id="couponInfo">
        <thead>
            <tr>
                <th>Coupon Amount</th>
                <th>Quantity</th>
                <th>Quantity on hands</th>
                <th>Entered Date</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>




