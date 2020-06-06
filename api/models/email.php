<?php
    class Email{

        public $email;
        public $name;
        public $phone;
        public $org;
        public $sub;
        public $msg;
        public $mailErr;
        public $errStr;
        public $pol;
        public $pod;
        public $eqp;
        public $cmdty;
        public $debug;

        // feedback variables
        public $feedback;
        public $feedbackRating;

        // booking variables
        public $vol;
        public $terms;
        public $BLmentioned;
        public $tradeLane;
        public $supplierDetails;
        public $CNEEdetails;
        public $notifyCNEE;
        public $grossWeight;
        public $encashmentCert;
        public $ftaCert;
        public $certOfOrigin;
        public $exportLiscense;
        public $comments;

        public function __construct()
        {
            set_error_handler(function($errno, $errstr) { 
                $this->mailErr = true;
                $this->errStr = $errstr;
            }, E_WARNING); 

            $this->debug = false;

        }
 
        // send is used for query
        public function send()
        {
            try{
                if($this->debug){
                    $to_email = 'dev@express-shipping.com';
                }
                else{
                    $to_email = 'nisar@express-shipping.com';
                }
                $subject = 'New Query - ' . $this->sub;
                $message = 'You have one new query: <br><hr>Name: ' . $this->name . '<br>Email: ' . $this->email;
                $message .= '<br>Phone: ' . $this->phone;
                $message .= '<br>Organization: ' . $this->org;
                $message .= '<br>Subject: ' . $this->sub;
                $message .= '<br>Message: ' . $this->msg;
                $headers = "From: noreply@express-shipping.com\r\n";
                if($this->debug){
                    // $headers .= "CC: amman@urwasoft.com\r\n";
                }
                else{
                    $headers .= "CC: tahir@express-shipping.com\r\n";
                }
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                mail($to_email,$subject,$message,$headers);

                $resp = array(
                    'iserror' => false,
                    'error' => "",
                    'mailErr' => $this->mailErr,
                    'mailErrStr' => $this->errStr
                );
                restore_error_handler();
                return $resp;
            }
            catch(Exception $e)
            {
                $resp = array(
                    'iserror' => true,
                    'error' => $e->getMessage(),
                    'mailErr' => $this->mailErr,
                    'mailErrStr' => $this->errStr
                );
                restore_error_handler();
                return $resp;
            }
        }

        public function booking()
        {
            try{
                if($this->debug){
                    $to_email = 'dev@express-shipping.com';
                }
                else{
                    $to_email = 'nisar@express-shipping.com';
                }
                $subject = 'New Booking Alert';
                $message = 'You have one new booking: <br><hr>';
                $message .= '<br>Customer Name: ' . $this->name;
                $message .= '<br>:Phone ' . $this->phone;
                $message .= '<br>Equipment: ' . $this->eqp;
                $message .= '<br>Volume: ' . $this->vol;
                $message .= '<br>Terms: ' . $this->terms;
                $message .= '<br>BL Mentioned: ' . $this->BLmentioned;
                $message .= '<br>Tradelane: ' . $this->tradeLane;
                $message .= '<br>POL: ' . $this->pol;
                $message .= '<br>POD: ' . $this->pod;
                $message .= '<br>Supplier Details: ' . $this->supplierDetails;
                $message .= '<br>CNEE Details: ' . $this->CNEEdetails;
                $message .= '<br>Noftify / CNEE: ' . $this->notifyCNEE;
                $message .= '<br>Commodity: ' . $this->cmdty;
                $message .= '<br>Gross Weight (Kgs): ' . $this->grossWeight;
                $message .= '<br>Encashment Certificate: ' . $this->encashmentCert;
                $message .= '<br>FTA Certificate: ' . $this->ftaCert;
                $message .= '<br>Certificate of Origin (COO): ' . $this->certOfOrigin;
                $message .= '<br>Export License: ' . $this->exportLiscense;
                $message .= '<br>Other Requirments/Comments: ' . $this->comments;
                // $message .= '<br>Equipment: ' . $this->eqp;
                $headers = "From: noreply@express-shipping.com\r\n";
                if($this->debug){
                    // $headers .= "CC: amman@urwasoft.com\r\n";
                }
                else{
                    $headers .= "CC: tahir@express-shipping.com\r\n";
                }
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                mail($to_email,$subject,$message,$headers);

                $resp = array(
                    'iserror' => false,
                    'error' => "",
                    'mailErr' => $this->mailErr,
                    'mailErrStr' => $this->errStr
                );
                restore_error_handler();
                return $resp;
            }
            catch(Exception $e)
            {
                $resp = array(
                    'iserror' => true,
                    'error' => $e->getMessage(),
                    'mailErr' => $this->mailErr,
                    'mailErrStr' => $this->errStr
                );
                restore_error_handler();
                return $resp;
            }
        }

        public function feedback()
        {
            try{
                if($this->debug){
                    $to_email = 'dev@express-shipping.com';
                }
                else{
                    $to_email = 'nisar@express-shipping.com';
                }
                $subject = 'New Feedback - ' . $this->sub;
                $message = 'You have one new feedback: <br><br><hr>Feedback: ' . $this->feedback . '<br>Email: ' . $this->email;
                $message .= '<br>Rating: ' . $this->feedbackRating . '/5';
                $headers = "From: noreply@express-shipping.com\r\n";
                // $headers .= "CC: amman.pasha@yahoo.com\r\n";
                if($this->debug){
                    // $headers .= "CC: amman@urwasoft.com\r\n";
                }
                else{
                    $headers .= "CC: tahir@express-shipping.com\r\n";
                }
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                mail($to_email,$subject,$message,$headers);

                $resp = array(
                    'iserror' => false,
                    'error' => "",
                    'mailErr' => $this->mailErr,
                    'mailErrStr' => $this->errStr
                );
                restore_error_handler();
                return $resp;
            }
            catch(Exception $e)
            {
                $resp = array(
                    'iserror' => true,
                    'error' => $e->getMessage(),
                    'mailErr' => $this->mailErr,
                    'mailErrStr' => $this->errStr
                );
                restore_error_handler();
                return $resp;
            }
        }

    }