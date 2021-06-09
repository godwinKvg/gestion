<?php

require_once 'src/inc/classes/Autoloader.php';
Autoloader::register();
require_once 'src/inc/partials/header.php';
Message::showGetMsg();


Application::process();


require_once 'src/inc/partials/footer.php';
