# BK Sanitizers Fuctions

<link rel="stylesheet" href="css/main.css" />

## 1. function set

set - Modifies a config setting

### Description

    public function set($case, $value="default")

Modifies a config setting temporarily and returns true if it is modified or else false if it is not modified

### Parameters

<b>case</b><br>
&emsp;The key of the setting. It can be any one of these.

<table class="card">
    <thead>
        <tr>
            <th>value of case</th>
            <th>description</th>
            <th>value</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>maxInputLength</th>
            <td>Maximum length of string (user input). If length of user input is more than maxInputLength then extra characters will be removed</td>
            <td>A integer specifing the Maximum length of user input</td>
        </tr>
        <tr>
            <th>encoding</th>
            <td>Encodes user input to that character set</td>
            <td>See https://www.php.net/manual/en/function.htmlspecialchars</td>
        </tr>
        <tr>
            <th>preventXSS</th>
            <td>Do you want to prevent XSS?</td>
            <td>A bool</td>
        </tr>
        <tr>
            <th>slashes</th>
            <td>Do you want to escape user input?</td>
            <td>A bool</td>
        </tr>
    </tbody>
</table>

<b>value</b><br>
&emsp;The value of the setting. It is based on the case parameter. See the value column in case parameter

### Example

1. Using set
```
$sanitizer = new Sanitize();
if ($sanitizer->set("preventXSS", true)) {
    $name = $sanitizer->sanitize("name", $_POST["name"]);
}
```

### Return values

&emsp;Returns true if config setting is modified or else false if it is not modified

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
$uid = $sanitizer->clean($_POST["uid"]);
```

### Return values
&emsp;Returns the sanitized string

## 3. function sanitize

sanitize - Sanitize a string

### Description

    public function sanitize($type, $text, $trim=true, $htmlspecialchars=true, $alpha_num=false, $ucwords=true)

Cleans a user input. It sanitizes the input string through `filter_var` and somtimes uses above `clean` function based on the type parameter.
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
    "array_key" => array( //Optional What filters you want to apply to array_key
        "trim" => true,
        "htmlentities" => true,
        "alpha_num" => false,
        "ucwords" => true
    )
);
```
See parameters in sanitize function for understanding about filters and see the table in type parameter in sanitize function for understanding about types.

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
