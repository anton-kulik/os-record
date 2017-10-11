<?php

define('DS', DIRECTORY_SEPARATOR);

function getCfg() {
    $cfgFileName = 'cfg.ini';
    if(file_exists($cfgFileName)) {
        return parse_ini_file($cfgFileName);
    }
    return 'file is not exists';
}