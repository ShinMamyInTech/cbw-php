<?php
include 'config/config.php';
session_destroy();
header(header:"Location: index.php");