<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Patch extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function version(){
        return $this->belongsTo('App\Version');
    }

    public function setPatchFile(UploadedFile $file){

        $extension = $file->getClientOriginalExtension();

        $upload_path = './uploads/patch/';
        $file = $file->move($upload_path,uniqid().'.'.$extension);

        $file_url = $file->getPathname();

        $zip_url = $upload_path.uniqid().'.zip';

        //压缩js文件为.zip包
        $pcl_zip = new \App\Library\PclZip($zip_url);
        $result = $pcl_zip->create($file_url,PCLZIP_OPT_REMOVE_ALL_PATH);
        if ($result == 0) {
            //$this->error("文件压缩失败 : ".$pcl_zip->errorInfo(true));
            return false;
        }

        //删除原来的js文件
        unlink($file_url);

        $this->url = substr($zip_url,1);
        $this->url = url($this->url);
        $this->md5 = md5_file($zip_url);

        /* rsa 加密 md5 值*/
        $private_key = file_get_contents('../app/Library/rsa_key/rsa_private_key.pem');

        $pi_key =  openssl_pkey_get_private($private_key);//这个函数可用来判断私钥是否是可用的，可用返回资源id Resource id

        $encrypted = "";

        openssl_private_encrypt($this->md5,$encrypted,$pi_key);//私钥加密

        $this->md5_rsa = base64_encode($encrypted);//加密后的内容通常含有特殊字符，需要编码转换下，在网络间通过url传输时要注意base64编码是否是url安全的

        return true;
    }
}
