let cardNumber = document.querySelector('input[name=card_number]');
let spanBrand = document.querySelector('span.brand');

cardNumber.addEventListener('keyup', function() {
    if (cardNumber.value.length >= 6) {
        PagSeguroDirectPayment.getBrand({
            cardBin: cardNumber.value.substr(0, 6),
            success: function(res) {
                let imgFlag = `${res.brand.name}`;
                spanBrand.innerHTML = res.brand.name;
                document.querySelector('input[name=card_brand]').value = res.brand.name;

                getInstallments(amountTransaction, res.brand.name);
            },
            error: function(err) {
                console.log('cardNumber.addEventListener ' + err);
            },
            complete: function(res) {
            }
        });
    }
});

let submitButton = document.querySelector('button.processCheckout');
submitButton.addEventListener('click', function(event) {
    // retira o comportamento padrão do elemento
    event.preventDefault();

    PagSeguroDirectPayment.createCardToken({
        cardNumber: document.querySelector('input[name=card_number]').value,
        brand: document.querySelector('input[name=card_brand]').value,
        cvv: document.querySelector('input[name=card_cvv]').value,
        expirationMonth: document.querySelector('input[name=card_month]').value,
        expirationYear: document.querySelector('input[name=card_year]').value,
        success: function(res) {
            proccessPayment(res.card.token);
        },
        error: function(err) {
        },
        complete: function(res) {
        }
    });
});