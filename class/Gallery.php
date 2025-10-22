<?php
    require_once 'Photo.php';
    require_once 'Input.php';

    class Gallery extends Photo{
        protected $galleryTable = 'gallery';
        protected $galleryFolder = 'gallery';

        public function getAllPhotos()
        {	
            $result = $this->getAll('gallery', 'id, name, date, visible, foto', 'date desc');
            return $result;	
        }
        
        public function addSinglePhoto()
        {      
            $input = new Input();
            $input_gallery_name = $input->post('name');
            
            $this->addPhoto($input_gallery_name);
        }   
	
        public function deleteSinglePhoto(int $id)
        {
            $this->deletePhoto($id, $this->galleryFolder, $this->galleryTable);
        }
	
        public function visibleSinglePhoto(int $id)
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_REQUEST['name'])) {
                    $name = $_REQUEST['name'];
                    
                    if ($name) {
                        $name = true;
                    }
                    
                    $edit = "UPDATE gallery SET visible='".$name."' WHERE id = ".$id."";
                    $this->db->query($edit);
                }
            }
        }
	
        public function getOneSinglePhoto(int $id)
        {
            $result = $this->getOne('gallery', 'id, name, visible, foto', 'id = "'.$id.'"');	
            return $result;	
        }
	
	
    }