<?php
namespace App\Modules\Customer\Repositories;

use App\Modules\Customer\Contracts\CustomerRepositoryInterface;
use App\Repositories\MainRepository;
use Illuminate\Contracts\Container\Container as App;

/**
 * Class CustomerRepository
 * @package App\Modules\Customer\Repositories
 */
class CustomerRepository extends MainRepository implements CustomerRepositoryInterface
{

    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    /**
     * @return mixed|string
     */
    function model()
    {
        return 'App\Modules\Customer\Models\Customer';
    }

    public function createCustomer($postParams)
    {
        return $this->model->create([
            'customer_firstname' => $postParams['customer_firstname'],
            'customer_lastname' => $postParams['customer_lastname'],
            'customer_email' => $postParams['customer_email'],
            'customer_phone' => $postParams['customer_phone'],
        ]);
    }

    public function getCustomers($selectArray = [], $whereArray = [], $options = [], $pluck = '', $toArray = NULL)
    {
        $selectArray =  empty($selectArray) ? '*' : $selectArray;
        $customers = $this->model->select($selectArray)->where($whereArray);

        if(!empty($options['orderBy'])) {
            $customers = $customers->orderBy($options['orderBy']['orderColumn'], $options['orderBy']['orderType']);
        }
        if(!empty($options['withArray'])) {
            $withArr = $this->withRelationshipQuery($options['withArray']);
            $customers = $customers->with($withArr);
        }
        if(!empty($options['first_name'])) {
            $customers = $customers->whereRaw('customer_firstname LIKE ?', ['%'.trim(strtolower($options['first_name'])).'%']);
        }
        if(!empty($options['last_name'])) {
            $customers = $customers->whereRaw('customer_lastname LIKE ?', ['%'.trim(strtolower($options['last_name'])).'%']);
        }
        if(!empty($options['email'])) {
            $customers = $customers->whereRaw('customer_email LIKE ?', ['%'.trim(strtolower($options['email'])).'%']);
        }
        if(!empty($options['phone'])) {
            $customers = $customers->whereRaw('customer_phone LIKE ?', ['%'.trim(strtolower($options['phone'])).'%']);
        }

        if($pluck != '') {
            $customers = $customers->pluck($pluck);
        }elseif(array_key_exists('id', $whereArray) || array_key_exists('slug', $whereArray)) {
            $customers = $customers->first();
        }elseif(!empty($options['paginate'])) {
            $customers = $customers->paginate($options['paginate']);
        }else {
            $customers = $customers->get();
        }

        if($toArray) {
            $customers = $customers->toArray();
        }
        return $customers;
    }
    public function updateCustomer($customerId, $postParams)
    {
        $status =  false;
        $msg =  '';
        $data = null;
        $customer = $this->getCustomers(['id'], ['id' => $customerId, 'created_by' =>  auth()->user()->id]);
        if($customer) {
            $updated = $customer->fill([
                'customer_firstname' => $postParams['customer_firstname'],
                'customer_lastname' => $postParams['customer_lastname'],
                'customer_email' => $postParams['customer_email'],
                'customer_phone' => $postParams['customer_phone'],
            ])->save();

            if ($updated) {
                $status = true;
                $msg = trans('Customer updated Successfully!');
                $data = $customer->id;
            }
        }else {
            $msg = trans('Customer is not found!');
        }
        return [
          'status' => $status,
          'msg' => $msg,
          'data' => $data,
        ];
    }

    public function optionsForGetCustomers($postParams)
    {
        return [
            'orderBy' => ['orderColumn' => 'created_at', 'orderType' => 'desc'],
            'paginate' => DEFAULT_PAGINATION,
            'first_name' => !empty($postParams['first_name']) ? $postParams['first_name'] : '',
            'last_name' => !empty($postParams['last_name']) ? $postParams['last_name'] : '',
            'email' => !empty($postParams['email']) ? $postParams['email'] : '',
            'phone' => !empty($postParams['phone']) ? $postParams['phone'] : '',
        ];
    }

    public function deleteCustomer($customerId)
    {
        return $this->model->where(['id' => $customerId, 'created_by' =>  auth()->user()->id])->delete();
    }

    public function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header){
                    $header = [
                        'customer_firstname',
                        'customer_lastname',
                        'customer_email',
                        'customer_phone'
                    ];
                } else{

                    $data[] = array_combine($header, $row);
                }

            }
            fclose($handle);
        }
        return $data;
    }

    public function importCsv($file)
    {
        $customerArr = $this->csvToArray($file);
        return $this->prepareAndImportData($customerArr);
    }
    public function prepareAndImportData($customersArray)
    {
        $constantDataArray = [
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),


        ];
        foreach ($customersArray as $customer){
            $preparedCustomers = array_merge($customer, $constantDataArray);
            $this->model->updateOrCreate(['customer_email' => $preparedCustomers['customer_email']], $preparedCustomers);

        }
        return true;
    }

}
