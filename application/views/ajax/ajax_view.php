<?php 
if(isset ($print_header) && $print_header == 'ajax'){
    header('Content-Type: application/json');
}
echo $ajax_value;
?>
