<?php
    session_start();
    require 'config/Connection.php';  
    $action = '';

    if(isset($_REQUEST['action'])){
        $action = $_REQUEST['action'];
    }
    

    if($action == 'blog_visible'){
        include('class/Blog.php');
        $blog = new Blog($db);
        $blog->visibleSinglePost($_REQUEST['id']);
        
    }