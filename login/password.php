<?php
require_once('../vendor/autoload.php');

enviarCorreoRecuperacion();
header("location:../login/login.html");

function enviarCorreoRecuperacion(){
    if(isset($_POST['name']) && isset($_POST['email'])){
        //
        $name = $_POST['name'];
        $email = $_POST['email'];

        // Configure API key authorization: api-key
        $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');

        // Uncomment below line to configure authorization using: partner-key
        // $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('partner-key', 'YOUR_API_KEY');

        $apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(
        // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
        // This is optional, `GuzzleHttp\Client` will be used as default.
        new GuzzleHttp\Client(),
        $config);
        $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail(); // \SendinBlue\Client\Model\SendSmtpEmail | Values to send a transactional email
        $sendSmtpEmail['to'] = array(array('email'=>$email, 'name'=>$name));
        $sendSmtpEmail['templateId'] = 2;
        $sendSmtpEmail['params'] = array('FIRSTNAME' => $name);
        $sendSmtpEmail['headers'] = array('X-Mailin-custom'=>'custom_header_1:custom_value_1|custom_header_2:custom_value_2');    
        try {
        $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
        print_r($result);
        }
        catch (Exception $e) 
        {
        echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
        }
    }
}


?>