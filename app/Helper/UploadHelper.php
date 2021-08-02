<?php

use Illuminate\Support\Str;
use App\Enums\UploadFileType;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Exists;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;

/**
 * @param $image
 * @param bool $is_base_64
 * @return string
 */
function uploadAvatar($image,$is_base_64 = false)
{
    return uploadFile($image,UploadFileType::Image,null,true,$is_base_64);
}


/**
 * @param $image
 * @param int $width
 * @param int $height
 * @return \Intervention\Image\Image
 */
function resizeImage($image,$width = 500,$height = 500){
    return Image::make($image)->resize($width,$height,function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
    });
}
/**
 * @param $file
 * @param int $type
 * @param null $name
 * @param bool $resize
 * @param bool $is_base_64
 * @param null $destination
 * @param int $width
 * @param int $height
 * @return string
 */
function uploadFile($file,$type = UploadFileType::Image, $name = null,$resize = true,$is_base_64 = false,$destination = null,$width = 500,$height = 500){
    if(empty($destination)){
        $destination =  config('app.upload_directory');

    }

    if($type === UploadFileType::Image){

        if(empty($name)){
            $name =  date("Y-m-d-His-").Str::random(10).'.png';
        }
        if(!$is_base_64){
            $file = $file->getRealPath();
        }
        if($resize){
            $file = resizeImage($file,$width,$height);
        }
        else{
            $file = Image::make($file);
        }
      $file->save(storage_path('app/public/'.$destination) . $name);
    //   unlink('storage/'.$destination . $name);
    }
    $file->save(storage_path('app/public/'.$destination) . $name);
    return 'storage/'.$destination . $name;
    
    return Storage::url($name);
}



/**
 * @param $path
 * @param string $default
 * @return string
 */
function getImage($path,$default = ''){
    return !empty($path) ? asset('images/'.$path) : asset($default);
}

/**
 * @param $pic
 * @param string $default
 * @return string
 */
function getPhoto($pic,$default = ''){
    $path = asset($pic);
    return !empty($pic) ? $path : asset($default);
}

