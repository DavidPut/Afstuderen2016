<?php

session_start();

//If there is already a session, go to index and do stuff test testtest
session_unset();
session_destroy();


header("Location: login");
exit();

?>