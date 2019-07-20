# Business metrics for starters

A VERY simple PHP, Prometheus &amp; Grafana setup to get started with business metrics

## Pre-Requisites

You will need to install the composer packages, which are used by this example project.

## Docker compose services

Assuming you have installed `docker` and `docker-compose` on your machine, go to the root directory of this project and run
```
docker-compose up -d
``` 
to fire up the following service setup. 

1. `nginx` will provide three URLs:
  1. http://127.0.0.1:8080 - The php script that provides metrics to the prometheus instance
  2. http://127.0.0.1:9090 - The prometheus instance web frontend
  3. http://127.0.0.1:3000 - The grafana instance web frontend
  
2. `php` will provide the PHP-FPM to run your PHP script under `/public/metrics.php`

3. `prometheus` will collect metrics from your PHP script unter http://127.0.0.1:8080/metrics.php

4. `grafana` will visualize metrics with the prometheus instance as its data source

## Used libraries

* [openmetrics-php/exposition-text](https://github.com/openmetrics-php/exposition-text) to produce metrics in the OpenMetrics format that prometheus understands.


## Configurations

### nginx

* You can find the config for the [nginx:latest](https://hub.docker.com/_/nginx) docker image [here](.docker/nginx/default.conf).

### PHP-FPM

* The default configuration from the [php:7.3-fpm-alpine](https://hub.docker.com/_/php) docker image is used. 

### Prometheus

* You can find the config for the [prom/prometheus](https://hub.docker.com/r/prom/prometheus) docker image [here](.docker/prometheus/prometheus.yml).

### Grafana

* The default configuration from the [grafana/grafana:latest](https://hub.docker.com/r/grafana/grafana) docker image is used.
