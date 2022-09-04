<?php
    include(dirname(__DIR__).'/service/jobService.php');
    include(dirname(__DIR__).'/model/jobModel.php');
    include_once(dirname(__DIR__).'/config.php');

	class jobController {

 		function __construct() {          
			$this->config = new Config();
			$this->jobService =  new jobService($this->config);
		}

        public function listAllJobs() {
            $result = $this->jobService->findAll();      
            return $result;                         
        }

        public function listOneJob($jobid) {
            return $this->jobService->findOne($jobid);                         
        }

        public function listLangs($jobid) {
            $result = $this->jobService->findLangIds($jobid);
            $i = 0;
            while ($langid = $result->fetch_object())
            {
                $res = $this->jobService->findLangs($langid->languageid);
                $j = $res->fetch_object();
                $langs[$i] = $j->name;
                //echo $langs[$i];
                $i++;
            }

            return $langs;                         
        }


        public function listAllCompanies() {
            $result = $this->jobService->findCompanies();      
            return $result;                         
        }

        public function listCompanyJobs($companyName) {
            return $this->jobService->findCompanyJobs($companyName);                         
        }

        public function formfunct(){
            return $this->jobService->form();
        }

        public function findUserJobsFunct($userid) {
            return $this->jobService->findUserJobs($userid);                         
        }

        public function deleteJobFunct($jobid) {
            return $this->jobService->deleteJob($jobid);                         
        }


    }
		
	
?>