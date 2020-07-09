<?php
use LSYS\CLI;
include __DIR__."/Bootstarp.php";
$pass=CLI::password("Input Your Password:");
CLI::write("password:".$pass);
$read=CLI::read("read:");
CLI::writeReplace($read);
CLI::wait(10);