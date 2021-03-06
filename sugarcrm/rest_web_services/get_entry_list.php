<?php
    
    ini_set('memory_limit', '-1');
    ini_set('max_execution_time', 0);

    $url = "http://dev1sugargini.ossclients.com/crmprodev6/service/v4/rest.php";
    $username = "siddarth";
    $password = "siddarth";
    $last_sync_time = '0000-00-00 00:00:00';
    //function to make cURL request
    function call($method, $parameters, $url)
    {
        ob_start();
        $curl_request = curl_init();

        curl_setopt($curl_request, CURLOPT_URL, $url);
        curl_setopt($curl_request, CURLOPT_POST, 1);
        curl_setopt($curl_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($curl_request, CURLOPT_HEADER, 1);
        curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_request, CURLOPT_FOLLOWLOCATION, 0);

        $jsonEncodedData = json_encode($parameters);

        $post = array(
             "method" => $method,
             "input_type" => "JSON",
             "response_type" => "JSON",
             "rest_data" => $jsonEncodedData
        );

        curl_setopt($curl_request, CURLOPT_POSTFIELDS, $post);
        $result = curl_exec($curl_request);
        curl_close($curl_request);

        $result = explode("\r\n\r\n", $result, 2);
        $response = json_decode($result[1]);
        ob_end_flush();

        return $response;
    }

    //login --------------------------------------------

    $login_parameters = array(
         "user_auth"=>array(
              "user_name"=>$username,
              "password"=>md5($password),
              "version"=>"1"
         ),
         "application_name"=>"RestTest",
         "name_value_list"=>array(),
    );

    $login_result = call("login", $login_parameters, $url);

    //get session id
    $session_id = $login_result->id;
    //get user_id
    $user_id = $login_result->name_value_list->user_id->value;

    /* Configurations Start */

    $event = 'Meetings';
    $query = "(";
    $query .= strtolower($event).".assigned_user_id='".$user_id."' ";
    $query .= " OR ".strtolower($event).".modified_user_id='".$user_id."' ";
    $query .= " OR ".strtolower($event).".created_by='".$user_id."' " ;
    $query .= ")";
    
    

    if ($last_sync_time != '0000-00-00 00:00:00') {
        $query .= " AND (".strtolower($event).".date_entered>'".$last_sync_time."' ";
        $query .= " OR ".strtolower($event).".date_modified>'".$last_sync_time."') ";
    }
    echo 'query :<hr>'.$query.'<hr>';
    $max_results = '99999';

    /* Configurations End */

    //get list of records --------------------------------
   
    $get_entry_list_parameters = array(

         //session id
         'session' => $session_id,

         //The name of the module from which to retrieve records
         'module_name' => $event,

         //The SQL WHERE clause without the word "where".
         'query' => $query,

         //The SQL ORDER BY clause without the phrase "order by".
         'order_by' => "",

         //The record offset from which to start.
         'offset' => '0',

         //Optional. A list of fields to include in the results.
         'select_fields' => array(
              'id',
              'name',
              'title',
         ),

         /*
         A list of link names and the fields to be returned for each link name.
         Example: 'link_name_to_fields_array' => array(array('name' => 'email_addresses', 'value' => array('id', 'email_address', 'opt_out', 'primary_address')))
         */
         'link_name_to_fields_array' => array(
         ),

         //The maximum number of results to return.
         'max_results' => $max_results,

         //To exclude deleted records

         'deleted' => '0',

         //If only records marked as favorites should be returned.
         'Favorites' => false,
    );

    $get_entry_list_result = call('get_entry_list', $get_entry_list_parameters, $url);
    echo '<pre> <hr>RETURNED RESPONSE FOR '.$event .'<hr>';
    print_r($get_entry_list_result);
    echo '</pre>';

?>