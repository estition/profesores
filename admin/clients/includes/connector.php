<?php

class Connector
{
  /**
   * 
   * @var Singleton
   */
  private static $instance;
    private $site;
	private $protocall;
	private $mysqli_host;
	private $mysqli_user;
	private $mysqli_password;
	private $database;
        private $link;

  private function __construct()
  {
        $this->site = "www.canterburyconsultingspain.com.mialias.net/profesores";
	$this->protocall = "http";
	$this->mysqli_host = "localhost";
	$this->mysqli_user = "canter6165";
	$this->mysqli_password = "v6CIR7pB";
	$this->database = "canterburybd";
        $this->link = mysqli_connect($this->mysqli_host, $this->mysqli_user, $this->mysqli_password, $this->database)
    or die("Could not connect : " . mysqli_error());
        if (!$this->link->set_charset("utf8")) {
      printf("Error loading character set utf8: %s\n", $link->error);
  } 
      }

  public static function getInstance()
  {
    if ( is_null( self::$instance ) )
    {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function getConn()
  {
      return $this->link;
  }
  public function getSite()
  {
      return $this->protocall.'://'.$this->site;
  }

}

?>