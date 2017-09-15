<?php

/**
 * Created by PhpStorm.
 * User: sharm
 * Date: 6/04/2017
 * Time: 12:03 PM
 */
require_once ('Model/CRUD.php');
class DefaultController
{
    public function getProfile(){
        require_once '/Views/guitar_hero.php';
    }
    public function index(){
        require_once 'Views/default/default.php';
    }

    /*Caelia*/
    public function editprofile()
    {
        if(session_status()==PHP_SESSION_NONE){
            session_start();
        }

        $userId = $_SESSION['member_id'];
        $profileId = $_SESSION['member_id'];

        $profileInfo = new CRUD();
        $profileResult = $profileInfo->getProfileInfo($userId);

        $firstname = $profileResult[0]['first_name'];
        $middlename = $profileResult[0]['middle_name'];
        $lastname = $profileResult[0]['last_name'];

        $nameOutput = $firstname . ' ' . $middlename . ' ' . $lastname;
        $emailOutput = $profileResult[0]['email'];

        foreach ($profileResult as $profile) {
            if ($profile['gender']) {
                $genderLinkOutput = ' ｜ <a href="#" class="edits" id="genderClick">Edit Gender</a> ';
                $genderOutput = '<p>' . $profile['gender'] . '</p>';
            } else {
                $genderLinkOutput  = "</br>";
                $genderOutput = '<form method="post" action="?controller=default&action=submitprofile">
                            <select name="gender">
                              <option value="" disabled selected>Select</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                              <option value="Other">Other</option>
                            </select> <button type="submit" class="btn btn-default" name="add_gender">Save Gender Selection</button> </form>';
            }

            if ($profile['dob']) {
                $dobLinkOutput = ' ｜ <a href="#" class="edits" id="dobClick">Edit Birthday</a>';
                $dobOutput = '<p>' . $profile['dob'] . ' </p>';
            } else {
                $dobLinkOutput  = "</br>";
                $dobOutput = '<form method="post" action="?controller=default&action=submitprofile"> <input type="date" name="dob"> <button type="submit" class="btn btn-default" name="add_dob">Save Birthday</button> </form>';
            }

            if ($profile['mentorship_limit']) {
                $limitLinkOutput = ' ｜ <a href="#" class="edits" id="limitClick">Edit Limit</a>';
                $limitOutput = '<p>' . $profile['mentorship_limit'] . ' </p>';
            } else {
                $limitLinkOutput  = "</br>";
                $limitOutput = '<form method="post" action="?controller=default&action=submitprofile"> <input type="number" class="form-control" name="limit" placeholder="Enter Limit Value (Must be a Numeric Value)"> <button type="submit" class="btn btn-default" name="add_limit">Save Limit</button> </form>';
            }

            if ($profile['experience']) {
                $experienceLinkOutput = ' ｜ <a href="#" class="edits" id="expClick">Edit Experience</a> ';
                $experienceOutput = '<p>' . $profile['experience'] . '</p>';
            } else {
                $experienceLinkOutput  = "</br>";
                $experienceOutput = '<form method="post" action="?controller=default&action=submitprofile"> <textarea class="form-control" name="experience" placeholder="Input your Experiences" rows="3"></textarea>
                    <button type="submit" class="btn btn-default" name="add_experience">Add Experiences</button> </form>';
            }

            if ($profile['pic_path']) {
                $picPath = $profile['pic_path'];
                $picOutput = "<img src=\"data:image / jpeg;base64," . base64_encode($picPath) . "\" alt=\"thumb01\">";
            } else {
                $picOutput = "<img src=\"image/user.png\" alt=\"user01\">";
            }
        }

        $descriptionResult = $profileInfo->getDescription($userId);

        if ($descriptionResult[0]['member_description']) {
            $descriptionLinkOutput = ' ｜ <a href="#" class="edits" id="desClick">Edit Description</a> ';
            $descriptionOutput = '<p>' . $descriptionResult[0]['member_description'] . '</p>';
        } else {
            $descriptionLinkOutput = "</br>";
            $descriptionOutput = '<form method="post" action="?controller=default&action=submitprofile"> <textarea class="form-control" name="description" placeholder="Input your Description" rows="3"></textarea>
                    <button type="submit" class="btn btn-default" name="add_description">Add Description</button> </form>';
        }

        $hobbiesResult = $profileInfo->getHobbies($userId);

        $countHobbies = count($hobbiesResult);
        if ($countHobbies > 0) {
            $hobbiesLinkOutput = ' ｜ <a href="#" class="edits" id="hobbyClick">Edit Hobby</a>';
            $hobbiesOutput = '<p>' . $hobbiesResult[0]['hobby'] . '</p>';
        } else {
            $hobbiesLinkOutput  = "</br>";
            $hobbiesOutput = '<form method="post" action="?controller=default&action=submitprofile"> <textarea class="form-control" name="hobbies" placeholder="Input your Hobbies" rows="3"></textarea>
                    <button type="submit" class="btn btn-default" name="add_hobbies">Add Hobbies</button> </form>';
        }

        $academicResult = $profileInfo->getAcademic($userId);

        $countAcademic = count($academicResult);
        if ($countAcademic > 0) {
            $academicLinkOutput = ' ｜ <a href="#" class="edits" id="acaClick">Edit Academic and Certification</a> </br>';
        } else {
            $academicLinkOutput = "</br>";
        }

        require_once ('Views/default/editprofile.php');
    }


