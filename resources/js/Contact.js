document.addEventListener('DOMContentLoaded', function () {
    document.querySelector("#storeImage").addEventListener('click', openLightbox);
    document.querySelector("#imageLightbox button").addEventListener('click', closeLightbox);

    const contactForm = document.querySelector('form');
    
    const inputs = {
        fullName: contactForm.querySelector('input[name="fullName"]'),
        email: contactForm.querySelector('input[name="email"]'),
        message: contactForm.querySelector('textarea[name="message"]')
    };

    const patterns = {
        name: /^[A-Z0-9a-zÀ-ỹ ]+$/,
        email: /^[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$/
    };

    const validationRules = {
        fullName: [
            {
                test: value => !!value.trim(),
                message: "Họ và tên không được để trống",
                action: input => { input.value = ""; }
            },
        ],
        email: [
            {
                test: value => !!value.trim(),
                message: "Email không được để trống",
                action: input => { input.value = ""; }
            },
            {
                test: value => patterns.email.test(value),
                message: "Email không hợp lệ"
            },
            {
                test: value => value.length <= 254,
                message: "Độ dài email tối đa chỉ được dưới 255 kí tự"
            }
        ],
        message: [
            {
                test: value => !!value.trim(),
                message: "Tin nhắn không được để trống",
                action: input => { input.value = ""; }
            },
            {
                test: value => value.length <= 500,
                message: "Độ dài email tối đa chỉ được dưới 500 kí tự"
            },
        ],
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

    
    
    contactForm.addEventListener('submit', function(event) {
        event.preventDefault();
        
        let isValid = true;
        Object.keys(inputs).forEach(inputName => {
            if (!validateInput(inputName)) {
                isValid = false;
            }
        });
        
        if (!isValid) {
            const invalidInput = contactForm.querySelector('input.invalid');
            if (invalidInput) {
                invalidInput.focus();
            }
            return;
        }
        
        this.submit();
    });
});

function debounce(func, delay = 300) {
    let timeout;
    return function(...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), delay);
    };
}

function openLightbox() {
    document.getElementById('imageLightbox').classList.remove('hidden');
    document.getElementById('imageLightbox').classList.add('flex');
    document.body.style.overflow = 'hidden'; 
}
  
function closeLightbox() {
    document.getElementById('imageLightbox').classList.add('hidden');
    document.getElementById('imageLightbox').classList.remove('flex');
    document.body.style.overflow = '';
}
  
document.getElementById('imageLightbox').addEventListener('click', function(e) {
    if (e.target === this) {
      closeLightbox();
    }
});
  
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && !document.getElementById('imageLightbox').classList.contains('hidden')) {
        closeLightbox();
    }
});