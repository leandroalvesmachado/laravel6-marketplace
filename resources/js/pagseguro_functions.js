function proccessPayment(token) {
    let data = {
        card_token: token,
        hash: PagSeguroDirectPayment.getSenderHash(),
        installment: document.querySelector('select.select_installments').value,
        card_name: document.querySelector('input[name=card_name]').value,
        _token: csrf
    };

    $.ajax({
        type: "POST",
        url: urlProccess,
        data: data,
        dataType: 'json',
        success: function(res) {
            // alert(res.data.message);
            toastr.success(res.data.message, 'Sucesso');
            // window.location.href = "{{ route('checkout.thanks') }}?order=" + res.data.order;
            window.location.href = `${urlThanks}?order=${res.data.order}`;
        },
        error: function(err) {
            console.log(err);
        },
    });
}

function getInstallments(amount, brand) {
    PagSeguroDirectPayment.getInstallments({
        amount: amount,
        brand: brand,
        maxInstallmentNoInterest: 0,
        success: function(res) {
            let selectInstallments = drawSelectInstallments(res.installments[brand]);
            document.querySelector('div.installments').innerHTML = selectInstallments;
        },
        error: function(err) {
            console.log('getInstallments: ' + err);
        },
        complete: function(res) {
        }
    })
}

function drawSelectInstallments(installments) {
    let select = '<label>Opções de Parcelamento:</label>';

    select += '<select class="form-control select_installments">';

    for(let l of installments) {
        select += `
            <option value="${l.quantity}|${l.installmentAmount}">
                ${l.quantity}x de ${l.installmentAmount} - Total fica ${l.totalAmount}
            </option>
        `;
    }

    select += '</select>';

    return select;
}