<div class="container-fluid">
    <!-- <h1 class="h3 mb-4 text-gray-800"><?php echo $judul; ?></h1> -->

    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Job Request Data <strong>Succes</strong> <?= $this->session->flashdata('flash'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6">
            <a href="<?= site_url('job_request/create_job') ?>" class="btn btn-info mb-2"><i class="fas fa-plus-circle"></i> Create</a>
            <button type="button" class="btn btn-info mb-2" data-toggle="modal" data-target="#filterModal"><i class="fas fa-filter"></i> Filter</button>
        </div>
        <?= $this->session->flashdata('message') ?>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk filter -->
                    <form action="<?= site_url('job_request') ?>" method="post">
                        <div class="form-group">
                            <label for="dateFrom">Date From</label>
                            <input type="date" class="form-control" id="created_at" name="created_at">
                        </div>
                        <div class="form-group">
                            <label for="dateTo">Date To</label>
                            <input type="date" class="form-control" id="created_at" name="creayed_at">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="">Select Status</option>
                                <option value="Not Started">Not Started</option>
                                <option value="On Going">On Going</option>
                                <option value="Done">Done</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Search</button>
                            <button type="button" class="btn btn-secondary text-white border-0" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Notifications</h3>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Job Title</th>
                        <th>Job Description</th>
                        <th>Department</th>
                        <th>Notes</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($job_request as $us) : ?>
                        <tr>
                            <td><?= $i; ?>.</td>
                            <td><?= $us['job_title']; ?></td>
                            <td><?= $us['job_description']; ?></td>
                            <td><?= $us['department']; ?></td>
                            <td><?= $us['notes']; ?></td>
                            <td><img src="<?= base_url('assets/dist/img/job_request/') . $us['image']; ?>" style="width: 100px;" class="img-thumbnail"></td>
                            <td><?= $us['status']; ?></td>
                            <td>
                                <a href="<?= site_url('job_request/detail_job/') . $us['id']; ?>" class="badge badge-info">Detail</a>
                              
                                <?php if ($this->session->userdata("role") == "admin" || $us['status'] == 'Not Started') : ?>
                                    <a href="<?= site_url('job_request/edit_job/') . $us['id']; ?>" class="badge badge-warning">Edit</a>
                                <?php endif; ?>

                                <?php if ($this->session->userdata("role") == "admin" || $us['status'] == 'Not Started') : ?>
                                    <a href="<?= site_url('job_request/delete_job/') . $us['id']; ?>" class="badge badge-danger" onclick="return confirm('Apakah Anda Yakin?')">Delete</a>
                                <?php endif; ?>

                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>