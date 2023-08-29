<?= $this->extend('layouts/matrix') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col">

        <div class="card">
            <div class="card-body">
                <h3 class="card-titte">Edit Data Buku</h3><br>

                <form action="/buku/proses_edit" method="POST" enctype="multipart/form-data">
                    <!-- Fitur Keamanan Form - Cross site request forgery -->
                    <?= csrf_field(); ?>

                    <div class="row mb-3">
                        <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" value="<?= old('judul') ? old('judul') : $item['judul']; ?>" autofocus>
                            <div id="judulFeedback" class="invalid-feedback">
                                <?= $validation->getError('judul'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="pengarang" class="col-sm-2 col-form-label">Pengarang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pengarang" name="pengarang" value="<?= old('pengarang') ? old('pengarang') : $item['pengarang']; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= old('penerbit') ? old('penerbit') : $item['penerbit']; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="jumlah_halaman" class="col-sm-2 col-form-label">Jumlah Halaman</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="jumlah_halaman" name="jumlah_halaman" value="<?= old('jumlah_halaman') ? old('jumlah_halaman') : $item['jumlah_halaman']; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="sampul" name="sampul" value="<?= old('sampul') ? old('sampul') : $item['sampul']; ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="jumlah_halaman" class="col-sm-2 col-form-label">Sampul Saat Ini</label>
                        <div class="col-sm-3">
                            <img src="/images/<?= $item['sampul']; ?>" alt="image" class="img-thumbnail" width="100px">
                        </div>
                    </div>

                    <input type="hidden" value="<?= $item['sampul']; ?>" name="sampul_old">
                    <input type="hidden" value="<?= $item['id']; ?>" name="id_edit">
                    <button type="submit" class="btn btn-primary">Update Data</button>
                </form>

            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>