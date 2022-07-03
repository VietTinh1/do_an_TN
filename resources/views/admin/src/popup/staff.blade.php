<div class="modal fade" id="modalStaff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding: 25px 0px 25px 0px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="margin-left:30%;color:red;font-size:25px;">Chi tiết nhân viên</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background-color:#ccc;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="modal-body" method="post" action="" id="editProvided" name="editProvided">
                @csrf
                <div class="container-fluid">
                    <div class="form-group col-md-12">
                        <label class="control-label">Mã nhân viên</label>
                        <input class="form-control" type="text" id="account_id" required readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Họ tên</label>
                        <input class="form-control" type="text" id="fullname" required readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Giới tính</label>
                        <input class="form-control" type="text" id="sex" required readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Ngày sinh</label>
                        <input class="form-control" type="date" id="birthday" required readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Email</label>
                        <input class="form-control" type="text" id="email" required readonly>
                    </div>
                    <div class="form-group  col-md-12">
                        <label class="control-label">CCCD</label>
                        <input class="form-control" type="number" id="citizen_ID" required readonly>
                    </div>
                    <div class="form-group  col-md-12">
                        <label class="control-label">Số điện thoại</label>
                        <input class="form-control" type="number" id="phone" required readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Địa chỉ</label>
                        <input class="form-control" type="text" id="address" required readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Quyền</label>
                        <input class="form-control" type="text" id="permission" required readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Tình Trạng</label>
                        <input class="form-control" type="text" id="status" readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Ngày tạo</label>
                        <input class="form-control" type="date" id="created_at" readonly>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
