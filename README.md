# DOCKER-COMPOSE-SLIM3-PHP-MYSQL
In this chapter, we will look at the functionality provided by 'Docker Compose'
for defining and running multi-container Docker applications.

We are going to use 'MySQL' like our specialized database and 'PHP Slim3 Framework'
like our PHP micro framework.
  

#What is Docker Compose?
Compose is a tool for defining and running multi-container Docker applications.
For more information please see: [Docker Compose official website][1].


#ScreenShots

<p align="center">
    <img src="Screenshots/dockerphp.png" alt="docker_compose" width="50%"/>
</p>

<p align="center">
    <img src="Screenshots/slim3.png" alt="docker_compose" width="50%"/>
</p>


#How to use
```bash
git clone https://github.com/CarlitosDroid/docker-compose-php-slim3-mysql.git
cd docker-compose-php-slim3-mysql/
docker-compose up 
```

If you want to know the Host Address for using in settings.php file, 
run the 'ifconfig' command in your linux computer, check out the output and search 
for IP Address.
    * In my case: 172.17.0.1
 
With this information in hand just replace the "host" propery in the settings.php file.

#Testing
[http://localhost/www.carlitosdroid.com/v1/index.php/user][3]

For stopping docker compose just run:
```bash
docker-compose down 
```

#About me
A student in Lima Perú. If you have any new idea about this project please feel free to contact me, here 
my [Google+ Account][2].

[1]: https://docs.docker.com/compose/overview/
[2]: https://plus.google.com/u/0/111050689283593613144
[3]: http://localhost/www.carlitosdroid.com/v1/index.php/user




