<?php

include( '../../../../wp-load.php' );
require_once( ABSPATH . 'wp-admin/includes/user.php' );

class SurveyvalTests extends PHPUnit_Extensions_SeleniumTestCase{
		
	var $browser_url = 'http://localhost/surveyval/';
	var $is_local = FALSE;
	
	var $browser = '*firefox';
	var $users = array(
		'peter' => 'mustermann',
		/*'test2' => 'test2',
		'test3' => 'test3',
		'test4' => 'test4',
		'test5' => 'test5',
		'test6' => 'test6',
		'test7' => 'test7',
		'test8' => 'test8',
		'test9' => 'test9',
		'test10' => 'test10',*/
	);
	
	var $db_data = array(
		'host' => '127.0.0.1',
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
			$user_id = wp_create_user( $user_name, $user_pass, $user_name . '@test.com' );
			$this->add_user_to_survey( $user_id, $this->survey_id );
			
			$this->open( "wp-login.php" );
			$this->type( "id=user_login", $user_name );
			$this->type( "id=user_pass", $user_pass );
			$this->click( "id=wp-submit" );
			
			sleep( 2 );
			
			$this->open("survey/check-melle/");
			$this->waitForPageToLoad("30000");
			
			sleep( 2 );
						
		    $this->run1();
			
			sleep( 2 );
			
			wp_delete_user( $user_id );
			
		endforeach;
	}
	
	private function run1(){
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
	
	private function add_user_to_survey( $user_id, $survey_id ){
		$table_participiants = $this->db_data[ 'wpdb_prefix' ] . 'surveyval_participiants';
		$sql = sprintf( "INSERT INTO `{$table_participiants}` (`survey_id`, `user_id`) VALUES ( '%d', '%d')", $survey_id, $user_id );
		$result = mysql_query( $sql ); 
	}
}
