<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-header justify-content-center">
                    Detail Job Request
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">Date</div>
                        <div class="col-md-2">:</div>
                        <div class="col-md-6"><?= $job_request['date']; ?></div>
                    </div>
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
                        <div class="col-md-6">
                            <?php if ($job_request['image']): ?>
                                <img src="<?= base_url('assets/dist/img/job_request/') . $job_request['image']; ?>" style="width: 100px;" class="img-thumbnail">
                            <?php else: ?>
                                No Image
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">Status</div>
                        <div class="col-md-2">:</div>
                        <div class="col-md-6"><?= $job_request['status']; ?></div>
                    </div>
                    <div class="card-footer justify-content-center">
                        <a href="<?= site_url('job_request') ?>" class="badge badge-danger float-right">Close</a>
                        <!-- <a href="<?= site_url('laporanpdf/detail/49') ?>" class="badge badge-info float-right mr-1">Print</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>