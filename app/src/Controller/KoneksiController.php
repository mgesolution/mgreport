<?php
// namespace Api\Login;
use SilverStripe\Control\Director;
use SilverStripe\Core\Environment;
class KoneksiAPIController
{
    public static function insertKoneksi($param)
    {
        $post = $param;
        if (empty($post["ID"])) {
            $data = Koneksi::create();
        }else{
            $data = Koneksi::get()->byID($post["ID"]);
        }
        $field = $data->fieldLabels();
        $hasOne = $data->hasOne();
        foreach ($field as $key) {
            if ($key!="ID" && !empty($post[$key])) {
                $data->{$key}=$post[$key];
            }
        }
        foreach ($hasOne as $key) {
            $data->{$key."ID"}=$post[$key."ID"];
        }
        $id = $data->write();
        return array("info" => "success","data"=>$id);
    }

    public static function getKoneksi($param)
    {
        $post = $param;
        $dataObject = Koneksi::get();
        if (!empty($post["sortBy"]) && !empty($post["sortBy"])) {
            $dataObject = $dataObject->sort($post["sortBy"], $post["sortType"]);
        }

        if (!empty($post["filter"])) {
            $filter = $post["filter"];
            if (!empty($filter['Nama'])) {
                $dataObject = $dataObject->where("Nama Like '%" . $filter['Nama'] . "%'");
            }
            if (!empty($filter['ID'])) {
                $dataObject = $dataObject->where("ID = " . $filter['ID']);
            }
        }
        $dataCount = $dataObject->count();
        if (!empty($post["pageNow"]) && !empty($post["limit"])) {
            $offset = ($post["pageNow"] - 1) * $post["limit"];
            $dataNow = $dataObject->limit($post["limit"], $offset);
        } else {
            $dataNow = $dataObject;
        }

        $arrayData = $dataNow->toNestedArray();
        $hasOne = $dataNow->newObject()->hasOne();
        for ($i=0; $i < count($arrayData); $i++) { 
            foreach ($hasOne as $key2) {
                $myclass=$key2;
                $myObject = new $myclass();
                $arrayData[$i][$key2."Data"] = $myObject->get()->byID($dataNow->offsetGet($i)->{$key2}->ID)->toMap();
            }
        }
        return array("info" => "success", "data" => $arrayData, "countData" => $dataCount, "baseURL" => Director::absoluteBaseURL());
    }

    public static function deleteKoneksi($param)
    {
        $post = $param;
        $data = Koneksi::get()->byID($post["ID"]);
        $hasMany = $data->hasMany();
        foreach ($hasMany as $key) {
            $myclass=$key;
            $myObject = new $myclass();
            $dataList = $myObject->get()->where("KoneksiID =".$post["ID"]);
            foreach ($dataList as $key2) {
                $key2->delete();
            }
        }
        $data->delete();
        return array("info" => "success");
    }
}
