<?php
namespace MyApp\Views;

use MyApp\Config\Conf;

class BaseView {
    public function renderHeader() {
        $conf = new Conf();
        $appUrl = $conf->appUrl();
        echo '<!DOCTYPE html>';
        echo '<html lang="en">';
        echo '<head>';
        echo '<meta charset="UTF-8">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo '<link rel="stylesheet" href="'.$appUrl.'/public/assets/css/styles.css">';
        echo '<script src="'.$appUrl.'/public/assets/js/script.js"></script>';
        echo '<title>PHP CRUD Example</title>';
        echo '</head>';
        echo '<body>';
    }

    public function renderFooter() {
        echo '</body>';
        echo '</html>';
    }
}
