<?php
/**
 * Created by Payfull.
 * Date: 10/15/2018
 */

namespace Param;

class Config
{
    const TEST_SERVICE_URL_NEW = 'http://test-dmz.ew.com.tr:8080/out.ws/service_ks.asmx?wsdl';
    const PROD_SERVICE_URL_NEW = 'https://dmzws.param.com.tr/out.ws/service_ks.asmx?wsdl';
    const TEST_SERVICE_URL = 'http://test-dmz.ew.com.tr:8080/turkpos.ws/service_turkpos_test.asmx?wsdl';
    const PROD_SERVICE_URL = 'https://dmzws.param.com.tr/turkpos.ws/service_turkpos_prod.asmx?wsdl';
    const TEST_MODE_FLAG = 'TEST';

    public $serviceUrl;
    public $mode;//TEST or something else
    public $clientCode;//Terminal ID, It will be forwarded by param.
    public $clientUsername;//User Name, It will be forwarded by param.
    public $clientPassword;//Password, It will be forwarded by param.
    public $guid;//Key Belonging to Member Workplace
    public $soapOpts;//SOAP options

    public function __construct($clientCode, $clientUsername, $clientPassword, $guid, $mode, $newAPI = false)
    {
        $this->clientCode = $clientCode;
        $this->clientUsername = $clientUsername;
        $this->clientPassword = $clientPassword;
        $this->guid = $guid;
        $this->mode = $mode;
        $this->soapOpts = array(
	        'soap_version' => 'SOAP_1_1',
	        'trace' => 1,
	        'stream_context' => stream_context_create(array(
		        'ssl' => array(
			        'crypto_method' => STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT
		        )
	        ))
        );
        if($newAPI)
        {
            $this->serviceUrl = ($mode == self::TEST_MODE_FLAG)?self::TEST_SERVICE_URL_NEW:self::PROD_SERVICE_URL_NEW;
        }
        else{
            $this->serviceUrl = ($mode == self::TEST_MODE_FLAG)?self::TEST_SERVICE_URL:self::PROD_SERVICE_URL;
        }
    }
}
