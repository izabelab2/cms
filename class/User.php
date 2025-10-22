<?php
    require_once 'Database.php';
    require_once 'Input.php';
    class User extends Database 
    {
        public function userGetLogIn() 
        {
            $input = new Input();

            $userLogin = $this->db->real_escape_string(htmlspecialchars(trim($input->post('login'))));
            $userPass = Hash('sha256', htmlspecialchars(trim($input->post('pass'))));
            
            $query = "SELECT id FROM user WHERE name='$userLogin' AND password='$userPass'";

            $result = $this->db->query($query);

            if ($result->num_rows > 0) {
                $_SESSION['logged'] = $userLogin;

            } else {
                return 'Nieprawidłowe dane';
            }
	}
	/*
	function forgotPassword() {
            $userEmail = htmlspecialchars(trim($_POST['email']));

            $query = "SELECT id FROM user WHERE email='$userEmail'";

            $result = $this->db->query($query);
            $userId = $result->fetch_assoc();
            $userId = $userId['id'];

            if ($result->num_rows > 0){
                $this->sendEmailWithNewPassword($userId);
                //return jeśli komunikat
            } else {
                return false;
            }
	}
	
	function sendEmailWithNewPassword($userId) {
            $userEmail = htmlspecialchars(trim($_POST['email']));
            $passwordHash = Hash('sha256', rand(10, 20));
            $userIdHash = Hash('sha256', $userId);
            $changePasswordAdress = 'http://iza.mtm-budowa.pl/?page=change_password&newpass='.$passwordHash.'&user='.$userIdHash;

            $edit = "UPDATE user SET password_hash='".$passwordHash."' WHERE id = ".$userId."";
            $this->db->query($edit);

            $tresc  = 'Link do zmiany hasła: <a href="' . $changePasswordAdress.'">Zmiana hasła</a>';

            $subject  = "Zmiana hasła";
            $charset  = "utf-8";

            $head =
                            "MIME-Version: 1.0\r\n" .
                            "Content-Type: text/plain; charset=$charset\r\n" .
                            "Content-Transfer-Encoding: 8bit";
            $body = "Treść wiadomości: $tresc";

            return mail($userEmail, "=?$charset?B?" . base64_encode($subject) . "?=", $body, $head) ? $message : $error;
	}
	
	function changePassword(){
            $actuallyPasswordHash = $_GET['newpass'];
            $newPassword = $_POST['new_pass'];
            $repeatNewPassword = $_POST['repeat_new_pass'];

            if ($newPassword != $repeatNewPassword) {
                return false;
            }

            $query = "SELECT id FROM user WHERE password_hash='$actuallyPasswordHash'";
            $result = $this->db->query($query);
            $userId = $result->fetch_assoc();
            $userId = $userId['id'];


            if ($result->num_rows != 1) {
                return false;
            }

            $hashedPassword = Hash('sha256', $newPassword);
            $edit = "UPDATE user SET password='".$newPassword."', password_hash=NULL WHERE id = ".$userId."";
            $this->db->query($edit);
	}
	
	function blockIp() {
            $ip = $_SERVER['REMOTE_ADDR'];
            $save = "INSERT INTO iza_blocked_ip (blocked_ip) VALUES ('$ip')";
	}
	*/
        public function userGetLogOut() 
        {
            session_destroy();
        }

}

?>