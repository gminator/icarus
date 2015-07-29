<?php
/**
 * Node
 *
 * Node management
 **/  
 class Incident {
   const POST_TYPE = "incidents";
   const ONLINE = "online";
   const DOWN = "offline";
   const DEGRADED = "degraded";
   const STALE = "stale";
   
   public $id;
   public $title;
   public $incident;
   public $type;
   
   public function __construct($attributes)
   {
      foreach($attributes as $k => $v)
      { $this->{$k} = $v;}
   }
   
   /**
    * Node
    *
    * Save node to wordpress
   **/
   public function save()
   { 
      wp_insert_post( array("ID" => $this->id,
                            "post_title" => $this->title,
                            "post_content" => $this->incident,
                            "post_status" => $this->type,
                            "post_type" => self::POST_TYPE), $wp_error );
      return 1;
   }
   
   
   
 }
 