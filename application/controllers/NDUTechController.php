<?php
class NDUTechController extends CI_Controller {

	    public function __construct() {
	        parent::__construct();
	        $this->load->model('NDUTechModel');
	    }

	  	public function index() {
		    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
		        $captcha = substr(number_format(time() * rand(), 0, '', ''), 0, 8);

		        $vals = array(
		            'word' => $captcha,
		            'img_path' => './assets/captcha-images/',
		            'img_url' => base_url() . 'assets/captcha-images/',
		            'font_path' => base_url() . 'system/fonts/Poppins-Regular.ttf',
		            'font_size' => 12,
		            'img_width' => 200,
		            'img_height' => 50,
		            'expiration' => 7200,
		            'colors' => array(
		                'background' => array(173, 216, 230),
		                'border' => array(0, 0, 200),
		                'text' => array(0, 0, 255),
		                'grid' => array(135, 206, 250)
		            )
		        );

		        $cap = create_captcha($vals);
		        $this->session->unset_userdata('guessword');
		        $this->session->set_userdata('guessword', $captcha); 
		        $data['image'] = $cap['image']; 

		        $this->load->view('templates/loginheader');
		        $this->load->view('pages/login', $data); 
		        $this->load->view('templates/loginfooter');
		        return;
		    }

			    $captcha_response = trim($this->input->post('captcha_input'));
			    if (empty($captcha_response)) {
			        $this->session->set_flashdata('message', 'Please enter the CAPTCHA.');
			        redirect('login');
			    }

			    $stored_captcha = $this->session->userdata('guessword');
			    if ($captcha_response !== $stored_captcha) {
			        $this->session->set_flashdata('message', 'Invalid code. Please try again.');
			        redirect('login');
			    }

			    $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
			    $this->form_validation->set_rules('username', 'Username', 'required');
			    $this->form_validation->set_rules('password', 'Password', 'required');

