<?php
namespace App\Modules\File\Repositories;

use App\Modules\Category\Category;
use App\Image;
use App\Modules\Category\Contracts\CategoryRepositoryInterface;
use App\Modules\File\Contracts\ImageRepositoryInterface;
use App\Repositories\MainRepository;
use Illuminate\Contracts\Container\Container as App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

/**
 * Class ImageRepository
 * @package App\Modules\File\Repositories
 */
class ImageRepository extends MainRepository implements ImageRepositoryInterface
{

    /**
     * @var $imageModel
     */
    private $imageModel;


    /**
     * Image repository constructor.
     * @param App $app
     * @param $imageModel
     */
    public function __construct(App $app, Image $imageModel
    )
    {
        parent::__construct($app);
        $this->imageModel = $imageModel;
    }

    /**
     * @return mixed|string
     */
    function model()
    {
        return 'App\Image';
    }

    public function getImages($selectArray = [], $whereArray = [], $options = [], $pluck = '', $toArray = NULL) {

        $selectArray =  empty($selectArray) ? '*' : $selectArray;
        $invoices = $this->categoryModel->select($selectArray)->where($whereArray);

        if(!empty($options['orderBy'])) {
            $invoices = $invoices->orderBy($options['orderBy']['orderColumn'], $options['orderBy']['orderType']);
        }

        if($pluck != '') {
            $invoices = $invoices->pluck($pluck);
        }elseif(array_key_exists('site_id', $whereArray)) {
            $invoices = $invoices->first();
        }elseif(!empty($options['paginate'])) {
            $invoices = $invoices->paginate(10);
        }else {
            $invoices = $invoices->get();
        }

        if($toArray) {
            $invoices = $invoices->toArray();
        }
        return $invoices;
    }

    public function saveImage($resourceType, $resourceId, $images, $createdBy = null, $updatedBy = null)
    {
        if(count($images) > 0):
            foreach($images as $image):
                if(strlen($image['path']) > 128) {
                    list($mime, $data)   = explode(';', $image['path']);
                    list(, $data)       = explode(',', $data);

                    $data = base64_decode($data);
                    $mime = explode(':',$mime)[1];
                    $ext = explode('/',$mime)[1];
                    $name = mt_rand().time();
                    $fileName = $name.'.'.$ext;
                    $savePath = '/'.$resourceId.'/original/'.$fileName;

                    $imageDataInserted = $this->model->create([
                        'name' => $name,
                        'path' => $fileName,
                        'resource_type' => $resourceType,
                        'resource_id' => $resourceId,
                        'mime_type' => $mime,
                        'extension' => $ext,
                        'created_by' => $createdBy ? $createdBy : Auth::user()->id,
                        'updated_by' => $updatedBy ? $updatedBy : Auth::user()->id
                    ]);

                    if($imageDataInserted) {
                        $stored = Storage::disk($resourceType)->put($savePath, $data);
                        if($stored) {
                            $imageInfo = getimagesize(Storage::disk($resourceType)->getDriver()->getAdapter()->getPathPrefix().$savePath);
                            $this->cropAndResizeImagesForSizes($resourceType, $resourceId, $imageInfo, $imageDataInserted);
                        }
                    }
                }

            endforeach;
        endif;
    }

    public function cropAndResizeImagesForSizes($resourceType, $resourceId, $imageInfo, $imageDataInserted) {
        $imageSizes = IMAGE_SIZES;
        foreach ($imageSizes as $sizeName => $size) {
            $this->resizeImagesAndSaveInResourceDirectory($resourceType, $resourceId, $imageInfo, $imageDataInserted, $sizeName , $size['w'], $size['h']);
        }
    }

    public function resizeImagesAndSaveInResourceDirectory($resourceType = null, $resourceId = null, $imageInfo = [], $uploadedImage = null, $imageSizeName = 'original', $desiredWith, $desiredHeight)
    {
        $save_path = storage_path('app/images/'.$resourceType.'/'.$resourceId);

        if(!file_exists($save_path)){
            mkdir ($save_path, 0777,true);
        }

        if(!file_exists($save_path.'/'.$imageSizeName)){
            mkdir ($save_path.'/'.$imageSizeName, 0777,true);
        }

        $this->_resizeToDirectory($imageInfo, $desiredWith, $desiredHeight, $resourceType,$resourceId,$uploadedImage,$imageSizeName);
    }

    private function _resizeToDirectory($imageInfo, $desired_width, $desired_height, $resourceType, $resourceId, $uploadedImage, $imageSizeName = 'original', $imageQuality = 90)
    {
        $original_w = $imageInfo[0];
        $original_h = $imageInfo[1];

        if(checkIsLinux()){
            $original_img_path = public_path("storage/images/".$resourceType."/".$resourceId."/original/".$uploadedImage->name.'.'.$uploadedImage->extension);
            $crop_img_path = public_path("storage/images/".$resourceType."/".$resourceId."/".$imageSizeName);
        }else{
            $original_img_path = public_path("storage\\images\\".$resourceType."\\".$resourceId."\\original\\".$uploadedImage->name.'.'.$uploadedImage->extension);
            $crop_img_path = public_path("storage\\images\\".$resourceType."\\".$resourceId."\\".$imageSizeName);
        }

        $fp = fopen($original_img_path, 'r');
        $imgContent = fread($fp, filesize($original_img_path));

        $sourceImage = imagecreatefromstring($imgContent);
        $newImage = imagecreatetruecolor($desired_width, $desired_height);
        $width_new = $original_h * $desired_width / $desired_height;
        $height_new =$original_w * $desired_height / $desired_width;
        //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
        if ($width_new > $original_w) {
            //cut point by height
            $h_point = (($original_h - $height_new) / 2);
            //copy image
            imagecopyresampled($newImage, $sourceImage, 0, 0, 0, $h_point, $desired_width, $desired_height, $original_w, $height_new);
        } else {
            //cut point by width
            $w_point = (($original_w - $width_new) / 2);
            imagecopyresampled($newImage, $sourceImage, 0, 0, $w_point, 0, $desired_width, $desired_height, $width_new,$original_h);
        }

        if ( !file_exists($crop_img_path)) {
            mkdir ($crop_img_path, 0777);
        }

        if(checkIsLinux()){
            $newFileName = $crop_img_path.'/'.$uploadedImage->name.'.'.$uploadedImage->extension;
        }else{
            $newFileName = $crop_img_path.'\\'.$uploadedImage->name.'.'.$uploadedImage->extension;
        }

        imagejpeg($newImage, $newFileName, $imageQuality);
        imagedestroy($newImage);
        imagedestroy($sourceImage);

        return $newFileName;
    }
}
