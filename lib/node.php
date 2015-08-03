<?php
/**
 * Node
 *
 * Node management
 **/  
 class Node{
   
   const ONLINE = "online";
   const DOWN = "offline";
   const DEGRADED = "degraded";
   const STALE = "stale";
   
   public $id;
   public $host;
   public $nic;
   public $data;
   
   public function __construct($attributes)
   {
      foreach($attributes as $k => $v)
      { $this->{$k} = $v;}
   }
   
   public static function load_nodes()
   {
      
   }
   
   /**
    * Register a node
    *
    * Note: assume that eth0 is default interface
    **/ 
   public function register_node()
   {
      $settings = Icarus::retrieve_settings();
      $hostame = `hostname`;
      $ifaces = $settings["iface"];
      $interface = `ifconfig | grep -A 2 {$ifaces}`;
      var_dump($interface);
      preg_match_all("/addr:(([\d\.]{2,3}){4})/", $interface, $data);
      
      $eth0 = join("::", $data[1]);
      
      
      $node =  Node::get($eth0);
      $settings = Icarus::retrieve_settings();
      //Register nodes on page load if probing is not enabled
      if($node )
      {
         if(!$settings['probe_enabled'])
         {
            $node->status = Node::ONLINE;
            $node->save();
         }
         return $node;
      }
      
      $node = new Node(array("host" => $hostame, "nic" => $eth0, "status" => Node::ONLINE));
      $node->save();
      return $node;
   }
   
   /**
    * Retrieve Node
    * By ID
    **/
   public static function get($nic)
   {
      $data =  get_page_by_title( $nic, ARRAY_A, strtolower(Icarus::POST_TYPE));
      if (empty($data))
      {return null;}
      return new Node(array("id" => $data["ID"], "nic" => $data["post_title"], "host" => $data["post_name"], "status" => $data["post_status"]));
   }
   /**
    * Node
    *
    * Save node to wordpress
    **/
   public function save()
   {
      if ($this->id)
      {
         wp_update_post( array("ID" => $this->id, "post_status" => $this->status,  "post_name" => $this->host, "post_content" => $this->metadata()) );  
         return   1;
      }
      
      
       wp_insert_post( array("post_content" => $this->metadata(), "ID" => $this->id, "post_name" => $this->host, "post_title" => $this->nic, "post_status" => $this->status, "post_type" => Icarus::POST_TYPE), $wp_error );
         return 1;
   }
   
   public static function offline_nodes()
   {
      $nodes = Node::all();
      
      foreach($nodes as $node)
      {
         $node->status = Node::DOWN;
         $node->save();
      }
   }
   public static function all()
   {
      $nodes = array();
      $args = array( 'post_type' => Icarus::POST_TYPE, 'post_status' => Node::ONLINE );
      $posts_array = get_posts($args);
      foreach($posts_array as $post)
      { 
         $nodes[] = new Node(array("last_update" => $post->post_modified, "data" => json_decode($post->post_content, true),"id" => $post->ID, "nic" => $post->post_title, "host" => $post->post_name, "status" => $post->post_status));
      }
      return $nodes;
   }
   
   public function last_update()
   {
       return current_time('timestamp') - strtotime($this->last_update);
   }
   public function status()
   {
      $last_update = $this->last_update();
      $settings = Icarus::retrieve_settings();
      
      if($last_update > $settings["down_timeout"])
      {return Node::DOWN;}
      
      if($last_update > $settings["stale_timeout"])
      {return Node::STALE;}
      
      
      if ($this->status != Node::ONLINE)
      {return $this->status;}
      
      
      if ($this->ram() > $settings['mem_limit'] || $this->load() > $settings['load_limit'])
      {return Node::DEGRADED;}
      
      return  $this->status;
   }
   
   public function metadata()
   {
      $free = shell_exec('free');
      $free = (string)trim($free);
      $free_arr = explode("\n", $free);
      $mem = explode(" ", $free_arr[1]);
      $mem = array_filter($mem);
      $mem = array_merge($mem);
      $memory_usage = $mem[2]/$mem[1]*100;
      
      $load = sys_getloadavg();
      
      return json_encode(array("load" => $load[0], "memory" => $memory_usage));
   }
   
   public function ram()
   { 
      return round($this->data["memory"],0);
   }
   
   public function load()
   { 
      return $this->data["load"];
   }
   
   
 }
 