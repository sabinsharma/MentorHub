<div id ="exchange_title" class="row">
    <h2>Discussions Board</h2>
</div>
<!--Ask Question Button Section-->
<div class="row">
    <div class="col-md-8"></div>
    <div class="col-md-4">
        <input type="button" class="btn btn-primary btn-lg" id="_btnAskQuestion" name="btnAskQuestion"
               value="Ask Question" data-toggle="modal" data-target="#modalAskQuestion">
    </div>
</div>
<!--Ask Question Section End-->
<!--Filter Section Begin-->
<span id="filter">Filter</span>
<hr>
<div id="filterdiv">
    <div class="row">
        <form class="form-group" name="filter">
            <div class="col-md-4"><!--Area DropDown-->
                <div class="form-group">
                    <label for="area">Area of Discussion</label>
                    <select class="form-control" name="area" id="area">
                        <option value="" selected>Select Area</option>
                        <?php
                        foreach ($disarea as $area) {
                            echo "<option value='" . $area->id . "'>" . $area->discussion_area . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4"><!--Topic Drop Down-->
                <div class="form-group">
                    <label for="topics">Topic</label>
                    <select class="form-control" name="topics" id="topics">
                        <option value="" selected>Select Topics</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="ddcreator">Created By</label>
                        <select class="form-control" name="creator" id="ddcreator">
                            <option value="" selected>Show All</option>
                            <option value=<?php echo $_SESSION['member_id'] ?>>Only Created By Me</option>
                            <?php
                            foreach ($createdBy as $creator) {
                                echo "<option value=".$creator['id'].">".$creator['member_name']."</option>";
                            }
                            ?>
                        </select>
                </div>
            </div>
        </form>
    </div>

</div>




<!--<span id="askquestion">Ask Question</span>
<div id="askquestiondiv">
    <form name="frmAskQuestion" id="_frmAskQuestion" action="" method="post">
        <div class="row">

            <div class="col-md-4">
                <div class="form-group">
                    <label for="area">Area of Discussion</label>
                    <select class="form-control" name="area_askquestion" id="area_askquestion">
                        <option value="" selected>Select Area</option>
                        <?php
/*                        foreach ($disarea as $area) {
                            echo "<option value='" . $area->id . "'>" . $area->discussion_area . "</option>";
                        }
                        */?>
                    </select>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="_txtTopics">Topic</label>
                    <input type="text" class="form-control" id="_txtTopics" name="txtTopics"
                           placeholder="Enter you question Here">
                    <div id="myTopics"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <input type="button" class="btn btn-primary btn-lg" id="_btnAskQuestion" name="btnAskQuestion"
                       value="Ask Question" data-toggle="modal" data-target="#modalAskQuestion">

            </div>
        </div>
    </form>
</div>-->

<hr>
<!--Filter Section Ends-->

<!--Display Topic list section-->

<div class="table-responsive">
    <table class="table table-condensed table-hover table-striped ">
        <thead>
            <tr>
                <th>#</th>
                <th>Topic</th>
                <th>Views</th>
                <th>Replies</th>
                <th colspan="3" style="text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody id="listingTopicsDetail">

                <?php
                $cnt=1;
                //var_dump($discussionDetail);
                foreach ($discussionDetail as $disItem) {
                    echo"<tr>";
                    echo "<td>$cnt</td>";
                    echo "<td>".$disItem['Topic']."</td>";
                    echo"<td>".$disItem['ViewCount']."</td>";
                    $result=$crud->SelectAll("SELECT COUNT(id) as Replies FROM tbl_topics_detail WHERE topic_id=".$disItem['TopicID']);

                    echo"<td>".$result[0]['Replies']."</td>";
                    echo"<td><a href='?controller=discussionboard&action=ViewReplies&TopicID=".$disItem['TopicID']."' id='updateViewCount' data-id=".$disItem['TopicID'].">View</a></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                     echo "</tr>";
                     $cnt++;
                }
                ?>

        </tbody>
    </table>
</div>

<hr>
<!--End of Display topic section-->
<!-- Modal -->
<div class="modal fade" id="modalAskQuestion" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Ask Question
                </h4>
            </div>

            <!-- Modal Body -->
            <script src="ckeditor/ckeditor.js"></script>
            <div class="modal-body">
                <div id="askquestiondiv">
                    <form name="frmAskQuestion" id="_frmAskQuestion" action="" method="post">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="area">Area of Discussion</label>
                                    <select class="form-control" name="area_askquestion" id="area_askquestion">
                                        <option value="" selected>Select Area</option>
                                        <?php
                                        foreach ($disarea as $area) {
                                            echo "<option value='" . $area->id . "'>" . $area->discussion_area . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="_txtTopics">Topic</label>
                                    <input type="text" class="form-control" id="_txtTopics" name="txtTopics"
                                           placeholder="Enter you question Here">
                                    <div id="myTopics"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <textarea name="replyeditor" id="_replyeditor" rows="10" cols="80">

                                </textarea>
                                <script>
                                    CKEDITOR.replace('_replyeditor',{ language:'en',uiColor:'#9AB8F3'});
                                </script>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <input type="button" class="btn btn-primary btn-lg" id="_btnAskQuestion" name="btnAskQuestion"
                                       value="Create topic for discussion" data-dismiss="modal">

                            </div>
                        </div>
                    </form>
                </div><!--My body ends here-->
            </div>
            <!-- End of Modal Body-->

            <!-- Modal Footer -->
            <div class="modal-footer">
                <p> Before you ask question please search for the topics. Your question may have been already addressed by other members.</p>
            </div>
        </div>
    </div>
</div>
<!--END OF MODAL-->