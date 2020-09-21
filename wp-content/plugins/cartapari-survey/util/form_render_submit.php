<?php

function test(){
    print_r($_POST);
}
add_action("admin_post_test","test");
?>