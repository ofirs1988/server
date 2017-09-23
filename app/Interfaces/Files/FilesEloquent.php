<?php

namespace App\Interfaces\Files;

use App\UsersCompany;
use App\Videos;


class FilesEloquent implements \App\Interfaces\Files\FilesInterface {

    public function UploadVideo($user,$request)
    {
        if($user->type = 2){
            $company_id = UsersCompany::select('company_id')
                ->where('user_id',$user->id)
                ->first();
            if(!$company_id)
                return response()->json(array('success' => false,
                    'massage' => 'not Company ID'), 500);
            // Settings Of Files
            $videoFile  = $request->file['video'];
            $videoIdentifier = $company_id->company_id."-".strtotime(date("Ymd"))."_".$user->id;

            $destinationVideoPath = base_path() . '/uploadsVideos/';
            $videoExtension       = $videoFile->getClientOriginalExtension();
            if(!$this->validatorsVideo($videoExtension))
                return 'format video not access';
            $videofilename        = $videoIdentifier . "-" . uniqid() . "." . $videoExtension;
            $urlSaveVideo = 'http://localhost:8080/site/uploadsVideos/' . $videofilename;
            $uploadVideo_success = $videoFile->move($destinationVideoPath, $videofilename);
            //Settings of Images

            if($request->file['poster']){
                $imageFile  = $request->file['poster'];
                $imageIdentifier = $company_id->company_id
                    ."- ".$timestamp = strtotime(date("Ymd"))."_".$user->id;
                $destinationImagePath = base_path() . '/uploadsPosters/';
                $imageExtension       = $imageFile->getClientOriginalExtension();
                if(!$this->validatorsImages($imageExtension))
                    return 'format image not access';
                $imagefilename        = $imageIdentifier .
                    "-" . uniqid() . "." . $imageExtension;
                $uploadImage_success = $imageFile->move($destinationImagePath, $imagefilename);
                $urlSaveImage = 'http://localhost:8080/site/uploadsPosters/' . $videofilename;
                if($uploadImage_success)
                    $massageImage = true;
                else
                    $massageImage = false;
            }
            if($uploadVideo_success) {
                $video = new Videos();
                $video->uid = $user->id;
                $video->company_id = $company_id->company_id;
                $video->src = $urlSaveVideo;
                $video->poster = $urlSaveImage;
                $video->name = $request->file['name'];
                $video->subtitle = $subtitle =
                    isset($request->subtitle) ? $request->subtitle : null;
                $video->type = 'video/'.$videoExtension;
                $video->theme = null;
                $video->totalTime = "00:10";
                $video->clicks = $request->file['clicks'];
                $video->sound = null;

                if($video->save())
                    return response()->json(array('success' => true,
                        'posterUpload' => $massageImage), 201);
                else
                    return response()->json(array('success' => false,
                        'massage' => 'not Insert video'), 500);
            } else {
                return response()->json(array('success' => false,
                    'massage' => 'not Upload video'), 500);
            }
        }
    }


    protected function validatorsVideo($format){
        $format = strtolower($format);
        $formats = ['mkv', 'mp4', 'm4v', 'avi', 'mov', '3gp', 'flv', 'wmv', 'emvb'];
        if(in_array($format,$formats))
            return true;
        else
            return false;
    }

    protected function validatorsImages($format){
        $format = strtolower($format);
        $formats = ['jpg','tif','png','gif'];
        if(in_array($format,$formats))
            return true;
        else
            return false;
    }
}