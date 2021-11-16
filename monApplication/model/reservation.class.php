<?php

use Doctrine\Common\Collections\ArrayCollection;

/** 
 * @Entity
 * @Table(name="jabaianb.reservation")
 */
class reservation{

	/** 
     * @Id 
     * @Column(type="integer")
	 * @GeneratedValue
	 */ 
	public $id;

	/** 
     * @ManyToOne(targetEntity="voyage")
     * @JoinColumn(name="voyage", referencedColumnName="id")
     */ 
	public $voyage;
		
	/**  
     * @ManyToOne(targetEntity="utilisateur")
     * @JoinColumn(name="voyageur", referencedColumnName="id")
     */ 
	public $voyageur;

	
}

?>




<!-- CREATE TABLE reservation (
    id SERIAL ,
    voyage INT NULL ,
    voyageur INT NULL ,
    PRIMARY KEY (id) ,
    CONSTRAINT utilisateur
    FOREIGN KEY (voyageur)
    REFERENCES utilisateur (id )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT voyage
    FOREIGN KEY (voyage)
    REFERENCES voyage (id )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION); -->