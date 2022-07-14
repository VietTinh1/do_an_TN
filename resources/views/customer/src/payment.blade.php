    @extends('customer.layout')
    @section('content')
    <div style="padding-left: 10%;padding-right: 10%;padding-top:30px;padding-bottom:30px;">
        <form action="{{ route('postPaymentCustomer') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name_customer">Nhập tên</label>
                <input type="text" class="form-control" id="name_customer" name="name_customer" required>
            </div>
            <div class="form-group">
            <label for="email_customer">Nhập email</label>
            <input type="email" class="form-control" id="email_customer" name="email_customer" required>
            </div>
            <div class="form-group">
            <label for="phone">Nhập số điện thoại</label>
            <input type="number" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="address_customer">Nhập địa chỉ</label>
                <input type="text" class="form-control" id="address_customer" name="address_customer" required>
            </div>
            <div class="form-group">
                <label for="message">Nhập yêu cầu(nếu có)</label>
                <textarea class="form-control" id="message" name="message"></textarea>
            </div>
            <div class="form-group">
                <label for="#">Chọn phương thức thanh toán</label>
                <select class="form-control" id="exampleSelect1" name="card_type" required>
                    <option value="Trực tiếp tại nhà">Trực tiếp tại nhà</option>
                </select>
            </div>
            <div class="modal-body">
                    <table class="show-cart table">

                    </table>
                    <div>Tổng tiền: <span class="total-cart" name="total"></span>&nbsp;VND</div>
            </div>
            <button type="submit" class="btn btn-primary">Thanh Toán</button>
        </form>
    </div>
    @endsection
