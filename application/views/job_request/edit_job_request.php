<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-header justify-content-center">
                    Edit Job Request Form
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $job_request['id']; ?>">

                        <div class="form-group">
                            <label for="job_title">Job Title</label>
                            <input type="text" name="job_title" value="<?= $job_request['job_title']; ?>" class="form-control" id="job_title" placeholder="Job Title">
                            <?= form_error('job_title', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="job_description">Job Description</label>
                            <input type="text" name="job_description" value="<?= $job_request['job_description']; ?>" class="form-control" id="job_description" placeholder="Job Description">
                            <?= form_error('job_description', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <input type="text" name="notes" value="<?= $job_request['notes']; ?>" class="form-control" id="notes" placeholder="Notes">
                            <?= form_error('notes', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <img src="<?= base_url('assets/dist/img/job_request/') . $job_request['image']; ?>" style="width: 100px;" class="img-thumbnail">
                            <div class="custom-file">
                                <input type="file" name="image" class="form-control" id="image">
                                <?= form_error('image', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            </img>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" value="<?= $job_request['status']; ?>" id="status" class="form-control">
                                    <?php foreach ($status as $us) :  ?>
                                        <?php if ($us == $job_request['status']) : ?>
                                            <option value="<?= $us ?>" selected><?= $us ?></option>
                                        <?php else : ?>
                                            <option value="<?= $us ?>"><?= $us ?></option>
                                        <?php endif; ?>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <a href="<?= site_url('dashboard/job_request') ?>" class="btn btn-danger">Cancel</a>
                            <button type="submit" name="update" class="btn btn-primary float-right">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>