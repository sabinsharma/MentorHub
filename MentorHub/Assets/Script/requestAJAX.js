$(document).ready(function(){
    $("#accept_request").click(function(){
        var requestId = $("#requestId").val();
        var status = 'accept';
// Returns successful data submission message when the entered information is stored in database.
        var dataString = 'requestId='+ requestId + '&status='+ status;
        if(requestId=='')
        {
            alert("ERROR, returning requests");
        }
        else
        {
// AJAX Code To Submit Form.
            $.ajax({
                type: "POST",
                url: "?controller=requeststatus&action=status",
                data: dataString,
                cache: false,
                success: function(result){
                    setInterval(function(){
                        $("#notify").load('Views/requests/displayRequest.php')
                    }, 1);
                    document.getElementById("statusChanged").innerHTML = "Accepted";
                }
            });
        }
        return false;
    });
    $("#decline_request").click(function(){
        var requestId = $("#requestId").val();
        var status = 'decline';
// Returns successful data submission message when the entered information is stored in database.
        var dataString = 'requestId='+ requestId + '&status='+ status;
        if(requestId=='')
        {
            alert("ERROR, returning requests");
        }
        else
        {
// AJAX Code To Submit Form.
            $.ajax({
                type: "POST",
                url: "?controller=requeststatus&action=status",
                data: dataString,
                cache: false,
                success: function(result){
                    setInterval(function(){
                        $("#notify").load('Views/requests/displayRequest.php')
                    }, 1);
                    document.getElementById("statusChanged").innerHTML = "Declined";
                }
            });
        }
        return false;
    });
});