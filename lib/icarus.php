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
    const DEGRADED = "partialy running";
    const INCONSISTENT = "inconsistent ";
    public function __construct()
    { 
         add_action( 'admin_menu', array( $this, 'register_admin_menu' ) );
         add_action( 'admin_init', array( $this, 'register_settings' ) );
         add_action( 'init', array( $this, 'register_post_types' ) );
         add_action( 'init', array( $this, 'register_nodes' ) );    
    }
    
    public function register_nodes()
    {
         #Node::offline_nodes();
         Node::register_node();  
    }
    
    public function register_post_types()
    {
      register_post_type( 'icarus_incidents',
         array(
           'labels' => array(
             'name' => __( 'incidents' ),
             'singular_name' => __( 'incidents' )
           ),
           'public' => false,
           'has_archive' => true,
         )
       );
      
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
        add_options_page( 'Icarus Monitoring','Icarus Monitoring','manage_options','icarus.php', array( $this, 'admins_settings_page' ) ); 
    }
    
    /**
     * Register Settings
     *
     * This will register respective
     * settings for this plugin 
     **/
    public function register_settings(){
        #register_setting('icarus_settings', 'nodes', array($this, "validate_empty"));
        #register_setting('icarus_settings', 'rewrites', array($this, "validate_empty"));
        register_setting('icarus_settings_alerts', 'alert_email');
        
        
        
        register_setting('icarus_settings', 'iface');
        register_setting('icarus_settings', 'stale_timeout'); 
        register_setting('icarus_settings', 'down_timeout');   
        register_setting('icarus_settings', 'mem_limit');
        register_setting('icarus_settings', 'load_limit');
        
        register_setting('icarus_settings_load_balancer', 'loadalanced');
        register_setting('icarus_settings_load_balancer', 'loadbalancer');
        register_setting('icarus_settings_load_balancer', 'probe_enabled');
        register_setting('icarus_settings_load_balancer', 'nodes');
        
        
    }
    
    /**
     * Settings Page
     *
     * This will retrieve the settings page for the
     * dashboard admin panel
     *
     **/
    public function admins_settings_page($template)
    {
      
      $states = array(Node::ONLINE => "success", Node::DEGRADED => "warning", self::DEGRADED => "warning", Node::DOWN => "danger", Node::STALE => "default", self::INCONSISTENT => "danger");
      $node_states= $this->node_states();
      $running = $node_states[Node::ONLINE] + $node_states[Node::DEGRADED];
      $total = array_sum(array_values($node_states));
      $options = $this->retrieve_settings();
      
      if(empty($template))
      {$template="/views/settings.html.php";}
      
      require_once ICARUS_PLUGIN_DIR . $template;
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
    public function status_uri($file = "status.php")
    {     
        return plugins_url($file, ICARUS_PLUGIN_DIR ."/icarus.php");
    }
    
    
    public function assert_health()
    {
         $status  = $this->status();
         
         if($status == self::DEGRADED)
         {throw new PartiallyRunningException("Some nodes are down");}
         
         if($status == Node::DEGRADED)
         {throw new DegradedNodesException("Some nodes are down");}
          
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
    
    
    
    public function success($status = 200, $message = "OK")
    {
         echo json_encode(array("status" => $this->status()));
         exit;
    }
    
    public function node_states()
    {
      $states = array();
      foreach(Node::all() as $node)
      {
         $states[$node->status()] ++;
      }
      return $states;
    }
    public function status()
    {
      
      $settings = $this->retrieve_settings();
      $states = $this->node_states();
      $total = array_sum(array_values($states));
      
      if ($total < $settings["nodes"])
      { return self::INCONSISTENT; }
      
      if ($states[Node::DOWN])
      {
         
         if ($states[Node::DOWN] == $total)
         {return Node::DOWN;}
         
         return self::DEGRADED;
      }
      
      
      if (count($states[Node::DEGRADED]))
      {return Node::DEGRADED;}
      
      return Node::ONLINE;
    }
    
     /**
     * Admin Settings
     *
     * Retrieve settings page from views
     *
     * @param void
     * @return void
     **/
    public function retrieve_settings()
    {
      
        
            $settings = array(
               
              "iface" => get_option('iface'),
              "alert_email" => get_option('alert_email'),
              
              "loadalanced" => get_option('loadalanced'),
              "loadbalancer" => get_option('loadbalancer'),
              "probe_enabled" => get_option('probe_enabled'),
              "nodes" => get_option('nodes'),
              
              "stale_timeout" => get_option('stale_timeout', 10),
              "down_timeout" => get_option('down_timeout', 60),
              "mem_limit" => get_option('mem_limit', 60),
              "load_limit" => get_option('load_limit', 1.5),
            );
            return $settings;
    }
 }
 
class UnableToEstablishDbConnection extends Exception {}
class PartiallyRunningException extends Exception {}
class DegradedNodesException extends Exception {}
 