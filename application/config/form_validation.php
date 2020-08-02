<?php 
$config = array(
	'customer_rules'  => [

                        [
                                'field' => 'name',
                                'label' => 'Name',
                                'rules' => 'trim|required|max_length[50]'
                        ],

                        [
                                'field' => 'username',
                                'label' => 'Username',
                                'rules' => 'trim|required|max_length[25]|is_unique[customers_list_tbl.username]'
                        ],

                        [
                                'field' => 'mobile_no',
                                'label' => 'Mobile No',
                                'rules' => 'trim|required|required|regex_match[/^([+]\d{2})?\d{10}$/]|is_unique[customers_list_tbl.mobile_no]'
                        ],

                        [

                                'field' => 'email',
                                'label' => 'Email Address',
                                'rules' => 'trim|required|valid_email|max_length[100]|is_unique[customers_list_tbl.email]'
                        ],

                        [

                                'field' => 'admin',
                                'label' => 'Admin',
                                'rules' => 'trim|required'
                        ],
                ],

        );

?>