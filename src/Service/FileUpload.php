<?php

namespace App\Service;

class FileUpload
{
    // public $file;

    public function __construct() {}

    public function fileUpload($inputField, $doc_dir, $new_name = ''){

        if(isset($_FILES[$inputField]) && $_FILES[$inputField]['error'] === UPLOAD_ERR_OK) { // es gibt file-input 'dokument' in form &  // eine Datei gewählt zu upload
            
            $file = $new_name;
            if($new_name == ''){
                $file = basename($_FILES[$inputField]['name']);
            }

            $target_path = $doc_dir.'/'.$file;
            
            if(move_uploaded_file($_FILES[$inputField]['tmp_name'], $target_path)) {
                return $file;
            } 
        }
        // else {
        //     $error = "please select 1 file ---";
        // }
        return '';
    }

    public function myUpload($uploadConfig) {
        $inputField = $uploadConfig['inputField'];
        $doc_dir    = $uploadConfig['depoDir'];      // '/var/www/html/img/serminarkalender/referenten'

        $image = $this->fileUpload($inputField, $doc_dir);  // file-name

        if($image !== ''){
            $domain  = $uploadConfig['domain'];
            $depoUrl = $domain.str_replace('/var/www/html', '', $doc_dir);

            $fileUrl = $uploadConfig['fileUrl'];
            $file    = str_replace($depoUrl.'/', '', $fileUrl);
            if(strlen($file) > 0){ // delete current file
                unlink($doc_dir.'/'.$file);
            }

            $fileUrl = $depoUrl.'/'.$image;
            return $fileUrl;
        } 

        return '';
    }

}