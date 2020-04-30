<?php
// namespace Api\Login;
use SilverStripe\Control\Director;
use SilverStripe\Core\Environment;
class ConnectionAPIController
{
    public static function getDataFromDB($param)
    {
        $koneksi = Koneksi::get()->byID($param["ID"]);
        $conn = mysqli_connect($koneksi->Host, $koneksi->User, $koneksi->Password, $koneksi->Database,$koneksi->Port);
		if (!$conn) {
			$msg = "connection failed";
		}
        $result = mysqli_query($conn, $param["Query"]);
        $arrData=[];
        while($row = mysqli_fetch_assoc($result)) {
            $arrData[]=$row;
        }
        mysqli_close($conn);
        return array("info" => "success","data"=>$arrData);
    }
}
