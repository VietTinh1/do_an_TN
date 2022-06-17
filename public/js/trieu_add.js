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
});