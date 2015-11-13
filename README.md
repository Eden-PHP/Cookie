![logo](http://eden.openovate.com/assets/images/cloud-social.png) Eden Cookie
====
[![Build Status](https://api.travis-ci.org/Eden-PHP/Cookie.png)](https://travis-ci.org/Eden-PHP/Cookie)
====

- [Install](#install)
- [Introduction](#intro)
- [API](#api)
    - [clear](#clear)
    - [get](#get)
    - [remove](#remove)
    - [set](#set)
    - [setData](#setData)
    - [setSecure](#setSecure)
    - [setSecureData](#setSecureData)
- [Contributing](#contributing)

====

<a name="install"></a>
## Install

`composer install eden/cookie`

====

<a name="intro"></a>
## Introduction

Instantiate cookies in this manner.

```
$cookie = eden('cookie');
```

The cookie is returned is an array object and can be used like a normal array.

```
$cookie['me']    = array('name' => 'John', 'age' => 31);
$cookie['you']    = array('name' => 'Jane', 'age' => 28);
$cookie['him']    = array('name' => 'Jack', 'age' => 35);

foreach($cookie as $key => $value) {
	echo $value['name'];
}
```

====

<a name="api"></a>
## API

==== 

<a name="clear"></a>

### clear

Removes all cookies. 

#### Usage

```
eden('cookie')->clear();
```

#### Parameters

Returns `Eden\Cookie\Index`

==== 

<a name="get"></a>

### get

Returns data 

#### Usage

```
eden('cookie')->get(*string|null $key);
```

#### Parameters

 - `*string|null $key` - The key to retreive

Returns `mixed`

#### Example

```
eden('cookie')->get('foo');
```

==== 

<a name="remove"></a>

### remove

Removes a cookie. 

#### Usage

```
eden('cookie')->remove(*string $name);
```

#### Parameters

 - `*string $name` - The cookie name

Returns `Eden\Cookie\Index`

#### Example

```
eden('cookie')->remove('foo');
```

==== 

<a name="set"></a>

### set

Sets a cookie. 

#### Usage

```
eden('cookie')->set(*string $key, scalar $data, int $expires, string $path, string|null $domain, bool $secure, bool $httponly);
```

#### Parameters

 - `*string $key` - Cookie name
 - `scalar $data` - The data
 - `int $expires` - Expiration
 - `string $path` - Path to make the cookie available
 - `string|null $domain` - The domain
 - `bool $secure` - Use secure cookie
 - `bool $httponly` - Make it only available on http://

Returns `Eden\Cookie\Index`

#### Example

```
eden('cookie')->set('foo');
```

==== 

<a name="setData"></a>

### setData

Sets a set of cookies. 

#### Usage

```
eden('cookie')->setData(*array $data, int $expires, string $path, string|null $domain, bool $secure, bool $httponly);
```

#### Parameters

 - `*array $data` - The list of cookie data
 - `int $expires` - Expiration
 - `string $path` - Path to make the cookie available
 - `string|null $domain` - The domain
 - `bool $secure` - Use secure cookie
 - `bool $httponly` - Make it only available on http://

Returns `Eden\Cookie\Index`

#### Example

```
eden('cookie')->setData(array('foo' => 'bar'));
```

==== 

<a name="setSecure"></a>

### setSecure

Sets a secure cookie. 

#### Usage

```
eden('cookie')->setSecure(*string $key, scalar $data, int $expires, string $path, string|null $domain);
```

#### Parameters

 - `*string $key` - Cookie name
 - `scalar $data` - The data
 - `int $expires` - Expiration
 - `string $path` - Path to make the cookie available
 - `string|null $domain` - The domain

Returns `Eden\Cookie\Index`

#### Example

```
eden('cookie')->setSecure('foo');
```

==== 

<a name="setSecureData"></a>

### setSecureData

Sets a set of secure cookies. 

#### Usage

```
eden('cookie')->setSecureData(*array $data, int $expires, string $path, string|null $domain);
```

#### Parameters

 - `*array $data` - The list of cookie data
 - `int $expires` - Expiration
 - `string $path` - Path to make the cookie available
 - `string|null $domain` - The domain

Returns `Eden\Cookie\Index`

#### Example

```
eden('cookie')->setSecureData(array('foo' => 'bar'));
```

==== 

<a name="contributing"></a>
#Contributing to Eden

Contributions to *Eden* are following the Github work flow. Please read up before contributing.

##Setting up your machine with the Eden repository and your fork

1. Fork the repository
2. Fire up your local terminal create a new branch from the `v4` branch of your 
fork with a branch name describing what your changes are. 
 Possible branch name types:
    - bugfix
    - feature
    - improvement
3. Make your changes. Always make sure to sign-off (-s) on all commits made (git commit -s -m "Commit message")

##Making pull requests

1. Please ensure to run `phpunit` before making a pull request.
2. Push your code to your remote forked version.
3. Go back to your forked version on GitHub and submit a pull request.
4. An Eden developer will review your code and merge it in when it has been classified as suitable.