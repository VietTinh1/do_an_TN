<div class="modal fade" id="modalInvoiceProvided" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding: 25px 0px 25px 0px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="margin-left:35%;color:red;font-size:25px;">Chi tiết nhà cung cấp</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background-color:#ccc;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="modal-body" method="post" action="" id="editProvided" name="editProvided">
                @csrf
                <div class="container-fluid">
                    <div class="form-group col-md-12">
                        <label class="control-label">Mã nhà cung cấp</label>
                        <input class="form-control" type="number" id="provided_id" required readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Nhân viên thêm</label>
                        <input class="form-control" type="text" id="account_id" required readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Tổng tiền</label>
                        <input class="form-control" type="number" id="total" required readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Số lượng</label>
                        <input class="form-control" type="number" id="amount" required readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Giá nhập</label>
                        <textarea class="form-control" type="text" id="import_price" required readonly></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Tình Trạng</label>
                        <input class="form-control" type="text" id="status" readonly readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Mô tả</label>
                        <textarea class="form-control" type="text" id="describe" readonly></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Ngày tạo</label>
                        <input class="form-control" type="text" id="created_at" readonly>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>