<?php

    require_once 'Database.php';
    require_once 'Input.php';
    abstract class Photo extends Database
    {
        protected $galleryTable;
        protected $galleryFolder;

        public function addPhoto($inputGalleryName) : void
        {
            if(!$this->isEmptyFile()) {
                return;
            }

            if (!$this->validatePhoto()) {
                return;
            }

            $fileName = $_FILES['file']['name'];
            $filePath = 'upload/'.$this->galleryFolder.'/'.$fileName;
            if(file_exists($filePath)) {
                $filePath = 'upload/'.$this->galleryFolder.'/'.rand(1,10).$fileName;
            } 
                
            $photoId = $this->savePhoto($inputGalleryName, $filePath);

            if (!$this->movePhoto($filePath)) {
                $this->deletePhoto($photoId, $this->galleryFolder, $this->galleryTable);
            }
	    }

        protected function isEmptyFile() : bool
        {
            if (empty($_FILES['file']['tmp_name'])) {
                return false;
            }

            return true;
        }

        protected function validatePhoto() : bool
        {
            
            if ($_FILES['file']['error'] > 0) {
                if($_FILES['file']['error'] == 1) {
                    echo 'Za duży rozmiar zdjęcia. Zdefiniowane w php.ini';
                } elseif ($_FILES['file']['error'] == 2) {
                    echo 'Za duży rozmiar zdjęcia. Zdefiniowane w MAX_SIZE formularza';
                } elseif ($_FILES['file']['error'] == 3) {
                    echo 'Plik wysłany częściowo';
                } elseif ($_FILES['file']['error'] == 4) {
                    echo 'Plik nie został załadowany';
                } elseif ($_FILES['file']['error'] == 6) {
                    echo 'Nie ma katalogu tymczasowego';
                } elseif ($_FILES['file']['error'] == 7) {
                    echo 'Błąd przy zapisie pliku na serwerze';
                } elseif ($_FILES['file']['error'] == 8) {
                    echo 'Błąd serwera.';
                }
                return false;
            }
            
            $filesType = array('image/jpg', 'image/jpeg', 'image/png');

            if (!in_array( $_FILES[ "file" ][ "type" ], $filesType)) {
                echo "Problem. Złe rozszerzenie pliku.";
                return false;
            }

            return true;
        }

        protected function movePhoto($filePath) : bool
        {
            if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                if (!move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
                    echo 'Problem: Plik nie może być skopiowany do katalogu';
                    return false;
                }
            } else {
                echo 'Problem: możliwy atak podczas wysyłania pliku.';
                return false;
            }

            return true;
        }

        public function savePhoto($inputGalleryName, $filePath)
        {
            $galleryName = $inputGalleryName;
            $input = new Input();

            if (null !== ($input->post('visible'))) {
                $visible = 1;
            } else{
                $visible = 0;
            }

            return $this->save($this->galleryTable, 'name, date, visible, foto', '"'.$galleryName.'", NOW(), "'.$visible.'", "'.$filePath.'"');
           
	    }

        public function deletePhoto($id, $galleryFolder, $galleryTable)
        {
            $filePath = $this->getOne($galleryFolder, 'foto', 'id = "'.$id.'"');
            $filePath = implode(",", $filePath);

            $this->unlinkFile($filePath);

            $this->delete($galleryTable, 'id = "'.$id.'"');
        }

        public function unlinkFile($filePath)
        {
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        public function getThumbnail($fileName) : string
        {
            $maxHeight = 400;
            $maxWidth = 1000;
            
            list($widthCoordinate, $heightCoordinate) = getimagesize($fileName);

            $ratioOrig = $widthCoordinate/$heightCoordinate;

            if ($maxWidth/$maxHeight < $ratioOrig) {
                $maxWidth = round($maxHeight*$ratioOrig);
            } else {
                $maxHeight = round($maxWidth/$ratioOrig);
            }

            // Korekcja
            $image_p = imagecreatetruecolor($maxWidth, $maxHeight);
            
            $photoExtention = $this->checkImageExtension($fileName);

            if($photoExtention == 'jpeg' || $photoExtention == 'jpg') {
                $image = imagecreatefromjpeg($fileName);
            } elseif($photoExtention == 'png') {
                $image = imagecreatefrompng($fileName);
            } elseif($photoExtention == 'webp') {
                $image = imagecreatefromwebp($fileName);
            } else {
              //throw new Exception('test');
              return 'testtttt';
            }
        
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $maxWidth, $maxHeight, $widthCoordinate, $heightCoordinate);

            imagejpeg($image_p, $fileName, -1);

            return '/' . $fileName;
        }
            
        protected function checkImageExtension($fileName) 
        {
            $extention = pathinfo($fileName);

            return $extention["extension"];
        }


    }