<div class="card">
    <div class="card-header">
        <h3 class="card-title">Notifications</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Job Title</th>
                    <th>Job Description</th>
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
                        <td> <?= $i; ?>.</td>
                        <td><?= $us['job_title']; ?></td>
                        <td><?= $us['job_description']; ?></td>
                        <td><?= $us['notes']; ?></td>
                        <td><?= $us['image']; ?></td>
                        <td><?= $us['status']; ?></td>
                        <td><?= $us['notes']; ?></td>
                        <td>
                            <a href="<?= base_url('job_request/hapus/') . $us['id']; ?>" class="badge badge-danger">Hapus</a>
                            <a href="<?= base_url('job_request/edit/') . $us['id']; ?>" class="badge badge-warning">Edit</a>
                            <a href="<?= base_url('job_request/detail/') . $us['id']; ?>" class="badge badge-info">Detail</a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>