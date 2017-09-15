<?php
/**
 * Created by PhpStorm.
 * User: sharm
 * Date: 17/03/2017
 * Time: 5:18 PM
 */
function call($controller,$action)
{
    require_once('Controller/' . $controller . 'controller.php');

    switch ($controller) {
        case 'pages':
            $controller = new PagesController();
            break;
        case 'posts':
            require_once ('Model/post.php');
            $controller=new PostsController();
            break;
        case 'discussionboard':
            $controller=new DiscussionBoard();
            break;
        case 'default':
            $controller=new DefaultController();
            break;
        case'event':
            $controller=new EventController();
            break;
        case 'exchange':
            $controller=new ExchangeController();
            break;
        case 'chatting':
            $controller=new ChattingController();
            break;
        case 'review':
            $controller=new ReviewController();
            break;
        case 'blog':
            $controller=new BlogController();
            break;
        case 'mentorsearch':
            $controller=new MentorSearchController();
            break;
        case 'dashboard':
            $controller=new DashboardController();
            break;
        case 'welcome':
            $controller=new WelcomeController();
            break;
        case 'requeststatus':
            $controller=new RequestStatusController();
            break;
        case 'sharenote':
            $controller=new ShareNoteController();
            break;
        case 'exchange':
            $controller=new ExchangeController();
            break;
        case 'message':
            $controller=new MessageController();
            break;
        case 'offer':
            $controller=new OfferController();
            break;
    }
    $controller->{$action}();
}

$controllers=array('pages'=>['home','error'],
    'posts'=>['index','show'],
    'discussionboard'=>['index','ViewReplies'],
    'default'=>['index', 'editprofile', 'submitprofile', 'profile', 'getProfile'],
    'event'=>['index','create','view'],
    'exchange'=>['index','create','view'],
    'chatting'=>['chat'],
    'review'=>['index','addReview','editReview'],
    'blog'=>['index','view','myblog','create','edit','delete'],
    'mentorsearch'=>['index'],
    'requeststatus'=>['status'],
    'dashboard'=>['index','create','edit','addCoupon','editCoupon'],
    'welcome'=>['login', 'registration', 'confirm'],
    'sharenote'=>['index','create','noteshare','sharednote'],
    'message'=>['index','create','view','send'],
    'offer'=>['index']);

if(array_key_exists($controller,$controllers)){
    if(in_array($action,$controllers[$controller])){
        call($controller,$action);
    }else{
        call('default','index');
    }
}else{
    call('default','index');
}

/*controller=blog and action=view
echo array_key_exists($controller,$controllers)."<br>";
    if(array_key_exists($controller,$controllers)){
        //echo "controller is ",$controller. " from outer if";
        if(in_array($action,$controllers[$controller])){
            //echo "controller is ",$controller." action is ".$action."from inner if";
            call($controller,$action);
        }else{
            //echo "controller is ",$controller." action is ".$action."else part inside the if";
            call('pages','error');
        }
    }else{
        //echo "controller is ",$controller."else part inside the main if";;
        call('pages','error');
    }*/
