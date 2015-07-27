<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<div class="row">
  <div class="col-md-12">
    <h1>Icurus Settings</h1>
    <h5>Health and Status Monitoring</h5> 
    <p>
      Browse to: <a href="<?= $this->status_uri() ?>" ><?= $this->status_uri() ?></a>
    </p>
  </div>
</div>


<div class="row">
  <div class="col-md-12">
    <table class="table table-bordered">
      <tr>
        <th>Host</th>
        <th>Interface</th>
        <th>Status</th>
      </tr>
      <? foreach(Node::all() as $node) { ?>
      <tr>
        <td><?= $node->host ?></td>
        <td><?= $node->nic ?></td>
        <td><span class="label label-success"><?= $node->status()?></span></td>
      </tr>
      <? } ?>
    </table>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="alert alert-info" role="alert"><strong>Note:</strong> Please disable caching for this page if you using varnish.</div> 
  </div>
</div>


