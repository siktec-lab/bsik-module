<?php

use \Siktec\Bsik\Module\Modules;
use \Siktec\Bsik\Module\Module;
use \Siktec\Bsik\Module\ModuleView;
use \Siktec\Bsik\Privileges as Priv;
use \Siktec\Bsik\Objects\SettingsObject;

/****************************************************************************/
/*******************  local Includes    *************************************/
/****************************************************************************/
require_once "includes".DIRECTORY_SEPARATOR."components.php";


/****************************************************************************/
/*******************  required privileges for module / views    *************/
/****************************************************************************/
$module_policy = new Priv\RequiredPrivileges();
$module_policy->define(
    new Priv\Default\PrivAccess(manage : true)
);

/****************************************************************************/
/*******************  Register Module  **************************************/
/****************************************************************************/

Modules::register_module_once(new Module(
    name          : "example",
    privileges    : $module_policy,
    views         : ["greet"],
    default_view  : "greet"
)); 

/****************************************************************************/
/*******************  View - forms  *****************************************/
/****************************************************************************/

Modules::module("greet")->register_view(
    view : new ModuleView(
        name        : "forms",
        privileges  : null,
        settings    : new SettingsObject([
            "title"         => "Example Module",
            "description"   => "Example Module Description",
        ])
    ),
    render      : function() {

        /** @var Module $this */

        //Include confiramtion modal in page:
        // $this->page->additional_html(Components::confirm());


        //Include some data for js use:
        // $this->page->meta->data_object([
        //     "can_edit" => $this->page::$issuer_privileges->can("content.edit")
        // ]);

        //Template:
        //Render Template:
        return $this->page->engine->render("view-message", [
            "name"       => "Dear User",
        ]);
    }
);
