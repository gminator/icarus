<?php
/**
 * Node
 *
 * Node management
 **/  
 class Node{
   
   const ONLINE = "running";
   const DOWN = "online";
   public $id;
   public $host;
   public $nic;
   
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
      $hostame = `hostname`;
      $interface = `ifconfig | grep -A 2 eth10`;
      preg_match("/([\d\.]{2,3}){4}/", $interface, $data);
      
      $eth0 = $data[0];
      
      
      $node =  Node::get($eth0); 
      if($node)
      {return $node;}
      
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
      return new Node(array("id" => $data["ID"], "nic" => $data["post_title"], "host" => $data["post_content"], "status" => $data["post_status"]));
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
         wp_update_post( array("ID" => $this->id, "post_status" => $this->status,  "post_content" => $this->host) ); 
         return   1;
      }
      return wp_insert_post( array("ID" => $this->id, "post_content" => $this->host, "post_title" => $this->nic, "post_status" => $this->status, "post_type" => Icarus::POST_TYPE), $wp_error );
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
         $nodes[] = new Node(array("id" => $post->ID, "nic" => $post->post_title, "host" => $post->post_content, "status" => $post->post_status));
      }
      return $nodes;
   }
   
   public function status()
   {
      return ucwords($this->status);
   }
 }
 