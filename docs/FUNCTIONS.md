# Sanitizers Fuctions

<link rel="stylesheet" href="css/main.css" />

## 1. function sanitize

sanitize - Sanitize a string

### Description

`public function sanitize($type, $text, $trim=true, $html_entities=true, $alpha_num=false, $ucwords=true)`

Cleans a user input. It sanitizes the input string through various functions given in param 2.
And return the sanitized string

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
&emsp;A boolen indicting whether to trim the input data.

<b>html_entities</b><br>
&emsp;A boolen indicting whether to use html_entities in input data.

<b>alpha_num</b><br>
&emsp;A boolen indicting whether the input data is alpha_numeric.

### Return values
&emsp;Returns the sanitized string

