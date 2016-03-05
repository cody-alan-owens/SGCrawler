# SGCrawler

1. Use `composer require codyowens/sgcrawler` in your web directory to install the SGCrawler from Packagist
2. Move the DefaultCrawl.php file into your root web directory - or at least, to a directory above vendors.
3. Configure the Config.php file to point to the correct server and database with the correct username and password.
4. Add a folder called img to the same directory where your DefaultCrawler.php file is located. Or, change the image save directory specified in DefaultCrawl.php.
5. Import the slickguns.sql schema provided here into your database to ensure a schema match.
6. Run DefaultCrawl.php from your browser. This may take quite some time; please be patient. You can verify results are being added to the database over time by checking your tables.