<?php 

    //create relative url
    function urlFor($script_path) {
        //add '/' at the beginning if there is none 
        if($script_path[0] != '/') {
            $script_path = "/" . $script_path;
        }
        return WWW_ROOT . $script_path;
    }

    //used to encode urls (space is encoded as '+')
    function u($string="") {
        return urlencode($string);
    }

    //used to encode urls (space is encoded as '%20')
    function rawU($string="") {
        return rawurlencode($string);
    }

    //if dynamic data is embedded to html pass data through this function first
    function h($string="") {
        return htmlspecialchars($string);
    }

    function error404() {
        header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
        exit();
    }

    function error500() {
        header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
        exit();
    }

    function redirectTo($location) {
        header("Location: " . $location);
        exit;
    }

    function isPostRequest() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    function isGetRequest() {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    function displayErrors($errors = array()) {
        $output = '';
        if (!empty($errors)) {
            $output .= "<div class=\"errors\">";
            $output .= "Please fix following errors:";
            $output .= "<ul>";
            foreach ($errors as $error) {
                $output .= "<li>" . h($error) . "</li>";
            }
            $output .= "</ul>";
            $output .= "</div>";
        }
        return $output;
    }

    function getAndClearSessionMessage() {
        if (isset($_SESSION['message']) && $_SESSION['message'] != '') {
            $msg = $_SESSION['message'];
            unset($_SESSION['message']);
            return $msg;
        }
    }

    function displaySessionMessage() {
        $msg = getAndClearSessionMessage();
        if (!isBlank($msg)) {
            return '<p class="error-message">' . h($msg) . '</p>';
        }
    }

    function getProductInfoFromURL($url) {
        //get part of url after "?" which contains relevant info
        $info = explode("?", $url)[1];
        //separate relevant info from each other
        $info = explode("/", $info);

        //[0] - productID
        //[1] - product description
        //[2] - price
        return $info;
    }

?>