<?php

namespace App\Modules\Customer\Contracts;
use App\Contracts\MainRepositoryInterface;

/**
 * Interface CustomerRepositoryInterface
 * @package App\Modules\Customer\Contracts
 */
interface CustomerRepositoryInterface extends MainRepositoryInterface{
    public function createCustomer($postParams);
    public function getCustomers($selectArray = [], $whereArray = [], $options = [], $pluck = '', $toArray = NULL);
    public function updateCustomer($customerId, $postParams);
    public function deleteCustomer($customerId);
    public function optionsForGetCustomers($postParams);
    public function csvToArray($filename = '', $delimiter = ',');
    public function importCsv($file);
}
