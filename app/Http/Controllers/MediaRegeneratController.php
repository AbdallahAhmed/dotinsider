<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
//use Illuminate\Http\Request;
use Dot\Media\Models\Media;

class MediaRegeneratController extends Controller
{
    function regenerate_media($offset = 0)
    {

        $images = Media::where("type", "image")->offset($offset)->take(1)->orderBy('created_at','DESC')->get();

        if (count($images)) {
            foreach ($images as $image) {
                $this->regenerate($image->path);
            }

            if(\Request::filled('update-sizes')){

                return redirect()->route('media.cron', ['offset' => $offset + 1,'lang'=>app()->getLocale(),'update-sizes'=>true]);

            }

            return redirect()->route('media.cron', ['offset' => $offset + 1,'lang'=>app()->getLocale()]);
        } else {

            return response()->json([
                "regenerated" => 1
            ]);

        }

    }

    /**
     * create thumbnails
     * @param $filename
     * @param int $s3_save
     * @return bool
     */
    function regenerate($filename, $s3_save = 1)
    {


        if (!config("media.thumbnails")) {
            return false;
        }


        list($year, $month, $filename) = @explode("/", $filename);

        $file_directory = UPLOADS_PATH . "/" . $year . "/" . $month;

        if (file_exists($file_directory . "/" . $filename)) {

            $sizes = \Config::get("media.sizes");

            if(\Request::filled('update-sizes')){
                $sizes = \Config::get("media.sizes_updated");
            }

            $width = \Image::make($file_directory . "/" . $filename)->width();
            $height = \Image::make($file_directory . "/" . $filename)->height();

            $resize_mode = option('media_resize_mode','blur_background');

            foreach ($sizes as $size => $dimensions) {

                if ($width > $height) {
                    $new_width = $dimensions[0];
                    $new_height = null;
                } else {
                    $new_height = $dimensions[1];
                    $new_width = null;
                }

                if (isset($dimensions[2])) {
                    $resize_mode = $dimensions[2];
                }

                if ($resize_mode == "resize") {

                    \Image::make($file_directory . "/" . $filename)
                        ->resize($new_width, $new_height, function ($constraint) {
                            $constraint->aspectRatio();
                        })
                        ->save($file_directory . "/" . $size . "-" . $filename);

                }

                if ($resize_mode == "resize_crop") {

                    \Image::make($file_directory . "/" . $filename)
                        ->fit($dimensions[0], $dimensions[1])
                        ->save($file_directory . "/" . $size . "-" . $filename);

                }

                if ($resize_mode == "color_background") {

                    $background_color = \config("media.resize_background_color", "#000000");

                    $background = \Image::canvas($dimensions[0], $dimensions[1], $background_color);

                    $image = \Image::make($file_directory . "/" . $filename)
                        ->resize($new_width, $new_height, function ($constraint) {
                            $constraint->aspectRatio();
                            //$constraint->upsize();
                        });

                    $background->insert($image, 'center');
                    $background->save($file_directory . "/" . $size . "-" . $filename);
                }

                if ($resize_mode == "gradient_background") {

                    $first_color = \config("media.resize_gradient_first_color", "#000000");
                    $second_color = \config("media.resize_gradient_second_color", "#ffffff");

                    $background = \Image::make($this->gradient($dimensions[0], $dimensions[1], array($first_color, $first_color, $second_color, $second_color)));

                    $image = Image::make($file_directory . "/" . $filename)
                        ->resize($new_width, $new_height, function ($constraint) {
                            $constraint->aspectRatio();
                        });

                    $background->insert($image, 'center');
                    $background->save($file_directory . "/" . $size . "-" . $filename);

                }

                if ($resize_mode == "blur_background") {

                    $background = \Image::make($file_directory . "/" . $filename)
                        ->fit($dimensions[0], $dimensions[1])
                        ->blur(100);

                    $image = \Image::make($file_directory . "/" . $filename)
                        ->resize($new_width, $new_height, function ($constraint) {
                            $constraint->aspectRatio();
                        });

                    $background->insert($image, 'center');
                    $background->save($file_directory . "/" . $size . "-" . $filename);


                }


                if ($resize_mode == "resize_crop_top") {

                    \Image::make($file_directory . "/" . $filename)
                        ->fit($dimensions[0], $dimensions[1],null,"top")
                        ->save($file_directory . "/" . $size . "-" . $filename, 100);

                }

            }
        }


    }

}
