<?php

Class Segnalazione {

	private $cdt = 0;

	private $nome_evento = "";

	private $citta = "";

	private $indirizzo = "";

	private $tipo_evento = "";

	private $gravita = 0;

	private $stato = "";

	private $descrizione = "";

	private $data_creazione = "";

	private $latitudine = 0.00;

	private $longitudine = 0.00;

	private $squadra = "";



public function __construct($cdt,$nome_evento,$citta,$indirizzo,$tipo_evento,$gravita,$stato,$descrizione,$data_creazione,$latitudine,$longitudine,$squadra){

	$this->cdt = $cdt;

	$this->nome_evento = $nome_evento;

	$this->citta = $citta;

	$this->indirizzo = $indirizzo;

	$this->tipo_evento = $tipo_evento;

	$this->gravita = $gravita;

	$this->stato = $stato;

	$this->descrizione = $descrizione;

	$this->data_creazione = $data_creazione;

	$this->latitudine = $latitudine;

	$this->longitudine = $longitudine;

	$this->squadra = $squadra;

}



public function getCdt(){

	return $this->cdt;

}

public function getNomeEvento(){

	return $this->nome_evento;

}



public function getCitta(){

	return $this->citta;

}

public function getIndirizzo(){

	return $this->indirizzo;

}

public function getTipoEvento(){

	return $this->tipo_evento;

}

public function getGravita(){

	return $this->gravita;

}

public function getStato(){

	return $this->stato;

}

public function getDescrizione(){

	return $this->descrizione;

}

public function getDataCreazione(){

	return $this->data_creazione;

}

public function getLatitudine(){

	return $this->latitudine;

}

public function getLongitudine(){

	return $this->longitudine;

}

public function getSquadra(){

	return $this->squadra;

}



}

