<?php require_once ("./layout/header.php") ?>
          <h3>Dashboard</h3>

          <div class="row">
            <div class="col-3 ">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-end">
                      <i class="bi bi-people card-icon me-5"></i>
                      <div>
                          <h2><?= count(get_all_student($mysqli)->fetch_all());?></h2>
                          <p>Students</p>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-3 ">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-end">
                    <i class="bi bi-mortarboard card-icon teacher-icon me-5"></i>
                      <div>
                          <h2><?= count(get_all_teacher($mysqli)->fetch_all());?></h2>
                          <p>Teachers</p>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-3 ">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-end">
                    <i class="bi bi-bank card-icon class-icon  me-5"></i>
                      <div>
                        <h2><?= count(get_all_class($mysqli)->fetch_all());?></h2>
                          <p>Class</p>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-3 ">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-end">
                    <i class="bi bi-book card-icon me-5"></i>
                      <div>
                        <h2><?= count(get_all_batch($mysqli)->fetch_all());?></h2>
                          <p>Batch</p>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
<?php require_once ("./layout/footer.php") ?>       