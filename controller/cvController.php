<?php
    include(dirname(__DIR__).'/service/cvService.php');
    include(dirname(__DIR__).'/model/submitModel.php');
    include_once(dirname(__DIR__).'/config.php');

	class cvController {

 		function __construct() {          
			$this->config = new Config();
			$this->cvService =  new cvService($this->config);
		}

        public function cvlistfunct(){
            return $this->cvService->cvlist();
        }

        public function insertCVFunct($name, $file_name, $mainid, $owner) {
            return $this->cvService->insertCV($name, $file_name, $mainid, $owner);                         
        } 


    }

?>