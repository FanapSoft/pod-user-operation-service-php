<?php
use PHPUnit\Framework\TestCase;
use Pod\User\Operation\Service\UserOperationService;
use Pod\Base\Service\BaseInfo;
use Pod\Base\Service\Exception\ValidationException;
use Pod\Base\Service\Exception\PodException;

final class UserOperationTest extends TestCase
{
//    public static $apiToken;
    public static $userOperationService;
    const TOKEN_ISSUER = 1;
    const API_TOKEN = '{Put Api Token}';
    const ACCESS_TOKEN = '{Put Access Token}';
    const CLIENT_ID = '{Put Client Id}';
    const CLIENT_SECRET = '{Put Client Secret}';
    const CONFIRM_CODE = '{Put Confirm Code}';

    public function setUp(): void
    {
        parent::setUp();
        # set serverType to SandBox or Production
        BaseInfo::initServerType(BaseInfo::SANDBOX_SERVER);
        self::$userOperationService = new UserOperationService();
    }

    public function testGetUserProfileAllParameters()
    {
        $params =
            [
            ## ============== Required Parameters  ====================
                "token"         => self::ACCESS_TOKEN,
            ## ============== Optional Parameters  ====================
                'tokenIssuer'   => self::TOKEN_ISSUER,
                "client_id"     => self::CLIENT_ID,
                "client_secret" => self::CLIENT_SECRET,
        ];

        try {
            $result = self::$userOperationService->getUserProfile($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: '. $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: '. $error['message']);
        }
    }

    public function testGetUserProfileRequiredParameters()
    {
        $params = [
        ## ============== Required Parameters  ====================
            "token"         => self::ACCESS_TOKEN,
        ];
        try {
            $result = self::$userOperationService->getUserProfile($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: '. $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: '. $error['message']);
        }
    }

    public function testGetUserProfileValidationError()
    {
        $params = [
            ## ============== Required Parameters  ====================
        ];
        try {
            self::$userOperationService->getUserProfile($params);
        }
        catch (ValidationException $e) {
            $validation = $e->getErrorsAsArray();
            $this->assertNotEmpty($validation);
            $result = $e->getResult();
            $this->assertArrayHasKey('_token_', $validation);
            $this->assertEquals(887,$result['code']);
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: '. $error['message']);
        }
    }

    public function testEditProfileWithConfirmationAllParameters()
    {
        $name = uniqid('TestEditProfile');
        $params =
            [
            ## ============== Required Parameters  ====================
                "token"         => self::ACCESS_TOKEN,
                'nickName'      => $name,
            ## ============== Optional Parameters  ====================
                'tokenIssuer'   => self::TOKEN_ISSUER,
                "client_id"     => self::CLIENT_ID,
                "client_secret" => self::CLIENT_SECRET,
                'firstName' => 'userOpTestFirstName',       # scope: profile
                'lastName' => 'userOpTestLastName',         # scope: profile
                'email' =>   'test@test.com',              # scope: email
                'phoneNumber' => '05136211111',   # scope: address
                'cellphoneNumber' => '09151111111',   # scope: phone
                'nationalCode' => '1111771111',          # scope: legal
                'gender' =>   'WOMAN_GENDER',                     # scope: profile MAN_GENDER یا WOMAN_GENDER
                'address' =>   'رضاشهر خیابان هفتم',                   # scope: address
                'birthDate' =>  '1363/01/27',               # scope: legal  تاریخ شمسی تولد yyyy/mm/dd
                'country' =>  'ایران',                    # scope: address
                'state' => 'خراسان رضوی',                         # scope: address استان محل تولد
                'city' =>   'مشهد',                         # scope: address
                'postalcode' =>  '9698146968',             # scope: address
                'sheba' =>  '980570100680013557234101',                        # scope: legal  شبا که به صورت عددی وارد می شود. (بدون IR)
                'profileImage' =>  'https://core.pod.land:443/nzh/image/?imageId=110531&width=909&height=909&hashCode=16b11e5cf3c-0.42178732891944504',         # scope: profile     تصویر پروفایل کاربر
                'birthState' => 'خراسان رضوی',              # scope: address
                'client_metadata' => '{put client meta data}',    # SSO client_metadata
                'identificationNumber' => '639',  # شماره شناسنامه
                'fatherName' => 'پرویز',              # scope: profile نام پدر
        ];

        try {
            $result = self::$userOperationService->editProfileWithConfirmation($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: '. $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: '. $error['message']);
        }
    }

    public function testEditProfileWithConfirmationRequiredParameters()
    {
        $name = uniqid('TestEditProfile');
        $params = [
            ## ============== Required Parameters  ====================
            "token"         => self::ACCESS_TOKEN,
            'nickName'      => $name,
        ];
        try {
            $result = self::$userOperationService->editProfileWithConfirmation($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: '. $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: '. $error['message']);
        }
    }

