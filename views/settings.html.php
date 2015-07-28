<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<style>
  .tab-pane  {padding-top: 20px;padding-bottom: 20px;}
</style>
<div class="row">
  <div class="col-md-8">
    <h1>Icurus Settings</h1>
    <h5>Health and Status Monitoring</h5>
    <br/><br/>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#health" aria-controls="health" role="tab" data-toggle="tab">Health</a></li>
      <li role="presentation"><a href="#alerts" aria-controls="alerts" role="tab" data-toggle="tab">Alerts</a></li>
      <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
    </ul>
  
    <!-- Tab panes -->
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="health"><? require_once ICARUS_PLUGIN_DIR . "/views/health.html.php"; ?></div>
      <div role="tabpanel" class="tab-pane" id="alerts"><? require_once ICARUS_PLUGIN_DIR . "/views/alerts.html.php"; ?></div>
      <div role="tabpanel" class="tab-pane" id="settings"><? require_once ICARUS_PLUGIN_DIR . "/views/config.html.php"; ?></div>
    </div> 
  </div>
</div>

<div class="row">
  <div class="col-md-8">
    <div class="alert alert-info" role="alert"><strong>Note:</strong> Please disable caching for this page if you using varnish.</div> 
  </div>
</div>


