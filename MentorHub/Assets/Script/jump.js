//js for mentor search
$(document).ready(function () {
    $("#category").change(function () {
        var cat = $(this).val();
        //alert(cat);

        $.ajax({
            url:'Factory/factory.php',
            type:'post',
            data:{
                factory:'selectSubject',
                catid:cat
                },
            cache:false,
            success:function(response){
                $("#subject").empty().append(response);
            }
        });//end of ajax for category
    });//end of category value change

    $("#subject").change(function () {
        var sub = $(this).val();

        $.ajax({
            url:'Factory/factory.php',
            type:'post',
            data:{
                factory:'selectTopic',
                subid:sub
            },
            catche:false,
            success:function (response) {
                // console.log(response);
                $("#topic").empty().append(response);
            }
        });//end of ajax for subject
    });//end of subject value change

    $("#topic").change(function () {
        var topic = $(this).val();
// console.log(topic);
        $.ajax({
            url:'Factory/factory.php',
            type:'post',
            data:{
                factory:'selectMentor',
                mentId:topic
            },
            catche:false,
            success:function (response) {
               // console.log(response);
               // alert(response);
                $("#mentor-name").empty().append(response);
            }
        }); //end of ajax for mentor

        $.ajax({
            url:'Factory/factory.php',
            type:'post',
            data:{
                factory:'selectTopics',
                topicId:topic
            },
            catche:false,
            success:function (response) {
                // console.log(response);
                // alert(response);
                $("#mentor-topics").empty().append(response);
            }
        }); //end of ajax for mentor

    }); //end of topic change value

});//end of document function