<?php
/**
 * Created by PhpStorm.
 * User: sharm
 * Date: 18/03/2017
 * Time: 3:51 PM
 */
echo "<p>This is the requested post:</p>";
foreach ($list as $post){
    echo "<p>".$post->author."</p>
         <p>".$post->content."</p>";
}




