<?php
    if($page == 'photo-add') {
        if(!isset($_SESSION['logged'])) {
            header('Location: ?page=admin');
        } else {

            $title = 'Dodaj zdjęcie';
            $siteTitle = 'Dodaj nowe zdjęcie';
            $photoValueName = '';
            $photoSubmit = 'save';
            $photoId = '';

            require('template/admin/photo_form.php');
        }
    }  elseif($page == 'photo-save') {
        if(!isset($_SESSION['logged'])) {
            header('Location: ?page=admin');
        } else {
            include('class/Gallery.php');
            $gallery = new Gallery($db);

            if(($input->post('save')) !== null) {
                $gallery->addSinglePhoto();
                header('Location: ?page=photo-list');
            } elseif(($input->post('edit')) !== null) {
                $gallery->editSinglePhoto($_GET['id']);
                header('Location: ?page=photo-list');
            }
        }
    } elseif($page == 'photo-list') {
        if(!isset($_SESSION['logged'])){
            header('Location: ?page=admin');
        } else {
            include('class/Gallery.php');

            $gallery = new Gallery($db);
            $photoListing = $gallery->getAllPhotos();

            $title = 'Lista zdjęć';
            require('template/admin/photo_list.php'); 
        }
    } elseif($page == 'photo-delete') {
        if(!isset($_SESSION['logged'])) {
            header('Location: ?page=admin');
        } else {
            include('class/Gallery.php');
            $gallery = new Gallery($db);

            $gallery->deleteSinglePhoto($_GET['id']);
            header('Location: ?page=photo-list');
        }
    }