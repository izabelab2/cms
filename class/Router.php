<?php

    class Router
    {
	private $routeMap = [
            'home' => 'Index',
            'admin' => 'Index',
            'logout' => 'Index',
            'cms' => 'Index',
            'forgot-password' => 'Index',
            'change-password' => 'Index',
            'photo-add' => 'Gallery',
            'photo-edit' => 'Gallery',
            'photo-form' => 'Gallery',
            'photo-list' => 'Gallery',
            'photo-save' => 'Gallery',
            'photo-delete' => 'Gallery',
            'site-add' => 'Site',
            'site-edit' => 'Site',
            'site-list' => 'Site',
            'site-save' => 'Site',
            'site-delete' => 'Site',
            'blog-add' => 'Blog',
            'blog-edit' => 'Blog',
            'blog-save' => 'Blog',
            'blog-delete' => 'Blog',
            'blog-list' => 'Blog',
            'index' => 'Index',
            'gallery' => 'Index',
            'blog' => 'Index',
            'blog-category-add' => 'Blog',
            'blog-category-save' => 'Blog',
            'blog-categories-list' => 'Blog',
            'blog-category-delete' => 'Blog',
            'blog-category-edit' => 'Blog',
            'blog-tag-add' => 'Blog',
            'blog-tag-save' => 'Blog',
            'blog-tags-list' => 'Blog',
            'blog-tag-delete' => 'Blog',
            'blog-tag-edit' => 'Blog'
            
 

	];
	
	public function getController($page)
	{
            $controller = $this->routeMap[$page];

            return $controller;	
            
	}
	
}