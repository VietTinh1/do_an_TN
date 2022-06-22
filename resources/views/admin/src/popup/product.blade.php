<div class="modal fade" id="modalProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding: 25px 0px 25px 0px;">
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
                        <label class="control-label">Nhân viên thêm</label>
                        <input class="form-control" type="text" id="account_id" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Hãng sản xuất</label>
                        <input class="form-control" type="text"  id="trademark" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Tên sản phẩm</label>
                        <input class="form-control" type="text"  id="name" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Loại sản phẩm</label>
                        <input class="form-control" type="text"  id="product_type_id" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Mã sản phẩm</label>
                        <input class="form-control" type="text"  id="product_code" readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Mô tả</label>
                        <input class="form-control" type="text"  id="describe" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Số lượng</label>
                        <input class="form-control" type="text"  id="amount" readonly>
                    </div>
                    <div class="form-group  col-md-12">
                        <label class="control-label">Giá(VND)</label>
                        <input class="form-control" type="number"  id="price" required>
                    </div>
                    <div class="form-group  col-md-12">
                        <label class="control-label">Khuyến mãi</label>
                        <input class="form-control" type="number"  id="sale" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Thời gian bảo hành</label>
                        <input class="form-control" type="number"   id="time_warranty" readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Thuế</label>
                        <input class="form-control" type="text"  id="tax" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Đánh giá</label>
                        <input class="form-control" type="text"  id="so_sao" readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Tình Trạng</label>
                        <input class="form-control" type="text"  id="status" readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Ngày tạo</label>
                        <input class="form-control" type="text"  id="createdat" readonly>
                    </div>
                </div>
                <div class="modal-footer" style="margin-right:30%;">
                    <button type="submit" class="btn btn-primary save-edit">Lưu lại</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                </div>
            </form>
        </div>
    </div>
</div>
