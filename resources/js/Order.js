document.addEventListener("DOMContentLoaded", function () {
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

    const orderForm = document.querySelector("form");

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
});
