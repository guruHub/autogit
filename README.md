#AutoGit Standalone

## Installation

* First of all add this repo as a submodule in yours.
    `$ cd /path/to/repo`
    `$ git submodule add git@github.com:guruHub/autogit.git /autogit`
 
* Now on the server, initialize and update submodules so autogit code goes inside 
    `$ cd /path/to/repo`
    `$ git submodule init`
    `$ git submodule update`

* Make shure the user who runs the php (www-data in most of cases) can pull from your repo, and you can send mails from your server

* Edit your config file.
    `$ cp config.php.sample config.php`

* That's it!
