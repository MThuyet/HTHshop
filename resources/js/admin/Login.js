const loginForm = document.querySelector('form');
const inputs = {
    username: loginForm.querySelector('input[name="username"]'),
    password: loginForm.querySelector('input[name="password"]')
};

const validationRules = {
    username: [
        {
            test: value => !!value.trim(),
            message: "Tên tài khoản không được để trống",
            action: input => { input.value = ""; }
        },
        {
            test: value => value.length >= 5 && value.length <= 50,
            message: "Tên tài khoản phải dài từ 5-50 kí tự"
        },
    ],
    password: [
        {
            test: value => !!value.trim(),
            message: "Mật khẩu không được để trống và không được chứa khoảng trắng",
            action: input => { input.value = ""; }
        },
        {
            test: value => !value.includes(' '),
            message: "Mật khẩu không được chứa kí tự khoảng trắng"
        },
        {
            test: value => value.length >= 5 && value.length <= 60,
            message: "Mật khẩu phải dài từ 5-60 kí tự"
        }
    ]
}

function debounce(func, delay = 300) {
    let timeout;
    return function(...args) {
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
            input.classList.add('invalid');
            input.classList.remove('valid');
            input.nextElementSibling.innerHTML = rule.message;
            
            if (rule.action) {
                rule.action(input);
            }
            
            return false;
        }
    }
    
    input.classList.add('valid');
    input.classList.remove('invalid');
    input.nextElementSibling.innerHTML = "";
    return true;
}

Object.keys(inputs).forEach(inputName => {
    const input = inputs[inputName];
    const debouncedValidate = debounce(() => validateInput(inputName), 200);
    
    input.addEventListener('input', debouncedValidate);
    input.addEventListener('blur', () => validateInput(inputName));
});

loginForm.addEventListener('submit', function(event) {
    event.preventDefault();
    
    let isValid = true;
    Object.keys(inputs).forEach(inputName => {
        if (!validateInput(inputName)) {
            isValid = false;
        }
    });
    
    if (!isValid) {
        const invalidInput = loginForm.querySelector('input.invalid');
        if (invalidInput) {
            invalidInput.focus();
        }
        return;
    }
    
    this.submit();
});