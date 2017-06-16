[![Latest Stable Version](https://poser.pugx.org/pmvc-app/error/v/stable)](https://packagist.org/packages/pmvc-app/error) 
[![Latest Unstable Version](https://poser.pugx.org/pmvc-app/error/v/unstable)](https://packagist.org/packages/pmvc-app/error) 
[![Build Status](https://travis-ci.org/pmvc-app/error.svg?branch=master)](https://travis-ci.org/pmvc-app/error)
[![License](https://poser.pugx.org/pmvc-app/error/license)](https://packagist.org/packages/pmvc-app/error)
[![Total Downloads](https://poser.pugx.org/pmvc-app/error/downloads)](https://packagist.org/packages/pmvc-app/error) 

PMVC Error Handle Share App 
===

## Error Sample Link
```
/error?errors[0]=1001&errors[1]=1002&lastError=1002
```

## Install with Composer
### 1. Download composer
   * mkdir test_folder
   * curl -sS https://getcomposer.org/installer | php

### 2. Install Use composer.json or use command-line directly
#### 2.1 Install Use composer.json
   * vim composer.json
```
{
    "require": {
        "pmvc-app/error": "dev-master"
    }
}
```
   * php composer.phar install

#### 2.2 Or use composer command-line
   * php composer.phar require pmvc-app/error


