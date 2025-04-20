document.addEventListener("DOMContentLoaded", function () {
    // Hiển thị dữ liệu giỏ hàng từ localStorage
    const cart = JSON.parse(localStorage.getItem("cart")) || [];
    const mobileCartContainer = document.querySelector(
        ".lg\\:hidden .max-h-\\[250px\\]"
    );
    const desktopCartContainer = document.querySelector(
        ".hidden.lg\\:block.max-h-\\[500px\\]"
    );
    const orderCountElements = document.querySelectorAll(
        ".text-\\[var\\(--orange-color\\)\\]"
    );
    const totalPriceElement = document.querySelector(
        ".flex.justify-between.text-xl.font-bold.mt-2 span:last-child"
    );
    const orderForm = document.querySelector("form");
    const cartCountElements = document.querySelectorAll(".cart-count");
    const cartItemsContainers = document.querySelectorAll(".cart-items");

    // Hàm định dạng giá tiền
    function formatPrice(price) {
        return price.toLocaleString("vi-VN") + "đ";
    }

    // Hàm map các giá trị enum
    const colorMap = {
        black: "Đen",
        white: "Trắng",
    };

    const printPositionMap = {
        CENTER_CHEST_A4: "Mặt trước",
        CENTER_BACK_A4: "Mặt sau",
        BOTH_SIDES: "Cả hai mặt",
    };

    // Nếu giỏ hàng trống, quay về trang giỏ hàng
    // if (cart.length === 0) {
    //     window.location.href = "/gio-hang";
    //     return;
    // }

    // Hiển thị số lượng sản phẩm
    orderCountElements.forEach((el) => {
        el.textContent = cart.length;
    });

    // Cập nhật số lượng sản phẩm
    cartCountElements.forEach((el) => {
        el.textContent = cart.length;
    });

    // Tính tổng tiền
    const totalPrice = cart.reduce(
        (total, item) => total + item.price * item.quantity,
        0
    );
    if (totalPriceElement) {
        totalPriceElement.textContent = formatPrice(totalPrice);
    }

    // Clear các container
    if (mobileCartContainer) {
        mobileCartContainer.innerHTML = "";
    }
    if (desktopCartContainer) {
        desktopCartContainer.innerHTML = "";
    }

    // Hiển thị danh sách sản phẩm
    function renderCartItems() {
        if (cart.length === 0) {
            cartItemsContainers.forEach((container) => {
                container.innerHTML =
                    '<p class="text-center text-gray-500">Giỏ hàng trống</p>';
            });
            return;
        }

        let totalPrice = 0;
        const cartItemsHtml = cart
            .map((item) => {
                const itemTotal = item.price * item.quantity;
                totalPrice += itemTotal;

                return `
                <div class="flex items-center border-b mr-[16px] mb-4 py-2">
                    <img src="${item.image}" alt="${item.productName}"
                        class="w-24 h-24 rounded-md object-cover">
                    <div class="ml-4 flex-1">
                        <h3 class="font-semibold">${item.productName}</h3>
                        <p class="text-sm text-gray-500">${item.size} / ${
                    item.color
                }</p>
                        <p class="mt-1">
                            <b>${item.price.toLocaleString()}đ</b>
                            <span class="text-[var(--orange-color)] font-semibold ml-2">x${
                                item.quantity
                            }</span>
                        </p>
                        <p class="text-sm font-bold text-end text-gray-600">Tạm tính: ${itemTotal.toLocaleString()}đ</p>
                    </div>
                </div>
            `;
            })
            .join("");

        // Render cho tất cả các container
        cartItemsContainers.forEach((container) => {
            container.innerHTML = cartItemsHtml;
        });

        // Cập nhật tổng tiền
        if (totalPriceElement) {
            totalPriceElement.textContent = totalPrice.toLocaleString() + "đ";
        }
    }

    // Gọi hàm render khi trang load
    renderCartItems();

    // Thêm dữ liệu giỏ hàng vào form để gửi đi
    if (orderForm) {
        const cartInput = document.createElement("input");
        cartInput.type = "hidden";
        cartInput.name = "cart_data";
        cartInput.value = JSON.stringify(cart);
        orderForm.appendChild(cartInput);

        const totalInput = document.createElement("input");
        totalInput.type = "hidden";
        totalInput.name = "total_price";
        totalInput.value = totalPrice;
        orderForm.appendChild(totalInput);

        // Thêm sự kiện cho form trước khi các đoạn mã khác xử lý nó
        const originalSubmitEvent = orderForm.onsubmit;
        orderForm.addEventListener("submit", function (event) {
            // Chỉ xóa giỏ hàng khi form đã được validate thành công
            const isFormValid = !document.querySelector(".invalid");
            if (isFormValid) {
                // Lưu trữ thông tin đơn hàng để hiển thị trang xác nhận (nếu cần)
                sessionStorage.setItem(
                    "last_order",
                    JSON.stringify({
                        items: cart,
                        total: totalPrice,
                        date: new Date().toISOString(),
                    })
                );

                // Xóa giỏ hàng sau khi đặt hàng thành công
                localStorage.removeItem("cart");
            }
        });
    }

    let provinceContainer = document.querySelector("#province");
    let provinceDropdown = provinceContainer.querySelector("ul");
    let inputHiddenProvince = document.querySelector('input[name="province"]');

    let districtContainer = document.querySelector("#district");
    let districtDropdown = districtContainer.querySelector("ul");
    let inputHiddenDistrict = document.querySelector('input[name="district"]');

    let wardContainer = document.querySelector("#ward");
    let wardDropdown = wardContainer.querySelector("ul");
    let inputHiddenWard = document.querySelector('input[name="ward"]');

    let districtClickHandler = null;
    let wardClickHandler = null;

    function addDropdownListener(container, dropdown, handler) {
        if (handler) {
            container.removeEventListener("click", handler);
        }

        const newHandler = () => {
            container.querySelector(
                "span.material-symbols-rounded"
            ).textContent = "arrow_drop_up";
            dropdown.classList.remove("hidden");
        };

        container.addEventListener("click", newHandler);

        return newHandler;
    }

    function disableDropdown(container, dropdown, defaultText) {
        container.classList.add("bg-[#eee]");
        container.querySelector("h5").textContent = defaultText || "---";

        const newContainer = container.cloneNode(true);
        container.parentNode.replaceChild(newContainer, container);

        return newContainer;
    }

    function setupFilterInput(container, dropdown) {
        const input = container.querySelector("input");

        input.addEventListener("input", (event) => {
            event.stopPropagation();
            const searchValue = input.value.toLowerCase();

            dropdown.querySelectorAll("div > li").forEach((liElement) => {
                const matches = liElement.textContent
                    .toLowerCase()
                    .includes(searchValue);
                liElement.classList.toggle("hidden", !matches);
            });
        });
    }

    function resetWard() {
        const wardText = "---";
        const newWardContainer = disableDropdown(
            wardContainer,
            wardDropdown,
            wardText
        );
        inputHiddenWard.value = "";
        inputHiddenDistrict.value = "";
        wardContainer = newWardContainer;
        wardDropdown = wardContainer.querySelector("ul");
        return wardText;
    }

    Promise.all([
        fetch("https://provinces.open-api.vn/api/p/"),
        fetch("https://provinces.open-api.vn/api/d/"),
        fetch("https://provinces.open-api.vn/api/w/"),
    ])
        .then((responses) =>
            Promise.all(responses.map((response) => response.json()))
        )
        .then((data) => {
            const [provinces, districts, wards] = data;

            const districtsMap = {};
            const wardsMap = {};

            districts.forEach((district) => {
                if (!districtsMap[district.province_code]) {
                    districtsMap[district.province_code] = [];
                }
                districtsMap[district.province_code].push(district);
            });

            wards.forEach((ward) => {
                if (!wardsMap[ward.district_code]) {
                    wardsMap[ward.district_code] = [];
                }
                wardsMap[ward.district_code].push(ward);
            });

            provinces.forEach((province) => {
                let liElement = document.createElement("li");
                liElement.classList.add(
                    "px-[6px]",
                    "py-[6px]",
                    "hover:bg-[#66afe9]"
                );
                liElement.textContent = province.name;
                liElement.dataset.province_code = province.code;
                provinceDropdown.querySelector("div").appendChild(liElement);
            });

            districts.forEach((district) => {
                let liElement = document.createElement("li");
                liElement.classList.add(
                    "px-[6px]",
                    "py-[6px]",
                    "hover:bg-[#66afe9]",
                    "hidden"
                );
                liElement.textContent = district.name;
                liElement.dataset.province_code = district.province_code;
                liElement.dataset.district_code = district.code;
                districtDropdown.querySelector("div").appendChild(liElement);
            });

            wards.forEach((ward) => {
                let liElement = document.createElement("li");
                liElement.classList.add(
                    "px-[6px]",
                    "py-[6px]",
                    "hover:bg-[#66afe9]",
                    "hidden"
                );
                liElement.textContent = ward.name;
                liElement.dataset.district_code = ward.district_code;
                wardDropdown.querySelector("div").appendChild(liElement);
            });

            districtClickHandler = addDropdownListener(
                provinceContainer,
                provinceDropdown
            );

            setupFilterInput(provinceContainer, provinceDropdown);
            setupFilterInput(districtContainer, districtDropdown);
            setupFilterInput(wardContainer, wardDropdown);

            document.addEventListener("click", (event) => {
                if (!provinceContainer.contains(event.target)) {
                    provinceContainer.querySelector(
                        "span.material-symbols-rounded"
                    ).textContent = "arrow_drop_down";
                    provinceDropdown.classList.add("hidden");
                }
                if (!districtContainer.contains(event.target)) {
                    districtContainer.querySelector(
                        "span.material-symbols-rounded"
                    ).textContent = "arrow_drop_down";
                    districtDropdown.classList.add("hidden");
                }
                if (!wardContainer.contains(event.target)) {
                    wardContainer.querySelector(
                        "span.material-symbols-rounded"
                    ).textContent = "arrow_drop_down";
                    wardDropdown.classList.add("hidden");
                }
            });

            provinceDropdown
                .querySelectorAll("div > li")
                .forEach((liProvinceElement) => {
                    liProvinceElement.addEventListener("click", (event) => {
                        event.stopPropagation();
                        const selectedValue = liProvinceElement.textContent;
                        const previousValue =
                            provinceContainer.querySelector("h5").textContent;

                        provinceDropdown
                            .querySelectorAll("div > li")
                            .forEach((e) => {
                                e.classList.remove("bg-[#eee]");
                            });
                        liProvinceElement.classList.add("bg-[#eee]");

                        provinceContainer.querySelector("h5").textContent =
                            selectedValue;
                        provinceContainer
                            .querySelector("ul > div")
                            .insertBefore(
                                liProvinceElement,
                                provinceDropdown.querySelector("div > li")
                                    .nextSibling
                            );

                        const districtText = "---";
                        const wardText = "---";

                        if (selectedValue === previousValue) {
                            return;
                        } else {
                            resetWard();
                        }

                        if (selectedValue !== "---") {
                            const provinceCode =
                                liProvinceElement.dataset.province_code;
                            inputHiddenProvince.value = selectedValue;

                            districtContainer.classList.remove("bg-[#eee]");

                            const newDistrictContainer =
                                districtContainer.cloneNode(true);
                            districtContainer.parentNode.replaceChild(
                                newDistrictContainer,
                                districtContainer
                            );
                            districtContainer = newDistrictContainer;
                            districtDropdown =
                                districtContainer.querySelector("ul");
                            districtClickHandler = addDropdownListener(
                                districtContainer,
                                districtDropdown
                            );

                            setupFilterInput(
                                districtContainer,
                                districtDropdown
                            );

                            districtDropdown
                                .querySelectorAll("div > li")
                                .forEach((liDistrictElement) => {
                                    const isRelevant =
                                        liDistrictElement.dataset
                                            .province_code === provinceCode;
                                    liDistrictElement.classList.toggle(
                                        "hidden",
                                        !isRelevant
                                    );

                                    if (isRelevant) {
                                        liDistrictElement.addEventListener(
                                            "click",
                                            handleDistrictClick
                                        );
                                    }
                                });
                        } else {
                            const newDistrictContainer = disableDropdown(
                                districtContainer,
                                districtDropdown,
                                districtText
                            );
                            inputHiddenProvince.value = "";
                            districtContainer = newDistrictContainer;
                            districtDropdown =
                                districtContainer.querySelector("ul");
                        }

                        districtContainer.querySelector("h5").textContent =
                            districtText;
                        wardContainer.querySelector("h5").textContent =
                            wardText;
                    });
                });

            function handleDistrictClick(event) {
                event.stopPropagation();
                const liDistrictElement = this;
                const selectedValue = liDistrictElement.textContent;

                const previousValue =
                    districtContainer.querySelector("h5").textContent;

                if (previousValue !== selectedValue) {
                    resetWard();
                }

                districtDropdown.querySelectorAll("div > li").forEach((e) => {
                    e.classList.remove("bg-[#eee]");
                });
                liDistrictElement.classList.add("bg-[#eee]");

                districtContainer.querySelector("h5").textContent =
                    selectedValue;
                districtContainer
                    .querySelector("ul > div")
                    .insertBefore(
                        liDistrictElement,
                        districtDropdown.querySelector("div > li").nextSibling
                    );

                if (selectedValue !== "---") {
                    inputHiddenDistrict.value = selectedValue;
                    const districtCode =
                        liDistrictElement.dataset.district_code;

                    wardContainer.classList.remove("bg-[#eee]");

                    const newWardContainer = wardContainer.cloneNode(true);
                    wardContainer.parentNode.replaceChild(
                        newWardContainer,
                        wardContainer
                    );
                    wardContainer = newWardContainer;
                    wardDropdown = wardContainer.querySelector("ul");
                    wardClickHandler = addDropdownListener(
                        wardContainer,
                        wardDropdown
                    );

                    setupFilterInput(wardContainer, wardDropdown);

                    wardDropdown
                        .querySelectorAll("div > li")
                        .forEach((liWardElement) => {
                            const isRelevant =
                                liWardElement.dataset.district_code ===
                                districtCode;
                            liWardElement.classList.toggle(
                                "hidden",
                                !isRelevant
                            );

                            if (isRelevant) {
                                liWardElement.addEventListener(
                                    "click",
                                    handleWardClick
                                );
                            }
                        });
                } else {
                    inputHiddenDistrict.value = "";
                    resetWard();
                }
            }

            function handleWardClick(event) {
                event.stopPropagation();
                const liWardElement = this;

                wardDropdown.querySelectorAll("div > li").forEach((e) => {
                    e.classList.remove("bg-[#eee]");
                });
                liWardElement.classList.add("bg-[#eee]");

                wardContainer.querySelector("h5").textContent =
                    liWardElement.textContent;
                inputHiddenWard.value = liWardElement.textContent;

                wardContainer
                    .querySelector("ul > div")
                    .insertBefore(
                        liWardElement,
                        wardDropdown.querySelector("div > li").nextSibling
                    );
            }
        })
        .catch((error) => {
            console.error("Lỗi khi tải dữ liệu:", error);
        });

    const inputs = {
        fullName: orderForm.querySelector('input[name="fullName"]'),
        email: orderForm.querySelector('input[name="email"]'),
        phoneNumber: orderForm.querySelector('input[name="phoneNumber"]'),
        province: orderForm.querySelector('input[name="province"]'),
        district: orderForm.querySelector('input[name="district"]'),
        ward: orderForm.querySelector('input[name="ward"]'),
        specifyAddress: orderForm.querySelector(
            'textarea[name="specifyAddress"]'
        ),
        note: orderForm.querySelector('textarea[name="note"]'),
    };

    const patterns = {
        name: /^[A-Za-zÀ-ỹ ]+$/,
        phoneNumber: /^0[0-9]{9,10}$/,
        email: /^[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$/,
    };

    const validationRules = {
        fullName: [
            {
                test: (value) => !!value.trim(),
                message: "Họ và tên không được để trống",
                action: (input) => {
                    input.value = "";
                },
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
                test: (value) => value.length <= 255,
                message: "Độ dài email tối đa chỉ được dưới 255 kí tự",
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
                message:
                    "Số điện thoại phải bắt đầu bằng 0 và gồm 10-11 chữ số",
            },
        ],
        province: [
            {
                test: (value) => !!value.trim(),
                message: "Tỉnh thành không được để trống",
            },
        ],
        district: [
            {
                test: (value) => !!value.trim(),
                message: "Quận huyện / Thành phố không được để trống",
            },
        ],
        ward: [
            {
                test: (value) => !!value.trim(),
                message: "Phường xã không được để trống",
            },
        ],
        specifyAddress: [
            {
                test: (value) => !!value.trim(),
                message: "Địa chỉ cụ thể không được để trống",
                action: (input) => {
                    input.value = "";
                },
            },
            {
                test: (value) => value.length <= 500,
                message: "Địa chỉ cụ thể tối đa chỉ được dưới 255 kí tự",
            },
        ],
        note: [
            {
                test: (value) => value.length <= 255,
                message: "Độ dài ghi chú tối đa chỉ được dưới 255 kí tự",
            },
        ],
    };

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

        const debouncedValidate = debounce(() => validateInput(inputName), 500);

        input.addEventListener("input", debouncedValidate);
        input.addEventListener("blur", () => validateInput(inputName));
    });

    orderForm.addEventListener("submit", function (event) {
        event.preventDefault();

        let isValid = true;
        Object.keys(inputs).forEach((inputName) => {
            if (!validateInput(inputName)) {
                isValid = false;
            }
        });

        if (!isValid) {
            const invalidInput = orderForm.querySelector("input.invalid");
            if (invalidInput) {
                invalidInput.focus();
            }
            return;
        }

        this.submit();
    });

    function debounce(func, delay = 300) {
        let timeout;
        return function (...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

    const form = document.querySelector("form");
    const submitBtn = document.querySelector('button[name="SubmitOrder"]');
    const errorMessages = document.querySelectorAll(".error-message");

    // Reset error messages
    function resetErrors() {
        errorMessages.forEach((error) => (error.textContent = ""));
    }

    // Validate form
    function validateForm() {
        let isValid = true;
        resetErrors();

        // Validate email
        const email = form.querySelector('input[name="email"]');
        if (!email.value) {
            email.nextElementSibling.textContent = "Vui lòng nhập email";
            isValid = false;
        } else if (!email.checkValidity()) {
            email.nextElementSibling.textContent = "Email không hợp lệ";
            isValid = false;
        }

        // Validate full name
        const fullName = form.querySelector('input[name="fullName"]');
        if (!fullName.value) {
            fullName.nextElementSibling.textContent = "Vui lòng nhập họ tên";
            isValid = false;
        } else if (!fullName.checkValidity()) {
            fullName.nextElementSibling.textContent =
                "Họ tên chỉ được chứa chữ cái và dấu cách";
            isValid = false;
        }

        // Validate phone number
        const phoneNumber = form.querySelector('input[name="phoneNumber"]');
        if (!phoneNumber.value) {
            phoneNumber.nextElementSibling.textContent =
                "Vui lòng nhập số điện thoại";
            isValid = false;
        } else if (!phoneNumber.checkValidity()) {
            phoneNumber.nextElementSibling.textContent =
                "Số điện thoại không hợp lệ";
            isValid = false;
        }

        // Validate address
        const province = form.querySelector('input[name="province"]');
        const district = form.querySelector('input[name="district"]');
        const ward = form.querySelector('input[name="ward"]');
        const specifyAddress = form.querySelector(
            'textarea[name="specifyAddress"]'
        );

        if (!province.value) {
            document.getElementById("province").nextElementSibling.textContent =
                "Vui lòng chọn tỉnh/thành phố";
            isValid = false;
        }

        if (!district.value) {
            document.getElementById("district").nextElementSibling.textContent =
                "Vui lòng chọn quận/huyện";
            isValid = false;
        }

        if (!ward.value) {
            document.getElementById("ward").nextElementSibling.textContent =
                "Vui lòng chọn phường/xã";
            isValid = false;
        }

        if (!specifyAddress.value) {
            specifyAddress.nextElementSibling.textContent =
                "Vui lòng nhập địa chỉ cụ thể";
            isValid = false;
        }

        return isValid;
    }

    // Handle form submission
    form.addEventListener("submit", function (e) {
        e.preventDefault();

        if (!validateForm()) {
            return;
        }

        // Get cart data from localStorage
        const cart = JSON.parse(localStorage.getItem("cart")) || [];
        if (cart.length === 0) {
            Swal.fire({
                icon: "error",
                title: "Giỏ hàng trống",
                text: "Vui lòng thêm sản phẩm vào giỏ hàng trước khi đặt hàng",
                confirmButtonText: "OK",
            });
            return;
        }

        // Prepare form data
        const formData = new FormData(form);
        formData.append("cart", JSON.stringify(cart));

        // Show loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML =
            '<span class="material-symbols-rounded animate-spin">refresh</span> Đang xử lý...';

        // Submit form
        fetch("/order", {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
            },
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    // Clear cart
                    localStorage.removeItem("cart");

                    // Show success message and redirect
                    Swal.fire({
                        icon: "success",
                        title: "Đặt hàng thành công",
                        text: "Cảm ơn bạn đã mua hàng!",
                        confirmButtonText: "OK",
                    }).then(() => {
                        window.location.href = "/";
                    });
                } else {
                    throw new Error(data.message || "Có lỗi xảy ra");
                }
            })
            .catch((error) => {
                Swal.fire({
                    icon: "error",
                    title: "Lỗi",
                    text: error.message || "Có lỗi xảy ra khi đặt hàng",
                    confirmButtonText: "OK",
                });
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.textContent = "ĐẶT HÀNG";
            });
    });
});