    public function submitprofile(){

        if(session_status()==PHP_SESSION_NONE){
            session_start();
        }

        $profileId = $_SESSION['member_id'];
        $delete = '';

        $modifyProfile = new CRUD();
        $profileInfo = new CRUD();


        if(isset($_POST['upload_pic'])){
            $imgData = file_get_contents($_FILES['imageName']['tmp_name']);
            $imgSize = $_FILES['imageName']['size'];

            if($imgSize < 5000000)    {
                $modifyProfile->addPicture($profileId, $imgData);

                echo'<script>window.location="?controller=default&action=editprofile";</script>';
            } else{
                echo '<script language="javascript">';
                echo 'alert("file too large")';
                echo '</script>';
            }
        }

        if(isset($_POST['update_name'])){
            $firstname = $_POST['fname'];
            $middlename = $_POST['mname'];
            $lastname = $_POST['lname'];

            $modifyProfile->updateName($profileId, $firstname, $middlename, $lastname);

            echo'<script>window.location="?controller=default&action=editprofile";</script>';
        }

        if(isset($_POST['update_gender'])){
            $gender = $_POST['gender'];

            $modifyProfile->addGender($gender, $profileId);

            echo'<script>window.location="?controller=default&action=editprofile";</script>';
        }

        if(isset($_POST['delete_gender'])){
            $modifyProfile->deleteGender($delete, $profileId);

            echo'<script>window.location="?controller=default&action=editprofile";</script>';
        }

        if(isset($_POST['update_email'])){
            $email = $_POST['email'];

            $modifyProfile->updateEmail($profileId, $email);

            echo'<script>window.location="?controller=default&action=editprofile";</script>';
        }

        if(isset($_POST['update_dob'])){
            $dob = $_POST['dob'];

            $modifyProfile->addDOB($dob, $profileId);

            echo'<script>window.location="?controller=default&action=editprofile";</script>';
        }

        if(isset($_POST['delete_dob'])){
            $modifyProfile->deleteDOB($delete, $profileId);

            echo'<script>window.location="?controller=default&action=editprofile";</script>';
        }

        if(isset($_POST['update_limit'])){
            $limit = $_POST['limit'];

            $modifyProfile->addLimit($limit, $profileId);

            echo'<script>window.location="?controller=default&action=editprofile";</script>';
        }

        if(isset($_POST['delete_limit'])){
            $modifyProfile->deleteLimit($delete, $profileId);

            echo'<script>window.location="?controller=default&action=editprofile";</script>';
        }

        if(isset($_POST['update_experience'])){
            $exp = $_POST['experience'];

            $modifyProfile->addExperience($exp, $profileId);

            echo'<script>window.location="?controller=default&action=editprofile";</script>';
        }

        if(isset($_POST['delete_experience'])){
            $modifyProfile->deleteExperience($delete, $profileId);

            echo'<script>window.location="?controller=default&action=editprofile";</script>';
        }

        if(isset($_POST['update_description'])){
            $des = $_POST['description'];

            $modifyProfile->addDescription($des, $profileId);

            echo'<script>window.location="?controller=default&action=editprofile";</script>';
        }

        if(isset($_POST['delete_description'])){
            $modifyProfile->deleteDescription($delete, $profileId);

            echo'<script>window.location="?controller=default&action=editprofile";</script>';
        }

        if(isset($_POST['update_hobbies'])){
            $hobby = $_POST['hobby'];

            $modifyProfile->updateHobbies($profileId, $hobby);

            echo'<script>window.location="?controller=default&action=editprofile";</script>';
        }

        if(isset($_POST['delete_hobbies'])){
            $modifyProfile->deleteHobbies($profileId);

            echo'<script>window.location="?controller=default&action=editprofile";</script>';
        }

        if(isset($_POST['update_academic'])){
            $id = $_POST['id'];
            $program = $_POST['program'];
            $cert = $_POST['cert'];

            $modifyProfile->updateAcademics($id, $cert, $program);

            echo'<script>window.location="?controller=default&action=editprofile";</script>';
        }

        if(isset($_POST['delete_academic'])){
            $id = $_POST['id'];

            $modifyProfile->deleteAcademic($id);

            echo'<script>window.location="?controller=default&action=editprofile";</script>';
        }

        if(isset($_POST['add_gender'])){
            $gender = $_POST['gender'];

            $modifyProfile->addGender($gender, $profileId);

            echo'<script>window.location="?controller=default&action=editprofile";</script>';
        }

        if(isset($_POST['add_dob'])){
            $dob = $_POST['dob'];

            $modifyProfile->addDOB($dob, $profileId);

            echo'<script>window.location="?controller=default&action=editprofile";</script>';
        }

        if(isset($_POST['add_limit'])){
            $limit = $_POST['limit'];

            $modifyProfile->addLimit($limit, $profileId);

            echo'<script>window.location="?controller=default&action=editprofile";</script>';
        }

        if(isset($_POST['add_experience'])){
            $exp = $_POST['experience'];

            $modifyProfile->addExperience($exp, $profileId);

            echo'<script>window.location="?controller=default&action=editprofile";</script>';
        }

        if(isset($_POST['add_description'])){
            $des = $_POST['description'];

            $modifyProfile->addDescription($des, $profileId);

            echo'<script>window.location="?controller=default&action=editprofile";</script>';
        }

        if(isset($_POST['add_hobbies'])){
            $hobbies = $_POST['hobbies'];

            $modifyProfile->addHobbies($hobbies, $profileId);

            echo'<script>window.location="?controller=default&action=editprofile";</script>';
        }

        if(isset($_POST['add_academic'])){
            $program = $_POST['program'];
            $cert = $_POST['cert'];

            $modifyProfile->addAcademic($profileId, $cert, $program);

            echo'<script>window.location="?controller=default&action=editprofile";</script>';
        }
    }

