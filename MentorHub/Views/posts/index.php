<?php
/**
 * Created by PhpStorm.
 * User: sharm
 * Date: 18/03/2017
 * Time: 3:47 PM
 */
foreach ($list as $post){
    echo "<p>".$post->author;
    echo "<a href='?controller=posts&action=show&id=".$post->id."'>Details</a></p>";

}