<?php
const SITE_ROOT = __DIR__;
define("BASE_URL", "http://localhost/blog/");
define("ROOT_PATH", realpath(dirname(__FILE__)));
define("BLOCK_TIME", 300); // время блокировки при повторных авторизациях
define("MAX_ATTEMPTS_AUTH", 3); // время блокировки при повторных авторизациях
?>