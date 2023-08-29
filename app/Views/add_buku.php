<?= $this->extend('layouts/matrix') ?>
<?= $this->section('content') ?>


<div class="row">
    <div class="col">

        <div class="card">
            <div class="card-body">
                <h3 class="card-titte">Tambah Data Buku</h3><br>

                <form action="/buku/save" method="POST" enctype="multipart/form-data">
                    <!-- Fitur Keamanan Form - Cross site request forgery -->
                    <?= csrf_field(); ?>

                    <div class="row mb-3">
                        <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" value="<?= old('judul'); ?>" autofocus>
                            <div id="judulFeedback" class="invalid-feedback">
                                <?= $validation->getError('judul'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="pengarang" class="col-sm-2 col-form-label">Pengarang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pengarang" name="pengarang" value="<?= old('pengarang'); ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= old('penerbit'); ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="jumlah_halaman" class="col-sm-2 col-form-label">Jumlah Halaman</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="jumlah_halaman" name="jumlah_halaman" value="<?= old('jumlah_halaman'); ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="sampul" name="sampul" value="<?= old('sampul'); ?>">
                            <div id="judulFeedback" class="invalid-feedback">
                                <?= $validation->getError('sampul'); ?>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </form>

            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>