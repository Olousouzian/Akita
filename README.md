<p align="center">
  <img src="http://i.imgur.com/cIONxmZ.png" alt="Akita"/>
</p>

## Content

Provide a Symfony 2.X bundle for easy crawling Facebook page.

## Get your accessToken

First, you new to create an Web Application on Facebook dev plateform.

Then go to <a href="https://developers.facebook.com/tools/access_token/">https://developers.facebook.com/tools/access_token/</a>
and save your token. We need this on the next step.

## How to install ?

Install it with Composer 

```sh
composer require olousouzian/akitabundle
```


Finally, register the bundle into app/AppKernel : 

```sh
new Olousouzian\AkitaBundle\OlousouzianAkitaBundle(),
```

## Parameters

Edit /app/config/parameters.yml.dist and add the following variable :

```sh
akita_access_token
```

Save the change and launch 

```sh
$ composer update
```

Enter your Facebook token.


## How to use

This bundle works only by CLI (Command Line Interface).
Two commands are avalaibles : 

-  app/console akita:check --> Only check if your installation seems to be ok
-  app/console akita:crawl [facebookPageId] [Limit] [Timestamp] --> Launch the crawler

## License

This solution is under MIT license.
