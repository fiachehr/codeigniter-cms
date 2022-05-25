<?php

function createMessageToEmail($data, $type) {

    if ($type == "sendNewPassword") {

        $message = "کاربر گرامی ضمن عرض خیر مقدم خدمت شما لطفا برای ورود به سایت از کلمه عبور " . $data['password'] . "استفااده نمایید.";
        sendEmail("noreply@alloestekhdam.com", $data['userEmail'], NULL, "کلمه عبور ورود به سایت الو استخدام ", $message, NULL);
        
    }else if ($type == "forgetPassword") {
        
        $message = "کاربر گرامی کلمه عبور جدید شما ".$data['password']." می باشد";
       
        sendEmail("noreply@alloestekhdam.com", $data['userEmail'], NULL, "کلمه عبو رجدید ورود به سایت الو استخدام ", $message, NULL);
    }else if($type == "Payment"){
        
        sendEmail("noreply@alloestekhdam.com", $data['userEmail'], NULL, "تایید پرداخت ", $data['message'], NULL);
        
    }else if($type == "RegClassified"){
        
        sendEmail("noreply@alloestekhdam.com", $data['userEmail'], NULL, "ثبت آگهی", $data['message'], NULL);
        
    }else if($type == "classfiedActive"){
        
        sendEmail("noreply@alloestekhdam.com", $data['userEmail'], NULL, "تایید آگهی", $data['message'], NULL);
        
    }else if($type == "newMessage"){
        
        sendEmail("noreply@alloestekhdam.com", $data['userEmail'], NULL, "پیام جدید", $data['message'], NULL);
        
    }else if($type == "newChat"){
        
        sendEmail("noreply@alloestekhdam.com", $data['userEmail'], NULL, "درخواست چت جدید", $data['message'], NULL);
        
    }
   
}

function sendToFriend($job,$myEmail,$yourEmail){
    sendEmail($myEmail, $yourEmail, NULL, "معرفی شغل", $job, NULL);
}

function sendEmail($from, $to, $cc, $subject, $message, $attach) {

    $ci = get_instance();
    $ci->load->library('email');
    $config['protocol'] = "smtp";
    $config['smtp_host'] = SMTP_HOST;
    $config['smtp_port'] = SMTP_PORT;
    $config['smtp_user'] = SMTP_USERNAME;
    $config['smtp_pass'] = SMTP_PASSWORD;
    $config['charset'] = CHARSET;
    $config['mailtype'] = MAILTYPE;
    $config['newline'] = "\r\n";
    $ci->email->initialize($config);

    if ($attach == NULL) {

        $ci->email->set_mailtype("html");
        $ci->email->from($from);
        $ci->email->to($to);
        $ci->email->cc($cc);
        $ci->email->subject($subject);
        $ci->email->message($message);
        $ci->email->send();
        $ci->email->print_debugger();
    } else {

        $ci->email->set_mailtype("html");
        $ci->email->from($from);
        $ci->email->to($to);
        $ci->email->cc($cc);
        $ci->email->subject($subject);
        $ci->email->message($message);
        $ci->email->attach(ATTACHMENT . $attach);
        $ci->email->send();
        unlink(ATTACHMENT . $attach);
    }
}
