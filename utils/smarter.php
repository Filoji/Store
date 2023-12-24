<?php
namespace Smarter;
function include_with_props(string $file ,array $props){
    include $file;
}

function redirect($location) {
    header('Location: ' . $location, TRUE, 302);
    exit();
}
?>