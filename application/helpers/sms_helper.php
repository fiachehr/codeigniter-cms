<?php
include_once("./lib/sms.php");
                                                 
function sendSMS($phoneNo,$code)
{
	try {
		
		date_default_timezone_set("Asia/Tehran");

		
		// your sms.ir panel configuration
		$APIKey = "b04c845f64f5a3ca9f589168";
		$SecretKey = "SUvms7=+qKb?";

		
		// message data

		$data = array(
			"ParameterArray" => array(
				array(

					"Parameter" => "VerificationCode",
					"ParameterValue" => $code
				),			
			),
			"Mobile" => $phoneNo,
			"TemplateId" => "4588"
		);

		$SmsIR_UltraFastSend = new SmsIR_UltraFastSend($APIKey,$SecretKey);
		$UltraFastSend = $SmsIR_UltraFastSend->UltraFastSend($data);
		
	} catch (Exeption $e) {
		echo 'Error UltraFastSend : '.$e->getMessage();
	}
}

function sendSMSPassword($phoneNo,$code)
{
	try {
		
		date_default_timezone_set("Asia/Tehran");

		
		// your sms.ir panel configuration
		$APIKey = "b04c845f64f5a3ca9f589168";
		$SecretKey = "SUvms7=+qKb?";

		
		// message data

		$data = array(
			"ParameterArray" => array(
				array(

					"Parameter" => "VerificationCode",
					"ParameterValue" => $code
				),			
			),
			"Mobile" => $phoneNo,
			"TemplateId" => "4588"
		);

		$SmsIR_UltraFastSend = new SmsIR_UltraFastSend($APIKey,$SecretKey);
		$UltraFastSend = $SmsIR_UltraFastSend->UltraFastSend($data);
		
	} catch (Exeption $e) {
		echo 'Error UltraFastSend : '.$e->getMessage();
	}
}

?> 
                                        
                                    

