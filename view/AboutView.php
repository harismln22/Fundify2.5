<?php
include_once("model/Template.php");
class AboutView {

    public function render()
    {
        $views = new Template("layout/about.html");
        $views->write();
    }
}