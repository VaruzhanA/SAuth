class IdeabubblePhone extends HTMLElement {
    input = null;
    hiddenInput = null;
    iti = null;
    connectedCallback()
    {
        let phone = this;

        let input = document.createElement("input");
        phone.input = input;
        input.maxLength = 25;
        input.type = "tel";
        input.classList.add("form-input");
        phone.appendChild(input);

        phone.hiddenInput = document.createElement("input");
        phone.hiddenInput.type = "hidden";
        phone.hiddenInput.name = phone.getAttribute("name");
        phone.parentElement.appendChild(phone.hiddenInput);
        if (phone.hasAttribute("required")) {
            phone.input.setAttribute("required", "required");
            phone.hiddenInput.setAttribute("required", "required");
        }
        if (phone.hasAttribute("readonly")) {
            phone.input.setAttribute("readonly", "readonly");
        }
        if (phone.hasAttribute("disabled")) {
            phone.input.setAttribute("disabled", "disabled");
        }
        if (phone.hasAttribute("placeholder")) {
            phone.input.setAttribute("placeholder", phone.getAttribute("placeholder"));
        }

        phone.iti = intlTelInput(
            input,
            {
                initialCountry: "IE",
                nationalMode: false,
                separateDialCode: true,
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/utils.min.js"
            }
        );

        input.addEventListener(
            "change",
            function(){
                //if (phone.iti.isValidNumber()) {
                    phone.hiddenInput.value = phone.iti.getNumber();
                //} else {
                    //alert("invalid number");
                //}
            }
        );

        // inital value in the html tag
        let val = phone.getAttribute("value");
        if (val !== undefined && val !== null && val !== "") {
            this.iti.setNumber(val);
            this.hiddenInput.value = val;
        }
    }

    get value() {
        return this.iti.getNumber();
    }
    set value(val) {
        this.iti.setNumber(val);
        this.hiddenInput.value = val;
    }

    get country() {
        return this.iti.getSelectedCountryData();
    }

    get isValid()
    {
        //return this.iti.isValidNumber();
        return true;
    }

    // number without country code
    get lnumber() {
        let country = this.iti.getSelectedCountryData();
        let number = this.iti.getNumber();
        let lnumber = number.substr(country.dialCode.length + 1);
        return lnumber;
    }
}
customElements.define('ideabubble-phone', IdeabubblePhone);
