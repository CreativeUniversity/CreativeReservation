<?php
/**
 * Created by PhpStorm.
 * User: MhamdiRayen
 * Date: 08/02/2018
 * Time: 14:44
 */


session_start();

session_unset();

session_destroy();

header("location: ../../public/views/connectionUI.html");