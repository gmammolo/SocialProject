<?php

define("_HOME_DIR_" , "php.server/SocialProject/");
define("_HOME_URL_" , "/SocialProject/index.php");
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
require_once _DIR_MODEL_.'Relationship.php';
require_once _DIR_MODEL_.'Post.php';
require_once _DIR_MODEL_.'Showcase.php';


require_once _DIR_TEMPLATE_.'MenageTemplate.php';
MenageTemplate::addJavascript("Config/Config.js");

?>