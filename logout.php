<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 12/01/16
 * Time: 10:00
 */



SESSION_START();

SESSION_UNSET();

SESSION_DESTROY();

header('Location: index.php?e=logout');
?>
