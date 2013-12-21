<?php
class KickstarterDownloadThing {
	public $email_address;
	public $error_msg = null;
	public $logged_in = false;
	
	public function __construct() {

	}

	public function verifyEmail($email_address) {
		$email = trim(strtolower($email_address));
		$query= "SELECT * FROM users WHERE LOWER(email)='$email'";
		$result = mysql_query($query,$dblink);
		// returns number of new (unapproved/unignored) questions if true
		if (mysql_num_rows($result)) { 
			$row = mysql_fetch_assoc($result);
			return $row['fullname'];
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
			//addToList($user['email'],$user['fullname']);
			echo "$key. {$user['fullname']} / {$user['email']}<br />";
		}
	}

	public function parseFolder($folder) {
		$updates = glob($folder . "/*.csv");
		if (is_array($updates) && count($updates)) {
			foreach ($updates as $update) {
				$this->parseAndAddExport($update);
			}
		}
	}
	
	public function addToList($email1,$email2,$fullname) {
		global $dblink;
		$query = "INSERT INTO users (email,fullname) VALUES ('$email','$fullname')";
		if (mysql_query($query,$dblink)) { 
			return true;
		}
	}
}
?>