<?php


namespace Edu\Cnm\DataDesign;

require_once("autoload.php");

require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;
/**
 *
 *
 * @author Manuel Escobar III <mescobar14@cnm.edu>
 *
 **/
class sanator {
	use \ValidateUuid;


	/**
	 * id for this Senator; this is the primary key
	 * @var Uuid $senatorId
	 **/
	protected $senatorId;

	/**
	 * sanators name
	 * @var string $senatorName
	 **/
	protected $senatorName;

	/**
	 * senatorsLives
	 * @var string $senatorLives
	 **/
	protected $senatorLives;


	/**
	 * -- inserts this Senator into mySQL
	 *
	 * -- @param \PDO $pdo PDO connection object
	 * -- @throws \PDOException when mySQL related errors occur
	 * -- @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo): void {

		$query = "INSERT INTO senator(senatorId, senatorName, senatorLives) VALUES(:senatorId, :senatorName,:senatorLives)";
		$statement = $pdo->prepare($query);
		$parameters = ["personaId" => $this->senatorId->getBytes(), "senatorName" => $this->senatorName, "senatorLives" => $this->senatorLives];
		$statement->execute($parameters);
	}


	public function delete(\PDO $pdo): void {

		// create query template
		$query = "DELETE FROM senator WHERE senatorId = :senatorId";
		$statement = $pdo->prepare($query);
		$parameters = ["senatorId" => $this->senatorId->getBytes(), "senatorName" => $this->senatorName, "senatorLives" => $this->senatorLives];
		$statement->execute($parameters);
	}


	public function update(\PDO $pdo): void {

// create query template
		$query = "UPDATE senator SET senatorId = :senatorId, senatorName = :senatorName, senatorLives = :senatorLives, WHERE senatorId = :senatorId";
		$statement = $pdo->prepare($query);

		$parameters = ["senatorId" => $this->senatorId->getBytes(), "senatorName" => $this->senatorName, "senatorLives" => $this->senatorLives];
		$statement->execute($parameters);
	}
}