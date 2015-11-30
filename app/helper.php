<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of helper
 *
 * @author Crusty
<?php

/**
 * Set a flash message in the session.
 *
 * @param  string $message
 * @return void
 */
function flash($message) {
    session()->flash('message', $message);
}
