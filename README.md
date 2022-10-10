<!-- Improved compatibility of back to top link: See: https://github.com/othneildrew/Best-README-Template/pull/73 -->
<a name="readme-top"></a>
<!--
*** Thanks for checking out the Best-README-Template. If you have a suggestion
*** that would make this better, please fork the repo and create a pull request
*** or simply open an issue with the tag "enhancement".
*** Don't forget to give the project a star!
*** Thanks again! Now go create something AMAZING! :D
-->



<!-- PROJECT SHIELDS -->
<!--
*** I'm using markdown "reference style" links for readability.
*** Reference links are enclosed in brackets [ ] instead of parentheses ( ).
*** See the bottom of this document for the declaration of the reference variables
*** for contributors-url, forks-url, etc. This is an optional, concise syntax you may use.
*** https://www.markdownguide.org/basic-syntax/#reference-style-links
-->
[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![MIT License][license-shield]][license-url]


<!-- PROJECT LOGO -->
<br />
<div align="center">
    <!-- optional logo
  <a href="https://github.com/xdaTq/InventorySystem">
    <img src="images/logo.png" alt="Logo" width="80" height="80">
  </a>
  -->

  <h3 align="center">Inventory System</h3>

  <p align="center">
    Inventory system to keep track of inventory and supply!
    <br />
    <a href="https://github.com/xdaTq/InventorySystem"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="https://github.com/xdaTq/InventorySystem/issues">Report Bug</a>
    ·
    <a href="https://github.com/xdaTq/InventorySystem/issues">Request Feature</a>
  </p>
</div>



<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#acknowledgments">Acknowledgments</a></li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->
## About The Project

![Product Name Screen Shot][product-screenshot]

Inventory system created to track your inventory and supply, <br>
To get started go to <a href="#getting-started">Getting started</a>.
For more inforamtion about the usage go to <a href="#usage">Usage</a>,
if your intrested what the project is built with go to <a href="#built-with">Usage</a>

prior knowledge:
* For better understanding of this project you should have a decent experiance using PHP as well as MySQL.
* For better understanding of the hosting type and serving this project you should have decent expierance in nginx or apache or really any other type of web server
* For more information about forking this project go to <a href="#">Fork</a>
* For more information about contributing go to <a href="#contributing">Contributing</a>

What the project is served on? <br>
For the hosting of this project you can use, for example (MAMP, XAMMP) or any other type of web server for more inforamtion about what we used for the hosting and serving this project go to <a href="#built-with">Usage</a>

Use the `README.md` to get started.

<p align="right">(<a href="#readme-top">back to top</a>)</p>


### Built With

This project was built using these technologies. Feels free to add any or change any of these technilogies below to suit your usage like frameworks for front-end as well as back-end.

For more information about <a href="#usage">Usage</a> or <a href="#getting-started">Getting started</a>.

* [![Php][Php.net]][Php-url]
* [![Docker][Docker.com]][Docker-url]
* [![Apache][Apache.org]][Apache-url]
* [![Nginx][Nginx.com]][Nginx-url]
* [![Mysql][Mysql.com]][Mysql-url]
* [![Bootstrap][Bootstrap.com]][Bootstrap-url]
* [![Jenkins][Jenkins.io]][Jenkins-url]

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- GETTING STARTED -->
## Getting Started

* Setting up the project with Docker.

### Prerequisites

