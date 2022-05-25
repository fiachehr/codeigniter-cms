<?php

/*
  |--------------------------------------------------------------------------
  | Random String
  |--------------------------------------------------------------------------
 */

function randomStr($length = 10) {
	
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
    
}

/*
  |--------------------------------------------------------------------------
  | File Upload
  |--------------------------------------------------------------------------
 */

function fileUpload($userConfig) {

    $config['upload_path'] = $userConfig['path'];
    $config['allowed_types'] = $userConfig['type'];
    $config['max_size'] = $userConfig['maxSize'];
    
    $file =& get_instance();
    $file->load->library('upload', $config);   
    $file->upload->initialize($config);

    if (!$file->upload->do_upload($userConfig['file'])) {
        $error = array('error' => $file->upload->display_errors());
        $result = array('filename' => NULL, 'error' => $error['error']);
        return $result;
    } else {
        $data = array('upload_data' => $file->upload->data());
        $newFileName = date("YmdHis") . randomStr(10) . $data['upload_data']['file_ext'];
        rename($data['upload_data']['full_path'], $data['upload_data']['file_path'] . trim($newFileName));
        $result = array('filename' => $newFileName, 'error' => NULL);
        return $result;
    }
}

/*
  |--------------------------------------------------------------------------
  | Thumbnile File Name
  |--------------------------------------------------------------------------
 */

    function imageThumbName($file){
                            
        $extention = substr($file,-3);
        $filename = substr($file,0,-4);
        return $filename."_thumb.".$extention;
        
    }

/*
  |--------------------------------------------------------------------------
  | Image Proccess
  | Sample : $resize = $this->base->imageProccess($upload['filename'],"resize",FILE_TEMP_FOLDER,GALLERY,array(FALSE,GALLERY_THUMB),array(TRUE,"Sample Text","overlay"),500,500);
  |--------------------------------------------------------------------------
 */


function multiFileUpload($userConfig) {

    $finalResult = true;
    $message = '';
    $imageFileType = strtolower(pathinfo($userConfig['name'],PATHINFO_EXTENSION));
    $allowType = array_values(array_unique(array_filter(explode("|",$userConfig['type']))));

    if(!in_array($imageFileType,$allowType)){
        $message = 'فرمت انتخابی اشتباه است';
        $finalResult = false;
    }

    if($userConfig['size'] > ($userConfig['maxSize']*1000)){
        $message = 'ُسایز فایل بزرگتر از استاندارد است';
        $finalResult = false;
    }

    if($imageFileType == "jpg" || $imageFileType == "gif" || $imageFileType == "png"){
        $imageFileType = "jpg";
    }

    if($finalResult == true){
        $newFileName = $userConfig['newName'].".".$imageFileType;
        move_uploaded_file($userConfig['tmp'], $userConfig['path'].$newFileName);
    }

    if($userConfig['resize'] != false){

        $config['image_library'] = 'gd2';
        $config['source_image'] = $userConfig['path'].$newFileName;
        $config['width'] = $userConfig['resize']['width'];
        $config['height'] = $userConfig['resize']['height'];
        $config['create_thumb'] = $userConfig['resize']['thumb'];
        $config['maintain_ratio'] = TRUE;
        $img =& get_instance();
        $img->load->library('image_lib', $config);   
        $img->image_lib->initialize($config);
        
        if ($userConfig['resize']['type'] == "crop") {
            list($imgWidth, $imgHeight) = getimagesize($userConfig['path'].$newFileName);
            $config['x_axis'] = ($imgWidth / 2) - ($userConfig['resize']['width'] / 2);
            $config['y_axis'] = ($imgHeight / 2) - ($userConfig['resize']['height'] / 2);
            $img->image_lib->initialize($config);
            $img->image_lib->crop();
            $img->image_lib->clear();
        }elseif ($userConfig['resize']['type'] == "resize") {
                $img->image_lib->initialize($config);
                $img->image_lib->resize();
                $img->image_lib->clear();  
        }

        if ($userConfig['resize']['thumb'] != false) {
            $thumbFileName = imageThumbName($newFileName);
            rename($userConfig['path'].$thumbFileName,$userConfig['path']."thumb/".$thumbFileName);
        }

        if ($userConfig['resize']['watermark'] != false) {

            $config['source_image'] = $userConfig['path'].$newFileName;
            $config['wm_text'] = $userConfig['resize']['watermark']['text'];
            $config['wm_type'] = $userConfig['resize']['watermark']['type'];
            $config['wm_font_path'] = './assets/panel/fonts/tahoma.ttf';
            $config['wm_overlay_path'] = './assets/images/watermark/' . $userConfig['resize']['watermark']['text'] . '';
            $config['wm_font_size'] = '16';
            $config['wm_font_color'] = 'ffffff';
            $config['wm_vrt_alignment'] = 'middle';
            $config['wm_hor_alignment'] = 'center';
            $config['wm_padding'] = '-5';
            $img->image_lib->initialize($config);
            $img->image_lib->watermark();
            $img->image_lib->display_errors();
            $img->image_lib->clear();

        }

    }

}
