<?php
include_once dirname(__DIR__).'/src/classes/LSYS/PcntlUtils.php';
include __DIR__."/Bootstarp.php";
LSYS\PcntlUtils::setRestart();
LSYS\PcntlUtils::setUser();
//unix 统一入口