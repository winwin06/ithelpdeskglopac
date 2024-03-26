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
            <a href="<?= site_url('dashboard/create_job_request') ?>" class="btn btn-info mb-2">Create</a>
        </div>
        <?= $this->session->flashdata('message') ?>
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
                                <a href="<?= site_url('dashboard/detail_job_request/') . $us['id']; ?>" class="badge badge-info">Detail</a>
                                <a href="<?= site_url('dashboard/edit_job_request/') . $us['id']; ?>" class="badge badge-warning">Edit</a>
                                <a href="<?= site_url('dashboard/delete_job_request/') . $us['id']; ?>" class="badge badge-danger" onclick="return confirm('yakin?')">Delete</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>