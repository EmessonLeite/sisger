<?php
if(file_exists("includes/inc{$url->getURL(0)}.php")){
    include_once("includes/inc{$url->getURL(0)}.php");
}