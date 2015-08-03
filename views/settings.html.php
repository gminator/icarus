<!-- Latest compiled and minified CSS -->
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

 <script src="<?= $this->status_uri("js/default.js")?>"></script>


<style>
  .tab-pane  {padding-top: 20px;padding-bottom: 20px;}
  h1 .glyphicon, .nav-tabs .glyphicon {margin-right: 5px;}
  .menu-btn {margin-top: 20px;}
  
</style>

<div class="row">
  
  <div class="col-md-8">
        
    <div class="row">
      <div class="col-md-10">
        <h1><span class="glyphicon glyphicon-plus-sign"></span>Icarus Monitoring</h1>
        <h5>Health and Availability Monitoring for load balanced instances of wordpress</h5> 
      </div>
      <div class="col-md-2">
            <div class="btn-group menu-btn">
              <button class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> &nbsp;Menu</button>
              <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                <li>
                  <a  id="reset" href="<?= $this->status_uri("reset.php")?>"><span class="glyphicon glyphicon-refresh"></span> &nbsp;Rest nodes</a>  
                </li>
              </ul>
            </div>
        </div>
    </div>  
    <br/><br/>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#health" aria-controls="health" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-plus-sign"></span>Health</a></li>
      <!--li role="presentation"><a href="#alerts" aria-controls="alerts" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-bell"></span>Alerts</a></li-->
      <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-wrench"></span>Settings</a></li>
      <li role="presentation"><a href="#load_balancer" aria-controls="load_balancer" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-th"></span>Load Balancer</a></li>
      <!-- li role="presentation"><a href="#incidents" aria-controls="incidents" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-warning-sign"></span>Incidents</a></li-->
      <li role="presentation"><a href="#help" aria-controls="help" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-question-sign"></span>Help</a></li>
    </ul>
  
    <!-- Tab panes -->
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="health"><? require_once ICARUS_PLUGIN_DIR . "/views/health.html.php"; ?></div>
      <div role="tabpanel" class="tab-pane" id="alerts"><? require_once ICARUS_PLUGIN_DIR . "/views/alerts.html.php"; ?></div>
      <div role="tabpanel" class="tab-pane" id="settings"><? require_once ICARUS_PLUGIN_DIR . "/views/config.html.php"; ?></div>
      <div role="tabpanel" class="tab-pane" id="load_balancer"><? require_once ICARUS_PLUGIN_DIR . "/views/loadbalancers.html.php"; ?></div>
      <div role="tabpanel" class="tab-pane" id="incidents"></div>
      <div role="tabpanel" class="tab-pane" id="help"><? require_once ICARUS_PLUGIN_DIR . "/views/help.html.php"; ?></div>
    </div> 
  </div>
</div>



