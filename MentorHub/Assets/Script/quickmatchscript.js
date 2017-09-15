$(document).ready(function (){

    //When the RANDOM button is clicked, do this

    $("#randomBtn").click(function(){

        $.ajax({    //this ajax call sends the data (the key-value pairs job:"getmessage" etc) to messages.php
            url: "Factory/responsedata.php",
            data: {
                job:"randomize"
            },
            type: "post",
            cache: false,
            success: function(data){

                $("#main_user").empty().append(data); //Empty the div containing all the messages and isert the new XML data

            }
        });
    });


    //When the NEW button is clicked, do this

    $("#newBtn").click(function(){

        $.ajax({    //this ajax call sends the data (the key-value pairs job:"getmessage" etc) to messages.php
            url: "Factory/responsedata.php",
            data: {
                job:"new"
            },
            type: "post",
            cache: false,
            success: function(data){

                $("#main_user").empty().append(data); //Empty the div containing all the messages and isert the new XML data

            }
        });
    });


    //When the ONLINE button is clicked, do this

    $("#onlineBtn").click(function(){

        $.ajax({    //this ajax call sends the data (the key-value pairs job:"getmessage" etc) to messages.php
            url: "Factory/responsedata.php",
            data: {
                job:"online"
            },
            type: "post",
            cache: false,
            success: function(data){

                $("#main_user").empty().append(data); //Empty the div containing all the messages and isert the new XML data

            }
        });
    });

    //When the FEATURED button is clicked, do this

    $("#featuredBtn").click(function(){

        $.ajax({    //this ajax call sends the data (the key-value pairs job:"getmessage" etc) to messages.php
            url: "Factory/responsedata.php",
            data: {
                job:"featured"
            },
            type: "post",
            cache: false,
            success: function(data){

                $("#main_user").empty().append(data); //Empty the div containing all the messages and isert the new XML data

            }
        });
    });

    $("#nearbyBtn").click(function(){

        $.ajax({    //this ajax call sends the data (the key-value pairs job:"getmessage" etc) to messages.php
            url: "Factory/responsedata.php",
            data: {
                job:"nearby"
            },
            type: "post",
            cache: false,
            success: function(data){

                $("#main_user").empty().append(data); //Empty the div containing all the messages and isert the new XML data

            }
        });
    });





}); //end of ready function