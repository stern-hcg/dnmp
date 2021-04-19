<?php


if (in_array(PHP_SAPI, ['cli', 'phpdbg', 'embed'], true)) {
    include_once dirname(__FILE__) . "/cli_inject.php";
} else {
    include_once dirname(__FILE__) . "/fpm_inject.php";
}

