<?php
class NDUTechModel extends CI_Model{

		public function login()
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			$this->db->select('*');
			$this->db->from('useraccount');
			$this->db->where('username like binary', $username);
			$this->db->where('password like binary', md5($password));
			$result = $this->db->get();

			if($result->num_rows() > 0){
				return $result->row_array();
			}else{
				return false;
			}
		}

		public function register_user($data) {
		    return $this->db->insert('useraccount', $data);
		}

		public function get_user_by_id($accountid) {
		    $this->db->where('accountid', $accountid);
		    $query = $this->db->get('useraccount'); 
		    return $query->row(); 
		}

		public function check_existing_user($username, $email) {
		    $this->db->where('username', $username);
		    $this->db->or_where('email', $email);
		    return $this->db->get('useraccount')->row();
		}

		public function save_otp($accountid, $otp, $otpexpiry) {
		    $data = [
		        'otp' => $otp,
		        'otpexpiry' => $otpexpiry
		    ];
		    $this->db->where('accountid', $accountid);
		    return $this->db->update('useraccount', $data);
		}

		public function verify_otp($accountid, $otp) {
		    $this->db->where('accountid', $accountid);
		    $this->db->where('otp', $otp);
		    $this->db->where('otpexpiry >', date('Y-m-d H:i:s')); 
		    return $this->db->get('useraccount')->row();
		}

		public function get_user_by_token($token) {
		    $this->db->where('verification_token', $token);
		    return $this->db->get('useraccount')->row();
		}

		public function update_user_status($accountid, $status) {
		    $this->db->where('accountid', $accountid);
		    return $this->db->update('useraccount', ['userstatus' => $status]);
		}
	}
?>