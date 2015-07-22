# Icarus - Health & Status 
*Version 1.0.0*

This plugin provides a lightweigh basic url that be used by various monitoring systems to determine
whether or not your wordpress instance is alive.

It will perform basic checks such as loading the wordpress core, and some db connections. If any of these fail, the page will return
a status 500 which can be evaluated by monitoring system such as newrelic downtime alerts or zabbix.

## Todo
* Add support for redirects
* Add support load balanced envs (Node registration)
* Add support to monitor idenpendant nodes