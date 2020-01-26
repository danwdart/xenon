<?php

$dbcnx = @mysql_connect("sql", "xenonproject_xenon", "");
if (!$dbcnx) {
      echo( "Can't connect! Please try again later." );
      exit();
    }
if (! @mysql_select_db("xenonproject_xenon") ) {
      echo( "Can't locate the database! Please try again later." );
      exit();
    }

?>
