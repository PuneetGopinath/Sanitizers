# BK Sanitizers Fuctions

<link rel="stylesheet" href="css/main.css" />

## 1. function getVersion

getVersion - Returns the current Sanitizers version

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
1.1.0
v1.1.0
```

### Return values

&emsp;Returns version as a string in the format `major.minor.patch`

## 2. function clean

clean - Sanitize a string without specifing the type parameter of sanitize function

### Description

    public function clean($text, $trim=true, $htmlspecialchars=true, $alpha_num=false, $ucwords=true)

Cleans a user input. It sanitizes the input string through various functions.
The input string is given parameter 1.<br>
And returns the sanitized string

### Parameters

<b>text</b><br>
&emsp;The input data.

<b>trim</b><br>
&emsp;A boolen indicting whether to trim the input data.

<b>htmlspecialchars</b><br>
&emsp;A boolen indicting whether to use htmlspecialchars in input data.

<b>alpha_num</b><br>
&emsp;A boolen indicting whether the input data is alpha_numeric.

### Example

1. Using clean
```
$sanitizer = new Sanitize();
$uid = $sanitizer->clean($_POST["uid"]); // uid full form is user id
```

### Return values
&emsp;Returns the sanitized string

## 3. function sanitize

sanitize - Sanitize a string

### Description

    public function sanitize($type, $text, $trim=true, $htmlspecialchars=true, $alpha_num=false, $ucwords=true)

Cleans a user input. It sanitizes the input string through filter_var and somtimes uses above clean function according to type parameter.
The input string is given parameter 2.<br>
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

<b>htmlspecialchars</b><br>
&emsp;Same as mentioned above in clean function

<b>alpha_num</b><br>
&emsp;Same as mentioned above in clean function

### Return values
&emsp;Returns the sanitized string

## 3. function sanitizeArray

sanitizeArray - Sanitize an array

### Description

    public function sanitizeArray($array, $filters=array("types"=>array()))

Cleans a whole array one by one. It sanitizes the input string through above sanitize function according to the types given in `$filters["types"][$array_key]`.<br>
And returns the sanitized array

You can sanitize whole `$_POST`, `$_GET`, `$_REQUEST`, etc...

### Parameters

<b>array</b><br>
&emsp;The input array.

Example:
```
$array = array(
    "array_key" => "saNiTiZeRs"
);
```

<b>filters</b><br>
&emsp;The filters to apply to the array.

It should be in the format like in the below example:

Example:
```
$filters = array(
    "types" => array( //Types also Optional, if string detected then we will treat it as message
        "array_key" => "string" //The type of array_key
    ),
    "array_key" => array( //Optional What filters to apply to array_key
        "trim" => true,
        "htmlentities" => true,
        "alpha_num" => false
    )
);
```
See SanitizersTest.php for understanding more.

### Return values
&emsp;Returns the sanitized array

## 4. function HTML

HTML - Sanitize html code

### Description

    public function HTML($text, $tags="<b><i><em><p><a><br>")

Cleans html code given by users.<br>
And returns the sanitized html code

### Parameters

<b>text</b><br>
&emsp;The input code.

<b>tags</b><br>
&emsp;Optional, the allowed html tags to keep in the code.

It should be in the format like in the below example:

```
<b><a>
```
Which will keep both `<b>` and `</b>`, `<a>` and `</a>` in this example.

### Return values
&emsp;Returns the sanitized html code

## 5. function configFromIni

configFromIni - Use config settings from ini
### Description

    public function configFromIni($file="config.ini")

Uses php `parse_ini_file` function to get config settings.

### Parameters

<b>file</b><br>
&emsp;The configuration file (default: `config.ini`).

### Return values
&emsp;Returns null
