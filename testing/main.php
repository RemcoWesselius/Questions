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
		'test7' => 'test7',
		'test8' => 'test8',
		'test9' => 'test9',
		'test10' => 'test10',
	);
	
	var $db_data = array(
		'host' => 'localhost',
		'user' => 'root',
		'pass' => '',
		'db'   => 'surveyval',
		'wpdb_prefix' => 'wpsrvv_'
	);
	
	var $survey_id = 10;
	var $con;
	
	protected $screenshotPath = 'C:/xampp/htdocs/surveyval';
	protected $captureScreenshotOnFailure = TRUE;
	protected $screenshotUrl = 'http://localhost/surveyval';
	
	public function setUp(){
		$this->setBrowser( $this->browser );
		$this->setBrowserUrl( $this->browser_url );
		
		$this->con = $this->connect_db();
	}
	
	public function test(){
		$user_ids = array();
		
		foreach( $this->users as $user_name => $user_pass ):
			$user_id = $this->add_user( $user_name, $user_pass );
			$this->add_user_to_survey( $user_id, $this->survey_id );
			
			$this->open( "wp-login.php" );
			$this->type( "id=user_login", $user_name );
			$this->type( "id=user_pass", $user_pass );
			$this->click( "id=wp-submit" );
			
			sleep( 2 );
			
			$this->open("survey/check-melle/");
			$this->waitForPageToLoad("30000");
			
			sleep( 2 );
						
		    $this->click("name=surveyval_submission");
		    $this->waitForPageToLoad("30000");
		    $this->click("name=surveyval_response[101][]");
		    $this->click("document.surveyval.elements['surveyval_response[101][]'][8]");
		    $this->click("document.surveyval.elements['surveyval_response[101][]'][16]");
		    $this->click("document.surveyval.elements['surveyval_response[101][]'][24]");
		    $this->click("document.surveyval.elements['surveyval_response[101][]'][32]");
		    $this->click("document.surveyval.elements['surveyval_response[101][]'][40]");
		    $this->click("document.surveyval.elements['surveyval_response[101][]'][48]");
		    $this->click("name=surveyval_submission");
		    $this->waitForPageToLoad("30000");
		    $this->select("name=surveyval_response[105]", "label=5");
		    $this->type("name=surveyval_response[106]", "30");
		    $this->select("name=surveyval_response[109]", "label=5");
		    $this->type("name=surveyval_response[110]", "35");
		    $this->select("name=surveyval_response[113]", "label=5");
		    $this->type("name=surveyval_response[114]", "40");
		    $this->type("name=surveyval_response[115]", "100");
		    $this->type("name=surveyval_response[117]", "190");
		    $this->type("name=surveyval_response[118]", "100");
		    $this->select("name=surveyval_response[119]", "label=Ja");
		    $this->select("name=surveyval_response[120]", "label=Mehr als 30");
		    $this->click("name=surveyval_submission");
		    $this->waitForPageToLoad("30000");
		    $this->type("name=surveyval_response[115]", "8");
		    $this->click("name=surveyval_submission");
		    $this->waitForPageToLoad("30000");
		    $this->click("name=surveyval_response[122][]");
		    $this->click("document.surveyval.elements['surveyval_response[122][]'][9]");
		    $this->click("document.surveyval.elements['surveyval_response[122][]'][18]");
		    $this->click("document.surveyval.elements['surveyval_response[122][]'][27]");
		    $this->click("document.surveyval.elements['surveyval_response[122][]'][36]");
		    $this->click("document.surveyval.elements['surveyval_response[122][]'][45]");
		    $this->click("document.surveyval.elements['surveyval_response[122][]'][54]");
		    $this->click("document.surveyval.elements['surveyval_response[122][]'][72]");
		    $this->click("name=surveyval_submission");
		    $this->waitForPageToLoad("30000");
		    $this->click("document.surveyval.elements['surveyval_response[122][]'][63]");
		    $this->click("name=surveyval_submission_back");
		    $this->waitForPageToLoad("30000");
		    $this->click("name=surveyval_submission_back");
		    $this->waitForPageToLoad("30000");
		    $this->click("document.surveyval.elements['surveyval_response[101][]'][48]");
		    $this->click("name=surveyval_submission");
		    $this->waitForPageToLoad("30000");
		    $this->click("document.surveyval.elements['surveyval_response[101][]'][48]");
		    $this->click("name=surveyval_submission");
		    $this->waitForPageToLoad("30000");
		    $this->click("name=surveyval_submission");
		    $this->waitForPageToLoad("30000");
		    $this->click("name=surveyval_submission");
		    $this->waitForPageToLoad("30000");
			
			sleep( 2 );
			
			$this->delete_user( $user_id );
		endforeach;
	}
	
	private function run1(){
		$this->open("survey/check-melle/");
		$this->waitForPageToLoad("300000");
	    $this->click("name=surveyval_submission");
	    $this->waitForPageToLoad("30000");
	    $this->click("name=surveyval_response[101][]");
	    $this->click("document.surveyval.elements['surveyval_response[101][]'][8]");
	    $this->click("document.surveyval.elements['surveyval_response[101][]'][16]");
	    $this->click("document.surveyval.elements['surveyval_response[101][]'][24]");
	    $this->click("document.surveyval.elements['surveyval_response[101][]'][32]");
	    $this->click("document.surveyval.elements['surveyval_response[101][]'][40]");
	    $this->click("document.surveyval.elements['surveyval_response[101][]'][48]");
	    $this->click("name=surveyval_submission");
	    $this->waitForPageToLoad("30000");
	    $this->select("name=surveyval_response[105]", "label=5");
	    $this->type("name=surveyval_response[106]", "30");
	    $this->select("name=surveyval_response[109]", "label=5");
	    $this->type("name=surveyval_response[110]", "35");
	    $this->select("name=surveyval_response[113]", "label=5");
	    $this->type("name=surveyval_response[114]", "40");
	    $this->type("name=surveyval_response[115]", "100");
	    $this->type("name=surveyval_response[117]", "190");
	    $this->type("name=surveyval_response[118]", "100");
	    $this->select("name=surveyval_response[119]", "label=Ja");
	    $this->select("name=surveyval_response[120]", "label=Mehr als 30");
	    $this->click("name=surveyval_submission");
	    $this->waitForPageToLoad("30000");
	    $this->type("name=surveyval_response[115]", "8");
	    $this->click("name=surveyval_submission");
	    $this->waitForPageToLoad("30000");
	    $this->click("name=surveyval_response[122][]");
	    $this->click("document.surveyval.elements['surveyval_response[122][]'][9]");
	    $this->click("document.surveyval.elements['surveyval_response[122][]'][18]");
	    $this->click("document.surveyval.elements['surveyval_response[122][]'][27]");
	    $this->click("document.surveyval.elements['surveyval_response[122][]'][36]");
	    $this->click("document.surveyval.elements['surveyval_response[122][]'][45]");
	    $this->click("document.surveyval.elements['surveyval_response[122][]'][54]");
	    $this->click("document.surveyval.elements['surveyval_response[122][]'][72]");
	    $this->click("name=surveyval_submission");
	    $this->waitForPageToLoad("30000");
	    $this->click("document.surveyval.elements['surveyval_response[122][]'][63]");
	    $this->click("name=surveyval_submission_back");
	    $this->waitForPageToLoad("30000");
	    $this->click("name=surveyval_submission_back");
	    $this->waitForPageToLoad("30000");
	    $this->click("document.surveyval.elements['surveyval_response[101][]'][48]");
	    $this->click("name=surveyval_submission");
	    $this->waitForPageToLoad("30000");
	    $this->click("document.surveyval.elements['surveyval_response[101][]'][48]");
	    $this->click("name=surveyval_submission");
	    $this->waitForPageToLoad("30000");
	    $this->click("name=surveyval_submission");
	    $this->waitForPageToLoad("30000");
	    $this->click("name=surveyval_submission");
	    $this->waitForPageToLoad("30000");
	}
	
	private function connect_db(){
		$con = mysql_connect( $this->db_data[ 'host' ], $this->db_data[ 'user' ], $this->db_data[ 'pass' ] );
		
		// Check connection
		if ( !$con ) {
		    die( 'Verbindung schlug fehl: ' . mysql_error() );
		}

		mysql_select_db( $this->db_data[ 'db' ], $con ) or die( 'Datenbank konnte nicht erreichbar.' );
		
		/*
		$table = $this->db_data[ 'wpdb_prefix' ] . 'users';
		
		$query = "SELECT * FROM {$table}";
		$result = mysql_query( $query ); 
		
		while( $row = mysql_fetch_row( $result ) ):
			print_r( $row );
		endwhile;
		 */
		
		return $con;
	}
	
	private function add_user( $user_name, $user_pass, $user_level = 10 ){
		$table_users = $this->db_data[ 'wpdb_prefix' ] . 'users';
		
		$sql = sprintf( "INSERT INTO `{$table_users}` (`user_login`, `user_pass`, `user_nicename`, `user_email`, `user_registered`, `display_name`) VALUES ( '%s', '%s', '%s', '%s', '%s', '%s')", $user_name, md5( $user_pass ), $user_name, $user_name . '@rheinschmiede.de' ,date( "Y-m-d H:i:s", time() ), $user_name ); 
		$result = mysql_query( $sql, $this->con );
		
		$user_id = mysql_insert_id();
		
		$this->add_user_meta( $user_id, $this->db_data[ 'wpdb_prefix' ] . 'user_level' , 0 );
		$this->add_user_meta( $user_id, $this->db_data[ 'wpdb_prefix' ] . 'capabilities', 'a:1:{s:10:"subscriber";b:1;}' );
			
		return $user_id;
		
	}
	
	private function add_user_meta( $user_id, $meta_key, $meta_value ){
		$table_usermeta = $this->db_data[ 'wpdb_prefix' ] . 'usermeta';
		$sql = sprintf( "INSERT INTO `{$table_usermeta}` (`user_id`, `meta_key`, `meta_value`) VALUES ( '%s', '%s', '%s')", $user_id, $meta_key , $meta_value );
		$result = mysql_query( $sql ); 
	}

	private function add_user_to_survey( $user_id, $survey_id ){
		$table_participiants = $this->db_data[ 'wpdb_prefix' ] . 'surveyval_participiants';
		$sql = sprintf( "INSERT INTO `{$table_participiants}` (`survey_id`, `user_id`) VALUES ( '%d', '%d')", $survey_id, $user_id );
		$result = mysql_query( $sql ); 
	}
	
	private function delete_user( $user_id ){
		$table_users = $this->db_data[ 'wpdb_prefix' ] . 'users';
		$table_usermeta = $this->db_data[ 'wpdb_prefix' ] . 'usermeta';
		$table_participiants = $this->db_data[ 'wpdb_prefix' ] . 'surveyval_participiants';
		
		$sql = sprintf( "DELETE FROM `{$table_users}` WHERE ID = '%d'", $user_id );
		$result = mysql_query( $sql );
		
		$sql = sprintf( "DELETE FROM `{$table_usermeta}` WHERE user_id = '%d'", $user_id );
		$result = mysql_query( $sql ); 
		
		$sql = sprintf( "DELETE FROM `{$table_participiants}` WHERE user_id = '%d'", $user_id );
		$result = mysql_query( $sql ); 
	}
}
