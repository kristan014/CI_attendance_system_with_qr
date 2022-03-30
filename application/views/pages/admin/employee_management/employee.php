     <!-- Begin Page Content -->

     <div class="container-fluid" id="div_form">
         <!-- Page Heading -->
         <h1 class="h3 mb-4 text-gray-800">Employee</h1>
         <div class="row">
             <div class="col-md-12">

                 <form id="form_id" name="form_id" enctype="multipart/form-data">
                     <div class="card shadow mb-4">
                         <div class="card-header font-weight-bold text-primary">
                             Add Employee
                         </div>
                         <div class="card-body">
                             <input type="hidden" name="uuid" id="uuid" value="" />
                             <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <img src="https://avatars.dicebear.com/api/bottts/smile.svg" alt=""
                                            class="rounded avatar-lg img-thumbnail" style="height:150px; width:150px;"
                                            id="photo_path_placeholder" name="photo_path_placeholder">

                                    </div>
                                    <div class="mb-3">
                                        <label for="photo" class="form-label">Profile Picture</label>
                                        <input class="form-control" type="file" id="photo" name="photo"
                                            accept="image/*">
                                            
                                    </div>
                                </div>
                            </div>

                             <div class="row">
                                 <div class="col-md-3 form-group">
                                     <div class="mb-2"><label class="form-label">First Name<span class="text-danger">*</span></label>
                                         <input type="text" class="form-control" id="first_name" name="first_name">
                                     </div>
                                 </div>
                                 <div class="col-md-3 form-group">
                                     <div class="mb-2"><label class="form-label">Middle Name</label>
                                         <input type="text" class="form-control" id="middle_name" name="middle_name">
                                     </div>
                                 </div>
                                 <div class="col-md-3 form-group">
                                     <div class="mb-2"><label class="form-label">Last Name<span class="text-danger">*</span></label>
                                         <input type="text" class="form-control" id="last_name" name="last_name">
                                     </div>
                                 </div>

                                 <div class="col-md-3 form-group">
                                     <div class="mb-2"><label class="form-label">Extension Name</label>
                                         <input type="text" class="form-control" id="extension_name" name="extension_name">
                                     </div>
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-md-3 form-group">
                                     <div class="mb-2"><label class="form-label">Email<span class="text-danger">*</span></label>
                                         <input type="text" class="form-control" id="email" name="email">
                                     </div>
                                 </div>
                                 <div class="col-md-3 form-group">
                                     <div class="mb-2"><label class="form-label">Cellphone Number<span class="text-danger">*</span></label>
                                         <input type="number" class="form-control" id="cellphone_no" name="cellphone_no">
                                     </div>
                                 </div>
                                 <div class="col-md-3 form-group">
                                     <div class="mb-2"><label class="form-label">Nationality<span class="text-danger">*</span></label>
                                         <input type="text" class="form-control" id="nationality" name="nationality">
                                     </div>
                                 </div>

                                 <div class="col-md-3 form-group">
                                     <div class="mb-2"><label class="form-label">Gender<span class="text-danger">*</span></label>
                                         <select class="form-control" id="gender" name="gender">
                                             <option value="Male">Male</option>
                                             <option value="Female">Female</option>

                                         </select>
                                     </div>
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="col-md-4 form-group">
                                     <div class="mb-2"><label class="form-label">Birhtdate<span class="text-danger">*</span></label>
                                         <input type="date" class="form-control" id="birth_date" name="birth_date">
                                     </div>
                                 </div>
                                 <div class="col-md-4 form-group">
                                     <div class="mb-2"><label class="form-label">Date Hired<span class="text-danger">*</span></label>
                                         <input type="date" class="form-control" id="date_hired" name="date_hired">
                                     </div>
                                 </div>
                                 <div class="col-md-4 form-group">
                                     <div class="mb-2"><label class="form-label">Job Title<span class="text-danger">*</span></label>
                                          <select class="form-control" id="job_title_id" name="job_title_id"></select>

                                     </div>
                                 </div>

                            
                             </div>
                             <div class="row">
                                 <div class="col-md-12">
                                 <label class="form-label">Address<span class="text-danger">*</span></label>
                                     <textarea name="address" id="address" class="form-control"></textarea>
                                 </div>
                             </div>


                         </div>
                         <div class="card-footer text-right">
                             <button type="reset" class="btn btn-secondary" onClick="return formReset('hide')">Cancel</button>
                             <button type="submit" class="btn btn-primary submit">Submit</button>

                         </div>
                     </div>
                 </form>
             </div>
         </div>
     </div>

     <div class="container-fluid">
         <!-- DataTales Example -->
         <div class="card shadow mb-4">
             <div class="card-header py-3">
                 <div class="row">
                     <div class="col-md-6">
                         <h6 class="m-0 font-weight-bold text-primary">List of Employees</h6>
                     </div>
                     <div class="col-md-6 text-right">
                         <button type="button" class="btn btn-sm btn-primary" id="btn_add" onClick="formReset('show')">
                             <i class="fas fa-plus font-size-16 mr-1"></i> Add Employee
                         </button>

                     </div>
                 </div>


             </div>
             <div class="card-body">
                 <div class="table-responsive">
                     <table class="table table-bordered" id="data-table" width="100%" cellspacing="0">
                         <thead>
                             <tr>
                                 <th>Employee Name</th>
                                 <th>Job Title</th>
                                 <th>Gender</th>
                                 <th>Birthdate</th>
                                 <th>Status</th>
                                 <th>Action</th>

                             </tr>
                         </thead>

                         <tbody>

                         </tbody>
                     </table>
                 </div>
             </div>
         </div>

     </div>
     <!-- /.container-fluid -->

     <script src="<?= base_url('assets') ?>/js/employee/employee.js"></script>