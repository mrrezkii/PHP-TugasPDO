<?php
$queryExecuteShowStatus = null;
$queryExecuteShowFamily = null;
$dataUpdate = [];
include "transactions/show_status.php";
include "transactions/show_family.php";

?>
<!doctype html>
<html lang="en">
<head>
 <?php include "component/head.php"?>
</head>

<body>
  <main>
    <section class="m-auto" id="no-books">
      <div class="container mt-5">
        <div class="content-page">
          <div class="accordion accordion-flush w-50" id="accordionFlushExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingOne">
                <button class="collapsed btn btn-primary w-50" type="button" data-bs-toggle="collapse"
                  data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                  Tambah Data
                </button>
              </h2>
              <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  <form action="transactions/create_family.php" method="POST">
                    <div class="mb-3">
                      <label for="inputName" class="form-label">Nama</label>
                      <input type="text" class="form-control" id="inputName" aria-describedby="inputNameHelp"
                        name="name" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" name="id_status" required>
                            <option value="" selected disabled>Please select</option>
                            <?php
                            while ($data = mysqli_fetch_array($queryExecuteShowStatus)) {
                                array_push($dataUpdate, $data)
                                ?>
                            <option value="<?= $data['id'] ?>"><?= $data['status'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Tambah</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
            $number = 0;
            while ($data = mysqli_fetch_assoc($queryExecuteShowFamily)) {
                $number++;
            ?>
              <tr class="w-50">
                <th scope="row" class="w-25"><?= $number ?></th>
                <td class="w-25"><?= $data['nama'] ?></td>
                <td class="w-25"><?= $data['status']  ?></td>
                <td class="w-25">
                  <button class="btn btn-warning" type="button" data-bs-toggle="modal"
                    data-bs-target="#updateModal" onclick="btnUpdate('<?=implode(',', $data); ?>')">Update</button>
                    <span>&emsp;&emsp;</span>
                  <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                    data-bs-target="#deleteModal" onclick="btnDelete('<?=implode(',', $data); ?>')">Delete</button>
                </td>
              </tr>

            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- START | Modal Delete -->
      <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <form action="transactions/delete_family.php" method="POST">
            <div class="modal-content">
              <div class="modal-header">
                  <input type="text" class="form-control" id="inputIdModalDelete" aria-describedby="inputIdModalHelp" name="id"
                         required hidden>
                <h5 class="modal-title" id="deleteModalLabel">Yakin ingin menghapus (nama...) ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Delete</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- END | Modal Delete -->
      <!-- START | Modal Update -->
      <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <form action="transactions/update_family.php" method="POST">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update (nama...)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <input type="text" class="form-control" id="inputIdModalUpdate" aria-describedby="inputIdModalHelp" name="id"
                         required hidden>
                <div class="mb-3">
                  <label for="inputNameModal" class="form-label">Nama</label>
                  <input type="text" class="form-control" id="inputNameModal" aria-describedby="inputNameHelp" name="name" autocomplete="off"
                    required>
                </div>
                <div class="mb-3">
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" name="id_status" required>
                            <option value="" selected disabled>Please select</option>
                            <?php
                            foreach ($dataUpdate as $data) {
                                ?>
                                <option id="<?= $data['status'] ?>" value="<?= $data['id'] ?>"><?= $data['status'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-warning">Update</button>
                </div>
              </div>
          </form>
        </div>
      </div>
      <!-- END | Modal Update -->

    </section>

  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
<script type="text/javascript">
    function btnUpdate(arr){
        const data = arr.split(",")
        document.getElementById("updateModalLabel").innerText = "Update "+ data[1];
        document.getElementById("inputIdModalUpdate").value = data[0];
        document.getElementById("inputNameModal").value = data[1];
        document.getElementById(data[2]).selected = true;
        console.log(data);
    }
    function btnDelete(arr){
        const data = arr.split(",")
        document.getElementById("deleteModalLabel").innerText = "Yakin ingin menghapus "+ data[1] +" ?";
        document.getElementById("inputIdModalDelete").value = data[0];
        document.getElementById(data[2]).selected = true;
        console.log(data);
    }
</script>
</body>

</html>