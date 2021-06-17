<?php

require_once 'src/inc/classes/Autoloader.php';

Autoloader::register();

Application::process();


require_once 'src/inc/partials/footer.php';