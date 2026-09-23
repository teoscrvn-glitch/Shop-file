<?php
require_once(__DIR__ . '/core/db.php');
require_once(__DIR__ . '/core/helpers.php');

function insert_options($key, $value)
{
    global $LOCNGUYEN_SIEUTHICODE;
    if (!$LOCNGUYEN_SIEUTHICODE->get_row("SELECT * FROM `options` WHERE `key` = '$key' ")) {

        $LOCNGUYEN_SIEUTHICODE->query("INSERT INTO `options` (`key`, `value`) VALUES ('$key', '$value')");
    }
}

insert_options('footer','');
insert_options('noti_home','');
die('Success!');
