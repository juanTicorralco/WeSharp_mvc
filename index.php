<?php

require_once "controllers/templateController.php";
require_once "controllers/curlController.php";
require_once "controllers/controllerUsers.php";

$index = new TemplateController;

$index->index();
