<?php

    if ($page == 'home') {
    } elseif ($page == 'admin') {
        $communique = '';
        include('class/User.php');

        $title = 'Logowanie';
        $user = new User($db);
	
        if($input->post('get_logged') !== null ) {
            $communique = $user->userGetLogIn();
        }	

        if(isset($_SESSION['logged'])) {
            header('Location: ?page=cms');
        }

        require('template/admin/admin.php');
    } elseif ($page == 'logout') {

        include('class/User.php');

        $user = new User($db);
        $user->userGetLogOut();

        header('Location: ?page=admin');
    } elseif ($page == 'cms') {
        if(!isset($_SESSION['logged'])) {
            header('Location: ?page=admin');
        } else{
            $title = 'Panel';
            require('template/admin/cms.php'); 
        }
    } elseif ($page == 'index') {
        $title = 'front';
        require('template/front/index.php'); 
    } elseif ($page == 'gallery') {
        include('class/Gallery.php');
        $gallery = new Gallery($db);
        $photoListing = $gallery->getAllPhotos();

        $title = 'Galeria';
        require('template/front/gallery.php'); 

    } elseif ($page == 'blog') {
        $title = 'Blog';
        require('template/front/blog.php'); 

    }