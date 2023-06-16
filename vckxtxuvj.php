<?php


$runner = $_POST['runner'];
switch ($runner) {
    case 'infobip':
        require_once('./infob.php');
        break;
    
    case 'octopush':
        require_once('./Octopush.php');
        break;

    default:
        echo 'under development';
        break;
}
