<?php
require_once("config.php");
session_start();
session_destroy();
header("Location: teste_session.php");