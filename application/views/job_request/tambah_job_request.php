<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-header justify-content-center">
                    Form Tambah Data Job Request
                </div>
                <div class="card-body">
                    <form action="" method="POST">
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
                            <label for="notes">Notes</label>
                            <input type="text" name="notes" value="<?= set_value('notes'); ?>" class="form-control" id="notes" placeholder="Notes">
                            <?= form_error('notes', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="text" name="image" value="<?= set_value('image'); ?>" class="form-control" id="image" placeholder="Image">
                            <?= form_error('image', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" value="<?= set_value('status'); ?>" id="status" class="form-control">
                                <option value="">Status</option>
                                <option value="Not Started">Not Started</option>
                                <option value="On Going">On Going</option>
                                <option value="Done">Done</option>
                            </select>
                        </div>
                        <a href="<?= site_url('dashboard/dashboard') ?>" class="btn btn-danger">Close</a>
                        <button type="submit" name="tambah" class="btn btn-primary float-right">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>