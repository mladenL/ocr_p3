<?php 


class Model
{
	static $connections = array();

	public $conf = 'default';
	public $table = false;
	public $db;
	
	public function __construct() {
		$conf = conf::$databases[$this->conf];

		if(isset(Model::$connections[$this->conf])) {
			$this->db = Model::$connections[$this->conf];
			return true;
		}

		try {

			$pdo = new PDO('mysql:host='.$conf['host'].';dbname='.$conf['dbname'].';charset='.$conf['charset'], $conf['login'], $conf['passwd']);
			Model::$connections[$this->conf] = $pdo;
			$this->db = $pdo;

		} catch (PDOException $e) {

			if (conf::$debug >= 1) {
				die($e->getMessage());

			}
			else {

				die('Impossible de se connecter à la base de données');

			}
		}

		// Initializing variables
		if($this->table === false) {
			$this->table = strtolower(get_class($this)).'s';
		}
		else {
			$this->table = false;
		}

	}

	public function find($req) {
		$sql = 'SELECT * FROM '.$this->table.' as '.get_class($this).'';
		if(isset($req['conditions'])) {
			$sql .= ' WHERE '.$req['conditions'];
		}

		$pre = $this->db->prepare($sql);
		$pre->execute();
		return $pre->fetchAll(PDO::FETCH_OBJ);
	}
}

?>
