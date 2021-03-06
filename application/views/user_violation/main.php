<style>
    .image-cropper {
        width: 180px;
        height: 180px;
        overflow: hidden;
        border-radius: 50%;
        margin:20px auto;
        box-shadow: 0px 0px 10px gray;
    }

    .image-cropper img {
        display: inline;
        margin: 0 auto;
        height: 100%;
        width: auto;
    }
    .form-control:read-only {
        background-color: white;
    }
    .btn-file {
        position: relative;
        overflow: hidden;
    }
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }

    #img-upload{
        width: 100%;
    }
</style>
<?php

function determineStatus($status)
{
    if ($status == 0) {
        echo '<span class = "badge badge-secondary">Finished</span>';
    } else {
        echo '<span class = "badge badge-danger" style = "background:#ff3232;">Active</span>';
    }
}
?>
<div class="row">
    <ol class="breadcrumb">
        <li>
            <a href="<?=base_url(); ?>UserDashboard">
                <em class="fa fa-home"></em>
            </a>
        </li>
        <li class="active"><?=ucfirst($this->session->userdata('useraccess')); ?> Violation</li>
    </ol>
</div><!--/.row breadcrumb-->

<div class = "row">
    <div class = "col-sm-3 text-center">
        <div class="image-cropper" >
            <img src = "<?=base_url().$currentuser->user_picture; ?>" alt="<?=$currentuser->user_firstname.' '.$currentuser->user_lastname; ?>">
        </div>

    </div>
    <div class = "col-sm-9" style="padding:15px;">
        <h3><?=$currentuser->user_lastname.', '.$currentuser->user_firstname.' '.$currentuser->user_middlename; ?></h3>
        <h4><?=$currentuser->user_number; ?></h4>
    </div>
</div>
<h1>Major Reports</h1>
<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-bordered datatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Date &amp; Time</th>
                        <th>Status</th>
                        <th>Reported By</th>
                        <th>Violation</th>
                        <th>Sanction</th>
                    </tr>
                </thead>
                <?php if ($violations): ?>
                    <?php foreach ($violations as $violation): ?>
                        <tbody>
                            <tr>
                                <td><span class = "hidden"><?=$violation->incident_report_datetime; ?></span><?=date('F d, Y \a\t h:i A', $violation->incident_report_datetime); ?></td>
                                <td><?=determineStatus($violation->incident_report_status); ?></td>
                                <td>
                                    <?php
                                        if ($violation->reportedby_id != '') {
                                            //if REPORTED_BY teacher, get user's name
                                            echo $violation->reportedby_firstname.' '.($violation->reportedby_middlename == '' ? '' : substr($violation->reportedby_middlename, 0, 1).'. ').$violation->reportedby_lastname;
                                            echo " <small class = 'text-muted'><b>(".$violation->reportedby_access.')</b></small>';
                                        } else {
                                            //if REPORTED_BY admin, get admin's name
                                            echo 'Admin';
                                        }
                                        ?>
                                </td>
                                <td><?=ucfirst($violation->violation_name); ?></td>
                                <td><?=ucfirst($violation->effect_name); ?></td>
                            </tr>
                        </tbody>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>
<br/><br/>
<h1>Minor Reports</h1>
<div class="row">
    <div class="col-xs-12">
        <?php if (!$minor_reports): ?>
        <center><h3>No minor reports so far...</h3></center>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered datatable">
                <thead>
                    <tr>
                        <td>Group</td>
                        <th>Firstname</th>
                        <th>Middlename</th>
                        <th>Lastname</th>
                        <th>Violation</th>
                        <th>Tapped At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($minor_reports as $mr): ?>
                    <tr>
                        <td><?=$mr->group_id ? $mr->group_id : 'NONE'; ?></td>
                        <td><?=$mr->user_fname; ?></td>
                        <td><?=$mr->user_mname; ?></td>
                        <td><?=$mr->user_lname; ?></td>
                        <td><?=$mr->violation_name; ?></td>
                        <td><?=date('F d,Y - h:i A', $mr->tapped_at); ?></td>
                        <td>
                            <button class ="btn btn-primary"type="button" data-toggle="modal" data-target="#mr_details_<?=$mr->mr_id; ?>">Details</button>
                        </td>
                    </tr>
                    <div class="modal fade text-left" id="mr_details_<?=$mr->mr_id; ?>" tabindex="-1" role="dialog" aria-labelledby="detailsTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="detailsTitle">Details</h3>
                                </div>
                                <div class="modal-body" style="text-align:center;">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <h3>User</h3>
                                            <p><?=$mr->user_fname.' '.$mr->user_mname.' '.$mr->user_lname; ?></p>
                                            <h3>Reporter</h3>
                                            <p><?=$mr->reporter_fname.' '.$mr->reporter_mname.' '.$mr->reporter_lname; ?></p>
                                            <h3>Violation</h3>
                                            <p><?=$mr->violation_name; ?></p>
                                        </div>
                                        <div class="col-xs-6">
                                            <h3>Location</h3>
                                            <p><?=$mr->location ? $mr->location : 'None'; ?></p>
                                            <h3>Message</h3>
                                            <p><?=$mr->message ? $mr->message : 'None'; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h3>Tapped At</h3>
                                            <p><?=date('F d,Y - h:i A', $mr->tapped_at); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div> <!--END DETAILS MODAL-->
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>