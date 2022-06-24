<div class="modal fade" id="modalProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding: 25px 0px 25px 0px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="margin-left:26%;color:red;font-size:25px;">Chi tiết sản phẩm nhập</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background-color:#ccc;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="modal-body" method="post" action="" id="editProvided" name="editProvided">
                @csrf
                <div class="container-fluid">
                    <div class="form-group col-md-12">
                        <label class="control-label">Nhân viên thêm</label>
                        <input class="form-control" type="text" id="account_id" required readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Hãng sản xuất</label>
                        <input class="form-control" type="text" id="trademark" required readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Tên sản phẩm</label>
                        <input class="form-control" type="text" id="name" required readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Loại sản phẩm</label>
                        <input class="form-control" type="text" id="product_type_id" required readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Mã sản phẩm</label>
                        <input class="form-control" type="text" id="product_code" readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Mô tả</label>
                        <input class="form-control" type="text" id="describe" required readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Số lượng</label>
                        <input class="form-control" type="text" id="amount" readonly readonly>
                    </div>
                    <div class="form-group  col-md-12">
                        <label class="control-label">Giá(VND)</label>
                        <input class="form-control" type="number" id="price" required readonly>
                    </div>
                    <div class="form-group  col-md-12">
                        <label class="control-label">Khuyến mãi</label>
                        <input class="form-control" type="number" id="sale" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Thời gian bảo hành</label>
                        <input class="form-control" type="number" id="time_warranty" readonly readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Thuế</label>
                        <input class="form-control" type="text" id="tax" required readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Đánh giá</label>
                        <input class="form-control" type="text" id="so_sao" readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Tình Trạng</label>
                        <input class="form-control" type="text" id="status" readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Ngày tạo</label>
                        <input class="form-control" type="text" id="createdat" readonly>
                    </div>
                    {{-- <div class="form-group col-md-12">
                        <label class="control-label">Tên sản phẩm</label>
                        <img src="{{ url('storage/'.$invoiceProvides->image_url) }}" alt="" title="" width="100px" />
                </div> --}}
                <div class="form-group col-md-12">
                    <label class="control-label">Loại sản phẩm</label>
                    <input class="form-control" type="text" id="product_type_id" required readonly>

                </div>
                <div class="form-group col-md-12">
                    <label class="control-label">Mã sản phẩm</label>
                    <input class="form-control" type="text" id="product_code" readonly>
                </div>
                <div class="form-group col-md-12">
                    <label class="control-label">Mô tả</label>
                    <input class="form-control" type="text" id="describe" required readonly>
                </div>
                <div class="form-group col-md-12">
                    <label class="control-label">Số lượng</label>
                    <input class="form-control" type="text" id="amount" readonly>
                </div>
                <div class="form-group  col-md-12">
                    <label class="control-label">Giá(VND)</label>
                    <input class="form-control" type="number" id="price" required readonly>
                </div>
                <div class="form-group  col-md-12">
                    <label class="control-label">Khuyến mãi</label>
                    <input class="form-control" type="number" id="sale" required readonly>
                </div>
                <div class="form-group col-md-12">
                    <label class="control-label">Thời gian bảo hành</label>
                    <input class="form-control" type="number" id="time_warranty" readonly>
                </div>
                <div class="form-group col-md-12">
                    <label class="control-label">Thuế</label>
                    <input class="form-control" type="text" id="tax" required readonly>
                </div>
                <div class="form-group col-md-12">
                    <label class="control-label">Đánh giá</label>
                    <input class="form-control" type="text" id="so_sao" readonly>
                </div>
                <div class="form-group col-md-12">
                    <label class="control-label">Tình Trạng</label>
                    <input class="form-control" type="text" id="status" readonly>
                </div>
                <div class="form-group col-md-12">
                    <label class="control-label">Ngày tạo</label>
                    <input class="form-control" type="text" id="createdat" readonly>
                </div>
        </div>

        </form>
    </div>
</div>
</div>