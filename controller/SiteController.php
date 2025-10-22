<?php
    if($page == 'site-add'){
        if(!isset($_SESSION['logged'])) {
            header('Location: ?page=admin');
        } else {
            $title = 'Dodaj stronę';
            $siteTitle = 'Dodaj nową podstronę';
            $siteValueName = '';
            $siteValueText = '';
            $siteSubmit = 'save';
            $siteId = '';

            require('template/admin/site_form.php');   
        }
    } elseif($page == 'site-edit') {
        if(!isset($_SESSION['logged'])) {
            header('Location: ?page=admin');
        } else {
            include('class/Site.php');
            $site = new Site($db);
            $siteEditing = $site->getOneSite($_GET['id']);

            $siteTitle = 'Edytuj podstronę';
            $title = 'Edycja podstrony';
            $siteValueName = 'value="'.$siteEditing['name'].'"';
            $siteValueText = $siteEditing['text'];
            $siteSubmit = 'edit';
            $siteId = '&id='.$siteEditing['id'];

            require('template/admin/site_form.php'); 
        }
    } elseif($page == 'site-list') {
        if(!isset($_SESSION['logged'])){
            header('Location: ?page=admin');
        } else {
            include('class/Site.php');

            $site = new Site($db);
            $siteListing = $site->getAllSites();
            
            $title = 'Lista podstron';
            require('template/admin/site_list.php'); 
        }
    } elseif($page == 'site-save') {
        if(!isset($_SESSION['logged'])) {
            header('Location: ?page=admin');
        } else {
            include('class/Site.php');
            $site = new Site($db);

            if(($input->post('save')) !== null) {
                $site->addSite();
                header('Location: ?page=site-list');
            } elseif(($input->post('edit')) !== null) {
                $site->editSite($_GET['id']);
                header('Location: ?page=site-list');
            }
        }
    } elseif($page == 'site-delete') {
        if(!isset($_SESSION['logged'])) {
            header('Location: ?page=admin');
        } else {
            include('class/Site.php');
            $site = new Site($db);

            $site->deleteSite($_GET['id']);
            header('Location: ?page=site-list');
        }
    }