     <!-- Begin Page Content -->

     <div class="container-fluid" id="div_form">
         <!-- Page Heading -->
         <h1 class="h3 mb-4 text-gray-800">Department</h1>
         <div class="row">
             <div class="col-md-12">

                 <form id="form_id" name="form_id">
                     <div class="card shadow mb-4">
                         <div class="card-header font-weight-bold text-primary">
                             Add Department
                         </div>
                         <div class="card-body">
                             <input type="hidden" name="uuid" id="uuid" value="" />
                             <div class="row">
                                 <div class="col-md-4 form-group">
                                     <div class="mb-3"><label class="form-label">Department Name<span class="text-danger">*</span></label>
                                         <input type="text" class="form-control" id="department_name" name="department_name">
                                     </div>
                                 </div>
                                 <div class="col-md-4 form-group">
                                     <div class="mb-3"><label class="form-label">Department Contact Number<span class="text-danger">*</span></label>
                                         <input type="number" class="form-control" id="department_contact_no" name="department_contact_no">
                                     </div>
                                 </div>
                                 <div class="col-md-4 form-group">
                                     <div class="mb-3"><label class="form-label">Department Head<span class="text-danger">*</span></label>
                                         <input type="text" class="form-control" id="department_head" name="department_head">
                                     </div>
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
                         <h6 class="m-0 font-weight-bold text-primary">List of Departments</h6>
                     </div>
                     <div class="col-md-6 text-right">
                         <button type="button" class="btn btn-sm btn-primary" id="btn_add" onClick="formReset('show')">
                             <i class="fas fa-plus font-size-16 mr-1"></i> Add Department
                         </button>

                     </div>
                 </div>


             </div>
             <div class="card-body">
                 <div class="table-responsive">
                     <table class="table table-bordered" id="data-table" width="100%" cellspacing="0">
                         <thead>
                             <tr>
                                 <th>Department Name</th>
                                 <th>Contact No</th>
                                 <th>Department Head</th>
                                 <th>Status</th>
                                 <th>Created At</th>
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

     <script src="<?= base_url('assets') ?>/js/department/department.js"></script>