<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="card p-4 shadow">
        <h3 class="text-center">Edit Profile</h3>
        
        <!-- Foto Profil -->
        <div class="text-center">
            <img id="profileImage" src="default-profile.png" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
            <input type="file" id="uploadProfile" accept="image/*" class="form-control mt-2">
        </div>

        <!-- Form Data -->
        <form id="profileForm">
            <div class="mb-3">
                <label class="form-label">Nama:</label>
                <input type="text" id="janitornameInput" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">No. Hp:</label>
                <input type="text" id="phoneInput" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Email:</label>
                <input type="email" id="emailInput" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat:</label>
                <input type="text" id="addressInput" class="form-control">
            </div>

            <button type="button" class="btn btn-primary w-100" onclick="saveProfile()">Submit</button>
        </form>
    </div>
</div>

<script>
    function openProfileModal() {
        let savedImage = localStorage.getItem("profileImage");
        let savedJanitorname = localStorage.getItem("janitorname");
        let savedPhone = localStorage.getItem("phone");
        let savedEmail = localStorage.getItem("email");
        let savedAddress = localStorage.getItem("address");

        if (savedImage) document.getElementById("profileImage").src = savedImage;
        if (savedJanitorname) document.getElementById("janitornameInput").value = savedJanitorname;
        if (savedPhone) document.getElementById("phoneInput").value = savedPhone;
        if (savedEmail) document.getElementById("emailInput").value = savedEmail;
        if (savedAddress) document.getElementById("addressInput").value = savedAddress;
    }

    document.getElementById("uploadProfile").addEventListener("change", function(event) {
        let file = event.target.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("profileImage").src = e.target.result;
                localStorage.setItem("profileImage", e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });

    function saveProfile() {
        let newJanitorname = document.getElementById("janitornameInput").value;
        let newPhone = document.getElementById("phoneInput").value;
        let newEmail = document.getElementById("emailInput").value;
        let newAddress = document.getElementById("addressInput").value;

        localStorage.setItem("janitorname", newJanitorname);
        localStorage.setItem("phone", newPhone);
        localStorage.setItem("email", newEmail);
        localStorage.setItem("address", newAddress);

        alert("Profile berhasil diperbarui!");
        <a href="{{ route('janitor.index') }}" class="btn btn-primary">Submit</a>
    }
    <form id="janitorForm" onsubmit="saveProfile(); return true;">
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>
    function saveProfile() {
        let newJanitorname = document.getElementById("janitornameInput").value;
        localStorage.setItem("janitorname", newJanitorname);

        let newPhone = document.getElementById("phoneInput").value;
        localStorage.setItem("phone", newPhone);

        let newEmail = document.getElementById("emailInput").value;
        localStorage.setItem("email", newEmail);

        let newAddress = document.getElementById("addressInput").value;
        localStorage.setItem("address", newAddress);

        alert("Profile berhasil diperbarui!");
    }
</script>
    window.onload = openProfileModal;
</script>

</body>
</html>