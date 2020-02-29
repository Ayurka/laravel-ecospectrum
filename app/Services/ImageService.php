<?php

namespace App\Services;

use App\Models\Backend\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Request;
use Intervention\Image\Facades\Image as ImageInt;

class ImageService
{
    /**
     * Устанавливаем изображения
     *
     * @param $model object
     * @param \Illuminate\Http\Request
     * @return object
     */
    public function setImages($model, $request)
    {
        $modelName = class_basename($model);

        $cropImage = config('cropImage');

        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $key => $image) {

                $images = [];

                foreach ($cropImage as $key => $crop) {
                    $interventionImage = ImageInt::make($image);
                    $interventionImage->fit($crop['width'], $crop['height'], function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode('jpg');

                    $now = Carbon::now()->toDateTimeString();
                    $hash = md5($interventionImage->__toString().$now);

                    $imageHash = "{$hash}.jpg";

                    $path = $modelName . '/' . $model->id . '/' . $crop['width'] . 'x' . $crop['height'] . '/' . $imageHash;

                    Storage::disk('public')->put($path, $interventionImage->__toString());

                    $images[$key] = $path;
                }

                $model->image()->create([
                    'position' => $key,
                    'small' => url('') . Storage::url($images['small']),
                    'medium' => url('') . Storage::url($images['medium']),
                    'large' => url('') . Storage::url($images['large']),
                ]);
            }
        }

        return $model;
    }

    /**
     * @param $images array
     * @return string
     */
    public function getConfigImages($images)
    {
        $config = [];

        if ($images) {
            foreach ($images as $image) {
                $config['initialPreview'][] = $image->large;
                $config['initialPreviewConfig'][] = [
                    'caption' => $image->small,
                    'url' => route('admin.image_delete', $image->id),
                    'key' => $image->id
                ];
            }
        }

        return $this->conf($config);
    }

    /**
     * Удаляем изображение
     *
     * @param $id int
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function deleteImage($id)
    {
        $image = Image::find($id);
        $image->delete();

        Storage::disk('public')->delete($image->small);

        return response('200');
    }

    /**
     * Удаляем директорию изображений
     *
     * @param $model object
     * @param $id int
     * @return bool
     */
    public function deleteImageDirectory($model, $id)
    {
        $modelName = class_basename($model);

        if ($model->image) {
            $model->image()->delete();
        }

        if ($model->images) {
            $model->images()->delete();
        }

        return Storage::disk('public')->deleteDirectory($modelName . '/' . $id);
    }

    /**
     * Сортируем изображения
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function sortImage()
    {
        $images = Request::get('param');

        foreach ($images as $key => $image) {
            $model = Image::where('id', $image['key'])->first();
            $model->position = $key;
            $model->update();
        }

        return response('200');
    }

    /**
     * Получаем конфиг
     *
     * @param $initial array
     * @return string
     */
    protected function conf($initial)
    {
        if(!empty($initial)){
            $conf = "{
            theme: 'fas',
            language: 'ru',
            allowedFileExtensions: ['jpg', 'png', 'gif', 'jpeg'],
            overwriteInitial: false,
            initialPreviewAsData: true,
            uploadAsync: true,
            deleteExtraData: function() {
                        return {
                            _token: $(\"input[name='_token']\").val()
                        };
                    },
            initialPreview: " . response()->json($initial['initialPreview'])->content() . ",
            initialPreviewConfig: " .  response()->json($initial['initialPreviewConfig'])->content() . "}";
        } else {
            $conf = "{
            theme: 'fas',
            language: 'ru',
            allowedFileExtensions: ['jpg', 'png', 'gif', 'jpeg']}";
        }

        return $conf;
    }
}
