<?php
class Route{
    private $_keyRoute = null;
    function handleRoute($url)
    {
        global $routes;
        unset($routes['default_controller']);
        $url = trim($url);
        $handleUrl = $url;
        if (!empty($routes)) {
            foreach ($routes as $key => $value) {
                if (preg_match('~' . $key . '~is', $url)) {
                    $handleUrl = preg_replace('~' . $key . '~is', $value, $url);
                    $this->_keyRoute = $key;
                }
            }
        }
        return $handleUrl;
    }

    public function getUrl(){
        return $this->_keyRoute;
    }

    static function getFullUrl(){
        $uri = App::getUrl();
        return $uri;
    }
}
