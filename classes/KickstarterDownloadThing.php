<?php
class KickstarterDownloadThing {
	public $email_address;
	public $error_msg = null;
	public $logged_in = false;
	public $backers = array();
	
	public function __construct() {
		$this->parseDataFolder();
	}

	public function verifyEmail($email_address) {
		$email = trim(strtolower($email_address));
		if (array_key_exists($email, $this->backers)) {
			return true;
		} else {
			return false;
		}
	}

	public function parseAndAddExport($file) {
		$backers = array();
		$output = array();
		$handle = fopen($file, "r");
		$currentline = 0;

		if ($handle) {
			$firstline = fgetcsv($handle, 4096, ",");
			while (($data = fgetcsv($handle, 4096, ",")) !== FALSE) {
				$backers[$currentline] = array();
				foreach ($data as $current => $col) {
					$backers[$currentline][$firstline[$current]] = $col;
				}
				$currentline++;
			}
			fclose($handle);
		}
		
		foreach ($backers as $backer) {
			if ($backer['Pledged Status'] == 'collected') {
				$output[] = array(
					'email' => $backer['Email'],
					'fullname' => $backer['Backer Name']
				);
			}
		}
		
		foreach ($output as $key => $user) {
			$this->addToList($user['email'],$user['fullname']);
		}
	}

	public function parseDataFolder() {
		$updates = glob(DATA_LOCATION . "/*.csv");
		if (is_array($updates) && count($updates)) {
			foreach ($updates as $update) {
				$this->parseAndAddExport($update);
			}
		}
	}
	
	public function addToList($email,$fullname) {
		$this->backers[trim(strtolower($email))] = $fullname;
	}
}
?>