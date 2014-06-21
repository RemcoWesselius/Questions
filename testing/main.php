<?php

class SurveyvalTests extends PHPUnit_Extensions_SeleniumTestCase{
		
	var $browser_url = 'http://localhost/surveyval/';
	var $is_local = FALSE;
	
	var $browser = '*firefox';
	var $users = array(
		'test1' => 'test1',
		'test2' => 'test2',
		'test3' => 'test3',
		'test4' => 'test4',
		'test5' => 'test5',
		'test6' => 'test6',
	);
	
	var $db_data = array(
		'host' => 'localhost',
		'user' => 'root',
		'pass' => '',
		'db'   => 'surveyval',
		'wpdb_prefix' => 'wpsrvv_'
	);
	
	public function setUp(){
		$this->setBrowser( $this->browser );
		$this->setBrowserUrl( $this->browser_url );
	}
	
	public function test(){
		$con = $this->connect_db();
		
		foreach( $this->users as $user_name => $user_pass ):
			$this->open( "wp-login.php" );
			$this->type( "id=user_login", $user_name );
			$this->type( "id=user_pass", $user_pass );
			$this->click( "id=wp-submit" );
			
		    $this->waitForPageToLoad( "30000" );
		endforeach;
	}
	
	private function connect_db(){
		$con = mysqli_connect( $this->db_data[ 'host' ], $this->db_data[ 'user' ], $this->db_data[ 'pass' ], $this->db_data[ 'db' ] );
		
		// Check connection
		if ( mysqli_connect_errno()) {
		  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
			return FALSE;
		}
		
		return $con;
	}
}
