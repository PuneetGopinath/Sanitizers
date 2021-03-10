# Sanitizers Fuctions

<link rel="stylesheet" href="css/main.css" />

## 1. function getVersion

getVersion - Returns the Sanitizers version

### Description

    public function getVersion()

Returns the version of Sanitizers you are using

### Parameters

&emsp;It has no parameters

### Example

1. Using getVersion
```
$sanitizer = new Sanitize();
echo $sanitizer->getVersion() . PHP_EOL;
echo "v" . $sanitizer->getVersion();
```
Will output:

```
1.0.1
v1.0.1
```

### Return values

&emsp;Returns version as a string in the format `major.minor.patch`

## 2. function clean

clean - Sanitize a string without specifing the type parameter

### Description

    public function clean($text, $trim=true, $html_entities=true, $alpha_num=false, $ucwords=true)

Cleans a user input. It sanitizes the input string through various functions.
The input string is in parameter 1.<br>
And returns the sanitized string

### Parameters

<b>text</b><br>
&emsp;The input data.

<b>trim</b><br>
&emsp;A boolen indicting whether to trim the input data.

<b>html_entities</b><br>
&emsp;A boolen indicting whether to use htmlspecialchars in input data.

<b>alpha_num</b><br>
&emsp;A boolen indicting whether the input data is alpha_numeric.

### Example

1. Using clean
```
$sanitizer = new Sanitize();
$uid = $sanitizer->clean($_POST["uid"]); // uid is user id
```

### Return values
&emsp;Returns the sanitized string

## 3. function sanitize

sanitize - Sanitize a string

### Description

    public function sanitize($type, $text, $trim=true, $html_entities=true, $alpha_num=false, $ucwords=true)

Cleans a user input. It sanitizes the input string through filter_var and somtimes uses above clean function according to type parameter.
The input string is in parameter 2.<br>
And returns the sanitized string

### Parameters

<b>type</b><br>
&emsp;The input type. It can be any one of these.

<table class="card">
    <thead>
        <tr>
            <th>value of type</th>
            <th>description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>int/integer</th>
            <td>For integer</td>
        </tr>
        <tr>
            <th>float</th>
            <td>For decimal number</td>
        </tr>
        <tr>
            <th>string/text</th>
            <td>For string</td>
        </tr>
        <tr>
            <th>hex</th>
            <td>For hexadecimal</td>
        </tr>
        <tr>
            <th>url</th>
            <td>For URLs</td>
        </tr>
        <tr>
            <th>password</th>
            <td>For user's password</td>
        </tr>
        <tr>
            <th>name</th>
            <td>For user's full name</td>
        </tr>
        <tr>
            <th>message</th>
            <td>For message</td>
        </tr>
        <tr>
            <th>email</th>
            <td>For user's email</td>
        </tr>
        <tr>
            <th>username</th>
            <td>For user's username</td>
        </tr>
    </tbody>
</table>

<b>text</b><br>
&emsp;The input data.

<b>trim</b><br>
&emsp;Same as mentioned above in clean function

<b>html_entities</b><br>
&emsp;Same as mentioned above in clean function

<b>alpha_num</b><br>
&emsp;Same as mentioned above in clean function

### Return values
&emsp;Returns the sanitized string

