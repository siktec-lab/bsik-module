<?php

use \Siktec\Bsik\Builder\Components;

/****************************************************************************/
/*******************  Custom Private Components       ***********************/
/****************************************************************************/

//A component to generat settings html form
Components::register_once("greetings", function(
    string $name = "World"
) {
    return "Hello $name";
});