			    if ($this->form_validation->run() == FALSE) {
			        $this->load->view('templates/loginheader');
			        $this->load->view('pages/login', $data); 
			        $this->load->view('templates/loginfooter');
			    } else {
			        $user = $this->NDUTechModel->login();
			        if ($user) {
	            if ($user['userstatus'] === 'Inactive') {
	                $this->session->set_flashdata('message', 'Your account is not verified. Please check your email.');
	                redirect('login');
	            }
	            $otp = $this->sendOTP($user['email'], $user['accountid']);
	            if ($otp) {
	                $this->session->set_userdata('otp_accountid', $user['accountid']);
	                redirect('verify_otp');
	            } else {
	                $this->session->set_flashdata('message', 'Failed to send OTP. Please try again.');
	                redirect('login');
	            }
		        } else {
		            $this->session->set_flashdata('message', 'Invalid username/password.');
		            redirect('login');
		        }
    		}
		}

		public function refreshCaptcha() {
		    if (!$this->input->is_ajax_request()) {
		        exit('No direct script access allowed');
		    }

		    $captcha = substr(number_format(time() * rand(), 0, '', ''), 0, 8);

		    $vals = array(
		        'word' => $captcha,
		        'img_path' => './assets/captcha-images/',
		        'img_url' => base_url() . 'assets/captcha-images/',
		        'font_path' => base_url() . 'system/fonts/Poppins-Regular.ttf', 
		        'font_size' => 12,
		        'img_width' => 200,
		        'img_height' => 50,
		        'expiration' => 7200,
		        'colors' => array(
		            'background' => array(173, 216, 230),
	                'border' => array(0, 0, 200),
	                'text' => array(0, 0, 255),
	                'grid' => array(135, 206, 250)
		        )
		    );

		    $cap = create_captcha($vals);

		    $this->session->unset_userdata('guessword');
		    $this->session->set_userdata('guessword', $captcha);

		    echo $cap['image'];
		}

	    public function logout() {
	        $this->session->unset_userdata('accountid');
	        $this->session->unset_userdata('accountname');
	        $this->session->unset_userdata('username');
	        $this->session->unset_userdata('usertype');
	        $this->session->unset_userdata('userstatus');
	        $this->session->unset_userdata('islogged_in');
	        $this->session->sess_destroy();
	        redirect(base_url());
	    }

	    /*public function sendOTP($email, $accountid) {
	    	$this->load->helper('string');
	    	$otp = random_string('alnum', 6);
	    	$otpexpiry = date("Y/m/d H:i:s", strtotime("+5 minutes"));

	    	$data = array(
	    		'otp' => $otp,
	    		'otpexpiry' => $otpexpiry
	    	);

	    	$this->db->where('accountid', $accountid);
	    	$result = $this->db->update('useraccount', $data);

	    	$emailaddressrecovery = $email."databasemanagementsystem";
	    	$from_email = 'noreply@ndutech.nduelect.com';
	    	$to_email = '$email';
	    	$message .= "\n\n";
	    	$message .= "OTP code is ".$otp.". This code is valid until ".$otpexpiry." only.\n\n";
			$this->email->from($from_email, "NDU Technology Portal");
	    	$this->email->to($to_email);
	    	$this->email->subject("OTP Code");
	    	$this->email->message($message);

	    	$result = false;

	    	return $this->email->send();
	    }*/

	    public function dashboard() {
	        if ($this->session->usertype == "System Administrator") {
	            $page = "dashboard";
	            $this->load->view('templates/header');
	            $this->load->view('templates/menus');
	            $this->load->view('pages/' . $page);
	            $this->load->view('templates/footer');
	        }else{
	            redirect(base_url());
	        }
	    }

	    public function register() {
		    $captcha = substr(number_format(time() * rand(), 0, '', ''), 0, 8);

		    $vals = array(
		        'word' => $captcha,
		        'img_path' => './assets/captcha-images/', 
		        'img_url' => base_url() . 'assets/captcha-images/',
		        'font_path' => base_url() . 'system/fonts/Poppins-Regular.ttf', 
		        'font_size' => 12,
		        'img_width' => 150,
		        'img_height' => 50,
		        'expiration' => 7200,
		        'colors' => array(
		            'background' => array(173, 216, 230), 
		            'border' => array(0, 0, 139),
		            'text' => array(0, 0, 255), 
		            'grid' => array(135, 206, 250) 
		        )
		    );

		    $cap = create_captcha($vals);
		    $this->session->unset_userdata('guessword');
		    $this->session->set_userdata('guessword', $captcha); 
		    $data['image'] = $cap['image']; 
		    
		    $this->load->view('pages/register', $data);
		}

		public function process_registration() {
		    $this->form_validation->set_rules('accountname', 'Name', 'required');
		    $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|is_unique[useraccount.username]');
		    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[useraccount.email]');
		    $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
		    $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
		    $this->form_validation->set_rules('captcha_input', 'CAPTCHA', 'required');

		    if ($this->form_validation->run() == FALSE) {
		        // If validation fails, set flash data for errors
		        $errors = validation_errors();
		        $this->session->set_flashdata('flashmessages', [
		            'message' => $errors,
		            'status' => 'negative'
		        ]);
		        redirect('register'); 
		    } else {
		        // Validate CAPTCHA
		        $captcha_response = trim($this->input->post('captcha_input'));
		        $stored_captcha = $this->session->userdata('guessword');

		        if ($captcha_response !== $stored_captcha) {
		            $this->session->set_flashdata('flashmessages', [
		                'message' => 'Invalid CAPTCHA. Please try again.',
		                'status' => 'negative'
		            ]);
		            redirect('register');
		        }

		        $verification_token = bin2hex(random_bytes(32)); // Generate a unique token
		        $verification_link = base_url('verify_email/' . $verification_token);

		        $data = [
		            'accountname' => $this->input->post('accountname'),
		            'username' => $this->input->post('username'),
		            'email' => $this->input->post('email'),
		            'password' => md5($this->input->post('password')),
		            'verification_token' => $verification_token,
		            'userstatus' => 'Inactive' // Set status to inactive until verified
		        ];

		        if ($this->NDUTechModel->register_user($data)) {
		            // Send verification email
		            $email = $this->input->post('email');
		            $subject = 'Verify Your Account';
		            $message = '
		                <h1>Welcome to Apps & Tech</h1>
		                <p>Please click the link below to verify your account:</p>
		                <a href="' . $verification_link . '">Verify Email</a>
		            ';

		            $result = $this->sendmail($email, $subject, $message);
		            if (strpos($result, 'Message has been sent') !== false) {
		                // Email sent successfully
		                $this->session->set_flashdata('flashmessages', [
		                    'message' => 'Registration successful! Please check your email to verify your account.',
		                    'status' => 'positive'
		                ]);
		                redirect('register'); 
		            } else {
		                // Email failed to send
		                $this->session->set_flashdata('flashmessages', [
		                    'message' => 'Registration successful, but failed to send verification email. Please contact support.',
		                    'status' => 'negative'
		                ]);
		                redirect('register'); 
		            }
		        } else {
		            // failed
		            $this->session->set_flashdata('flashmessages', [
		                'message' => 'Registration failed. Please try again.',
		                'status' => 'negative'
		            ]);
		            redirect('register');
		        }
		    }
		}

	    /*public function process_registration() {
		    $this->form_validation->set_rules('accountname', 'Name', 'required');
		    $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|is_unique[useraccount.username]');
		    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[useraccount.email]');
		    $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
		    $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
		    $this->form_validation->set_rules('captcha_input', 'CAPTCHA', 'required'); 

		    if ($this->form_validation->run() == FALSE) {
		        // If validation fails, set flash data for errors
		        $errors = validation_errors();
		        $this->session->set_flashdata('flashmessages', [
		            'message' => $errors,
		            'status' => 'negative'
		        ]);
		        redirect('register'); // Redirect back to the registration page
		    } else {
		        // Validate CAPTCHA
		        $captcha_response = trim($this->input->post('captcha_input'));
		        $stored_captcha = $this->session->userdata('guessword');

		        if ($captcha_response !== $stored_captcha) {
		            $this->session->set_flashdata('flashmessages', [
		                'message' => 'Invalid CAPTCHA. Please try again.',
		                'status' => 'negative'
		            ]);
		            redirect('register');
		        }

		        // If validation passes, prepare data for insertion
		        $verification_token = bin2hex(random_bytes(32)); // Generate a unique token
		        $verification_link = base_url('verify_email/' . $verification_token);

		        $data = [
		            'accountname' => $this->input->post('accountname'),
		            'username' => $this->input->post('username'),
		            'email' => $this->input->post('email'),
		            'password' => md5($this->input->post('password')), 
		            'verification_token' => $verification_token, 
		            'userstatus' => 'Inactive' // Set status to inactive until verified
		        ];

		        // Insert data into the database
		        if ($this->NDUTechModel->register_user($data)) {
		            // Send verification email
		            $email = $this->input->post('email');
		            $subject = 'Verify Your Account';
		            $message = '
		                <h1>Welcome to NDU Technology</h1>
		                <p>Please click the link below to verify your account:</p>
		                <a href="' . $verification_link . '">Verify Email</a>
		            ';

		            $result = $this->sendmail($email, $subject, $message);
		            if (strpos($result, 'Message has been sent') !== false) {
		                // Email sent successfully
		                $this->session->set_flashdata('flashmessages', [
		                    'message' => 'Registration successful! Please check your email to verify your account.',
		                    'status' => 'positive'
		                ]);
		                redirect('login');
		            } else {
		                // Email failed to send
		                $this->session->set_flashdata('flashmessages', [
		                    'message' => 'Registration successful, but failed to send verification email. Please contact support.',
		                    'status' => 'negative'
		                ]);
		                redirect('login');
		            }
		        } else {
		            // Registration failed
		            $this->session->set_flashdata('flashmessages', [
		                'message' => 'Registration failed. Please try again.',
		                'status' => 'negative'
		            ]);
		            redirect('register');
		        }
		    }
		}*/

		public function sendmail($email, $subject, $message) {
		    // Load PHPMailer library
		    $this->load->library('phpmailer_lib');

		    // Initialize PHPMailer
		    $mail = $this->phpmailer_lib->load();

		    // SMTP configuration
		    $mail->isSMTP();
		    $mail->Host = 'smtp.hostinger.com'; // SMTP server
		    $mail->SMTPAuth = true; // Enable SMTP authentication
		    $mail->Username = 'noreply@ndutech.nduelect.com'; // SMTP username
		    $mail->Password = '#NDUtechmail1'; // SMTP password
		    $mail->SMTPSecure = 'ssl'; // Enable TLS/SSL encryption
		    $mail->Port = 465; // TCP port to connect to

		    $mail->setFrom('noreply@ndutech.nduelect.com', 'Apps & Tech'); 
		    $mail->addReplyTo('noreply@ndutech.nduelect.com', 'Apps & Tech'); 
		    $mail->addAddress($email); // Recipient email

		    $mail->Subject = $subject; 
		    $mail->isHTML(true);
		    $mail->Body = $message; 

		    if (!$mail->send()) {
		        return 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
		    } else {
		        return 'Message has been sent';
		    }
		}

		public function verify_email($token) {
		    $user = $this->NDUTechModel->get_user_by_token($token);
		    if ($user) {
		        $this->NDUTechModel->update_user_status($user->accountid, 'Active');
		        $this->session->set_flashdata('flashmessages', [
		            'message' => 'Email verified successfully! You can now login.',
		            'status' => 'positive'
		        ]);
		    } else {
		        $this->session->set_flashdata('flashmessages', [
		            'message' => 'Invalid or expired verification link.',
		            'status' => 'negative'
		        ]);
		    }
		    redirect('login');
		}

		public function verify_otp() {
		    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
		        $this->load->view('pages/verify_otp');
		        return;
		    }

		    $otp = $this->input->post('otp');
		    $accountid = $this->session->userdata('otp_accountid');

		    if ($this->NDUTechModel->verify_otp($accountid, $otp)) {

		        $user = $this->NDUTechModel->get_user_by_id($accountid);
		        $user_data = [
		            'accountid' => $user->accountid,
		            'accountname' => $user->accountname,
		            'username' => $user->username,
		            'usertype' => $user->usertype,
		            'userstatus' => $user->userstatus,
		            'islogged_in' => true
		        ];
		        $this->session->set_userdata($user_data);
		        redirect('dashboard');
		    } else {
		        $this->session->set_flashdata('message', 'Invalid or expired OTP.');
		        redirect('verify_otp');
		    }
		}

		public function sendOTP($email, $accountid) {
		    $this->load->helper('string');
		    $otp = random_string('numeric', 6); 
		    $otpexpiry = date("Y-m-d H:i:s", strtotime("+5 minutes")); 

		    $this->NDUTechModel->save_otp($accountid, $otp, $otpexpiry);

		    $subject = 'OTP for Login';
		    $message = '
		        <h1>OTP</h1>
		        <p>OTP is: <strong>' . $otp . '</strong></p>
		        <p>This OTP will expire in 5 minutes.</p>
		    ';

		    $result = $this->sendmail($email, $subject, $message);
		    return (strpos($result, 'Message has been sent') !== false);
		}
	}
?>