    public function testEditProfileWithConfirmationValidation()
    {
        $name = uniqid('TestEditProfile');
        $wrongEmail = 'test@';
        $wrongMobilePhone = '0951111111';
        $wrongPhoneNumber = '123456789012345';
        $wrongGender = 'female';
        $wrongBirthDate = '1398-01-01';
        $wrongSheba = '139801';
        $wrongPostalCode = '12345';
        $wrongNationalCode = '1234567';
        $params = [
            ## ============== Required Parameters  ====================
            "token"             => self::ACCESS_TOKEN,
            'nickName'          => $name,
            ## ============== Optional Parameters  ====================
            'email'             =>  $wrongEmail,
            'phoneNumber'       => $wrongPhoneNumber,
            'cellphoneNumber'   => $wrongMobilePhone,
            'nationalCode'      => $wrongNationalCode,
            'gender'            => $wrongGender,
            'birthDate'         =>  $wrongBirthDate,
            'postalcode'        =>  $wrongPostalCode,
            'sheba'             =>  $wrongSheba,
        ];
        try {
            self::$userOperationService->editProfileWithConfirmation($params);
        }
        catch (ValidationException $e) {
            $validation = $e->getErrorsAsArray();
            $this->assertNotEmpty($validation);

            $result = $e->getResult();

            $this->assertArrayHasKey('email', $validation);
            $this->assertArrayHasKey('phoneNumber', $validation);
            $this->assertArrayHasKey('cellphoneNumber', $validation);
            $this->assertArrayHasKey('nationalCode', $validation);
            $this->assertArrayHasKey('gender', $validation);
            $this->assertArrayHasKey('birthDate', $validation);
            $this->assertArrayHasKey('postalcode', $validation);
            $this->assertArrayHasKey('sheba', $validation);

            $this->assertEquals(887,$result['code']);

        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: '. $error['message']);
        }
    }

    public function testConfirmEditProfileAllParameters()
    {
        $params =
            [
                ## ============== Required Parameters  ====================
                "token"             => self::ACCESS_TOKEN,
                'code'              => self::CONFIRM_CODE,
                'cellphoneNumber'   => "09158107405",
            ];

        try {
            $result = self::$userOperationService->confirmEditProfile($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: '. $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->assertEquals(101, $error['code']);
        }
    }

//    public function testConfirmEditProfileRequiredParameters()
//    {
//        $params = [
//            ## ============== Required Parameters  ====================
//            "token"         => self::ACCESS_TOKEN,
//        ];
//        try {
//            $result = self::$userOperationService->confirmEditProfile($params);
//            $this->assertFalse($result['hasError']);
//        } catch (ValidationException $e) {
//            $this->fail('ValidationException: '. $e->getErrorsAsString());
//        } catch (PodException $e) {
//            $error = $e->getResult();
//            $this->fail('PodException: '. $error['message']);
//        }
//    }

//    public function testConfirmEditProfileValidationError()
//    {
//        $params = [
//            ## ============== Required Parameters  ====================
//        ];
//        try {
//            self::$userOperationService->confirmEditProfile($params);
//        }
//        catch (ValidationException $e) {
//            $validation = $e->getErrorsAsArray();
//            $this->assertNotEmpty($validation);
//            $result = $e->getResult();
//            $this->assertNotEmpty($validation['_token_']);
//            $this->assertEquals(887,$result['code']);
//        } catch (PodException $e) {
//            $error = $e->getResult();
//            $this->fail('PodException: '. $error['message']);
//        }
//    }

    public function testListAddressAllParameters()
    {
        $params =
            [
                ## ============== Required Parameters  ====================
                "token"         => self::ACCESS_TOKEN,
                "offset"        => 0,
                ## ============== Optional Parameters  ====================
                'size'          => 10,
            ];

        try {
            $result = self::$userOperationService->getListAddress($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: '. $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: '. $error['message']);
        }
    }

    public function testGetListAddressRequiredParameters()
    {
        $params = [
            ## ============== Required Parameters  ====================
            "token"         => self::ACCESS_TOKEN,
            "offset"        => 0,
        ];
        try {
            $result = self::$userOperationService->getListAddress($params);
            $this->assertFalse($result['hasError']);
        } catch (ValidationException $e) {
            $this->fail('ValidationException: '. $e->getErrorsAsString());
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: '. $error['message']);
        }
    }

    public function testGetListAddressValidationError()
    {
        $params = [
            ## ============== Required Parameters  ====================
        ];
        try {
            self::$userOperationService->getListAddress($params);
        }
        catch (ValidationException $e) {
            $validation = $e->getErrorsAsArray();
            $this->assertNotEmpty($validation);
            $result = $e->getResult();
            $this->assertArrayHasKey('_token_', $validation);
            $this->assertArrayHasKey('offset', $validation);
            $this->assertEquals(887,$result['code']);
        } catch (PodException $e) {
            $error = $e->getResult();
            $this->fail('PodException: '. $error['message']);
        }
    }
}