$(document).ready(function() {
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var tax_code = button.data('taxcode')
        var name = button.data('name')
        var email = button.data('email')
        var phone = button.data('phone')
        var address = button.data('address')
        var notes = button.data('notes')
        var status = button.data('status')
        var createdat = button.data('createdat')
        var modal = $(this)
        modal.find('.modal-body #tax_code').val(tax_code);
        modal.find('.modal-body #name').val(name);
        modal.find('.modal-body #email').val(email);
        modal.find('.modal-body #phone').val(phone);
        modal.find('.modal-body #address').val(address);
        modal.find('.modal-body #notes').val(notes);
        modal.find('.modal-body #status').val(status);
        modal.find('.modal-body #created_at').val(createdat);
    });
    // https://stackoverflow.com/questions/68482194/how-to-get-url-id-for-posting-ajax-to-controller
    $('#modalInvoiceProvided').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var provided_id = button.data('provided-id')
        var account_id = button.data('account-id')
        var total = button.data('total')
        var amount = button.data('amount')
        var status = button.data('status')
        var import_price = button.data('import-price')
        var describe = button.data('describe')
        var createdat = button.data('created-at')
        var modal = $(this)
        modal.find('.modal-body #provided_id').val(provided_id);
        modal.find('.modal-body #account_id').val(account_id);
        modal.find('.modal-body #total').val(total);
        modal.find('.modal-body #amount').val(amount);
        modal.find('.modal-body #import_price').val(import_price);
        modal.find('.modal-body #status').val(status);
        modal.find('.modal-body #describe').val(describe);
        modal.find('.modal-body #created_at').val(createdat);
    });
    //
    $('#modalProduct').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var account_id = button.data('account-id')
        var trademark = button.data('trademark')
        var name = button.data('name')
        var product_type_id = button.data('product-type-id')
        var product_code = button.data('product-code')
        var describe = button.data('describe')
        var time_warranty = button.data('time-warranty')
        var amount = button.data('amount')
        var price = button.data('price')
        var sale = button.data('sale')
        var tax = button.data('tax')
        var so_sao = button.data('so-sao')
        var status = button.data('status')
        var createdat = button.data('createdat')
        var modal = $(this)
        modal.find('.modal-body #account_id').val(account_id);
        modal.find('.modal-body #trademark').val(trademark);
        modal.find('.modal-body #name').val(name);
        modal.find('.modal-body #product_type_id').val(product_type_id);
        modal.find('.modal-body #product_code').val(product_code);
        modal.find('.modal-body #describe').val(describe);
        modal.find('.modal-body #time_warranty').val(time_warranty);
        modal.find('.modal-body #amount').val(amount);
        modal.find('.modal-body #price').val(price);
        modal.find('.modal-body #sale').val(sale);
        modal.find('.modal-body #tax').val(tax);
        modal.find('.modal-body #so_sao').val(so_sao);
        modal.find('.modal-body #describe').val(describe);
        modal.find('.modal-body #status').val(status);
        modal.find('.modal-body #createdat').val(createdat);
    });
    $('#modalStaff').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var account_id = button.data('account-id')
        var fullname = button.data('fullname')
        var sex = button.data('sex')
        var birthday = button.data('birthday')
        var citizen_ID = button.data('citizenid')
        var address = button.data('address')
        var phone = button.data('phone')
        var email = button.data('email')
        var permission = button.data('permission')
        var status = button.data('status')
        var createdat = button.data('createdat')
        var modal = $(this)
        modal.find('.modal-body #account_id').val(account_id);
        modal.find('.modal-body #fullname').val(fullname);
        modal.find('.modal-body #sex').val(sex);
        modal.find('.modal-body #birthday').val(birthday);
        modal.find('.modal-body #citizen_ID').val(citizen_ID);
        modal.find('.modal-body #address').val(address);
        modal.find('.modal-body #phone').val(phone);
        modal.find('.modal-body #email').val(email);
        modal.find('.modal-body #permission').val(permission);
        modal.find('.modal-body #status').val(status);
        modal.find('.modal-body #created_at').val(createdat);
    });
    //chart index
    let dataChart1 = {
        labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6"],
        data: 'http://127.0.0.1:8000/api/api',
        datasets: [{
                label: "Dữ liệu đầu tiên",
                fillColor: "rgba(255, 213, 59, 0.767), 212, 59)",
                strokeColor: "rgb(255, 212, 59)",
                pointColor: "rgb(255, 212, 59)",
                pointStrokeColor: "rgb(255, 212, 59)",
                pointHighlightFill: "rgb(255, 212, 59)",
                pointHighlightStroke: "rgb(255, 212, 59)",
                data: [48, 48, 49, 39, 86, 10]
            },
            {
                label: "Dữ liệu kế tiếp",
                fillColor: "rgba(9, 109, 239, 0.651)  ",
                pointColor: "rgb(9, 109, 239)",
                strokeColor: "rgb(9, 109, 239)",
                pointStrokeColor: "rgb(9, 109, 239)",
                pointHighlightFill: "rgb(9, 109, 239)",
                pointHighlightStroke: "rgb(9, 109, 239)",
                data: [48, 48, 49, 39, 86, 10]
            }
        ]
    };
    var ctxl = $("#lineChart").get(0).getContext("2d");
    var lineChart = new Chart(ctxl).Line(dataChart1);
    var ctxb = $("#barChart").get(0).getContext("2d");
    var barChart = new Chart(ctxb).Bar(dataChart1);

    //multi select
    $(".product-chosen").chosen({
        no_results_text: "Oops, nothing found!",
    })
});