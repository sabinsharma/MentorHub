<?php
/**
 * Created by PhpStorm.
 * User: sharm
 * Date: 27/03/2017
 * Time: 12:58 PM
 */

?>
<div id ="exchange_title" class="row">
    <h2>Discussion Board</h2>
</div>
<!--row for topic-->
    <div class="row">
        <div class="col-md-12">
            <h2><?php echo $mytopic[0]['topic'] ?></h2>
        </div>
    </div>
    <hr>
<!--row for topic description-->
    <div class="row">
        <div class="col-md-12">
          <h3><?php echo $mytopic[0]['description'] ?></h3>
        </div>
    </div>
<hr>
<!--row for topic description-->
<div id="loadReplies">
<?php
    if(count($replies)>0){
        echo "<div class='row'>";
            foreach ($replies as $topicreply){
                echo "<div class='col-md-12'>";
                    echo "<div class='row'>";
                        echo"<div class='col-md-10'>";
                            echo $topicreply['Reply'];
                        echo"</div>";//div class col-md-8

                        if($_SESSION['member_id']==$topicreply['RepliedBy']) {
                            echo "<div class='col-md-1'>";
                                echo "<span class='glyphicon glyphicon-pencil' data-id='" . $topicreply['TopicDetailID'] . "' data-toggle='modal' data-target='#modalPostAnswer'>";
                            echo "</div>";//div class com-md-2
                            echo "<div class='col-md-1'>";
                                echo "<span class='glyphicon glyphicon-trash' data-id='" . $topicreply['TopicDetailID'] . "'>";
                            echo "</div>";//div class col-md-2
                        }//end of if statement
                    echo "</div>";//inner div class row
                echo "<hr>";
                echo "</div>";//div class col-md-12

            }//end of foreach


        echo "</div>";//outer div class row
    }

?>
</div>
<!--Rows for posting reply-->
<script src="ckeditor/ckeditor.js"></script>
<h3>Post you Answer</h3>
<div class="row">
    <div class="col-md-12">
        <textarea name="replyboxeditor" id="_replyboxeditor" rows="10" cols="80">

        </textarea>
        <script>
            CKEDITOR.replace('_replyboxeditor', {language: 'en', uiColor: '#9AB8F3'});
        </script>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-md-8"></div>
    <div class="col-md-4">
        <input type="button" class="btn btn-primary btn-lg" id="_btnReply" name="btnReply"
               value="Post My Answer" data-id="<?php echo $mytopic[0]['id']?>">

    </div>
</div>


<!--End of Display topic section-->
<!-- Modal -->
<div class="modal fade" id="modalPostAnswer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Update My Answer
                </h4>
            </div>

            <!-- Modal Body -->
            <script src="ckeditor/ckeditor.js"></script>
            <div class="modal-body">
                <div id="updateAnswer">
                    <form name="frmAskQuestion" id="_frmAskQuestion" action="" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <textarea name="updatereplyeditor" id="_updatereplyeditor" rows="10" cols="80">

                                </textarea>
                                <script>
                                    CKEDITOR.replace('_updatereplyeditor',{ language:'en',uiColor:'#9AB8F3'});
                                </script>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <input type="button" class="btn btn-primary btn-lg" id="_btnUpdateReply" name="btnUpdateReply"
                                       value="Update" data-dismiss="modal">

                            </div>
                        </div>
                    </form>
                </div><!--My body ends here-->
            </div>
            <!-- End of Modal Body-->

            <!-- Modal Footer -->
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<!--END OF MODAL-->