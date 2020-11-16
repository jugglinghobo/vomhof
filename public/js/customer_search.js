(function() {

  var autocompleteCustomers = function(e) {
    var search = $(this);
    var input = search.val();
    if (input.length > 2) {
      var url = search.data('url');
      $.ajax({
        url: url,
        data: {q: input},
        type: 'GET',
        dataType: 'json',
        success: renderCustomerSearchResults
      })
    } else {
      emptyProductResultContainer();
      hideCustomerResultContainer();
    }
  }

  var renderCustomerSearchResults = function(results, status) {
    results = JSON.parse(results);
    var resultContent = "";
    if (results.length > 0) {
      for(result_index in results) {
        var result = results[result_index];
        var customerInfo = `${result.name}, ${result.address1}`
        var dataAttributes = `data-customer=${btoa(JSON.stringify(result))}`
        resultContent = resultContent + `<div class='customer-result search-result' ${dataAttributes}>${customerInfo}</div>`
      }
    } else {
      resultContent = "<div>Keine Kunden gefunden</div>"
    }
    resultContent = resultContent + "<div class='new-customer-link'><a href='/admin/customers/new'>Neuer Kunde registrieren?</a></div>"
    $('#customer-search-results').html(resultContent);
    showCustomerResultContainer();
  }

  var fillCustomerInfo = function() {
    hideCustomerResultContainer();
    var customer = JSON.parse(atob($(this).data('customer')));
    // TODO: add customer relation
    // $("#order_customer_id").val(customer.id);
    $("#invoice_firstName").val(customer.firstName);
    $("#invoice_lastName").val(customer.lastName);
    $("#invoice_company").val(customer.company);
    $("#invoice_address1").val(customer.address1);
    $("#invoice_address2").val(customer.address2);
    $("#invoice_zipCode").val(customer.zipCode);
    $("#invoice_city").val(customer.city);
    $("#invoice_phone").val(customer.phone);
    $("#invoice_email").val(customer.email);
    $("#invoice_paidCash").prop('checked', customer.paidCash)
  }

  var redirectToNewCustomerForm = function() {
    var url = $(this).find('a').attr('href');
    window.location.href = url;
  }

  var emptyProductResultContainer = function() {
    $("#customer-search-results").empty();
  }

  var showCustomerResultContainer = function() {
    $('#customer-search-results').removeClass('d-none');
  }

  var hideCustomerResultContainer = function() {
    $('#customer-search-results').addClass('d-none');
  }

  $(document).ready(function() {
    $("#customer-search").on('keyup', autocompleteCustomers);


    $("#invoice-form").off('mousedown', fillCustomerInfo);
    $("#invoice-form").on('mousedown', '.customer-result', fillCustomerInfo);

    $("#customer-search").focus(showCustomerResultContainer).focusout(hideCustomerResultContainer);
    $("#customer-search-results").off('mousedown', redirectToNewCustomerForm);
    $("#customer-search-results").on('mousedown', '.new-customer-link', redirectToNewCustomerForm);
  });
})();
