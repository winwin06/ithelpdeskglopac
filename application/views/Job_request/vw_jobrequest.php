<div class="container-fluid">
    <?= $this->session->flashdata('message') ?>
    <div class="clearfix">
        <div class="float-left">
            <h1 class="h3 mb-4 text-gray-800"><?php echo $judul; ?></h1>
        </div>
        <div class="float-right">
            <a href="<?= site_url() ?>Prodi/tambah" class="btn btn-info mb-2">Job Request</a>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacinf="0">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Job Title</td>
                            <td>Job Description</td>
                            <td>Notes</td>
                            <td>Image</td>
                            <td>Status</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($job_request as $us) : ?>
                            <tr>
                                <td><?= $i; ?>.</td>
                                <td><?= $us['job_title']; ?></td>
                                <td><?= $us['job_description']; ?></td>
                                <td><?= $us['notes']; ?></td>
                                <td><?= $us['image']; ?></td>
                                <td><?= $us['status']; ?></td>
                                <td>
                                    <a href="<?= site_url('Prodi/hapus/') . $us['id']; ?>" class="badge badge-danger">Hapus</a>
                                    <a href="<?= site_url('Prodi/edit/') . $us['id']; ?>" class="badge badge-warning">Edit</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>