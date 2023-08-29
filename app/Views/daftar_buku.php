<?= $this->extend('layouts/matrix') ?>


<?= $this->section('content') ?>

<?php
if (session()->getFlashdata('pesan')) : ?>
    <div class="alert alert-primary" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
    </div>
<?php endif; ?>

<div class="row">
    <div class="cols">

        <div class="card">
            <div class="card-body">
                <h3 class="card-titte">Daftar Buku</h3>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Pengarang</th>
                            <th scope="col">Penerbit</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($databuku as $item) : ?>
                            <tr>
                                <th scope="row"><?= $no; ?></th>
                                <td>
                                    <img src="/images/<?= $item['sampul']; ?>" class="img-fluid rounded-start" alt="sampul" width="100px">
                                </td>
                                <td><?= $item['judul']; ?></td>
                                <td><?= $item['pengarang']; ?></td>
                                <td><?= $item['penerbit']; ?></td>
                                <td>

                                    <form action="/buku/edit" method="POST" class="d-inline">
                                        <!--d-inline agar menjadi satu baris dengan botton lainnya-->
                                        <?= csrf_field(); ?>
                                        <input type="hidden" value="<?= $item['id']; ?>" name="id_edit">
                                        <button type="submit" class="btn btn-primary">Edit</button>
                                    </form>

                                    <form action="/buku/delete" method="post" class="d-inline">
                                        <!--d-inline agar menjadi satu baris dengan botton lainnya-->
                                        <?= csrf_field(); ?>
                                        <input type="hidden" value="<?= $item['id']; ?>" name="id_delete">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin akan menghapus data?')">Hapus</button>
                                    </form>

                                </td>
                                
                            </tr>
                            <?php $no++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>



            </div>
        </div>

    </div>
</div>


<?= $this->endSection() ?>