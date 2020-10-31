<?php namespace Config;

define("ROOT", dirname(__DIR__) . "/");
//Path to your project's root folder
define("FRONT_ROOT", "/YourMovie/");
define("VIEWS_PATH", "Views/");
define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");
define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");
define("IMG_PATH", VIEWS_PATH . "img/");

//Database Constants
define("DB_HOST", "localhost");
define("DB_NAME", "yourmovie");
define("DB_USER", "");
define("DB_PASS", "");

//API Constants
define("API_URL", 'https://api.themoviedb.org/3/');
define('KEY','?api_key=1b6861e202a1e52c6537b73132864511&language=en-US&page=1');

?>




