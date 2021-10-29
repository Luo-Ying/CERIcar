<?php

use Doctrine\Common\Collections\ArrayCollection;

/** 
 * @Entity
 * @Table(name="jabaianb.trajet")
 */
class trajet{

	/** 
     * @Id 
     * @Column(type="integer")
	 * @GeneratedValue
	 */ 
	public $id;

	/** @Column(type="string", length=25) */ 
	public $depart;
		
	/** @Column(type="string", length=25) */ 
	public $arrivee;

	/** @Column(type="integer") */ 
	public $distance;

	
}

?>





<!-- CREATE TABLE trajet (
     id SERIAL ,
     depart VARCHAR(25) NULL ,
     arrivee VARCHAR(25) NULL ,
     distance INT NULL , 
     PRIMARY KEY (id) ); -->