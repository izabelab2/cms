<?php
    require_once 'Database.php';
    require_once 'Input.php';

    class Site extends Database
    {
        public function getAllSites(): array
        {
            $allSites = [];
            $result = $this->getAll('site', 'id, name, date, visible', 'date desc');	
            
            if($result) {
                $allSites = $result;
            }
            return $allSites;
	    }

        public function addSite() 
        {
            $input = new Input();
            
            $name = $input->post('name');
            $text = $input->post('text');

            if (null !== ($input->post('visible'))) {
                $visible = 1;
            } else {
                $visible = 0;
            }
            
            $this->save('site', 'name, text, date', '"' . $name . '", "' . $text . '", NOW()');	
	    }
        
        public function deleteSite(int $id) 
        {
            $result = $this->delete('site', 'id = "'.$id.'"');
	    }

        public function getOneSite(int $id) 
        {
            $result = $this->getOne('site', 'id, name, text, visible', 'id = "'.$id.'"');
            
            return $result;
	    }

        public function editSite(int $id) 
        {
            $input = new Input();
            
            $name = $input->post('name');
            $text = $input->post('text');
            
            if (($input->post('visible')) !== null ) {
                $visible = 1;
            } else {
                $visible = 0;
            }

            $edit = "UPDATE site SET name='".$name."', text='".$text."', visible='".$visible."' WHERE id = ".$id."";
            $this->db->query($edit);
	    }

        public function visibleSite($id)
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_REQUEST['name'])) {
                    $name = $_REQUEST['name'];
                    
                    if($name) {
                        $name = true;  
                    }
                    
                    $updateVisibleSite = "UPDATE site SET visible='".$name."' WHERE id = ".$id."";

                    $this->db->query($updateVisibleSite);
                }
            }

	    }
    }