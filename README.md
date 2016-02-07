metrica
=======

Yandex.Metrica goals management tool. Allows to create counter goals based on template.

###Clone source code to local storage

`>git clone https://github.com/skieff/ymtt.git`

###Install project dependencies using composer

`>php composer.phar install`

 If you do not have composer installed refer to composer [documentation](https://getcomposer.org/).

###Change settings
 
 In `app/config/parameters.yml` change goal template `app.defaultBuilderOptions` and 
 Yandex.Metrica API token `app.api_token`.
 
###Update project cache

`>php app/console cache:clear --env=prod --no-debug`

###Setup preferred web server

Server setup examples can be found at [Symfony project page](http://symfony.com/doc/2.8/cookbook/configuration/web_server_configuration.html)