<?php
namespace MyApp\Controllers;


class BaseController {
    protected $view;

    public function __construct($view) {
        $this->view = $view;
    }

    public function renderHeader() {
        $this->view->renderHeader();
    }

    public function renderFooter() {
        $this->view->renderFooter();
    }
}
