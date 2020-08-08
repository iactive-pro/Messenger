To install this package
```
composer require iactive/messenger dev-master
```

Example use 
```
$mess = new ApiMessengerSender('urcode');
if ($mess->sendMessage('799999999', 'Your Message')) {
    echo 'sended';
} else {
    echo 'not sended. Error: ' . $mess->getException()->getMessage();
}
```

or 

```
$mess = new ApiMessengerSender('urcode');
$mess->sendMessage('799999999', 'Your Message');
if ($mess->isOk()) {
    echo 'sended';
} else {
    echo 'not sended. Error: ' . $mess->getException()->getMessage();
}
```