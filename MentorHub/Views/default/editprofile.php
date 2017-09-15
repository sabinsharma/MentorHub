<?php
?>

<style>
    h3 {
        display:inline;
    }

    h4 {
        display:inline;
    }

    #nameUpdate, #genderUpdate, #DOBupdate, #emailUpdate, #limitUpdate, #academicUpdate, #experienceUpdate, #descriptionUpdate, #hobbiesUpdate, #pictureUpdate{
        display: none;
    }
</style>
<script>
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
</script>

<article id="recent_art01" class="row">
    <div class="col-xs-3">
        <?php echo $picOutput;?>
        <a href="#" class="edits" id="pictureClick">Edit Profile Picture</a>
        <div id="pictureUpdate">
            <form method="post" action="?controller=default&action=submitprofile" enctype="multipart/form-data">
                <input type="file" name="imageName" accept="image/*">
                <button type="submit" class="btn btn-default" name="upload_pic">Upload Profile Picture</button>
            </form>
        </div>
    </div>
    <div class="col-xs-9">
        <h3><?php echo $nameOutput; ?></h3>  ｜ <a href="#" class="edits" id="nameClick">Edit Name</a>
        <div id="nameUpdate">
            <form method="post" action="?controller=default&action=submitprofile">
                <div class="row">
                    <div class="col-xs-4">
                        <input type="text" class="form-control" name="fname" placeholder="First Name" value=" <?php echo $firstname;?> ">
                    </div>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" name="mname" placeholder="Middle Name" value="<?php echo $middlename;?>">
                    </div>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" name="lname" placeholder="Last Name" value="<?php echo $lastname;?>">
                    </div>
                    <button type="submit" class="btn btn-default" name="update_name">Save</button>
                </div>
            </form>
        </div>
        <br>
        <br>
        <h4>Gender</h4><?php echo $genderLinkOutput; ?>
        <?php echo $genderOutput; ?>
        <div id="genderUpdate">
            <form method="post" action="?controller=default&action=submitprofile">
                <select name="gender">
                    <option value="" disabled selected>Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select> <button type="submit" class="btn btn-default" name="update_gender">Save</button> <button type="submit" class="btn btn-default" name="delete_gender">Delete</button>
            </form>
        </div>
        <br>
        <h4>Birthday</h4><?php echo $dobLinkOutput; ?>
        <?php echo $dobOutput; ?>
        <div id="DOBupdate">
            <form method="post" action="?controller=default&action=submitprofile">
                <input type="date" name="dob">
                <button type="submit" class="btn btn-default" name="update_dob">Save</button> <button type="submit" class="btn btn-default" name="delete_dob">Delete</button>
            </form>
        </div>
        <br>
        <h4>Email</h4> ｜ <a href="#" class="edits" id="emailClick">Edit Email</a>
        <p> <?php echo $emailOutput; ?></p>
        <div id="emailUpdate">
            <form method="post" action="?controller=default&action=submitprofile">
                <input type="email" name="email" id="input-email" class="form-control" placeholder="Email address" value="<?php echo $emailOutput;?>" required>
                <button type="submit" class="btn btn-default" name="update_email">Save</button>
            </form>
        </div>
        <br>
        <h4>Mentor Limit</h4> <?php echo $limitLinkOutput; ?>
        <?php echo $limitOutput; ?>
        <div id="limitUpdate">
            <form method="post" action="?controller=default&action=submitprofile">
                <input type="number" class="form-control" name="limit" value="<?php echo $profile['mentorship_limit'];?>">
                <button type="submit" class="btn btn-default" name="update_limit">Save</button> <button type="submit" class="btn btn-default" name="delete_limit">Delete</button>
            </form>
        </div>
        <br>
        <h4>Academics and Certifications</h4> <?php echo $academicLinkOutput; ?>
        <?php
        $countAcademic = count($academicResult);
        if($countAcademic > 0) {
            foreach ($academicResult as $academicInfo) {
                echo $academicInfo['certification'] . ' in ' . $academicInfo['program'] . ' <br>';
            }
        }else{
            echo '<form method="post" action="?controller=default&action=submitprofile">
                        <textarea class="form-control" name="program" rows="1" placeholder="Program Name" required></textarea>
                        <textarea class="form-control" name="cert" rows="1" placeholder="Certification (bachelors, Masters, PhD etc.)" required></textarea>
                        <button type="submit" class="btn btn-default" name="add_academic">Add Academics and Certifications</button>
                    </form>';
        }
        ?>
        <div id="academicUpdate">
            <?php
            foreach ($academicResult as $academicInfo) {
                echo '<form method="post" action="?controller=default&action=submitprofile"> <input type="number" name="id" value="' . $academicInfo['id'] . '" hidden> <textarea class="form-control" name="program" rows="1" required>' . $academicInfo['certification'] . '</textarea>
                            <textarea class="form-control" name="cert" rows="1" required>' . $academicInfo['program']  . '</textarea> <button type="submit" class="btn btn-default" name="update_academic">Save</button> <button type="submit" class="btn btn-default" name="delete_academic">Delete</button> </form>';
            }
            ?>
            <form method="post" action="?controller=default&action=submitprofile">
                <textarea class="form-control" name="program" rows="1" placeholder="Program Name" required></textarea>
                <textarea class="form-control" name="cert" rows="1" placeholder="Certification (bachelors, Masters, PhD etc.)" required></textarea>
                <button type="submit" class="btn btn-default" name="add_academic">Add Academics and Certifications</button>
            </form>
            <hr>
        </div>
        <br>
        <h4>Experiences</h4><?php echo $experienceLinkOutput; ?>
        <?php echo $experienceOutput; ?>
        <div id="experienceUpdate">
            <form method="post" action="?controller=default&action=submitprofile">
                <textarea class="form-control" name="experience" rows="3"><?php echo $profile['experience']; ?></textarea>
                <button type="submit" class="btn btn-default" name="update_experience">Save</button> <button type="submit" class="btn btn-default" name="delete_experience">Delete</button>
            </form>
        </div>
        <br>
        <h4>Description</h4><?php echo $descriptionLinkOutput; ?>
        <?php echo $descriptionOutput; ?>
        <div id="descriptionUpdate">
            <form method="post" action="?controller=default&action=submitprofile">
                <textarea class="form-control" name="description" rows="3" required><?php echo $descriptionResult[0]['member_description'];?></textarea>
                <button type="submit" class="btn btn-default" name="update_description">Save</button> <button type="submit" class="btn btn-default" name="delete_description">Delete</button>
            </form>
        </div>
        <br>
        <h4>Hobbies</h4><?php echo $hobbiesLinkOutput; ?>
        <?php echo $hobbiesOutput; ?>
        <div id="hobbiesUpdate">
            <form method="post" action="?controller=default&action=submitprofile">
                <textarea class="form-control" name="hobby" placeholder="Edit your Hobbies" rows="3" required><?php echo $hobbiesResult[0]['hobby']; ?></textarea>
                <button type="submit" class="btn btn-default" name="update_hobbies">Save</button> <button type="submit" class="btn btn-default" name="delete_hobbies">Delete</button>
            </form>
        </div>
    </div>
</article><!--END recent_art01-->


