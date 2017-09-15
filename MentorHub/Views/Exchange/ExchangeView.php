<?php
require_once "Model/CRUD.php";
$crud = new CRUD();
$exchange=$crud->FetchALL('tbl_exchange_info');

function getTraderName($trader_id){
    require_once "Model/CRUD.php";
    $crud = new CRUD();
    $qry='SELECT Id, First_name FROM tbl_member_mst where Id='. $trader_id;
    $username=$crud->SelectAll($qry);
    return $username;
}

?>

<div id ="exchange_title" class="row">
    <h2>Item Exchange Board</h2>
</div>
<div id="exchange_field" class="row">
    <div>
        <div id="addPost_btn">
            <a class="btn btn-primary btn-lg" href="?controller=exchange&action=create" role="button">Add New Post</a>
        </div>
        <table class="post-table table table-striped">
            <thead class="post-thead">
            <tr>
                <th>Status</th>
                <th>Title</th>
                <th>Item</th>
                <th>Trader Name</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($exchange as $exchange) : ?>
                <tr>
                    <td>
                        <?php if ($exchange['Is_offer'] == 1):?>
                            <span class="label label-pink">TRADE</span>
                        <?php else :?>
                            <span class="label label-green">NEEDED</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo $exchange['Title']; ?> </td>
                    <td><?php echo $exchange['Item_id']; ?> </td>
                    <td><?php foreach (getTraderName($exchange['Traders_id']) as $itemname){echo $itemname['First_name'];} ?></td>

                    <td><a class="viewPost_btn btn btn-primary" href="?controller=exchange&action=view&Id=<?php echo $exchange['Id']; ?>" role="button">View</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!--Janani-->
<?php

/* Note that the CSS and Javascript code for the slider were altered from
https://codepen.io/bkainteractive/pen/VLxLYp by BKA Digital Outfiiters on 16/04/2017
*/

require_once("Model/CRUD.php");

//Grab username from session

$_SESSION['username'] = 'math_wiz';
$username = $_SESSION['username'];

//$dbc = new Dbconnect();
//$conn = $dbc->getDb();

//First retrieve user's interest categories
$myinterest = new CRUD();
$user_interest_cat = $myinterest->getInterests($username);

//var_dump($user_interest_cat);

$interests = array_column($user_interest_cat, 'interest_category'); //array_column returns the values from a single column in the input array (when you have an array of arrays).
// So we get: Array([0] => mathematics  [1] => mathematics)
//Grab items with matching item category from database table and display them

$allitems = $myinterest->getInterestItems($interests);


//var_dump($allitems);

?>



<div id="exchange_field" class="row">
    <h2 class="similar">Similar Listings</h2>
    <div class="row">
        <div class="col-md-12 heroSlider-fixed">
            <div class="overlay">
            </div>
            <!-- Slider -->
            <div class="slider responsive">
                <?php foreach ($allitems as $key => $value) : ?>
                    <div>
                        <img src="Assets/Images/user/<?php echo $allitems[$key]['item_image_path']?>" height="150" width="150" alt="item01">
                        <p><b>Trader:</b> <br><?php echo $allitems[$key]['username']?></p>
                        <p><b>Item name:</b> <br><?php echo $allitems[$key]['item_name']?></p>
                        <p><b>Item description:</b><br><?php echo $allitems[$key]['item_description']?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- control arrows -->
            <div class="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            </div>
            <div class="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            </div>

        </div>
    </div>
</div>

<!-- All JS files are below -->


