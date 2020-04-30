Build
-----

- Build image

`docker build --tag=ami-monitor:latest .`

- Install dependencies

`docker run --rm -it -v appvolume:/app --user=uid:gid ami-monitor:latest composer install`

Install
-------

- Create container

`docker run -d -v appvolume:/app --name=ami-monitor --network=bridge --add-host=callcenter-web.callback.local:192.168.11.101 ami-monitor:latest php ./connect.php`

- Manage container

```
docker ps
docker stop ami-monitor
docker start ami-monitor
docker logs ami-monitor
```