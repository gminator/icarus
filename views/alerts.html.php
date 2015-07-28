<div class="row">
  <div class="col-md-9">
    <p> Downtime alerts will be sent to this notification settings. </p>
    <form method="post" action="options.php" class="form-horizontal"> 
      
      <?php settings_fields( 'icarus_settings' ); ?> 
      <?php do_settings_sections( 'icarus_settings' ); ?>
      <input type="hidden" value="<?php echo $options['down_timeout'] ?>" name="down_timeout" >
      <input type="hidden" value="<?php echo $options['stale_timeout'] ?>" name="stale_timeout" >
      <input type="hidden" value="<?php echo $options['mem_limit'] ?>" name="mem_limit" >
      <input type="hidden" value="<?php echo $options['load_limit'] ?>" name="load_limit" >
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-4 control-label">Email Address</label>
        <div class="col-sm-8">
          <input type="email" class="form-control" placeholder="Notify this email for alerts" value="<?php echo $options['alert_email'] ?>" name="alert_email">
        </div>
      </div>
      
      <?php submit_button(); ?>
    </form>
  </div>
</div>