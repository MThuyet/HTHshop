document.addEventListener('DOMContentLoaded', function () {
    const checkboxChangePassword = document.getElementById('toggleChangePwd');
    const oldPassword = document.getElementById('oldPassword');
    const newPassword = document.getElementById('newPassword');
    const avatarInput = document.querySelector('input[name="avatar"]')
    const avatarImage = document.getElementById('avatar-image');

    avatarInput.addEventListener('change', () => {
        const file = avatarInput.files[0];
        if (file) {
            const fileName = file.name;
            const fileExtension = fileName.slice(((fileName.lastIndexOf(".") - 1) >>> 0) + 2);

            if (fileExtension === 'jpg' || fileExtension === 'jpeg' || fileExtension === 'png' || fileExtension === 'webp') {
                const url = window.URL.createObjectURL(file);
                avatarImage.src = url;
            } else {
                Swal.fire({
                    icon: 'error',
                    title: `Có lỗi`,
                    text: `Vui lòng gửi file đúng định dạnh ảnh (jpg, jpeg, png, webp)`,
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        }
    });

    checkboxChangePassword.addEventListener('change', () => {
        if(checkboxChangePassword.checked) {
            oldPassword.classList.remove('hidden');
            newPassword.classList.remove('hidden');
        }else {
            oldPassword.classList.add('hidden');
            newPassword.classList.add('hidden');
        }
    });
});