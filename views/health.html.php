<p>
 <strong>Browse to:</strong> <a href="<?= $this->status_uri() ?>" ><?= $this->status_uri() ?></a>
</p>


<div class="row">
  
  <div class="col-md-9">
    <h4>Node Status</h4>
    <table class="table table-bordered">
      <tr>
        <th>Host</th>
        <th>Last Request</th>
        <th>Interface</th>
        <th>Ram</th>
        <th>Load</th>
        <th>Status</th>
      </tr>
      <? foreach(Node::all() as $node) { ?>
      <tr>
        <td><?= $node->host ?></td>
        <td><?= human_time_diff( strtotime($node->last_update), current_time('timestamp') )  ?> ago</td>
        <td><?= $node->nic ?></td>
        <td><?= $node->ram() ?>%</td>
        <td><?= $node->load() ?></td>
        <td><span class="label label-<?= $states[$node->status()]?>"><?= ucwords($node->status()) ?></span></td>
      </tr>
      <? } ?>
    </table>
  </div>
  
  <div class="col-md-3">
    <h4>Cluster Status</h4>
    <table class="table table-bordered">
      <tr>
          <th>Status</th>
          <td><span class="label label-<?= $states[$this->status()]?>"><?= ucwords($this->status()) ?></span></td>
      </tr>
      <tr>
          <th>Nodes</th>
          <td><?= $running ?>/<?= $total ?> Running</td>
      </tr>
    </table>
        
  </div>
</div>