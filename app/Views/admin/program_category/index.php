<?= $this->extend('admin/home') ?>
<?= $this->section('content') ?>

<section>
    <div style="w-100%; display: flex; justify-content: space-between;margin-top:10px; margin-left: 10px; margin-right: 10px;" class="mb-4 mt-4">
        <a href="/admin" class="btn btn-light">ተመለስ</a>
        <a href="/admin/program_category/new" class="btn btn-light">አዲስ ፕሮግራም መደብ ይለጥፉ</a>
    </div>
    
    <table class="table table-striped table-hover table-bordered mx-3">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">ርዕስ</th>
      <th scope="col">መግለጫ</th>
       <th scope="col">ምስል</th>
      <th scope="col">አዘምን</th>
      <th scope="col">ሰርዝ</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($program_categories as $program_category) : ?>
      
    <tr>
      <td><?= $program_category['id'] ?></td>
      <td><?= $program_category['title'] ?></td>
      <td><?= $program_category['description'] ?></td>
       <td>  <img src="<?= base_url('images/' . $program_category['photo']) ?>" width="30px" height="30px" alt="Category Image"  style="width: 40px; height: 40px; object-fit: cover;"> </td>
      <td>
        <a href="<?= base_url('/admin/program_category/'.$program_category['id'].'/edit') ?>" class="btn btn-primary">Edit</a>
      </td>
      <td>
        <a class="btn btn-danger" onclick='if(confirm(`Do you want delete this record`)) { document.forms[`form_<?= $program_category["id"] ?>`].submit() }'>Delete</a>
      </td>
    </tr>
 
    <form action='/admin/program_category/<?= $program_category['id'] ?>' method='post' name='form_<?= $program_category['id'] ?>' class="d-none">
      <?= csrf_field() ?>
      <input type='hidden' name='_method' value='DELETE' />
    </form>
      
    <?php endforeach ?>
  </tbody>
</table>
</section>

<?= $this->endSection() ?>