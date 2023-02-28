<?php 

use \Siktec\Bsik\Api\EndPoint\ApiEndPoint;
use \Siktec\Bsik\Api\AdminApi;
use \Siktec\Bsik\Api\Input\Validate;
use \Siktec\Bsik\Privileges as Priv;
use \Siktec\Bsik\Builder\Components;

/****************************************************************************/
/**********************  Greeting Message  **********************************/
/****************************************************************************/
$say_hi_policy = new Priv\RequiredPrivileges();
$say_hi_policy->define(
    new Priv\Default\PrivContent(view: true)
);

AdminApi::register_endpoint(new ApiEndPoint(
    module          : "example",
    name            : "hello",
    working_dir     : dirname(__FILE__).DS."..",
    allow_global    : true,
    allow_external  : true,
    allow_override  : false,
    policy          : $say_hi_policy,
    params      : [
        "name"      => null
    ],
    filter      : [
        "name"      => Validate::filter("trim")::filter("strchars","A-Z","a-z","0-9","_","-")::create_filter()
    ],
    validation  : [
        "name"      => Validate::condition("required")::condition("min_length", "2")::create_rule()
    ],
    method : function(AdminApi $Api, array $args, ApiEndPoint $Endpoint) {
        
        $Api->request->answer_data([
            "greeting" => Components::greetings($args["name"])
        ]);

        return true;
    }
));