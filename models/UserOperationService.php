<?php
namespace Pod\User\Operation\Service;
require __DIR__ . '/../vendor/autoload.php';

use Pod\Base\Service\BaseService;
use Pod\Base\Service\ApiRequestHandler;
use Exception;

class UserOperationService extends BaseService {

    private $header;
    private $serverType;
    private static $userOperationApi =
        [
            // #1, tag: user_operations -> getUserProfile
            'getUserProfile' => [
                'baseUri'   => 'PLATFORM-ADDRESS',
                'subUri'    => 'nzh/getUserProfile/',
                'method'    => 'GET'
            ],

            // #2, tag: user_operations -> editProfile
            'editProfile' => [
                'baseUri'   => 'PLATFORM-ADDRESS',
                'subUri'    => 'nzh/editProfile/',
                'method'    => 'POST'
            ],

            // #3, tag: user_operations -> editProfileWithConfirmation
            'editProfileWithConfirmation' => [
                'baseUri'   => 'PLATFORM-ADDRESS',
                'subUri'    => 'nzh/editProfileWithConfirmation/',
                'method'    => 'POST'
            ],

            // #4, tag: user_operations -> confirmEditProfile
            'confirmEditProfile' => [
                'baseUri'   => 'PLATFORM-ADDRESS',
                'subUri'    => 'nzh/confirmEditProfile/',
                'method'    => 'POST'
            ],

            // #5, tag: user_operations -> listAddress
            'listAddress' => [
                'baseUri'   => 'PLATFORM-ADDRESS',
                'subUri'    => 'nzh/listAddress/',
                'method'    => 'GET'
            ],

        ];

    public function __construct($baseInfo)
    {
        parent::__construct();

        self::$jsonSchema = json_decode(file_get_contents ('jsonSchema.json'), true);
        $this->serverType = $baseInfo->getServerType();
        $this->header = [
            "_token_issuer_"    => $baseInfo->getTokenIssuer(),
            "_token_"           => $baseInfo->getToken(),
        ];
    }


    /**
     * @param array $params
     *      @option string "client_id"
     *      @option string "client_secret"
     * @throws
     * @return mixed
    */
    public function getUserProfile ($params) {
        $apiName = 'getUserProfile';
        $paramKey = self::$userOperationApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';

        array_walk_recursive($params, 'self::prepareData');

        $option = [
            'headers' => $this->header,
            $paramKey => $params,
        ];

        $validateResult = self::validateOption($apiName, $option, $paramKey);
        if ($validateResult['validate']) {
            return ApiRequestHandler::Request(
                self::$config[$this->serverType][self::$userOperationApi[$apiName]['baseUri']],
                self::$userOperationApi[$apiName]['method'],
                self::$userOperationApi[$apiName]['subUri'],
                $option
            );
        }
        else {
            throw new Exception($validateResult['errorMessage'], self::VALIDATION_ERROR_CODE);
        }

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
     * @throws

     * @return mixed
     */

    public function editProfileWithConfirmation ($params) {
        $apiName = 'editProfileWithConfirmation';
        $paramKey = self::$userOperationApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';

        array_walk_recursive($params, 'self::prepareData');

        $option = [
            'headers' => $this->header,
            $paramKey => $params,
        ];

        $validateResult = self::validateOption($apiName, $option, $paramKey);
        if ($validateResult['validate']) {
            return ApiRequestHandler::Request(
                self::$config[$this->serverType][self::$userOperationApi[$apiName]['baseUri']],
                self::$userOperationApi[$apiName]['method'],
                self::$userOperationApi[$apiName]['subUri'],
                $option
            );
        }
        else {
            throw new Exception($validateResult['errorMessage'], self::VALIDATION_ERROR_CODE);
        }

    }

    /**
     * @param array $params
     *      @option string  "client_id"
     *      @option string  "client_secret"
     *      @option string  "offset"
     *      @option string  "lastName"
     * @return mixed
     * @throws
     */

    public function listAddress ($params) {
        $apiName = 'listAddress';
        $paramKey = self::$userOperationApi[$apiName]['method'] == 'GET' ? 'query' : 'form_params';

        array_walk_recursive($params, 'self::prepareData');

        $option = [
            'headers' => $this->header,
            $paramKey => $params,
        ];

        $validateResult = self::validateOption($apiName, $option, $paramKey);
        if ($validateResult['validate']) {
            return ApiRequestHandler::Request(
                self::$config[$this->serverType][self::$userOperationApi[$apiName]['baseUri']],
                self::$userOperationApi[$apiName]['method'],
                self::$userOperationApi[$apiName]['subUri'],
                $option
            );
        }
        else {
            throw new Exception($validateResult['errorMessage'], self::VALIDATION_ERROR_CODE);
        }

    }
}