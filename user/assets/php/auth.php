<?php 

	require_once 'config.php';

	class Auth extends Database {

		//Register New User
		public function register($name, $email, $password) {
			$sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :pass)";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['name'=>$name, 'email'=>$email, 'pass'=>$password]);
			return true;
		}

		//Check if user already registred
		public function user_exist($email){
			$sql = "SELECT email FROM users WHERE email = :email";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['email'=>$email]);
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return $result;
		}

		//Login Existing User
		public function login($email){
			$sql = "SELECT email, password FROM users WHERE email = :email AND deleted != 1";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['email'=>$email]);
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			return $row;
		}

		//Check if user already registred
		public function currentUser($email){
			$sql = "SELECT * FROM users WHERE email = :email AND deleted != 1";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['email'=>$email]);
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			return $row;
		}

		//Forgot Password
		public function forgot_password($token, $email){
			$sql = "UPDATE users SET token = :token, token_expire = DATE_ADD(NOW(), INTERVAL 10 MINUTE) WHERE email = :email";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['token'=>$token, 'email'=>$email]);
			return true;
		}

		//Reset Password User Auth
		public function reset_pass_auth($email, $token){
            $sql = "SELECT id FROM users WHERE email = :email AND token = :token AND token != '' AND token_expire > NOW() AND deleted != 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email'=>$email, 'token'=>$token]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

		//Update New Password
		public function update_new_pass($pass, $email){
			$sql = "UPDATE users SET token = '', password = :pass WHERE email = :email AND deleted != 1";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['pass'=>$pass, 'email'=>$email]);
			return true;
		}

		//Add New Note
		public function add_new_note($uid, $title, $note){
			$sql = "INSERT INTO notes (uid, title, note) VALUES (:uid, :title, :note)";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['uid'=>$uid, 'title'=>$title, 'note'=>$note]);
			return true;
		}

		// Fetch all notes of user
		public function get_notes($uid){
			$sql = "SELECT * FROM notes WHERE uid = :uid";
			$stmt = $this->conn->prepare($sql);
            $stmt->execute(['uid'=>$uid]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
		}

		// Edit note of an user
		public function edit_note($id){
			$sql = "SELECT * FROM notes WHERE id = :id";
			$stmt = $this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
		}

		//Update note of an user
		public function update_note($id, $title, $note){
			$sql = "UPDATE notes SET title = :title, note = :note, updated_at = NOW() WHERE id = :id";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['title'=>$title, 'note'=>$note, 'id'=>$id]);
			return true;
		}

		//Delete note of an user
		public function delete_note($id){
			$sql = "DELETE FROM notes WHERE id = :id";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['id'=>$id]);
			return true;
		}

		//Update User Profile
		public function update_profile($name,$gender,$dob,$phone,$photo,$address,$city,$state,$zipcode,$country,$id){
			$sql = "UPDATE users SET name = :name, gender = :gender, dob = :dob, phone = :phone, photo = :photo, address = :address, city = :city, state = :state, zip_code = :zipcode, country = :country WHERE id = :id AND deleted != 1";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['name'=>$name, 'gender'=>$gender, 'dob'=>$dob, 'phone'=>$phone, 'photo'=>$photo, 'address'=>$address, 'city'=>$city, 'state'=>$state, 'zipcode'=>$zipcode, 'country'=>$country, 'id'=>$id]);
			return true;
		}

		//Change password of an user
		public function change_password($pass, $id){
			$sql = "UPDATE users SET password = :pass WHERE id = :id AND deleted != 1";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['pass'=>$pass, 'id'=>$id]);
			return true;
		}

        //Verify email of an user
        public function verify_email($email){
        	$sql = "UPDATE users SET token = '', verified = 1 WHERE email = :email AND deleted != 1";
        	$stmt = $this->conn->prepare($sql);
			$stmt->execute(['email'=>$email]);
			return true;
        }

        //Send feedback of user to admin	
        public function send_feedback($sub, $feed, $uid){
        	$sql = "INSERT INTO feedback (uid, subject, feedback) VALUES (:uid, :sub, :feed)";
        	$stmt = $this->conn->prepare($sql);
			$stmt->execute(['uid'=>$uid, 'sub'=>$sub, 'feed'=>$feed]);
			return true;
        }

        //Notification Insert
        public function notification($uid, $type, $message){
        	$sql = "INSERT INTO notification (uid, type, message) VALUES (:uid, :type, :message)";
        	$stmt = $this->conn->prepare($sql);
			$stmt->execute(['uid'=>$uid, 'type'=>$type, 'message'=>$message]);
			return true;
        }

        //Fetch Notification
        public function fetchNotification($uid){
        	$sql = "SELECT * FROM notification WHERE uid = :uid AND type = 'user'";
        	$stmt = $this->conn->prepare($sql);
            $stmt->execute(['uid'=>$uid]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        //count notification
        public function countNotification($uid){
        	$sql = "SELECT count(*) FROM notification WHERE uid = :uid AND type = 'user'";
        	$stmt = $this->conn->prepare($sql);
            $stmt->execute(['uid'=>$uid]);
            $result = $stmt->fetchColumn();
            return $result;
        }

        //Remove Notification
        public function removeNotification($id){
        	$sql = "DELETE FROM notification WHERE id = :id AND type = 'user'";
        	$stmt = $this->conn->prepare($sql);
			$stmt->execute(['id'=>$id]);
			return true;
        }
	}

 ?>