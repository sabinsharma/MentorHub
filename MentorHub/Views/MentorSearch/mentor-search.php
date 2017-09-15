<?php

/*require_once "mainheader.php";
require_once "banner.php";

require_once "../../Model/MentorSearchModel.php";
require_once "../../Controller/MentorSearchCrud.php";
require_once "../../Model/Connection.php";

$myconn = new Connection();
$conn = $myconn->dbConnect();

$mentorSearchModel = new MentorSearchModel();*/

require_once ('Model/CRUD.php');
$mentorSearchCrud = new CRUD();

$categoriesres = $mentorSearchCrud->viewAllCategories();
//$subjectres = $mentorSearchCrud->viewAllSubjects($conn);
//$topicsres = $mentorSearchCrud->viewAllTopics($conn);


//var_dump($categoriesres);
//var_dump($res);
//foreach ($res as $val){
////    var_dump($val);
//    echo $val['name'];
//}
?>

<div class="container">
    <div class="row">
        <section id="recent" class="col-sm-8">
            <div id ="recent_title" class="row">
                <h2 class="col-xs-8">Mentor Search</h2>
                <div class="col-xs-4">
                    <p id="recent_online">100 people online</p>
                </div>
            </div>
            <br>
            <br>
<!--            <div class="recent_iconList">-->
<!--                <h2 class="">Mentor Search</h2>-->
<!--            </div>-->

            <!--            form starts-->
            <div class="row">
                <!--                <div class="col-sm-1"></div>-->

                    <form action="#" method="post">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="category">Select Category</label>
                                <select class="form-control" id="category" name="category">
                                    <option value="0" selected>Select Category</option>
                                    <?php foreach ($categoriesres as $val){ ?>
                                        <option value="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></option>
                                    <?php } ?>
                                </select>
                                <br>

                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="subject">Select Subject</label>
                                <select class="form-control" id="subject" name="subject">
                                    <option value="0" selected>Select Subject</option>
                                    <?php /*foreach ($subjectres as $val){ */?><!--
                                        <option value="<?php /*echo $val['name']; */?>"><?php /*echo $val['name']; */?></option>
                                    --><?php /*} */?>
                                </select>
                                <br>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="topic">Select Topic</label>
                                <select class="form-control" id="topic" name="topic">
                                    <option value="0" selected>Select Topic</option>
<!--                                    --><?php //foreach ($topicsres as $val){ ?>
<!--                                        <option value="--><?php //echo $val['name']; ?><!--">--><?php //echo $val['name'] ?><!--</option>-->
<!--                                    --><?php //} ?>
                                </select>
                                <br>
                            </div>
                        </div>

                    </form>

            </div>
            <!--            form ends-->

            <br>


            <!--        well starts-->
            <h2>Mentors Profile</h2>
            <br>

            <!--        well ends-->

            <!--            <div id="recent_more_button" class="center-block">-->
            <!--                <p><a href="#">See more</a></p>-->
            <!--            </div>-->
            <!--END recent_more_button-->

            <section id="content">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-7">
                        <p id="mentor-name"></p>
                    </div>
                    <div class="col-sm-2"></div>
                </div> <!--end of mentor name row-->
                <br>

                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-7">
<!--                        <span class="label label-mentor" id="mentor-symbol">Menter</span>-->
<!--                        <span class="label label-mentee">Mentee</span>-->
                    </div>
                    <div class="col-sm-2"></div>
                </div> <!--end of mentor/mentee row-->

                <br>

                <div class="row">
<!--                    <div class="col-sm-2"></div>-->
                    <div class="col-sm-12">
                        <table class="table table-bordered table-striped">
                            <tr><th>All Topics</th></tr>
                            <tr><td id = "mentor-topics">Select a category to see mentor posts</td></tr>
                        </table>
                    </div>
<!--                    <div class="col-sm-2"></div>-->
                </div> <!--end of mentor/mentee row-->
            </section>

        </section>
        <!--END recent-->
    </div>
</div>

