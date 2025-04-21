<?php


function randomString($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
    }

    return $str;
}
function dd($data)
    {
        echo "<pre style='background: #222; color: #0f0; padding: 10px; border-radius: 5px;'>";
        print_r($data);
        echo "</pre>";
        die();
    }

function uploadImage()
{
    $image = randomString(8) . basename($_FILES["image"]["name"]);

    $target_dir = "uploads/";
    $target_file = $target_dir.$$image;
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
}
