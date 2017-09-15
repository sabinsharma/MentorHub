/**
 * Created by Sabin Kumar sharma on 11/03/2017.
 */
$(document).ready(function () {
    //alert("test");
    // $("#board").click(function () {
    //     pathname = document.location.href.match(/[^\/]+$/)[0];
    //     alert(pathname+"dfgd");
    //     switch (pathname){
    //         case 'index.php':
    //             break;
    //         case 'discussion-board.php':
    //             loadDiscussionBoard();
    //             break;
    //     }
    // })//click function ends here
    /*var pathname;
    var _href=document.location.href.match(/[^\/]+$/);
    _href===null?pathname='index.php':pathname = document.location.href.match(/[^\/]+$/)[0];*/



    // function loadDiscussionBoard() {
    //
    //     $.ajax({
    //         url:'../../../View/Discussion/view.php',
    //         type:'post',
    //         cache:false,
    //         success:function (discussionboard) {
    //             alert(discussionboard+"from dis function");
    //             $("#main_field").append(discussionboard);
    //         }
    //     });//end of ajax function
    // }//end of loadDiscussionBoard

    // alert("test");

    $(".alert").hide();

    var topicid,creatorid,AreaID;
    function getSelectedDropDownValue() {

        topicid=$("#main_field #topics").find(":selected").val();
        creatorid=$("#main_field #ddcreator").find(":selected").val();
        AreaID=$("#main_field #area").find(":selected").val();
        //console.log(AreaID+"--"+topicid+"--"+creatorid);
    }

    function listTopicRelatedInformation(){
        //call to ajax function that list the topic detail information in table of index.php for discussion based on area id, topic id and creator id
        $.ajax({
            url:'Factory/factory.php',
            data:{
                factory:'listTopicDetail',
                areaid:AreaID,
                topicId:topicid,
                creatorId:creatorid
            },
            type:'post',
            cache:false,
            success:function(info){
                console.log(info);
                //alert(info);
                $("#listingTopicsDetail").empty().append(info);
            }
        });//function that list the topic detail information in table
    }



    //function to get the topics based on selected area for discussion. main field is the div in layout page.
    $("#main_field").on('change','#area',(function () {
        //call to ajax function to populate the discussion area dropdown
        var id=$(this).find(":selected").val();
        alert(id);
        $.ajax({
            url:'Factory/factory.php',
            data:{
                factory:'getTopics',
                id:id
            },
            type:'post',
            cache:false,
            success:function (id) {
                // $("#test").html(id);
                id="<option value='' >Select Topic</option>"+id;
                $("#topics").empty().append(id);
                getSelectedDropDownValue();
                listTopicRelatedInformation();
            }
        });//end of ajax function to populate discussion area dropdown


    }));//end of change function

    //when the topic dropdown is changed ajax function below will be called to list the topic detail information in table
    $("#main_field").on('change','#topics',(function () {
        getSelectedDropDownValue();
        listTopicRelatedInformation();
        }));//end of dropdown change function

    $("#main_field").on('change','#ddcreator',(function () {
        getSelectedDropDownValue();
        listTopicRelatedInformation();
    }));//end of dropdown change function





    //show and hide filter options
    /*$("#filter").click(function () {

        $("#filterdiv").slideToggle("slow");
    });*///end of click function

    //Show and hide ask questions
    /*$("#askquestion").click(function () {
       $("#askquestiondiv").slideToggle("slow");
    });*///end of click function


    //get the area id for the topic from the dropdown
    var areaid;
    var topic;
    $("#modalAskQuestion").on('change','#area_askquestion',function () {
        areaid=$(this).find(":selected").val();
        //alert(areaid);
        if(topic!=='' && topic!==undefined){
            loadTopics(topic,areaid);
            // alert(topic);
        }
        if(topic===''){
            // alert("null");
            $("#modalAskQuestion #myTopics").empty();
        }
    });//end of #area_askquestion dropdown change

    //list all the topics when user start typing
    $("#modalAskQuestion").on('keyup',"#_txtTopics",function () {

        topic=$(this).val();
        //alert(topic);
        if(topic!=='' && topic!==undefined){
            loadTopics(topic,areaid);
        }
        if(topic===''){
            // alert("null");
            $("#modalAskQuestion #myTopics").empty();
        }
    });//end of keypress


    //call to this function will give list of topic
    function loadTopics(topic, areaid) {
        areaid = areaid == undefined ? 'area_id' : areaid;
        $.ajax({
            url: 'Factory/factory.php',
            data: {
                factory: 'listTopics',
                id: areaid,
                topic: topic
            },
            type: 'post',
            cache: false,
            success: function (topiclist) {
                if (topiclist !== "") {
                    // alert("from data" + topiclist);
                    //$("#myTopics").show("slow");
                    //alert(topiclist);
                    $("#modalAskQuestion #myTopics").empty().append(topiclist);
                }
                else {
                     //alert("from empty");
                    $("#modalAskQuestion #myTopics").empty();
                }
            }
        });//end of ajax
    }

    //this javascript object is used to initialize all the variables to be added in tbl_topics. It is then send using ajax to a function
    //in Factory.php file to save.
    var saveTopic={
        area_id:'',
        topic:'',
        description:'',
        active:true,
        created_by:'',
        topicid:''
    };
     //same function is called when adding topic and also when updating topic. When updating topic, topic id is also
    // passed to javascript object above and then passed to ajax function to save it.
    function saveTopicInformation(){
        saveTopic.area_id=$("#modalAskQuestion #area_askquestion").find(":selected").val();//get the area_id from the dropdown list.
        saveTopic.topic=$("#modalAskQuestion #_txtTopics").val();
        saveTopic.description=CKEDITOR.instances._replyeditor.getData();//to get the text in ckeditor that is in modal window.
        //below is call to ajax to get member id stored in session variable
        $.ajax({
            url: 'Factory/factory.php',
            data: {
                factory: 'getmemberid'
            },
            type: 'post',
            cache: false,
            success:function (memberid) {
                saveTopic.created_by=memberid;
                //console.log($('#error'));
                //console.log("area_id="+saveTopic.area_id+"topic="+saveTopic.topic+"Description="+saveTopic.description+"memberid="+saveTopic.created_by);
                // saveTopic.created_by did not set the member_id so i called ajax function from here so that object will send the member id.
                //this ajax function will pass the value to php function and that in turn will save the data in tbl topics.
                var jqxhr=$.post('Factory/factory.php', {factory:'saveTopics', info: JSON.stringify(saveTopic)}, function(response){
                    alert(response);

                    if(response!==''){
                        addinClass('success');
                        $(".alert #error").empty().append("<strong>Success!</strong>".response);
                    }
                }).fail(function () {
                    alert("err"+response);
                    if(response!=='') {
                        addinClass('error');//calling the function to add alert-danger class to alert class.
                        $(".alert #error").empty().append("<strong>Warning!</strong>".response);

                    }
                    console.log(response);
                });

                //console.log("member id recieved is "+memberid);
            }
        });//end of ajax function
    }

    $("#modalAskQuestion").on('click',"#_btnAskQuestion",function () {
        $(".modal-body #_btnAskQuestion").val('Create Topic for Discussion');//change the label of a button of modal window
        CKEDITOR.instances._replyeditor.setData('');
        saveTopicInformation();

    });//end of button clicked

    $('#modalAskQuestion').on('hidden.bs.modal', function () {
        getSelectedDropDownValue();
        listTopicRelatedInformation();
    });
    /*When a user clicks on the listed topic then load the question answer page*/
    // $("#main_field").on('mouseup','#topicHLink',function () {
    //     var id=$(this).attr("topicid");
    //     alert(id);
    //     $.ajax({
    //         url:'../../../View/Discussion/topicspostsview.php',
    //         data:{
    //             id:id
    //         },
    //         type:'post',
    //         cache:false,
    //         success:function (topics_detail) {
    //             $('#main_field').append(topics_detail);
    //             //console.log("hello");
    //         }
    //     });//End of aj
    //
    // });//End of .on function

    function addinClass($type) {
        switch ($type){
            case 'error':
                $(".alert").show();
                $(".alert").addClass("alert-danger");
                break;
            case 'success':
                $(".alert").show();
                $(".alert").addClass("alert-success");
                break;
        }
    }

    //call to replies function when answer is post.
    $("#postanswer").click(function () {
       getReplies();

    });//end of form submit function


    /*
    * Source:http://stackoverflow.com/questions/19503631/ajax-how-to-use-a-returned-array-in-a-success-function
    * Answered BY :Hugo Tunius Oct 21 '13 at 20:05
    * Edited BY:aendrew Apr 23 '15 at 22:11
    * Source:http://stackoverflow.com/questions/292615/how-can-i-set-the-value-of-a-dropdownlist-using-jquery
    * Answered By:Nick Berardi Nov 15 '08 at 14:38
    * Viewed on :March 26,2017 at 8:56 PM
    * */
    //when the edit link in index.php is clicked this function is called to load the information in modal window
    $(document).on("click", "#open-AddTopicDialog", function () {
        var myTopicID = $(this).data('id');
        $(".modal-body #_btnAskQuestion").val('Update Topic');//change the label of a button of modal window
        $.ajax({
            url:'Factory/factory.php',
            data:{
                factory:'getTopicInfo',
                topicid:myTopicID
            },
            type:'post',
            cache:false,
            dataType: "json",
            success:function (data) {
                $(".modal-body #area_askquestion").val(data.areaid);
                $(".modal-body #_txtTopics").val(data.topic);
                CKEDITOR.instances._replyeditor.setData(data.description);
                saveTopic.topicid=myTopicID;
            }
        });//end of ajax function

    });//end of edit link click function

    $(document).on("click", "#deleteTopic", function () {
        var confirmation=confirm("Are you sure you want to delete?");
        var delTopicID=$(this).data('id');
        if(confirmation===true){
            $.ajax({
                url:'Factory/factory.php',
                data:{
                    factory:'deleteTopic',
                    topicid:delTopicID
                },
                type:'post',
                cache:false,
                success:function (data) {
                    alert(data);
                    getSelectedDropDownValue();
                    listTopicRelatedInformation();
                }
            });//end of ajax function
        }

    });//end of delete link clicked function


    /*var queryString=getQueryString();
    var pathname = document.location.href.match(/[^\/]+$/)[0];
    pathname=pathname.slice(0,pathname.indexOf('?'));
    if(pathname==='topics-detail.php' && queryString['id']!==undefined){
        getReplies();
    }*/

    //function to load replies
    function getReplies() {
        var queryString=getQueryString();
        var id=queryString['id'];
        $.ajax({
            url:'../../../MODEL/Factory.php',
            data:{
                factory:'getReplies',
                id:id
            },
            type:'post',
            cache:false,
            success:function (replies) {
               // console.log(replies);
                $("#replies").append(replies);

            }

        });//end of ajax
    }
    /*$("#topicHLink").on("click",function () {
       var queryString=getQueryString();
       alert(queryString['id']);
       //console.log(queryString[0],queryString['page']);
    });*/
/*
*SOURCE
 * url:http://stackoverflow.com/questions/4656843/jquery-get-querystring-from-url
 * Answered on: Jan 11,2011 by benhowdle89
 * Edited Mar 7 2013 By Moshe Katz
 * View Date:Mar 12, 2017
*/
    function getQueryString() {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }

    $(document).on('click',"#updateViewCount",function () {
        var id=$(this).data('id');
        //alert(id);

       $.ajax({
           url:'Factory/factory.php',
           data:{
                factory:'updateViewCount',
                topicID:id
           },
           type:'post',
           cache:false,
           success:function(recordupdate){
                //alert("here is the error"+recordupdate);
                //alert(id);
                //sendTopicIDToReplies(id);

           }

       });//end of ajax function
    });

    /*function sendTopicIDToReplies(id){
        alert(id);
        $.post('Controller/DiscussionBoardController.php',{topicID:id},function(data){

        });
    }*/
/*When the post my answer button in replies.php is clicked. this function is going to save the user reply and reload the replies*/
    $("#_btnReply").click(function () {
        var topic_id=$(this).data('id');
        var answer=CKEDITOR.instances._replyboxeditor.getData();
        var active=true;
        var jqxhr=$.post('Factory/factory.php',{factory:'saveUserReply',topicID:topic_id,userReply:answer,status:active},function (data) {
           alert(data +" records saved successfully");
           $.post('Factory/factory.php',{factory:'reloadReplies',topicID:topic_id},function (response) {
               $("#loadReplies").empty().append(response);
               CKEDITOR.instances._replyboxeditor.setData('');
           }).fail(function () {
               alert("Reloading failed");
           });


        }).fail(function () {
            alert("something went wrong");
        });
    });//end of post my answer button click function

    var topicDetailInfo={};

    //call this method to get the topicdetailID when the edit button beside the reply in replies.php is clicked. and set the value in texteditor
    $("#main_field").on('click',".glyphicon-pencil",function () {
       // alert($(this).data('id'));
        topicDetailInfo.topicDetailID=$(this).data('id');//assign the topicdetailID so that it can be used while saving edited answer
        //Step 1. get the topicDetailID and get the reply associated witht that topicdetailID
        var jqxhr=$.post('Factory/factory.php',{factory:'getReply',topicDetailID:topicDetailInfo.topicDetailID},function (response) {
            //Step 2. set the reply in texteditor.
            //console.log(response);
            CKEDITOR.instances._updatereplyeditor.setData(response.reply);
            topicDetailInfo.topicid=response.topic_id;// we get this value because when the update button in modal window
                                                        // is clicked, we will send topicid to reload all the messages once updated.
        },'json').fail(function () {
            alert("Oops something went wrong!!")
        });

    });//end of edit button clicked function


    $(".modal-body").on('click',"#_btnUpdateReply",function () {
        //When the update button is clicked update the information.

       var updatedAnswer=CKEDITOR.instances._updatereplyeditor.getData();//to get the text in ckeditor that is in modal window.;
       var topicDetailID=topicDetailInfo.topicDetailID;
       var topicid=topicDetailInfo.topicid;
       //console.log("updated answer : "+updatedAnswer+" and id: "+topicDetailID);
       var jqxhr=$.post('Factory/factory.php',{factory:'updateReply',topicDetailId:topicDetailID,updateReply:updatedAnswer,Topic_ID:topicid},function (response) {
           alert(response +" records updated");

           $.post('Factory/factory.php',{factory:'reloadReplies',topicID:topicid},function (response) {
               $("#loadReplies").empty().append(response);
               CKEDITOR.instances._updatereplyeditor.setData('');
           }).fail(function () {
               alert("Reloading failed");
           });

       }).fail(function () {
          alert("Records could not be updated");
       });

        /*if(updatedAnswer===''){
            alert("Answer cannot be left blank");
        }*/
    });//end of update button click of modal window

    $("#main_field").on('click',".glyphicon-trash",function () {
        var topicDetailID=$(this).data('id');
        var topicid='';
        var jqxhr=$.post('Factory/factory.php',{factory:'getReply',topicDetailID:topicDetailID},function (response) {
            topicid=response.topic_id;// we get this value because when the delete button
            // is clicked, we will send topicid to reload all the messages once updated.
        },'json').fail(function () {
            alert("Oops something went wrong!!")
        });


        $.post('Factory/factory.php',{factory:'deleteReply',topicdetailid:topicDetailID},function (response) {
           alert(response+" records deleted successfully");
            $.post('Factory/factory.php',{factory:'reloadReplies',topicID:topicid},function (response) {
                $("#loadReplies").empty().append(response);

            }).fail(function () {
                alert("Reloading failed");
            });
        }).fail(function () {
            alert("Something went wrong cannot delete information.");
        });//end of ajax
    });//end of delete button clicked in replies.php


    //Chat Application
    /*var pubnub = new PubNub({
        subscribeKey: 'sub-c-4dd602ce-1edb-11e7-9093-0619f8945a4f', // always required
        publishKey: 'pub-c-d86bf8ac-1f0f-4c76-9483-da7151dae30e' // only required if publishing
    });

   pubnub.subscribe({
       channel:'mentorship'
   });*/

    /*This function is used to save the store manager*/

    var storeManager={
        //FName,MName,LName,Gender,Dob,Street,UnitNumber,UserName,Psd
        FName:'',
        MName:'',
        LName:'',
        Gender:'',
        Dob:'',
        Street:'',
        UnitNumber:'',
        UserName:'',
        Psd:'',
        VerifiedBy:''
    }

    $("#registerStoreManager").click(function () {
        $('#Register_store').find('form')[0].reset();
    })


    $("#btnSaveStoreManager").click(function () {

        storeManager.FName=$("#txtFirstName").val();
        storeManager.MName=$("#txtMiddleName").val();
        storeManager.LName=$("#txtLastName").val();
        storeManager.Gender=$("input[name=gender]:checked").val();
        storeManager.Dob=$("#txtDoB").val();
        storeManager.Street=$("#txtAddress").val();
        storeManager.UnitNumber=$("#txtUnit").val();
        storeManager.UserName=$("#txtUserName").val();
        storeManager.Psd=$("#txtpsd").val();


        $.post('Factory/factory.php',{factory:'saveStoreManager',storemanager: JSON.stringify(storeManager)},function (response) {
            //$("#Register_store").html("");
            $('#Register_store').find('form')[0].reset();
            $('#Register_store').modal('hide');
            $('#alertWindow').find('.modal-body').empty().append(response);
            $('#alertWindow').modal('show');

        }).fail(function () {
            $('#alertWindow').find('.modal-body').empty().append("Oops Something Wen Wrong!! Records is not Saved");
            $('#alertWindow').modal('show');
        });



    });//end of click function

    //clear the form in the login modal
    $("#loginAsStoreManager").click(function () {
        $("#login_store").find("#InvalidMessage").empty();
        $('#login_store').find('form')[0].reset();
    });



//this function will validate the user and navigate to storeManager dashboard.

$('#btnManagerLogin').click(function () {
    var userName=$('#login_store').find("#txtUserName").val();
    var password=$('#login_store').find("#txtpsd").val();
     //alert(userName+" "+password);

    $.post('Factory/factory.php',{factory:'managerLogin',username:userName,password:password},function (response) {
        $('#login_store').find('form')[0].reset();
       // alert(response);
        if(response>0){
            window.location = "http://localhost:8012/mentorhub/index.php?controller=dashboard&action=index";

        }
        else {
                $("#login_store").find("#InvalidMessage").empty().append("Invalid Username or Password");
        }
    }).fail(function () {
        $('#alertWindow').find('.modal-body').empty().append("Oops Something Went Wrong!! Records is not Saved");
        $('#alertWindow').modal('show');
    })
});//end of click function

//THis function saves the new store information
$("#btnRegisterStore").click(function(){

   var storeinfo={};
   storeinfo.Manager_Id=$(this).data('id');
   storeinfo.Name=$("#txtStoreName").val();
   storeinfo.StreetAddress=$("#txtAddress").val();
    storeinfo.Unit=$("#txtUnit").val();

   $.post('Factory/factory.php',{factory:'saveStore',storeInfo:JSON.stringify(storeinfo)},function (response) {
       $('#alertWindow').find('.modal-body').empty().append(response);
       $('#alertWindow').modal('show');
   }).fail(function () {
       $('#alertWindow').find('.modal-body').empty().append("Oops Something Went Wrong!! Store Registration failed");
       $('#alertWindow').modal('show');
    });


});

$("#btnUpdateStore").click(function () {
    var updateStoreinfo={};
    updateStoreinfo.Id=$("#storeID").val();
    updateStoreinfo.Manager_Id=$(this).data('id');
    updateStoreinfo.Name=$("#txtStoreName").val();
    updateStoreinfo.StreetAddress=$("#txtAddress").val();
    updateStoreinfo.Unit=$("#txtUnit").val();
    $.post('Factory/factory.php',{factory:'updateStoreInfo',updatedStoreInfo:JSON.stringify(updateStoreinfo)},function (response) {
        $('#alertWindow').find('.modal-body').empty().append(response);
        $('#alertWindow').modal('show');
    }).fail(function () {
        $('#alertWindow').find('.modal-body').empty().append("Oops Something Went Wrong!! Store Registration failed");
        $('#alertWindow').modal('show');
    })//end of ajax
});//end of update store information click


    $("#btnAddCoupon").click(function () {
        var storeCouponInformation={};
        storeCouponInformation.StoreId=$("#txtstoreId").val();
        storeCouponInformation.Amount=$('#txtAmount').val();
        storeCouponInformation.Quantity=$('#txtQuantity').val();
        storeCouponInformation.QuantityOnHand=storeCouponInformation.Quantity;

        $.post('Factory/factory.php',{factory:'addCoupon',addCoupon:JSON.stringify(storeCouponInformation)},function (response) {
            $('#alertWindow').find('.modal-body').empty().append(response);
            $('#alertWindow').modal('show');
        }).fail(function () {
            $('#alertWindow').find('.modal-body').empty().append("Oops Something Went Wrong!! Store Registration failed");
            $('#alertWindow').modal('show');
        });//end of ajax
    });//end of click function




        $.ajax({
            url:'Factory/factory.php',
            type:'post',
            data: {
                factory: 'loadCoupons'
            },
            success: function (data) {
                //console.log(data);
                $("#couponInfo tbody").empty().append(data);
            }
        });//end

    $("#btnEditCoupon").click(function () {
        var updateCoupon={};
        updateCoupon.Id=$("#txtCouponId").val();
        updateCoupon.StoreId=$("#txtStoreId").val();
        updateCoupon.Amount=$("#txtAmount").val();
        updateCoupon.Quantity=$("#txtQuantity").val();

       /* var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1;
        var yyyy = today.getFullYear();*/
        //updateCoupon.EnteredDate=yyyy-mm-dd;



        $.post('Factory/factory.php',{factory:'updateCoupon',couponInfo:JSON.stringify(updateCoupon)},function (response) {
            $('#alertWindow').find('.modal-body').empty().append(response);
            $('#alertWindow').modal('show');
        }).fail(function () {
            $('#alertWindow').find('.modal-body').empty().append("Oops Something Went Wrong!! Store Registration failed");
            $('#alertWindow').modal('show');
        });
    });//end of click

    $("#couponInfo").on('click','#btnDeleteCoupon',(function() {
        //alert("test");
        var couponID=$(this).data('id');
        $.post('Factory/factory.php',{factory:'confirmCouponDeletion',couponid:couponID},function (response) {

            if(response==true){
                var del=confirm("Are you sure you want to delete");
                if(del===true){
                    $.post('Factory/factory',{factory:'deleteCoupon',couponid:couponID},function (data) {
                        $('#alertWindow').find('.modal-body').empty().append(response);
                        $('#alertWindow').modal('show');
                    }).fail(function () {
                        $('#alertWindow').find('.modal-body').empty().append("Oops Something Went Wrong!! Store Registration failed");
                        $('#alertWindow').modal('show');
                    });//inner ajax
                }
            }
            else
            {
                alert("Sorry coupon has been subscribed cannot delete");
            }
        });//end of post

    }));//end of click function


    $("#storeList").change(function () {
        var id=$(this).find(":selected").val();
        $.post('Factory/factory.php',{factory:'getCouponsList',storeId:id},function (data) {
            $("#CouponList tbody").empty().append(data);
        });//end of ajax
    });



});//end of ready function