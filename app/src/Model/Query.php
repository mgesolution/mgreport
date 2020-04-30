<?php
use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\ORM\ValidationException;
class Query extends DataObject
{
    private static $db = [
        'QueryValue' => 'Text',
    ];

    private static $has_one = [
        "Koneksi" => Koneksi::class,
    ];

}
