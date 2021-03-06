<?php

use Doctrine\Common\Collections\ArrayCollection;

/** 
 * @Entity
 * @Table(name="jabaianb.voyage")
 */
class voyage{

	/** 
	 * @Id 
	 * @Column(type="integer")
	 * @GeneratedValue
	 */ 
	public $id;

	/**
	 * @ManyToOne(targetEntity="utilisateur")
	 * @JoinColumn(name="conducteur", referencedColumnName="id")
	 */ 
	public $conducteur;
		
	/** 
	 * @ManyToOne(targetEntity="trajet")
	 * @JoinColumn(name="trajet", referencedColumnName="id")
	 */ 
	public $trajet;

	/** @Column(type="string", length=45) */ 
	public $tarif;

	/** @Column(type="string", length=45) */ 
	public $nbPlace;

	/** @Column(type="string", length=200) */ 
	public $heureDepart;

    /** @Column(type="string", length=200) */ 
	public $contraintes;

	
}

?>





<!-- CREATE TABLE voyage (
 id SERIAL ,
 conducteur INT NULL ,
 trajet INT NULL ,
 tarif INT NULL , 
 nbPlace INT NULL ,
 heureDepart INT NULL ,
 contraintes VARCHAR(500),	 
 PRIMARY KEY (id) ,
 CONSTRAINT utilisateur
 FOREIGN KEY (conducteur)
 REFERENCES utilisateur (id )
 ON DELETE NO ACTION
 ON UPDATE NO ACTION,
 CONSTRAINT trajet
 FOREIGN KEY (trajet)
 REFERENCES trajet (id )
 ON DELETE NO ACTION
 ON UPDATE NO ACTION); -->
