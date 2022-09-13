# vulnerablePHPsite
This is a vulnerable PHP web site used to test a RCE (Remote Code Execution) attack.

## What is RCE?
Remote Code Execution is a mechanism for exploiting a network flaw to execute arbitrary code on a target device.
In practice, these attacks occur when an adversary manages to illegally access and control a device or server. Most of the time, malware is used to take control of the system.

## Objective
The objective of this repo is to simulate the exploitation of a vulnerability present in an image hosting site by loading a php script that will allow the execution of system commands on the server; making the system believe that the uploaded file is actually a harmless image.
The server will check the uploaded file verifying that the HTTP Content-Type header is that of an image (image / png). The exploited vulnerability consists in the fact that the header is set by the client, and therefore can be modified by an attacker in order to make the server accept files other than images.

I used Burp Suite to intercept the upload of the file in order to alter this header, allowing to load a PHP script containing arbitrary code.

## Execution
- publish the PHP site on a linux VM;
- access via **Burp Suite browser** to the host address;
- log in with your credentials and upload the attacking file;
- intercept the sending of the request on Burp Suite and change the string `Content-Type: application/octet-stream` to `Content-Type: image/png`;
- repeat the operation with other php files or access the open shell with the `attack.php` file.

## Conclusions
Although the consequences of the attack can be harmful to an application, the ways to avoid it are simple:
- do not save the images directly in a folder on the server, but in the database;
- do not grant the user the ability to access and write to folders;
- if possible don't let the client set the HTTP Content-Type header;
- validate the files entered by users before entering the database and, if possible, check for special characters, function names or linux commands.

RCE attacks were dramatically increased from 7% in 2019 to 27% in Q2 2020. This demonstrates how important it is to develop more protections and limit the vulnerabilities that allow for these types of security holes.




Thanks for your attention!&#128513;