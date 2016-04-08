<?php include("config.php"); ?>
<?php include("core/fbApp.php"); ?>
<?php include("core/appManager.php"); ?>
<?php include("core/actionManager.php"); ?>

<?php
include_once('/usr/lib/php5/adodb/v515/adodb.inc.php'); 
include_once('/usr/lib/php5/adodb/v515/adodb-active-record.inc.php');

$ADODB_ASSOC_CASE = 2;
$db = NewADOConnection('mysql://root:1234@localhost/authorTracker');
ADOdb_Active_Record::SetDatabaseAdapter($db);

class User extends ADOdb_Active_Record{}
class Record extends ADOdb_Active_Record{}



class actionResponse{

public $status 	= 0;
public $data 	= null;

public function  __construct($status,$data){
	$this->status 	= $status;
	$this->data 	= $data;
}

}
?>

