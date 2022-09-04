<?php
    include(dirname(__DIR__).'/service/userService.php');
    include(dirname(__DIR__).'/model/userModel.php');
    include_once(dirname(__DIR__).'/config.php');

	class userController {

 		function __construct() {          
			$this->config = new Config();
			$this->userService =  new userService($this->config);
		}

        public function loginfunct(){
            return $this->userService->login();
        }

        public function logoutfunct(){
            return $this->userService->logout();
        }

        public function registerfunct(){
            return $this->userService->register();
        }

    }

?>