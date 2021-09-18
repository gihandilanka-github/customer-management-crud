<?php

namespace App\Modules\Customer\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Customer\Contracts\CustomerRepositoryInterface;
use App\Modules\Customer\Http\Requests\CsvRequest;
use App\Modules\Customer\Http\Requests\CustomerRequest;
use App\Modules\Customer\Http\Resources\CustomerEditResource;
use App\Modules\Customer\Http\Resources\CustomerListResourceCollection;
use Illuminate\Http\Request;

/**
 * Class CustomerController
 * @package App\Modules\Customer\Http\Controllers
 */
class CustomerController extends Controller
{

    private $customerRepo;

    public function __construct(CustomerRepositoryInterface $customerRepo)
    {
        $this->customerRepo = $customerRepo;
    }

    public function index(Request  $request)
    {
        $postParams = removeTokenFromRequestData($request->all());
        $options = $this->customerRepo->optionsForGetCustomers($postParams);
        $customers = $this->customerRepo->getCustomers([], [], $options, '');
        $this->data = new CustomerListResourceCollection($customers);
        return $this->apiResponse($this->data, $this->response_status_code, $this->status, $this->msg);
    }
    public function store(CustomerRequest $request)
    {
        $status = false;
        $msg = '';
        $postParams = removeTokenFromRequestData($request->all());
        $created = $this->customerRepo->createCustomer($postParams);
        if($created) {
            $status = true;
            $msg = trans('Customer Created Successfully!');
        }
        return response()->json([
            'data' => $created,
            'status' => $status,
            'msg' => $msg,
        ]);
    }

    public function edit($customer)
    {
        $customer = $this->customerRepo->getCustomers([], ['id' => $customer, 'created_by' =>  getLoggedInUser()->id]);
        $this->data = new CustomerEditResource($customer);
        if($this->data) {
            $this->status = true;
        }

        return $this->apiResponse($this->data, $this->response_status_code, $this->status, $this->msg);
    }

    public function update(CustomerRequest $request, $customerId)
    {
        $postParams = removeTokenFromRequestData($request->all());
        $updated = $this->customerRepo->updateCustomer($customerId, $postParams);
        return $this->apiResponse($updated['data'], $this->response_status_code, $updated['status'], $updated['msg']);
    }

    public function destroy($customerId)
    {
        $deleted = $this->customerRepo->deleteCustomer($customerId);
        if($deleted) {
            $this->status = true;
            $this->msg = trans('Customer was Deleted Successfully!');
        }else {
            $this->msg = trans("Customer Deleting Failed!");
        }
        return $this->apiResponse($this->data, $this->response_status_code, $this->status, $this->msg);
    }

    public function importCustomersUsingCsv(CsvRequest $request)
    {
        $postParams = removeTokenFromRequestData($request->all());
        $imported = $this->customerRepo->importCsv($postParams['csvFile']);
        if($imported) {
            $this->msg = trans('Customers Imported Successfully!');
            $this->status = true;
        }

        return $this->apiResponse($this->data, $this->response_status_code, $this->status, $this->msg);
    }





}
