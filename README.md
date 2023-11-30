## Simple libraries
## Session
### Write
```php
\krzysztofzylka\SimpleLibraries\Library\Session::set(string $name, mixed $value)
```
### Get
```php
\krzysztofzylka\SimpleLibraries\Library\Session::get(string $name)
```
### Delete
```php
\krzysztofzylka\SimpleLibraries\Library\Session::delete(string $name)
```
### Exists
```php
\krzysztofzylka\SimpleLibraries\Library\Session::exists(string $name)
```
### Clean
```php
\krzysztofzylka\SimpleLibraries\Library\Session::clean(string $name)
```

## Strings
### Repair url
```php
\krzysztofzylka\SimpleLibraries\Library\Strings::repairUrl(string $url)
```
### Escape
```php
\krzysztofzylka\SimpleLibraries\Library\Strings::escape(string $string)
```
### Undo escape
```php
\krzysztofzylka\SimpleLibraries\Library\Strings::undoEscape(string $string)
```
### Clean string and use lowercase
```php
\krzysztofzylka\SimpleLibraries\Library\Strings::lowerCleanString(string $string)
```
### Remove all special chars from string
```php
\krzysztofzylka\SimpleLibraries\Library\Strings::clean(string $string)
```
### Get first x words
```php
\krzysztofzylka\SimpleLibraries\Library\Strings::substrWithoutLastWord(string $string, int $length)
```
### Remove line breaks in string
```php
\krzysztofzylka\SimpleLibraries\Library\Strings::removeLineBreaks(string $string)
```
### Camelize string with separator
```php
\krzysztofzylka\SimpleLibraries\Library\Strings::camelizeString(string $string, string $separator = '')
```
### Decamelize string with separator
```php
\krzysztofzylka\SimpleLibraries\Library\Strings::decamelizeString(string $string, string $separator = '')
```

## _Array
### Escape table
```php
\krzysztofzylka\SimpleLibraries\Library\_Array::escape($array)
```
### Remove html special chars
```php
\krzysztofzylka\SimpleLibraries\Library\_Array::htmlSpecialChars($array)
```
### Trim data
```php
\krzysztofzylka\SimpleLibraries\Library\_Array::trim($array)
```
### Get array from string
```php
\krzysztofzylka\SimpleLibraries\Library\_Array::getFromArrayUsingString(string $name, array $array)
```
Example:
```php
$array = ['a' => ['b' => 'ok']]
echo \krzysztofzylka\SimpleLibraries\Library\_Array::getFromArrayUsingString('a.b', $array)
// return: ok
```
### Merge recursive distinct
```php
\krzysztofzylka\SimpleLibraries\Library\_Array::mergeRecursiveDistinct(array $array1, array $array2)
```
### In array keys
```php
\krzysztofzylka\SimpleLibraries\Library\_Array::inArrayKeys(string $name, array $array)
```
### Reduction
```php
\krzysztofzylka\SimpleLibraries\Library\_Array::reduction(array $array, int $nthElement = 2, bool $lastKey = true)
```