document.addEventListener('DOMContentLoaded', function () {
    let form = document.getElementById('purchaseForm');
    let paymentSelect = document.getElementById('payment');
    let postalCodeInput = document.getElementById('postal_code');
    let addressInput = document.getElementById('address');
    let buildingInput = document.getElementById('building');
    let deliveryAddressHidden = document.getElementById('delivery_address');
    let selectedPaymentDisplay = document.getElementById('selected-payment');

    paymentSelect.addEventListener('change', function () {
        selectedPaymentDisplay.textContent = paymentSelect.value;
    });

    form.addEventListener('submit', function (event) {
        let postalCode = postalCodeInput.value.trim();
        let address = addressInput.value.trim();
        let building = buildingInput.value.trim();

        let fullAddress = postalCode + ' ' + address;
        if (building) {
            fullAddress += ' ' + building;
        }

        deliveryAddressHidden.value = fullAddress;

    });
});

function removePlaceholderOption(select) {
    let firstOption = select.options[0];
    if (firstOption.value === "") {
        select.remove(0);
    }
}
