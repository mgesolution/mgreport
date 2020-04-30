<?php
use SilverStripe\Control\HTTPRequest;

class ApiController extends PageController
{
    private static $allowed_actions = [
        "testFunction",
        "getKoneksi",
        "insertKoneksi",
        "deleteKoneksi",
        "getDataFromDB"
    ];

    private static $url_handlers = [

    ];

    protected function init()
    {
        parent::init();
    }

    public function testFunction(HTTPRequest $param)
    {
    }

    public static function checkRequiredRequest($required_arr, $method = 'REQUEST')
    {
        $data = array();
        if ($method == 'REQUEST') {
            $data = $_REQUEST;
        } elseif ($method == 'GET') {
            $data = $_GET;
        } else {
            $data = $_POST;
        }

        foreach ($required_arr as $row) {
            if (!isset($data[$row]) || (empty($data[$row]) || is_null($data[$row]))) {
                return false;
            }
        }
        return true;
    }

    public function setHeader()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
        header('Content-Type: application/json');
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            header('Access-Control-Allow-Origin: *');
            header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
            header("HTTP/1.1 200 OK");
        }
    }

    public function getKoneksi(HTTPRequest $request)
    {
        $this->setHeader();
        $data = KoneksiAPIController::getKoneksi($_POST);
        return json_encode($data);
    }
    public function insertKoneksi(HTTPRequest $request)
    {
        $this->setHeader();
        $data = KoneksiAPIController::insertKoneksi($_POST);
        return json_encode($data);
    }
    public function deleteKoneksi(HTTPRequest $request)
    {
        $this->setHeader();
        $data = KoneksiAPIController::deleteKoneksi($_POST);
        return json_encode($data);
    }
    public function getDataFromDB(HTTPRequest $request)
    {
        $this->setHeader();
        $data = ConnectionAPIController::getDataFromDB($_POST);
        return json_encode($data);
    }
}
