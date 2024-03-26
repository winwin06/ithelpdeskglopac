<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-header justify-content-center">
                    Add Job Request Form
                </div>
                <div class="card-body">

                    <form action="<?= site_url('dashboard/create_job_request'); ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="job_title">Job Title</label>
                            <input type="text" name="job_title" value="<?= set_value('job_title'); ?>" class="form-control" id="job_title" placeholder="Job Title">
                            <?= form_error('job_title', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="job_description">Job Description</label>
                            <input type="text" name="job_description" value="<?= set_value('job_description'); ?>" class="form-control" id="job_description" placeholder="Job Description">
                            <?= form_error('job_description', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="department">Department</label>
                            <input type="text" name="department" value="<?= set_value('department'); ?>" class="form-control" id="department" placeholder="Department">
                            <?= form_error('department', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <input type="text" name="notes" value="<?= set_value('notes'); ?>" class="form-control" id="notes" placeholder="Notes">
                            <?= form_error('notes', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <div class="custom-file">
                                <input type="file" name="image" class="form-control" id="image" accept="image/*">
                                <?= form_error('image', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <?php if ($this->session->userdata("role") == "user") : ?>
                                <input type="text" name="status" id="status" class="form-control" readonly>
                            <?php else : ?>
                                <select name="status" id="status" class="form-control">
                                    <option value="">--Status--</option>
                                    <option value="Not Started">Not Started</option>
                                    <option value="On Going">On Going</option>
                                    <option value="Done">Done</option>
                                </select>
                            <?php endif; ?>
                        </div>



                        <a href="<?= site_url('dashboard/job_request') ?>" class="btn btn-danger">Close</a>
                        <button type="submit" name="tambah" class="btn btn-primary float-right">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>