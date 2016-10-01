<?php

Config::set('site_name','LDform.com');

Config::set('languages', array('ru','en'));


Config::set('routes',array(
    'default' =>'',
    'admin'=>'admin_',
    'ajax'=>'ajax_',
));

Config::set('default_route', 'default');
Config::set('default_language', 'ru');
Config::set('default_controller', 'users');
Config::set('default_action', 'index');

Config::set('db.host','localhost');
Config::set('db.user','root');
Config::set('db.password','');
Config::set('db.db_name','ldform');

Config:: set('salt', 'helloworld');