<?php
/**
 * Icarus
 *
 * This is main class for the Icarus plugin
 *
 * it will be responsible for registering menus
 * and pages and such 
 **/  
 class Icarus {
   const POST_TYPE = "node";
    
    public function __construct($action = null, $data = array())
    {
        
         add_action( 'admin_menu', array( $this, 'register_admin_menu' ) );
         add_action( 'admin_init', array( $this, 'register_settings' ) );
         add_action( 'init', array( $this, 'register_post_types' ) );
         
         Node::offline_nodes();
         Node::register_node();  
    }
    
    public function register_post_types()
    { 
       register_post_type( 'acme_product',
         array(
           'labels' => array(
             'name' => __( 'Node' ),
             'singular_name' => __( 'Node' )
           ),
           'public' => false,
           'has_archive' => true,
         )
       );
    }
    public function register_admin_menu(){ 
        add_options_page( 'Icarus','Icarus','manage_options','icarus.php', array( $this, 'admins_settings_page' ) ); 
    }
    
    /**
     * Register Settings
     *
     * This will register respective
     * settings for this plugin 
     **/
    public function register_settings(){
        register_setting('icarus_settings', 'nodes', array($this, "validate_empty"));
        register_setting('icarus_settings', 'rewrites', array($this, "validate_empty")); 
    }
    
    /**
     * Settings Page
     *
     * This will retrieve the settings page for the
     * dashboard admin panel
     *
     **/
    public function admins_settings_page()
    {
      
        require_once ICARUS_PLUGIN_DIR . "/views/settings.html.php";
    }
    
    /**
     * Status URI
     *
     * This will return the uri needed for the health
     * check
     * @todo Allow for url rewrites 
     * @param void
     * @return string
     **/
    public function status_uri()
    {     
        return plugins_url("status.php", ICARUS_PLUGIN_DIR ."/icarus.php");
    }
    
    
    public function assert_health()
    {
        if(!$this->assert_database_connection())
        {return false;}
        
        return true;
    }
    
    /**
     * Assert Db Connection
     *
     * This will verify that we can
     * connect to the databases
     * and that we get epxected results
     *
     * @return boolean
     * @throws UnableToEstablishDbConnection if the db connection/results failed for what ever reason
     *
     **/
    public function assert_database_connection()
    {
        try{
            global $wpdb;
            $results = $wpdb->get_results( 'SELECT * FROM wp_options limit 1', OBJECT); 
        } catch(Exception $e) {
            throw new UnableToEstablishDbConnection("Failed to query db: " . get_class($e));
        }

        if(empty($results))
        {throw new UnableToEstablishDbConnection("Failed to retrieve results from wp setting");}
         
        return true;
    }
    
    public function failed($message)
    {
        header($_SERVER["SERVER_PROTOCOL"]." 500 Internal Server Error"); 
        header("Status: 500");
        echo json_encode(array("status" => "down", "message" => $message));
    }
    
    
    
    public function success()
    { 
        echo json_encode(array("status" => "running"));
    }
 }
 
 class UnableToEstablishDbConnection extends Exception {}
 