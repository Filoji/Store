<?php
namespace Smarter;
function include_with_props(string $file ,array $props){
    include $file;
}

function redirect($location, $code=302) {
    header('Location: ' . $location, TRUE, $code);
    exit();
}

function currency($value) : string{
    return number_format($value, 2, ',', ' ') . '€';
}
?>