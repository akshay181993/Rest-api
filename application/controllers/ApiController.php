<?php
require APPPATH . '/libraries/CreateTokenJWT.php';

class ApiController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Database model where you find all db queries 
        $this->load->model('ApiModel');
        // json_output us the helper fun to creat and send json response 
        $this->load->helper('json_output');
        // create object of JWT Token.
        $this->objOfJwt = new CreateTokenJWT();
    }

    //To create new token

    public function CreateToken()
    {
        $tokenData['uniqueId'] = 'shyenatechyarns_12345';
        $tokenData['name'] = 'shyenatechyarns';
        $tokenData['timeStamp'] = Date('Y-m-d h:i:s');
        $jwtToken = $this->objOfJwt->GenerateToken($tokenData);// to generate new token using given payload.
        json_output(200,array('status' => 200,'message' => 'success','Token' => $jwtToken));
    }
    
    // To create new customer API 
    public function CreateCustomer()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
           json_output(400,array('status' => 400,'message' => 'Bad request.'));
        } else {
            $received_Token = $this->input->request_headers('Authorization');// get token
            if(!isset($received_Token['Token'])){
                json_output(400,array('status' => 401,'message' => 'Unauthorized'));
            }else
            {
                $this->GetTokenData(); // chk for valid token

                if ($this->form_validation->run('customer_rules') == TRUE)//you can find validation rules in config/form_validation.php
                {

                    $params = [
                        'name'      => $_REQUEST['name'],
                        'username'  => $_REQUEST['username'],
                        'email'     => $_REQUEST['email'],
                        'mobile_no' => $_REQUEST['mobile_no'],
                        'country_id' => $_REQUEST['country'],
                        'admin_id'   => $_REQUEST['admin'],
                    ];
                    
                    $response = $this->ApiModel->Save($params); //To insert record in db
                    echo json_output($response['status'],$response);

                }else{
                    $errors = [
                        'name'      => form_error('name'),
                        'username'  => form_error('username'),
                        'email'     => form_error('email'),
                        'mobile_no' => form_error('mobile_no'),
                        'admin'     => form_error('admin')

                    ];
                    echo json_output(201,array( "status" => 201, "messages" => $errors));
                }    
                
            }
            
        }
    }

    // Update existing customer API
    public function UpdateCustomer()
    {
        $id = "";
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
           json_output(400,array('status' => 400,'message' => 'Bad request.'));
        } else {
            $received_Token = $this->input->request_headers('Authorization');// get token
            if(!isset($received_Token['Token'])){
                json_output(400,array('status' => 401,'message' => 'Unauthorized'));
            }else{
                $this->GetTokenData(); //chk for valid token
                if ($this->form_validation->run('customer_rules') == TRUE) //you can find validation rules in config/form_validation.php              
                {
                    if(isset( $_REQUEST['id']) && !empty( $_REQUEST['id']))
                    {
                        $id =  $_REQUEST['id'];
                        $params = [
                            'name'      => $_REQUEST['name'],
                            'username'  => $_REQUEST['username'],
                            'email'     => $_REQUEST['email'],
                            'mobile_no' => $_REQUEST['mobile_no'],
                        ];
                        if(isset( $_REQUEST['country']) && !empty($_REQUEST['country'])){
                            $params['country_id'] = $_REQUEST['country'];
                        }
                        if(isset( $_REQUEST['admin']) && !empty($_REQUEST['admin'])){
                            $params['admin_id'] = $_REQUEST['admin'];
                        }
                        $response = $this->ApiModel->Update($params,$id); // to udate record in db.
                        echo json_output($response['status'],$response);
                    }else{
                        json_output(201,array('status' => 201,'message' => 'please provide record details !'));
                    }
                }else{
                    $errors = [
                        'name'      => form_error('name'),
                        'username'  => form_error('username'),
                        'email'     => form_error('email'),
                        'mobile_no' => form_error('mobile_no'),
                        'admin'     => form_error('admin')
                    ];
                    echo json_output(201,array( "status" => 201, "messages" => $errors));
                }
            }
        }
    }
    // To Show all Records of customers API
    public function AllCustomers()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'GET'){
            json_output(400,array('status' => 400,'message' => 'Bad request.'));
        } else {
           $received_Token = $this->input->request_headers('Authorization');// get token
            if(!isset($received_Token['Token'])){
                json_output(400,array('status' => 401,'message' => 'Unauthorized'));
            }else{ 
                $this->GetTokenData();
                $response = $this->ApiModel->GetAllCustomer(); // get all records from db
                $data = array();
                $j = 0;
                if($response != FALSE ){
                    for ($i=0; $i <count($response['data']) ; $i++) { 
                            $data[$j]['id'] = $response['data'][$i]->id;
                            $data[$j]['assigned_admin'] = $response['data'][$i]->admin_name;
                            $data[$j]['name'] = $response['data'][$i]->name;
                            $data[$j]['username'] = $response['data'][$i]->username;
                            $data[$j]['email'] = $response['data'][$i]->email;
                            $data[$j]['country_name'] = $response['data'][$i]->country_name;
                            $data[$j]['mobile_no'] = $response['data'][$i]->mobile_no;
                            $data[$j]['created_at'] = $response['data'][$i]->created_at;
                            $data[$j]['updated_at'] = $response['data'][$i]->updated_at;
                            $j++;
                        }
                    $response['data'] = $data;
                    json_output($response['status'],$response);
                }else{
                    json_output(404,array('status' => 404,'message' => 'No Data Found'));
                }
            }
        }
    }
    // To Delete the Record of customer API
    public function DeleteCustomerApi()
    {
        $id = "";
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            json_output(400,array('status' => 400,'message' => 'Bad request.'));
        } else {
           $received_Token = $this->input->request_headers('Authorization');// get token
            if(!isset($received_Token['Token'])){
                json_output(400,array('status' => 401,'message' => 'Unauthorized'));
            }else{ 
                $this->GetTokenData();
                if(isset( $_REQUEST['id']) && !empty( $_REQUEST['id'])){
                    $id = $_REQUEST['id'];
                    $response = $this->ApiModel->DeleteCustomer($id);//delete record from db
                    echo json_output($response['status'],$response);
                }else{
                    json_output(201,array('status' => 201,'message' => 'please provide record details !')); 
                }

                
            }
        }
    }

    //To Verify token
    public function GetTokenData()
    {
        $received_Token = $this->input->request_headers('Authorization');// get token
        try
        {
            $jwtData = $this->objOfJwt->DecodeToken($received_Token['Token']); // to decode valid token
            return true;
        }
        catch (Exception $e)
        {
            http_response_code('401');
            echo json_encode(array( "status" => false, "message" => 'Token Mismatch'));
            exit;
        }
    }
}

?>