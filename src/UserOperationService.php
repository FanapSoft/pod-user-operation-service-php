<?php
namespace Pod\User\Operation\Service;

use Pod\Base\Service\BaseService;
use Pod\Base\Service\ApiRequestHandler;

class UserOperationService extends BaseService {

    private static $jsonSchema;
    private static $userOperationApi;
    private static $serviceProductId;
    private static $baseUri;

    public function __construct()
    {
        parent::__construct();

        self::$jsonSchema = json_decode(file_get_contents(__DIR__ . '/../config/validationSchema.json'), true);
        self::$userOperationApi = require __DIR__ . '/../config/apiConfig.php';
        self::$serviceProductId = require __DIR__ . '/../config/serviceProductId.php';
        self::$baseUri = self::$config[self::$serverType];
        self::$serviceProductId = self::$serviceProductId[self::$serverType];
    }

    /**
     * @param array $params
     *      @option string "client_id"
     *      @option string "client_secret"
     *      @option string  "_token_"
     *      @option string  "_token_issuer_"
     *      @option string  "scVoucherHash"
     *      @option string  "scApiKey"
     * @throws
     * @return mixed
    */
    public function getUserProfile ($params) {
        $apiName = 'getUserProfile';
        $optionHasArray = false;
        $method = self::$userOperationApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';

        $header = [
            '_token_issuer_' => 1,
            '_token_'   => ''
        ];
        array_walk_recursive($params, 'self::prepareData');

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }

        // set token in header
        if (isset($params['token'])) {
            $header['_token_'] = $params['token'];
            unset($params['token']);
        }

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($option, self::$jsonSchema[$apiName], $paramKey);
        // prepare params to send
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];
        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }
        return ApiRequestHandler::Request(
            self::$baseUri[self::$userOperationApi[$apiName]['baseUri']],
            $method,
            self::$userOperationApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );
    }

    /**
     * @param array $params
     *      @option string  "client_id"
     *      @option string  "client_secret"
     *      @option string  "firstName"
     *      @option string  "lastName"
     *      @option string  "nickName"
     *      @option string  "email"
     *      @option string  "phoneNumber"
     *      @option string  "cellphoneNumber"
     *      @option string  "nationalCode"
     *      @option string  "gender"
     *      @option string  "address"
     *      @option string  "birthDate"
     *      @option string  "country"
     *      @option string  "state"
     *      @option string  "city"
     *      @option string  "postalcode"
     *      @option string  "sheba"
     *      @option string  "profileImage"
     *      @option string  "client_metadata"
     *      @option string  "birthState"
     *      @option string  "identificationNumber"
     *      @option string  "fatherName"
     *      @option string  "_token_"
     *      @option string  "_token_issuer_"
     *      @option string  "scVoucherHash"
     *      @option string  "scApiKey"
     * @throws

     * @return mixed
     */

    public function editProfileWithConfirmation ($params) {
        $apiName = 'editProfileWithConfirmation';
        $optionHasArray = false;
        $method = self::$userOperationApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';

        $header = [
            '_token_issuer_' => 1,
            '_token_'   => ''
        ];

        array_walk_recursive($params, 'self::prepareData');

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }

        // set token in header
        if (isset($params['token'])) {
            $header['_token_'] = $params['token'];
            unset($params['token']);
        }

        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];


        self::validateOption($option, self::$jsonSchema[$apiName], $paramKey);
        // prepare params to send
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];
        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }
        return ApiRequestHandler::Request(
            self::$baseUri[self::$userOperationApi[$apiName]['baseUri']],
            $method,
            self::$userOperationApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );
    }

    /**
     * @param array $params
     *      @option string  "code"
     *      @option string  "cellphoneNumber"
     *      @option string  "_token_"
     *      @option string  "_token_issuer_"
     *      @option string  "scVoucherHash"
     *      @option string  "scApiKey"
     * @throws

     * @return mixed
     */

    public function confirmEditProfile ($params) {
        $apiName = 'confirmEditProfile';
        $optionHasArray = false;
        $method = self::$userOperationApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';
        $header = [
            '_token_issuer_' => 1,
            '_token_'   => ''
        ];

        array_walk_recursive($params, 'self::prepareData');

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }

        // set token in header
        if (isset($params['token'])) {
            $header['_token_'] = $params['token'];
            unset($params['token']);
        }
        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($option, self::$jsonSchema[$apiName], $paramKey);
        // prepare params to send
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];
        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }
        return ApiRequestHandler::Request(
            self::$baseUri[self::$userOperationApi[$apiName]['baseUri']],
            $method,
            self::$userOperationApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );
    }

    /**
     * @param array $params
     *      @option string  "client_id"
     *      @option string  "client_secret"
     *      @option string  "offset"
     *      @option string  "lastName"
     *      @option string  "_token_"
     *      @option string  "_token_issuer_"
     *      @option string  "scVoucherHash"
     *      @option string  "scApiKey"
     * @return mixed
     * @throws
     */

    public function getListAddress ($params) {
        $apiName = 'getListAddress';
        $optionHasArray = false;
        $method = self::$userOperationApi[$apiName]['method'];
        $paramKey = $method == 'GET' ? 'query' : 'form_params';
        $header = [
            '_token_issuer_' => 1,
            '_token_'   => ''
        ];

        array_walk_recursive($params, 'self::prepareData');

        // set tokenIssuer in header
        if (isset($params['tokenIssuer'])) {
            $header['_token_issuer_'] = $params['tokenIssuer'];
            unset($params['tokenIssuer']);
        }

        // set token in header
        if (isset($params['token'])) {
            $header['_token_'] = $params['token'];
            unset($params['token']);
        }
        $option = [
            'headers' => $header,
            $paramKey => $params,
        ];

        self::validateOption($option, self::$jsonSchema[$apiName], $paramKey);
        // prepare params to send
        $option[$paramKey]['scProductId'] = self::$serviceProductId[$apiName];
        if (isset($params['scVoucherHash'])) {
            $option['withoutBracketParams'] =  $option[$paramKey];
            unset($option[$paramKey]);
            $optionHasArray = true;
            $method = 'GET';
        }
        return ApiRequestHandler::Request(
            self::$baseUri[self::$userOperationApi[$apiName]['baseUri']],
            $method,
            self::$userOperationApi[$apiName]['subUri'],
            $option,
            false,
            $optionHasArray
        );
    }
}