<?php

namespace App\Modules\File\Contracts;
use App\Contracts\MainRepositoryInterface;

/**
 * Interface ImageRepositoryInterface
 * @package App\Modules\Category\Contracts
 */
interface ImageRepositoryInterface extends MainRepositoryInterface{
    public function getImages($selectArray = [], $whereArray = [], $options = [], $pluck = '', $toArray = NULL);

    public function saveImage($resourceType, $resourceId, $images);
}
