<?= $this->extend('admin/home') ?>
<?= $this->section('content') ?>

<div class="container-fluid px-4">

    <div style="w-100%; display: flex; justify-content: space-between;margin-top:10px; margin-left: 10px; margin-right: 10px;"
        class="mb-4 mt-4">
        <a href="/admin" class="btn btn-light">ተመለስ</a>
        <a href="/admin/news/new" class="btn btn-light">አዲስ ዜና ይለጥፉ</a>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            የዜና ዝርዝር
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>ርዕስ</th>
                        <th>የዜና ምድብ</th>
                        <th>ምስል</th>
                        <th>አዘምን</th>
                        <th>ሰርዝ</th>

                    </tr>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ርዕስ</th>
                        <th>የዜና ምድብ</th>
                        <th>ምስል</th>
                        <th>አዘምን</th>
                        <th>ሰርዝ</th>
                    </tr>
                </tfoot>
                <tbody>

                    <?php foreach ($news as $news_data): ?>
                        <tr>
                            <td class="col"><?= $news_data['title'] ?></td>
                            <td><?= $news_data['category_title'] ?></td>
                            <td> <img src="<?= base_url('images/' . $news_data['photo']) ?>" width="30px" height="30px"
                                    alt="Category Image" style="width: 40px; height: 40px; object-fit: cover;"></td>
                            <td>
                                <a href="<?= base_url('/admin/news/' . $news_data['id'] . '/edit') ?>"
                                    class="btn btn-primary">Edit</a>
                            </td>
                            <td>
                                <a class="btn btn-danger"
                                    onclick='if(confirm(`Do you want delete this record`)) { document.forms[`form_<?= $news_data["id"] ?>`].submit() }'>Delete</a>
                            </td>
                        </tr>

                        <form action='/admin/news/<?= $news_data['id'] ?>' method='post' name='form_<?= $news_data['id'] ?>'
                            class="d-none">
                            <?= csrf_field() ?>
                            <input type='hidden' name='_method' value='DELETE' />
                        </form>

                    <?php endforeach ?>


                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>