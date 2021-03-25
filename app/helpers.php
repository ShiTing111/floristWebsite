<?php

function productImage($path)
{
    return $path && file_exists('storage/bouquet/images/'.$path) ? asset('storage/bouquet/images/'.$path) : asset('images/not-found.jpg');
}

