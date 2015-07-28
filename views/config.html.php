<div class="row">
  <div class="col-md-9">
    <p>Adjust settings for thresholds under which nodes will be flaged.</p>
    
    <form method="post" action="options.php" class="form-horizontal"> 
      
      <?php settings_fields( 'icarus_settings' ); ?> 
      <?php do_settings_sections( 'icarus_settings' ); ?>
      <input type="hidden" value="<?php echo $options['alert_email'] ?>" name="alert_email" >
        
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-4 control-label">Stale Timeout</label>
        <div class="col-sm-8">
          <input type="text"
                 class="form-control"
                 placeholder="Nodes need to phone home before registering as offline"
                 value="<?php echo $options['stale_timeout'] ?>"
                 name="stale_timeout" >
        </div>
      </div>
      
              
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-4 control-label">Offline Timeout</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" placeholder="Nodes need to phone home before registering as offline" value="<?php echo $options['down_timeout'] ?>" name="down_timeout">
        </div>
      </div>
      
         
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-4 control-label">Memory Limit</label>
        <div class="col-sm-8">
          <input type="text"
                 class="form-control"
                 placeholder="Memory limit percentage"
                 value="<?php echo $options['mem_limit'] ?>"
                 name="mem_limit" >
        </div>
      </div>
      
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-4 control-label">Load Limit</label>
        <div class="col-sm-8">
          <input type="text"
                 class="form-control"
                 placeholder="Server load limit"
                 value="<?php echo $options['load_limit'] ?>"
                 name="load_limit" >
        </div>
      </div>
      <?php submit_button(); ?>
    </form>
  </div>
</div>