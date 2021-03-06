<div class="row">
    <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>AdminDashboard">
                <em class="fa fa-home"></em>
            </a></li>
        <li class="active">Audit Trail</li>
    </ol>
</div><!--/.row breadcrumb-->

<div class="row">
    <div class = "col-xs-12">
        <h1><?= $cms->audit_trail_title?></h1>
        <h5><?= $cms->audit_trail_text?></h5>
        <div class="table-responsive">
            <table class="table table-bordered datatable">
                <thead>
                    <tr>
                        <th>Date &amp; Time<br><small class = "text-muted">[MM/DD/YYYY] - HH:mm:ss</small></th>
                        <th>User Number</th>
                        <th>Desc</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($audits): ?>
                        <?php foreach ($audits as $audit): ?>
                            <tr>
                                <td><span class = "hidden"><?= $audit->log_added_at?></span><?= date('[ m/d/Y ] - H:i:s',$audit->log_added_at)?></td>
                                <td><?= $audit->user_id == '' ? 'Admin' : $audit->user_firstname." ".($audit->user_middlename == "" ? "" : substr($audit->user_middlename, 0, 1).". ")." ".$audit->user_lastname?></td>
                                <td><?= $audit->log_desc?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

