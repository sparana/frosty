<?php

class Coordinate {
	private $x,$y;

	function __construct($x,$y) {
		$this->x=$x;
		$this->y=$y;
	}

	public function getCoordinate() {
		return array("x" => $this->x, "y" => $this->y);
	}

	public function setCoordinate($x, $y){
		$this->x= $x;
		$this->y= $y;
	}
}
abstract class Person {
	private $location;

	public function setLocation(Coordinate $cor) {
		$this->location=$cor;
	}

	public function getLocation() {
		return $this->location->getCoordinate();
	}
}
class Owner extends Person {
	public function __construct(Coordinate $cor){
		$this->setLocation($cor);
	}

	public function searchNearestNurse(){
		$nearest_nurse_index;
		$min_dist=9877563;
		foreach(Nurse::$nurses as $key=>$var){	
			$nurse_loc=$var->getLocation();
			$own_loc=$this->getLocation();
			$distance=sqrt(pow(($own_loc['x']-$nurse_loc['x']),2)+pow(($own_loc['y']-$nurse_loc['y']),2));
			//we can see distance by uncommenting next line
//			echo "Nurse number ".$key." distance is".$distance."<br />";
			if($distance<$min_dist)
			{
				$min_dist=$distance;
				$nearest_nurse_index=$key;
			}
		}
		return $nearest_nurse_index+1;
	}
}
class Nurse extends Person {
	public static $nurses=array();

	function __construct(Coordinate $cor) {
		$this->setLocation($cor);
		self::$nurses[] = $this;
	}
}
// -----------------------------------------------------------------------------
//nureses
$roopa = new Nurse(new Coordinate(2,3));
$poopa = new Nurse(new Coordinate(11,22));
$qoofa = new Nurse(new Coordinate(1,22));
$choof = new Nurse(new Coordinate(45,8));
$refoa = new Nurse(new Coordinate(41,55));
//owner
$own1 = new Owner(new Coordinate(23,11));
$index=$own1->searchNearestNurse();
echo "Nurse number ".$index." is at nearest distance.";




?>
