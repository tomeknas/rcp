<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MediaboxController
 *
 * @author Tomek
 */
class MediaboxController extends ControllerBase {
    public function index(){}
    public function close() {
        $entry = new Mediabox($_POST['id']);
        $entry->store();
    }
}
