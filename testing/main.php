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
	
	
	var $survey_id = 4;
	var $con;
	
	// protected $screenshotPath = 'C:/xampp/htdocs/surveyval';
	protected $screenshotPath = '/Users/svenw/htdocs/surveyval/';
	protected $captureScreenshotOnFailure = TRUE;
	protected $screenshotUrl = 'http://localhost/surveyval';
	
	public function setUp(){
		$this->setBrowser( $this->browser );
		$this->setBrowserUrl( $this->browser_url );
	}
	
	public function test(){
		$user_ids = array();
		$this->generate_scripts();
		
		foreach( $this->users as $user_name => $user_pass ):
			$user_id = wp_create_user( $user_name, $user_pass, $user_name . '@test.com' );
			// $this->add_user_to_survey( $user_id, $this->survey_id );
			
			$this->open( "wp-login.php" );
			$this->type( "id=user_login", $user_name );
			$this->type( "id=user_pass", $user_pass );
			$this->click( "id=wp-submit" );
			sleep( 2 );
			
			$this->open("survey/check-melle/");
			$this->waitForPageToLoad("30000");
			
		    $this->run1();
			
			wp_delete_user( $user_id );
			
		endforeach;
	}
	
	private function run1(){
		$values = array();
		$values[ 101 ] = array( 8, 16, 24, 32, 40, 48 );
		$values[ 105 ] = '7';
		$values[ 106 ] = '5';
		$values[ 109 ] = '7';
		$values[ 110 ] = '5';
		$values[ 113 ] = '7';
		$values[ 114 ] = '5';
		$values[ 115 ] = '5';
		$values[ 117 ] = '180';
		$values[ 118 ] = '100';
		$values[ 119 ] = 'Ja';
		$values[ 120 ] = '21-30';
		$values[ 122 ] = array( 9, 18, 27, 36, 45, 54, 63, 72 );
		
		$this->click("name=surveyval_response[101][]");
		foreach( $values[ 101 ] AS $value ) $this->click("document.surveyval.elements['surveyval_response[101][]'][" . $value . "]");
		$this->click("name=surveyval_submission");
		$this->waitForPageToLoad("30000");
		sleep(2);
		$this->select("name=surveyval_response[105]", "label=" . $values[ 105 ]);
		$this->type("name=surveyval_response[106]",  $values[ 106 ] );
		$this->select("name=surveyval_response[109]", "label=" . $values[ 109 ]);
		$this->type("name=surveyval_response[110]",  $values[ 110 ] );
		$this->select("name=surveyval_response[113]", "label=" . $values[ 113 ]);
		$this->type("name=surveyval_response[114]",  $values[ 114 ] );
		$this->type("name=surveyval_response[115]",  $values[ 115 ] );
		$this->type("name=surveyval_response[117]",  $values[ 117 ] );
		$this->type("name=surveyval_response[118]",  $values[ 118 ] );
		$this->select("name=surveyval_response[119]", "label=" . $values[ 119 ]);
		$this->select("name=surveyval_response[120]", "label=" . $values[ 120 ]);
		$this->click("name=surveyval_submission");
		$this->waitForPageToLoad("30000");
		sleep(2);
		$this->click("name=surveyval_response[122][]");
		foreach( $values[ 122 ] AS $value ) $this->click("document.surveyval.elements['surveyval_response[122][]'][" . $value . "]");
		$this->click("name=surveyval_submission");
		$this->waitForPageToLoad("30000");
		sleep(5);
		
		$response_id = $this->getValue( 'response_id' );
		
		foreach( $values[ 101 ] AS $value ) $sql[ 101 ][] = "SELECT * FROM wpsrvv_surveyval_respond_answers WHERE question_id='101' AND respond_id='" . $response_id. "' AND value='" . $value . "'";
		$sql[ 105 ] = "SELECT * FROM wpsrvv_surveyval_respond_answers WHERE question_id='105' AND respond_id='" . $response_id. "' AND value='" . $values[105] . "'";
		$sql[ 106 ] = "SELECT * FROM wpsrvv_surveyval_respond_answers WHERE question_id='106' AND respond_id='" . $response_id. "' AND value='" . $values[106] . "'";
		$sql[ 109 ] = "SELECT * FROM wpsrvv_surveyval_respond_answers WHERE question_id='109' AND respond_id='" . $response_id. "' AND value='" . $values[109] . "'";
		$sql[ 110 ] = "SELECT * FROM wpsrvv_surveyval_respond_answers WHERE question_id='110' AND respond_id='" . $response_id. "' AND value='" . $values[110] . "'";
		$sql[ 113 ] = "SELECT * FROM wpsrvv_surveyval_respond_answers WHERE question_id='113' AND respond_id='" . $response_id. "' AND value='" . $values[113] . "'";
		$sql[ 114 ] = "SELECT * FROM wpsrvv_surveyval_respond_answers WHERE question_id='114' AND respond_id='" . $response_id. "' AND value='" . $values[114] . "'";
		$sql[ 115 ] = "SELECT * FROM wpsrvv_surveyval_respond_answers WHERE question_id='115' AND respond_id='" . $response_id. "' AND value='" . $values[115] . "'";
		$sql[ 117 ] = "SELECT * FROM wpsrvv_surveyval_respond_answers WHERE question_id='117' AND respond_id='" . $response_id. "' AND value='" . $values[117] . "'";
		$sql[ 118 ] = "SELECT * FROM wpsrvv_surveyval_respond_answers WHERE question_id='118' AND respond_id='" . $response_id. "' AND value='" . $values[118] . "'";
		$sql[ 119 ] = "SELECT * FROM wpsrvv_surveyval_respond_answers WHERE question_id='119' AND respond_id='" . $response_id. "' AND value='" . $values[119] . "'";
		$sql[ 120 ] = "SELECT * FROM wpsrvv_surveyval_respond_answers WHERE question_id='120' AND respond_id='" . $response_id. "' AND value='" . $values[120] . "'";
		foreach( $values[ 122 ] AS $value ) $sql[ 122 ][] = "SELECT * FROM wpsrvv_surveyval_respond_answers WHERE question_id='122' AND respond_id='" . $response_id. "' AND value='" . $value . "'";

		$this->check_db_values( $sql );
		/*
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
		*/
	}

	private function check_db_values( $sqls ){
		global $wpdb;
		$results_log = '';
		
		foreach( $sqls AS $query ):
			if( is_array( $query ) ):
				foreach( $query  AS $subquery ):
					$wpdb->get_results( $subquery );
					if( $wpdb->num_rows === 0 ):
						$results_log .= 'Value Failed: ' . $subquery . chr(13);
					else:
						$results_log .= 'Value Matched!' . chr( 13 );
					endif;
				endforeach;
			else:
				$wpdb->get_results( $query );
				if( $wpdb->num_rows === 0 ):
					$results_log .= 'Value Failed: ' . $query . chr(13);
				else:
					$results_log .= 'Value Matched!' . chr( 13 );
				endif;
			endif;
			
		endforeach;
		
		$file = fopen( 'results.log', 'w' );
		fputs( $file, $results_log );
		fclose( $file );
		
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
	
	private function generate_scripts(){
		global $wpdb;
		
		$survey = new SurveyVal_Survey( $this->survey_id );
		
		$values_code = '$values = array();' . chr( 13 );
		$click_code = '';
		$select_code = '';
		
		foreach( $survey->elements AS $element ):
			
			print_r( $element );
			switch( get_class( $element ) ){
				case 'SurveyVal_SurveyElement_Text':
					$values_code.= '$values[ ' . $element->id .' ] = \'\';' . chr( 13 );
					$click_code.= '$this->type("name=surveyval_response[' . $element->id . ']",  $values[ ' . $element->id . ' ] );' . chr( 13 );
					$select_code.= '$sql[ ' . $element->id . ' ] = "SELECT * FROM ' . $wpdb->prefix. 'surveyval_respond_answers WHERE question_id=\'' . $element->id . '\' AND respond_id=\'" . $response_id. "\' AND value=\'" . $values[' . $element->id . '] . "\'";' . chr( 13 );
					break;
				case 'SurveyVal_SurveyElement_Textarea':
					$values_code.= '$values[ ' . $element->id .' ] = \'\';' . chr( 13 );
					$click_code.= '$this->type("name=surveyval_response[' . $element->id . ']",  $values[ ' . $element->id . ' ] );' . chr( 13 );
					$select_code.= '$sql[ ' . $element->id . ' ] = "SELECT * FROM ' . $wpdb->prefix. 'surveyval_respond_answers WHERE question_id=\'' . $element->id . '\' AND respond_id=\'" . $response_id. "\' AND value=\'" . $values[' . $element->id . '] . "\'";' . chr( 13 );
					break;
				case 'SurveyVal_SurveyElement_OneChoice':
					$values_code.= '$values[ ' . $element->id .' ] = \'\';' . chr( 13 );
					$click_code.= '$this->type("name=surveyval_response[' . $element->id . ']",  $values[ ' . $element->id . ' ] );' . chr( 13 );
					$select_code.= '$sql[ ' . $element->id . ' ] = "SELECT * FROM ' . $wpdb->prefix. 'surveyval_respond_answers WHERE question_id=\'' . $element->id . '\' AND respond_id=\'" . $response_id. "\' AND value=\'" . $values[' . $element->id . '] . "\'";' . chr( 13 );
					break;
					break;
				case 'SurveyVal_SurveyElement_MultipleChoice':
					$values_code.= '$values[ ' . $element->id .' ] = array(\'\');' . chr( 13 );
					
					$click_code.= '$this->click("name=surveyval_response[' . $element->id . '][]");' . chr( 13 );
					$click_code.= 'foreach( $values[ ' . $element->id . ' ] AS $value ) ';
					$click_code.= '$this->click("document.surveyval.elements[\'surveyval_response[' . $element->id . '][]\'][" . $value . "]");' . chr( 13 );
					
					break;
					
				case 'SurveyVal_SurveyElement_Dropdown':
					$values_code.= '$values[ ' . $element->id .' ] = \'\';' . chr( 13 );
					$click_code.= '$this->select("name=surveyval_response[' . $element->id . ']", "label=" . $values[ ' . $element->id . ' ]);' . chr( 13 );
					$select_code.= '$sql[ ' . $element->id . ' ] = "SELECT * FROM ' . $wpdb->prefix. 'surveyval_respond_answers WHERE question_id=\'' . $element->id . '\' AND respond_id=\'" . $response_id. "\' AND value=\'" . $values[' . $element->id . '] . "\'";' . chr( 13 );
					
					break;
				case 'SurveyVal_SurveyElement_Matrix':
					$values_code.= '$values[ ' . $element->id .' ] = array(\'\');' . chr( 13 );
					
					$click_code.= '$this->click("name=surveyval_response[' . $element->id . '][]");' . chr( 13 );
					$click_code.= 'foreach( $values[ ' . $element->id . ' ] AS $value ) ';
					$click_code.= '$this->click("document.surveyval.elements[\'surveyval_response[' . $element->id . '][]\'][" . $value . "]");' . chr( 13 );
					
					$select_code.= 'foreach( $values[ ' . $element->id . ' ] AS $value ) ';
					$select_code.= '$sql[ ' . $element->id . ' ][] = "SELECT * FROM ' . $wpdb->prefix. 'surveyval_respond_answers WHERE question_id=\'' . $element->id . '\' AND respond_id=\'" . $response_id. "\' AND value=\'" . $value . "\'";' . chr( 13 );
					
					break;
				case 'SurveyVal_SurveyElement_Range':
					$values_code.= '$values[ ' . $element->id .' ] = \'\';' . chr( 13 );
					$click_code.= '$this->type("name=surveyval_response[' . $element->id . ']",  $values[ ' . $element->id . ' ] );' . chr( 13 );
					$select_code.= '$sql[ ' . $element->id . ' ] = "SELECT * FROM ' . $wpdb->prefix. 'surveyval_respond_answers WHERE question_id=\'' . $element->id . '\' AND respond_id=\'" . $response_id. "\' AND value=\'" . $values[' . $element->id . '] . "\'";' . chr( 13 );
					break;
				case 'SurveyVal_SurveyElement_RangeEmotional':
					$values_code.= '$values[ ' . $element->id .' ] = \'\';' . chr( 13 );
					$click_code.= '$this->type("name=surveyval_response[' . $element->id . ']",  $values[ ' . $element->id . ' ] );' . chr( 13 );
					$select_code.= '$sql[ ' . $element->id . ' ] = "SELECT * FROM ' . $wpdb->prefix. 'surveyval_respond_answers WHERE question_id=\'' . $element->id . '\' AND respond_id=\'" . $response_id. "\' AND value=\'" . $values[' . $element->id . '] . "\'";' . chr( 13 );
					break;
					
				case 'SurveyVal_SurveyElement_Splitter':
					$click_code.= '$this->click("name=surveyval_submission");' . chr( 13 );
					$click_code.= '$this->waitForPageToLoad("30000");' . chr( 13 );
					$click_code.= 'sleep(2);' . chr( 13 );
					break;

			}
		endforeach;
		
		$click_code.= '$this->click("name=surveyval_submission");' . chr( 13 );
		$click_code.= '$this->waitForPageToLoad("30000");' . chr( 13 );
		$click_code.= 'sleep(2);' . chr( 13 );
		
		$code = '<?php' . chr( 13 ) . chr( 13 );
		$code.= $values_code . chr( 13 );
		$code.= $click_code . chr( 13 );
		$code.= $select_code . chr( 13 );
		
		$file = fopen( 'generated-script.php', 'w' );
		fputs( $file, $code );
		fclose( $file );
		
		print_r( $values_code );
	}
}
