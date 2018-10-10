<?php

define('ACHAGUA_BK_ROOT',dirname(__FILE__));

function req($path) {
    return include_once(ACHAGUA_BK_ROOT.$path);
}