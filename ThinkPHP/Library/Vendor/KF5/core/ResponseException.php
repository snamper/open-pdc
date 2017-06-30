<?php

class ResponseException extends Exception {

	/**
	 * @param string     $method
	 * @param string     $detail
	 * @param int        $code
	 * @param \Exception $previous
	 */
	public function __construct($method) {
		parent::__construct('Response to '.$method.' is not valid,or the parameter is not correct. Call $this->client->getDebug() for details');
	}

}