<?php
?>

<article id="recent_art01" class="row">
    <div class="col-xs-3">
        <?php echo $picOutput;?>
        <form method="post" action="index.php?controller=default&action=profile">
            <button type="submit" class="btn btn-default" name="request">Send a Request</button>
        </form>
    </div>
    <div class="col-xs-9">
        <h3 class="recent_art_title"><?php echo $nameOutput; ?></h3> <?php echo $ratingOutput; ?>
        <?php echo $genderOutput; ?>
        <?php echo $dobOutput; ?>
        <?php echo $emailOutput; ?>
        <?php echo $limitOutput; ?>
        <?php echo $startOutput;
        $countAcademic = count($academicResult);
        if($countAcademic > 0) {
            foreach ($academicResult as $academicInfo) {
                echo $academicInfo['certification'] . ' in ' . $academicInfo['program'] . '<br>';
            }
        }
        echo $endOutput; ?>
        <?php echo $experienceOutput; ?>
        <?php echo $descriptionOutput; ?>
        <?php echo $hobbiesOutput; ?>
    </div>
</article><!--END recent_art01-->
