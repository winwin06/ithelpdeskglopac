<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-header justify-content-center">
                    Detail Job Request
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">Job Title</div>
                        <div class="col-md-2">:</div>
                        <div class="col-md-6"><?= $job_request['job_title']; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Job Description</div>
                        <div class="col-md-2">:</div>
                        <div class="col-md-6"><?= $job_request['job_description']; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Notes</div>
                        <div class="col-md-2">:</div>
                        <div class="col-md-6"><?= $job_request['notes']; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Image</div>
                        <div class="col-md-2">:</div>
                        <div class="col-md-6"><?= $job_request['image']; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Status</div>
                        <div class="col-md-2">:</div>
                        <div class="col-md-6"><?= $job_request['status']; ?></div>
                    </div>
                    <div class="card-footer justify-content-center">
                        <a href="<?= site_url('dashboard/job_request') ?>" class="badge badge-danger float-right">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>