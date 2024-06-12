//

200 Success

201 Invalid request

202 Username or password incorrect

204 Unauthorized user



        $response = array();
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

        } else {
            $response['message'] = 'Invalid Request';
            $response['code'] = 201;
            $response['status'] = false;
        }
        echo json_encode($response);
