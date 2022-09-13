# vulnerablePHPsite
This is a vulnerable PHP web site used to test a RCE (Remote Code Execution) attack.

## What is RCE?
Remote Code Execution is a mechanism for exploiting a network flaw to execute arbitrary code on a target device.
In practice, these attacks occur when an adversary manages to illegally access and control a device or server. Most of the time, malware is used to take control of the system.

## Objective
The objective of this repo is to simulate the exploitation of a vulnerability present in an image hosting site by loading a php script that will allow the execution of system commands on the server; making the system believe that the uploaded file is actually a harmless image.
The server will check the uploaded file verifying that the HTTP Content-Type header is that of an image (image / png). The exploited vulnerability consists in the fact that the header is set by the client, and therefore can be modified by an attacker in order to make the server accept files other than images.

I used Burp Suite to intercept the upload of the file in order to alter this header, allowing to load a PHP script containing arbitrary code.