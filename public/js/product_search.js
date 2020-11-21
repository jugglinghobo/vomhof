(function() {

  var autocompleteProducts = function(e) {
    var search = $(this);
    var input = search.val();
    if (input.length > 0) {
      var url = search.data('url');
      $.ajax({
        url: url,
        data: {q: input},
        type: 'GET',
        dataType: 'json',
        success: renderProductSearchResults,
      })
      showProductResultContainer();
    } else {
      emptyProductResultContainer();
      hideProductResultContainer();
    }
  }

  var renderProductSearchResults = function(results, status) {
    var results = JSON.parse(results);
    var resultContent = "";
    if (results.length > 0) {
      for(result_index in results) {
        var result = results[result_index];
        var productInfo;
        if (result.identifier == '') {
          productInfo = `${result.name}`
        } else {
          productInfo = `${result.identifier} | ${result.name}`
        }
        var dataAttributes = `data-product=${btoa(JSON.stringify(result))}`
        resultContent = resultContent + `<div class='product-result search-result' ${dataAttributes}>${productInfo}</div>`
      }
    } else {
      resultContent = "<div>Keine Produkte gefunden</div>"
    }
    $('#product-search-results').html(resultContent);
  }

  var addInvoiceItem = function() {
    hideProductResultContainer();
    emptyProductSearchInput();
    removeOtherNewItemStates();
    var product = JSON.parse(atob($(this).data('product')))
    if ($("#invoice-item-"+product.id).length == 0) {
      var item = invoiceItem(product);
      debugger;
      $("#invoice-items").append(item);
    } else {
      $("#invoice-item-"+product.id).removeClass('deleted');
    }
    row = $(".invoice-items").find("#invoice-item-"+product.id+"");
    row.addClass('new-item');
  }

  var emptyProductSearchInput = function() {
    $("#product-search").val("");
  }

  var emptyProductResultContainer = function() {
    $("#product-search-results").empty();
  }

  var showProductResultContainer = function() {
    $('#product-search-results').removeClass('d-none');
  }

  var hideProductResultContainer = function() {
    $('#product-search-results').addClass('d-none');
  }

  var removeOtherNewItemStates = function() {
    $(".invoice-items .invoice-item").removeClass('new-item');
  }

  var invoiceItem = function(product) {
    var prototype = $("#invoice-items").data('prototype');
    var invoiceItemHTML =
      `<tr class="invoice-item" id="invoice-item-${product.id}">` +
      `<td class="col-md-1 delete-action"><a class="fa fa-times delete-item" href="#"></a></td>` +
      `<td class="col-md-1 identifier">${product.identifier}</td>` +
      `<td class="col-md-4 name">${product.name}</td>` +
      `<td class="col-md-1 quantity text-right form-group">` +
      `<input type="hidden" name="invoice[invoice_items_attributes][${product.id}][product_id]" id="invoice_invoice_items_attributes_${product.id}_product_id" value="${product.id}"</input>` +
      `<input type="text" name="invoice[invoice_items_attributes][${product.id}][quantity]" id="invoice_invoice_items_attributes_${product.id}_quantity" class="quantity_input form-control text-right">` +
      `</td>` +
      `<td class="col-md-1 price">` +
      `<input type="text" name="invoice[invoice_items_attributes][${product.id}][price]" value="${product.price_f}" id="invoice_invoice_items_attributes_${product.id}_price" class="price_input form-control text-right">` +
      `</td>` +
      `<td class="col-md-2 total-price text-right">0</td>` +
      `</tr>`
    return prototype;
  }

  $(document).ready(function() {
    $("#product-search").on('keyup', autocompleteProducts);
    $("#product-search").focus(showProductResultContainer).blur(hideProductResultContainer);

    $("#invoice-form").off('mousedown', addInvoiceItem)
    $("#invoice-form").on('mousedown', '.product-result', addInvoiceItem)
  });
})();
