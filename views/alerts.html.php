<div class="row">
  <div class="col-md-9">
    <p> Downtime alerts will be sent to this notification settings. </p>
    <form method="post" action="options.php" class="form-horizontal"> 
      
      <?php settings_fields( 'icarus_settings_alerts' ); ?> 
      <?php do_settings_sections( 'icarus_settings_alerts' ); ?>
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