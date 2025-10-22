<?php
    require_once 'Input.php';
    require_once 'Photo.php';

    class Blog extends Photo 
    {
        protected $photoFolder = 'blog';
        protected $dataBaseTable = 'blog';
        protected $blogCategoryTable = 'blog_category';
        protected $blogTagTable = 'blog_tag';
        protected $blogCategoryHelperTable = 'helper_blog_category';

        public function getAllBlogPost() : array | bool
        {           
            $result = $this->getAll("$this->dataBaseTable", 'id, name, date, visible', 'date desc');	
            return $result;	
        }

        public function addBlogPost()
        {
            $input = new Input();
            
            $titlePost = $input->post('title');
            $contentPost = $input->post('text');
            $miniContentPost = $input->post('text_mini');
            $fotoAlt = $input->post('foto_alt');
            $url = $this->slugify($titlePost);
            $filePath = '';
            $newFile = '';
            $blogPostCategoryId = $input->post('category');
            

            if (null !== ($input->post('visible'))) {
                $visiblePost = 1;
            } else {
                $visiblePost = 0;
            }
            
            if(!empty($_FILES['file']['name'])) {
                if (!$this->validatePhoto()) {
                    return;
                }
           
                $fileName = $_FILES['file']['name'];
                $filePath = 'upload/'.$this->photoFolder.'/'.$fileName;
                if(file_exists($filePath)) {
                    $filePath = 'upload/'.$this->photoFolder.'/'.rand(1,10).$fileName;
                } 
                $this->movePhoto($filePath);
                

                $newfilePath = explode($fileName, $filePath);
                $newFile = $newfilePath [0].'min_'.$fileName;


                copy($filePath, $newFile);
        
                $photoThumbnail = $this->getThumbnail($newFile);

                if (empty($photoThumbnail)) {
                    $this->unlinkFile($filePath);
                    $this->unlinkFile($newFile);
                    return false;
                }           
            }

            $this->save("$this->dataBaseTable", 'name, text, text_mini, date, visible, foto, foto_mini, foto_alt, url', '"' . $titlePost . '", "' . $contentPost . '", "' . $miniContentPost . '", NOW(), "'.$visiblePost.'", "'.$filePath.'", "'.$newFile.'", "'.$fotoAlt.'", "'.$url.'"');
            
            $blogPostId = $this->db->insert_id;

            if(!empty($blogPostCategoryId)) {
                foreach($blogPostCategoryId as $check) {
                    $this->save("$this->blogCategoryHelperTable ", 'id_blog, id_category', '"' . $blogPostId . '", "' . $check . '"');
                    
                }
            }
   
        }  
            
        public function deleteBlogPost(int $id)
        {

            $filePath = $this->getOne($this->photoFolder, 'foto', 'id = "'.$id.'"');
            $filePath = implode(",", $filePath);

            $minFilePath = $this->getOne($this->photoFolder, 'foto_mini', 'id = "'.$id.'"');
            $minFilePath = implode(",", $minFilePath);

            if (file_exists($filePath)) 
            {
                $files = array($filePath, $minFilePath);
                foreach ($files as $file) {
                    unlink($file);    
                }
            }

            $this->delete("$this->dataBaseTable", 'id = "'.$id.'"');
	    }

        public function getOneBlogPost(int $id)
        {
            $result = $this->getOne("$this->dataBaseTable", 'id, name, text, text_mini, visible, foto, foto_mini, foto_alt, url', 'id = "'.$id.'"');

            return $result;            
	    }

        function getOneBlogPostbyUrl($url)
        {
            $result = $this->getOne("$this->dataBaseTable", 'id, name, text, text_mini, foto, foto_mini, foto_alt, date, url', 'url = "'.$url.'"');

            return $result;            
	    }

        public function editBlogPost(int $id)
        {
            $input = new Input();

            $titlePost = $input->post('title');
            $contentPost = $input->post('text');
            $miniContentPost = $input->post('text_mini');
            $fotoAlt = $input->post('foto_alt');
            $url = $this->slugify($titlePost);
            
            $filePath = $this->getOne($this->photoFolder, 'foto', 'id = "'.$id.'"');
            $filePath = implode(",", $filePath);
            
            $newFileName = $_FILES['file']['name'];
            $newFilePath = 'upload/'.$this->photoFolder.'/'.$newFileName;

            $minFilePath = $this->getOne($this->photoFolder, 'foto_mini', 'id = "'.$id.'"');
            $minFilePath = implode(",", $minFilePath);

            
            if($newFileName != '') {
                
                unlink($filePath);
                $newFilePath = 'upload/'.$this->photoFolder.'/'.rand(1,10).$newFileName;
                
                if (!$this->validatePhoto()) {
                    return;
                }
                $this->movePhoto($newFilePath);
                $filePath = $newFilePath;
                

                $minFilePath = $this->getOne($this->photoFolder, 'foto_mini', 'id = "'.$id.'"');
                $minFilePath = implode(",", $minFilePath);
                
                $newfile = 'upload/'.$this->photoFolder.'/min_'.$newFileName;

                copy($newFilePath, $newfile);
                $newMiniPhoto = $this->getThumbnail($newfile);


                unlink($minFilePath);
                $this->movePhoto($newfile);
                $minFilePath = $newMiniPhoto;
            }
        
                

            if (null !== ($input->post('visible'))) {
                $visiblePost = 1;
            } else {
                $visiblePost = 0;
            }
            
            $editPost = "UPDATE $this->dataBaseTable SET name='".$titlePost."', text='".$contentPost."', text_mini='".$miniContentPost."', visible='".$visiblePost."', foto='".$filePath."', foto_mini='".$minFilePath."', foto_alt='".$fotoAlt."', url='".$url."' WHERE id = ".$id."";
            
            $this->db->query($editPost);
	    }

        public function visibleSinglePost($id){

            $input = new Input();

            if (!$input->isNumber($id)) {
                return false;
            }
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_REQUEST['name'])) {
                    $name = $_REQUEST['name'];
                        
                   
                    $edit = "UPDATE $this->dataBaseTable SET visible='".$name."' WHERE id = ".$id."";
                    $this->db->query($edit);
                }
            }
        }

        public function addBlogCategory() {
            $input = new Input();
            
            $blogCategoryName = $input->post('title');   

            $this->save("$this->blogCategoryTable", 'name', '"' . $blogCategoryName . '"');
        }

        public function getAllBlogCategories() : array | bool 
        {
            $result = $this->getAll("$this->blogCategoryTable", 'id, name', 'id');	
            return $result;	
        }

        public function getAllBlogCategoriesAndChecked() : array | bool 
        {
            $query = "SELECT blog_category.id, blog_category_name, helper_blog_category.id, helper_blog_category.id_category FROM blog_category LEFT JOIN OUTER helper_blog_category ON blog_category.id = helper_blog_category.blog_id";
            $result = $this->db->query($query);

            if ($result->num_rows > 0) {
                for ($i=0; $i<$result->num_rows; $i++) {
                    $array[] = $result->fetch_assoc();
                }
                return $array;
            } else {
                return false;
            }
        }
        
        public function deleteBlogCategory(int $id) {
            $this->delete("$this->blogCategoryTable", 'id = "'.$id.'"');
        }

        public function getOneBlogCategory(int $id) {
            $result = $this->getOne("$this->blogCategoryTable", 'id, name', 'id = "'.$id.'"');

            return $result;  
        }

        public function editBlogCategory(int $id) {
            $input = new Input();

            $nameBlogCategory = $input->post('title');

            $editBlogCategory = "UPDATE $this->blogCategoryTable SET name='".$nameBlogCategory."' WHERE id = ".$id."";
            
            $this->db->query($editBlogCategory);
        }

        public function getCategoriesForOneBlogPost(int $id) {
            $query = "SELECT id_category FROM helper_blog_category WHERE id_blog = ".$id."";
            
            $result = $this->db->query($query);

            if ($result->num_rows > 0) {
                for ($i=0; $i<$result->num_rows; $i++) {
                    $array[] = $result->fetch_assoc();
                }
                return $array;
            } else {
                return false;
            }
        }

        public function addBlogTag() {
            $input = new Input();
            
            $tagBlogName = $input->post('title');   

            $this->save("$this->blogTagTable", 'name', '"' . $tagBlogName . '"');
        }

        public function getAllBlogTags() : array | bool 
        {
            $result = $this->getAll("$this->blogTagTable", 'id, name', 'id');	
            return $result;	
        }

        public function deleteBlogTag(int $id) {
            $this->delete("$this->blogTagTable", 'id = "'.$id.'"');
        }

        public function getOneBlogTag(int $id) {
            $result = $this->getOne("$this->blogTagTable", 'id, name', 'id = "'.$id.'"');

            return $result;  
        }

        public function editBlogTag(int $id) {
            $input = new Input();

            $nameBlogTag = $input->post('title');

            $editTag = "UPDATE $this->blogTagTable SET name='".$nameBlogTag."' WHERE id = ".$id."";
            
            $this->db->query($editTag);
        }

        protected static function slugify($text, string $divider = '-')
        {
            $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
            $text = preg_replace('~[^-\w]+~', '', $text);
            $text = trim($text, $divider);
            $text = preg_replace('~-+~', $divider, $text);
            $text = strtolower($text);

            if (empty($text)) {
                return 'n-a';
            }

            return $text;
        }
    }