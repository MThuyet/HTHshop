const registerForm = document.querySelector(".register__container form");
const inputs = {
    username: registerForm.querySelector('input[name="username"]'),
    phoneNumber: registerForm.querySelector('input[name="phoneNumber"]'),
    email: registerForm.querySelector('input[name="email"]'),
    password: registerForm.querySelector('input[name="password"]'),
};

const patterns = {
    name: /^[A-Za-zÀ-ỹ ]+$/,
    phoneNumber: /^0[0-9]{9,10}$/,
    email: /^[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$/,
};

const validationRules = {
    username: [
        {
            test: (value) => !!value.trim(),
            message: "Tên tài khoản không được để trống",
            action: (input) => {
                input.value = "";
            },
        },
        {
            test: (value) => value.length >= 4 && value.length <= 25,
            message: "Họ phải dài từ 4 đến 25 kí tự",
        },
    ],
    phoneNumber: [
        {
            test: (value) => !!value.trim(),
            message: "Số điện thoại không được để trống",
        },
        {
            test: (value) => !patterns.name.test(value),
            message: "Số điện thoại không được chứa kí tự",
            action: (input) => {
                input.value = "";
            },
        },
        {
            test: (value) => patterns.phoneNumber.test(value),
            message: "Số điện thoại phải bắt đầu bằng 0 và gồm 10-11 chữ số",
        },
    ],
    email: [
        {
            test: (value) => !!value.trim(),
            message: "Email không được để trống",
            action: (input) => {
                input.value = "";
            },
        },
        {
            test: (value) => patterns.email.test(value),
            message: "Email không hợp lệ",
        },
        {
            test: (value) => value.length <= 254,
            message: "Độ dài email tối đa chỉ được dưới 255 kí tự",
        },
    ],
    password: [
        {
            test: (value) => !!value.trim(),
            message:
                "Mật khẩu không được để trống và không được chứa khoảng trắng",
            action: (input) => {
                input.value = "";
            },
        },
        {
            test: (value) => !value.includes(" "),
            message: "Mật khẩu không được chứa kí tự khoảng trắng",
        },
        {
            test: (value) => value.length >= 5 && value.length <= 60,
            message: "Mật khẩu phải dài từ 5-60 kí tự",
        },
    ],
};

function debounce(func, delay = 300) {
    let timeout;
    return function (...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), delay);
    };
}

function validateInput(inputName) {
    const input = inputs[inputName];
    const rules = validationRules[inputName];
    const value = input.value;

    for (const rule of rules) {
        if (!rule.test(value)) {
            input.classList.add("invalid");
            input.classList.remove("valid");
            input.nextElementSibling.innerHTML = rule.message;

            if (rule.action) {
                rule.action(input);
            }

            return false;
        }
    }

    input.classList.add("valid");
    input.classList.remove("invalid");
    input.nextElementSibling.innerHTML = "";
    return true;
}

Object.keys(inputs).forEach((inputName) => {
    const input = inputs[inputName];
    const debouncedValidate = debounce(() => validateInput(inputName), 200);

    input.addEventListener("input", debouncedValidate);
    input.addEventListener("blur", () => validateInput(inputName));
});

registerForm.addEventListener("submit", function (event) {
    event.preventDefault();

    let isValid = true;
    Object.keys(inputs).forEach((inputName) => {
        if (!validateInput(inputName)) {
            isValid = false;
        }
    });

    if (!isValid) {
        const invalidInput = registerForm.querySelector("input.invalid");
        if (invalidInput) {
            invalidInput.focus();
        }
        return;
    }

    this.submit();
});
