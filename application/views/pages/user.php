     <!-- Begin Page Content -->

     <div class="container-fluid" id="div_form">
         <!-- Page Heading -->
         <h1 class="h3 mb-4 text-gray-800">User</h1>
         <div class="row">
             <div class="col-md-12">

                 <form id="form_id" name="form_id" enctype="multipart/form-data">
                     <div class="card shadow mb-4">
                         <div class="card-header font-weight-bold text-primary">
                             Add User
                         </div>
                         <div class="card-body">
                             <input type="hidden" name="uuid" id="uuid" value="" />
                      
                     


                             <div class="row">
                                 <div class="col-md-4 form-group">
                                     <div class="mb-2"><label class="form-label">Email<span class="text-danger">*</span></label>
                                         <input type="email" class="form-control" id="email" name="email">
                                     </div>
                                 </div>
                                 <div class="col-md-4 form-group">
                                     <div class="mb-2"><label class="form-label">Password<span class="text-danger">*</span></label>
                                     <i id="showpass" class="fas fa-eye font-size-16" onclick="showPassword()" style="cursor: pointer;"></i>
                                         <input type="password" class="form-control" id="password" name="password">
                                         
                                     </div>
                                 </div>
                                 <div class="col-md-4 form-group">
                                     <div class="mb-2"><label class="form-label">Employee<span class="text-danger">*</span></label>
                                    <select class="form-control" name="employee_id" id="employee_id"></select>
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
                         <h6 class="m-0 font-weight-bold text-primary">List of Users</h6>
                     </div>
                     <div class="col-md-6 text-right">
                         <button type="button" class="btn btn-sm btn-primary" id="btn_add" onClick="formReset('show')">
                             <i class="fas fa-plus font-size-16 mr-1"></i> Add User
                         </button>

                     </div>
                 </div>


             </div>
             <div class="card-body">
                 <div class="table-responsive">
                     <table class="table table-bordered" id="data-table" width="100%" cellspacing="0">
                         <thead>
                             <tr>
                                 <th>Employee</th>
                                 <th>Email</th>
                                 <th>created_by</th>
                                 <th>Status</th>
                                 <th>created_at</th>
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

     <script src="<?= base_url('assets') ?>/js/user_management/user.js"></script>