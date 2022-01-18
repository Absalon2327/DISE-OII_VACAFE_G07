<?php
include('Fuction_Backup.php');

echo backup_tables('localhost','root','','db_finca');

header("Content-disposition: attachment; filename=db_finca.sql");
header("Content-type: MIME");
readfile("backups/db_finca.sql");