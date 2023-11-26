function changeAvatar() {
    const avatarInput = document.getElementById("avatar-input");
    avatarInput.click();

    avatarInput.addEventListener("change", function (event) {
        const file = event.target.files[0];
        const avatarImage = document.getElementById("avatar-image");

        if (file) {
            const reader = new FileReader();

            reader.onload = function () {
                avatarImage.src = reader.result;
            };

            reader.readAsDataURL(file);
        }
    });
}

