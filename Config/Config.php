<?php


define("_DIR_TEMPLATE_", _ROOT_."Template/");
define("_DIR_MODEL_", _ROOT_."Model/");
define("_DIR_VIEW_", _ROOT_."View/");
define("_DIR_CONTROLLER_", _ROOT_."Controller/");
define("_DIR_CONFIG_", _ROOT_."Config/");

require_once _DIR_MODEL_. 'Utility.php';
require_once _DIR_MODEL_. 'Database.php';
require_once _DIR_MODEL_. 'Session.php';
require_once _DIR_MODEL_ . 'Enum.php';

require_once _DIR_MODEL_.'User.php';
require_once _DIR_MODEL_.'Profile.php';
require_once _DIR_MODEL_.'Friendship.php';


require_once _DIR_TEMPLATE_.'/GestoreTemplate.php';
GestoreTemplate::addJavascript("Config/Config.js");

?>