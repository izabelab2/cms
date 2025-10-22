<?php
    if($page == 'blog-add'){
        if(!isset($_SESSION['logged'])) {
            header('Location: ?page=admin');
        } else {
            $title = 'Dodaj wpis';
            $blogTitle = 'Dodaj nowy wpis';
            $blogValueName = '';
            $blogValueText = '';
            $blogMiniText = '';
            $blogFotoAlt = '';
            $blogSubmit = 'save';
            $blogId = '';

            $blogPhotoId = '';
            
            include('class/Blog.php');
            $blog = new Blog($db);
            $blogCategories = $blog->getAllBlogCategories();

            require('template/admin/blog_form.php');   
        }
    } elseif($page == 'blog-edit') {
        if(!isset($_SESSION['logged'])) {
            header('Location: ?page=admin');
        } else {
            include('class/Blog.php');
            $blog = new Blog($db);
            $blogEditing = $blog->getOneBlogPost($_GET['id']);

            $blogTitle = 'Edytuj wpis';
            $title = 'Edycja wpisu';
            $blogValueName = 'value="'.$blogEditing['name'].'"';
            $blogValueText = $blogEditing['text'];
            $blogMiniText = 'value="'.$blogEditing['text_mini'].'"';
            $blogFotoAlt = 'value="'.$blogEditing['foto_alt'].'"';
            $blogSubmit = 'edit';
            $blogId = '&id='.$blogEditing['id'];

            $blogPhotoId = '&id='.$blogEditing['foto'];

            $blogCategories = $blog->getAllBlogCategories();
            $blogCheckedCategories = $blog->getAllBlogCategoriesAndChecked();

            require('template/admin/blog_form.php'); 
        }
    } elseif($page == 'blog-list') {
        if(!isset($_SESSION['logged'])){
            header('Location: ?page=admin');
        } else {
            include('class/Blog.php');

            $blog = new Blog($db);
            $blogListing = $blog->getAllBlogPost();
            
            $title = 'Lista wpisów';
            require('template/admin/blog_list.php'); 
        }
    } elseif($page == 'blog-save') {
        if(!isset($_SESSION['logged'])) {
            header('Location: ?page=admin');
        } else {
            include('class/Blog.php');
            $blog = new Blog($db);

            if(($input->post('save')) !== null) {
                $blog->addBlogPost();
                header('Location: ?page=blog-list');
            } elseif(($input->post('edit')) !== null) {
                $blog->editBlogPost($_GET['id']);
                header('Location: ?page=blog-list');
            }
        }
    } elseif($page == 'blog-delete') {
        if(!isset($_SESSION['logged'])) {
            header('Location: ?page=admin');
        } else {
            include('class/Blog.php');
            $blog = new Blog($db);

            $blog->deleteBlogPost($_GET['id']);
            header('Location: ?page=blog-list');
        }
    }  elseif($page == 'blog-category-add'){
        if(!isset($_SESSION['logged'])) {
            header('Location: ?page=admin');
        } else {
            $title = 'Dodaj kategorię';
            $blogCategoryTitle = 'Dodaj nową kategorię';
            $blogCategoryValueName = '';
            $blogCategorySubmit = 'save';
            $blogCategoryId = '';

            require('template/admin/blog_category_form.php');   
        }
    } elseif($page == 'blog-category-save') {
        if(!isset($_SESSION['logged'])) {
            header('Location: ?page=admin');
        } else {
            include('class/Blog.php');
            $blog = new Blog($db);

            if(($input->post('save')) !== null) {
                $blog->addBlogCategory();
                header('Location: ?page=blog-categories-list');
            } elseif(($input->post('edit')) !== null) {
                $blog->editBlogCategory($_GET['id']);
                header('Location: ?page=blog-categories-list');
            }
        }
    } elseif($page == 'blog-categories-list') {
        if(!isset($_SESSION['logged'])){
            header('Location: ?page=admin');
        } else {
            include('class/Blog.php');

            $blog = new Blog($db);
            $blogCategoriesListing = $blog->getAllBlogCategories();
            
            $title = 'Lista kategorii bloga';
            require('template/admin/blog_categories_list.php'); 
        }
    } elseif($page == 'blog-category-delete') {
        if(!isset($_SESSION['logged'])) {
            header('Location: ?page=admin');
        } else {
            include('class/Blog.php');
            $blog = new Blog($db);

            $blog->deleteBlogCategory($_GET['id']);
            header('Location: ?page=blog-categories-list');
        }
    } elseif($page == 'blog-category-edit') {
        if(!isset($_SESSION['logged'])) {
            header('Location: ?page=admin');
        } else {
            include('class/Blog.php');
            $blog = new Blog($db);
            $blogCategoryEditing = $blog->getOneBlogCategory($_GET['id']);

            $blogCategoryTitle = 'Edytuj kategorię';
            $title = 'Edycja kategorii';
            $blogCategoryValueName = 'value="'.$blogCategoryEditing['name'].'"';
            $blogCategorySubmit = 'edit';
            $blogCategoryId = '&id='.$blogCategoryEditing['id'];

            require('template/admin/blog_category_form.php'); 
        }/** */
    } elseif($page == 'blog-tag-add'){
        if(!isset($_SESSION['logged'])) {
            header('Location: ?page=admin');
        } else {
            $title = 'Dodaj tag';
            $blogTagTitle = 'Dodaj nowy tag';
            $blogTagValueName = '';
            $blogTagSubmit = 'save';
            $blogTagId = '';

            require('template/admin/blog_tag_form.php');   
        }
    } elseif($page == 'blog-tag-save') {
        if(!isset($_SESSION['logged'])) {
            header('Location: ?page=admin');
        } else {
            include('class/Blog.php');
            $blog = new Blog($db);

            if(($input->post('save')) !== null) {
                $blog->addBlogTag();
                header('Location: ?page=blog-tags-list');
            } elseif(($input->post('edit')) !== null) {
                $blog->editBlogTag($_GET['id']);
                header('Location: ?page=blog-tags-list');
            }
        }
    } elseif($page == 'blog-tags-list') {
        if(!isset($_SESSION['logged'])){
            header('Location: ?page=admin');
        } else {
            include('class/Blog.php');

            $blog = new Blog($db);
            $blogTagsListing = $blog->getAllBlogtags();
            
            $title = 'Lista tagów bloga';
            require('template/admin/blog_tags_list.php'); 
        }
    } elseif($page == 'blog-tag-delete') {
        if(!isset($_SESSION['logged'])) {
            header('Location: ?page=admin');
        } else {
            include('class/Blog.php');
            $blog = new Blog($db);

            $blog->deleteBlogTag($_GET['id']);
            header('Location: ?page=blog-tags-list');
        }
    } elseif($page == 'blog-tag-edit') {
        if(!isset($_SESSION['logged'])) {
            header('Location: ?page=admin');
        } else {
            include('class/Blog.php');
            $blog = new Blog($db);
            $blogTagEditing = $blog->getOneBlogTag($_GET['id']);

            $blogTagTitle = 'Edytuj tag';
            $title = 'Edycja tagu';
            $blogTagValueName = 'value="'.$blogTagEditing['name'].'"';
            $blogTagSubmit = 'edit';
            $blogTagId = '&id='.$blogTagEditing['id'];

            require('template/admin/blog_tag_form.php'); 
        }
    } 