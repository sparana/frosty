<?php
class DBHandler
{
	private $dbh;
	public 	function __contruct($db,$collection)
	{
		$d=new MongoClient();
		$this->dbh=$d->selectDB($db)->selectCollection($collection);	

	}
	public function getDB()
	{
		return $this->dbh;
	}
	public function getId($col)
	{
		$max = $col->find(array(), array('_id' => 1))->sort(array('_id' => -1))->limit(1);
		return ($max+1);
	}
}

?>
