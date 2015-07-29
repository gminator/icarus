<h3>Icurus Health and Monitoring</h3>
<p>
  This plugin will provide a status page that can be polled by any load balancer probe and Monitoring System.
  <div class="alert alert-info" role="alert"><strong>Note:</strong> If you using varnish, you will want to skip caching of the status page.</div> 
</p>
<h4>Web nodes and states</h4>
<p>
  Nodes represent server instances that house your wordpress source code and serve content to your end users.
  The nodes will phone home to the plugin when ever it serves content or hits the status page.
  This is done to avoid the use of crons or complicated polling mechanisms, allowing the plugin to stand alone.
</p>
<p>
  The status for the web nodes are defined as follows, these refer to the possible meaning when a node is reflecting a particlar state:<br/>
</p>
<p>
  <table class="table">
    <tr>
      <td><span class="label label-danger">Offline</span></td>
      <td>This means that a node has not phoned home in the given time (Offline Timeout)</td>
    </tr>
    <tr>
      <td> <span class="label label-default">Stale</span></td>
      <td>This means that a node has not phoned home in the given time (Stale Timeout)</td>
    </tr>
    <tr>
      <td> <span class="label label-success">Online</span></td>
      <td>The node has recently registered/phoned home or is serving content regularly</td>
    </tr>
    <tr>
      <td> <span class="label label-warning">Degraded</span></td>
      <td>The node is currently expereincing high load or ram usage</td>
    </tr>
  </table>
  <div class="alert alert-warning" role="alert"><strong>Heads up:</strong> This works best when your environement has a load balancer capable of probing the status page. If the probe setting is disabled the plugin will rely on the nodes serving content through the cms.</div> 
</p>
<h4>Clusters</h4>
A cluster refers to the combined health of all your nodes.
<p>
  <table class="table">
    <tr>
      <td><span class="label label-danger">Offline</span></td>
      <td>You should never really see this, in theory you should not be able to see wordpress if your cluser is offline. If you do see it means your probe is not working</td>
    </tr>
    <tr>
      <td> <span class="label label-success">Online</span></td>
      <td>All nodes are healthy</td>
    </tr>
    <tr>
      <td> <span class="label label-warning">Degraded</span></td>
      <td>One or more nodes are under high load</td>
    </tr>
    <tr>
      <td> <span class="label label-warning">Partially runnning</span></td>
      <td>Some nodes are offline, or did not phone home</td>
    </tr>
    
    <tr>
      <td> <span class="label label-danger">Inconsistent</span></td>
      <td>There registered node code does not match your node settings</td>
    </tr>
  </table>
</p>