window.onload = function () {

    $("a.edits").click(function() {
        var linkId = this.id;

        switch (linkId){
            case "nameClick":
                document.getElementById("nameUpdate").style.display = "inline";
                break;
            case "emailClick":
                document.getElementById("emailUpdate").style.display = "inline";
                break;
            case "genderClick":
                document.getElementById("genderUpdate").style.display = "inline";
                break;
            case "dobClick":
                document.getElementById("DOBupdate").style.display = "inline";
                break;
            case "limitClick":
                document.getElementById("limitUpdate").style.display = "inline";
                break;
            case "acaClick":
                document.getElementById("academicUpdate").style.display = "inline";
                break;
            case "expClick":
                document.getElementById("experienceUpdate").style.display = "inline";
                break;
            case "desClick":
                document.getElementById("descriptionUpdate").style.display = "inline";
                break;
            case "hobbyClick":
                document.getElementById("hobbiesUpdate").style.display = "inline";
                break;
            case "pictureClick":
                document.getElementById("pictureUpdate").style.display = "inline";
                break;
        }
        return false;
    });
}