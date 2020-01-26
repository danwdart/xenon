<!--

PHP Registered Script.
This needs extra security.
TODO:
Add md5 BEFORE sending.
Check for and remove quotes.

-->

<html>
<head>
<title>Xenon - Registered</title>
<style type="text/css">
body {
color: black;
background-color: white;
}
#indent {
position: absolute;
right: 100px;
}
</style>
</head>
<body>
<?php
if ($_POST['submit'] == "Register") {
$dbcnx = @mysql_connect("sql", "xenonproject_xenon", "");
if (!$dbcnx) {
      echo( "Can't connect! Please try again later." );
      exit();
    }
if (! @mysql_select_db("xenonproject_xenon") ) {
      echo( "Can't locate the database! Please try again later." );
      exit();
    }
$sql = "INSERT INTO users (".
"username,".
"fname,".
"lname,".
"email,".
"password,".
"IP,".
"joindate".
" ) VALUES ( \"".
 $_POST['username'] ."\", \"".
 $_POST['fname'] ."\", \"".
 $_POST['lname'] ."\", \"".
 $_POST['email'] ."\", \"".
 md5($_POST['password']) ."\", \"".
 $_SERVER['REMOTE_ADDR'] ."\", \"".
date("Y-m-d") ."\");";
$result=mysql_query($sql);
if (!$result) {
    echo("Error performing query: " .
           mysql_error() );
      exit();
}
else {echo ("You have successfully registered.");}

}
else {

echo ("You cannot run this script like this.");
}

?>

</body>
</html>
