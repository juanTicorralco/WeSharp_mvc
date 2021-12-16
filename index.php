<?php

require_once "controllers/templateController.php";
require_once "controllers/curlController.php";
require_once "controllers/controllerUsers.php";

require_once "extensions/vendor/autoload.php";

$index = new TemplateController;
$index->index();
