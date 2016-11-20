<?php
class dbhandle
{
	public 	function __contruct($db,$collection)
	{
		$dbh=new MongoClient();
		$dbh=$dbh->selectDB($db)->selectCollection($collection);		return $dbh;

	}
	public function getId($col)
	{
		$max = $col->find(array(), array('_id' => 1))->sort(array('_id' => -1))->limit(1);
		return ($max+1);
	}
}
?>
