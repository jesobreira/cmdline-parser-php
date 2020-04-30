# CmdLine Parser

Library for easy parsing of command line arguments.

Install by running:

```
composer require jesobreira/cmdline
```

It can get:

## Simple key/value

Example. The following code:

```
use CmdLine\Parser as cmdline;

echo cmdline::get('color');
```

Will return "white" if you run the script in one of these ways (quotes are optional but mandatory if you're going to use spaces):

* php script.php -color "white"
* php script.php --color white
* php script.php /color white

## Existence

Example. The following code:

```
if (cmdline::keyexists('givemecoffee')) {
	echo "You want coffee.";
} else {
	echo "You do not want coffee.";
}
```

Will return "You want coffee." if you run one of these:

* php script.php -givemecoffee
* php script.php --givemecoffee
* php script.php /givemecoffee

## Flags

Example. This script:

```
echo "You want: ";

if (cmdline::flagenabled('C')) echo "coffee ";

if (cmdline::flagenabled('B')) echo "beer ";

echo " and you do not want: ";

if (cmdline::flagdisabled('V')) echo "vodka ";

if (cmdline::flagdisabled('W')) echo "wine ";

echo " but you did not tell me if you want: ";

if (!cmdline::flagexists('S')) echo "soda ";

if (!cmdline::flagexists('J')) echo "juice ";
```

Will return "Will return "You want: coffee beer  and you do not want: vodka wine  but you did not tell me if you want: soda juice" if you run:

* php script.php +CB -VW

## Getting arguments by its index

You can also read the `process.argv` (0-based index) through this function. The advantage is that if the index does not exist (the user did not specify the argument), it won't throw an error. It will just return the value you specify in the second function parameter.

```
// 0 = php executable; 1 = php script; 2... = args
$first_argument = cmdline::getvalbyindex(2, false);
if (!$first_argument) {
	echo "You did not specify any argument.";
} else {
	echo "First argument is: " . $first_argument;
}

```

*Just a note:* The second value of `getvalbyindex` method can be an integer value, a string, a boolean value, an array or anything you want it to return if the index does not exist in `process.argv` object.

This parameter is also available in `get` method, also as a second function parameter. In this case, it will return this value if the key was not found. Example:

```
$user_wants = cmdline::get('iwant', 'nothing');
echo "You want" . $user_wants;

```

So, if you run:

* php script.php /iwant water

It will return "You want water". But if you run just:

* php script.php

It will return "You want nothing". Please note that, as these two are the only methods in this module meant to return strings, the second parameter is not available for the other functions. By default, if you do not specify any fallback value, it returns null if the wanted value could not be found.

Also, please note that this module can NOT parse arguments in the format key=value. Example:

* php script.php key=value **IT WILL NOT WORK**

# Other Ports

This lib is a port from the [AutoIt3 UDF](https://www.autoitscript.com/forum/topic/169610-cmdline-udf-get-valueexistenceflag/), which is also available as a [NodeJS module](https://www.npmjs.com/package/node-cmdline-parser).