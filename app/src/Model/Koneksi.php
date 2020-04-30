<?php
use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\ORM\ValidationException;
class Koneksi extends DataObject
{
    private static $db = [
        'Nama' => 'Varchar(100)',
        'Host' => 'Varchar(100)',
        'User' => 'Varchar(100)',
        'Password' => 'Varchar(100)',
        'Port' => 'Varchar(10)',
        'Database' => 'Varchar(255)',
    ];
    private static $has_many = [
        "Query" => Query::class,
    ];

}
