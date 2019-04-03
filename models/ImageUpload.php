<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ImageUpload extends Model
{
    public $image;

    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'jpg,png']
        ];
    }

    public function uploadFile($file, $nameImage)
    {
        $this->image = $file;

       if ($this->validate())
       {
           $this->deleteCurrentImage($nameImage);

           return $this->saveImage();
       }
    }

    private function getFolder()
    {
        return Yii::getAlias('@web') . 'uploads/';
    }

    private function genFilename()
    {
        return strtolower(md5(uniqid($this->image->baseName)) . '.' . $this->image->extension);
    }

    public function deleteCurrentImage($nameImage)
    {
        if ($this->fileExist($nameImage))
        {
            unlink($this->getFolder() . $nameImage);
        }
    }

    public function fileExist($nameImage)
    {
        if (!empty($nameImage) && $nameImage != NULL)
        {
            return file_exists($this->getFolder() . $nameImage);
        }
    }

    public function saveImage()
    {
        $filename = $this->genFilename();

        $this->image->saveAs($this->getFolder() . $filename);

        return $filename;
    }
}