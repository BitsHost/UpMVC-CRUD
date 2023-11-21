<?php
/*
 *   Copyright (c) 2023 BitsHost
 *   All rights reserved.

 *   Permission is hereby granted, free of charge, to any person obtaining a copy
 *   of this software and associated documentation files (the "Software"), to deal
 *   in the Software without restriction, including without limitation the rights
 *   to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *   copies of the Software, and to permit persons to whom the Software is
 *   furnished to do so, subject to the following conditions:

 *   The above copyright notice and this permission notice shall be included in all
 *   copies or substantial portions of the Software.

 *   THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *   IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *   FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *   AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *   LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *   OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 *   SOFTWARE.
 */

namespace MyApp\Views;

use MyApp\Config\Conf;

class BaseView
{
    public function renderHeader()
    {
        $conf   = new Conf();
        $appUrl = $conf->appUrl();
        echo '<!DOCTYPE html>';
        echo '<html lang="en">';
        echo '<head>';
        echo '<meta charset="UTF-8">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo '<link rel="stylesheet" href="' . $appUrl . '/public/assets/css/styles.css">';
        echo '<script src="' . $appUrl . '/public/assets/js/script.js"></script>';
        echo '<title>PHP CRUD Example</title>';
        echo '</head>';
        echo '<body>';
    }

    public function renderFooter()
    {
        echo '</body>';
        ?>
        <div>
            <p style="text-align:center;"><a href="https://bitshost.biz/free-web-hosting.html"
                    style="color: black; text-align:center; font-size: 15px;" target="_blank">©️ All rights reserved - BitsHost
                    Cloud
                    <?php echo date("Y"); ?><a>

            </p>
        </div>
        <?php
        echo '</html>';
    }
}