For this project `Docker` can be used for simplifying  the installation. Here you can find the Dockerized files from [DockerHub](https://hub.docker.com)

**1**. Docker pull IMAGE
  ```sh
  $ docker pull [OPTIONS] NAME[:TAG|@DIGEST]
  ```
**2**. docker check for IMAGES
  ```sh
  $ docker images
  ```
**3**. docker running the app in a `container`
  ```sh
  $ docker run --name CONTAINER_NAME -p PORT:PORT APP_NAME
  ```
  * If you want to check what containers are running, use the command below
    ```sh
    $ docker ps
    ```

### Installation
* _For this Project MacOS is used so every step from here on out will be directed to the MacOS users. For installation on any other devices then unix refer to the instructions above_.

* #### MacOS
  **1**. Install homebrew from [homebrew](https://brew.sh)
  **2**. Install all necessary programs using brew (Incase you cant run brew as a normal user use `sudo`)
   ```sh
   $ brew install php
   ```
   ```sh
   $ brew install mysql
   ```
   ```sh
   $ brew install telnet
   ```
   ```sh
   $ brew install nginx
   ```
    * Nginx Configuration 


  **3**. On MacOS with a Silicon Proccesor all of your config files will be found in `/opt/homebrew/etc/` else for normal MacOS with Intel Proccesor you will find your config files in `/usr/local/etc/`. 
    <br>
  Inside this directory navigate to a folder called `nginx`, and open the `nginx.conf` file with a editor of your choice.

  **4**. Nginx.conf file In the `nginx.conf` file change the following configuration to the following.
  ```sh
    listen       YOUR_PORT;
    server_name  YOUR_SERVERNAME;
  ```
        
  In the `Location /` block change the default `root` to your location and in the Index add the following as shown below.

  ```sh
    root /Users/erwinkujawski/Desktop/Inv;
    index index.html index.htm index.php;

    location / {
      autoindex on;
      try_files $uri $uri/ /index.php?$args;

      proxy_buffer_size 128k;
      proxy_buffers 4 256k;
      proxy_busy_buffers_size 256k;
    }
  ```
        
  In the default config the `.\$php` will be commented uncomment and change it to the following.<br>
  Note: The default IP for hosting localy is `127.0.0.1`.

  ```sh
    location ~ \.php$ {
      fastcgi_pass   SERVER_IP:PORT;
      fastcgi_index  index.php;
      fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
      include        fastcgi_params;
    }
  ```
* #### MySQL Configuration 
      <br>
  **5**. On MacOS with Silicon Proccesor all of you MySQL config files will be found in `/opt/homebrew/etc/` else for normal MacOS with Intel Proccesor you will find you config files in `/usr/local/etc/`.
      <br>
    Inside this direcotry navigate to a folder called `/etc/` which can be found in the step above.
  **6**. In the `my.conf` file change the following configuration to the following. 
      <br>
    Note: The default IP for hosting localy is `127.0.0.1`

    ```sh

      [mysqld]

      bind-address            = SERVER_IP
      mysqlx-bind-address     = SERVER_IP
      socket                  = /tmp/mysql.sock

      character-set-server    = utf8mb4
      collation-server        = utf8mb4_unicode_ci
      character-set-client-handshake = false
    ```
  **7**. Next step is to login to the database as root. in the terminal type in the following command. after typing in this command the terminal will prompt you with a message to type in your password and sicnce this is a newly created MySQL Database the password will be empty so dont type in anything simply press `Enter` and procced to the next step.

  ```sh
    mysql -u root -p
  ```
  **8**. If for some reason step `7.` didn't work and you got an `Error` that says something like `Access denied for user 'root@localhost' (using password: NO)` try using the same command and simply type in the password as `root` some times MySQL sets the password as `root` for default. Else if you everything worked out you should see something like this. 

  ![database-screenshot][database-screenshot] 

  If you see this prompt with MySQL in you terminal that means your now connected as the database.  
  Note: To display all of the existing databases type in the following `query` as shown below.

  ```sh
    SHOW DATABASES;
  ```
  **9**.
  Creating the database. type in the following `query` as shown below to create a database.
  ```sh
  CREATE DATABASE database_name;
  ```
  After inserting this `query` use the following `query` to see if the database was created.
  ```sh
  SHOW DATABASES;
  ```
  **10**.
  Inserting the database. type in the following `query` in the mysql terminal.
  ```sh
  mysql database_name < db.sql;
  ``` 

* #### PHP Configuration (Optional)  

    <br>
  **12**. On MacOS with Silicon Proccesor all of you PHP config files will be found in `/opt/homebrew/etc/` else for normal MacOS with Intel Proccesor you will find you config files in `/usr/local/etc/`.
    <br>
  Inside this directory navigate to a folder called `php`, and it's optional you dont need to edit anything in that file for the application to work. 
    <br>
  If u want to see all of the users use the command below in the `/opt/homebrew/etc/`.
    <br>
  ```sh
  ls -l /usr/local/etc/php
  ```
#### Linux


<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- USAGE EXAMPLES -->
## Usage

Use this space to show useful examples of how a project can be used. Additional screenshots, code examples and demos work well in this space. You may also link to more resources.

_For more examples, please refer to the [Documentation](https://example.com)_

<p align="right">(<a href="#readme-top">back to top</a>)</p>


<!-- ROADMAP -->
## Roadmap

- [x] Add Changelog
- [x] Add More Features
- [ ] Add Additional Documentation Page
- [ ] Add Proper Admin Page

See the [open issues](https://github.com/xdaTq/InventorySystem/issues) for a full list of proposed features (and known issues).

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- CONTRIBUTING -->
## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement".
Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- LICENSE -->
## License

Distributed under the MIT License. See `LICENSE.txt` for more information.

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- CONTACT -->
## Contact

[Owner](https://github/xdaTq/) - xdaTq

Project Link: [https://github.com/xdaTq/InventorySystem](https://github.com/xdaTq/InventorySystem)

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- ACKNOWLEDGMENTS -->
## Acknowledgments

Here is a list of all the resources we used for this project including best sources for any further help. <br>
For any further development help go to <a href="https://github.com/xdaTq/InventorySystem/issues">Issues</a>

* [Choose an Open Source License](https://choosealicense.com)
* [Docker Documentation](https://docs.docker.com/)
* [Php Documentation](https://www.php.net/docs.php)
* [Nginx Documentation](https://nginx.org/en/docs/)
* [Apache Documentation](https://httpd.apache.org/docs/)
* [MySQL Documentation](https://dev.mysql.com/doc/)
* [Bootstrap Documentation](https://getbootstrap.com/docs/5.2/getting-started/introduction/)

* [StackOverflow](https://stackoverflow.com)


<p align="right">(<a href="#readme-top">back to top</a>)</p>


<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[contributors-shield]: https://img.shields.io/github/contributors/xdaTq/InventorySystem.svg?style=for-the-badge
[contributors-url]: https://github.com/xdaTq/InventorySystem/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/xdaTq/InventorySystem.svg?style=for-the-badge
[forks-url]: https://github.com/xdaTq/InventorySystem/network/members
[stars-shield]: https://img.shields.io/github/stars/xdaTq/InventorySystem.svg?style=for-the-badge
[stars-url]: https://github.com/xdaTq/InventorySystem/stargazers
[issues-shield]: https://img.shields.io/github/issues/xdaTq/InventorySystem.svg?style=for-the-badge
[issues-url]: https://github.com/xdaTq/InventorySystem/issues
[license-shield]: https://img.shields.io/github/license/xdaTq/InventorySystem.svg?style=for-the-badge
[license-url]: https://github.com/othneildrew/Best-README-Template/blob/master/LICENSE.txt

<!-- screen shots -->
[product-screenshot]: img/screenshot.png
[database-screenshot]: img/database.png
<!-- Built with --->
[Apache.org]: https://img.shields.io/badge/apache-000000?style=for-the-badge&logo=apache&logoColor=c92038
[Apache-url]: https://apache.org/
[Nginx.com]: https://img.shields.io/badge/Nginx-20232A?style=for-the-badge&logo=Nginx&logoColor=039138
[Nginx-url]: https://nginx.com/
[Mysql.com]: https://img.shields.io/badge/Mysql-02758f?style=for-the-badge&logo=mysql&logoColor=f29111
[Mysql-url]: https://mysql.com/
[Bootstrap.com]: https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white
[Bootstrap-url]: https://getbootstrap.com
[Php.net]: https://img.shields.io/badge/Php-0769AD?style=for-the-badge&logo=php&logoColor=white
[Php-url]: https://www.php.net
[Docker.com]: https://img.shields.io/badge/Docker-2496ed?style=for-the-badge&logo=docker&logoColor=white
[Docker-url]: https://www.docker.com
[Jenkins.io]: https://img.shields.io/badge/Jenkins-d23833?style=for-the-badge&logo=jenkins&logoColor=black
[Jenkins-url]: https://www.jenkins.io 
