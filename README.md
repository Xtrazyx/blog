# blog
OpenClassrooms Study Project

This a basic Blog without authentication.

Features :

- Blog post creation and edition
- Adding Comments to a post
- Contact form emailed to your configured address

also with :

- Twig templating
- Symfony forms including validation
- Doctrine ORM and entity management
- SwiftMailer
- Bootstrap Css

# Installation

1. Clone the repository
2. Install dependencies with composer by running the following command in the project root 
directory.

`composer.phar install`

3. Configure the app/Config/app_config.yml (instructions in the file comments).
4. Create de DB schema with the doctrine CLI.

`php [YOUR PROJECT ROOT PATH]/vendor/doctrine/orm/bin/doctrine orm:schema-tool:create`

5. Configure URL rewriting (virtual host) on your server accordingly. You have to redirect all URLS
to /web_app.php except for the asset files.

<code>

    <VirtualHost *:80>
        ServerName blog
        DocumentRoot [YOUR PROJECT ROOT PATH]
        RewriteEngine On
        RewriteCond %{DOCUMENT_ROOT}/%{REQUEST_FILENAME} !-f
        RewriteRule ^(.*)$ /web_app.php [QSA,L]
        <Directory  "[YOUR PROJECT ROOT PATH]/">
            Options Indexes FollowSymLinks MultiViews
            AllowOverride All
        </Directory>
     </VirtualHost>
     
</code>