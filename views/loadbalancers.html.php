<div class="row">
  <div class="col-md-9">
    <p> Modify load balancer settings. </p>
    <form method="post" action="options.php" class="form-horizontal"> 
      
      <?php settings_fields( 'icarus_settings_load_balancer' ); ?> 
      <?php do_settings_sections( 'icarus_settings_load_balancer' ); ?>
      
      
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-4 control-label">Are you load balancing?</label>
        <div class="col-sm-8">
          <input type="checkbox" name="loadalanced" <?= $options["loadalanced"] ?  "checked" : null ?> >
        </div>
      </div>
      
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-4 control-label">Do you have node Probing?</label>
        <div class="col-sm-8">
          <input type="checkbox" name="probe_enabled" <?= $options["probe_enabled"] ?  "checked" : null ?> >
        </div>
      </div>
      
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-4 control-label">Load balancer Type</label>
        <div class="col-sm-8">
          <select name="loadbalancer">
            <? foreach(array("Nginx Web Server", "Varnish HTTP Accelerator", "Other") as $lb ) { ?>
            <option <?= $options["loadbalancer"] == $lb ?  "selected" : null ?>  value="<?= $lb ?>"><?= $lb ?></option>
            <? } ?>
          </select>
        </div>
      </div>
      
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-4 control-label">How many nodes?</label>
        <div class="col-sm-8">
          <input type="number" class="form-control" placeholder="How many nodes you have in your cluster" value="<?php echo $options['nodes'] ?>" name="nodes">
        </div>
      </div>
      
      <?php submit_button(); ?>
    </form>
  </div>
</div>