    public function profile(){

        if(session_status()==PHP_SESSION_NONE){
            session_start();
        }

        //need to get profile id
        //$profileId = $_SESSION['profile_id'];

        // setting default profileid
        $profileId = '11111';

        $profileInfo = new CRUD();
        $profileResult = $profileInfo->getProfileInfo($profileId);

        $firstname = $profileResult[0]['first_name'];
        $middlename = $profileResult[0]['middle_name'];
        $lastname = $profileResult[0]['last_name'];

        $nameOutput = $firstname . ' ' . $middlename . ' ' . $lastname;
        $emailOutput = '<p> Email: ' . $profileResult[0]['email'] . '</p>';

        foreach ($profileResult as $profile){
            if($profile['gender']){
                $genderOutput = '<p>Gender: ' . $profile['gender'] . '</p>';
            }else{
                $genderOutput = '';
            }

            if ($profile['dob']){
                $dobOutput = '<p>Birthday: ' . $profile['dob'] . '</p>';
            }else{
                $dobOutput = '';
            }

            if ($profile['average_star_rating']){
                $ratingOutput = '<p>' . $profile['average_star_rating'] . '</p>';
            }else{
                $ratingOutput = '';
            }

            if ($profile['mentorship_limit']){
                $limitOutput = '<p> Mentor Limit: ' . $profile['mentorship_limit'] . '</p>';
            }else{
                $limitOutput = '';
            }

            if ($profile['experience']){
                $experienceOutput = '<p> Experience: ' . $profile['experience'] . '</p>';
            }else{
                $experienceOutput = '';
            }

            if ($profile['pic_path']){
                $picPath = $profile['pic_path'];
                $picOutput = "<img src=\"data:image/jpeg;base64," . base64_encode( $picPath ) . "\" alt=\"thumb01\">";
            }else{
                $picOutput = "<img src=\"image/user.png\" alt=\"user01\">";
            }
        }

        $descriptionResult = $profileInfo->getDescription($profileId);

        if ($descriptionResult[0]['member_description']){
            $descriptionOutput = '<p>Description: ' . $descriptionResult[0]['member_description'] . '</p>';
        }else{
            $descriptionOutput = '';
        }

        $hobbiesResult = $profileInfo->getHobbies($profileId);

        $countHobbies = count($hobbiesResult);
        if ($countHobbies > 0){
            $hobbiesOutput = '<p>Hobbies: ' . $hobbiesResult[0]['hobby'] . '</p>';
        }else{
            $hobbiesOutput = '';
        }

        $academicResult = $profileInfo->getAcademic($profileId);

        $countAcademic = count($academicResult);
        if($countAcademic > 0) {
            $startOutput = '<p> Academics and Certifications: ';
            $endOutput = '</p>';
        }else{
            $startOutput = '';
            $endOutput = '';
        }

        //send request
        $request = new CRUD();

        if(isset($_POST['request'])){
            $userId = $_SESSION['member_id'];

            $request->sendRequest($userId, $profileId);

            echo'<script>alert("request sent");</script>';
        }

        require_once ('Views/default/profile.php');
    }
}